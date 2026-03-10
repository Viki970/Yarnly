<section class="space-y-6" x-data="{ confirmingDeletion: false }">
    <header>
        <h2 class="text-lg font-medium text-red-400">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-zinc-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button type="button" @click="confirmingDeletion = true"
            class="px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-500 text-white text-sm font-semibold transition-colors">
        {{ __('Delete Account') }}
    </button>

    {{-- Confirmation modal --}}
    <div x-show="confirmingDeletion"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm"
         style="display: none;">
        <div @click.outside="confirmingDeletion = false"
             class="w-full max-w-md bg-zinc-900 border border-zinc-700 rounded-2xl shadow-2xl p-6 space-y-4">

            <h2 class="text-lg font-bold text-white">{{ __('Are you sure you want to delete your account?') }}</h2>
            <p class="text-sm text-zinc-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm.') }}
            </p>

            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4 mt-2">
                @csrf
                @method('delete')

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1.5">{{ __('Password') }}</label>
                    <input type="password" name="password" placeholder="{{ __('Password') }}"
                           class="w-full bg-zinc-800 border border-zinc-600 rounded-xl px-4 py-2.5 text-sm text-white placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition">
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                </div>

                <div class="flex justify-end gap-3 pt-1">
                    <button type="button" @click="confirmingDeletion = false"
                            class="px-5 py-2.5 rounded-xl bg-zinc-700 hover:bg-zinc-600 text-white text-sm font-semibold transition-colors">
                        {{ __('Cancel') }}
                    </button>
                    <button type="submit"
                            class="px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-500 text-white text-sm font-semibold transition-colors">
                        {{ __('Delete Account') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

