<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-cyber-alt overflow-hidden shadow-[0_0_30px_rgba(217,70,239,0.15)] sm:rounded-lg border border-cyber-secondary/30">
                
                <!-- Hero Section -->
                <div class="relative h-96 w-full">
                    <img src="{{ $game->cover_image }}" alt="{{ $game->title }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-cyber-alt via-cyber-alt/50 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-8">
                        <span class="bg-cyber-primary text-white text-sm font-bold px-3 py-1 rounded mb-2 inline-block">{{ $game->genre }}</span>
                        <h1 class="text-5xl font-extrabold text-white tracking-tight drop-shadow-lg mb-2">{{ $game->title }}</h1>
                        <p class="text-xl text-gray-300">{{ $game->developer }} / {{ $game->publisher }}</p>
                    </div>
                </div>

                <div class="p-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Main Content -->
                    <div class="lg:col-span-2">
                        <h3 class="text-2xl font-bold text-cyber-primary mb-4 border-b border-cyber-secondary/30 pb-2">Description</h3>
                        <div class="prose prose-invert max-w-none text-gray-300">
                            {{ $game->description }}
                        </div>

                        <div class="mt-8 grid grid-cols-2 gap-4 text-sm text-gray-400">
                            <div>
                                <span class="block text-cyber-secondary">Release Date</span>
                                <span class="text-white">{{ $game->release_date }}</span>
                            </div>
                            <div>
                                <span class="block text-cyber-secondary">Platform</span>
                                <span class="text-white">{{ $game->platform }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Actions -->
                    <div class="bg-cyber-bg p-6 rounded-xl border border-cyber-secondary/30 h-fit">
                        <div class="text-4xl font-bold text-white mb-6">${{ $game->price }}</div>
                        
                        <form action="{{ route('cart.add', $game) }}" method="POST" class="mb-4">
                            @csrf
                            <button type="submit" class="w-full bg-gradient-to-r from-cyber-primary to-cyber-secondary hover:from-pink-500 hover:to-purple-600 text-white font-bold py-4 px-6 rounded-lg shadow-lg transform transition hover:scale-105">
                                Add to Cart
                            </button>
                        </form>
                        
                        <p class="text-xs text-gray-500 text-center mb-6">Instant Digital Download. Secure Checkout.</p>
                        
                        <a href="{{ route('forum.index', $game->id) }}" class="block w-full text-center border-2 border-cyber-secondary text-cyber-secondary hover:bg-cyber-secondary hover:text-white font-bold py-3 px-6 rounded-lg transition">
                            Community Forum
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
