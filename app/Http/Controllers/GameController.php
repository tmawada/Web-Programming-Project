<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->get('search');
            $games = Game::where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('genre', 'like', "%{$search}%")
                ->paginate(8);
        } else {
            $games = Game::paginate(8);
        } return view('games.index', compact('games'));
    }

    public function show(Game $game)
    {
        return view('games.show', compact('game'));
    }
}
