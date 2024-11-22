<?php

namespace App\Http\Controllers;

use App\Models\PostComments;
use Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($post_id)
    {
        $user = Auth::user();
        return view('addcomment', ['commenter_id' => $user->id, 'post_id' => $post_id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            PostComments::create([
                'comment' => $request->comment,
                'post_id' => $request->post_id,
                'commenter_id' => $request->commenter_id
            ]);
            return redirect()->route('user.profile');
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PostComments $postComments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostComments $postComments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PostComments $postComments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostComments $postComments)
    {
        //
    }
}
