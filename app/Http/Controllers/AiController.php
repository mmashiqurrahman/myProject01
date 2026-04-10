<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\AiReply;
use Throwable;

class AiController extends Controller
{
    public function getReply(Request $request) {
        
        $apiKey = env('GOOGLE_API_KEY');
        if (!$apiKey) {
            die("Error: GOOGLE_API_KEY not found. Run 'export GOOGLE_API_KEY=your_key'\n");
        }
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-3.1-flash-image-preview:generateContent?key=" . $apiKey;

        $data = [
            "contents" => [
                [
                    "parts" => [
                        ["text" => $request->question]
                    ]
                ]
            ],
            "generation_config" => [
                "response_modalities" => ["IMAGE"] 
            ]
        ];

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            dd('Curl Error!');
            dd(curl_error($ch));
        }

        $result = json_decode($response, true);

        // Check for parts and then check if inline_data exists
        $parts = $result['candidates'][0]['content']['parts'] ?? [];
        $base64Image = null;

        foreach ($parts as $part) {
            if (isset($part['inlineData']['data'])) {
                $base64Image = $part['inlineData']['data'];
                break;
            }
        }

        if ($base64Image) {
            // 2. Decode the Base64 string into binary image data
            $imageBinary = base64_decode($base64Image);

            // 3. Generate a unique filename
            $fileName = 'ai' . time() . '.png';
            $filePath = 'generated_images/' . $fileName;

            // 4. Save to the 'public' disk (storage/app/public/generated_images)
            // Make sure to run 'php artisan storage:link' if you haven't already
            \Illuminate\Support\Facades\Storage::disk('public')->put($filePath, $imageBinary);

            // 5. Get the URL for the frontend
            $url = \Illuminate\Support\Facades\Storage::url($filePath);

            try {
                AiReply::create([
                    'question' => $request->question,
                    'answer' => $url
                ]);
            } catch (Throwable $e) {
                dd($e->getMessage());
            }

            return redirect()->back();
        } else {
            // dd('No image was received.');
            dd($result);
        }

        curl_close($ch);

    }

    // =============================================================================

    public function submitImageWithRequest(Request $request) {

        $apiKey = env('GOOGLE_API_KEY');
        if (!$apiKey) {
            \Log::error("Gemini API Key missing in background job.");
            return;
        }

        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-image:generateContent?key=" . $apiKey;

        $logoPath = 'uploaded_file/logo.png';
        if (!Storage::disk('public')->exists($logoPath)) {
            dd('Logo not found.');
        }

        $logoBinary = Storage::disk('public')->get($logoPath);
        $logoMimeType = Storage::disk('public')->mimeType($logoPath);

        // 3. Build the JSON Payload (No manual boundaries needed)
        $payload = [
            "contents" => [
                [
                    "parts" => [
                        ["text" => $request->question],
                        [
                            "inline_data" => [
                                "mime_type" => $logoMimeType,
                                "data" => base64_encode($logoBinary)
                            ]
                        ]
                    ]
                ]
            ],
            "generation_config" => [
                "response_modalities" => ["IMAGE"]
            ]
        ];

        // 4. Send as a standard JSON POST
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->timeout(600)->post($url, $payload);

        if (!$response->successful()) {
            dd([
                'status' => $response->status(),
                'error'  => $response->json()
            ]);
        }

        $result = $response->json();
        
        // 5. Extraction logic (remain the same)
        $base64Image = $result['candidates'][0]['content']['parts'][0]['inlineData']['data'] ?? null;

        if ($base64Image) {
            $resultFileName = 'ai' . time() . '.png';
            Storage::disk('public')->put('generated_images/' . $resultFileName, base64_decode($base64Image));
            return Storage::url('generated_images/' . $resultFileName);
        } else {
            dd($result);
        }
    }
}
