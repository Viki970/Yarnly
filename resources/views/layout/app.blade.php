<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ $htmlClass ?? 'dark' }}">
    <head>
    @include('partials.head')
    <title>@yield('title', $title ?? config('app.name', 'Yarnly'))</title>
        @stack('head')
    </head>
    <body class="{{ $bodyClass ?? 'min-h-screen bg-white text-zinc-900 dark:bg-zinc-900 dark:text-zinc-100' }}">
        <x-navbar />

        <main class="{{ $mainClass ?? '' }}">
            @yield('content')
        </main>

        @stack('scripts')
        @stack('modals')
    </body>
</html>
