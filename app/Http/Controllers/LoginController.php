<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function create() {
        return view('login');
    }

    public function store(Request $request) {
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)) {
            Log::info("logged in User: " . json_encode(Auth::user()));
            return redirect()->route('user.profile');
        }
        Log::info("Login attempt failed.");
        return redirect()->route('login.create');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login.create');
    }

    public function apiLogin() {
        return view('api.apilogin');
    }

    public function apiLoginAttempt(Request $request) {

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = User::where('email', $request->email)->first();
            $token = $user->createToken($user->email)->accessToken;
            
            $data['access_token'] = $token;
            return response()->json($data);

        } else {
            return response()->json(['That did not work. Try again.']);
        }
    }
}