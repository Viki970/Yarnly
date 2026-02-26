@extends('layout.app')

@section('title', 'Yarnly - Embroidery Patterns')

@section('content')
<style>
    /* Offset anchor links to account for fixed navbar */
    #patterns {
        scroll-margin-top: 30px;
    }
</style>

<section class="relative overflow-hidden bg-gradient-to-br from-rose-50 via-pink-50 to-fuchsia-50 py-16 dark:from-rose-950/30 dark:via-pink-950/30 dark:to-fuchsia-950/30">
    <div class="absolute -left-20 top-10 h-48 w-48 rounded-full bg-rose-300/30 blur-3xl dark:bg-rose-700/30"></div>
    <div class="absolute -right-12 bottom-10 h-64 w-64 rounded-full bg-pink-300/25 blur-3xl dark:bg-pink-700/25"></div>
    <div class="relative max-w-6xl mx-auto px-6 lg:px-12">
        <p class="inline-flex items-center gap-2 rounded-full bg-white/70 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-rose-700 ring-1 ring-rose-200 dark:bg-zinc-900/70 dark:text-rose-200 dark:ring-rose-800/60">
            Embroidery Spotlight
        </p>
        <div class="mt-6 flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div class="max-w-3xl">
                <h1 class="text-4xl font-bold tracking-tight text-rose-900 sm:text-5xl dark:text-white">Curated embroidery patterns</h1>
                <p class="mt-4 text-lg leading-relaxed text-zinc-600 dark:text-zinc-300">
                    Browse curated stitches, step-by-step project guides, and community favorites. Save patterns to your library and pick up where you left off.
                </p>
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="#collections" class="rounded-xl bg-rose-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-rose-500/25 transition hover:translate-y-[-1px] hover:shadow-rose-500/35">Browse patterns</a>
                </div>
            </div>
            <div class="grid w-full max-w-md grid-cols-2 gap-4 rounded-2xl bg-white/80 p-4 shadow-xl ring-1 ring-rose-100 backdrop-blur dark:bg-zinc-900/70 dark:ring-rose-900/40">
                <div class="rounded-xl bg-gradient-to-br from-rose-500 to-pink-500 p-4 text-white shadow-lg">
                    <p class="text-sm font-medium">New this week</p>
                    <p class="mt-3 text-2xl font-bold">{{ $newThisWeek ?? 0 }} {{ Str::plural('pattern', $newThisWeek ?? 0) }}</p>
                    <p class="mt-1 text-sm text-rose-100">Fresh patterns ready to start.</p>
                </div>
                <div class="flex flex-col justify-between rounded-xl bg-white p-4 ring-1 ring-rose-100 dark:bg-zinc-800 dark:ring-rose-900/50">
                    <div>
                        <p class="text-sm font-semibold text-rose-800 dark:text-rose-100">Your queue</p>
                        <p class="mt-2 text-3xl font-bold text-rose-900 dark:text-white" id="favorites-count">{{ $favoritesCount ?? 0 }}</p>
                        <p class="text-sm text-zinc-600 dark:text-zinc-300">{{ Str::plural('Pattern', $favoritesCount ?? 0) }} ready to start.</p>
                    </div>
                    <div class="mt-4 flex items-center gap-2 text-xs font-medium text-rose-700 dark:text-rose-200">
                        <span class="inline-flex h-2 w-2 rounded-full bg-rose-500"></span>
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
                <p class="text-sm font-semibold text-rose-700 dark:text-rose-200">Pick your lane</p>
                <h2 class="text-3xl font-bold text-zinc-900 dark:text-white">What embroidery are you into?</h2>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">Jump straight to the style you want. Each option links to curated picks below.</p>
            </div>
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('patterns.create') }}" 
                        class="rounded-xl bg-gradient-to-r from-rose-600 to-pink-600 px-5 py-3 text-sm font-semibold text-white shadow-lg hover:from-rose-500 hover:to-pink-500 transition-all duration-200 transform hover:scale-105">
                        <svg class="inline-block h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Create Pattern
                    </a>
                @else
                    <button onclick="handleCreatePatternGuest()" 
                        class="rounded-xl bg-gradient-to-r from-rose-600 to-pink-600 px-5 py-3 text-sm font-semibold text-white shadow-lg hover:from-rose-500 hover:to-pink-500 transition-all duration-200 transform hover:scale-105">
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
            <a href="{{ route('patterns.embroidery') }}#patterns" class="rounded-full border @if(!$selectedCategory) border-rose-500 bg-rose-50 text-rose-900 dark:border-rose-400 dark:bg-rose-900/30 dark:text-rose-100 @else border-rose-200 bg-white text-rose-800 dark:border-rose-900/50 dark:bg-zinc-900 dark:text-rose-100 @endif px-4 py-2 text-sm font-semibold transition hover:-translate-y-0.5 hover:shadow-sm">All</a>
            <a href="{{ route('patterns.embroidery.category', 'clothing-embroidery') }}#patterns" class="rounded-full border @if($selectedCategory === 'clothing-embroidery') border-rose-500 bg-rose-50 text-rose-900 dark:border-rose-400 dark:bg-rose-900/30 dark:text-rose-100 @else border-rose-200 bg-white text-rose-800 dark:border-rose-900/50 dark:bg-zinc-900 dark:text-rose-100 @endif px-4 py-2 text-sm font-semibold transition hover:-translate-y-0.5 hover:shadow-sm">Clothing Embroidery</a>
            <a href="{{ route('patterns.embroidery.category', 'hoop-art-wall-decor') }}#patterns" class="rounded-full border @if($selectedCategory === 'hoop-art-wall-decor') border-rose-500 bg-rose-50 text-rose-900 dark:border-rose-400 dark:bg-rose-900/30 dark:text-rose-100 @else border-rose-200 bg-white text-rose-800 dark:border-rose-900/50 dark:bg-zinc-900 dark:text-rose-100 @endif px-4 py-2 text-sm font-semibold transition hover:-translate-y-0.5 hover:shadow-sm">Hoop Art &amp; Wall Decor</a>
            <a href="{{ route('patterns.embroidery.category', 'cross-stitch') }}#patterns" class="rounded-full border @if($selectedCategory === 'cross-stitch') border-rose-500 bg-rose-50 text-rose-900 dark:border-rose-400 dark:bg-rose-900/30 dark:text-rose-100 @else border-rose-200 bg-white text-rose-800 dark:border-rose-900/50 dark:bg-zinc-900 dark:text-rose-100 @endif px-4 py-2 text-sm font-semibold transition hover:-translate-y-0.5 hover:shadow-sm">Cross Stitch</a>
            <a href="{{ route('patterns.embroidery.category', 'hand-techniques') }}#patterns" class="rounded-full border @if($selectedCategory === 'hand-techniques') border-rose-500 bg-rose-50 text-rose-900 dark:border-rose-400 dark:bg-rose-900/30 dark:text-rose-100 @else border-rose-200 bg-white text-rose-800 dark:border-rose-900/50 dark:bg-zinc-900 dark:text-rose-100 @endif px-4 py-2 text-sm font-semibold transition hover:-translate-y-0.5 hover:shadow-sm">Hand Techniques</a>
        </div>

        @if($selectedCategory)
            <!-- Show patterns for selected category -->
            <div id="patterns" class="mt-12">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h3 class="mt-1 text-2xl font-bold text-zinc-900 dark:text-white">{{ ucfirst(str_replace('-', ' ', $selectedCategory)) }} patterns</h3>
                    </div>
                    <a href="{{ route('patterns.embroidery') }}" class="text-sm font-semibold text-rose-700 underline-offset-4 hover:underline dark:text-rose-200">View all</a>
                </div>
                
                <!-- Sorting Controls -->
                <div class="mt-6 flex flex-wrap items-center justify-between gap-4">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="text-sm font-medium text-zinc-600 dark:text-zinc-300">Sort by:</span>
                        <select id="sortSelect" class="rounded-lg border border-rose-200 bg-white px-3 py-2 text-sm font-medium text-zinc-700 transition focus:border-rose-500 focus:outline-none focus:ring-2 focus:ring-rose-500/20 dark:border-rose-800 dark:bg-zinc-800 dark:text-zinc-200">
                            <option value="newest">Newest first</option>
                            <option value="oldest">Oldest first</option>
                            <option value="title-asc">Title A-Z</option>
                            <option value="title-desc">Title Z-A</option>
                            <option value="popular">Most popular</option>
                        </select>
                        
                        <span class="text-sm font-medium text-zinc-600 dark:text-zinc-300">Time:</span>
                        <select id="timeFilter" class="rounded-lg border border-rose-200 bg-white px-3 py-2 text-sm font-medium text-zinc-700 transition focus:border-rose-500 focus:outline-none focus:ring-2 focus:ring-rose-500/20 dark:border-rose-800 dark:bg-zinc-800 dark:text-zinc-200">
                            <option value="all">All times</option>
                            <option value="shortest">Shortest first</option>
                            <option value="longest">Longest first</option>
                        </select>
                        
                        <span class="text-sm font-medium text-zinc-600 dark:text-zinc-300">Difficulty:</span>
                        <select id="difficultyFilter" class="rounded-lg border border-rose-200 bg-white px-3 py-2 text-sm font-medium text-zinc-700 transition focus:border-rose-500 focus:outline-none focus:ring-2 focus:ring-rose-500/20 dark:border-rose-800 dark:bg-zinc-800 dark:text-zinc-200">
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
                            <article class="group rounded-2xl border border-rose-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-rose-900/40 dark:bg-zinc-900/70"
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
                                @else
                                    <div class="mb-4 aspect-[3/4] w-full overflow-hidden rounded-xl bg-gradient-to-br from-rose-100 to-pink-100 dark:from-rose-950/40 dark:to-pink-950/40 flex flex-col items-center justify-center gap-3">
                                        <svg class="h-16 w-16 text-rose-300 dark:text-rose-700" fill="currentColor" viewBox="0 0 274 274">
                                            <path d="M262.353,170.603c-0.792-2.288-19.578-56.177-45.5-69.878c-1.554-0.818-3.18-1.652-4.847-2.501c7.783-26.139,10.299-47.996,5.188-66.953c-4.981-18.491-22.059-32.213-38.856-31.219c-14.794,0.865-25.295,12.718-28.097,31.701c-0.88,5.965-0.834,11.387-0.171,16.43c-3.469,4.836-5.841,9.036-6.543,10.325L13.143,266.149c-0.997,1.579-2.231,3.547-0.955,5.872l1.229,2.206h2.509c2.201,0,3.379-1.476,4.513-2.895L170.42,83.093c9.569,8.114,21.034,14.245,31.375,19.49c-4.635,14.333-10.776,30.049-18.046,47.328c-19.957,47.483-10.657,86.687,3.401,95.64c0.705,0.451,1.492,0.663,2.279,0.663c1.402,0,2.77-0.694,3.583-1.968c1.248-1.973,0.673-4.604-1.305-5.852c-9.896-6.302-18.662-41.109-0.135-85.19c7.13-16.953,13.204-32.467,17.875-46.753c1.186,0.605,2.34,1.201,3.453,1.786c22.96,12.138,41.26,64.612,41.436,65.136c0.767,2.217,3.18,3.392,5.396,2.631C261.934,175.227,263.115,172.814,262.353,170.603z M153.986,80.063l-8.353,6.902l3.299-10.325c0.973-3.024,2.791-8.383,5.203-14.131c1.885,4.085,4.272,7.819,7.048,11.236C157.973,76.713,155.27,79.002,153.986,80.063z M167.345,67.781c-3.671-4.722-6.426-10.077-7.954-16.181c4.106-7.322,9.021-13.241,14.209-13.241c1.435,0,2.817,0.409,4.096,1.222c2.123,1.341,3.319,3.365,3.48,5.851C181.564,51.579,174.481,60.464,167.345,67.781z M204.333,94.345c-9.823-5.007-20.164-10.651-28.589-17.891c5.634-7.28,16.669-23.229,15.198-34.932c-0.513-4.096-2.517-7.482-5.789-9.792c-2.714-1.9-5.686-2.874-8.839-2.874c-6.551,0-12.868,4.339-18.201,9.704c0.083-1.802,0.232-3.646,0.518-5.571c2.2-14.934,9.569-23.855,20.205-24.477c0.378-0.021,0.771-0.037,1.16-0.037c11.143,0,24.72,9.088,29.013,24.995C213.57,50.414,211.343,70.354,204.333,94.345z"/>
                                        </svg>
                                        <span class="text-sm font-semibold text-rose-400 dark:text-rose-600">No image yet</span>
                                    </div>
                                @endif
                                <div class="flex items-center justify-between">
                                    <div class="rounded-lg px-3 py-1 text-xs font-semibold @if($pattern->difficulty === 'beginner') bg-rose-100 text-rose-800 dark:bg-rose-900/40 dark:text-rose-200 @elseif($pattern->difficulty === 'intermediate') bg-pink-100 text-pink-800 dark:bg-pink-900/40 dark:text-pink-200 @else bg-orange-100 text-orange-800 dark:bg-orange-900/40 dark:text-orange-200 @endif">
                                        {{ ucfirst($pattern->difficulty) }}
                                    </div>
                                    @if($pattern->estimated_hours)
                                        <span class="text-xs font-medium text-rose-700 dark:text-rose-200">≈ {{ $pattern->estimated_hours }} hrs</span>
                                    @endif
                                </div>
                                <h3 class="mt-4 text-lg font-bold text-zinc-900 dark:text-white">{{ $pattern->title }}</h3>
                                @if($pattern->user)
                                    <p class="mt-1 flex items-center gap-1 text-xs text-zinc-400 dark:text-zinc-500">
                                        <svg class="h-3.5 w-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        <span>{{ $pattern->user->name }}</span>
                                    </p>
                                @endif
                                <div class="mt-4 flex items-center justify-between">
                                    <div class="flex items-center gap-3 text-xs font-semibold text-rose-700 dark:text-rose-200">
                                        <span class="inline-flex h-2 w-2 rounded-full bg-rose-500"></span>
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
                                        <a href="{{ route('patterns.view', $pattern->id) }}" class="flex-1 rounded-lg bg-pink-600 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-pink-700">View Pattern</a>
                                        <a href="{{ route('patterns.download', $pattern) }}" class="flex-1 rounded-lg bg-rose-600 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-rose-700 dark:hover:bg-rose-500">Download PDF</a>
                                    </div>
                                @else
                                    <button disabled class="mt-5 block w-full rounded-lg bg-zinc-200 px-4 py-2 text-center text-sm font-semibold text-zinc-500 cursor-not-allowed dark:bg-zinc-700 dark:text-zinc-400">PDF Coming Soon</button>
                                @endif
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="mt-8 rounded-2xl border border-dashed border-rose-200 bg-rose-50 p-12 text-center dark:border-rose-900/40 dark:bg-zinc-900/70">
                        <h3 class="text-lg font-bold text-rose-900 dark:text-white">No patterns yet</h3>
                        <p class="mt-2 text-sm text-rose-700 dark:text-rose-300">More {{ str_replace('-', ' ', $selectedCategory) }} patterns coming soon!</p>
                        <a href="{{ route('patterns.embroidery') }}" class="mt-4 inline-block rounded-lg bg-rose-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-rose-700">View all categories</a>
                    </div>
                @endif
            </div>
        @else
            <!-- Show newest patterns when no category is selected -->
            <div id="patterns" class="mt-12">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h3 class="mt-1 text-2xl font-bold text-zinc-900 dark:text-white">Newest embroidery patterns</h3>
                    </div>
                </div>
                
                <!-- Sorting Controls -->
                <div class="mt-6 flex flex-wrap items-center justify-between gap-4">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="text-sm font-medium text-zinc-600 dark:text-zinc-300">Sort by:</span>
                        <select id="sortSelectAll" class="rounded-lg border border-rose-200 bg-white px-3 py-2 text-sm font-medium text-zinc-700 transition focus:border-rose-500 focus:outline-none focus:ring-2 focus:ring-rose-500/20 dark:border-rose-800 dark:bg-zinc-800 dark:text-zinc-200">
                            <option value="newest">Newest first</option>
                            <option value="oldest">Oldest first</option>
                            <option value="title-asc">Title A-Z</option>
                            <option value="title-desc">Title Z-A</option>
                            <option value="popular">Most popular</option>
                        </select>
                        
                        <span class="text-sm font-medium text-zinc-600 dark:text-zinc-300">Time:</span>
                        <select id="timeFilter" class="rounded-lg border border-rose-200 bg-white px-3 py-2 text-sm font-medium text-zinc-700 transition focus:border-rose-500 focus:outline-none focus:ring-2 focus:ring-rose-500/20 dark:border-rose-800 dark:bg-zinc-800 dark:text-zinc-200">
                            <option value="all">All times</option>
                            <option value="shortest">Shortest first</option>
                            <option value="longest">Longest first</option>
                        </select>
                        
                        <span class="text-sm font-medium text-zinc-600 dark:text-zinc-300">Difficulty:</span>
                        <select id="difficultyFilter" class="rounded-lg border border-rose-200 bg-white px-3 py-2 text-sm font-medium text-zinc-700 transition focus:border-rose-500 focus:outline-none focus:ring-2 focus:ring-rose-500/20 dark:border-rose-800 dark:bg-zinc-800 dark:text-zinc-200">
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
                            <article class="group rounded-2xl border border-rose-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-rose-900/40 dark:bg-zinc-900/70"
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
                                @else
                                    <div class="mb-4 aspect-[3/4] w-full overflow-hidden rounded-xl bg-gradient-to-br from-rose-100 to-pink-100 dark:from-rose-950/40 dark:to-pink-950/40 flex flex-col items-center justify-center gap-3">
                                        <svg class="h-16 w-16 text-rose-300 dark:text-rose-700" fill="currentColor" viewBox="0 0 274 274">
                                            <path d="M262.353,170.603c-0.792-2.288-19.578-56.177-45.5-69.878c-1.554-0.818-3.18-1.652-4.847-2.501c7.783-26.139,10.299-47.996,5.188-66.953c-4.981-18.491-22.059-32.213-38.856-31.219c-14.794,0.865-25.295,12.718-28.097,31.701c-0.88,5.965-0.834,11.387-0.171,16.43c-3.469,4.836-5.841,9.036-6.543,10.325L13.143,266.149c-0.997,1.579-2.231,3.547-0.955,5.872l1.229,2.206h2.509c2.201,0,3.379-1.476,4.513-2.895L170.42,83.093c9.569,8.114,21.034,14.245,31.375,19.49c-4.635,14.333-10.776,30.049-18.046,47.328c-19.957,47.483-10.657,86.687,3.401,95.64c0.705,0.451,1.492,0.663,2.279,0.663c1.402,0,2.77-0.694,3.583-1.968c1.248-1.973,0.673-4.604-1.305-5.852c-9.896-6.302-18.662-41.109-0.135-85.19c7.13-16.953,13.204-32.467,17.875-46.753c1.186,0.605,2.34,1.201,3.453,1.786c22.96,12.138,41.26,64.612,41.436,65.136c0.767,2.217,3.18,3.392,5.396,2.631C261.934,175.227,263.115,172.814,262.353,170.603z M153.986,80.063l-8.353,6.902l3.299-10.325c0.973-3.024,2.791-8.383,5.203-14.131c1.885,4.085,4.272,7.819,7.048,11.236C157.973,76.713,155.27,79.002,153.986,80.063z M167.345,67.781c-3.671-4.722-6.426-10.077-7.954-16.181c4.106-7.322,9.021-13.241,14.209-13.241c1.435,0,2.817,0.409,4.096,1.222c2.123,1.341,3.319,3.365,3.48,5.851C181.564,51.579,174.481,60.464,167.345,67.781z M204.333,94.345c-9.823-5.007-20.164-10.651-28.589-17.891c5.634-7.28,16.669-23.229,15.198-34.932c-0.513-4.096-2.517-7.482-5.789-9.792c-2.714-1.9-5.686-2.874-8.839-2.874c-6.551,0-12.868,4.339-18.201,9.704c0.083-1.802,0.232-3.646,0.518-5.571c2.2-14.934,9.569-23.855,20.205-24.477c0.378-0.021,0.771-0.037,1.16-0.037c11.143,0,24.72,9.088,29.013,24.995C213.57,50.414,211.343,70.354,204.333,94.345z"/>
                                        </svg>
                                        <span class="text-sm font-semibold text-rose-400 dark:text-rose-600">No image yet</span>
                                    </div>
                                @endif
                                <div class="flex items-center justify-between">
                                    <div class="rounded-lg px-3 py-1 text-xs font-semibold @if($pattern->difficulty === 'beginner') bg-rose-100 text-rose-800 dark:bg-rose-900/40 dark:text-rose-200 @elseif($pattern->difficulty === 'intermediate') bg-pink-100 text-pink-800 dark:bg-pink-900/40 dark:text-pink-200 @else bg-orange-100 text-orange-800 dark:bg-orange-900/40 dark:text-orange-200 @endif">
                                        {{ ucfirst($pattern->difficulty) }}
                                    </div>
                                    @if($pattern->estimated_hours)
                                        <span class="text-xs font-medium text-rose-700 dark:text-rose-200">≈ {{ $pattern->estimated_hours }} hrs</span>
                                    @endif
                                </div>
                                <h3 class="mt-4 text-lg font-bold text-zinc-900 dark:text-white">{{ $pattern->title }}</h3>
                                @if($pattern->user)
                                    <p class="mt-1 flex items-center gap-1 text-xs text-zinc-400 dark:text-zinc-500">
                                        <svg class="h-3.5 w-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        <span>{{ $pattern->user->name }}</span>
                                    </p>
                                @endif
                                <div class="mt-4 flex items-center justify-between">
                                    <div class="flex items-center gap-3 text-xs font-semibold text-rose-700 dark:text-rose-200">
                                        <span class="inline-flex h-2 w-2 rounded-full bg-rose-500"></span>
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
                                        <a href="{{ route('patterns.view', $pattern->id) }}" class="flex-1 rounded-lg bg-pink-600 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-pink-700">View Pattern</a>
                                        <a href="{{ route('patterns.download', $pattern) }}" class="flex-1 rounded-lg bg-rose-600 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-rose-700 dark:hover:bg-rose-500">Download PDF</a>
                                    </div>
                                @else
                                    <button disabled class="mt-5 block w-full rounded-lg bg-zinc-200 px-4 py-2 text-center text-sm font-semibold text-zinc-500 cursor-not-allowed dark:bg-zinc-700 dark:text-zinc-400">PDF Coming Soon</button>
                                @endif
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="mt-8 rounded-2xl border border-dashed border-rose-200 bg-rose-50 p-12 text-center dark:border-rose-900/40 dark:bg-zinc-900/70">
                        <h3 class="text-lg font-bold text-rose-900 dark:text-white">No patterns yet</h3>
                        <p class="mt-2 text-sm text-rose-700 dark:text-rose-300">New patterns will appear here soon!</p>
                    </div>
                @endif
            </div>
        @endif
    </div>
</section>



<section id="collections" class="bg-gradient-to-br from-rose-50 via-white to-pink-50 py-14 dark:from-rose-950/20 dark:via-zinc-900 dark:to-pink-950/20">
    <div class="max-w-6xl mx-auto px-6 lg:px-12">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-rose-700 dark:text-rose-200">Community sets</p>
                <h2 class="text-3xl font-bold text-zinc-900 dark:text-white">Collections you can start tonight</h2>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">Curated collections of patterns organized by theme, skill level, and project type.</p>
            </div>
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('collections.select-patterns') }}" class="rounded-xl bg-gradient-to-r from-rose-800 to-rose-900 px-5 py-3 text-sm font-semibold text-white shadow-lg hover:from-rose-700 hover:to-rose-800 transition-all duration-200 transform hover:scale-105">
                        <svg class="inline-block h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add Collection
                    </a>
                @else
                    <button onclick="handleCreateCollectionGuest()" class="rounded-xl bg-gradient-to-r from-rose-800 to-rose-900 px-5 py-3 text-sm font-semibold text-white shadow-lg hover:from-rose-700 hover:to-rose-800 transition-all duration-200 transform hover:scale-105">
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
                    <article class="group rounded-2xl border border-rose-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-rose-900/40 dark:bg-zinc-900/70" 
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
                            <div class="rounded-lg px-3 py-1 text-xs font-semibold bg-rose-100 text-rose-800 dark:bg-rose-900/40 dark:text-rose-200">
                                {{ ucfirst($collection->craft_type ?? 'embroidery') }}
                            </div>
                            <span class="text-xs font-medium text-rose-700 dark:text-rose-200">
                                {{ $collection->patterns->count() }} {{ Str::plural('pattern', $collection->patterns->count()) }}
                            </span>
                        </div>
                        
                        <h3 class="mt-4 text-lg font-bold text-zinc-900 dark:text-white">{{ $collection->name }}</h3>
                        @if($collection->user)
                            <p class="mt-1 flex items-center gap-1 text-xs text-zinc-400 dark:text-zinc-500">
                                <svg class="h-3.5 w-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span>{{ $collection->user->name }}</span>
                            </p>
                        @endif
                        
                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex items-center gap-3 text-xs font-semibold text-rose-700 dark:text-rose-200">
                                <span class="inline-flex h-2 w-2 rounded-full bg-rose-500"></span>
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

                        <a href="{{ route('collections.show', $collection) }}" class="mt-5 block w-full rounded-lg bg-rose-600 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-rose-700">
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
                        <a href="{{ route('collections.select-patterns') }}" class="mt-4 inline-block rounded-lg bg-rose-800 px-4 py-2 text-sm font-semibold text-white transition hover:bg-rose-700">Create Collection</a>
                    @else
                        <button onclick="handleCreateCollectionGuest()" class="mt-4 inline-block rounded-lg bg-rose-800 px-4 py-2 text-sm font-semibold text-white transition hover:bg-rose-700">Create Collection</button>
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
        const timeFilter = document.querySelector('#timeFilter');
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
                        const dateA = parseInt(a.getAttribute('data-created') || '0');
                        const dateB = parseInt(b.getAttribute('data-created') || '0');
                        return dateB - dateA;
                        
                    case 'oldest':
                        const dateOldA = parseInt(a.getAttribute('data-created') || '0');
                        const dateOldB = parseInt(b.getAttribute('data-created') || '0');
                        return dateOldA - dateOldB;
                        
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
        articles.forEach(article => article.style.display = 'none');
        
        filteredArticles.forEach(article => {
            article.style.display = 'block';
            container.appendChild(article);
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
                    
                    button.style.transition = 'all 0.2s ease';
                    
                    if (data.favorited) {
                        button.classList.remove('text-zinc-400', 'hover:text-pink-500');
                        button.classList.add('text-pink-600', 'hover:text-pink-700');
                        button.dataset.favorited = 'true';
                        svg.classList.add('fill-current');
                        svg.setAttribute('fill', 'currentColor');
                        
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
                    
                    button.style.transition = 'all 0.2s ease';
                    
                    if (data.favorited) {
                        button.classList.remove('text-zinc-400', 'hover:text-pink-500');
                        button.classList.add('text-pink-600', 'hover:text-pink-700');
                        button.dataset.favorited = 'true';
                        svg.classList.add('fill-current');
                        svg.setAttribute('fill', 'currentColor');
                        
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
