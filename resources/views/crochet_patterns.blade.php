@extends('layout.app')

@section('title', 'Yarnly - Crochet Patterns')

@section('content')
<style>
    /* Offset anchor links to account for fixed navbar */
    #patterns {
        scroll-margin-top: 30px;
    }
</style>

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
                    Browse curated stitches, step-by-step project guides, and community favorites. Save patterns to your library and pick up where you left off.
                </p>
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="#collections" class="rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-emerald-500/25 transition hover:translate-y-[-1px] hover:shadow-emerald-500/35">Browse patterns</a>
                </div>
            </div>
            <div class="grid w-full max-w-md grid-cols-2 gap-4 rounded-2xl bg-white/80 p-4 shadow-xl ring-1 ring-emerald-100 backdrop-blur dark:bg-zinc-900/70 dark:ring-emerald-900/40">
                <div class="rounded-xl bg-gradient-to-br from-emerald-500 to-teal-500 p-4 text-white shadow-lg">
                    <p class="text-sm font-medium">New this week</p>
                    <p class="mt-3 text-2xl font-bold">{{ $newThisWeek ?? 0 }} {{ Str::plural('pattern', $newThisWeek ?? 0) }}</p>
                    <p class="mt-1 text-sm text-emerald-100">Fresh patterns ready to start.</p>
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

<section id="patterns" class="bg-white py-12 dark:bg-zinc-900">
    <div class="max-w-6xl mx-auto px-6 lg:px-12">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-emerald-700 dark:text-emerald-200">Pick your lane</p>
                <h2 class="text-3xl font-bold text-zinc-900 dark:text-white">What crochet are you into?</h2>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">Jump straight to the style you want. Each option links to curated picks below.</p>
            </div>
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('patterns.create') }}" 
                        class="rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 px-5 py-3 text-sm font-semibold text-white shadow-lg hover:from-emerald-500 hover:to-teal-500 transition-all duration-200 transform hover:scale-105">
                        <svg class="inline-block h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Create Pattern
                    </a>
                @else
                    <button onclick="handleCreatePatternGuest()" 
                        class="rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 px-5 py-3 text-sm font-semibold text-white shadow-lg hover:from-emerald-500 hover:to-teal-500 transition-all duration-200 transform hover:scale-105">
                        <svg class="inline-block h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Create Pattern
                    </button>
                @endauth
                <a href="/" class="text-sm font-semibold text-zinc-600 underline-offset-4 hover:underline dark:text-zinc-300">Back to home</a>
            </div>
        </div>

        <div class="mt-6 flex flex-wrap gap-3">
            <a href="{{ route('patterns.crochet') }}#patterns" class="rounded-full border @if(!$selectedCategory) border-emerald-500 bg-emerald-50 text-emerald-900 dark:border-emerald-400 dark:bg-emerald-900/30 dark:text-emerald-100 @else border-emerald-200 bg-white text-emerald-800 dark:border-emerald-900/50 dark:bg-zinc-900 dark:text-emerald-100 @endif px-4 py-2 text-sm font-semibold transition hover:-translate-y-0.5 hover:shadow-sm">All</a>
            <a href="{{ route('patterns.crochet.category', 'blankets') }}#patterns" class="rounded-full border @if($selectedCategory === 'blankets') border-emerald-500 bg-emerald-50 text-emerald-900 dark:border-emerald-400 dark:bg-emerald-900/30 dark:text-emerald-100 @else border-emerald-200 bg-white text-emerald-800 dark:border-emerald-900/50 dark:bg-zinc-900 dark:text-emerald-100 @endif px-4 py-2 text-sm font-semibold transition hover:-translate-y-0.5 hover:shadow-sm">Blankets</a>
            <a href="{{ route('patterns.crochet.category', 'amigurumi') }}#patterns" class="rounded-full border @if($selectedCategory === 'amigurumi') border-emerald-500 bg-emerald-50 text-emerald-900 dark:border-emerald-400 dark:bg-emerald-900/30 dark:text-emerald-100 @else border-emerald-200 bg-white text-emerald-800 dark:border-emerald-900/50 dark:bg-zinc-900 dark:text-emerald-100 @endif px-4 py-2 text-sm font-semibold transition hover:-translate-y-0.5 hover:shadow-sm">Amigurumi</a>
            <a href="{{ route('patterns.crochet.category', 'bags') }}#patterns" class="rounded-full border @if($selectedCategory === 'bags') border-emerald-500 bg-emerald-50 text-emerald-900 dark:border-emerald-400 dark:bg-emerald-900/30 dark:text-emerald-100 @else border-emerald-200 bg-white text-emerald-800 dark:border-emerald-900/50 dark:bg-zinc-900 dark:text-emerald-100 @endif px-4 py-2 text-sm font-semibold transition hover:-translate-y-0.5 hover:shadow-sm">Bags & Totes</a>
            <a href="{{ route('patterns.crochet.category', 'wearables') }}#patterns" class="rounded-full border @if($selectedCategory === 'wearables') border-emerald-500 bg-emerald-50 text-emerald-900 dark:border-emerald-400 dark:bg-emerald-900/30 dark:text-emerald-100 @else border-emerald-200 bg-white text-emerald-800 dark:border-emerald-900/50 dark:bg-zinc-900 dark:text-emerald-100 @endif px-4 py-2 text-sm font-semibold transition hover:-translate-y-0.5 hover:shadow-sm">Wearables</a>
            <a href="{{ route('patterns.crochet.category', 'home-decor') }}#patterns" class="rounded-full border @if($selectedCategory === 'home-decor') border-emerald-500 bg-emerald-50 text-emerald-900 dark:border-emerald-400 dark:bg-emerald-900/30 dark:text-emerald-100 @else border-emerald-200 bg-white text-emerald-800 dark:border-emerald-900/50 dark:bg-zinc-900 dark:text-emerald-100 @endif px-4 py-2 text-sm font-semibold transition hover:-translate-y-0.5 hover:shadow-sm">Home decor</a>
        </div>

        @if($selectedCategory)
            <!-- Show patterns for selected category -->
            <div id="patterns" class="mt-12">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h3 class="mt-1 text-2xl font-bold text-zinc-900 dark:text-white">{{ ucfirst(str_replace('-', ' ', $selectedCategory)) }} patterns</h3>
                    </div>
                    <a href="{{ route('patterns.crochet') }}" class="text-sm font-semibold text-emerald-700 underline-offset-4 hover:underline dark:text-emerald-200">View all</a>
                </div>
                
                <!-- Sorting Controls -->
                <div class="mt-6 flex flex-wrap items-center justify-between gap-4">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="text-sm font-medium text-zinc-600 dark:text-zinc-300">Sort by:</span>
                        <select id="sortSelect" class="rounded-lg border border-emerald-200 bg-white px-3 py-2 text-sm font-medium text-zinc-700 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 dark:border-emerald-800 dark:bg-zinc-800 dark:text-zinc-200">
                            <option value="newest">Newest first</option>
                            <option value="oldest">Oldest first</option>
                            <option value="title-asc">Title A-Z</option>
                            <option value="title-desc">Title Z-A</option>
                            <option value="popular">Most popular</option>
                        </select>
                        
                        <span class="text-sm font-medium text-zinc-600 dark:text-zinc-300">Time:</span>
                        <select id="timeFilter" class="rounded-lg border border-emerald-200 bg-white px-3 py-2 text-sm font-medium text-zinc-700 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 dark:border-emerald-800 dark:bg-zinc-800 dark:text-zinc-200">
                            <option value="all">All times</option>
                            <option value="shortest">Shortest first</option>
                            <option value="longest">Longest first</option>
                        </select>
                        
                        <span class="text-sm font-medium text-zinc-600 dark:text-zinc-300">Difficulty:</span>
                        <select id="difficultyFilter" class="rounded-lg border border-emerald-200 bg-white px-3 py-2 text-sm font-medium text-zinc-700 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 dark:border-emerald-800 dark:bg-zinc-800 dark:text-zinc-200">
                            <option value="all">All levels</option>
                            <option value="beginner">Beginner</option>
                            <option value="intermediate">Intermediate</option>
                            <option value="advanced">Advanced</option>
                        </select>
                    </div>
                    <div class="text-sm text-zinc-500 dark:text-zinc-400">
                        <span id="patternCount">{{ $patterns ? $patterns->count() : 0 }}</span> {{ Str::plural('pattern', $patterns ? $patterns->count() : 0) }}
                    </div>
                </div>

                @if($patterns && $patterns->count() > 0)
                    <div class="mt-8 grid gap-6 md:grid-cols-3">
                        @foreach($patterns as $pattern)
                            <article class="group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-emerald-900/40 dark:bg-zinc-900/70">
                                @if($pattern->image_path)
                                    <div class="mb-4 aspect-[3/4] w-full overflow-hidden rounded-xl bg-zinc-100 dark:bg-zinc-800">
                                        <img 
                                            src="{{ asset('storage/' . $pattern->image_path) }}" 
                                            alt="{{ $pattern->title }}"
                                            class="h-full w-full object-cover" 
                                            loading="lazy">
                                    </div>
                                @endif
                                <div class="flex items-center justify-between">
                                    <div class="rounded-lg px-3 py-1 text-xs font-semibold @if($pattern->difficulty === 'beginner') bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-200 @elseif($pattern->difficulty === 'intermediate') bg-teal-100 text-teal-800 dark:bg-teal-900/40 dark:text-teal-200 @else bg-orange-100 text-orange-800 dark:bg-orange-900/40 dark:text-orange-200 @endif">
                                        {{ ucfirst($pattern->difficulty) }}
                                    </div>
                                    @if($pattern->estimated_hours)
                                        <span class="text-xs font-medium text-emerald-700 dark:text-emerald-200">≈ {{ $pattern->estimated_hours }} hrs</span>
                                    @endif
                                </div>
                                <h3 class="mt-4 text-lg font-bold text-zinc-900 dark:text-white">{{ $pattern->title }}</h3>
                                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">{{ $pattern->description }}</p>
                                <div class="mt-4 flex items-center gap-3 text-xs font-semibold text-emerald-700 dark:text-emerald-200">
                                    <span class="inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                                    {{ $pattern->makers_saved }} makers saved
                                </div>
                                @if($pattern->pdf_file)
                                    <div class="mt-5 flex gap-2">
                                        <a href="{{ route('patterns.view', $pattern->id) }}" class="flex-1 rounded-lg bg-teal-600 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-teal-700">View Pattern</a>
                                        <a href="{{ asset('storage/' . $pattern->pdf_file) }}" download class="flex-1 rounded-lg bg-emerald-600 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-emerald-700 dark:hover:bg-emerald-500">Download PDF</a>
                                    </div>
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
            </div>
        @else
            <!-- Show newest patterns when no category is selected -->
            <div id="patterns" class="mt-12">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h3 class="mt-1 text-2xl font-bold text-zinc-900 dark:text-white">Newest crochet patterns</h3>
                    </div>
                </div>
                
                <!-- Sorting Controls -->
                <div class="mt-6 flex flex-wrap items-center justify-between gap-4">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="text-sm font-medium text-zinc-600 dark:text-zinc-300">Sort by:</span>
                        <select id="sortSelect" class="rounded-lg border border-emerald-200 bg-white px-3 py-2 text-sm font-medium text-zinc-700 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 dark:border-emerald-800 dark:bg-zinc-800 dark:text-zinc-200">
                            <option value="newest">Newest first</option>
                            <option value="oldest">Oldest first</option>
                            <option value="title-asc">Title A-Z</option>
                            <option value="title-desc">Title Z-A</option>
                            <option value="popular">Most popular</option>
                        </select>
                        
                        <span class="text-sm font-medium text-zinc-600 dark:text-zinc-300">Time:</span>
                        <select id="timeFilter" class="rounded-lg border border-emerald-200 bg-white px-3 py-2 text-sm font-medium text-zinc-700 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 dark:border-emerald-800 dark:bg-zinc-800 dark:text-zinc-200">
                            <option value="all">All times</option>
                            <option value="shortest">Shortest first</option>
                            <option value="longest">Longest first</option>
                        </select>
                        
                        <span class="text-sm font-medium text-zinc-600 dark:text-zinc-300">Difficulty:</span>
                        <select id="difficultyFilter" class="rounded-lg border border-emerald-200 bg-white px-3 py-2 text-sm font-medium text-zinc-700 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 dark:border-emerald-800 dark:bg-zinc-800 dark:text-zinc-200">
                            <option value="all">All levels</option>
                            <option value="beginner">Beginner</option>
                            <option value="intermediate">Intermediate</option>
                            <option value="advanced">Advanced</option>
                        </select>
                    </div>
                    <div class="text-sm text-zinc-500 dark:text-zinc-400">
                        <span id="patternCount">{{ $newest ? $newest->count() : 0 }}</span> {{ Str::plural('pattern', $newest ? $newest->count() : 0) }}
                    </div>
                </div>

                @if($newest && $newest->count() > 0)
                    <div class="mt-8 grid gap-6 md:grid-cols-3">
                        @foreach($newest as $pattern)
                            <article class="group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-emerald-900/40 dark:bg-zinc-900/70">
                                @if($pattern->image_path)
                                    <div class="mb-4 aspect-[3/4] w-full overflow-hidden rounded-xl bg-zinc-100 dark:bg-zinc-800">
                                        <img 
                                            src="{{ asset('storage/' . $pattern->image_path) }}" 
                                            alt="{{ $pattern->title }}"
                                            class="h-full w-full object-cover" 
                                            loading="lazy">
                                    </div>
                                @endif
                                <div class="flex items-center justify-between">
                                    <div class="rounded-lg px-3 py-1 text-xs font-semibold @if($pattern->difficulty === 'beginner') bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-200 @elseif($pattern->difficulty === 'intermediate') bg-teal-100 text-teal-800 dark:bg-teal-900/40 dark:text-teal-200 @else bg-orange-100 text-orange-800 dark:bg-orange-900/40 dark:text-orange-200 @endif">
                                        {{ ucfirst($pattern->difficulty) }}
                                    </div>
                                    @if($pattern->estimated_hours)
                                        <span class="text-xs font-medium text-emerald-700 dark:text-emerald-200">≈ {{ $pattern->estimated_hours }} hrs</span>
                                    @endif
                                </div>
                                <h3 class="mt-4 text-lg font-bold text-zinc-900 dark:text-white">{{ $pattern->title }}</h3>
                                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">{{ $pattern->description }}</p>
                                <div class="mt-4 flex items-center gap-3 text-xs font-semibold text-emerald-700 dark:text-emerald-200">
                                    <span class="inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                                    {{ $pattern->makers_saved }} makers saved
                                </div>
                                @if($pattern->pdf_file)
                                    <div class="mt-5 flex gap-2">
                                        <a href="{{ route('patterns.view', $pattern->id) }}" class="flex-1 rounded-lg bg-teal-600 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-teal-700">View Pattern</a>
                                        <a href="{{ asset('storage/' . $pattern->pdf_file) }}" download class="flex-1 rounded-lg bg-emerald-600 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-emerald-700 dark:hover:bg-emerald-500">Download PDF</a>
                                    </div>
                                @else
                                    <button disabled class="mt-5 block w-full rounded-lg bg-zinc-200 px-4 py-2 text-center text-sm font-semibold text-zinc-500 cursor-not-allowed dark:bg-zinc-700 dark:text-zinc-400">PDF Coming Soon</button>
                                @endif
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="mt-8 rounded-2xl border border-dashed border-emerald-200 bg-emerald-50 p-12 text-center dark:border-emerald-900/40 dark:bg-zinc-900/70">
                        <h3 class="text-lg font-bold text-emerald-900 dark:text-white">No patterns yet</h3>
                        <p class="mt-2 text-sm text-emerald-700 dark:text-emerald-300">New patterns will appear here soon!</p>
                    </div>
                @endif
            </div>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sortSelect = document.getElementById('sortSelect');
    const difficultyFilter = document.getElementById('difficultyFilter');
    const timeFilter = document.getElementById('timeFilter');
    const patternCount = document.getElementById('patternCount');
    
    function updatePatterns() {
        const patternsGrid = document.querySelector('.mt-8.grid.gap-6.md\\:grid-cols-3');
        if (!patternsGrid) return;
        
        const articles = Array.from(patternsGrid.children);
        let visibleArticles = [];
        
        // First, show all articles and collect them
        articles.forEach(article => {
            article.style.display = 'block';
            
            // Check difficulty filter
            let shouldShow = true;
            if (difficultyFilter && difficultyFilter.value !== 'all') {
                const selectedDifficulty = difficultyFilter.value;
                const diffElement = article.querySelector('.rounded-lg.px-3.py-1');
                if (diffElement) {
                    const difficulty = diffElement.textContent.trim().toLowerCase();
                    shouldShow = difficulty === selectedDifficulty;
                }
            }
            
            if (shouldShow) {
                visibleArticles.push(article);
            } else {
                article.style.display = 'none';
            }
        });
        
        // Apply time sorting if selected
        if (timeFilter && timeFilter.value !== 'all') {
            const timeValue = timeFilter.value;
            visibleArticles.sort((a, b) => {
                const timeA = parseInt(a.querySelector('span[class*="hrs"]')?.textContent.match(/\\d+/)?.[0] || '999');
                const timeB = parseInt(b.querySelector('span[class*="hrs"]')?.textContent.match(/\\d+/)?.[0] || '999');
                
                if (timeValue === 'shortest') {
                    return timeA - timeB;
                } else if (timeValue === 'longest') {
                    return timeB - timeA;
                }
                return 0;
            });
        } 
        // Otherwise, apply main sorting
        else if (sortSelect) {
            const sortValue = sortSelect.value;
            visibleArticles.sort((a, b) => {
                switch (sortValue) {
                    case 'newest':
                        return articles.indexOf(a) - articles.indexOf(b);
                        
                    case 'oldest':
                        return articles.indexOf(b) - articles.indexOf(a);
                        
                    case 'title-asc':
                        const titleA = a.querySelector('h3').textContent.trim();
                        const titleB = b.querySelector('h3').textContent.trim();
                        return titleA.localeCompare(titleB);
                        
                    case 'title-desc':
                        const titleDescA = a.querySelector('h3').textContent.trim();
                        const titleDescB = b.querySelector('h3').textContent.trim();
                        return titleDescB.localeCompare(titleDescA);
                        
                    case 'popular':
                        const savedA = parseInt(a.textContent.match(/(\\d+)\\s+makers\\s+saved/i)?.[1] || '0');
                        const savedB = parseInt(b.textContent.match(/(\\d+)\\s+makers\\s+saved/i)?.[1] || '0');
                        return savedB - savedA;
                        
                    default:
                        return 0;
                }
            });
        }
        
        // Reorder visible articles in the DOM
        visibleArticles.forEach(article => {
            patternsGrid.appendChild(article);
        });
        
        // Update pattern count
        if (patternCount) {
            patternCount.textContent = visibleArticles.length;
        }
    }
    
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            if (timeFilter) timeFilter.value = 'all'; // Reset time filter when main sort is used
            updatePatterns();
        });
    }
    
    if (difficultyFilter) {
        difficultyFilter.addEventListener('change', updatePatterns);
    }
    
    if (timeFilter) {
        timeFilter.addEventListener('change', function() {
            if (sortSelect) sortSelect.value = 'newest'; // Reset main sort when time filter is used
            updatePatterns();
        });
    }
});

// Handle create pattern for guest users
function handleCreatePatternGuest() {
    if (confirm('You need to sign up to create patterns. Would you like to create an account?')) {
        window.location.href = '{{ route("register") }}';
    }
}
</script>
@endsection
