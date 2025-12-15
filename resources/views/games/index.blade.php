<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-cyber-primary leading-tight uppercase tracking-wider">
                {{ __('Game Store') }}
            </h2>
            <form method="GET" action="{{ route('games.index') }}" class="flex">
                <input type="text" name="search" placeholder="Search games..." value="{{ request('search') }}" 
                    class="bg-cyber-bg border border-cyber-secondary text-cyber-text rounded-l-md focus:ring-cyber-primary focus:border-cyber-primary">
                <button type="submit" class="bg-cyber-secondary text-white px-4 py-2 rounded-r-md hover:bg-cyber-primary transition">
                    Search
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($games as $game)
                    <div class="bg-cyber-alt border border-cyber-secondary/50 rounded-lg overflow-hidden shadow-[0_0_15px_rgba(139,92,246,0.1)] hover:shadow-[0_0_25px_rgba(217,70,239,0.3)] transition transform hover:-translate-y-1">
                        <a href="{{ route('games.show', $game) }}">
                            <div class="h-48 overflow-hidden relative group">
                                <img src="{{ $game->cover_image }}" alt="{{ $game->title }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t from-cyber-bg to-transparent opacity-60"></div>
                            </div>
                        </a>
                        <div class="p-4">
                            <div class="flex justify-between items-start mb-2">
                                <a href="{{ route('games.show', $game) }}">
                                    <h3 class="text-lg font-bold text-cyber-text hover:text-cyber-primary truncate transition">{{ $game->title }}</h3>
                                </a>
                                <span class="bg-cyber-secondary/20 text-cyber-secondary text-xs px-2 py-1 rounded border border-cyber-secondary/50">{{ $game->genre }}</span>
                            </div>
                            
                            <p class="text-gray-400 text-sm mb-4 line-clamp-2 h-10">{{ $game->description }}</p>
                            
                            <div class="flex justify-between items-center mt-auto">
                                <span class="text-xl font-bold text-cyber-primary">${{ $game->price }}</span>
                                <form action="{{ route('cart.add', $game) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-transparent border border-cyber-primary text-cyber-primary hover:bg-cyber-primary hover:text-white px-3 py-1 rounded text-sm transition uppercase tracking-wide font-semibold">
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-xl text-gray-500">No games found.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $games->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
