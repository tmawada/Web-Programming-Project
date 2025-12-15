<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function show($userId)
    {
        $friend = \App\Models\User::findOrFail($userId);
        $authId = auth()->id();

        // Mark messages as read
        \App\Models\Message::where('sender_id', $userId)
            ->where('receiver_id', $authId)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        $messages = \App\Models\Message::where(function($q) use ($authId, $userId) {
            $q->where('sender_id', $authId)->where('receiver_id', $userId);
        })->orWhere(function($q) use ($authId, $userId) {
            $q->where('sender_id', $userId)->where('receiver_id', $authId);
        })->orderBy('created_at')->get();

        return view('friends.chat', compact('friend', 'messages'));
    }

    public function store(Request $request, $userId)
    {
        $request->validate(['content' => 'required|string']);

        \App\Models\Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $userId,
            'content' => $request->content,
        ]);

        return back();
    }
}
