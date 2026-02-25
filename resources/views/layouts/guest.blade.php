<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <title>{{ config('app.name', 'Yarnly') }}</title>
        @stack('head')
    </head>
    <body class="min-h-screen bg-zinc-950 text-zinc-100 flex flex-col items-center justify-center">

        <div class="w-full sm:max-w-md px-6 py-8">
            <!-- Logo -->
            <div class="flex justify-center mb-8">
                <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                    <span class="text-3xl font-extrabold tracking-tight bg-gradient-to-r from-amber-400 via-rose-400 to-purple-400 bg-clip-text text-transparent group-hover:opacity-80 transition-opacity">
                        Yarnly
                    </span>
                </a>
            </div>

            <!-- Card -->
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl shadow-2xl p-8">
                {{ $slot }}
            </div>
        </div>

        @stack('scripts')
    </body>
</html>
