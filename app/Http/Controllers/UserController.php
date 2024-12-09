<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Exception;

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

    public function changeImage() {
        $user = Auth::user();
        return view('change-image', ['user' => $user]);
    }

    public function updateImage(Request $request) {
        $request->validate([
            'image' => 'required'
        ]);

        $path = $request->image->store('public');
        $path = str_replace('public', 'storage', $path);

        try{
            $user = User::find($request->user_id);
            $user->image = $path;
            $user->save();
            return redirect()->route('user.dashboard');
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function downloadImage() {
        $user = Auth::user();
        return response()->download($user->image);
    }
}
