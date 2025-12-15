<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate(['body' => 'required|string']);

        \App\Models\Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $postId,
            'body' => $request->body,
        ]);

        return back()->with('success', 'Comment added!');
    }
}
