<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserGame;

class LibraryController extends Controller
{
    public function index()
    {
        $purchasedGames = UserGame::where('user_id', auth()->id())
            ->with('game')
            ->orderBy('purchased_at', 'desc')
            ->get();

        return view('library.index', compact('purchasedGames'));
    }
}
