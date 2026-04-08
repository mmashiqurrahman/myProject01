<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AiReply;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('userlist', ['users' => $users]);
    }

    public function profile() {
        $user = Auth::user();
        return view('profile', ['user' => $user]);
    }

    public function dashboard() {
        $user = Auth::user();
        $aiReplies = AiReply::all();
        return view('dashboard', ['user' => $user, 'aiReplies' => $aiReplies]);
    }
}
