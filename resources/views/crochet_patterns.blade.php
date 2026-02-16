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
                        <p class="mt-2 text-3xl font-bold text-emerald-900 dark:text-white" id="favorites-count">{{ $favoritesCount ?? 0 }}</p>
                        <p class="text-sm text-zinc-600 dark:text-zinc-300">{{ Str::plural('Pattern', $favoritesCount ?? 0) }} ready to start.</p>
                    </div>
                    <div class="mt-4 flex items-center gap-2 text-xs font-medium text-emerald-700 dark:text-emerald-200">
                        <span class="inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                        Synced with your favourites
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
                            <article class="group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-emerald-900/40 dark:bg-zinc-900/70"
                                     data-created="{{ $pattern->created_at->timestamp }}"
                                     data-title="{{ $pattern->title }}"
                                     data-makers-saved="{{ $pattern->makers_saved ?? 0 }}">
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
                                <div class="mt-4 flex items-center justify-between">
                                    <div class="flex items-center gap-3 text-xs font-semibold text-emerald-700 dark:text-emerald-200">
                                        <span class="inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                                        <span class="makers-saved-{{ $pattern->id }}">{{ $pattern->makers_saved }}</span> users saved
                                    </div>
                                    @auth
                                        <button class="favorite-btn p-2 rounded-full transition-all duration-200 hover:scale-110 {{ Auth::user()->hasFavorited($pattern) ? 'text-pink-600 hover:text-pink-700' : 'text-zinc-400 hover:text-pink-500' }}"
                                                data-pattern-id="{{ $pattern->id }}"
                                                data-favorited="{{ Auth::user()->hasFavorited($pattern) ? 'true' : 'false' }}">
                                            <svg class="h-5 w-5 {{ Auth::user()->hasFavorited($pattern) ? 'fill-current' : '' }}" fill="{{ Auth::user()->hasFavorited($pattern) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                        </button>
                                    @endauth
                                </div>
                                @if($pattern->pdf_file)
                                    <div class="mt-5 flex gap-2">
                                        <a href="{{ route('patterns.view', $pattern->id) }}" class="flex-1 rounded-lg bg-teal-600 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-teal-700">View Pattern</a>
                                        <a href="{{ route('patterns.download', $pattern) }}" class="flex-1 rounded-lg bg-emerald-600 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-emerald-700 dark:hover:bg-emerald-500">Download PDF</a>
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
                        <select id="sortSelectAll" class="rounded-lg border border-emerald-200 bg-white px-3 py-2 text-sm font-medium text-zinc-700 transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 dark:border-emerald-800 dark:bg-zinc-800 dark:text-zinc-200">
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
                            <article class="group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-emerald-900/40 dark:bg-zinc-900/70"
                                     data-created="{{ $pattern->created_at->timestamp }}"
                                     data-title="{{ $pattern->title }}"
                                     data-makers-saved="{{ $pattern->makers_saved ?? 0 }}">
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
                                <div class="mt-4 flex items-center justify-between">
                                    <div class="flex items-center gap-3 text-xs font-semibold text-emerald-700 dark:text-emerald-200">
                                        <span class="inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                                        <span class="makers-saved-{{ $pattern->id }}">{{ $pattern->makers_saved }}</span> users saved
                                    </div>
                                    @auth
                                        <button class="favorite-btn p-2 rounded-full transition-all duration-200 hover:scale-110 {{ Auth::user()->hasFavorited($pattern) ? 'text-pink-600 hover:text-pink-700' : 'text-zinc-400 hover:text-pink-500' }}"
                                                data-pattern-id="{{ $pattern->id }}"
                                                data-favorited="{{ Auth::user()->hasFavorited($pattern) ? 'true' : 'false' }}">
                                            <svg class="h-5 w-5 {{ Auth::user()->hasFavorited($pattern) ? 'fill-current' : '' }}" fill="{{ Auth::user()->hasFavorited($pattern) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                        </button>
                                    @endauth
                                </div>
                                @if($pattern->pdf_file)
                                    <div class="mt-5 flex gap-2">
                                        <a href="{{ route('patterns.view', $pattern->id) }}" class="flex-1 rounded-lg bg-teal-600 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-teal-700">View Pattern</a>
                                        <a href="{{ route('patterns.download', $pattern) }}" class="flex-1 rounded-lg bg-emerald-600 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-emerald-700 dark:hover:bg-emerald-500">Download PDF</a>
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
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">Curated collections of patterns organized by theme, skill level, and project type.</p>
            </div>
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('collections.select-patterns') }}" class="rounded-xl bg-gradient-to-r from-teal-800 to-teal-900 px-5 py-3 text-sm font-semibold text-white shadow-lg hover:from-teal-700 hover:to-teal-800 transition-all duration-200 transform hover:scale-105">
                        <svg class="inline-block h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add Collection
                    </a>
                @else
                    <button onclick="handleCreateCollectionGuest()" class="rounded-xl bg-gradient-to-r from-teal-800 to-teal-900 px-5 py-3 text-sm font-semibold text-white shadow-lg hover:from-teal-700 hover:to-teal-800 transition-all duration-200 transform hover:scale-105">
                        <svg class="inline-block h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add Collection
                    </button>
                @endauth
                <a href="/" class="text-sm font-semibold text-zinc-600 underline-offset-4 hover:underline dark:text-zinc-300">Back to home</a>
            </div>
        </div>

        <div class="mt-8 grid gap-6 md:grid-cols-3">
            @if(isset($collections) && $collections->isNotEmpty())
                @foreach($collections as $collection)
                    <article class="group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-emerald-900/40 dark:bg-zinc-900/70" 
                             data-created="{{ $collection->created_at->timestamp }}"
                             data-title="{{ $collection->name }}">
                        @if($collection->cover_image_path)
                            <div class="mb-4 aspect-[3/4] w-full overflow-hidden rounded-xl bg-zinc-100 dark:bg-zinc-800">
                                <img src="{{ asset('storage/' . $collection->cover_image_path) }}" 
                                    alt="{{ $collection->name }}" 
                                    class="h-full w-full object-cover"
                                    loading="lazy">
                            </div>
                        @elseif($collection->patterns->isNotEmpty())
                            @php
                                $patternCount = $collection->patterns->count();
                                $patternsWithImages = $collection->patterns->filter(fn($p) => $p->image_path)->take(4);
                            @endphp
                            @if($patternsWithImages->isNotEmpty())
                                <div class="mb-4 aspect-[3/4] w-full overflow-hidden rounded-xl bg-zinc-100 dark:bg-zinc-800">
                                    <div class="grid h-full w-full grid-cols-2 grid-rows-2 gap-0.5">
                                        @if($patternsWithImages->count() === 1)
                                            {{-- Single pattern: Full span --}}
                                            <img src="{{ asset('storage/' . $patternsWithImages->first()->image_path) }}" 
                                                 alt="{{ $patternsWithImages->first()->title }}" 
                                                 class="col-span-2 row-span-2 h-full w-full object-cover"
                                                 loading="lazy">
                                        @elseif($patternsWithImages->count() === 2)
                                            {{-- Two patterns: Horizontal split --}}
                                            <img src="{{ asset('storage/' . $patternsWithImages[0]->image_path) }}" 
                                                 alt="{{ $patternsWithImages[0]->title }}" 
                                                 class="col-span-2 row-span-1 h-full w-full object-cover"
                                                 loading="lazy">
                                            <img src="{{ asset('storage/' . $patternsWithImages[1]->image_path) }}" 
                                                 alt="{{ $patternsWithImages[1]->title }}" 
                                                 class="col-span-2 row-span-1 h-full w-full object-cover"
                                                 loading="lazy">
                                        @elseif($patternsWithImages->count() === 3)
                                            {{-- Three patterns: Top large, bottom two small --}}
                                            <img src="{{ asset('storage/' . $patternsWithImages[0]->image_path) }}" 
                                                 alt="{{ $patternsWithImages[0]->title }}" 
                                                 class="col-span-2 row-span-1 h-full w-full object-cover"
                                                 loading="lazy">
                                            <img src="{{ asset('storage/' . $patternsWithImages[1]->image_path) }}" 
                                                 alt="{{ $patternsWithImages[1]->title }}" 
                                                 class="col-span-1 row-span-1 h-full w-full object-cover"
                                                 loading="lazy">
                                            <img src="{{ asset('storage/' . $patternsWithImages[2]->image_path) }}" 
                                                 alt="{{ $patternsWithImages[2]->title }}" 
                                                 class="col-span-1 row-span-1 h-full w-full object-cover"
                                                 loading="lazy">
                                        @else
                                            {{-- Four or more patterns: 2x2 grid --}}
                                            @foreach($patternsWithImages->take(4) as $pattern)
                                                <img src="{{ asset('storage/' . $pattern->image_path) }}" 
                                                     alt="{{ $pattern->title }}" 
                                                     class="col-span-1 row-span-1 h-full w-full object-cover"
                                                     loading="lazy">
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @else
                                {{-- No patterns with images: Show icon placeholder --}}
                                <div class="mb-4 aspect-[3/4] w-full overflow-hidden rounded-xl bg-gradient-to-br from-slate-200 to-slate-300 dark:from-slate-800/50 dark:to-slate-900/50 flex items-center justify-center">
                                    <svg class="h-20 w-20 text-slate-600 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                            @endif
                        @else
                            {{-- Collection is empty: Show icon placeholder --}}
                            <div class="mb-4 aspect-[3/4] w-full overflow-hidden rounded-xl bg-gradient-to-br from-slate-200 to-slate-300 dark:from-slate-800/50 dark:to-slate-900/50 flex items-center justify-center">
                                <svg class="h-20 w-20 text-slate-600 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                        @endif
                        
                        <div class="flex items-center justify-between">
                            <div class="rounded-lg px-3 py-1 text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-200">
                                {{ ucfirst($collection->craft_type ?? 'crochet') }}
                            </div>
                            <span class="text-xs font-medium text-emerald-700 dark:text-emerald-200">
                                {{ $collection->patterns->count() }} {{ Str::plural('pattern', $collection->patterns->count()) }}
                            </span>
                        </div>
                        
                        <h3 class="mt-4 text-lg font-bold text-zinc-900 dark:text-white">{{ $collection->name }}</h3>
                        
                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex items-center gap-3 text-xs font-semibold text-emerald-700 dark:text-emerald-200">
                                <span class="inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                                <span class="favorites-count-{{ $collection->id }}">{{ $collection->favorites_count }}</span> users saved
                            </div>
                            @auth
                                <button class="favorite-collection-btn p-2 rounded-full transition-all duration-200 hover:scale-110 {{ Auth::user()->hasFavoritedCollection($collection) ? 'text-pink-600 hover:text-pink-700' : 'text-zinc-400 hover:text-pink-500' }}"
                                        data-collection-id="{{ $collection->id }}"
                                        data-favorited="{{ Auth::user()->hasFavoritedCollection($collection) ? 'true' : 'false' }}">
                                    <svg class="h-5 w-5 {{ Auth::user()->hasFavoritedCollection($collection) ? 'fill-current' : '' }}" fill="{{ Auth::user()->hasFavoritedCollection($collection) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                            @endauth
                        </div>

                        <a href="{{ route('collections.show', $collection) }}" class="mt-5 block w-full rounded-lg bg-teal-600 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-teal-700">
                            View Collection
                        </a>
                    </article>
                @endforeach
            @else
                <div class="col-span-3 text-center py-12">
                    <div class="mx-auto h-16 w-16 rounded-full bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center mb-4 dark:from-slate-800/50 dark:to-slate-900/50">
                        <svg class="h-8 w-8 text-slate-600 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white">No collections yet</h3>
                    <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">Be the first to create a collection and organize your favorite patterns!</p>
                    @auth
                        <a href="{{ route('collections.select-patterns') }}" class="mt-4 inline-block rounded-lg bg-teal-800 px-4 py-2 text-sm font-semibold text-white transition hover:bg-teal-700">Create Collection</a>
                    @else
                        <button onclick="handleCreateCollectionGuest()" class="mt-4 inline-block rounded-lg bg-teal-800 px-4 py-2 text-sm font-semibold text-white transition hover:bg-teal-700">Create Collection</button>
                    @endauth
                </div>
            @endif
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded - initializing sorting');
    
    function sortPatterns() {
        console.log('sortPatterns called');
        
        // Find the patterns container - try both possible locations
        let container = document.querySelector('#patterns .mt-8.grid.gap-6.md\\:grid-cols-3');
        if (!container) {
            container = document.querySelector('.mt-8.grid.gap-6.md\\:grid-cols-3');
        }
        
        if (!container) {
            console.log('No patterns container found');
            return;
        }
        
        // Get all articles
        const articles = Array.from(container.querySelectorAll('article'));
        console.log('Found articles:', articles.length);
        
        if (articles.length === 0) {
            return;
        }
        
        // Get active visible controls
        const sortSelect = document.querySelector('#sortSelect') || document.querySelector('#sortSelectAll');
        const timeFilter = document.querySelector('#timeFilter'); // IDs are unique due to if/else
        const difficultyFilter = document.getElementById('difficultyFilter');
        
        // Log found controls
        console.log('Controls found:', {
            sort: sortSelect ? sortSelect.value : 'missing',
            time: timeFilter ? timeFilter.value : 'missing',
            difficulty: difficultyFilter ? difficultyFilter.value : 'missing'
        });
        
        // Start with all articles
        let filteredArticles = [...articles];
        
        // 1. Apply difficulty filter
        if (difficultyFilter && difficultyFilter.value !== 'all') {
            const targetDifficulty = difficultyFilter.value;
            filteredArticles = filteredArticles.filter(article => {
                const diffBadge = article.querySelector('.rounded-lg.px-3.py-1');
                if (diffBadge) {
                    const difficulty = diffBadge.textContent.trim().toLowerCase();
                    return difficulty === targetDifficulty;
                }
                return false;
            });
            console.log('After difficulty filter:', filteredArticles.length);
        }
        
        // 2. Apply sorting (Time OR Main Sort)
        // If time filter is active (not 'all'), it takes precedence or we reset main sort?
        // Logic: if time filter is used, main sort is ignored/reset (handled by listeners)
        
        if (timeFilter && timeFilter.value !== 'all') {
            const timeMode = timeFilter.value;
            console.log('Sorting by time:', timeMode);
            
            filteredArticles.sort((a, b) => {
                const getHours = (article) => {
                    const text = article.textContent || '';
                    const match = text.match(/(\d+)\s*hrs?/i);
                    return match ? parseInt(match[1]) : 999;
                };
                
                const hoursA = getHours(a);
                const hoursB = getHours(b);
                
                if (timeMode === 'shortest') {
                    return hoursA - hoursB;
                } else if (timeMode === 'longest') {
                    return hoursB - hoursA;
                }
                return 0;
            });
        } else if (sortSelect && sortSelect.value) {
            const sortMode = sortSelect.value;
            console.log('Sorting by main sort:', sortMode);
            
            filteredArticles.sort((a, b) => {
                switch (sortMode) {
                    case 'newest':
                        // data-created is timestamp
                        const dateA = parseInt(a.getAttribute('data-created') || '0');
                        const dateB = parseInt(b.getAttribute('data-created') || '0');
                        return dateB - dateA; // Descending
                        
                    case 'oldest':
                        const dateOldA = parseInt(a.getAttribute('data-created') || '0');
                        const dateOldB = parseInt(b.getAttribute('data-created') || '0');
                        return dateOldA - dateOldB; // Ascending
                        
                    case 'title-asc':
                        const titleA = (a.getAttribute('data-title') || '').toLowerCase();
                        const titleB = (b.getAttribute('data-title') || '').toLowerCase();
                        return titleA.localeCompare(titleB);
                        
                    case 'title-desc':
                        const titleDescA = (a.getAttribute('data-title') || '').toLowerCase();
                        const titleDescB = (b.getAttribute('data-title') || '').toLowerCase();
                        return titleDescB.localeCompare(titleDescA);
                        
                    case 'popular':
                         const savedA = parseInt(a.getAttribute('data-makers-saved') || '0');
                         const savedB = parseInt(b.getAttribute('data-makers-saved') || '0');
                         return savedB - savedA;
                        
                    default:
                        return 0;
                }
            });
        }
        
        // 3. Update DOM
        articles.forEach(article => article.style.display = 'none'); // Hide all original
        
        // Show filtered
        filteredArticles.forEach(article => {
            article.style.display = 'block'; // Ensure visible
            container.appendChild(article); // Move to end (reorder)
        });
        
        // Update count
        const countElement = document.getElementById('patternCount');
        if (countElement) {
            countElement.textContent = filteredArticles.length;
        }
    }
    
    // Attach Listeners
    const sortSelect = document.getElementById('sortSelect');
    const sortSelectAll = document.getElementById('sortSelectAll');
    const timeFilter = document.getElementById('timeFilter');
    const difficultyFilter = document.getElementById('difficultyFilter');
    
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            if (timeFilter) timeFilter.value = 'all'; 
            sortPatterns();
        });
    }
    
    if (sortSelectAll) {
        sortSelectAll.addEventListener('change', function() {
            if (timeFilter) timeFilter.value = 'all'; 
            sortPatterns();
        });
    }
    
    if (timeFilter) {
        timeFilter.addEventListener('change', function() {
            if (sortSelect) sortSelect.value = 'newest';
            if (sortSelectAll) sortSelectAll.value = 'newest';
            sortPatterns();
        });
    }
    
    if (difficultyFilter) {
        difficultyFilter.addEventListener('change', sortPatterns);
    }
    
    // Initial sort
    setTimeout(sortPatterns, 100);

    // Event delegation for favorite buttons
    document.addEventListener('click', function(e) {
        if (e.target.closest('.favorite-btn')) {
            e.preventDefault();
            const button = e.target.closest('.favorite-btn');
            const patternId = button.dataset.patternId;
            const isFavorited = button.dataset.favorited === 'true';
            
            // Disable button during request and add loading state
            button.disabled = true;
            button.style.opacity = '0.7';
            
            fetch(`/patterns/${patternId}/toggle-favorite`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const svg = button.querySelector('svg');
                    
                    // Add smooth transition
                    button.style.transition = 'all 0.2s ease';
                    
                    if (data.favorited) {
                        button.classList.remove('text-zinc-400', 'hover:text-pink-500');
                        button.classList.add('text-pink-600', 'hover:text-pink-700');
                        button.dataset.favorited = 'true';
                        svg.classList.add('fill-current');
                        svg.setAttribute('fill', 'currentColor');
                        
                        // Add a brief scale animation for feedback
                        button.style.transform = 'scale(1.1)';
                        setTimeout(() => {
                            button.style.transform = 'scale(1)';
                        }, 150);
                    } else {
                        button.classList.remove('text-pink-600', 'hover:text-pink-700');
                        button.classList.add('text-zinc-400', 'hover:text-pink-500');
                        button.dataset.favorited = 'false';
                        svg.classList.remove('fill-current');
                        svg.setAttribute('fill', 'none');
                    }
                    
                    // Update makers saved count with animation
                    const countSpan = document.querySelector(`.makers-saved-${patternId}`);
                    if (countSpan) {
                        countSpan.style.transition = 'all 0.2s ease';
                        countSpan.style.transform = 'scale(1.1)';
                        countSpan.textContent = data.makers_saved;
                        setTimeout(() => {
                            countSpan.style.transform = 'scale(1)';
                        }, 200);
                    }
                    
                    // Update favorites counter in the queue widget
                    const favoritesCounter = document.getElementById('favorites-count');
                    if (favoritesCounter) {
                        const currentCount = parseInt(favoritesCounter.textContent);
                        const newCount = data.favorited ? currentCount + 1 : Math.max(0, currentCount - 1);
                        favoritesCounter.style.transition = 'all 0.2s ease';
                        favoritesCounter.style.transform = 'scale(1.1)';
                        favoritesCounter.textContent = newCount;
                        
                        // Update the text below the counter
                        const counterText = favoritesCounter.parentElement.querySelector('p:nth-child(3)');
                        if (counterText) {
                            counterText.textContent = newCount === 1 ? 'Pattern ready to start.' : `${newCount} Patterns ready to start.`;
                        }
                        
                        setTimeout(() => {
                            favoritesCounter.style.transform = 'scale(1)';
                        }, 200);
                    }
                    
                    // Update data attribute for sorting
                    const article = button.closest('article');
                    if (article) {
                        article.setAttribute('data-makers-saved', data.makers_saved);
                    }
                } else {
                    alert('Error: ' + (data.message || 'Something went wrong'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Something went wrong. Please try again.');
            })
            .finally(() => {
                button.disabled = false;
                button.style.opacity = '1';
            });
        }
        
        // Handle collection favorite button clicks
        if (e.target.closest('.favorite-collection-btn')) {
            e.preventDefault();
            const button = e.target.closest('.favorite-collection-btn');
            const collectionId = button.dataset.collectionId;
            const isFavorited = button.dataset.favorited === 'true';
            
            // Disable button during request and add loading state
            button.disabled = true;
            button.style.opacity = '0.7';
            
            fetch(`/collections/${collectionId}/toggle-favorite`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const svg = button.querySelector('svg');
                    
                    // Add smooth transition
                    button.style.transition = 'all 0.2s ease';
                    
                    if (data.favorited) {
                        button.classList.remove('text-zinc-400', 'hover:text-pink-500');
                        button.classList.add('text-pink-600', 'hover:text-pink-700');
                        button.dataset.favorited = 'true';
                        svg.classList.add('fill-current');
                        svg.setAttribute('fill', 'currentColor');
                        
                        // Add a brief scale animation for feedback
                        button.style.transform = 'scale(1.1)';
                        setTimeout(() => {
                            button.style.transform = 'scale(1)';
                        }, 150);
                    } else {
                        button.classList.remove('text-pink-600', 'hover:text-pink-700');
                        button.classList.add('text-zinc-400', 'hover:text-pink-500');
                        button.dataset.favorited = 'false';
                        svg.classList.remove('fill-current');
                        svg.setAttribute('fill', 'none');
                    }
                    
                    // Update favorites count with animation
                    const countSpan = document.querySelector(`.favorites-count-${collectionId}`);
                    if (countSpan) {
                        countSpan.style.transition = 'all 0.2s ease';
                        countSpan.style.transform = 'scale(1.1)';
                        countSpan.textContent = data.favorites_count;
                        setTimeout(() => {
                            countSpan.style.transform = 'scale(1)';
                        }, 200);
                    }
                } else {
                    alert('Error: ' + (data.message || 'Something went wrong'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Something went wrong. Please try again.');
            })
            .finally(() => {
                button.disabled = false;
                button.style.opacity = '1';
            });
        }
    });
});

// Handle create pattern for guest users
function handleCreatePatternGuest() {
    if (confirm('You need to sign up to create patterns. Would you like to create an account?')) {
        window.location.href = '{{ route("register") }}';
    }
}

// Handle create collection for guest users
function handleCreateCollectionGuest() {
    if (confirm('You need to sign up to create collections. Would you like to create an account?')) {
        window.location.href = '{{ route("register") }}';
    }
}
</script>
@endsection
