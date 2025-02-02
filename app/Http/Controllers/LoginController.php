<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function create() {
        return view('login');
    }

// This this the Login Controller.

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
}
