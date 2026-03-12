@extends('layout.app')

@section('title', 'Yarnly - Models Gallery')

@section('content')
<style>
    #gallery-feed { scroll-margin-top: 30px; }

    .post-card {
        animation: fadeInUp 0.4s ease both;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .tab-btn:hover:not(.text-white) {
        background: #f3e8ff;
        color: #7c3aed;
    }
    .dark .tab-btn:hover:not(.text-white) {
        background: rgba(109,40,217,0.15);
        color: #c4b5fd;
    }

    /* Heart animation */
    .heart-btn.liked svg {
        fill: #ef4444;
        stroke: #ef4444;
    }
    .heart-btn:active svg {
        transform: scale(1.35);
        transition: transform 0.12s ease;
    }

    /* Masonry-style columns */
    .gallery-columns {
        columns: 1;
        column-gap: 1.25rem;
    }
    @media (min-width: 640px)  { .gallery-columns { columns: 2; } }
    @media (min-width: 1024px) { .gallery-columns { columns: 3; } }

    .gallery-item {
        break-inside: avoid;
        margin-bottom: 1.25rem;
    }

    /* Skeleton loader */
    .skeleton { animation: shimmer 1.4s infinite; background: linear-gradient(90deg, #e5e7eb 25%, #f3f4f6 50%, #e5e7eb 75%); background-size: 200% 100%; }
    .dark .skeleton { background: linear-gradient(90deg, #27272a 25%, #3f3f46 50%, #27272a 75%); background-size: 200% 100%; }
    @keyframes shimmer { to { background-position: -200% 0; } }

    /* Hide scrollbar on tab strip */
    .scrollbar-hide { scrollbar-width: none; }
    .scrollbar-hide::-webkit-scrollbar { display: none; }

    /* Mobile inline comments animation */
    .mc-section { animation: fadeInDown 0.2s ease both; }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-6px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ── Mobile post-detail modal ─────────────────── */
    @media (max-width: 767px) {
        #gal-post-modal {
            padding: 0 !important;
            align-items: stretch;
        }
        #gal-post-modal .gal-modal-inner {
            max-height: 100dvh;
            max-height: 100vh;
            border-radius: 0 !important;
        }
        #gal-post-modal .gal-image-panel {
            height: 45vh !important;
            min-height: 0 !important;
            max-height: 45vh !important;
        }
        #gal-post-modal .gal-detail-panel {
            max-height: 55vh !important;
            flex: 1 1 auto;
        }
    }

    /* ── Reply buttons: always visible on touch devices ── */
    @media (hover: none) and (pointer: coarse) {
        .group\/comment .reply-btn {
            opacity: 0.6 !important;
        }
    }
</style>

@php
$galleryPostData = [];
$allGalleryModels = collect();

if (isset($recentModels)) {
    foreach ($recentModels->items() as $m) { $allGalleryModels->put($m->id, $m); }
}
if (isset($topRatedModels)) {
    foreach ($topRatedModels->items() as $m) {
        if (!$allGalleryModels->has($m->id)) $allGalleryModels->put($m->id, $m);
    }
}
if (isset($followingModels) && $followingModels) {
    foreach ($followingModels->items() as $m) {
        if (!$allGalleryModels->has($m->id)) $allGalleryModels->put($m->id, $m);
    }
}

foreach ($allGalleryModels as $model) {
    $imgs = [];
    if (!empty($model->images) && $model->images->count()) {
        $imgs = $model->images->map(fn($i) => asset('storage/'.$i->image_path))->values()->all();
    } elseif ($model->image_url ?? null) {
        $imgs = [$model->image_url];
    } elseif ($model->cover_image ?? null) {
        $imgs = [asset('storage/'.$model->cover_image)];
    }

    $galleryPostData[$model->id] = [
        'id'          => $model->id,
        'images'      => $imgs,
        'description' => $model->description ?? '',
        'craft_type'  => $model->craft_type ?? ($model->type ?? 'crochet'),
        'tags'        => method_exists($model, 'getTagsArrayAttribute') ? $model->tags_array : [],
        'likes_count' => $model->likes_count ?? 0,
        'author'      => $model->user->name ?? 'Anonymous',
        'initials'    => strtoupper(substr($model->user->name ?? 'A', 0, 1)),
        'created_at'  => $model->created_at->diffForHumans(),
        'is_liked'    => (bool)($model->liked_by_user ?? false),
        'is_faved'    => (bool)($model->faved_by_user ?? false),
        'like_url'       => route('posts.like',           $model->id),
        'unlike_url'     => route('posts.unlike',         $model->id),
        'fav_url'        => route('posts.favorite',       $model->id),
        'unfav_url'      => route('posts.unfavorite',     $model->id),
        'comments_count' => $model->comments_count ?? 0,
        'comments_url'   => route('posts.comments',       $model->id),
        'comment_url'    => route('posts.comments.store', $model->id),
    ];
}
@endphp

<!-- ─── Hero ─── -->
<section class="relative overflow-hidden bg-gradient-to-br from-purple-950 via-violet-950 to-indigo-950 py-8 sm:py-14">
    <div class="absolute -left-20 top-0 h-72 w-72 rounded-full bg-purple-600/20 blur-3xl"></div>
    <div class="absolute -right-16 bottom-0 h-72 w-72 rounded-full bg-violet-600/20 blur-3xl"></div>
    <div class="absolute left-1/2 top-1/2 h-96 w-96 -translate-x-1/2 -translate-y-1/2 rounded-full bg-purple-500/10 blur-3xl"></div>

    <div class="relative max-w-3xl mx-auto px-6 lg:px-12 text-center">

        {{-- Headline --}}
        <h1 class="text-2xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-5xl">
            Discover what crafters <br class="hidden sm:block">are making right now
        </h1>
        <p class="mt-3 text-sm sm:text-base text-purple-200/70">
            {{ $totalModels ?? 0 }} models shared &middot; {{ $newToday ?? 0 }} new today
            <span class="inline-flex items-center gap-1 ml-2">
                <span class="inline-flex h-1.5 w-1.5 rounded-full bg-green-400 animate-pulse"></span>
                <span class="text-green-400 text-xs font-medium">live</span>
            </span>
        </p>

        {{-- Search bar --}}
        <div class="mt-8 flex items-center gap-2 rounded-2xl bg-white/10 px-4 py-3 ring-1 ring-white/15 backdrop-blur focus-within:ring-purple-400/60 transition-all duration-200">
            <svg class="h-5 w-5 shrink-0 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input
                type="text"
                id="gallery-search"
                name="q"
                value="{{ $search ?? '' }}"
                placeholder="Search models, crafters, tags…"
                class="w-full bg-transparent text-sm text-white placeholder-purple-300/60 outline-none"
                onkeydown="if(event.key==='Enter'){event.preventDefault();galSearch(this.value);}"
                oninput="document.getElementById('gal-search-clear').classList.toggle('hidden', this.value.trim()==='');"
            >
            @if(!empty($search))
            <button id="gal-search-clear"
                    onclick="galSearch('')"
                    class="shrink-0 text-purple-300/70 hover:text-white transition-colors"
                    title="Clear search">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            @else
            <button id="gal-search-clear"
                    onclick="galSearch(document.getElementById('gallery-search').value)"
                    class="hidden shrink-0 text-purple-300/70 hover:text-white transition-colors"
                    title="Clear search">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            @endif
        </div>

        {{-- Trending tags --}}
        <div class="mt-5 flex flex-wrap items-center justify-center gap-2">
            <span class="text-xs font-semibold text-purple-400 uppercase tracking-wide">Trending:</span>
            @foreach(['amigurumi', 'blanket', 'sweater', 'cross-stitch', 'beanie', 'tote-bag'] as $tag)
                <button
                    onclick="galSearch('{{ $tag }}')"
                    class="rounded-full px-3 py-1 text-xs font-medium ring-1 transition-all duration-200
                        {{ ($search ?? '') === $tag
                            ? 'bg-purple-500/60 text-white ring-purple-400/70'
                            : 'bg-white/10 text-purple-200 ring-white/10 hover:bg-purple-500/30 hover:text-white hover:ring-purple-400/50' }}">
                    #{{ $tag }}
                </button>
            @endforeach
        </div>

    </div>
</section>

<!-- ─── Sticky tab bar ─── -->
<div id="gallery-feed" class="sticky top-[65px] z-40 border-b border-zinc-200/80 bg-white/90 backdrop-blur dark:border-zinc-800/70 dark:bg-zinc-900/90">
    <div class="max-w-6xl mx-auto px-3 sm:px-6 lg:px-12">
        <div class="flex items-center justify-between py-2 sm:py-3 gap-2 sm:gap-4">

            <!-- Sliding pill tabs -->
            <div class="relative flex items-center gap-1 rounded-xl bg-zinc-100/80 p-1 dark:bg-zinc-800/60 overflow-x-auto scrollbar-hide flex-1 sm:flex-none min-w-0" id="tab-bar">
                {{-- Sliding pill background --}}
                <div id="tab-pill"
                     class="absolute top-1 bottom-1 rounded-lg bg-gradient-to-r from-purple-600 to-violet-600 shadow-md shadow-purple-500/30 transition-all duration-300 ease-in-out pointer-events-none"
                     style="left:4px;"></div>

                <button
                    onclick="switchTab('recently-added')"
                    id="tab-recently-added"
                    class="tab-btn relative z-10 flex items-center gap-1.5 rounded-lg px-2.5 sm:px-4 py-2 text-xs sm:text-sm font-semibold transition-colors duration-200 text-white whitespace-nowrap">
                    <svg class="h-4 w-4 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Recently Added
                </button>
                <button
                    onclick="switchTab('top-rated')"
                    id="tab-top-rated"
                    class="tab-btn relative z-10 flex items-center gap-1.5 rounded-lg px-2.5 sm:px-4 py-2 text-xs sm:text-sm font-semibold transition-colors duration-200 text-zinc-500 dark:text-zinc-400 whitespace-nowrap">
                    <svg class="h-4 w-4 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                    Top Rated
                </button>
                <button
                    onclick="switchTab('following')"
                    id="tab-following"
                    class="tab-btn relative z-10 flex items-center gap-1.5 rounded-lg px-2.5 sm:px-4 py-2 text-xs sm:text-sm font-semibold transition-colors duration-200 text-zinc-500 dark:text-zinc-400 whitespace-nowrap">
                    <svg class="h-4 w-4 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Following
                </button>
            </div>

            <!-- Create button -->
            @auth
                <a href="{{ route('posts.create') }}"
                   class="flex-shrink-0 flex items-center gap-2 rounded-xl bg-gradient-to-r from-purple-600 to-violet-600 px-2.5 sm:px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-purple-500/25 transition-all duration-200 hover:from-purple-500 hover:to-violet-500 hover:scale-105">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span class="hidden sm:inline">Share Post</span>
                </a>
            @else
                <button onclick="openLoginModal()"
                   class="flex-shrink-0 flex items-center gap-2 rounded-xl bg-gradient-to-r from-purple-600 to-violet-600 px-2.5 sm:px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-purple-500/25 transition-all duration-200 hover:from-purple-500 hover:to-violet-500 hover:scale-105">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span class="hidden sm:inline">Share Post</span>
                </button>
            @endauth
        </div>
    </div>
</div>

<!-- ─── Feed ─── -->
<section class="bg-white py-6 sm:py-10 dark:bg-zinc-900 min-h-screen">
    <div class="max-w-6xl mx-auto px-3 sm:px-6 lg:px-12">

        <!-- ─ Recently Added feed ─ -->
        <div id="feed-recently-added" class="gallery-feed-section">
            @if(isset($recentModels) && $recentModels->count())
                <div class="gallery-columns">
                    @foreach($recentModels as $model)
                        @include('gallery.partials.post-card', ['model' => $model, 'feedPrefix' => 'r'])
                    @endforeach
                </div>

                <!-- Infinite scroll sentinel -->
                <div id="sentinel-recently-added" class="mt-8 flex justify-center">
                    <div class="h-12 w-12 animate-spin rounded-full border-4 border-purple-200 border-t-purple-600 dark:border-zinc-700 dark:border-t-purple-400"></div>
                </div>
            @else
                @include('gallery.partials.empty-state', ['tab' => 'recently added'])
            @endif
        </div>

        <!-- ─ Top Rated feed ─ -->
        <div id="feed-top-rated" class="gallery-feed-section hidden">
            @if(isset($topRatedModels) && $topRatedModels->count())
                <div class="gallery-columns">
                    @foreach($topRatedModels as $model)
                        @include('gallery.partials.post-card', ['model' => $model, 'feedPrefix' => 't'])
                    @endforeach
                </div>
                <div id="sentinel-top-rated" class="mt-8 flex justify-center">
                    <div class="h-12 w-12 animate-spin rounded-full border-4 border-purple-200 border-t-purple-600 dark:border-zinc-700 dark:border-t-purple-400"></div>
                </div>
            @else
                @include('gallery.partials.empty-state', ['tab' => 'top rated'])
            @endif
        </div>

        <!-- ─ Following feed ─ -->
        <div id="feed-following" class="gallery-feed-section hidden">
            @auth
                @if(isset($followingModels) && $followingModels->count())
                    <div class="gallery-columns">
                        @foreach($followingModels as $model)
                            @include('gallery.partials.post-card', ['model' => $model, 'feedPrefix' => 'f'])
                        @endforeach
                    </div>
                    <div id="sentinel-following" class="mt-8 flex justify-center">
                        <div class="h-12 w-12 animate-spin rounded-full border-4 border-purple-200 border-t-purple-600 dark:border-zinc-700 dark:border-t-purple-400"></div>
                    </div>
                @elseif(count($followingIds ?? []) === 0)
                    <div class="flex flex-col items-center justify-center py-24 text-center">
                        <div class="mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-purple-100 dark:bg-purple-900/30">
                            <svg class="h-10 w-10 text-purple-400 dark:text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-zinc-900 dark:text-white">No one followed yet</h3>
                        <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400 max-w-xs">Follow some crafters and their latest posts will appear here.</p>
                    </div>
                @else
                    @include('gallery.partials.empty-state', ['tab' => 'following'])
                @endif
            @else
                <div class="flex flex-col items-center justify-center py-24 text-center">
                    <div class="mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-purple-100 dark:bg-purple-900/30">
                        <svg class="h-10 w-10 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Sign in to see your feed</h3>
                    <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">Follow crafters and their latest work will appear here.</p>
                    <a href="{{ route('login') }}" class="mt-6 rounded-xl bg-gradient-to-r from-purple-600 to-violet-600 px-6 py-2.5 text-sm font-semibold text-white shadow-lg hover:from-purple-500 hover:to-violet-500 transition-all">
                        Sign in
                    </a>
                </div>
            @endauth
        </div>

    </div>
</section>

<!-- ─── Login modal (guest) ─── -->
<div id="login-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeLoginModal()"></div>
    <div class="relative w-full max-w-sm rounded-2xl bg-white p-8 shadow-2xl dark:bg-zinc-900">
        <div class="text-center">
            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-purple-100 dark:bg-purple-900/40">
                <svg class="h-7 w-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-zinc-900 dark:text-white">Sign in required</h3>
            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">Create an account or sign in to share your models.</p>
            <div class="mt-6 flex flex-col gap-3">
                <a href="{{ route('login') }}" class="rounded-xl bg-gradient-to-r from-purple-600 to-violet-600 py-2.5 text-sm font-semibold text-white shadow hover:from-purple-500 hover:to-violet-500 transition-all">Sign in</a>
                <a href="{{ route('register') }}" class="rounded-xl border border-zinc-200 py-2.5 text-sm font-semibold text-zinc-700 hover:bg-zinc-50 transition-all dark:border-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-800">Create account</a>
            </div>
        </div>
        <button onclick="closeLoginModal()" class="absolute right-4 top-4 text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>

<!-- ─── Post detail modal ─── -->
<div id="gal-post-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-0 sm:p-6 bg-black/80 backdrop-blur-sm" onclick="galHandleBackdrop(event)">

    {{-- ◀ Prev post (outside modal box) --}}
    <button id="gal-nav-prev" onclick="galPrevPost()" style="display:none;"
        class="absolute left-4 top-1/2 -translate-y-1/2 z-10 flex w-12 h-12 items-center justify-center rounded-2xl bg-black/50 border border-white/20 text-white hover:bg-violet-600/80 hover:border-violet-400/60 hover:scale-110 transition-all duration-200 backdrop-blur-sm shadow-lg">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>

    {{-- ▶ Next post (outside modal box) --}}
    <button id="gal-nav-next" onclick="galNextPost()" style="display:none;"
        class="absolute right-4 top-1/2 -translate-y-1/2 z-10 flex w-12 h-12 items-center justify-center rounded-2xl bg-black/50 border border-white/20 text-white hover:bg-violet-600/80 hover:border-violet-400/60 hover:scale-110 transition-all duration-200 backdrop-blur-sm shadow-lg">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
        </svg>
    </button>

    <div class="gal-modal-inner relative flex flex-col md:flex-row w-full max-w-6xl rounded-none sm:rounded-2xl overflow-hidden shadow-2xl ring-1 ring-zinc-700 bg-zinc-900 dark:bg-zinc-900"
         style="max-height:90vh;" onclick="event.stopPropagation()">

        {{-- ✕ --}}
        <button onclick="galCloseModal()" class="absolute top-3 right-3 z-20 w-8 h-8 flex items-center justify-center rounded-full bg-zinc-800/80 hover:bg-zinc-700 text-zinc-300 hover:text-white transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        {{-- LEFT: image carousel --}}
        <div class="gal-image-panel relative flex-none w-full md:w-3/5 bg-black flex items-stretch" style="min-height:320px;max-height:90vh;">
            <div id="gal-pm-carousel" class="w-full overflow-hidden relative" style="min-height:320px;">
                <div id="gal-pm-track" style="display:flex;transition:transform .3s ease;height:100%;"></div>
            </div>
            <button id="gal-pm-prev" onclick="galPmGo(-1)" class="absolute left-2 top-1/2 -translate-y-1/2 z-10 w-8 h-8 hidden items-center justify-center rounded-full bg-black/55 text-white hover:bg-black/80 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button id="gal-pm-next" onclick="galPmGo(1)" class="absolute right-2 top-1/2 -translate-y-1/2 z-10 w-8 h-8 hidden items-center justify-center rounded-full bg-black/55 text-white hover:bg-black/80 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </button>
            <div id="gal-pm-dots" class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-1.5 z-10"></div>
        </div>

        {{-- RIGHT: meta --}}
        <div class="gal-detail-panel flex flex-col w-full md:w-2/5 min-w-0 border-t border-zinc-800 md:border-t-0 md:border-l md:border-zinc-800" style="max-height:90vh;">

            {{-- Author header --}}
            <div class="flex items-center gap-3 px-4 py-3 border-b border-zinc-800 shrink-0">
                <div id="gal-pm-avatar" class="w-9 h-9 rounded-full bg-gradient-to-br from-purple-500 to-violet-500 flex items-center justify-center text-sm font-bold text-white shrink-0 select-none"></div>
                <div class="min-w-0 flex-1">
                    <p id="gal-pm-author" class="text-sm font-semibold text-white truncate"></p>
                    <p id="gal-pm-time"   class="text-xs text-zinc-500"></p>
                </div>
                <span id="gal-pm-badge" class="inline-flex items-center rounded-full bg-purple-900/40 text-purple-300 px-2.5 py-0.5 text-xs font-semibold capitalize shrink-0"></span>
                <button onclick="galCloseModal()" class="ml-1 text-zinc-500 hover:text-white transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            {{-- Scrollable body --}}
            <div id="gal-pm-scroll" class="flex-1 overflow-y-auto px-4 py-4 space-y-3 text-sm">
                <p id="gal-pm-desc" class="text-zinc-200 leading-relaxed whitespace-pre-wrap break-words"></p>
                <div id="gal-pm-tags" class="flex flex-wrap gap-1.5"></div>
                {{-- Comments loader + list --}}
                <div id="gal-pm-comments-loading" class="hidden justify-center py-3">
                    <div class="h-4 w-4 animate-spin rounded-full border-2 border-zinc-700 border-t-purple-400"></div>
                </div>
                <div id="gal-pm-comments-list" class="space-y-4"></div>
            </div>

            {{-- Actions --}}
            <div class="shrink-0 border-t border-zinc-800 px-4 py-3 space-y-2">
                <div class="flex items-center justify-between">
                    @auth
                    <button id="gal-pm-like-btn" onclick="galPmToggleLike()"
                            class="flex items-center gap-1.5 text-zinc-400 hover:text-red-400 transition-colors duration-200">
                        <svg id="gal-pm-like-icon" class="w-6 h-6 stroke-2 transition-transform duration-150 hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        <span id="gal-pm-like-count" class="text-sm font-medium"></span>
                    </button>
                    @else
                    <button onclick="openLoginModal()" class="flex items-center gap-1.5 text-zinc-600 hover:text-red-400 transition-colors duration-200">
                        <svg class="w-6 h-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        <span id="gal-pm-like-count" class="text-sm font-medium text-zinc-400"></span>
                    </button>
                    @endauth

                    @auth
                    <button id="gal-pm-save-btn" onclick="galPmToggleSave()" class="text-zinc-400 hover:text-purple-400 transition-colors duration-200">
                        <svg id="gal-pm-save-icon" class="w-6 h-6 stroke-2 hover:scale-110 transition-transform duration-150" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                        </svg>
                    </button>
                    @else
                    <button onclick="openLoginModal()" class="text-zinc-600 hover:text-purple-400 transition-colors duration-200">
                        <svg class="w-6 h-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                        </svg>
                    </button>
                    @endauth
                </div>

                <p id="gal-pm-likes-label" class="text-xs text-zinc-500"></p>

                @auth
                {{-- Replying-to pill (hidden until Reply is clicked) --}}
                <div id="gal-pm-reply-banner" class="hidden items-center gap-2 px-0 pb-1 text-xs text-zinc-400">
                    <span>Replying to <span id="gal-pm-reply-to" class="text-purple-400 font-semibold"></span></span>
                    <button onclick="galCancelReply()" class="ml-auto text-zinc-600 hover:text-zinc-300 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div class="flex items-center gap-2 pt-1 border-t border-zinc-800">
                    <div class="w-6 h-6 rounded-full bg-gradient-to-br from-violet-400 to-purple-500 flex-none flex items-center justify-center text-white text-xs font-bold select-none">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <input id="gal-pm-comment-input" type="text" placeholder="Add a comment…"
                           class="flex-1 bg-transparent text-sm text-zinc-300 placeholder-zinc-600 outline-none py-1"
                           maxlength="500"
                           oninput="document.getElementById('gal-pm-comment-btn').disabled = this.value.trim().length === 0"
                           onkeydown="if(event.key==='Enter'){event.preventDefault();galPostComment();}"/>
                    <button id="gal-pm-comment-btn" onclick="galPostComment()"
                            class="text-sm font-semibold text-purple-400 hover:text-purple-300 transition-colors disabled:opacity-40 disabled:cursor-not-allowed"
                            disabled>Post</button>
                </div>
                @else
                <div class="pt-2 border-t border-zinc-800 text-center">
                    <a href="{{ route('login') }}" class="text-sm text-purple-400 hover:underline">Sign in to leave a comment</a>
                </div>
                @endauth
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// ─── Tab switching with sliding pill ──────────────────────────────────────────────
const _tabOrder = ['recently-added', 'top-rated', 'following'];

function movePill(tabId) {
    const btn  = document.getElementById('tab-' + tabId);
    const pill = document.getElementById('tab-pill');
    if (!btn || !pill) return;
    pill.style.left  = btn.offsetLeft + 'px';
    pill.style.width = btn.offsetWidth + 'px';
}

function switchTab(tab) {
    document.querySelectorAll('.gallery-feed-section').forEach(el => el.classList.add('hidden'));
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('text-white');
        btn.classList.add('text-zinc-500', 'dark:text-zinc-400');
    });

    const feed = document.getElementById('feed-' + tab);
    feed.classList.remove('hidden');

    const activeBtn = document.getElementById('tab-' + tab);
    activeBtn.classList.add('text-white');
    activeBtn.classList.remove('text-zinc-500', 'dark:text-zinc-400');

    movePill(tab);
}

// Initialise pill position on load
document.addEventListener('DOMContentLoaded', () => movePill('recently-added'));
window.addEventListener('resize', () => {
    const activeBtn = document.querySelector('.tab-btn.text-white');
    if (activeBtn) movePill(activeBtn.id.replace('tab-', ''));
});

// ─── Login modal ─────────────────────────────────────────────────────
function openLoginModal()  { document.getElementById('login-modal').classList.remove('hidden'); }
function closeLoginModal() { document.getElementById('login-modal').classList.add('hidden'); }


// ─── Infinite scroll placeholder ─────────────────────────────────────
// Replace with real AJAX pagination when backend is ready
const sentinels = document.querySelectorAll('[id^="sentinel-"]');
sentinels.forEach(sentinel => {
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // TODO: fetch next page and append cards
                // For now just hide the spinner once it enters view (no more pages)
                sentinel.innerHTML = '<p class="text-sm text-zinc-400 pb-8">You\'re all caught up ✓</p>';
                observer.unobserve(sentinel);
            }
        });
    }, { threshold: 0.5 });
    observer.observe(sentinel);
});

// ─── Open post modal when clicking image area ────────────────────────────
document.addEventListener('click', function (e) {
    const trigger = e.target.closest('[data-open-post]');
    if (trigger) galOpenModal(trigger.dataset.openPost);
});
</script>
<script id="gallery-post-data" type="application/json">@json($galleryPostData)</script>
<script>
// ═══════════════════════════════════════════════════════════
// Gallery post modal
// ═══════════════════════════════════════════════════════════
const _galPosts  = JSON.parse(document.getElementById('gallery-post-data').textContent);
const _galCsrf   = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
let   _galCurr   = null;
let   _galIdx    = 0;

// ─── Search helper ───────────────────────────────────────────────────────────
function galSearch(term) {
    const url = new URL(window.location.href);
    const trimmed = term.trim();
    if (trimmed) {
        url.searchParams.set('q', trimmed);
    } else {
        url.searchParams.delete('q');
    }
    window.location.href = url.toString();
}

// ─── Post-to-post navigation ─────────────────────────────────────────────────
let _galPostList    = [];  // ordered list of postIds in current visible feed
let _galPostListIdx = -1;  // which post is open right now

function galBuildPostList() {
    const feed = document.querySelector('.gallery-feed-section:not(.hidden)');
    if (!feed) { _galPostList = []; return; }
    const seen = new Set();
    _galPostList = Array.from(feed.querySelectorAll('[data-open-post]'))
        .map(el => el.dataset.openPost)
        .filter(id => { if (seen.has(id)) return false; seen.add(id); return true; });
}

function galUpdateNavArrows() {
    const prev = document.getElementById('gal-nav-prev');
    const next = document.getElementById('gal-nav-next');
    if (!prev || !next) return;
    // Never show outer nav arrows on mobile
    if (window.innerWidth < 768) { prev.style.display = 'none'; next.style.display = 'none'; return; }
    const hasPrev = _galPostListIdx > 0;
    const hasNext = _galPostListIdx < _galPostList.length - 1;
    prev.style.display = hasPrev ? 'flex' : 'none';
    next.style.display = hasNext ? 'flex' : 'none';
}

function galPrevPost() {
    if (_galPostListIdx > 0) {
        _galPostListIdx--;
        galOpenModal(_galPostList[_galPostListIdx]);
    }
}

function galNextPost() {
    if (_galPostListIdx < _galPostList.length - 1) {
        _galPostListIdx++;
        galOpenModal(_galPostList[_galPostListIdx]);
    }
}

function galOpenModal(postId) {
    const post = _galPosts[postId];
    if (!post) return;
    _galCurr = post;
    _galIdx  = 0;

    // Update post-list navigation
    galBuildPostList();
    _galPostListIdx = _galPostList.indexOf(String(postId));
    galUpdateNavArrows();

    document.getElementById('gal-pm-avatar').textContent = post.initials;
    document.getElementById('gal-pm-author').textContent = post.author;
    document.getElementById('gal-pm-time').textContent   = post.created_at;
    document.getElementById('gal-pm-badge').textContent  = post.craft_type;
    document.getElementById('gal-pm-desc').textContent   = post.description;

    const tagsEl = document.getElementById('gal-pm-tags');
    tagsEl.innerHTML = '';
    (post.tags || []).forEach(tag => {
        const s = document.createElement('span');
        s.className   = 'text-xs text-purple-400 hover:text-purple-300 cursor-default';
        s.textContent = '#' + tag.replace(/^#+/, '');
        tagsEl.appendChild(s);
    });

    galPmSetLike(post.is_liked, post.likes_count);
    galPmSetSave(post.is_faved);

    // Build carousel
    const track = document.getElementById('gal-pm-track');
    const dots  = document.getElementById('gal-pm-dots');
    track.innerHTML = '';
    dots.innerHTML  = '';
    const imgs = (post.images && post.images.length) ? post.images : [null];
    imgs.forEach((url, i) => {
        const slide = document.createElement('div');
        slide.style.cssText = 'flex:none;width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#000;';
        if (url) {
            const img = document.createElement('img');
            img.src = url; img.alt = 'Post image';
            img.style.cssText = 'width:100%;height:100%;object-fit:contain;';
            slide.appendChild(img);
        } else {
            slide.innerHTML = `<svg style="width:4rem;height:4rem;color:#3f3f46" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>`;
        }
        track.appendChild(slide);
        if (imgs.length > 1) {
            const dot = document.createElement('div');
            dot.style.cssText = `height:.375rem;border-radius:9999px;transition:all .2s;background:${i===0?'#fff':'rgba(255,255,255,.4)'};width:${i===0?'.625rem':'.375rem'};`;
            dots.appendChild(dot);
        }
    });

    const carEl = document.getElementById('gal-pm-carousel');
    carEl.style.height = (carEl.parentElement.offsetHeight || 560) + 'px';
    track.style.height = '100%';

    galPmUpdateArrows(imgs.length);
    galPmGoTo(0);

    const modal = document.getElementById('gal-post-modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';

    // Reset comment input
    const inp = document.getElementById('gal-pm-comment-input');
    const commentBtn = document.getElementById('gal-pm-comment-btn');
    if (inp)        { inp.value = ''; }
    if (commentBtn) { commentBtn.disabled = true; }
    galCancelReply();

    galLoadComments();
}

function galCloseModal() {
    document.getElementById('gal-post-modal').classList.add('hidden');
    document.getElementById('gal-post-modal').classList.remove('flex');
    document.body.style.overflow = '';
    _galCurr = null;
    // Hide outer nav arrows
    const prev = document.getElementById('gal-nav-prev');
    const next = document.getElementById('gal-nav-next');
    if (prev) prev.style.display = 'none';
    if (next) next.style.display = 'none';
}
function galHandleBackdrop(e) {
    if (e.target === document.getElementById('gal-post-modal')) galCloseModal();
}

// Carousel
function galPmGoTo(index) {
    const track = document.getElementById('gal-pm-track');
    const total = track.children.length;
    _galIdx = Math.max(0, Math.min(index, total - 1));
    track.style.transform = `translateX(-${_galIdx * 100}%)`;
    const dotEls = document.getElementById('gal-pm-dots').children;
    Array.from(dotEls).forEach((d, i) => {
        d.style.background = i === _galIdx ? '#fff' : 'rgba(255,255,255,.4)';
        d.style.width = i === _galIdx ? '.625rem' : '.375rem';
    });
    galPmUpdateArrows(total);
}
function galPmGo(dir) { galPmGoTo(_galIdx + dir); }
function galPmUpdateArrows(total) {
    const prev = document.getElementById('gal-pm-prev');
    const next = document.getElementById('gal-pm-next');
    const show = (el, visible) => { el.classList.toggle('hidden', !visible); el.classList.toggle('flex', visible); };
    show(prev, total > 1 && _galIdx > 0);
    show(next, total > 1 && _galIdx < total - 1);
}

// Like
function galPmSetLike(liked, count) {
    const icon  = document.getElementById('gal-pm-like-icon');
    const btn   = document.getElementById('gal-pm-like-btn');
    const cntEl = document.getElementById('gal-pm-like-count');
    const label = document.getElementById('gal-pm-likes-label');
    if (icon) icon.setAttribute('fill', liked ? 'currentColor' : 'none');
    if (btn)  { btn.classList.toggle('text-red-500',  liked); btn.classList.toggle('text-zinc-400', !liked); }
    if (cntEl) cntEl.textContent = count;
    if (label) label.textContent = count + (count === 1 ? ' like' : ' likes');

    // Sync the card's heart button too
    if (_galCurr) {
        const cardBtn = document.querySelector(`.like-btn[data-post-id="${_galCurr.id}"]`);
        if (cardBtn) {
            const svg = cardBtn.querySelector('svg');
            const cnt = cardBtn.querySelector('.like-count');
            cardBtn.dataset.liked = liked ? 'true' : 'false';
            if (svg) svg.setAttribute('fill', liked ? 'currentColor' : 'none');
            cardBtn.classList.toggle('text-red-500',  liked);
            cardBtn.classList.toggle('text-zinc-500', !liked);
            if (cnt) cnt.textContent = count;
        }
    }
}
function galPmSetSave(saved) {
    const icon = document.getElementById('gal-pm-save-icon');
    const btn  = document.getElementById('gal-pm-save-btn');
    if (icon) icon.setAttribute('fill', saved ? 'currentColor' : 'none');
    if (btn)  { btn.classList.toggle('text-purple-400', saved); btn.classList.toggle('text-zinc-400', !saved); }

    // Sync the card's bookmark button too
    if (_galCurr) {
        const cardBtn = document.querySelector(`.fav-btn[data-post-id="${_galCurr.id}"]`);
        if (cardBtn) {
            const svg = cardBtn.querySelector('svg');
            cardBtn.dataset.faved = saved ? 'true' : 'false';
            if (svg) svg.setAttribute('fill', saved ? 'currentColor' : 'none');
            cardBtn.classList.toggle('text-purple-500', saved);
            cardBtn.classList.toggle('text-zinc-400',   !saved);
        }
    }
}

async function galPmToggleLike() {
    if (!_galCurr) return;
    const liked  = _galCurr.is_liked;
    const url    = liked ? _galCurr.unlike_url : _galCurr.like_url;
    const method = liked ? 'DELETE' : 'POST';
    try {
        const res  = await fetch(url, { method, headers: { 'X-CSRF-TOKEN': _galCsrf, 'Accept': 'application/json' } });
        const data = await res.json();
        _galCurr.is_liked    = data.liked;
        _galCurr.likes_count = data.count;
        _galPosts[_galCurr.id].is_liked    = data.liked;
        _galPosts[_galCurr.id].likes_count = data.count;
        galPmSetLike(data.liked, data.count);
    } catch (err) { console.error(err); }
}

async function galPmToggleSave() {
    if (!_galCurr) return;
    const saved  = _galCurr.is_faved;
    const url    = saved ? _galCurr.unfav_url : _galCurr.fav_url;
    const method = saved ? 'DELETE' : 'POST';
    try {
        const res  = await fetch(url, { method, headers: { 'X-CSRF-TOKEN': _galCsrf, 'Accept': 'application/json' } });
        const data = await res.json();
        _galCurr.is_faved              = data.favorited;
        _galPosts[_galCurr.id].is_faved = data.favorited;
        galPmSetSave(data.favorited);
    } catch (err) { console.error(err); }
}

// ─── Comments ────────────────────────────────────────────────────────────────

async function galLoadComments() {
    if (!_galCurr) return;
    const list    = document.getElementById('gal-pm-comments-list');
    const loading = document.getElementById('gal-pm-comments-loading');
    list.innerHTML = '';
    loading.classList.remove('hidden');
    loading.classList.add('flex');
    try {
        const res  = await fetch(_galCurr.comments_url, { headers: { 'Accept': 'application/json' } });
        const data = await res.json();
        const comments = data.comments || [];

        // ── Group: separate top-level from replies ──
        // A reply starts with @SomeWord. Build a map: normalised-author → [replies]
        const replyMap  = {};   // key: lowercase no-space author name
        const topLevel  = [];

        comments.forEach(c => {
            const m = c.body.match(/^@(\S+)\s?/);
            if (m) {
                const key = m[1].toLowerCase();
                (replyMap[key] = replyMap[key] || []).push(c);
            } else {
                topLevel.push(c);
            }
        });

        // ── Render each top-level comment followed by its reply group ──
        topLevel.forEach(c => {
            const key     = c.author.replace(/\s+/g, '').toLowerCase();
            const replies = replyMap[key] || [];
            list.appendChild(galBuildCommentGroup(c, replies));
            // Remove consumed replies so orphan replies fall through below
            delete replyMap[key];
        });

        // ── Any replies whose mention didn't match a top-level author go at the bottom ──
        Object.values(replyMap).flat().forEach(c => {
            list.appendChild(galBuildCommentGroup(c, []));
        });
    } catch (err) { console.error(err); }
    finally {
        loading.classList.add('hidden');
        loading.classList.remove('flex');
    }
}

// Builds a top-level comment row + optional collapsible replies block
function galBuildCommentGroup(comment, replies) {
    const wrapper = document.createElement('div');
    wrapper.className = 'comment-group';
    wrapper.dataset.authorKey = comment.author.replace(/\s+/g, '').toLowerCase();

    wrapper.appendChild(galBuildCommentEl(comment, false));

    if (replies.length > 0) {
        // Toggle button
        const toggle = document.createElement('button');
        toggle.type = 'button';
        toggle.className = 'flex items-center gap-1.5 pl-9 mt-1 text-xs font-semibold text-zinc-500 hover:text-zinc-200 transition-colors';
        toggle.innerHTML = `
            <span class="inline-block w-5 h-px bg-zinc-700"></span>
            <span class="toggle-label">View ${replies.length} repl${replies.length === 1 ? 'y' : 'ies'}</span>
            <svg class="toggle-chevron w-3 h-3 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
            </svg>`;

        // Replies container (hidden by default)
        const repliesContainer = document.createElement('div');
        repliesContainer.className = 'replies-container hidden mt-2 space-y-3';
        replies.forEach(r => repliesContainer.appendChild(galBuildCommentEl(r, true)));

        toggle.onclick = () => {
            const open = !repliesContainer.classList.contains('hidden');
            repliesContainer.classList.toggle('hidden', open);
            toggle.querySelector('.toggle-label').textContent = open
                ? `View ${repliesContainer.children.length} repl${repliesContainer.children.length === 1 ? 'y' : 'ies'}`
                : `Hide repl${repliesContainer.children.length === 1 ? 'y' : 'ies'}`;
            toggle.querySelector('.toggle-chevron').style.transform = open ? '' : 'rotate(180deg)';
        };

        wrapper.appendChild(toggle);
        wrapper.appendChild(repliesContainer);
    } else {
        // Still add an empty (invisible) replies container so galPostComment can inject into it later
        const repliesContainer = document.createElement('div');
        repliesContainer.className = 'replies-container hidden mt-2 space-y-3';
        wrapper.appendChild(repliesContainer);
    }

    return wrapper;
}

// Builds a single comment row (top-level or reply)
function galBuildCommentEl(c, isReply) {
    const mentionMatch = c.body.match(/^(@\S+)\s?([\s\S]*)$/);
    const mentionPart  = mentionMatch ? mentionMatch[1] : null;
    const restBody     = mentionMatch ? mentionMatch[2] : c.body;

    const wrap = document.createElement('div');
    wrap.className = isReply ? 'flex gap-2 items-start pl-9' : 'flex gap-2.5 items-start';

    // Avatar
    let av;
    if (c.avatar) {
        av = document.createElement('img');
        av.src = c.avatar; av.alt = c.author;
        av.className = isReply ? 'w-6 h-6 rounded-full object-cover flex-none' : 'w-7 h-7 rounded-full object-cover flex-none';
    } else {
        av = document.createElement('div');
        av.className = (isReply ? 'w-6 h-6' : 'w-7 h-7') + ' rounded-full bg-gradient-to-br from-violet-400 to-purple-500 flex items-center justify-center text-white text-xs font-bold flex-none';
        av.textContent = c.initials;
    }

    // Body column
    const body = document.createElement('div');
    body.className = 'flex-1 min-w-0 group/comment';

    // Top line: bold author + text inline (Instagram style)
    const topLine = document.createElement('p');
    topLine.className = 'text-xs leading-relaxed break-words';

    const authorSpan = document.createElement('span');
    authorSpan.className = 'font-semibold text-white mr-1.5';
    authorSpan.textContent = c.author;
    topLine.appendChild(authorSpan);

    if (isReply && mentionPart) {
        const mentionSpan = document.createElement('span');
        mentionSpan.className = 'text-purple-400 font-semibold mr-1';
        mentionSpan.textContent = mentionPart;
        topLine.appendChild(mentionSpan);
    }
    topLine.appendChild(document.createTextNode(isReply && mentionPart ? restBody : c.body));

    // Meta line: timestamp + Reply button
    const metaLine = document.createElement('div');
    metaLine.className = 'flex items-center gap-3 mt-0.5';

    const timeSpan = document.createElement('span');
    timeSpan.className = 'text-xs text-zinc-600';
    timeSpan.textContent = c.created_at;
    metaLine.appendChild(timeSpan);

    // Reply button visible for logged-in users only (proxy: input element presence)
    if (document.getElementById('gal-pm-comment-input')) {
        const replyBtn = document.createElement('button');
        replyBtn.type = 'button';
        replyBtn.className = 'reply-btn text-xs font-semibold text-zinc-500 hover:text-zinc-200 transition-colors opacity-0 group-hover/comment:opacity-100';
        replyBtn.textContent = 'Reply';
        replyBtn.onclick = () => galStartReply(c.author);
        metaLine.appendChild(replyBtn);
    }

    body.appendChild(topLine);
    body.appendChild(metaLine);
    wrap.appendChild(av);
    wrap.appendChild(body);
    return wrap;
}

async function galPostComment() {
    if (!_galCurr) return;
    const input = document.getElementById('gal-pm-comment-input');
    const btn   = document.getElementById('gal-pm-comment-btn');
    if (!input) return;
    const body = input.value.trim();
    if (!body) return;

    btn.disabled = true;
    const prevText = btn.textContent;
    btn.textContent = '...';

    try {
        const res = await fetch(_galCurr.comment_url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': _galCsrf,
            },
            body: JSON.stringify({ body }),
        });

        if (res.status === 401) { openLoginModal(); return; }

        const data = await res.json();
        if (data.comment) {
            input.value = '';
            btn.disabled = true;
            btn.textContent = prevText;
            galCancelReply();

            const list    = document.getElementById('gal-pm-comments-list');
            const scroll  = document.getElementById('gal-pm-scroll');
            const comment = data.comment;

            // ── Decide where to inject: reply or top-level ──
            const mentionMatch = comment.body.match(/^@(\S+)\s?/);
            if (mentionMatch) {
                // Find the parent group by author key
                const key     = mentionMatch[1].toLowerCase();
                const group   = list.querySelector(`.comment-group[data-author-key="${key}"]`);
                if (group) {
                    const container = group.querySelector('.replies-container');
                    container.appendChild(galBuildCommentEl(comment, true));

                    // Show or create the toggle button
                    let toggle = group.querySelector('button.flex');
                    const replyCount = container.children.length;
                    if (!toggle) {
                        toggle = document.createElement('button');
                        toggle.type = 'button';
                        toggle.className = 'flex items-center gap-1.5 pl-9 mt-1 text-xs font-semibold text-zinc-500 hover:text-zinc-200 transition-colors';
                        toggle.innerHTML = `
                            <span class="inline-block w-5 h-px bg-zinc-700"></span>
                            <span class="toggle-label"></span>
                            <svg class="toggle-chevron w-3 h-3 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                            </svg>`;
                        toggle.onclick = () => {
                            const open = !container.classList.contains('hidden');
                            container.classList.toggle('hidden', open);
                            toggle.querySelector('.toggle-label').textContent = open
                                ? `View ${container.children.length} repl${container.children.length === 1 ? 'y' : 'ies'}`
                                : `Hide repl${container.children.length === 1 ? 'y' : 'ies'}`;
                            toggle.querySelector('.toggle-chevron').style.transform = open ? '' : 'rotate(180deg)';
                        };
                        group.insertBefore(toggle, container);
                    }

                    // Auto-expand the replies after posting
                    container.classList.remove('hidden');
                    toggle.querySelector('.toggle-label').textContent = `Hide repl${replyCount === 1 ? 'y' : 'ies'}`;
                    toggle.querySelector('.toggle-chevron').style.transform = 'rotate(180deg)';
                } else {
                    // Parent not found, append as top-level group
                    list.appendChild(galBuildCommentGroup(comment, []));
                }
            } else {
                // Top-level comment
                list.appendChild(galBuildCommentGroup(comment, []));
            }

            if (scroll) scroll.scrollTop = scroll.scrollHeight;

            // Update in-memory counts
            _galCurr.comments_count = (_galCurr.comments_count || 0) + 1;
            _galPosts[_galCurr.id].comments_count = _galCurr.comments_count;

            const cardBubble = document.querySelector(`[data-comment-link="${_galCurr.id}"] .comment-count`);
            if (cardBubble) cardBubble.textContent = _galCurr.comments_count;
        }
    } catch (err) {
        console.error(err);
        btn.textContent = prevText;
    }
}

// ─── Reply helpers ───────────────────────────────────────────────────────────

function galStartReply(authorName) {
    const input   = document.getElementById('gal-pm-comment-input');
    const banner  = document.getElementById('gal-pm-reply-banner');
    const replyTo = document.getElementById('gal-pm-reply-to');
    const btn     = document.getElementById('gal-pm-comment-btn');
    if (!input) return;

    const mention = '@' + authorName.replace(/\s+/g, '') + ' ';
    input.value = mention;
    input.focus();
    // Place cursor at end
    input.setSelectionRange(mention.length, mention.length);
    if (btn) btn.disabled = false;

    if (banner && replyTo) {
        replyTo.textContent = '@' + authorName;
        banner.classList.remove('hidden');
        banner.classList.add('flex');
    }
}

function galCancelReply() {
    const banner = document.getElementById('gal-pm-reply-banner');
    const input  = document.getElementById('gal-pm-comment-input');
    if (banner) { banner.classList.add('hidden'); banner.classList.remove('flex'); }
    // Only clear the @mention prefix if it's the only content (user hasn't typed more)
    if (input) {
        const mention = input.value.match(/^@\S+ ?$/);
        if (mention) {
            input.value = '';
            const btn = document.getElementById('gal-pm-comment-btn');
            if (btn) btn.disabled = true;
        }
    }
}

// Touch swipe inside modal carousel
(function () {
    let sx = 0;
    const el = document.getElementById('gal-pm-carousel');
    el.addEventListener('touchstart', e => { sx = e.touches[0].clientX; }, { passive: true });
    el.addEventListener('touchend',   e => {
        const diff = sx - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 40) galPmGo(diff > 0 ? 1 : -1);
    }, { passive: true });
})();

// ─── Mobile inline comments ─────────────────────────────────────────────────
function cardCommentClick(cardUid, postId) {
    if (window.innerWidth >= 768) {
        galOpenModal(postId);
    } else {
        mcToggle(cardUid, postId);
    }
}

function mcToggle(cardUid, postId) {
    const section = document.getElementById('mc-' + cardUid);
    if (!section) return;
    const isHidden = section.classList.contains('hidden');
    section.classList.toggle('hidden', !isHidden);
    if (isHidden && section.dataset.mcLoaded === 'false') {
        mcLoad(cardUid, postId);
    }
}

async function mcLoad(cardUid, postId) {
    const post    = _galPosts[postId];
    const list    = document.getElementById('mc-list-' + cardUid);
    const loading = document.getElementById('mc-loading-' + cardUid);
    const section = document.getElementById('mc-' + cardUid);
    if (!post || !list) return;
    loading.classList.remove('hidden'); loading.classList.add('flex');
    try {
        const res  = await fetch(post.comments_url, { headers: { 'Accept': 'application/json' } });
        const data = await res.json();
        list.innerHTML = '';
        const replyMap = {};
        const topLevel = [];
        (data.comments || []).forEach(c => {
            const m = c.body.match(/^@(\S+)\s?/);
            if (m) {
                const key = m[1].toLowerCase();
                (replyMap[key] = replyMap[key] || []).push(c);
            } else {
                topLevel.push(c);
            }
        });
        topLevel.forEach(c => {
            const key     = c.author.replace(/\s+/g, '').toLowerCase();
            const replies = replyMap[key] || [];
            list.appendChild(mcBuildCommentGroup(cardUid, c, replies));
            delete replyMap[key];
        });
        Object.values(replyMap).flat().forEach(c => {
            list.appendChild(mcBuildCommentGroup(cardUid, c, []));
        });
        section.dataset.mcLoaded = 'true';
    } catch (err) { console.error(err); }
    finally { loading.classList.add('hidden'); loading.classList.remove('flex'); }
}

function mcBuildCommentGroup(cardUid, comment, replies) {
    const wrapper = document.createElement('div');
    wrapper.className = 'comment-group';
    wrapper.dataset.authorKey = comment.author.replace(/\s+/g, '').toLowerCase();
    wrapper.appendChild(mcBuildCommentEl(cardUid, comment, false));

    if (replies.length > 0) {
        const toggle = document.createElement('button');
        toggle.type = 'button';
        toggle.className = 'flex items-center gap-1.5 pl-9 mt-1 text-xs font-semibold text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-200 transition-colors';
        toggle.innerHTML = `
            <span class="inline-block w-5 h-px bg-zinc-300 dark:bg-zinc-600"></span>
            <span class="toggle-label">View ${replies.length} repl${replies.length === 1 ? 'y' : 'ies'}</span>
            <svg class="toggle-chevron w-3 h-3 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
            </svg>`;

        const repliesContainer = document.createElement('div');
        repliesContainer.className = 'replies-container hidden mt-2 space-y-3';
        replies.forEach(r => repliesContainer.appendChild(mcBuildCommentEl(cardUid, r, true)));

        toggle.onclick = () => {
            const open = !repliesContainer.classList.contains('hidden');
            repliesContainer.classList.toggle('hidden', open);
            toggle.querySelector('.toggle-label').textContent = open
                ? `View ${repliesContainer.children.length} repl${repliesContainer.children.length === 1 ? 'y' : 'ies'}`
                : `Hide repl${repliesContainer.children.length === 1 ? 'y' : 'ies'}`;
            toggle.querySelector('.toggle-chevron').style.transform = open ? '' : 'rotate(180deg)';
        };
        wrapper.appendChild(toggle);
        wrapper.appendChild(repliesContainer);
    } else {
        const repliesContainer = document.createElement('div');
        repliesContainer.className = 'replies-container hidden mt-2 space-y-3';
        wrapper.appendChild(repliesContainer);
    }
    return wrapper;
}

function mcBuildCommentEl(cardUid, c, isReply) {
    const mentionMatch = c.body.match(/^(@\S+)\s?([\s\S]*)$/);
    const mentionPart  = mentionMatch ? mentionMatch[1] : null;
    const restBody     = mentionMatch ? mentionMatch[2] : c.body;

    const wrap = document.createElement('div');
    wrap.className = isReply ? 'flex gap-2 items-start pl-9' : 'flex gap-2 items-start';

    let av;
    if (c.avatar) {
        av = document.createElement('img');
        av.src = c.avatar; av.alt = c.author;
        av.className = isReply ? 'w-6 h-6 rounded-full object-cover flex-none' : 'w-7 h-7 rounded-full object-cover flex-none';
    } else {
        av = document.createElement('div');
        av.className = (isReply ? 'w-6 h-6' : 'w-7 h-7') + ' rounded-full bg-gradient-to-br from-violet-400 to-purple-500 flex items-center justify-center text-white text-xs font-bold flex-none';
        av.textContent = c.initials;
    }

    const body = document.createElement('div');
    body.className = 'flex-1 min-w-0 group/comment';

    const topLine = document.createElement('p');
    topLine.className = 'text-xs leading-relaxed break-words text-zinc-800 dark:text-zinc-200';

    const authorSpan = document.createElement('span');
    authorSpan.className = 'font-semibold mr-1.5';
    authorSpan.textContent = c.author;
    topLine.appendChild(authorSpan);

    if (isReply && mentionPart) {
        const mentionSpan = document.createElement('span');
        mentionSpan.className = 'text-purple-500 font-semibold mr-1';
        mentionSpan.textContent = mentionPart;
        topLine.appendChild(mentionSpan);
    }
    topLine.appendChild(document.createTextNode(isReply && mentionPart ? restBody : c.body));

    const metaLine = document.createElement('div');
    metaLine.className = 'flex items-center gap-3 mt-0.5';

    const timeSpan = document.createElement('span');
    timeSpan.className = 'text-xs text-zinc-400 dark:text-zinc-500';
    timeSpan.textContent = c.created_at;
    metaLine.appendChild(timeSpan);

    if (cardUid && document.getElementById('mc-input-' + cardUid)) {
        const replyBtn = document.createElement('button');
        replyBtn.type = 'button';
        replyBtn.className = 'reply-btn text-xs font-semibold text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-200 transition-colors opacity-0 group-hover/comment:opacity-100';
        replyBtn.textContent = 'Reply';
        replyBtn.onclick = () => mcStartReply(cardUid, c.author);
        metaLine.appendChild(replyBtn);
    }

    body.appendChild(topLine);
    body.appendChild(metaLine);
    wrap.appendChild(av);
    wrap.appendChild(body);
    return wrap;
}

function mcStartReply(cardUid, author) {
    const banner  = document.getElementById('mc-reply-banner-' + cardUid);
    const replyTo = document.getElementById('mc-reply-to-'     + cardUid);
    const input   = document.getElementById('mc-input-'        + cardUid);
    if (!banner || !input) return;
    replyTo.textContent = '@' + author;
    banner.classList.remove('hidden');
    banner.classList.add('flex');
    input.value = '@' + author + ' ';
    input.focus();
    document.getElementById('mc-btn-' + cardUid).disabled = false;
}

function mcCancelReply(cardUid) {
    const banner = document.getElementById('mc-reply-banner-' + cardUid);
    const input  = document.getElementById('mc-input-'        + cardUid);
    if (banner) { banner.classList.add('hidden'); banner.classList.remove('flex'); }
    if (input && input.value.startsWith('@')) { input.value = ''; }
    const btn = document.getElementById('mc-btn-' + cardUid);
    if (btn) btn.disabled = true;
}

async function mobilePostComment(cardUid, postId) {
    const post  = _galPosts[postId];
    const input = document.getElementById('mc-input-' + cardUid);
    const btn   = document.getElementById('mc-btn-'  + cardUid);
    const list  = document.getElementById('mc-list-' + cardUid);
    if (!post || !input || !input.value.trim()) return;
    const body = input.value.trim();
    btn.disabled   = true;
    const prev = btn.textContent;
    btn.textContent = '…';
    try {
        const res = await fetch(post.comment_url, {
            method : 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': _csrf },
            body   : JSON.stringify({ body }),
        });
        if (res.status === 401) { window.location.href = '/login'; return; }
        const data = await res.json();
        if (data.comment) {
            input.value = '';
            btn.disabled = true;
            btn.textContent = prev;
            mcCancelReply(cardUid);

            const comment = data.comment;
            const mentionMatch = comment.body.match(/^@(\S+)\s?/);
            if (mentionMatch && list) {
                const key   = mentionMatch[1].toLowerCase();
                const group = list.querySelector(`.comment-group[data-author-key="${key}"]`);
                if (group) {
                    const container = group.querySelector('.replies-container');
                    container.appendChild(mcBuildCommentEl(cardUid, comment, true));

                    // Show replies container
                    container.classList.remove('hidden');

                    // Update or create the toggle button
                    let toggle = group.querySelector('button.flex');
                    const replyCount = container.children.length;
                    if (!toggle) {
                        toggle = document.createElement('button');
                        toggle.type = 'button';
                        toggle.className = 'flex items-center gap-1.5 pl-9 mt-1 text-xs font-semibold text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-200 transition-colors';
                        toggle.innerHTML = `
                            <span class="inline-block w-5 h-px bg-zinc-300 dark:bg-zinc-600"></span>
                            <span class="toggle-label"></span>
                            <svg class="toggle-chevron w-3 h-3 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                            </svg>`;
                        toggle.onclick = () => {
                            const open = !container.classList.contains('hidden');
                            container.classList.toggle('hidden', open);
                            toggle.querySelector('.toggle-label').textContent = open
                                ? `View ${container.children.length} repl${container.children.length === 1 ? 'y' : 'ies'}`
                                : `Hide repl${container.children.length === 1 ? 'y' : 'ies'}`;
                            toggle.querySelector('.toggle-chevron').style.transform = open ? '' : 'rotate(180deg)';
                        };
                        group.insertBefore(toggle, container);
                    }
                    toggle.querySelector('.toggle-label').textContent = `Hide repl${replyCount === 1 ? 'y' : 'ies'}`;
                    toggle.querySelector('.toggle-chevron').style.transform = 'rotate(180deg)';
                } else if (list) {
                    list.appendChild(mcBuildCommentGroup(cardUid, comment, []));
                }
            } else if (list) {
                list.appendChild(mcBuildCommentGroup(cardUid, comment, []));
            }

            // Update comment count badge on the card
            const cnt = document.querySelector(`[data-comment-link="${postId}"] .comment-count`);
            if (cnt) cnt.textContent = parseInt(cnt.textContent || 0) + 1;
            if (_galPosts[postId]) _galPosts[postId].comments_count = (_galPosts[postId].comments_count || 0) + 1;
        }
    } catch (err) { console.error(err); btn.textContent = prev; btn.disabled = false; }
}

// Keyboard
document.addEventListener('keydown', e => {
    if (!document.getElementById('gal-post-modal').classList.contains('hidden')) {
        if (e.key === 'Escape') { galCloseModal(); return; }
        // Shift + Arrow = navigate between posts; plain Arrow = navigate images in carousel
        if (e.shiftKey) {
            if (e.key === 'ArrowLeft')  { e.preventDefault(); galPrevPost(); }
            if (e.key === 'ArrowRight') { e.preventDefault(); galNextPost(); }
        } else {
            if (e.key === 'ArrowLeft')  galPmGo(-1);
            if (e.key === 'ArrowRight') galPmGo(1);
        }
    }
});
</script>
@endpush
@endsection