<section>
    <header>
        <h2 class="text-xl font-bold text-cyber-primary uppercase tracking-wider">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-2 text-sm text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-semibold text-cyber-text mb-2">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password" 
                class="w-full bg-cyber-bg border-2 border-cyber-secondary/50 text-cyber-text rounded-lg px-4 py-3 focus:ring-2 focus:ring-cyber-primary focus:border-cyber-primary transition placeholder-gray-500" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-semibold text-cyber-text mb-2">{{ __('New Password') }}</label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password" 
                class="w-full bg-cyber-bg border-2 border-cyber-secondary/50 text-cyber-text rounded-lg px-4 py-3 focus:ring-2 focus:ring-cyber-primary focus:border-cyber-primary transition placeholder-gray-500" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-semibold text-cyber-text mb-2">{{ __('Confirm Password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" 
                class="w-full bg-cyber-bg border-2 border-cyber-secondary/50 text-cyber-text rounded-lg px-4 py-3 focus:ring-2 focus:ring-cyber-primary focus:border-cyber-primary transition placeholder-gray-500" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-cyber-primary to-cyber-secondary hover:from-pink-500 hover:to-purple-600 text-white font-bold rounded-lg shadow-lg transform transition hover:scale-105">
                {{ __('Update Password') }}
            </button>

            @if (session('status') === 'password-updated')
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
