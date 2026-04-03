<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <title>{{ config('app.name', 'Yarnly') }}</title>
        @stack('head')
    </head>
    <body class="min-h-screen bg-zinc-950 text-zinc-100">

        <style>
            @keyframes orb-float-a { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-28px)} }
            @keyframes orb-float-b { 0%,100%{transform:translateY(0) scale(1)} 50%{transform:translateY(-18px) scale(1.06)} }
            @keyframes auth-fade-up { from{opacity:0;transform:translateY(18px)} to{opacity:1;transform:translateY(0)} }
            .orb-a  { animation: orb-float-a 8s  ease-in-out infinite; }
            .orb-b  { animation: orb-float-b 10s ease-in-out infinite 1.5s; }
            .auth-fade { animation: auth-fade-up .55s cubic-bezier(.34,1.56,.64,1) both; }
        </style>

        <div class="flex min-h-screen">

            {{-- ═══ Left decorative panel (desktop only) ═══ --}}
            <div class="hidden lg:flex lg:w-[55%] relative overflow-hidden bg-gradient-to-br from-violet-950 via-zinc-950 to-indigo-950 flex-col items-center justify-center p-16">
                {{-- Animated orbs --}}
                <div class="pointer-events-none absolute inset-0" aria-hidden="true">
                    <div class="orb-a absolute -left-32 -top-32 h-[500px] w-[500px] rounded-full bg-violet-600/20 blur-[100px]"></div>
                    <div class="orb-b absolute -bottom-32 -right-32 h-[600px] w-[600px] rounded-full bg-indigo-600/15 blur-[120px]"></div>
                    <div class="orb-a absolute right-1/4 top-1/3  h-[250px] w-[250px] rounded-full bg-fuchsia-600/10 blur-[80px]"></div>
                    {{-- Grid overlay --}}
                    <div class="absolute inset-0 opacity-[.04]"
                         style="background-image:linear-gradient(rgba(255,255,255,1) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,1) 1px,transparent 1px);background-size:56px 56px"></div>
                </div>

                <div class="relative z-10 max-w-md text-center">
                    <a href="{{ url('/') }}" class="inline-block mb-10 group">
                        <span class="text-5xl font-black tracking-tight bg-gradient-to-r from-violet-400 via-fuchsia-400 to-pink-400 bg-clip-text text-transparent group-hover:opacity-80 transition-opacity">
                            Yarnly
                        </span>
                    </a>

                    <h2 class="text-3xl font-bold text-white leading-snug mb-4">
                        {{ __('Where Yarn') }}<br>
                        <span class="bg-gradient-to-r from-violet-400 via-fuchsia-400 to-pink-400 bg-clip-text text-transparent">{{ __('Meets Creativity') }}</span>
                    </h2>
                    <p class="text-zinc-400 text-base leading-relaxed mb-10">
                        {{ __('Discover thousands of crochet, knitting & embroidery patterns. Share your makes, connect with makers, and build your craft portfolio.') }}
                    </p>

                    <div class="space-y-3 text-left">
                        @foreach([
                            __('Explore thousands of patterns'),
                            __('Save your favourites & build collections'),
                            __('Share your makes with the community'),
                            __('Follow creators & get inspired'),
                        ] as $feat)
                        <div class="flex items-center gap-3 rounded-xl bg-white/5 px-4 py-3 ring-1 ring-white/10 backdrop-blur-sm">
                            <span class="h-1.5 w-1.5 flex-shrink-0 rounded-full bg-violet-400"></span>
                            <span class="text-sm text-zinc-300">{{ $feat }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- ═══ Right form panel ═══ --}}
            <div class="flex w-full lg:w-[45%] flex-col items-center justify-center bg-zinc-950 px-6 py-12">
                {{-- Mobile logo --}}
                <a href="{{ url('/') }}" class="lg:hidden mb-8 text-3xl font-black tracking-tight bg-gradient-to-r from-violet-400 via-fuchsia-400 to-pink-400 bg-clip-text text-transparent">
                    Yarnly
                </a>

                <div class="auth-fade w-full max-w-sm">
                    {{ $slot }}
                </div>
            </div>
        </div>

        @stack('scripts')
    </body>
</html>
