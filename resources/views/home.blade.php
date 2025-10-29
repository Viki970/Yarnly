@extends('layout.app')

@section('title', 'Yarnly - Home')

@push('scripts')
    @fluxScripts
@endpush

@section('content')
    <!-- Hero -->
    <section class="relative overflow-hidden py-16 sm:py-24">
        <div class="absolute inset-0 -z-10 bg-gradient-to-br from-violet-100/80 via-white to-sky-100/70 dark:from-violet-900/40 dark:via-zinc-950 dark:to-indigo-950"></div>
        <div class="absolute inset-x-0 top-0 -z-10 h-64 bg-gradient-to-b from-white dark:from-zinc-950"></div>
        <div class="max-w-6xl mx-auto px-6 lg:px-10">
            <div class="grid items-center gap-12 lg:grid-cols-[minmax(0,1fr)_minmax(0,1.2fr)]">
                <div class="space-y-8">
                    <span class="inline-flex items-center gap-2 rounded-full border border-white/70 bg-white/70 px-4 py-1 text-xs font-semibold uppercase tracking-wide text-violet-600 shadow-sm shadow-violet-200 dark:border-violet-500/30 dark:bg-violet-500/10 dark:text-violet-200">AI-assisted curation</span>
                    <h1 class="text-4xl font-semibold tracking-tight text-zinc-900 sm:text-5xl dark:text-white">Design, iterate, and share your yarn projects without losing the thread.</h1>
                    <p class="max-w-xl text-lg leading-relaxed text-zinc-600 dark:text-zinc-300">Yarnly keeps your knitting and crochet inspirations organised. Preview patterns, run AI suggestions, and collaborate with your community from any device.</p>
                    <div class="flex flex-wrap items-center gap-4">
                        <a href="#features" class="inline-flex items-center justify-center rounded-md bg-gradient-to-r from-violet-500 via-purple-500 to-indigo-500 px-5 py-2.5 text-sm font-semibold text-white shadow-md shadow-violet-500/40 transition hover:brightness-110">Explore features</a>
                        @guest
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-md border border-zinc-200 px-5 py-2.5 text-sm font-medium text-zinc-700 transition hover:border-zinc-300 hover:text-zinc-900 dark:border-zinc-700 dark:text-zinc-200 dark:hover:border-zinc-500 dark:hover:text-white">Log in</a>
                            @endif
                        @else
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center rounded-md border border-zinc-200 px-5 py-2.5 text-sm font-medium text-zinc-700 transition hover:border-zinc-300 hover:text-zinc-900 dark:border-zinc-700 dark:text-zinc-200 dark:hover:border-zinc-500 dark:hover:text-white">Go to Dashboard</a>
                        @endguest
                    </div>

                    <dl class="grid grid-cols-2 gap-6 text-sm text-zinc-500 dark:text-zinc-300 sm:grid-cols-3">
                        <div>
                            <dt class="font-medium text-zinc-700 dark:text-zinc-100">Curated patterns</dt>
                            <dd class="mt-1 text-2xl font-semibold text-zinc-900 dark:text-white">2.5k+</dd>
                        </div>
                        <div>
                            <dt class="font-medium text-zinc-700 dark:text-zinc-100">Community prompts</dt>
                            <dd class="mt-1 text-2xl font-semibold text-zinc-900 dark:text-white">820</dd>
                        </div>
                        <div>
                            <dt class="font-medium text-zinc-700 dark:text-zinc-100">Avg. time saved</dt>
                            <dd class="mt-1 text-2xl font-semibold text-zinc-900 dark:text-white">38%</dd>
                        </div>
                    </dl>
                </div>

                <div class="relative rounded-3xl border border-white/70 bg-white/80 p-6 shadow-xl shadow-violet-300/30 backdrop-blur-sm dark:border-zinc-800/70 dark:bg-zinc-900/70 dark:shadow-black/40">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-semibold text-zinc-700 dark:text-zinc-200">Live Inspiration Board</span>
                        <span class="rounded-full bg-violet-500/15 px-3 py-1 text-xs font-semibold text-violet-600 dark:text-violet-200">AI curated</span>
                    </div>
                    <div class="mt-6 space-y-4">
                        <article class="rounded-2xl border border-transparent bg-gradient-to-r from-violet-500/10 via-fuchsia-500/10 to-sky-500/10 p-4 backdrop-blur-sm transition hover:border-violet-400/40">
                            <h3 class="text-sm font-semibold text-zinc-900 dark:text-white">Nordic Winter Set</h3>
                            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-300">Generate yarn blends and stitch patterns for a custom-fit hat, scarf, and mittens bundle.</p>
                        </article>
                        <article class="rounded-2xl border border-zinc-200/60 bg-white/70 p-4 transition hover:border-zinc-300 dark:border-zinc-700/60 dark:bg-zinc-900/70 dark:hover:border-zinc-600">
                            <h3 class="text-sm font-semibold text-zinc-900 dark:text-white">Mood-driven palette matches</h3>
                            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-300">Upload a reference photo and Yarnly surfaces yarn colourways from verified suppliers.</p>
                        </article>
                        <article class="rounded-2xl border border-zinc-200/60 bg-white/70 p-4 transition hover:border-zinc-300 dark:border-zinc-700/60 dark:bg-zinc-900/70 dark:hover:border-zinc-600">
                            <h3 class="text-sm font-semibold text-zinc-900 dark:text-white">Community stitch swaps</h3>
                            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-300">Browse weekly prompts and share progress shots directly with fellow makers.</p>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="border-t border-zinc-200/70 bg-white py-16 dark:border-zinc-800/70 dark:bg-zinc-950">
        <div class="max-w-6xl mx-auto px-6 lg:px-10">
            <div class="max-w-2xl">
                <h2 class="text-3xl font-semibold tracking-tight text-zinc-900 dark:text-white">Designed for makers who love to experiment.</h2>
                <p class="mt-3 text-lg text-zinc-600 dark:text-zinc-300">Mix structured pattern management with playful discovery. Yarnly adapts to the way you work, whether you’re crafting solo or collaborating with a guild.</p>
            </div>

            <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <div class="group rounded-3xl border border-zinc-200/70 bg-white/90 p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-zinc-800/70 dark:bg-zinc-900/70 dark:hover:shadow-black/50">
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-violet-500 to-purple-500 text-sm font-semibold text-white">1</span>
                    <h3 class="mt-5 text-lg font-semibold text-zinc-900 dark:text-white">Pattern intelligence</h3>
                    <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">Surface stitch counts, yarn requirements, and colour changes instantly. Export to your preferred format in seconds.</p>
                </div>
                <div class="group rounded-3xl border border-zinc-200/70 bg-white/90 p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-zinc-800/70 dark:bg-zinc-900/70 dark:hover:shadow-black/50">
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-sky-500 text-sm font-semibold text-white">2</span>
                    <h3 class="mt-5 text-lg font-semibold text-zinc-900 dark:text-white">Realtime collaboration</h3>
                    <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">Invite co-creators, annotate charts, and keep track of yarn stash updates without leaving the dashboard.</p>
                </div>
                <div class="group rounded-3xl border border-zinc-200/70 bg-white/90 p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-zinc-800/70 dark:bg-zinc-900/70 dark:hover:shadow-black/50">
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-fuchsia-500 to-rose-500 text-sm font-semibold text-white">3</span>
                    <h3 class="mt-5 text-lg font-semibold text-zinc-900 dark:text-white">Guided inspiration</h3>
                    <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">Let Yarnly’s AI suggest stitches, embellishments, and community tutorials tailored to your current project.</p>
                </div>
            </div>
        </div>
    </section>
@endsection