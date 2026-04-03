{{-- Reusable guest login prompt modal.
     Include in any page that calls openLoginModal().
     The gallery page has its own inline version; use this for all other pages. --}}
<div id="login-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeLoginModal()"></div>
    <div class="relative w-full max-w-sm mx-4 rounded-2xl bg-white p-6 sm:p-8 shadow-2xl dark:bg-zinc-900">
        <div class="text-center">
            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-violet-100 dark:bg-violet-900/40">
                <svg class="h-7 w-7 text-violet-600 dark:text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-zinc-900 dark:text-white">{{ __('Sign in required') }}</h3>
            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">{{ __('Create an account or sign in to access this feature.') }}</p>
            <div class="mt-6 flex flex-col gap-3">
                <a href="{{ route('login') }}"
                   class="rounded-xl bg-gradient-to-r from-violet-600 to-fuchsia-600 py-2.5 text-sm font-semibold text-white shadow hover:from-violet-500 hover:to-fuchsia-500 transition-all">
                    {{ __('Sign in') }}
                </a>
                <a href="{{ route('register') }}"
                   class="rounded-xl border border-zinc-200 py-2.5 text-sm font-semibold text-zinc-700 hover:bg-zinc-50 transition-all dark:border-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-800">
                    {{ __('Create account') }}
                </a>
            </div>
        </div>
        <button onclick="closeLoginModal()" class="absolute right-4 top-4 text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>
<script>
function openLoginModal()  { document.getElementById('login-modal').classList.remove('hidden'); }
function closeLoginModal() { document.getElementById('login-modal').classList.add('hidden'); }
</script>
