<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyber-primary leading-tight uppercase tracking-wider">
            {{ __('Your Games') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-500/10 border border-green-500 text-green-400 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-cyber-alt overflow-hidden shadow-xl sm:rounded-lg border border-cyber-secondary/30 p-6">
                @if($purchasedGames->isEmpty())
                    <div class="text-center py-16">
                        <svg class="mx-auto h-24 w-24 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        <p class="text-gray-400 text-xl mb-6">You haven't purchased any games yet.</p>
                        <a href="{{ route('games.index') }}" class="inline-block bg-cyber-primary hover:bg-pink-600 text-white font-bold py-3 px-8 rounded-lg transition">
                            Browse Games
                        </a>
                    </div>
                @else
                    <div class="mb-6">
                        <p class="text-gray-400">You own <span class="text-cyber-primary font-bold">{{ $purchasedGames->count() }}</span> {{ Str::plural('game', $purchasedGames->count()) }}</p>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                        @foreach($purchasedGames as $userGame)
                            <a href="{{ route('games.show', $userGame->game) }}" class="group">
                                <div class="bg-cyber-bg border border-cyber-secondary/50 rounded-lg overflow-hidden shadow-[0_0_15px_rgba(139,92,246,0.1)] hover:shadow-[0_0_25px_rgba(217,70,239,0.3)] transition transform hover:-translate-y-1 flex flex-col">
                                    <div class="aspect-[3/4] overflow-hidden relative">
                                        <img src="{{ $userGame->game->cover_image }}" alt="{{ $userGame->game->title }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                                        <div class="absolute inset-0 bg-gradient-to-t from-cyber-bg via-transparent to-transparent opacity-60"></div>
                                        <span class="absolute top-2 right-2 bg-green-500/90 text-white text-xs px-2 py-1 rounded border border-green-500">Owned</span>
                                    </div>
                                    <div class="p-3">
                                        <h3 class="text-sm font-bold text-cyber-text group-hover:text-cyber-primary transition line-clamp-2 mb-1">{{ $userGame->game->title }}</h3>
                                        <p class="text-xs text-gray-500">Purchased {{ $userGame->purchased_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
