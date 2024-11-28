<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Exception;


class RegisterUserController extends Controller
{
    public function create() {
        $roles = Role::all();
        return view('register', ['roles' => $roles]);
    }

    public function store(Request $request) {

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users'
        ]);

        try{
            $user = User::create([
                'name' => $request->name,
                'role_id' => $request->role_id,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            return redirect()->route('homepage');
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }
}
