<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyber-primary leading-tight uppercase tracking-wider">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Order Summary -->
                <div class="bg-cyber-alt overflow-hidden shadow-xl sm:rounded-lg border border-cyber-secondary/30 p-6">
                    <h3 class="text-lg font-bold text-white mb-4">Order Summary</h3>
                    <div class="space-y-4">
                        @foreach($cart->items as $item)
                        <div class="flex justify-between items-center text-gray-300">
                            <div class="flex items-center gap-3">
                                <img src="{{ $item->game->cover_image }}" class="w-10 h-10 object-cover rounded" alt="">
                                <span>{{ $item->game->title }} <span class="text-xs text-gray-500">x{{ $item->quantity }}</span></span>
                            </div>
                            <span>${{ $item->game->price * $item->quantity }}</span>
                        </div>
                        @endforeach
                        <div class="border-t border-gray-700 pt-4 mt-4 text-xl font-bold text-white flex justify-between">
                            <span>Total</span>
                            <span class="text-cyber-primary">${{ $cart->items->sum(fn($i) => $i->game->price * $i->quantity) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Payment Mockup -->
                <div class="bg-cyber-alt overflow-hidden shadow-xl sm:rounded-lg border border-cyber-secondary/30 p-6">
                    <h3 class="text-lg font-bold text-white mb-4">Payment Details</h3>
                    
                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-400 text-sm font-bold mb-2">Cardholder Name</label>
                            <input type="text" class="w-full bg-cyber-bg border border-cyber-secondary/50 text-white rounded p-2 focus:ring-cyber-primary focus:border-cyber-primary" placeholder="John Doe" required>
                        </div>
                         <div class="mb-4">
                            <label class="block text-gray-400 text-sm font-bold mb-2">Card Number</label>
                            <input type="text" class="w-full bg-cyber-bg border border-cyber-secondary/50 text-white rounded p-2 focus:ring-cyber-primary focus:border-cyber-primary" placeholder="0000 0000 0000 0000" required>
                        </div>
                        <div class="grid grid-cols-2 gap-4 mb-6">
                             <div>
                                <label class="block text-gray-400 text-sm font-bold mb-2">Expiry</label>
                                <input type="text" class="w-full bg-cyber-bg border border-cyber-secondary/50 text-white rounded p-2" placeholder="MM/YY" required>
                            </div>
                             <div>
                                <label class="block text-gray-400 text-sm font-bold mb-2">CVC</label>
                                <input type="text" class="w-full bg-cyber-bg border border-cyber-secondary/50 text-white rounded p-2" placeholder="123" required>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-cyber-primary hover:bg-pink-600 text-white font-bold py-3 rounded shadow-lg transition">
                            Pay Now
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
