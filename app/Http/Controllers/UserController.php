<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index() {
        return view('userlist');
    }

    public function getUsers() {
        return DataTables::of(User::query())
        ->addColumn('role', function(User $user) {
            $role = Role::where('id', $user->role_id)->first();
            return $role->name;
        })
        ->toJson();
    }

    public function profile() {
        $user = Auth::user();
        return view('profile', ['user' => $user]);
    }

    public function dashboard() {
        $user = Auth::user();
        return view('dashboard', ['user' => $user]);
    }
}
