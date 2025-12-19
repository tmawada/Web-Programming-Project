<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        
        // Accepted Friends
        $friends = \App\Models\Friend::where(function($q) use ($user) {
            $q->where('user_id', $user->id)->orWhere('friend_id', $user->id);
        })->where('status', 'accepted')->get()->map(function($friend) use ($user) {
            return $friend->user_id == $user->id ? $friend->friend : $friend->user;
        });

        // Pending Requests (Incoming)
        $requests = \App\Models\Friend::where('friend_id', $user->id)
            ->where('status', 'pending')->with('user')->get();

        // Get existing friend IDs
        $existingFriendIds = \App\Models\Friend::where(function($q) use ($user) {
            $q->where('user_id', $user->id)->orWhere('friend_id', $user->id);
        })->where('status', 'accepted')->get()->map(function($friend) use ($user) {
            return $friend->user_id == $user->id ? $friend->friend_id : $friend->user_id;
        })->toArray();

        // Get pending request IDs (both sent and received)
        $pendingRequestIds = \App\Models\Friend::where(function($q) use ($user) {
            $q->where('user_id', $user->id)->orWhere('friend_id', $user->id);
        })->where('status', 'pending')->get()->map(function($friend) use ($user) {
            return $friend->user_id == $user->id ? $friend->friend_id : $friend->user_id;
        })->toArray();

        // Search Users
        $users = [];
        if ($request->has('search')) {
            $search = $request->get('search');
            $users = \App\Models\User::where('id', '!=', $user->id)
                ->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('username', 'like', "%{$search}%");
                })
                ->get();
        }

        return view('friends.index', compact('requests', 'friends', 'users', 'existingFriendIds', 'pendingRequestIds'));
    }

    public function store(Request $request)
    {
        $request->validate(['friend_id' => 'required|exists:users,id']);

        $friend = \App\Models\Friend::create([
            'user_id' => auth()->id(),
            'friend_id' => $request->friend_id,
            'status' => 'pending',
        ]);

        return redirect()->route('friends.index')->with('success', 'Friend request sent!');
    }

    public function accept($id)
    {
        $friendRequest = \App\Models\Friend::findOrFail($id);
        
        if ($friendRequest->friend_id != auth()->id()) {
            abort(403);
        }

        $friendRequest->update(['status' => 'accepted']);

        return redirect()->route('friends.index')->with('success', 'Friend request accepted!');
    }

    public function decline($id)
    {
        $friendRequest = \App\Models\Friend::findOrFail($id);
        
        if ($friendRequest->friend_id != auth()->id()) {
            abort(403);
        }

        $friendRequest->delete();

        return redirect()->route('friends.index')->with('success', 'Friend request declined.');
    }

    // Route-compatible methods: `update` for accepting and `destroy` for declining
    public function update(Request $request, $id)
    {
        return $this->accept($id);
    }

    public function destroy($id)
    {
        return $this->decline($id);
    }
}
