@php($navbarId = uniqid('navbar-'))

<nav class="sticky top-0 z-50 border-b border-zinc-200/70 bg-white/80 shadow-sm backdrop-blur lg:border-transparent lg:bg-white/70 dark:border-zinc-800/70 dark:bg-zinc-900/80 dark:shadow-[0_1px_0_rgba(255,255,255,0.05)] dark:lg:bg-zinc-900/70">
    <div class="mx-auto flex max-w-6xl items-center gap-6 px-5 py-4 lg:px-8">
        <a href="/" class="flex items-center gap-3 text-base font-semibold tracking-tight text-zinc-900 transition hover:text-zinc-700 dark:text-zinc-100 dark:hover:text-zinc-300">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-violet-500 via-purple-500 to-indigo-500 text-sm font-bold text-white shadow-sm shadow-violet-500/30">
                YL
            </span>
            <span class="text-lg">Yarnly</span>
        </a>

        <div class="hidden flex-1 items-center justify-end gap-10 lg:flex">
            <div class="flex items-center gap-8 text-sm font-medium text-zinc-500">
                <a href="#features" class="transition hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100">Features</a>
                <a href="#pricing" class="transition hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100">Pricing</a>
                <a href="#patterns" class="transition hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100">Patterns</a>
                <a href="#community" class="transition hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100">Community</a>
            </div>

            <div class="flex items-center gap-3">
                @guest
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-md border border-zinc-200 px-4 py-2 text-sm font-medium text-zinc-700 transition hover:border-zinc-300 hover:text-zinc-900 dark:border-zinc-700 dark:text-zinc-200 dark:hover:border-zinc-500 dark:hover:text-white">Log in</a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-md bg-gradient-to-r from-violet-500 via-purple-500 to-indigo-500 px-4 py-2 text-sm font-semibold text-white shadow-sm shadow-violet-500/40 transition hover:brightness-110">Sign up</a>
                    @endif
                @else
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center rounded-md border border-zinc-200 px-4 py-2 text-sm font-medium text-zinc-700 transition hover:border-zinc-300 hover:text-zinc-900 dark:border-zinc-700 dark:text-zinc-200 dark:hover:border-zinc-500 dark:hover:text-white">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center justify-center rounded-md bg-gradient-to-r from-violet-500 via-purple-500 to-indigo-500 px-4 py-2 text-sm font-semibold text-white shadow-sm shadow-violet-500/40 transition hover:brightness-110">Log out</button>
                    </form>
                @endguest
            </div>
        </div>

        <button type="button" data-navbar-toggle data-target="{{ $navbarId }}" class="ms-auto inline-flex items-center justify-center rounded-md border border-zinc-200 p-2 text-zinc-600 transition hover:bg-zinc-100 focus:outline-none focus:ring-2 focus:ring-violet-400 focus:ring-offset-2 focus:ring-offset-white dark:border-zinc-700 dark:text-zinc-300 dark:hover:bg-zinc-800 dark:focus:ring-violet-500 dark:focus:ring-offset-zinc-900 lg:hidden" aria-expanded="false" aria-controls="{{ $navbarId }}">
            <span class="sr-only">Toggle navigation</span>
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <div id="{{ $navbarId }}" class="hidden flex-col border-t border-zinc-200/70 px-5 pb-6 pt-4 lg:hidden dark:border-zinc-800/70">
        <div class="flex flex-col gap-5">
            <div class="grid gap-4 text-sm font-medium text-zinc-600 dark:text-zinc-300">
                <a href="#features" class="rounded-md px-3 py-2 transition hover:bg-zinc-100/80 dark:hover:bg-zinc-800/80">Features</a>
                <a href="#pricing" class="rounded-md px-3 py-2 transition hover:bg-zinc-100/80 dark:hover:bg-zinc-800/80">Pricing</a>
                <a href="#patterns" class="rounded-md px-3 py-2 transition hover:bg-zinc-100/80 dark:hover:bg-zinc-800/80">Patterns</a>
                <a href="#community" class="rounded-md px-3 py-2 transition hover:bg-zinc-100/80 dark:hover:bg-zinc-800/80">Community</a>
            </div>

            <div class="grid gap-3">
                @guest
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-md border border-zinc-200 px-4 py-2 text-sm font-medium text-zinc-700 transition hover:border-zinc-300 hover:bg-zinc-100/70 hover:text-zinc-900 dark:border-zinc-700 dark:text-zinc-200 dark:hover:border-zinc-500 dark:hover:bg-zinc-800/80 dark:hover:text-white">Log in</a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-md bg-gradient-to-r from-violet-500 via-purple-500 to-indigo-500 px-4 py-2 text-sm font-semibold text-white shadow-sm shadow-violet-500/40 transition hover:brightness-110">Sign up</a>
                    @endif
                @else
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center rounded-md border border-zinc-200 px-4 py-2 text-sm font-medium text-zinc-700 transition hover:border-zinc-300 hover:bg-zinc-100/70 hover:text-zinc-900 dark:border-zinc-700 dark:text-zinc-200 dark:hover:border-zinc-500 dark:hover:bg-zinc-800/80 dark:hover:text-white">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex w-full items-center justify-center rounded-md bg-gradient-to-r from-violet-500 via-purple-500 to-indigo-500 px-4 py-2 text-sm font-semibold text-white shadow-sm shadow-violet-500/40 transition hover:brightness-110">Log out</button>
                    </form>
                @endguest
            </div>
        </div>
    </div>
</nav>

@once
    <script>
        (function () {
            if (window.__yarnlyNavbarInit) {
                return;
            }
            window.__yarnlyNavbarInit = true;
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('[data-navbar-toggle]').forEach(function (toggle) {
                    toggle.addEventListener('click', function () {
                        var targetId = toggle.getAttribute('data-target');
                        var target = document.getElementById(targetId);
                        if (!target) {
                            return;
                        }
                        var isHidden = target.classList.contains('hidden');
                        target.classList.toggle('hidden', !isHidden);
                        target.classList.toggle('flex', isHidden);
                        toggle.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
                    });
                });
            });
        })();
    </script>
@endonce
