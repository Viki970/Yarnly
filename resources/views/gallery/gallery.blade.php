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
</style>

<!-- ─── Hero ─── -->
<section class="relative overflow-hidden bg-gradient-to-br from-purple-950 via-violet-950 to-indigo-950 py-14">
    <div class="absolute -left-20 top-0 h-72 w-72 rounded-full bg-purple-600/20 blur-3xl"></div>
    <div class="absolute -right-16 bottom-0 h-72 w-72 rounded-full bg-violet-600/20 blur-3xl"></div>
    <div class="absolute left-1/2 top-1/2 h-96 w-96 -translate-x-1/2 -translate-y-1/2 rounded-full bg-purple-500/10 blur-3xl"></div>

    <div class="relative max-w-3xl mx-auto px-6 lg:px-12 text-center">

        {{-- Headline --}}
        <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl">
            Discover what crafters<br>are making right now
        </h1>
        <p class="mt-4 text-base text-purple-200/70">
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
                placeholder="Search models, crafters, tags…"
                class="w-full bg-transparent text-sm text-white placeholder-purple-300/60 outline-none"
            >
        </div>

        {{-- Trending tags --}}
        <div class="mt-5 flex flex-wrap items-center justify-center gap-2">
            <span class="text-xs font-semibold text-purple-400 uppercase tracking-wide">Trending:</span>
            @foreach(['amigurumi', 'blanket', 'sweater', 'cross-stitch', 'beanie', 'tote-bag'] as $tag)
                <button class="rounded-full bg-white/10 px-3 py-1 text-xs font-medium text-purple-200 ring-1 ring-white/10 hover:bg-purple-500/30 hover:text-white hover:ring-purple-400/50 transition-all duration-200">
                    #{{ $tag }}
                </button>
            @endforeach
        </div>

    </div>
</section>

<!-- ─── Sticky tab bar ─── -->
<div id="gallery-feed" class="sticky top-[65px] z-40 border-b border-zinc-200/80 bg-white/90 backdrop-blur dark:border-zinc-800/70 dark:bg-zinc-900/90">
    <div class="max-w-5xl mx-auto px-6 lg:px-12">
        <div class="flex items-center justify-between py-3 gap-4">

            <!-- Sliding pill tabs -->
            <div class="relative flex items-center gap-1 rounded-xl bg-zinc-100/80 p-1 dark:bg-zinc-800/60" id="tab-bar">
                {{-- Sliding pill background --}}
                <div id="tab-pill"
                     class="absolute top-1 bottom-1 rounded-lg bg-gradient-to-r from-purple-600 to-violet-600 shadow-md shadow-purple-500/30 transition-all duration-300 ease-in-out pointer-events-none"
                     style="left:4px;"></div>

                <button
                    onclick="switchTab('recently-added')"
                    id="tab-recently-added"
                    class="tab-btn relative z-10 flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-semibold transition-colors duration-200 text-white">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Recently Added
                </button>
                <button
                    onclick="switchTab('top-rated')"
                    id="tab-top-rated"
                    class="tab-btn relative z-10 flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-semibold transition-colors duration-200 text-zinc-500 dark:text-zinc-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                    Top Rated
                </button>
                <button
                    onclick="switchTab('following')"
                    id="tab-following"
                    class="tab-btn relative z-10 flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-semibold transition-colors duration-200 text-zinc-500 dark:text-zinc-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Following
                </button>
            </div>

            <!-- Create button -->
            @auth
                <a href="{{ route('posts.create') }}"
                   class="flex items-center gap-2 rounded-xl bg-gradient-to-r from-purple-600 to-violet-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-purple-500/25 transition-all duration-200 hover:from-purple-500 hover:to-violet-500 hover:scale-105">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Share Model
                </a>
            @else
                <button onclick="openLoginModal()"
                   class="flex items-center gap-2 rounded-xl bg-gradient-to-r from-purple-600 to-violet-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-purple-500/25 transition-all duration-200 hover:from-purple-500 hover:to-violet-500 hover:scale-105">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Share Model
                </button>
            @endauth
        </div>
    </div>
</div>

<!-- ─── Feed ─── -->
<section class="bg-white py-10 dark:bg-zinc-900 min-h-screen">
    <div class="max-w-5xl mx-auto px-6 lg:px-12">

        <!-- ─ Recently Added feed ─ -->
        <div id="feed-recently-added" class="gallery-feed-section">
            @if(isset($recentModels) && $recentModels->count())
                <div class="gallery-columns">
                    @foreach($recentModels as $model)
                        @include('gallery.partials.post-card', ['model' => $model])
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
                        @include('gallery.partials.post-card', ['model' => $model])
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
                @include('gallery.partials.empty-state', ['tab' => 'following'])
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
</script>
@endpush

@endsection
