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
                    <h3 class="text-lg font-medium text-cyber-text mb-4">Friend Requests</h3>
                    <ul class="space-y-4">
                        @foreach($requests as $req)
                            <li class="flex justify-between items-center bg-cyber-bg p-3 rounded border border-cyber-secondary/20">
                                <span class="text-gray-300">{{ $req->user->name }}</span>
                                <div class="flex space-x-2">
                                    <form action="{{ route('friends.update', $req->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-green-400 hover:text-green-300 text-sm">Accept</button>
                                    </form>
                                    <form action="{{ route('friends.destroy', $req->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300 text-sm">Decline</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- My Friends -->
            <div class="bg-cyber-alt shadow sm:rounded-lg border border-cyber-secondary/30 p-6">
                <h3 class="text-lg font-medium text-cyber-text mb-4">My Friends</h3>
                @if($friends->count() > 0)
                    <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($friends as $friend)
                            <li class="bg-cyber-bg p-4 rounded border border-cyber-secondary/20 flex justify-between items-center">
                                <div class="flex items-center space-x-3">
                                    <div class="h-10 w-10 rounded-full bg-cyber-secondary/20 flex items-center justify-center text-cyber-primary font-bold">
                                        {{ substr($friend->name, 0, 1) }}
                                    </div>
                                    <span class="text-gray-200 font-medium">{{ $friend->name }}</span>
                                </div>
                                <a href="{{ route('chat.show', $friend->id) }}" class="bg-cyber-secondary/20 text-cyber-secondary hover:bg-cyber-secondary hover:text-white px-3 py-1 rounded text-xs transition">
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
                <form method="GET" action="{{ route('friends.index') }}" class="mb-4 flex">
                    <input type="text" name="search" placeholder="Search users..." value="{{ request('search') }}" 
                        class="flex-1 bg-cyber-bg border border-cyber-secondary text-cyber-text rounded-l-md focus:ring-cyber-primary focus:border-cyber-primary">
                    <button type="submit" class="bg-cyber-primary text-white px-4 py-2 rounded-r-md hover:bg-cyber-secondary transition">
                        Search
                    </button>
                </form>

                @if(request()->has('search') && count($users) > 0)
                    <ul class="space-y-2">
                        @foreach($users as $user)
                            <li class="flex justify-between items-center bg-cyber-bg p-3 rounded border border-cyber-secondary/20">
                                <span class="text-gray-300">{{ $user->name }}</span>
                                <form action="{{ route('friends.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="friend_id" value="{{ $user->id }}">
                                    <button type="submit" class="text-cyber-primary hover:text-cyber-secondary text-sm font-medium">Add Friend</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @elseif(request()->has('search'))
                    <p class="text-gray-500">No users found.</p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
