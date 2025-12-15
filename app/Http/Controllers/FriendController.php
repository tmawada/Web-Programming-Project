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

        // Search Users
        $users = [];
        if ($request->has('search')) {
            $search = $request->get('search');
            $users = \App\Models\User::where('id', '!=', $user->id)
                ->where('name', 'like', "%{$search}%")
                ->whereDoesntHave('friends', function($q) use ($user) {
                    $q->where('friend_id', $user->id);
                }) // Basic exclusion, ideally exclude existing friends properly logic is complex
                ->get();
            // Simplify search: just get users matching name, view will handle "already friend" check visually if needed, or refine here.
            // Let's refine: Exclude if a friendship record exists either way.
            $existingFriendIds = \App\Models\Friend::where('user_id', $user->id)->pluck('friend_id')->toArray();
            $existingFriendIds2 = \App\Models\Friend::where('friend_id', $user->id)->pluck('user_id')->toArray();
            $excludeIds = array_merge([$user->id], $existingFriendIds, $existingFriendIds2);

            $users = \App\Models\User::whereNotIn('id', $excludeIds)
                ->where('name', 'like', "%{$search}%")
                ->get();
        }

        return view('friends.index', compact('friends', 'requests', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate(['friend_id' => 'required|exists:users,id']);
        
        // Prevent duplicate
        $exists = \App\Models\Friend::where(function($q) use ($request) {
            $q->where('user_id', auth()->id())->where('friend_id', $request->friend_id);
        })->orWhere(function($q) use ($request) {
            $q->where('user_id', $request->friend_id)->where('friend_id', auth()->id());
        })->exists();

        if (!$exists) {
            \App\Models\Friend::create([
                'user_id' => auth()->id(),
                'friend_id' => $request->friend_id,
                'status' => 'pending'
            ]);
        }

        return back()->with('success', 'Friend request sent!');
    }

    public function update(Request $request, $id)
    {
        $friendship = \App\Models\Friend::where('id', $id)->where('friend_id', auth()->id())->firstOrFail();
        $friendship->update(['status' => 'accepted']);

        return back()->with('success', 'Friend request accepted!');
    }

    public function destroy($id)
    {
        // Allow deleting if user is involved
        $friendship = \App\Models\Friend::where('id', $id)
            ->where(function($q) {
                $q->where('user_id', auth()->id())->orWhere('friend_id', auth()->id());
            })->firstOrFail();
        
        $friendship->delete();

        return back()->with('success', 'Friend removed.');
    }
}
