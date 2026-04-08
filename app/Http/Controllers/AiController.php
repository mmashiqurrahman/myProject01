<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AiReply;

class AiController extends Controller
{
    public function getReply(Request $request) {
        
        $apiKey = env('GOOGLE_API_KEY');
        if (!$apiKey) {
            die("Error: GOOGLE_API_KEY not found. Run 'export GOOGLE_API_KEY=your_key'\n");
        }
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-3.1-flash-lite-preview:generateContent?key=" . $apiKey;

        $data = [
            "contents" => [
                [
                    "parts" => [
                        ["text" => $request->question]
                    ]
                ]
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
            dd(curl_error($ch));
        } else {
            $result = json_decode($response, true);
            
            if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
                
                AiReply::create([
                    'question' => $request->question,
                    'answer' => $result['candidates'][0]['content']['parts'][0]['text']
                ]);

                return redirect()->back();

            } else {
                dd($response);
            }
        }
        curl_close($ch);

    }
}
