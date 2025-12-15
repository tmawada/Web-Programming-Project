<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
            <h2 class="font-semibold text-xl text-cyber-primary leading-tight uppercase tracking-wider">
                {{ __('Game Store') }}
            </h2>
            <div class="w-full md:w-96" x-data="{ 
                search: '{{ request('search') }}',
                debounceTimer: null,
                performSearch() {
                    clearTimeout(this.debounceTimer);
                    this.debounceTimer = setTimeout(() => {
                        if (this.search.length >= 2 || this.search.length === 0) {
                            window.location.href = '{{ route('games.index') }}' + (this.search ? '?search=' + encodeURIComponent(this.search) : '');
                        }
                    }, 500);
                }
            }">
                <div class="relative">
                    <input 
                        type="text" 
                        x-model="search"
                        @input="performSearch()"
                        placeholder="Search games by title, genre..." 
                        class="w-full bg-cyber-bg border-2 border-cyber-secondary/50 text-cyber-text rounded-lg pl-10 pr-4 py-2.5 focus:ring-2 focus:ring-cyber-primary focus:border-cyber-primary transition placeholder-gray-500"
                    >
                    <svg class="absolute left-3 top-3 h-5 w-5 text-cyber-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Grid: 2x4 layout (4 columns, 2 rows with 8 items per page) -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse($games as $game)
                    <div class="bg-cyber-alt border border-cyber-secondary/50 rounded-lg overflow-hidden shadow-[0_0_15px_rgba(139,92,246,0.1)] hover:shadow-[0_0_25px_rgba(217,70,239,0.3)] transition transform hover:-translate-y-1 flex flex-col">
                        <a href="{{ route('games.show', $game) }}" class="block">
                            <div class="aspect-[3/4] overflow-hidden relative group">
                                <img src="{{ $game->cover_image }}" alt="{{ $game->title }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-cyber-bg via-transparent to-transparent opacity-60"></div>
                                <span class="absolute top-2 right-2 bg-cyber-secondary/90 text-white text-xs px-2 py-1 rounded border border-cyber-secondary">{{ $game->genre }}</span>
                            </div>
                        </a>
                        <div class="p-3 flex flex-col flex-1">
                            <a href="{{ route('games.show', $game) }}">
                                <h3 class="text-sm font-bold text-cyber-text hover:text-cyber-primary transition line-clamp-2 mb-2">{{ $game->title }}</h3>
                            </a>
                            
                            <div class="mt-auto">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold text-cyber-primary">${{ $game->price }}</span>
                                    <form action="{{ route('cart.add', $game) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-transparent border border-cyber-primary text-cyber-primary hover:bg-cyber-primary hover:text-white px-2 py-1 rounded text-xs transition uppercase tracking-wide font-semibold">
                                            Add
                                        </button>
                                    </form>
                                </div>
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
