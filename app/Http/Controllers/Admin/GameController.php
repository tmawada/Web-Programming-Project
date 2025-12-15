<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = \App\Models\Game::latest()->paginate(10);
        return view('admin.games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.games.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'cover_image' => 'required|url', // Assuming URL for now, or use file upload? Let's use URL for simplicity or handle file upload later if user asks. User prompt said "add games into game list" - URL is easier for now to match seeder logic.
            'platform' => 'required|string',
            'genre' => 'required|string',
            'publisher' => 'required|string',
            'release_date' => 'required|date',
        ]);

        \App\Models\Game::create($validated);

        return redirect()->route('admin.games.index')->with('success', 'Game created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $game = \App\Models\Game::findOrFail($id);
        return view('admin.games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $game = \App\Models\Game::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'cover_image' => 'required|url',
            'platform' => 'required|string',
            'genre' => 'required|string',
            'publisher' => 'required|string',
            'release_date' => 'required|date',
        ]);

        $game->update($validated);

        return redirect()->route('admin.games.index')->with('success', 'Game updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $game = \App\Models\Game::findOrFail($id);
        $game->delete();

        return redirect()->route('admin.games.index')->with('success', 'Game deleted successfully.');
    }
}
