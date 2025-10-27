<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <title>Yarnly - Home</title>
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100">
        <x-navbar />

        <!-- Hero -->
        <section class="py-16 sm:py-24">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="max-w-2xl">
                    <h1 class="text-4xl font-semibold tracking-tight sm:text-5xl">Welcome to Yarnly</h1>
                    <p class="mt-4 text-zinc-600 dark:text-zinc-300">Your main page is public. Log in only when you want to access your dashboard and other member features.</p>
                    <div class="mt-8 flex items-center gap-4">
                        <a href="#features" class="px-5 py-2 rounded-md bg-zinc-900 text-white dark:bg-white dark:text-black text-sm">Explore features</a>
                        @guest
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="px-5 py-2 rounded-md border border-zinc-300 text-sm text-zinc-800 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-200 dark:hover:bg-zinc-800">Log in</a>
                            @endif
                        @else
                            <a href="{{ route('dashboard') }}" class="px-5 py-2 rounded-md border border-zinc-300 text-sm text-zinc-800 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-200 dark:hover:bg-zinc-800">Go to Dashboard</a>
                        @endguest
                    </div>
                </div>
            </div>
        </section>

        <!-- Features placeholder -->
        <section id="features" class="py-12 border-t border-zinc-200 dark:border-zinc-800">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <h2 class="text-2xl font-semibold">Features</h2>
                <p class="mt-2 text-zinc-600 dark:text-zinc-300">Describe your product features here.</p>
            </div>
        </section>

        @fluxScripts
    </body>
</html>