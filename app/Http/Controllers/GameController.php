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
        // Check if game is already in cart
        $inCart = false;
        if (auth()->check()) {
            $cart = \App\Models\Cart::where('user_id', auth()->id())->first();
            if ($cart) {
                $inCart = $cart->items()->where('game_id', $game->id)->exists();
            }
        } else {
            $cart = \App\Models\Cart::where('session_id', session()->getId())->first();
            if ($cart) {
                $inCart = $cart->items()->where('game_id', $game->id)->exists();
            }
        }
        
        return view('games.show', compact('game', 'inCart'));
    }
}
