<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index($gameId)
    {
        $game = \App\Models\Game::findOrFail($gameId);
        $posts = $game->posts()->with('user')->latest()->paginate(10);
        return view('forum.index', compact('game', 'posts'));
    }

    public function show($gameId, $postId)
    {
        $game = \App\Models\Game::findOrFail($gameId);
        $post = \App\Models\Post::with(['user', 'comments.user'])->findOrFail($postId);
        return view('forum.show', compact('game', 'post'));
    }

    public function store(Request $request, $gameId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        \App\Models\Post::create([
            'user_id' => auth()->id(),
            'game_id' => $gameId,
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return back()->with('success', 'Post created!');
    }
}
