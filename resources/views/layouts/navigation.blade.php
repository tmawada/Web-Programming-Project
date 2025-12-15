<nav x-data="{ open: false }" class="bg-gradient-to-r from-cyber-bg via-cyber-alt to-cyber-bg border-b-2 border-cyber-primary/30 shadow-[0_4px_20px_rgba(217,70,239,0.15)]">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Left Section: Navigation Links -->
            <div class="hidden sm:flex items-center space-x-6">
                <x-nav-link :href="route('games.index')" :active="request()->routeIs('games.index')" class="text-sm font-semibold uppercase tracking-wider">
                    {{ __('Store') }}
                </x-nav-link>
                @auth
                    <x-nav-link :href="route('library.index')" :active="request()->routeIs('library.*')" class="text-sm font-semibold uppercase tracking-wider">
                        {{ __('Library') }}
                    </x-nav-link>
                    <x-nav-link :href="route('friends.index')" :active="request()->routeIs('friends.*')" class="text-sm font-semibold uppercase tracking-wider">
                        {{ __('Friends') }}
                    </x-nav-link>
                @endauth
            </div>

            <!-- Center: Logo -->
            <div class="absolute left-1/2 transform -translate-x-1/2 hidden sm:block">
                <a href="{{ route('games.index') }}" class="group">
                    <div class="relative">
                        <h1 class="text-3xl font-black bg-clip-text text-transparent bg-gradient-to-r from-cyber-primary via-cyber-secondary to-cyber-primary tracking-[0.2em] group-hover:tracking-[0.25em] transition-all duration-300" style="font-family: 'Courier New', monospace;">
                            ARCHEX
                        </h1>
                        <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-gradient-to-r from-transparent via-cyber-primary to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                </a>
            </div>

            <!-- Mobile Logo -->
            <div class="sm:hidden">
                <a href="{{ route('games.index') }}">
                    <h1 class="text-2xl font-black bg-clip-text text-transparent bg-gradient-to-r from-cyber-primary to-cyber-secondary tracking-wider" style="font-family: 'Courier New', monospace;">
                        ARCHEX
                    </h1>
                </a>
            </div>

            <!-- Right Section: Cart & User -->
            <div class="flex items-center space-x-4">
                <!-- Cart Icon -->
                <a href="{{ route('cart.index') }}" class="relative group">
                    <div class="p-2 rounded-lg bg-cyber-bg/50 border border-cyber-secondary/30 hover:border-cyber-primary/50 hover:bg-cyber-primary/10 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyber-text group-hover:text-cyber-primary transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        @php
                            $cartCount = 0;
                            if(auth()->check()){
                                $cart = \App\Models\Cart::where('user_id', auth()->id())->first();
                                if($cart) $cartCount = $cart->items->count();
                            } else {
                                $cart = \App\Models\Cart::where('session_id', session()->getId())->first();
                                if($cart) $cartCount = $cart->items->count();
                            }
                        @endphp
                        @if($cartCount > 0)
                            <span class="absolute -top-1 -right-1 bg-gradient-to-r from-cyber-primary to-cyber-secondary text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center border-2 border-cyber-bg">{{ $cartCount }}</span>
                        @endif
                    </div>
                </a>

                @auth
                    <!-- User Dropdown -->
                    <div class="hidden sm:block">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-4 py-2 border-2 border-cyber-secondary/30 rounded-lg text-sm font-semibold text-cyber-text bg-cyber-bg/50 hover:border-cyber-primary/50 hover:bg-cyber-primary/10 focus:outline-none transition-all">
                                    <div class="flex items-center gap-2">
                                        <div class="h-8 w-8 rounded-full bg-gradient-to-br from-cyber-primary to-cyber-secondary flex items-center justify-center text-white font-bold">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </div>
                                        <span>{{ Auth::user()->username }}</span>
                                    </div>
                                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                @if(auth()->user()->is_admin)
                                    <x-dropdown-link :href="route('admin.games.index')">
                                        {{ __('Admin Panel') }}
                                    </x-dropdown-link>
                                @endif

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <div class="hidden sm:flex items-center gap-2">
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-semibold text-cyber-text hover:text-cyber-primary transition">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-semibold bg-gradient-to-r from-cyber-primary to-cyber-secondary text-white rounded-lg hover:from-pink-500 hover:to-purple-600 transition">
                            Register
                        </a>
                    </div>
                @endauth

                <!-- Hamburger -->
                <div class="flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-cyber-text hover:text-cyber-primary hover:bg-cyber-bg/50 focus:outline-none transition">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-cyber-alt border-t border-cyber-secondary/30">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('games.index')" :active="request()->routeIs('games.index')">
                {{ __('Store') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">
                {{ __('Cart') }}
            </x-responsive-nav-link>
            @auth
                <x-responsive-nav-link :href="route('library.index')" :active="request()->routeIs('library.*')">
                    {{ __('Library') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('friends.index')" :active="request()->routeIs('friends.*')">
                    {{ __('Friends') }}
                </x-responsive-nav-link>
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-cyber-secondary/30">
                <div class="px-4 flex items-center gap-3 mb-3">
                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-cyber-primary to-cyber-secondary flex items-center justify-center text-white font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="font-medium text-base text-cyber-text">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">@{{ Auth::user()->username }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    @if(auth()->user()->is_admin)
                        <x-responsive-nav-link :href="route('admin.games.index')">
                            {{ __('Admin Panel') }}
                        </x-responsive-nav-link>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-3 border-t border-cyber-secondary/30 px-4 space-y-2">
                <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 text-sm font-semibold text-cyber-text border border-cyber-secondary/30 rounded-lg hover:border-cyber-primary/50 transition">
                    Login
                </a>
                <a href="{{ route('register') }}" class="block w-full text-center px-4 py-2 text-sm font-semibold bg-gradient-to-r from-cyber-primary to-cyber-secondary text-white rounded-lg hover:from-pink-500 hover:to-purple-600 transition">
                    Register
                </a>
            </div>
        @endauth
    </div>
</nav>
