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
                    <div class="lg:col-span-2 space-y-6">
                        <h3 class="text-2xl font-bold text-cyber-primary mb-4 border-b border-cyber-secondary/30 pb-2">Description</h3>
                        <div class="prose prose-invert max-w-none text-gray-300 leading-relaxed">
                            {{ $game->description }}
                        </div>

                        <!-- Game Details Grid -->
                        <div class="mt-8 grid grid-cols-2 md:grid-cols-3 gap-4">
                            <div class="bg-cyber-bg p-4 rounded-lg border border-cyber-secondary/20">
                                <span class="block text-cyber-secondary text-sm mb-1">Release Date</span>
                                <span class="text-white font-semibold">{{ $game->release_date }}</span>
                            </div>
                            <div class="bg-cyber-bg p-4 rounded-lg border border-cyber-secondary/20">
                                <span class="block text-cyber-secondary text-sm mb-1">Platform</span>
                                <span class="text-white font-semibold">{{ $game->platform }}</span>
                            </div>
                            <div class="bg-cyber-bg p-4 rounded-lg border border-cyber-secondary/20">
                                <span class="block text-cyber-secondary text-sm mb-1">Publisher</span>
                                <span class="text-white font-semibold">{{ $game->publisher }}</span>
                            </div>
                            <div class="bg-cyber-bg p-4 rounded-lg border border-cyber-secondary/20">
                                <span class="block text-cyber-secondary text-sm mb-1">Genre</span>
                                <span class="text-white font-semibold">{{ $game->genre }}</span>
                            </div>
                            <div class="bg-cyber-bg p-4 rounded-lg border border-cyber-secondary/20">
                                <span class="block text-cyber-secondary text-sm mb-1">Price</span>
                                <span class="text-cyber-primary font-bold text-xl">${{ $game->price }}</span>
                            </div>
                            <div class="bg-cyber-bg p-4 rounded-lg border border-cyber-secondary/20">
                                <span class="block text-cyber-secondary text-sm mb-1">Rating</span>
                                <span class="text-yellow-400 font-semibold">★★★★☆ 4.5</span>
                            </div>
                        </div>

                        <!-- Features Section -->
                        <div class="mt-6">
                            <h4 class="text-xl font-bold text-cyber-text mb-3">Key Features</h4>
                            <ul class="space-y-2 text-gray-300">
                                <li class="flex items-start">
                                    <span class="text-cyber-primary mr-2">▸</span>
                                    <span>Immersive gameplay with stunning graphics</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-cyber-primary mr-2">▸</span>
                                    <span>Engaging storyline and character development</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-cyber-primary mr-2">▸</span>
                                    <span>Multiplayer and co-op modes available</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-cyber-primary mr-2">▸</span>
                                    <span>Regular updates and DLC content</span>
                                </li>
                            </ul>
                        </div>

                        <!-- System Requirements -->
                        <div class="mt-6 bg-cyber-bg p-5 rounded-lg border border-cyber-secondary/20">
                            <h4 class="text-xl font-bold text-cyber-text mb-3">System Requirements</h4>
                            <div class="grid md:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <p class="text-cyber-secondary font-semibold mb-2">Minimum:</p>
                                    <ul class="text-gray-400 space-y-1">
                                        <li>OS: Windows 10 64-bit</li>
                                        <li>Processor: Intel Core i5-3570K</li>
                                        <li>Memory: 8 GB RAM</li>
                                        <li>Graphics: NVIDIA GTX 780</li>
                                        <li>Storage: 50 GB available space</li>
                                    </ul>
                                </div>
                                <div>
                                    <p class="text-cyber-secondary font-semibold mb-2">Recommended:</p>
                                    <ul class="text-gray-400 space-y-1">
                                        <li>OS: Windows 11 64-bit</li>
                                        <li>Processor: Intel Core i7-8700K</li>
                                        <li>Memory: 16 GB RAM</li>
                                        <li>Graphics: NVIDIA RTX 3070</li>
                                        <li>Storage: 50 GB SSD</li>
                                    </ul>
                                </div>
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
