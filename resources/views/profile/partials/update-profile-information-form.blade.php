<section>
    <header>
        <h2 class="text-xl font-bold text-cyber-primary uppercase tracking-wider">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-2 text-sm text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-sm font-semibold text-cyber-text mb-2">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" 
                class="w-full bg-cyber-bg border-2 border-cyber-secondary/50 text-cyber-text rounded-lg px-4 py-3 focus:ring-2 focus:ring-cyber-primary focus:border-cyber-primary transition placeholder-gray-500" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold text-cyber-text mb-2">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username" 
                class="w-full bg-cyber-bg border-2 border-cyber-secondary/50 text-cyber-text rounded-lg px-4 py-3 focus:ring-2 focus:ring-cyber-primary focus:border-cyber-primary transition placeholder-gray-500" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-3 bg-yellow-500/10 border border-yellow-500/30 rounded-lg">
                    <p class="text-sm text-yellow-400">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-yellow-300 hover:text-yellow-100 transition">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-cyber-primary to-cyber-secondary hover:from-pink-500 hover:to-purple-600 text-white font-bold rounded-lg shadow-lg transform transition hover:scale-105">
                {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-400 font-semibold"
                >{{ __('Saved!') }}</p>
            @endif
        </div>
    </form>
</section>
