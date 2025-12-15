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

            <div class="bg-cyber-alt overflow-hidden shadow-xl sm:rounded-lg border border-cyber-secondary/30">
                <div class="p-6">
                    @if(!$cart || $cart->items->isEmpty())
                        <div class="text-center py-10">
                            <p class="text-gray-400 text-xl mb-6">Your cart is empty.</p>
                            <a href="{{ route('games.index') }}" class="text-cyber-primary hover:text-white underline">Browse Games</a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-gray-400">
                                <thead class="text-xs text-cyber-secondary uppercase bg-cyber-bg">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Game</th>
                                        <th scope="col" class="px-6 py-3">Price</th>
                                        <th scope="col" class="px-6 py-3">Quantity</th>
                                        <th scope="col" class="px-6 py-3">Total</th>
                                        <th scope="col" class="px-6 py-3 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart->items as $item)
                                        <tr class="bg-cyber-alt border-b border-cyber-secondary/10 hover:bg-cyber-bg/50 transition">
                                            <td class="px-6 py-4 font-medium text-white flex items-center gap-4">
                                                <img src="{{ $item->game->cover_image }}" class="w-12 h-12 object-cover rounded" alt="">
                                                {{ $item->game->title }}
                                            </td>
                                            <td class="px-6 py-4">${{ $item->game->price }}</td>
                                            <td class="px-6 py-4">
                                                {{ $item->quantity }}
                                            </td>
                                            <td class="px-6 py-4 text-cyber-primary font-bold">
                                                ${{ $item->game->price * $item->quantity }}
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <form action="{{ route('cart.remove', $item) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-400 font-medium">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-8 flex justify-between items-center bg-cyber-bg p-6 rounded-lg">
                            <div class="text-gray-400">
                                <a href="{{ route('games.index') }}" class="hover:text-white transition">← Continue Shopping</a>
                            </div>
                            <div class="text-right">
                                <p class="text-lg text-gray-400 mb-1">Subtotal:</p>
                                <p class="text-3xl font-bold text-white mb-4">${{ $cart->items->sum(fn($i) => $i->game->price * $i->quantity) }}</p>
                                <a href="{{ route('checkout.index') }}" class="inline-block bg-cyber-primary hover:bg-pink-600 text-white font-bold py-3 px-8 rounded shadow-lg transform transition hover:-translate-y-1">
                                    Proceed to Checkout
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
