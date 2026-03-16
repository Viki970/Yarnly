@extends('layout.app')

@section('title', 'Yarnly · Where Yarn Meets Creativity')

@section('content')
<style>
@keyframes orb-float-a  { 0%,100%{transform:translateY(0)}           50%{transform:translateY(-28px)} }
@keyframes orb-float-b  { 0%,100%{transform:translateY(0) scale(1)}  50%{transform:translateY(-18px) scale(1.06)} }
@keyframes orb-float-c  { 0%,100%{transform:translateY(0) rotate(0deg)} 50%{transform:translateY(-22px) rotate(8deg)} }
@keyframes fade-up      { from{opacity:0;transform:translateY(16px)}  to{opacity:1;transform:translateY(0)} }
@keyframes pulse-dot    { 0%,100%{opacity:.5;transform:scale(1)}      50%{opacity:1;transform:scale(1.5)} }
.orb-a { animation: orb-float-a  8s  ease-in-out infinite; }
.orb-b { animation: orb-float-b  10s ease-in-out infinite 1.5s; }
.orb-c { animation: orb-float-c  12s ease-in-out infinite 3s; }
.hero-fade  { animation: fade-up .75s cubic-bezier(.34,1.56,.64,1) both; }
.hero-fade2 { animation: fade-up .75s cubic-bezier(.34,1.56,.64,1) .15s both; }
.hero-fade3 { animation: fade-up .75s cubic-bezier(.34,1.56,.64,1) .3s  both; }
.pulse-dot  { animation: pulse-dot 2s ease-in-out infinite; }
.feat-card  { transition: transform .3s cubic-bezier(.4,0,.2,1), box-shadow .3s; }
.feat-card:hover { transform: translateY(-8px); }
.sr-row { transition: background .12s; }
.sr-row:hover { background: rgba(139,92,246,.1); }
</style>

{{-- ══════════════════════════════════════════════
     HERO
══════════════════════════════════════════════ --}}
<section class="relative flex min-h-screen flex-col items-center justify-center overflow-hidden bg-zinc-50 dark:bg-zinc-950 pt-16 pb-32">

    {{-- Animated blurred orbs --}}
    <div class="pointer-events-none absolute inset-0 overflow-hidden" aria-hidden="true">
        <div class="orb-a absolute -left-40 -top-40 h-[560px] w-[560px] rounded-full bg-violet-600/14 blur-[100px]"></div>
        <div class="orb-b absolute -bottom-40 -right-40 h-[640px] w-[640px] rounded-full bg-indigo-600/10 blur-[120px]"></div>
        <div class="orb-c absolute right-1/4 top-1/3   h-[300px] w-[300px] rounded-full bg-fuchsia-600/8 blur-[80px]"></div>
        {{-- Grid overlay --}}
        <div class="absolute inset-0 opacity-[.05] dark:hidden"
             style="background-image:linear-gradient(rgba(0,0,0,1) 1px,transparent 1px),linear-gradient(90deg,rgba(0,0,0,1) 1px,transparent 1px);background-size:56px 56px"></div>
        <div class="absolute inset-0 opacity-[.035] hidden dark:block"
             style="background-image:linear-gradient(rgba(255,255,255,1) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,1) 1px,transparent 1px);background-size:56px 56px"></div>
    </div>

    <div class="relative z-10 mx-auto max-w-5xl px-6 text-center">

        {{-- Badge --}}
        <div class="hero-fade mb-8 inline-flex items-center gap-2 rounded-full border border-violet-500/25 bg-violet-500/10 px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-violet-600 dark:text-violet-300">
            <span class="pulse-dot h-1.5 w-1.5 rounded-full bg-violet-400"></span>
            {{ __('The yarn·crafting community') }}
        </div>

        {{-- Headline --}}
        <h1 class="hero-fade2 text-6xl font-black tracking-tight text-zinc-900 dark:text-white sm:text-7xl lg:text-8xl leading-[1.04]">
            {{ __('Where Yarn') }}
            <span class="block bg-gradient-to-r from-violet-400 via-fuchsia-400 to-pink-400 bg-clip-text text-transparent">
                {{ __('Meets Creativity') }}
            </span>
        </h1>

        {{-- Sub-heading --}}
        <p class="hero-fade2 mx-auto mt-6 max-w-2xl text-lg leading-relaxed text-zinc-600 dark:text-zinc-400 sm:text-xl">
            {{ __('Explore thousands of patterns, share your creations, follow inspiring makers, and build your crafting portfolio — all in one place.') }}
        </p>

        {{-- CTA buttons --}}
        <div class="hero-fade3 mt-8 flex flex-wrap items-center justify-center gap-4">
            @guest
                @if(Route::has('register'))
                <a href="{{ route('register') }}"
                   class="inline-flex items-center gap-2 rounded-2xl bg-gradient-to-r from-violet-600 to-fuchsia-600
                          px-8 py-3.5 text-sm font-bold text-white shadow-lg shadow-violet-500/40
                          transition-all duration-200 hover:scale-105 hover:from-violet-500 hover:to-fuchsia-500 hover:shadow-violet-500/60">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    {{ __('Start for free') }}
                </a>
                @endif
                @if(Route::has('login'))
                <a href="{{ route('login') }}"
                   class="inline-flex items-center gap-2 rounded-2xl border border-zinc-300 bg-zinc-100/60 dark:border-zinc-700 dark:bg-zinc-900/60
                          px-8 py-3.5 text-sm font-bold text-zinc-700 dark:text-zinc-200 backdrop-blur-md
                          transition-all duration-200 hover:border-zinc-400 hover:bg-zinc-200/80 dark:hover:border-zinc-500 dark:hover:bg-zinc-800/80">
                    {{ __('Sign in') }}
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                @endif
            @else
                @if(!auth()->user()->is_admin)
                <a href="{{ route('patterns.crochet') }}"
                   class="inline-flex items-center gap-2 rounded-2xl bg-gradient-to-r from-violet-600 to-fuchsia-600
                          px-8 py-3.5 text-sm font-bold text-white shadow-lg shadow-violet-500/40
                          transition-all duration-200 hover:scale-105 hover:from-violet-500 hover:to-fuchsia-500">
                    {{ __('Explore Patterns') }}
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                <a href="{{ route('profile.show') }}"
                   class="inline-flex items-center gap-2 rounded-2xl border border-zinc-300 bg-zinc-100/60 dark:border-zinc-700 dark:bg-zinc-900/60
                          px-8 py-3.5 text-sm font-bold text-zinc-700 dark:text-zinc-200 backdrop-blur-md
                          transition-all duration-200 hover:border-zinc-400 hover:bg-zinc-200/80 dark:hover:border-zinc-500 dark:hover:bg-zinc-800/80">
                    {{ __('My Profile') }}
                </a>
                @endif
            @endguest
        </div>

        {{-- ── Live user search ── --}}
        <div class="hero-fade3 relative mx-auto mt-8 max-w-xl"
             x-data="{
                 query:   '',
                 results: [],
                 loading: false,
                 open:    false,
                 timer:   null,
                 search() {
                     clearTimeout(this.timer);
                     if (this.query.length < 1) { this.results = []; this.open = false; return; }
                     this.loading = true;
                     this.open    = true;
                     this.timer   = setTimeout(() => {
                         fetch('/search/users?q=' + encodeURIComponent(this.query))
                             .then(r => r.json())
                             .then(data => {
                                 this.results = data;
                                 this.loading = false;
                             })
                             .catch(() => { this.results = []; this.loading = false; this.open = false; });
                     }, 150);
                 }
             }"
             @click.outside="open = false">

            <div class="flex items-center gap-3 rounded-2xl border border-zinc-200 bg-white/80 dark:border-zinc-700/50 dark:bg-zinc-900/80 px-5 py-4
                        shadow-xl shadow-black/10 dark:shadow-black/40 backdrop-blur-md
                        transition-all duration-200
                        focus-within:border-violet-500/60 focus-within:shadow-violet-500/10
                        focus-within:ring-2 focus-within:ring-violet-500/15
                        hover:border-zinc-300 dark:hover:border-zinc-600/70">
                <svg class="h-5 w-5 shrink-0 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text"
                       placeholder="{{ __('Search creators by name or @username…') }}"
                       x-model="query"
                       @input="search()"
                       @focus="if (query.length >= 1) open = true"
                       class="flex-1 bg-transparent text-sm font-medium text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-500 outline-none">
                <button x-show="query.length > 0"
                        @click="query = ''; results = []; open = false"
                        class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-zinc-200 dark:bg-zinc-700 text-zinc-500 dark:text-zinc-400 hover:bg-zinc-300 dark:hover:bg-zinc-600 hover:text-zinc-900 dark:hover:text-white transition-colors">
                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                <div x-show="loading"
                     class="h-4 w-4 shrink-0 animate-spin rounded-full border-2 border-violet-400 border-t-transparent"></div>
            </div>

            {{-- Results dropdown --}}
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-150"
                 x-transition:enter-start="opacity-0 -translate-y-2 scale-[.97]"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-100"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 -translate-y-1 scale-[.97]"
                 class="absolute left-0 right-0 top-full z-[999] mt-2 overflow-hidden rounded-2xl
                        border border-zinc-200 dark:border-zinc-700/60 bg-white dark:bg-zinc-900 shadow-2xl shadow-black/20 dark:shadow-black/70">

                <div x-show="results.length > 0" class="divide-y divide-zinc-100 dark:divide-zinc-800/60 py-1">
                    <template x-for="user in results" :key="user.profile_url">
                        <a :href="user.profile_url" class="sr-row flex items-center gap-3 px-4 py-3">
                            <template x-if="user.profile_picture">
                                <img :src="user.profile_picture" :alt="user.name"
                                     class="h-9 w-9 shrink-0 rounded-full object-cover ring-1 ring-zinc-700">
                            </template>
                            <template x-if="!user.profile_picture">
                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full
                                            bg-gradient-to-br from-violet-500 to-purple-600 text-xs font-bold text-white"
                                     x-text="user.initials"></div>
                            </template>
                            <div class="min-w-0 flex-1 text-left">
                                <p class="truncate text-sm font-semibold text-zinc-900 dark:text-white" x-text="user.name"></p>
                                <p class="truncate text-xs text-zinc-500 dark:text-zinc-400"
                                   x-text="user.username ? '@' + user.username : ''"></p>
                            </div>
                            <svg class="h-4 w-4 shrink-0 text-zinc-400 dark:text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </template>
                </div>

                <div x-show="!loading && results.length === 0 && query.length >= 1"
                     class="flex flex-col items-center gap-1 px-4 py-6 text-center">
                    <svg class="mb-1 h-8 w-8 text-zinc-300 dark:text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <p class="text-sm text-zinc-500">{{ __('No creators found for') }}
                        "<span class="text-zinc-700 dark:text-zinc-300" x-text="query"></span>"
                    </p>
                </div>

                <div x-show="loading && results.length === 0"
                     class="flex items-center justify-center gap-2 px-4 py-5 text-sm text-zinc-500">
                    <div class="h-4 w-4 animate-spin rounded-full border-2 border-violet-400 border-t-transparent"></div>
                    {{ __('Searching…') }}
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll hint --}}
    <div class="pointer-events-none absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-zinc-400 dark:text-zinc-600"
         aria-hidden="true">
        <span class="text-[10px] font-bold uppercase tracking-[.28em]">{{ __('Scroll') }}</span>
        <div class="h-8 w-px animate-pulse bg-gradient-to-b from-zinc-600 to-transparent"></div>
    </div>
</section>


{{-- ══════════════════════════════════════════════
     STATS BAR
══════════════════════════════════════════════ --}}
<div class="border-y border-zinc-200/60 bg-zinc-100/50 dark:border-zinc-800/40 dark:bg-zinc-900/30 backdrop-blur-sm">
    <div class="mx-auto grid max-w-3xl grid-cols-3 gap-8 px-6 py-10 text-center">
        <div>
            <div class="text-4xl font-black tabular-nums text-zinc-900 dark:text-white sm:text-5xl">
                {{ number_format($stats['patterns']) }}+
            </div>
            <div class="mt-1 text-sm font-medium text-zinc-500">{{ __('Patterns') }}</div>
        </div>
        <div>
            <div class="text-4xl font-black tabular-nums text-zinc-900 dark:text-white sm:text-5xl">
                {{ number_format($stats['users']) }}+
            </div>
            <div class="mt-1 text-sm font-medium text-zinc-500">{{ __('Creators') }}</div>
        </div>
        <div>
            <div class="text-4xl font-black tabular-nums text-zinc-900 dark:text-white sm:text-5xl">
                {{ number_format($stats['posts']) }}+
            </div>
            <div class="mt-1 text-sm font-medium text-zinc-500">{{ __('Posts Shared') }}</div>
        </div>
    </div>
</div>


{{-- ══════════════════════════════════════════════
     FEATURES
══════════════════════════════════════════════ --}}
<section class="bg-zinc-50 dark:bg-zinc-950 px-6 py-24">
    <div class="mx-auto max-w-6xl">

        <div class="mb-16 text-center">
            <p class="mb-3 text-xs font-bold uppercase tracking-[.26em] text-violet-600 dark:text-violet-400">{{ __('Everything you need') }}</p>
            <h2 class="text-4xl font-black tracking-tight text-zinc-900 dark:text-white sm:text-5xl">{{ __('Built for makers') }}</h2>
            <p class="mx-auto mt-4 max-w-xl text-lg text-zinc-600 dark:text-zinc-400">
                {{ __('All your crafting tools in one beautiful, focused space.') }}
            </p>
        </div>

        <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">

            {{-- Patterns --}}
            <a href="{{ route('patterns.crochet') }}"
               class="feat-card group relative overflow-hidden rounded-3xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900 p-7 shadow-lg hover:border-emerald-500/30">
                <div class="pointer-events-none absolute -right-10 -top-10 h-40 w-40 rounded-full bg-emerald-500/6 blur-2xl transition-colors duration-500 group-hover:bg-emerald-500/16"></div>
                <div class="mb-5 flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-500/14">
                    <svg class="h-5 w-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="mb-2 text-lg font-bold text-zinc-900 dark:text-white">{{ __('Pattern Library') }}</h3>
                <p class="text-sm leading-relaxed text-zinc-600 dark:text-zinc-400">
                    {{ __('Browse thousands of crochet, knitting, and embroidery patterns with step-by-step guides.') }}
                </p>
                <div class="mt-5 flex items-center gap-1 text-sm font-semibold text-emerald-400 transition-all duration-200 group-hover:gap-2">
                    {{ __('Browse patterns') }}
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>

            {{-- Community --}}
            <a href="{{ auth()->check() ? route('profile.show') : route('login') }}"
               class="feat-card group relative overflow-hidden rounded-3xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900 p-7 shadow-lg hover:border-violet-500/30">
                <div class="pointer-events-none absolute -right-10 -top-10 h-40 w-40 rounded-full bg-violet-500/6 blur-2xl transition-colors duration-500 group-hover:bg-violet-500/16"></div>
                <div class="mb-5 flex h-11 w-11 items-center justify-center rounded-xl bg-violet-500/14">
                    <svg class="h-5 w-5 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="mb-2 text-lg font-bold text-zinc-900 dark:text-white">{{ __('Community') }}</h3>
                <p class="text-sm leading-relaxed text-zinc-600 dark:text-zinc-400">
                    {{ __('Share posts, follow inspiring makers, like and save creations, and build real connections.') }}
                </p>
                <div class="mt-5 flex items-center gap-1 text-sm font-semibold text-violet-400 transition-all duration-200 group-hover:gap-2">
                    {{ __('Join community') }}
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>

            {{-- Gallery --}}
            <a href="{{ route('models.gallery') }}"
               class="feat-card group relative overflow-hidden rounded-3xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900 p-7 shadow-lg hover:border-pink-500/30">
                <div class="pointer-events-none absolute -right-10 -top-10 h-40 w-40 rounded-full bg-pink-500/6 blur-2xl transition-colors duration-500 group-hover:bg-pink-500/16"></div>
                <div class="mb-5 flex h-11 w-11 items-center justify-center rounded-xl bg-pink-500/14">
                    <svg class="h-5 w-5 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="mb-2 text-lg font-bold text-zinc-900 dark:text-white">{{ __('Model Gallery') }}</h3>
                <p class="text-sm leading-relaxed text-zinc-600 dark:text-zinc-400">
                    {{ __('Browse finished projects from the community and discover what others have created.') }}
                </p>
                <div class="mt-5 flex items-center gap-1 text-sm font-semibold text-pink-400 transition-all duration-200 group-hover:gap-2">
                    {{ __('Explore gallery') }}
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>

            {{-- Collections --}}
            <a href="{{ auth()->check() ? route('my-collections') : route('login') }}"
               class="feat-card group relative overflow-hidden rounded-3xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900 p-7 shadow-lg hover:border-sky-500/30">
                <div class="pointer-events-none absolute -right-10 -top-10 h-40 w-40 rounded-full bg-sky-500/6 blur-2xl transition-colors duration-500 group-hover:bg-sky-500/16"></div>
                <div class="mb-5 flex h-11 w-11 items-center justify-center rounded-xl bg-sky-500/14">
                    <svg class="h-5 w-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <h3 class="mb-2 text-lg font-bold text-zinc-900 dark:text-white">{{ __('Collections') }}</h3>
                <p class="text-sm leading-relaxed text-zinc-600 dark:text-zinc-400">
                    {{ __('Organize your favorite patterns into personal collections and access them anytime.') }}
                </p>
                <div class="mt-5 flex items-center gap-1 text-sm font-semibold text-sky-400 transition-all duration-200 group-hover:gap-2">
                    {{ __('My collections') }}
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>

            {{-- Share patterns --}}
            <a href="{{ auth()->check() ? route('patterns.create') : route('login') }}"
               class="feat-card group relative overflow-hidden rounded-3xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900 p-7 shadow-lg hover:border-amber-500/30">
                <div class="pointer-events-none absolute -right-10 -top-10 h-40 w-40 rounded-full bg-amber-500/6 blur-2xl transition-colors duration-500 group-hover:bg-amber-500/16"></div>
                <div class="mb-5 flex h-11 w-11 items-center justify-center rounded-xl bg-amber-500/14">
                    <svg class="h-5 w-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                </div>
                <h3 class="mb-2 text-lg font-bold text-zinc-900 dark:text-white">{{ __('Share Patterns') }}</h3>
                <p class="text-sm leading-relaxed text-zinc-600 dark:text-zinc-400">
                    {{ __('Upload your own patterns and let the community discover and download your unique designs.') }}
                </p>
                <div class="mt-5 flex items-center gap-1 text-sm font-semibold text-amber-400 transition-all duration-200 group-hover:gap-2">
                    {{ __('Upload pattern') }}
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>

            {{-- Privacy --}}
            <a href="{{ auth()->check() ? route('profile.settings', ['tab' => 'privacy']) : route('login') }}"
               class="feat-card group relative overflow-hidden rounded-3xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900 p-7 shadow-lg hover:border-rose-500/30">
                <div class="pointer-events-none absolute -right-10 -top-10 h-40 w-40 rounded-full bg-rose-500/6 blur-2xl transition-colors duration-500 group-hover:bg-rose-500/16"></div>
                <div class="mb-5 flex h-11 w-11 items-center justify-center rounded-xl bg-rose-500/14">
                    <svg class="h-5 w-5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="mb-2 text-lg font-bold text-zinc-900 dark:text-white">{{ __('Privacy Controls') }}</h3>
                <p class="text-sm leading-relaxed text-zinc-600 dark:text-zinc-400">
                    {{ __('Control your profile visibility, who sees your liked and saved posts, and your collections.') }}
                </p>
                <div class="mt-5 flex items-center gap-1 text-sm font-semibold text-rose-400 transition-all duration-200 group-hover:gap-2">
                    {{ __('Manage privacy') }}
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>

        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════
     HOW IT WORKS
══════════════════════════════════════════════ --}}
<section class="border-t border-zinc-200/60 bg-zinc-100/50 dark:border-zinc-800/40 dark:bg-zinc-900/30 px-6 py-24">
    <div class="mx-auto max-w-4xl">

        <div class="mb-16 text-center">
            <p class="mb-3 text-xs font-bold uppercase tracking-[.26em] text-fuchsia-600 dark:text-fuchsia-400">{{ __('Get started in minutes') }}</p>
            <h2 class="text-4xl font-black tracking-tight text-zinc-900 dark:text-white sm:text-5xl">{{ __('How Yarnly works') }}</h2>
        </div>

        <div class="grid gap-10 md:grid-cols-3">
            <div class="relative border-l-2 border-violet-500/30 pl-5 pt-1">
                <div class="absolute -left-px top-0 h-8 w-0.5 bg-violet-500"></div>
                <p class="select-none text-[4rem] font-black leading-none text-violet-500/15">01</p>
                <h3 class="mt-1 text-lg font-bold text-zinc-900 dark:text-white">{{ __('Create your account') }}</h3>
                <p class="mt-2 text-sm leading-relaxed text-zinc-600 dark:text-zinc-400">
                    {{ __('Sign up for free in seconds. Set up your crafter profile and let the community know what you love to make.') }}
                </p>
            </div>
            <div class="relative border-l-2 border-fuchsia-500/30 pl-5 pt-1">
                <div class="absolute -left-px top-0 h-8 w-0.5 bg-fuchsia-500"></div>
                <p class="select-none text-[4rem] font-black leading-none text-fuchsia-500/15">02</p>
                <h3 class="mt-1 text-lg font-bold text-zinc-900 dark:text-white">{{ __('Discover & organize') }}</h3>
                <p class="mt-2 text-sm leading-relaxed text-zinc-600 dark:text-zinc-400">
                    {{ __('Browse thousands of patterns, save your favorites into collections, and find creators to follow.') }}
                </p>
            </div>
            <div class="relative border-l-2 border-pink-500/30 pl-5 pt-1">
                <div class="absolute -left-px top-0 h-8 w-0.5 bg-pink-500"></div>
                <p class="select-none text-[4rem] font-black leading-none text-pink-500/15">03</p>
                <h3 class="mt-1 text-lg font-bold text-zinc-900 dark:text-white">{{ __('Share your creations') }}</h3>
                <p class="mt-2 text-sm leading-relaxed text-zinc-600 dark:text-zinc-400">
                    {{ __('Post your finished projects, get likes and comments, and build your portfolio in the community.') }}
                </p>
            </div>
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════
     CTA
══════════════════════════════════════════════ --}}
<section class="bg-zinc-50 dark:bg-zinc-950 px-6 py-24">
    <div class="mx-auto max-w-3xl text-center">
        <div class="relative overflow-hidden rounded-[2rem] border border-violet-300/40 dark:border-violet-500/15
                    bg-gradient-to-br from-violet-100/80 via-fuchsia-50/80 to-indigo-100/80 dark:from-violet-900/30 dark:via-fuchsia-900/15 dark:to-indigo-900/30 p-14">
            <div class="pointer-events-none absolute -left-20 -top-20 h-72 w-72 rounded-full bg-violet-600/15 blur-3xl" aria-hidden="true"></div>
            <div class="pointer-events-none absolute -bottom-20 -right-20 h-72 w-72 rounded-full bg-fuchsia-600/15 blur-3xl" aria-hidden="true"></div>
            <div class="relative">
                <p class="mb-3 text-xs font-bold uppercase tracking-[.26em] text-violet-600 dark:text-violet-400">{{ __('Free forever to join') }}</p>
                <h2 class="mb-5 text-4xl font-black tracking-tight text-zinc-900 dark:text-white sm:text-5xl">{{ __('Ready to start crafting?') }}</h2>
                <p class="mx-auto mb-8 max-w-lg text-lg text-zinc-600 dark:text-zinc-400">
                    {{ __('Join :count+ makers who use Yarnly to discover patterns, share creations, and connect with the community.', ['count' => number_format($stats['users'])]) }}
                </p>
                @guest
                    @if(Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center gap-2 rounded-2xl bg-gradient-to-r from-violet-600 to-fuchsia-600
                              px-10 py-4 text-sm font-bold text-white shadow-lg shadow-violet-500/40
                              transition-all duration-200 hover:scale-105 hover:from-violet-500 hover:to-fuchsia-500">
                        {{ __('Create free account') }} →
                    </a>
                    @endif
                @else
                    <a href="{{ route('patterns.crochet') }}"
                       class="inline-flex items-center gap-2 rounded-2xl bg-gradient-to-r from-violet-600 to-fuchsia-600
                              px-10 py-4 text-sm font-bold text-white shadow-lg shadow-violet-500/40
                              transition-all duration-200 hover:scale-105 hover:from-violet-500 hover:to-fuchsia-500">
                        {{ __('Explore patterns') }} →
                    </a>
                @endguest
            </div>
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════
     FOOTER
══════════════════════════════════════════════ --}}
<footer class="border-t border-zinc-200/60 bg-white dark:border-zinc-800/40 dark:bg-zinc-950 px-6 py-10">
    <div class="mx-auto max-w-6xl text-center">
        <p class="text-sm text-zinc-500 dark:text-zinc-600">
            &copy; {{ date('Y') }} Yarnly &middot; Made with <svg class="inline-block h-4 w-4 text-rose-500 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 21.593c-5.63-5.539-11-10.297-11-14.402 0-3.791 3.068-5.191 5.281-5.191 1.312 0 4.151.501 5.719 4.457 1.59-3.968 4.464-4.447 5.726-4.447 2.54 0 5.274 1.621 5.274 5.181 0 4.069-5.136 8.625-11 14.402z"/></svg> for the crafting community
        </p>
    </div>
</footer>
@endsection
