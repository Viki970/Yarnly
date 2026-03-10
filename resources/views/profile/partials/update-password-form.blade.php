<section>
    <header>
        <h2 class="text-lg font-medium text-white">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-zinc-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('put')

        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1.5">{{ __('Current Password') }}</label>
            <input type="password" name="current_password" id="update_password_current_password" autocomplete="current-password"
                   class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1.5">{{ __('New Password') }}</label>
            <input type="password" name="password" id="update_password_password" autocomplete="new-password"
                   class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1.5">{{ __('Confirm Password') }}</label>
            <input type="password" name="password_confirmation" id="update_password_password_confirmation" autocomplete="new-password"
                   class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="px-8 py-2.5 rounded-xl bg-violet-600 hover:bg-violet-500 text-white text-sm font-semibold transition-colors">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <span
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-400"
                >{{ __('Saved.') }}</span>
            @endif
        </div>
    </form>
</section>
