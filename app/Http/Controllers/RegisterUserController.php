<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Exception;


class RegisterUserController extends Controller
{
    public function create() {
        return view('register');
    }

    public function store(Request $request) {

        try{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            return redirect()->route('homepage');
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }
}
