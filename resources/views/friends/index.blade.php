<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyber-primary leading-tight">
            {{ __('Friends') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
                <div class="bg-green-500/20 text-green-400 p-4 rounded border border-green-500/50">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Friend Requests -->
            @if($requests->count() > 0)
                <div class="bg-cyber-alt shadow sm:rounded-lg border border-cyber-secondary/30 p-6">
                    <h3 class="text-lg font-medium text-cyber-text mb-4 flex items-center">
                        <span class="bg-cyber-primary text-white text-xs px-2 py-1 rounded-full mr-2">{{ $requests->count() }}</span>
                        Friend Requests
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach($requests as $req)
                            <div class="bg-cyber-bg p-4 rounded-lg border border-cyber-secondary/20 flex justify-between items-center hover:border-cyber-primary/50 transition">
                                <div class="flex items-center space-x-3">
                                    <div class="h-12 w-12 rounded-full bg-gradient-to-br from-cyber-primary to-cyber-secondary flex items-center justify-center text-white font-bold text-lg">
                                        {{ substr($req->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <span class="text-gray-200 font-medium block">{{ $req->user->name }}</span>
                                        <span class="text-gray-500 text-xs">@{{ $req->user->username }}</span>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <form action="{{ route('friends.update', $req->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-green-500/20 text-green-400 hover:bg-green-500 hover:text-white px-3 py-1.5 rounded text-sm font-medium transition border border-green-500/50">Accept</button>
                                    </form>
                                    <form action="{{ route('friends.destroy', $req->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500/20 text-red-400 hover:bg-red-500 hover:text-white px-3 py-1.5 rounded text-sm font-medium transition border border-red-500/50">Decline</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- My Friends -->
            <div class="bg-cyber-alt shadow sm:rounded-lg border border-cyber-secondary/30 p-6">
                <h3 class="text-lg font-medium text-cyber-text mb-4">My Friends</h3>
                @if($friends->count() > 0)
                    <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($friends as $friend)
                            <li class="bg-cyber-bg p-4 rounded border border-cyber-secondary/20 flex justify-between items-center">
                                <div class="flex items-center space-x-3 flex-1 min-w-0">
                                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-cyber-primary to-cyber-secondary flex items-center justify-center text-white font-bold flex-shrink-0">
                                        {{ substr($friend->name, 0, 1) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="text-cyber-text font-medium truncate">{{ $friend->name }}</div>
                                        <div class="text-gray-500 text-sm">@{{ $friend->username }}</div>
                                    </div>
                                </div>
                                <a href="{{ route('chat.show', $friend->id) }}" class="bg-cyber-secondary/20 text-cyber-secondary hover:bg-cyber-secondary hover:text-white px-3 py-1 rounded text-xs transition flex-shrink-0">
                                    Chat
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">You haven't added any friends yet.</p>
                @endif
            </div>

            <!-- Find Friends -->
            <div class="bg-cyber-alt shadow sm:rounded-lg border border-cyber-secondary/30 p-6">
                <h3 class="text-lg font-medium text-cyber-text mb-4">Find Friends</h3>
                <div x-data="{ 
                    search: '{{ request('search') }}',
                    debounceTimer: null,
                    performSearch() {
                        clearTimeout(this.debounceTimer);
                        this.debounceTimer = setTimeout(() => {
                            if (this.search.length >= 2 || this.search.length === 0) {
                                window.location.href = '{{ route('friends.index') }}' + (this.search ? '?search=' + encodeURIComponent(this.search) : '');
                            }
                        }, 500);
                    }
                }">
                    <div class="relative mb-4">
                        <input 
                            type="text" 
                            x-model="search"
                            @input="performSearch()"
                            placeholder="Search users by name or username..." 
                            class="w-full bg-cyber-bg border-2 border-cyber-secondary/50 text-cyber-text rounded-lg pl-10 pr-4 py-2.5 focus:ring-2 focus:ring-cyber-primary focus:border-cyber-primary transition placeholder-gray-500"
                        >
                        <svg class="absolute left-3 top-3 h-5 w-5 text-cyber-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                @if(request()->has('search') && count($users) > 0)
                    <div class="space-y-3">
                        @foreach($users as $u)
                            @php
                                $isAlreadyFriend = in_array($u->id, $existingFriendIds);
                                $isPending = in_array($u->id, $pendingRequestIds);
                            @endphp
                            <div class="bg-cyber-bg rounded-lg border border-cyber-secondary/20 p-4 hover:border-cyber-primary/50 transition">
                                <div class="flex items-center justify-between gap-4">
                                    <div class="flex items-center gap-3 flex-1 min-w-0">
                                        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-cyber-primary to-cyber-secondary flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                                            {{ substr($u->name, 0, 1) }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-cyber-text font-semibold truncate">{{ $u->name }}</h4>
                                            <p class="text-gray-500 text-sm">@ {{ $u->username }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex-shrink-0">
                                        @if($isAlreadyFriend)
                                            <span class="px-4 py-2 bg-green-500/20 border border-green-500/50 text-green-400 rounded-lg font-medium text-sm">
                                                Friends
                                            </span>
                                        @elseif($isPending)
                                            <span class="px-4 py-2 bg-yellow-500/20 border border-yellow-500/50 text-yellow-400 rounded-lg font-medium text-sm">
                                                Pending
                                            </span>
                                        @else
                                            <form action="{{ route('friends.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="friend_id" value="{{ $u->id }}">
                                                <button type="submit" class="px-4 py-2 bg-cyber-primary/20 border border-cyber-primary/50 text-cyber-primary hover:bg-cyber-primary hover:text-white rounded-lg font-medium transition text-sm">
                                                    Add Friend
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @elseif(request()->has('search'))
                    <p class="text-gray-500 text-center py-8">No users found matching "{{ request('search') }}"</p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
