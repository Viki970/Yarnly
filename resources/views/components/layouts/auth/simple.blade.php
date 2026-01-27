<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-sky-50 antialiased dark:from-blue-950/40 dark:via-indigo-950/40 dark:to-sky-950/40">
        <!-- Decorative Background Elements -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -left-16 top-20 h-64 w-64 rounded-full bg-blue-400/20 blur-3xl dark:bg-blue-700/20"></div>
            <div class="absolute -right-10 bottom-20 h-72 w-72 rounded-full bg-sky-300/15 blur-3xl dark:bg-sky-600/15"></div>
            <div class="absolute left-1/2 top-10 h-48 w-48 rounded-full bg-indigo-300/10 blur-3xl dark:bg-indigo-600/10"></div>
        </div>

        <div class="relative bg-background flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-sm flex-col gap-6">
                <!-- Enhanced Logo Section -->
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-3 font-medium group" wire:navigate>
                    <span class="flex h-12 w-12 mb-2 items-center justify-center rounded-xl bg-gradient-to-br from-violet-500 via-purple-500 to-indigo-500 shadow-lg shadow-violet-500/30 transition-all duration-200 group-hover:scale-110 group-hover:shadow-violet-500/40">
                        <span class="text-xl font-bold text-white">Y</span>
                    </span>
                    <span class="text-xl font-semibold bg-gradient-to-r from-violet-600 to-indigo-600 bg-clip-text text-transparent dark:from-violet-400 dark:to-indigo-400">
                        Yarnly
                    </span>
                    <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                </a>
                
                <!-- Main Content Card -->
                <div class="bg-white/80 backdrop-blur-xl border border-white/20 rounded-2xl shadow-xl shadow-blue-500/10 p-8 dark:bg-zinc-900/80 dark:border-zinc-700/50 dark:shadow-2xl">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
