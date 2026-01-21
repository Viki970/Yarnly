@extends('layout.app')

@section('title', 'Yarnly - Crochet Patterns')

@section('content')
<section class="relative overflow-hidden bg-gradient-to-br from-emerald-50 via-teal-50 to-sky-50 py-16 dark:from-emerald-950/30 dark:via-teal-950/30 dark:to-sky-950/30">
    <div class="absolute -left-20 top-10 h-48 w-48 rounded-full bg-emerald-300/30 blur-3xl dark:bg-emerald-700/30"></div>
    <div class="absolute -right-12 bottom-10 h-64 w-64 rounded-full bg-teal-300/25 blur-3xl dark:bg-teal-700/25"></div>
    <div class="relative max-w-6xl mx-auto px-6 lg:px-12">
        <p class="inline-flex items-center gap-2 rounded-full bg-white/70 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-emerald-700 ring-1 ring-emerald-200 dark:bg-zinc-900/70 dark:text-emerald-200 dark:ring-emerald-800/60">
            Crochet Spotlight
        </p>
        <div class="mt-6 flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div class="max-w-3xl">
                <h1 class="text-4xl font-bold tracking-tight text-emerald-900 sm:text-5xl dark:text-white">Curated crochet patterns</h1>
                <p class="mt-4 text-lg leading-relaxed text-zinc-600 dark:text-zinc-300">
                    Browse featured stitches, step-by-step project guides, and community favorites. Save patterns to your library and pick up where you left off.
                </p>
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="#featured" class="rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-emerald-500/25 transition hover:translate-y-[-1px] hover:shadow-emerald-500/35">Featured sets</a>
                    <a href="#collections" class="rounded-xl bg-white/80 px-5 py-3 text-sm font-semibold text-emerald-800 ring-1 ring-emerald-200 transition hover:bg-white dark:bg-zinc-900/70 dark:text-emerald-100 dark:ring-emerald-800/60">Community picks</a>
                </div>
            </div>
            <div class="grid w-full max-w-md grid-cols-2 gap-4 rounded-2xl bg-white/80 p-4 shadow-xl ring-1 ring-emerald-100 backdrop-blur dark:bg-zinc-900/70 dark:ring-emerald-900/40">
                <div class="rounded-xl bg-gradient-to-br from-emerald-500 to-teal-500 p-4 text-white shadow-lg">
                    <p class="text-sm font-medium">New this week</p>
                    <p class="mt-3 text-2xl font-bold">12 patterns</p>
                    <p class="mt-1 text-sm text-emerald-100">Lacy throws, motifs, and quick makes.</p>
                </div>
                <div class="flex flex-col justify-between rounded-xl bg-white p-4 ring-1 ring-emerald-100 dark:bg-zinc-800 dark:ring-emerald-900/50">
                    <div>
                        <p class="text-sm font-semibold text-emerald-800 dark:text-emerald-100">Your queue</p>
                        <p class="mt-2 text-3xl font-bold text-emerald-900 dark:text-white">3</p>
                        <p class="text-sm text-zinc-600 dark:text-zinc-300">Projects ready to start.</p>
                    </div>
                    <div class="mt-4 flex items-center gap-2 text-xs font-medium text-emerald-700 dark:text-emerald-200">
                        <span class="inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                        Synced with your library
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-white py-12 dark:bg-zinc-900">
    <div class="max-w-6xl mx-auto px-6 lg:px-12">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-emerald-700 dark:text-emerald-200">Pick your lane</p>
                <h2 class="text-3xl font-bold text-zinc-900 dark:text-white">What crochet are you into?</h2>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">Jump straight to the style you want. Each option links to curated picks below.</p>
            </div>
            <a href="/" class="text-sm font-semibold text-zinc-600 underline-offset-4 hover:underline dark:text-zinc-300">Back to home</a>
        </div>

        <div class="mt-6 flex flex-wrap gap-3">
            <a href="{{ route('patterns.crochet.category', 'blankets') }}" class="rounded-full border @if($selectedCategory === 'blankets') border-emerald-500 bg-emerald-50 text-emerald-900 dark:border-emerald-400 dark:bg-emerald-900/30 dark:text-emerald-100 @else border-emerald-200 bg-white text-emerald-800 dark:border-emerald-900/50 dark:bg-zinc-900 dark:text-emerald-100 @endif px-4 py-2 text-sm font-semibold transition hover:-translate-y-0.5 hover:shadow-sm">Blankets</a>
            <a href="{{ route('patterns.crochet.category', 'amigurumi') }}" class="rounded-full border @if($selectedCategory === 'amigurumi') border-emerald-500 bg-emerald-50 text-emerald-900 dark:border-emerald-400 dark:bg-emerald-900/30 dark:text-emerald-100 @else border-emerald-200 bg-white text-emerald-800 dark:border-emerald-900/50 dark:bg-zinc-900 dark:text-emerald-100 @endif px-4 py-2 text-sm font-semibold transition hover:-translate-y-0.5 hover:shadow-sm">Amigurumi</a>
            <a href="{{ route('patterns.crochet.category', 'bags') }}" class="rounded-full border @if($selectedCategory === 'bags') border-emerald-500 bg-emerald-50 text-emerald-900 dark:border-emerald-400 dark:bg-emerald-900/30 dark:text-emerald-100 @else border-emerald-200 bg-white text-emerald-800 dark:border-emerald-900/50 dark:bg-zinc-900 dark:text-emerald-100 @endif px-4 py-2 text-sm font-semibold transition hover:-translate-y-0.5 hover:shadow-sm">Bags & Totes</a>
            <a href="{{ route('patterns.crochet.category', 'wearables') }}" class="rounded-full border @if($selectedCategory === 'wearables') border-emerald-500 bg-emerald-50 text-emerald-900 dark:border-emerald-400 dark:bg-emerald-900/30 dark:text-emerald-100 @else border-emerald-200 bg-white text-emerald-800 dark:border-emerald-900/50 dark:bg-zinc-900 dark:text-emerald-100 @endif px-4 py-2 text-sm font-semibold transition hover:-translate-y-0.5 hover:shadow-sm">Wearables</a>
            <a href="{{ route('patterns.crochet.category', 'home-decor') }}" class="rounded-full border @if($selectedCategory === 'home-decor') border-emerald-500 bg-emerald-50 text-emerald-900 dark:border-emerald-400 dark:bg-emerald-900/30 dark:text-emerald-100 @else border-emerald-200 bg-white text-emerald-800 dark:border-emerald-900/50 dark:bg-zinc-900 dark:text-emerald-100 @endif px-4 py-2 text-sm font-semibold transition hover:-translate-y-0.5 hover:shadow-sm">Home decor</a>
        </div>

        <div class="mt-8 grid gap-6 md:grid-cols-2">
            <article id="blankets" class="group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-emerald-900/40 dark:bg-zinc-900/70">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white">Blankets & Throws</h3>
                    <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-200">Cozy</span>
                </div>
                <ul class="mt-3 space-y-2 text-sm text-zinc-600 dark:text-zinc-300">
                    <li>Ripple waves with easy repeats.</li>
                    <li>Color-block stripes for stash busting.</li>
                    <li>Chunky weight lap throws for quick wins.</li>
                </ul>
            </article>

            <article id="amigurumi" class="group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-emerald-900/40 dark:bg-zinc-900/70">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white">Amigurumi</h3>
                    <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-200">Toys</span>
                </div>
                <ul class="mt-3 space-y-2 text-sm text-zinc-600 dark:text-zinc-300">
                    <li>Animal minis with embroidered faces.</li>
                    <li>Plant pals and desk mascots.</li>
                    <li>Seamless spheres for practice runs.</li>
                </ul>
            </article>

            <article id="bags" class="group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-emerald-900/40 dark:bg-zinc-900/70">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white">Bags & Totes</h3>
                    <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-200">Daily carry</span>
                </div>
                <ul class="mt-3 space-y-2 text-sm text-zinc-600 dark:text-zinc-300">
                    <li>Market totes with reinforced bases.</li>
                    <li>Sunburst granny bags with lining tips.</li>
                    <li>Crossbody slings using sturdy cotton.</li>
                </ul>
            </article>

            <article id="wearables" class="group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-emerald-900/40 dark:bg-zinc-900/70">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white">Wearables</h3>
                    <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-200">Wardrobe</span>
                </div>
                <ul class="mt-3 space-y-2 text-sm text-zinc-600 dark:text-zinc-300">
                    <li>Boxy tees with breathable cotton.</li>
                    <li>Beginner-friendly cardigans with minimal seaming.</li>
                    <li>Bucket hats and cozy beanies.</li>
                </ul>
            </article>

            <article id="home-decor" class="group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-emerald-900/40 dark:bg-zinc-900/70 md:col-span-2">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white">Home decor</h3>
                    <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-200">Spaces</span>
                </div>
                <ul class="mt-3 flex flex-wrap gap-3 text-sm text-zinc-600 dark:text-zinc-300">
                    <li class="rounded-full bg-emerald-50 px-3 py-1 font-semibold text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-100">Wall hangings</li>
                    <li class="rounded-full bg-emerald-50 px-3 py-1 font-semibold text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-100">Table runners</li>
                    <li class="rounded-full bg-emerald-50 px-3 py-1 font-semibold text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-100">Plant cozies</li>
                    <li class="rounded-full bg-emerald-50 px-3 py-1 font-semibold text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-100">Pillow covers</li>
                </ul>
            </article>
        </div>
    </div>
</section>

<section id="featured" class="bg-white py-14 dark:bg-zinc-900">
    <div class="max-w-6xl mx-auto px-6 lg:px-12">
        @if($selectedCategory)
            <!-- Selected Category View -->
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold text-emerald-700 dark:text-emerald-200">{{ ucfirst(str_replace('-', ' ', $selectedCategory)) }} patterns</p>
                    <h2 class="mt-1 text-3xl font-bold text-zinc-900 dark:text-white">Available patterns</h2>
                    <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">Download PDF instructions and start your project today.</p>
                </div>
                <a href="{{ route('patterns.crochet') }}" class="text-sm font-semibold text-emerald-700 underline-offset-4 hover:underline dark:text-emerald-200">View all</a>
            </div>

            @if($patterns && $patterns->count() > 0)
                <div class="mt-8 grid gap-6 md:grid-cols-3">
                    @foreach($patterns as $pattern)
                        <article class="group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-emerald-900/40 dark:bg-zinc-900/70">
                            <div class="flex items-center justify-between">
                                <div class="rounded-lg px-3 py-1 text-xs font-semibold @if($pattern->difficulty === 'beginner') bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-200 @elseif($pattern->difficulty === 'intermediate') bg-teal-100 text-teal-800 dark:bg-teal-900/40 dark:text-teal-200 @else bg-orange-100 text-orange-800 dark:bg-orange-900/40 dark:text-orange-200 @endif">
                                    {{ ucfirst($pattern->difficulty) }}
                                </div>
                                @if($pattern->estimated_hours)
                                    <span class="text-xs font-medium text-emerald-700 dark:text-emerald-200">{{ $pattern->estimated_hours }} hrs</span>
                                @endif
                            </div>
                            <h3 class="mt-4 text-lg font-bold text-zinc-900 dark:text-white">{{ $pattern->title }}</h3>
                            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">{{ $pattern->description }}</p>
                            <div class="mt-4 flex items-center gap-3 text-xs font-semibold text-emerald-700 dark:text-emerald-200">
                                <span class="inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                                {{ $pattern->makers_saved }} makers saved
                            </div>
                            @if($pattern->pdf_file)
                                <a href="{{ asset('storage/' . $pattern->pdf_file) }}" download class="mt-5 block w-full rounded-lg bg-emerald-600 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-emerald-700 dark:hover:bg-emerald-500">Download PDF</a>
                            @else
                                <button disabled class="mt-5 block w-full rounded-lg bg-zinc-200 px-4 py-2 text-center text-sm font-semibold text-zinc-500 cursor-not-allowed dark:bg-zinc-700 dark:text-zinc-400">PDF Coming Soon</button>
                            @endif
                        </article>
                    @endforeach
                </div>
            @else
                <div class="mt-8 rounded-2xl border border-dashed border-emerald-200 bg-emerald-50 p-12 text-center dark:border-emerald-900/40 dark:bg-zinc-900/70">
                    <h3 class="text-lg font-bold text-emerald-900 dark:text-white">No patterns yet</h3>
                    <p class="mt-2 text-sm text-emerald-700 dark:text-emerald-300">More {{ str_replace('-', ' ', $selectedCategory) }} patterns coming soon!</p>
                    <a href="{{ route('patterns.crochet') }}" class="mt-4 inline-block rounded-lg bg-emerald-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-700">View all categories</a>
                </div>
            @endif
        @else
            <!-- Default Featured View -->
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold text-emerald-700 dark:text-emerald-200">Featured drops</p>
                    <h2 class="mt-1 text-3xl font-bold text-zinc-900 dark:text-white">Weekend-worthy crochet picks</h2>
                </div>
                <a href="#collections" class="text-sm font-semibold text-emerald-700 underline-offset-4 hover:underline dark:text-emerald-200">See collections</a>
            </div>

            @if($featured && $featured->count() > 0)
                <div class="mt-8 grid gap-6 md:grid-cols-3">
                    @foreach($featured as $pattern)
                        <article class="group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-emerald-900/40 dark:bg-zinc-900/70">
                            <div class="flex items-center justify-between">
                                <div class="rounded-lg px-3 py-1 text-xs font-semibold @if($pattern->difficulty === 'beginner') bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-200 @elseif($pattern->difficulty === 'intermediate') bg-teal-100 text-teal-800 dark:bg-teal-900/40 dark:text-teal-200 @else bg-orange-100 text-orange-800 dark:bg-orange-900/40 dark:text-orange-200 @endif">
                                    {{ ucfirst($pattern->difficulty) }}
                                </div>
                                @if($pattern->estimated_hours)
                                    <span class="text-xs font-medium text-emerald-700 dark:text-emerald-200">{{ $pattern->estimated_hours }} hrs</span>
                                @endif
                            </div>
                            <h3 class="mt-4 text-lg font-bold text-zinc-900 dark:text-white">{{ $pattern->title }}</h3>
                            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">{{ $pattern->description }}</p>
                            <div class="mt-4 flex items-center gap-3 text-xs font-semibold text-emerald-700 dark:text-emerald-200">
                                <span class="inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                                {{ $pattern->makers_saved }} makers saved
                            </div>
                            @if($pattern->pdf_file)
                                <a href="{{ asset('storage/' . $pattern->pdf_file) }}" download class="mt-5 block w-full rounded-lg bg-emerald-600 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-emerald-700 dark:hover:bg-emerald-500">Download PDF</a>
                            @else
                                <button disabled class="mt-5 block w-full rounded-lg bg-zinc-200 px-4 py-2 text-center text-sm font-semibold text-zinc-500 cursor-not-allowed dark:bg-zinc-700 dark:text-zinc-400">PDF Coming Soon</button>
                            @endif
                        </article>
                    @endforeach
                </div>
            @else
                <div class="mt-8 rounded-2xl border border-dashed border-emerald-200 bg-emerald-50 p-12 text-center dark:border-emerald-900/40 dark:bg-zinc-900/70">
                    <h3 class="text-lg font-bold text-emerald-900 dark:text-white">No featured patterns yet</h3>
                    <p class="mt-2 text-sm text-emerald-700 dark:text-emerald-300">Featured patterns will appear here soon. Select a category above to browse!</p>
                </div>
            @endif
        @endif
    </div>
</section>

<section id="collections" class="bg-gradient-to-br from-emerald-50 via-white to-teal-50 py-14 dark:from-emerald-950/20 dark:via-zinc-900 dark:to-teal-950/20">
    <div class="max-w-6xl mx-auto px-6 lg:px-12">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-emerald-700 dark:text-emerald-200">Community sets</p>
                <h2 class="text-3xl font-bold text-zinc-900 dark:text-white">Collections you can start tonight</h2>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">Save a set to your library or clone it into a project board.</p>
            </div>
            <a href="/" class="text-sm font-semibold text-zinc-600 underline-offset-4 hover:underline dark:text-zinc-300">Back to home</a>
        </div>

        <div class="mt-8 grid gap-6 md:grid-cols-3">
            <div class="rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm ring-1 ring-transparent transition hover:-translate-y-1 hover:ring-emerald-200 dark:border-emerald-900/40 dark:bg-zinc-900/70 dark:hover:ring-emerald-800/50">
                <h3 class="text-lg font-bold text-zinc-900 dark:text-white">Modern Granny Squares</h3>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">12-square palette with seamless joins and video tips.</p>
                <div class="mt-4 flex flex-wrap gap-2 text-xs font-semibold text-emerald-700 dark:text-emerald-200">
                    <span class="rounded-full bg-emerald-100 px-3 py-1 dark:bg-emerald-900/40">Colorwork</span>
                    <span class="rounded-full bg-emerald-100 px-3 py-1 dark:bg-emerald-900/40">Modular</span>
                </div>
            </div>

            <div class="rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm ring-1 ring-transparent transition hover:-translate-y-1 hover:ring-emerald-200 dark:border-emerald-900/40 dark:bg-zinc-900/70 dark:hover:ring-emerald-800/50">
                <h3 class="text-lg font-bold text-zinc-900 dark:text-white">Mindful Stitch Series</h3>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">Five meditative projects with breathing prompts and pacing guides.</p>
                <div class="mt-4 flex flex-wrap gap-2 text-xs font-semibold text-emerald-700 dark:text-emerald-200">
                    <span class="rounded-full bg-emerald-100 px-3 py-1 dark:bg-emerald-900/40">Wellness</span>
                    <span class="rounded-full bg-emerald-100 px-3 py-1 dark:bg-emerald-900/40">Quick wins</span>
                </div>
            </div>

            <div class="rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm ring-1 ring-transparent transition hover:-translate-y-1 hover:ring-emerald-200 dark:border-emerald-900/40 dark:bg-zinc-900/70 dark:hover:ring-emerald-800/50">
                <h3 class="text-lg font-bold text-zinc-900 dark:text-white">Textured Staples</h3>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">Ribbed beanies, waffle scarves, and squishy mitts for gifting.</p>
                <div class="mt-4 flex flex-wrap gap-2 text-xs font-semibold text-emerald-700 dark:text-emerald-200">
                    <span class="rounded-full bg-emerald-100 px-3 py-1 dark:bg-emerald-900/40">Accessories</span>
                    <span class="rounded-full bg-emerald-100 px-3 py-1 dark:bg-emerald-900/40">Texture</span>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
