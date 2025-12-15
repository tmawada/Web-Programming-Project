<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyber-primary leading-tight uppercase tracking-wider">
            {{ __('Your Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             @if (session('success'))
                <div class="mb-4 bg-green-500/10 border border-green-500 text-green-400 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('info'))
                <div class="mb-4 bg-blue-500/10 border border-blue-500 text-blue-400 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('info') }}</span>
                </div>
            @endif

            <div class="bg-cyber-alt overflow-hidden shadow-xl sm:rounded-lg border border-cyber-secondary/30">
                <div class="p-6">
                    @if(!$cart || $cart->items->isEmpty())
                        <div class="text-center py-16">
                            <svg class="mx-auto h-24 w-24 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <p class="text-gray-400 text-xl mb-6">Your cart is empty.</p>
                            <a href="{{ route('games.index') }}" class="inline-block bg-cyber-primary hover:bg-pink-600 text-white font-bold py-3 px-8 rounded-lg transition">
                                Browse Games
                            </a>
                        </div>
                    @else
                        <div x-data="{
                            selectedGames: [],
                            selectAll: false,
                            toggleAll() {
                                const checkboxes = document.querySelectorAll('input[name=\'game_ids[]\']');
                                if (this.selectAll) {
                                    this.selectedGames = Array.from(checkboxes).map(cb => parseInt(cb.value));
                                } else {
                                    this.selectedGames = [];
                                }
                            },
                            get totalPrice() {
                                let total = 0;
                                this.selectedGames.forEach(gameId => {
                                    const priceElement = document.querySelector(`[data-game-id='${gameId}']`);
                                    if (priceElement) {
                                        total += parseFloat(priceElement.dataset.price);
                                    }
                                });
                                return total.toFixed(2);
                            },
                            get selectedCount() {
                                return this.selectedGames.length;
                            }
                        }">
                            <!-- Select All -->
                            <div class="mb-4 flex items-center gap-2 p-3 bg-cyber-bg rounded-lg border border-cyber-secondary/20">
                                <input 
                                    type="checkbox" 
                                    x-model="selectAll"
                                    @change="toggleAll()"
                                    class="w-5 h-5 rounded border-cyber-secondary bg-cyber-bg text-cyber-primary focus:ring-cyber-primary focus:ring-2"
                                >
                                <label class="text-cyber-text font-medium cursor-pointer" @click="selectAll = !selectAll; toggleAll()">
                                    Select All
                                </label>
                            </div>

                            <!-- Cart Items as Cards -->
                            <div class="space-y-4 mb-8">
                                @foreach($cart->items as $item)
                                    <div class="bg-cyber-bg rounded-lg border border-cyber-secondary/20 p-4 hover:border-cyber-primary/50 transition" data-game-id="{{ $item->game->id }}" data-price="{{ $item->game->price }}">
                                        <div class="flex items-center gap-4">
                                            <!-- Checkbox -->
                                            <input 
                                                type="checkbox" 
                                                name="game_ids[]"
                                                value="{{ $item->game->id }}"
                                                x-model="selectedGames"
                                                class="w-5 h-5 rounded border-cyber-secondary bg-cyber-bg text-cyber-primary focus:ring-cyber-primary focus:ring-2 flex-shrink-0"
                                            >
                                            
                                            <!-- Game Cover -->
                                            <a href="{{ route('games.show', $item->game) }}" class="flex-shrink-0">
                                                <img src="{{ $item->game->cover_image }}" class="w-24 h-32 object-cover rounded-lg" alt="{{ $item->game->title }}">
                                            </a>
                                            
                                            <!-- Game Info -->
                                            <div class="flex-1 min-w-0">
                                                <a href="{{ route('games.show', $item->game) }}" class="hover:text-cyber-primary transition">
                                                    <h3 class="text-lg font-bold text-white mb-1">{{ $item->game->title }}</h3>
                                                </a>
                                                <p class="text-sm text-gray-400 mb-2">{{ $item->game->genre }} • {{ $item->game->platform }}</p>
                                                <div class="flex items-center gap-4">
                                                    <span class="text-2xl font-bold text-cyber-primary">${{ $item->game->price }}</span>
                                                </div>
                                            </div>

                                            <!-- Remove Button -->
                                            <div class="flex-shrink-0">
                                                <form action="{{ route('cart.remove', $item->game->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500/20 border border-red-500/50 text-red-400 hover:bg-red-500 hover:text-white px-4 py-2 rounded-lg font-medium transition">
                                                        Remove
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Cart Summary -->
                            <div class="border-t border-cyber-secondary/30 pt-6">
                                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                                    <a href="{{ route('games.index') }}" class="text-cyber-secondary hover:text-cyber-primary transition flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                        Continue Shopping
                                    </a>
                                    
                                    <div class="flex flex-col items-end gap-4">
                                        <div class="text-right">
                                            <p class="text-sm text-gray-400 mb-1">
                                                <span x-text="selectedCount"></span> 
                                                <span x-text="selectedCount === 1 ? 'item' : 'items'"></span> selected
                                            </p>
                                            <p class="text-4xl font-bold text-white">$<span x-text="totalPrice"></span></p>
                                        </div>
                                        <form action="{{ route('checkout.index') }}" method="GET">
                                            <input type="hidden" name="selected" x-bind:value="selectedGames.join(',')">
                                            <button 
                                                type="submit"
                                                x-bind:disabled="selectedCount === 0"
                                                x-bind:class="selectedCount === 0 ? 'opacity-50 cursor-not-allowed' : 'hover:scale-105'"
                                                class="bg-gradient-to-r from-cyber-primary to-cyber-secondary hover:from-pink-500 hover:to-purple-600 text-white font-bold py-3 px-8 rounded-lg shadow-lg transform transition"
                                            >
                                                Proceed to Checkout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
