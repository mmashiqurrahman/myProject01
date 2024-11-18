<?php

namespace App\Http\Controllers;

use App\Models\UserPosts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = UserPosts::all();
        return view('posts', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        return view('addpost', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            UserPosts::create([
                'title' => $request->title,
                'post' => $request->post,
                'user_id' => $request->user_id
            ]);
            return redirect()->route('user.profile');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UserPosts $userPosts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserPosts $userPosts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserPosts $userPosts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserPosts $userPosts)
    {
        //
    }
}
