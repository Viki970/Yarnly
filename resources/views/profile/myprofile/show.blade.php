@extends('layout.app')

@section('title', $user->name . ' · Yarnly')

@section('content')

@php
$authUser   = auth()->user();
// Build serialisable post data for JS modal
$allPostData = [];
foreach (array_merge($posts->all(), $savedPosts->all(), $likedPosts->all()) as $post) {
    if (isset($allPostData[$post->id])) continue;
    $allPostData[$post->id] = [
        'id'          => $post->id,
        'images'      => $post->images->map(fn($i) => asset('storage/'.$i->image_path))->values()->all(),
        'description' => $post->description ?? '',
        'craft_type'  => $post->craft_type  ?? '',
        'tags'        => $post->tags_array,
        'likes_count' => $post->likes_count,
        'author'      => $post->user->name,
        'initials'    => $post->user->initials(),
        'created_at'  => $post->created_at->diffForHumans(),
        'is_liked'    => $authUser ? $post->isLikedBy($authUser) : false,
        'is_faved'    => $authUser ? $post->isFavoritedBy($authUser) : false,
        'like_url'    => route('posts.like',       $post->id),
        'unlike_url'  => route('posts.unlike',     $post->id),
        'fav_url'     => route('posts.favorite',   $post->id),
        'unfav_url'   => route('posts.unfavorite', $post->id),
    ];
}
@endphp

<style>
    /* ── Grid thumbnails ── */
    .profile-thumb {
        position: relative;
        aspect-ratio: 1 / 1;
        overflow: hidden;
        background: #18181b;
        cursor: pointer;
        display: block;
        border: none;
        padding: 0;
        width: 100%;
    }
    .profile-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .35s ease, filter .35s ease;
    }
    .profile-thumb:hover img { transform: scale(1.06); filter: brightness(.55); }
    .profile-thumb .thumb-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1.25rem;
        opacity: 0;
        transition: opacity .25s ease;
    }
    .profile-thumb:hover .thumb-overlay { opacity: 1; }
    .thumb-stat { display: flex; align-items: center; gap: .4rem; color: #fff; font-weight: 700; font-size: .95rem; }

    /* ── Tab bar ── */
    .tab-btn { transition: color .2s; }
    .tab-btn.active { color: #fff; }
    #tab-indicator { transition: left .28s cubic-bezier(.4,0,.2,1), width .28s cubic-bezier(.4,0,.2,1); }

    /* ── Stat number ── */
    .stat-num { font-size: 1.125rem; font-weight: 700; line-height: 1.2; }
    .stat-label { font-size: .75rem; color: #a1a1aa; }

    /* ── Post modal carousel ── */
    #pm-track { display: flex; transition: transform .3s ease; height: 100%; }
    .pm-slide  { flex: none; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #000; }
    .pm-slide img { width: 100%; height: 100%; object-fit: contain; }
</style>

<div class="min-h-screen bg-zinc-950 text-white">
    <div class="max-w-3xl mx-auto px-4 py-10">

        {{-- ── Profile Header ── --}}
        <div class="flex items-start gap-10 mb-8 sm:mb-10">

            {{-- Avatar --}}
            <div class="shrink-0">
                @if($user->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile_picture) }}"
                         alt="{{ $user->username }}"
                         class="w-24 h-24 sm:w-36 sm:h-36 rounded-full object-cover shadow-lg ring-2 ring-zinc-700">
                @else
                    <div class="w-24 h-24 sm:w-36 sm:h-36 rounded-full bg-gradient-to-br from-violet-500 via-purple-500 to-indigo-500 flex items-center justify-center text-4xl sm:text-5xl font-bold text-white shadow-lg ring-2 ring-zinc-700">
                        {{ $user->initials() }}
                    </div>
                @endif
            </div>

            {{-- Info --}}
            <div class="flex flex-col gap-4 min-w-0 flex-1">

                {{-- Username + Edit button row --}}
                <div class="flex flex-wrap items-center gap-3">
                    <h1 class="text-xl font-bold tracking-wide truncate">{{ $user->username }}</h1>
                    <a href="{{ route('profile.edit') }}"
                       class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-lg bg-zinc-800 hover:bg-zinc-700 text-sm font-semibold text-white transition-colors duration-200 border border-zinc-700">
                        Edit Profile
                    </a>
                </div>

                {{-- Full name directly under username --}}
                <p class="text-sm text-zinc-400 -mt-2">{{ $user->name }}</p>

                {{-- Stats row (desktop) --}}
                <div class="hidden sm:flex items-center gap-8">
                    <div class="text-center">
                        <span class="stat-num">{{ $postsCount }}</span>
                        <span class="ml-1 text-sm text-zinc-300">{{ Str::plural('post', $postsCount) }}</span>
                    </div>
                    <button onclick="openFollowModal('followers')" class="text-center hover:opacity-80 transition-opacity">
                        <span class="stat-num">{{ $followersCount }}</span>
                        <span class="ml-1 text-sm text-zinc-300">{{ Str::plural('follower', $followersCount) }}</span>
                    </button>
                    <button onclick="openFollowModal('following')" class="text-center hover:opacity-80 transition-opacity">
                        <span class="stat-num">{{ $followingCount }}</span>
                        <span class="ml-1 text-sm text-zinc-300">following</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Stats row (mobile) --}}
        <div class="sm:hidden flex items-center justify-around border-t border-b border-zinc-800 py-3 mb-6">
            <div class="text-center">
                <div class="stat-num">{{ $postsCount }}</div>
                <div class="stat-label">Posts</div>
            </div>
            <button onclick="openFollowModal('followers')" class="text-center hover:opacity-80">
                <div class="stat-num">{{ $followersCount }}</div>
                <div class="stat-label">{{ Str::plural('Follower', $followersCount) }}</div>
            </button>
            <button onclick="openFollowModal('following')" class="text-center hover:opacity-80">
                <div class="stat-num">{{ $followingCount }}</div>
                <div class="stat-label">Following</div>
            </button>
        </div>

        {{-- ── Tab bar ── --}}
        <div class="relative flex items-center justify-center border-t border-zinc-800 mb-0.5">

            {{-- Sliding active indicator --}}
            <div id="tab-indicator" class="absolute top-0 h-0.5 bg-white pointer-events-none" style="left:0;width:0;"></div>

            {{-- Posts tab --}}
            <button onclick="switchTab('posts')" id="tab-posts"
                    class="tab-btn active flex items-center gap-2 px-8 py-3 text-xs font-semibold tracking-widest uppercase text-white">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
                <span class="hidden sm:inline">Posts</span>
            </button>

            {{-- Patterns tab --}}
            <button onclick="switchTab('patterns')" id="tab-patterns"
                    class="tab-btn flex items-center gap-2 px-8 py-3 text-xs font-semibold tracking-widest uppercase text-zinc-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span class="hidden sm:inline">Patterns</span>
            </button>

            {{-- Collections tab --}}
            <button onclick="switchTab('collections')" id="tab-collections"
                    class="tab-btn flex items-center gap-2 px-8 py-3 text-xs font-semibold tracking-widest uppercase text-zinc-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <span class="hidden sm:inline">Collections</span>
            </button>

            {{-- Saved tab --}}
            <button onclick="switchTab('saved')" id="tab-saved"
                    class="tab-btn flex items-center gap-2 px-8 py-3 text-xs font-semibold tracking-widest uppercase text-zinc-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                </svg>
                <span class="hidden sm:inline">Saved</span>
            </button>

            {{-- Liked tab --}}
            <button onclick="switchTab('liked')" id="tab-liked"
                    class="tab-btn flex items-center gap-2 px-8 py-3 text-xs font-semibold tracking-widest uppercase text-zinc-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                <span class="hidden sm:inline">Liked</span>
            </button>
        </div>

        {{-- ── Posts tab content ── --}}
        <div id="panel-posts">
            @if($posts->isEmpty())
            <div class="flex flex-col items-center justify-center py-24 text-center">
                <div class="w-20 h-20 rounded-full border-2 border-zinc-600 flex items-center justify-center mb-5">
                    <svg class="w-10 h-10 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-extrabold mb-2">Share Photos</h3>
                <p class="text-zinc-400 text-sm mb-5">When you share photos, they will appear on your profile.</p>
                <a href="{{ route('posts.create') }}"
                   class="text-sm font-semibold text-sky-400 hover:text-sky-300 transition-colors">Share your first photo</a>
            </div>
            @else
            <div class="grid grid-cols-3 gap-0.5">
                @foreach($posts as $post)
                @php
                    $firstImg = $post->images->first();
                    $imgUrl   = $firstImg ? asset('storage/' . $firstImg->image_path) : null;
                    $multiImg = $post->images->count() > 1;
                @endphp
                <button data-post-id="{{ $post->id }}" class="profile-thumb">
                    @if($imgUrl)
                        <img src="{{ $imgUrl }}" alt="Post" loading="lazy">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-violet-900/50 to-purple-900/50 flex items-center justify-center">
                            <svg class="w-8 h-8 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif

                    {{-- Multi-image badge --}}
                    @if($multiImg)
                    <div class="absolute top-2 right-2 z-10">
                        <svg class="w-5 h-5 text-white drop-shadow" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <rect x="7" y="3" width="14" height="14" rx="2"/>
                            <path d="M3 7v12a2 2 0 002 2h12"/>
                        </svg>
                    </div>
                    @endif

                    {{-- Hover overlay --}}
                    <div class="thumb-overlay">
                        <span class="thumb-stat">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            {{ $post->likes_count }}
                        </span>
                    </div>
                </button>
                @endforeach
            </div>
            @endif
        </div>

        {{-- ── Saved tab content ── --}}
        <div id="panel-saved" class="hidden">
            <div x-data="{ savedTab: 'posts' }">

                {{-- Sub-tab bar --}}
                <div class="flex items-center gap-2 py-3 overflow-x-auto scrollbar-none">
                    @foreach(['posts' => 'Posts', 'patterns' => 'Patterns', 'collections' => 'Collections'] as $val => $label)
                    <button @click="savedTab = '{{ $val }}'"
                            :class="savedTab === '{{ $val }}'
                                ? 'bg-violet-600 text-white border-violet-600'
                                : 'bg-transparent text-zinc-400 border-zinc-700 hover:border-zinc-500 hover:text-zinc-200'"
                            class="shrink-0 px-4 py-1.5 rounded-full text-xs font-semibold border transition-all duration-200">
                        {{ $label }}
                    </button>
                    @endforeach
                </div>

                {{-- Posts sub-tab --}}
                <div x-show="savedTab === 'posts'" x-transition>
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xs font-semibold text-zinc-500 uppercase tracking-wider">Collections</h3>
                        <button onclick="openNewCollectionModal(null)"
                                class="flex items-center gap-1 text-sm font-semibold text-violet-400 hover:text-violet-300 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                            </svg>
                            New
                        </button>
                    </div>

                    @if($savedPosts->isEmpty() && $postCollections->isEmpty())
                    <div class="flex flex-col items-center justify-center py-24 text-center">
                        <div class="w-20 h-20 rounded-full border-2 border-zinc-600 flex items-center justify-center mb-5">
                            <svg class="w-10 h-10 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-extrabold mb-2">Save Photos and Videos</h3>
                        <p class="text-zinc-400 text-sm">Save things you want to see again. No one is notified, and only you can see what you've saved.</p>
                    </div>
                    @else
                    @php
                        $allCoverImages = $savedPosts->map(fn($p) => $p->images->first())->filter()->take(4)->values();
                        $allCoverCount  = $allCoverImages->count();
                    @endphp
                    <div id="post-collections-grid" class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        {{-- Fixed "All Posts" card --}}
                        <a href="{{ route('post-collections.all') }}"
                           class="group block rounded-xl overflow-hidden bg-zinc-900 ring-1 ring-zinc-800 hover:ring-violet-500/50 transition-all">
                            <div class="aspect-square overflow-hidden bg-zinc-800">
                                @if($allCoverCount > 0)
                                <div class="grid h-full w-full gap-0.5 {{ $allCoverCount === 1 ? 'grid-cols-1 grid-rows-1' : 'grid-cols-2 grid-rows-2' }}">
                                    @if($allCoverCount === 1)
                                        <img src="{{ asset('storage/' . $allCoverImages[0]->image_path) }}"
                                             class="h-full w-full object-cover" loading="lazy">
                                    @elseif($allCoverCount === 2)
                                        <img src="{{ asset('storage/' . $allCoverImages[0]->image_path) }}"
                                             class="col-span-2 row-span-1 h-full w-full object-cover" loading="lazy">
                                        <img src="{{ asset('storage/' . $allCoverImages[1]->image_path) }}"
                                             class="col-span-2 row-span-1 h-full w-full object-cover" loading="lazy">
                                    @elseif($allCoverCount === 3)
                                        <img src="{{ asset('storage/' . $allCoverImages[0]->image_path) }}"
                                             class="col-span-2 row-span-1 h-full w-full object-cover" loading="lazy">
                                        <img src="{{ asset('storage/' . $allCoverImages[1]->image_path) }}"
                                             class="col-span-1 row-span-1 h-full w-full object-cover" loading="lazy">
                                        <img src="{{ asset('storage/' . $allCoverImages[2]->image_path) }}"
                                             class="col-span-1 row-span-1 h-full w-full object-cover" loading="lazy">
                                    @else
                                        @foreach($allCoverImages as $img)
                                        <img src="{{ asset('storage/' . $img->image_path) }}"
                                             class="col-span-1 row-span-1 h-full w-full object-cover" loading="lazy">
                                        @endforeach
                                    @endif
                                </div>
                                @else
                                <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-violet-900/40 to-purple-900/40">
                                    <svg class="w-10 h-10 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                    </svg>
                                </div>
                                @endif
                            </div>
                            <div class="px-3 py-2.5">
                                <p class="text-sm font-semibold text-white">All Posts</p>
                                <p class="text-xs text-zinc-400">{{ $savedPosts->count() }} {{ Str::plural('post', $savedPosts->count()) }}</p>
                            </div>
                        </a>
                        @foreach($postCollections as $col)
                        @php
                            $coverImages = $col->posts
                                ->map(fn($p) => $p->images->first())
                                ->filter()
                                ->take(4)
                                ->values();
                            $coverCount = $coverImages->count();
                        @endphp
                        <a href="{{ route('post-collections.show', $col) }}"
                           class="group block rounded-xl overflow-hidden bg-zinc-900 ring-1 ring-zinc-800 hover:ring-violet-500/50 transition-all">
                            <div class="aspect-square overflow-hidden bg-zinc-800">
                                @if($coverCount > 0)
                                <div class="grid h-full w-full gap-0.5 {{ $coverCount === 1 ? 'grid-cols-1 grid-rows-1' : 'grid-cols-2 grid-rows-2' }}">
                                    @if($coverCount === 1)
                                        <img src="{{ asset('storage/' . $coverImages[0]->image_path) }}"
                                             class="h-full w-full object-cover" loading="lazy">
                                    @elseif($coverCount === 2)
                                        <img src="{{ asset('storage/' . $coverImages[0]->image_path) }}"
                                             class="col-span-2 row-span-1 h-full w-full object-cover" loading="lazy">
                                        <img src="{{ asset('storage/' . $coverImages[1]->image_path) }}"
                                             class="col-span-2 row-span-1 h-full w-full object-cover" loading="lazy">
                                    @elseif($coverCount === 3)
                                        <img src="{{ asset('storage/' . $coverImages[0]->image_path) }}"
                                             class="col-span-2 row-span-1 h-full w-full object-cover" loading="lazy">
                                        <img src="{{ asset('storage/' . $coverImages[1]->image_path) }}"
                                             class="col-span-1 row-span-1 h-full w-full object-cover" loading="lazy">
                                        <img src="{{ asset('storage/' . $coverImages[2]->image_path) }}"
                                             class="col-span-1 row-span-1 h-full w-full object-cover" loading="lazy">
                                    @else
                                        @foreach($coverImages as $img)
                                        <img src="{{ asset('storage/' . $img->image_path) }}"
                                             class="col-span-1 row-span-1 h-full w-full object-cover" loading="lazy">
                                        @endforeach
                                    @endif
                                </div>
                                @else
                                <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-violet-900/40 to-purple-900/40">
                                    <svg class="w-10 h-10 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                </div>
                                @endif
                            </div>
                            <div class="px-3 py-2.5">
                                <p class="text-sm font-semibold text-white truncate">{{ $col->name }}</p>
                                <p class="text-xs text-zinc-400">{{ $col->posts_count }} {{ Str::plural('post', $col->posts_count) }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    @endif
                </div>

                {{-- Patterns sub-tab --}}
                <div x-show="savedTab === 'patterns'" x-transition>
                    @if($favoritePatterns->isEmpty())
                    <div class="flex flex-col items-center justify-center py-24 text-center">
                        <div class="w-20 h-20 rounded-full border-2 border-zinc-600 flex items-center justify-center mb-5">
                            <svg class="w-10 h-10 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-extrabold mb-2">No Saved Patterns</h3>
                        <p class="text-zinc-400 text-sm">Patterns you favourite will appear here.</p>
                    </div>
                    @else
                    <div x-data="{ craft: 'all' }">
                        <div class="flex items-center gap-2 py-3 overflow-x-auto scrollbar-none">
                            @foreach(['all' => 'All', 'crochet' => 'Crochet', 'knitting' => 'Knitting', 'embroidery' => 'Embroidery'] as $val => $label)
                            <button @click="craft = '{{ $val }}'"
                                    :class="craft === '{{ $val }}'
                                        ? 'bg-violet-600 text-white border-violet-600'
                                        : 'bg-transparent text-zinc-400 border-zinc-700 hover:border-zinc-500 hover:text-zinc-200'"
                                    class="shrink-0 px-4 py-1.5 rounded-full text-xs font-semibold border transition-all duration-200">
                                {{ $label }}
                            </button>
                            @endforeach
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            @foreach($favoritePatterns as $pattern)
                            <a href="{{ route('patterns.view', $pattern) }}"
                               x-show="craft === 'all' || craft === '{{ $pattern->craft_type }}'"
                               x-transition
                               class="group relative rounded-xl overflow-hidden bg-zinc-900 border border-zinc-800 hover:border-violet-500/50 transition-all duration-200">
                                @if($pattern->image_path)
                                    <img src="{{ asset('storage/' . $pattern->image_path) }}" alt="{{ $pattern->title }}"
                                         class="w-full aspect-square object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                                @else
                                    <div class="w-full aspect-square bg-gradient-to-br from-violet-900/40 to-purple-900/40 flex items-center justify-center">
                                        <svg class="w-10 h-10 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                <div class="p-2.5">
                                    <p class="text-sm font-semibold text-white truncate">{{ $pattern->title }}</p>
                                    <p class="text-xs text-zinc-400 capitalize mt-0.5">{{ $pattern->craft_type }} · {{ $pattern->difficulty }}</p>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Collections sub-tab --}}
                <div x-show="savedTab === 'collections'" x-transition>
                    @if($favoriteCollections->isEmpty())
                    <div class="flex flex-col items-center justify-center py-24 text-center">
                        <div class="w-20 h-20 rounded-full border-2 border-zinc-600 flex items-center justify-center mb-5">
                            <svg class="w-10 h-10 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-extrabold mb-2">No Saved Collections</h3>
                        <p class="text-zinc-400 text-sm">Collections you favourite will appear here.</p>
                    </div>
                    @else
                    <div x-data="{ craft: 'all' }">
                        <div class="flex items-center gap-2 py-3 overflow-x-auto scrollbar-none">
                            @foreach(['all' => 'All', 'crochet' => 'Crochet', 'knitting' => 'Knitting', 'embroidery' => 'Embroidery'] as $val => $label)
                            <button @click="craft = '{{ $val }}'"
                                    :class="craft === '{{ $val }}'
                                        ? 'bg-violet-600 text-white border-violet-600'
                                        : 'bg-transparent text-zinc-400 border-zinc-700 hover:border-zinc-500 hover:text-zinc-200'"
                                    class="shrink-0 px-4 py-1.5 rounded-full text-xs font-semibold border transition-all duration-200">
                                {{ $label }}
                            </button>
                            @endforeach
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            @foreach($favoriteCollections as $collection)
                            <a href="{{ route('collections.show', $collection) }}"
                               x-show="craft === 'all' || craft === '{{ $collection->craft_type }}'"
                               x-transition
                               class="group relative rounded-xl overflow-hidden bg-zinc-900 border border-zinc-800 hover:border-violet-500/50 transition-all duration-200">
                                <div class="w-full aspect-square overflow-hidden">
                                    @if($collection->cover_image_path)
                                        <img src="{{ asset('storage/' . $collection->cover_image_path) }}"
                                             alt="{{ $collection->name }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                                    @elseif($collection->patterns->isNotEmpty())
                                        @php $imgs = $collection->patterns->take(4)->values(); @endphp
                                        <div class="grid h-full w-full gap-0.5
                                            {{ $imgs->count() === 1 ? 'grid-cols-1 grid-rows-1' : 'grid-cols-2 grid-rows-2' }}">
                                            @if($imgs->count() === 1)
                                                <img src="{{ asset('storage/' . $imgs[0]->image_path) }}" class="w-full h-full object-cover" loading="lazy">
                                            @elseif($imgs->count() === 2)
                                                <img src="{{ asset('storage/' . $imgs[0]->image_path) }}" class="col-span-2 row-span-1 w-full h-full object-cover" loading="lazy">
                                                <img src="{{ asset('storage/' . $imgs[1]->image_path) }}" class="col-span-2 row-span-1 w-full h-full object-cover" loading="lazy">
                                            @elseif($imgs->count() === 3)
                                                <img src="{{ asset('storage/' . $imgs[0]->image_path) }}" class="col-span-2 row-span-1 w-full h-full object-cover" loading="lazy">
                                                <img src="{{ asset('storage/' . $imgs[1]->image_path) }}" class="col-span-1 row-span-1 w-full h-full object-cover" loading="lazy">
                                                <img src="{{ asset('storage/' . $imgs[2]->image_path) }}" class="col-span-1 row-span-1 w-full h-full object-cover" loading="lazy">
                                            @else
                                                @foreach($imgs as $p)
                                                    <img src="{{ asset('storage/' . $p->image_path) }}" class="col-span-1 row-span-1 w-full h-full object-cover" loading="lazy">
                                                @endforeach
                                            @endif
                                        </div>
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-sky-900/40 to-indigo-900/40 flex items-center justify-center">
                                            <svg class="w-10 h-10 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-2.5">
                                    <p class="text-sm font-semibold text-white truncate">{{ $collection->name }}</p>
                                    <p class="text-xs text-zinc-400 mt-0.5">{{ $collection->patterns_count }} {{ Str::plural('pattern', $collection->patterns_count) }}</p>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

            </div>
        </div>

        {{-- ── Liked tab content ── --}}
        <div id="panel-liked" class="hidden">
            @if($likedPosts->isEmpty())
            <div class="flex flex-col items-center justify-center py-24 text-center">
                <div class="w-20 h-20 rounded-full border-2 border-zinc-600 flex items-center justify-center mb-5">
                    <svg class="w-10 h-10 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-extrabold mb-2">No Liked Posts Yet</h3>
                <p class="text-zinc-400 text-sm">Posts you like will appear here.</p>
            </div>
            @else
            <div class="grid grid-cols-3 gap-0.5">
                @foreach($likedPosts as $post)
                @php
                    $firstImg = $post->images->first();
                    $imgUrl   = $firstImg ? asset('storage/' . $firstImg->image_path) : null;
                    $multiImg = $post->images->count() > 1;
                @endphp
                <button data-post-id="{{ $post->id }}" class="profile-thumb">
                    @if($imgUrl)
                        <img src="{{ $imgUrl }}" alt="Liked post" loading="lazy">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-violet-900/50 to-purple-900/50 flex items-center justify-center">
                            <svg class="w-8 h-8 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                    {{-- Multi-image badge --}}
                    @if($multiImg)
                    <div class="absolute top-2 right-2 z-10">
                        <svg class="w-5 h-5 text-white drop-shadow" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <rect x="7" y="3" width="14" height="14" rx="2"/>
                            <path d="M3 7v12a2 2 0 002 2h12"/>
                        </svg>
                    </div>
                    @endif
                    <div class="thumb-overlay">
                        <span class="thumb-stat">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            {{ $post->likes_count }}
                        </span>
                    </div>
                </button>
                @endforeach
            </div>
            @endif
        </div>

        {{-- ── Patterns tab content ── --}}
        <div id="panel-patterns" class="hidden">
            @if($patterns->isEmpty())
            <div class="flex flex-col items-center justify-center py-24 text-center">
                <div class="w-20 h-20 rounded-full border-2 border-zinc-600 flex items-center justify-center mb-5">
                    <svg class="w-10 h-10 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-extrabold mb-2">No Patterns Yet</h3>
                <p class="text-zinc-400 text-sm mb-5">Patterns you upload will appear here.</p>
                <a href="{{ route('patterns.create') }}"
                   class="text-sm font-semibold text-sky-400 hover:text-sky-300 transition-colors">Upload your first pattern</a>
            </div>
            @else
            <div x-data="{ craft: 'all' }">
                {{-- Mini craft filter --}}
                <div class="flex items-center gap-2 py-3 overflow-x-auto scrollbar-none">
                    @foreach(['all' => 'All', 'crochet' => 'Crochet', 'knitting' => 'Knitting', 'embroidery' => 'Embroidery'] as $val => $label)
                    <button @click="craft = '{{ $val }}'"
                            :class="craft === '{{ $val }}'
                                ? 'bg-violet-600 text-white border-violet-600'
                                : 'bg-transparent text-zinc-400 border-zinc-700 hover:border-zinc-500 hover:text-zinc-200'"
                            class="shrink-0 px-4 py-1.5 rounded-full text-xs font-semibold border transition-all duration-200">
                        {{ $label }}
                    </button>
                    @endforeach
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                    @foreach($patterns as $pattern)
                    <a href="{{ route('patterns.view', $pattern) }}"
                       x-show="craft === 'all' || craft === '{{ $pattern->craft_type }}'"
                       x-transition
                       class="group relative rounded-xl overflow-hidden bg-zinc-900 border border-zinc-800 hover:border-violet-500/50 transition-all duration-200">
                        @if($pattern->image_path)
                            <img src="{{ asset('storage/' . $pattern->image_path) }}" alt="{{ $pattern->title }}"
                                 class="w-full aspect-square object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                        @else
                            <div class="w-full aspect-square bg-gradient-to-br from-violet-900/40 to-purple-900/40 flex items-center justify-center">
                                <svg class="w-10 h-10 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                        @endif
                        <div class="p-2.5">
                            <p class="text-sm font-semibold text-white truncate">{{ $pattern->title }}</p>
                            <p class="text-xs text-zinc-400 capitalize mt-0.5">{{ $pattern->craft_type }} · {{ $pattern->difficulty }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        {{-- ── Collections tab content ── --}}
        <div id="panel-collections" class="hidden">
            @if($collections->isEmpty())
            <div class="flex flex-col items-center justify-center py-24 text-center">
                <div class="w-20 h-20 rounded-full border-2 border-zinc-600 flex items-center justify-center mb-5">
                    <svg class="w-10 h-10 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-extrabold mb-2">No Collections Yet</h3>
                <p class="text-zinc-400 text-sm mb-5">Collections you create will appear here.</p>
                <a href="{{ route('collections.create') }}"
                   class="text-sm font-semibold text-sky-400 hover:text-sky-300 transition-colors">Create your first collection</a>
            </div>
            @else
            <div x-data="{ craft: 'all' }">
                {{-- Mini craft filter --}}
                <div class="flex items-center gap-2 py-3 overflow-x-auto scrollbar-none">
                    @foreach(['all' => 'All', 'crochet' => 'Crochet', 'knitting' => 'Knitting', 'embroidery' => 'Embroidery'] as $val => $label)
                    <button @click="craft = '{{ $val }}'"
                            :class="craft === '{{ $val }}'
                                ? 'bg-violet-600 text-white border-violet-600'
                                : 'bg-transparent text-zinc-400 border-zinc-700 hover:border-zinc-500 hover:text-zinc-200'"
                            class="shrink-0 px-4 py-1.5 rounded-full text-xs font-semibold border transition-all duration-200">
                        {{ $label }}
                    </button>
                    @endforeach
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                    @foreach($collections as $collection)
                    <a href="{{ route('collections.show', $collection) }}"
                       x-show="craft === 'all' || craft === '{{ $collection->craft_type }}'"
                       x-transition
                       class="group relative rounded-xl overflow-hidden bg-zinc-900 border border-zinc-800 hover:border-violet-500/50 transition-all duration-200">
                        <div class="w-full aspect-square overflow-hidden">
                            @if($collection->cover_image_path)
                                <img src="{{ asset('storage/' . $collection->cover_image_path) }}"
                                     alt="{{ $collection->name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                     loading="lazy">
                            @elseif($collection->patterns->isNotEmpty())
                                @php $imgs = $collection->patterns->take(4)->values(); @endphp
                                <div class="grid h-full w-full gap-0.5
                                    {{ $imgs->count() === 1 ? 'grid-cols-1 grid-rows-1' : 'grid-cols-2 grid-rows-2' }}">
                                    @if($imgs->count() === 1)
                                        <img src="{{ asset('storage/' . $imgs[0]->image_path) }}"
                                             alt="{{ $imgs[0]->title }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                             loading="lazy">
                                    @elseif($imgs->count() === 2)
                                        <img src="{{ asset('storage/' . $imgs[0]->image_path) }}"
                                             class="col-span-2 row-span-1 w-full h-full object-cover" loading="lazy">
                                        <img src="{{ asset('storage/' . $imgs[1]->image_path) }}"
                                             class="col-span-2 row-span-1 w-full h-full object-cover" loading="lazy">
                                    @elseif($imgs->count() === 3)
                                        <img src="{{ asset('storage/' . $imgs[0]->image_path) }}"
                                             class="col-span-2 row-span-1 w-full h-full object-cover" loading="lazy">
                                        <img src="{{ asset('storage/' . $imgs[1]->image_path) }}"
                                             class="col-span-1 row-span-1 w-full h-full object-cover" loading="lazy">
                                        <img src="{{ asset('storage/' . $imgs[2]->image_path) }}"
                                             class="col-span-1 row-span-1 w-full h-full object-cover" loading="lazy">
                                    @else
                                        @foreach($imgs as $p)
                                            <img src="{{ asset('storage/' . $p->image_path) }}"
                                                 class="col-span-1 row-span-1 w-full h-full object-cover" loading="lazy">
                                        @endforeach
                                    @endif
                                </div>
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-sky-900/40 to-indigo-900/40 flex items-center justify-center">
                                    <svg class="w-10 h-10 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-2.5">
                            <p class="text-sm font-semibold text-white truncate">{{ $collection->name }}</p>
                            <p class="text-xs text-zinc-400 mt-0.5">{{ $collection->patterns_count }} {{ Str::plural('pattern', $collection->patterns_count) }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

    </div>{{-- /max-w-3xl --}}

    {{-- ══════════════════════════════════════════════════
         POST DETAIL MODAL
    ══════════════════════════════════════════════════ --}}
    <div id="post-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-2 sm:p-6 bg-black/80 backdrop-blur-sm" onclick="handlePostModalBackdrop(event)">
        <div class="relative flex flex-col md:flex-row w-full max-w-6xl rounded-2xl overflow-hidden shadow-2xl ring-1 ring-zinc-700 bg-zinc-900" style="max-height:90vh;" onclick="event.stopPropagation()">

            {{-- ✕ close button --}}
            <button onclick="closePostModal()" class="absolute top-3 right-3 z-20 w-8 h-8 flex items-center justify-center rounded-full bg-zinc-800/80 hover:bg-zinc-700 text-zinc-300 hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            {{-- ── LEFT: image carousel ── --}}
            <div class="relative flex-none w-full md:w-3/5 bg-black flex items-stretch" style="min-height:320px; max-height:90vh;">
                <div id="pm-carousel" class="w-full overflow-hidden relative" style="min-height:320px;">
                    <div id="pm-track"></div>
                </div>

                {{-- Prev arrow --}}
                <button id="pm-prev" onclick="pmGo(-1)" class="absolute left-2 top-1/2 -translate-y-1/2 z-10 w-8 h-8 flex items-center justify-center rounded-full bg-black/55 text-white hover:bg-black/80 transition hidden">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </button>
                {{-- Next arrow --}}
                <button id="pm-next" onclick="pmGo(1)" class="absolute right-2 top-1/2 -translate-y-1/2 z-10 w-8 h-8 flex items-center justify-center rounded-full bg-black/55 text-white hover:bg-black/80 transition hidden">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>

                {{-- Dots --}}
                <div id="pm-dots" class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-1.5 z-10"></div>
            </div>

            {{-- ── RIGHT: post meta ── --}}
            <div class="flex flex-col w-full md:w-2/5 min-w-0 border-t border-zinc-800 md:border-t-0 md:border-l md:border-zinc-800" style="max-height:90vh;">

                {{-- Author header --}}
                <div class="flex items-center gap-3 px-4 py-3 border-b border-zinc-800 shrink-0">
                    <div id="pm-avatar" class="w-9 h-9 rounded-full bg-gradient-to-br from-violet-500 to-purple-500 flex items-center justify-center text-sm font-bold text-white shrink-0 select-none"></div>
                    <div class="min-w-0 flex-1">
                        <p id="pm-author" class="text-sm font-semibold text-white truncate"></p>
                        <p id="pm-time"   class="text-xs text-zinc-500"></p>
                    </div>
                    <span id="pm-badge" class="inline-flex items-center rounded-full bg-violet-900/40 text-violet-300 px-2.5 py-0.5 text-xs font-semibold capitalize shrink-0"></span>
                </div>

                {{-- Scrollable body --}}
                <div class="flex-1 overflow-y-auto px-4 py-4 space-y-3 text-sm">
                    <p id="pm-desc" class="text-zinc-200 leading-relaxed whitespace-pre-wrap break-words"></p>
                    <div id="pm-tags" class="flex flex-wrap gap-1.5"></div>
                </div>

                {{-- Action bar --}}
                <div class="shrink-0 border-t border-zinc-800 px-4 py-3 space-y-2">
                    <div class="flex items-center justify-between">

                        {{-- Like --}}
                        @auth
                        <button id="pm-like-btn" onclick="pmToggleLike()" class="flex items-center gap-1.5 text-zinc-400 transition-colors duration-200 hover:text-red-400">
                            <svg id="pm-like-icon" class="w-6 h-6 stroke-2 transition-transform duration-150 hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            <span id="pm-like-count" class="text-sm font-medium"></span>
                        </button>
                        @else
                        <div class="flex items-center gap-1.5 text-zinc-600">
                            <svg class="w-6 h-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            <span id="pm-like-count" class="text-sm font-medium"></span>
                        </div>
                        @endauth

                        {{-- Save --}}
                        @auth
                        <button id="pm-save-btn" onclick="pmToggleSave()" class="text-zinc-400 transition-colors duration-200 hover:text-violet-400">
                            <svg id="pm-save-icon" class="w-6 h-6 stroke-2 hover:scale-110 transition-transform duration-150" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                            </svg>
                        </button>
                        @endauth
                    </div>

                    {{-- Likes label --}}
                    <p id="pm-likes-label" class="text-xs text-zinc-500"></p>

                    {{-- Comment input (decorative – no comments table yet) --}}
                    <div class="flex items-center gap-2 pt-1 border-t border-zinc-800">
                        <svg class="w-6 h-6 text-zinc-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <input type="text" placeholder="Add a comment…"
                               class="flex-1 bg-transparent text-sm text-zinc-300 placeholder-zinc-600 outline-none py-1"/>
                        <button class="text-sm font-semibold text-violet-400 hover:text-violet-300 transition-colors">Post</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Followers/Following Modal ── --}}
    <div id="follow-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeFollowModal()"></div>
        <div class="relative w-full max-w-sm bg-zinc-900 rounded-2xl shadow-2xl ring-1 ring-zinc-700 overflow-hidden">
            {{-- Modal header --}}
            <div class="flex items-center justify-between px-4 pt-4 pb-3 border-b border-zinc-800">
                <h2 id="follow-modal-title" class="text-base font-semibold text-white">Followers</h2>
                <button onclick="closeFollowModal()" class="text-zinc-400 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            {{-- Followers list --}}
            <div id="follow-modal-content" class="max-h-80 overflow-y-auto divide-y divide-zinc-800">
                @forelse($user->followers as $follower)
                <a href="{{ route('users.show', $follower) }}" class="flex items-center gap-3 px-4 py-3 hover:bg-zinc-800/50 transition-colors">
                    @if($follower->profile_picture)
                        <img src="{{ asset('storage/' . $follower->profile_picture) }}"
                             alt="{{ $follower->username }}"
                             class="w-10 h-10 rounded-full object-cover shrink-0">
                    @else
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-violet-500 to-purple-500 flex items-center justify-center text-sm font-bold text-white shrink-0">
                            {{ $follower->initials() }}
                        </div>
                    @endif
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-white truncate">{{ $follower->username }}</p>
                        <p class="text-xs text-zinc-400 truncate">{{ $follower->name }}</p>
                    </div>
                </a>
                @empty
                <p class="px-4 py-6 text-sm text-zinc-500 text-center">No followers yet.</p>
                @endforelse
            </div>
        </div>
    </div>

</div>{{-- /bg-zinc-950 --}}

{{-- ══════════════════════════════════════════════════════════
     Post-Collection – "New Collection" Quick Create Modal
     ══════════════════════════════════════════════════════════ --}}
<div id="new-collection-modal"
     class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm">
    <div class="bg-zinc-900 border border-zinc-700 rounded-2xl w-full max-w-sm p-6 shadow-2xl">
        <h3 class="text-lg font-bold text-white mb-4">New Collection</h3>
        <input id="nc-name" type="text" maxlength="100" placeholder="Collection name"
               class="w-full rounded-xl bg-zinc-800 border border-zinc-700 text-white px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-violet-500 mb-4">
        <div class="flex gap-3 justify-end">
            <button onclick="document.getElementById('new-collection-modal').classList.add('hidden')"
                    class="px-4 py-2 text-sm font-semibold text-zinc-400 hover:text-white transition-colors">
                Cancel
            </button>
            <button onclick="submitNewCollection()"
                    class="px-5 py-2 text-sm font-semibold bg-violet-600 hover:bg-violet-500 text-white rounded-xl transition-colors">
                Create
            </button>
        </div>
    </div>
</div>

@php
$followingUsers = $user->following()->get();
$followingHTML  = '';
foreach ($followingUsers as $fu) {
    $initials   = $fu->initials();
    $name       = e($fu->name);
    $username   = e($fu->username);
    $profileUrl = e(route('users.show', $fu));
    $avatarHtml = $fu->profile_picture
        ? '<img src="' . e(asset('storage/' . $fu->profile_picture)) . '" alt="' . $username . '" class="w-10 h-10 rounded-full object-cover shrink-0">'
        : '<div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-blue-500 flex items-center justify-center text-sm font-bold text-white shrink-0">' . $initials . '</div>';
    $followingHTML .= '<a href="' . $profileUrl . '" class="flex items-center gap-3 px-4 py-3 hover:bg-zinc-800/50 transition-colors">'
        . $avatarHtml
        . '<div class="min-w-0"><p class="text-sm font-semibold text-white truncate">' . $username . '</p>'
        . '<p class="text-xs text-zinc-400 truncate">' . $name . '</p></div>'
        . '</a>';
}
if (!$followingHTML) {
    $followingHTML = '<p class="px-4 py-6 text-sm text-zinc-500 text-center">Not following anyone yet.</p>';
}
@endphp

@push('scripts')
<script id="following-data" type="application/json">@json($followingHTML)</script>
<script id="post-data"      type="application/json">@json($allPostData)</script>
<script>
// ── Thumbnail click → open post modal ─────────────────────
document.addEventListener('click', function (e) {
    const btn = e.target.closest('[data-post-id]');
    if (btn) openPostModal(btn.dataset.postId);
});

// ── Tab switching
// ═══════════════════════════════════════════════════════════
const tabs = ['posts', 'saved', 'liked', 'patterns', 'collections'];
function slideIndicator(name) {
    const indEl = document.getElementById('tab-indicator');
    const activeBtn = document.getElementById('tab-' + name);
    indEl.style.left  = activeBtn.offsetLeft + 'px';
    indEl.style.width = activeBtn.offsetWidth + 'px';
}

function switchTab(name) {
    tabs.forEach(t => {
        const panel = document.getElementById('panel-' + t);
        const btn   = document.getElementById('tab-' + t);
        if (t === name) {
            // Set starting state before unhiding
            panel.style.transition = 'none';
            panel.style.opacity    = '0';
            panel.style.transform  = 'translateY(12px)';
            panel.classList.remove('hidden');
            // Double rAF ensures browser paints the start state before transitioning
            requestAnimationFrame(() => requestAnimationFrame(() => {
                panel.style.transition = 'opacity .28s ease, transform .28s ease';
                panel.style.opacity    = '1';
                panel.style.transform  = 'translateY(0)';
            }));
            btn.classList.add('active', 'text-white');
            btn.classList.remove('text-zinc-400');
        } else {
            panel.classList.add('hidden');
            panel.style.transition = '';
            panel.style.opacity    = '';
            panel.style.transform  = '';
            btn.classList.remove('active', 'text-white');
            btn.classList.add('text-zinc-400');
        }
    });
    slideIndicator(name);
}

// Init indicator on load
(function initIndicator() {
    const indEl = document.getElementById('tab-indicator');
    const firstBtn = document.getElementById('tab-posts');
    indEl.style.transition = 'none';
    indEl.style.left  = firstBtn.offsetLeft + 'px';
    indEl.style.width = firstBtn.offsetWidth + 'px';
    // Re-enable transition after placement
    requestAnimationFrame(() => { indEl.style.transition = ''; });
})();

// ═══════════════════════════════════════════════════════════
// Followers / Following modal
// ═══════════════════════════════════════════════════════════
const followersHTML = document.getElementById('follow-modal-content').innerHTML;
const followingHTML = JSON.parse(document.getElementById('following-data').textContent);

function openFollowModal(type) {
    const modal   = document.getElementById('follow-modal');
    const title   = document.getElementById('follow-modal-title');
    const content = document.getElementById('follow-modal-content');
    title.textContent = type === 'followers' ? 'Followers' : 'Following';
    content.innerHTML = type === 'followers' ? followersHTML : followingHTML;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}
function closeFollowModal() {
    const m = document.getElementById('follow-modal');
    m.classList.add('hidden');
    m.classList.remove('flex');
}

// ═══════════════════════════════════════════════════════════
// Post modal
// ═══════════════════════════════════════════════════════════
const allPosts = JSON.parse(document.getElementById('post-data').textContent);
const _csrf    = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
let   _current = null;  // current post object
let   _pmIndex = 0;     // current slide index

function openPostModal(postId) {
    const post = allPosts[postId];
    if (!post) return;
    _current = post;
    _pmIndex = 0;

    // Populate header
    document.getElementById('pm-avatar').textContent = post.initials;
    document.getElementById('pm-author').textContent = post.author;
    document.getElementById('pm-time').textContent   = post.created_at;
    document.getElementById('pm-badge').textContent  = post.craft_type;

    // Description
    document.getElementById('pm-desc').textContent = post.description;

    // Tags
    const tagsEl = document.getElementById('pm-tags');
    tagsEl.innerHTML = '';
    (post.tags || []).forEach(tag => {
        const span = document.createElement('span');
        span.className   = 'text-xs text-violet-400 hover:text-violet-300 cursor-default';
        span.textContent = '#' + tag;
        tagsEl.appendChild(span);
    });

    // Like / save state
    pmSetLike(post.is_liked, post.likes_count);
    pmSetSave(post.is_faved);

    // Build carousel slides
    const track = document.getElementById('pm-track');
    const dots  = document.getElementById('pm-dots');
    track.innerHTML = '';
    dots.innerHTML  = '';
    const imgs = (post.images && post.images.length) ? post.images : [null];
    imgs.forEach((url, i) => {
        const slide = document.createElement('div');
        slide.className = 'pm-slide';
        if (url) {
            const img = document.createElement('img');
            img.src = url;
            img.alt = 'Post image';
            slide.appendChild(img);
        } else {
            slide.innerHTML = `<svg class="w-16 h-16 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>`;
        }
        track.appendChild(slide);

        if (imgs.length > 1) {
            const dot = document.createElement('div');
            dot.className = 'w-1.5 h-1.5 rounded-full transition-all duration-200 ' + (i === 0 ? 'bg-white !w-2.5' : 'bg-white/40');
            dots.appendChild(dot);
        }
    });

    // Sync carousel track height
    const carouselEl = document.getElementById('pm-carousel');
    const parentH    = carouselEl.parentElement.offsetHeight || 560;
    carouselEl.style.height = parentH + 'px';
    track.style.height = '100%';

    pmUpdateArrows(imgs.length);
    pmGoTo(0);

    // Show modal
    const modal = document.getElementById('post-modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closePostModal() {
    document.getElementById('post-modal').classList.add('hidden');
    document.getElementById('post-modal').classList.remove('flex');
    document.body.style.overflow = '';
    _current = null;
}

function handlePostModalBackdrop(e) {
    if (e.target === document.getElementById('post-modal')) closePostModal();
}

// ── Carousel helpers ──────────────────────────────────────
function pmGoTo(index) {
    const track = document.getElementById('pm-track');
    const total = track.children.length;
    _pmIndex = Math.max(0, Math.min(index, total - 1));
    track.style.transform = `translateX(-${_pmIndex * 100}%)`;
    const dots = document.getElementById('pm-dots').children;
    Array.from(dots).forEach((d, i) => {
        d.className = 'rounded-full transition-all duration-200 ' + (i === _pmIndex ? 'bg-white w-2.5 h-1.5' : 'bg-white/40 w-1.5 h-1.5');
    });
    pmUpdateArrows(total);
}
function pmGo(dir) { pmGoTo(_pmIndex + dir); }
function pmUpdateArrows(total) {
    document.getElementById('pm-prev').classList.toggle('hidden', total <= 1 || _pmIndex === 0);
    document.getElementById('pm-next').classList.toggle('hidden', total <= 1 || _pmIndex >= total - 1);
}

// ── Like helpers ──────────────────────────────────────────
function pmSetLike(liked, count) {
    const icon  = document.getElementById('pm-like-icon');
    const countEl = document.getElementById('pm-like-count');
    const label   = document.getElementById('pm-likes-label');
    const btn     = document.getElementById('pm-like-btn');
    if (icon) {
        icon.setAttribute('fill', liked ? 'currentColor' : 'none');
        if (btn) {
            btn.classList.toggle('text-red-500',  liked);
            btn.classList.toggle('text-zinc-400', !liked);
        }
    }
    if (countEl) countEl.textContent = count;
    if (label)   label.textContent   = count + (count === 1 ? ' like' : ' likes');
}

function pmSetSave(saved) {
    const icon = document.getElementById('pm-save-icon');
    const btn  = document.getElementById('pm-save-btn');
    if (!icon) return;
    icon.setAttribute('fill', saved ? 'currentColor' : 'none');
    if (btn) {
        btn.classList.toggle('text-violet-400', saved);
        btn.classList.toggle('text-zinc-400',   !saved);
    }
}

async function pmToggleLike() {
    if (!_current) return;
    const liked  = _current.is_liked;
    const url    = liked ? _current.unlike_url : _current.like_url;
    const method = liked ? 'DELETE' : 'POST';
    try {
        const res  = await fetch(url, { method, headers: { 'X-CSRF-TOKEN': _csrf, 'Accept': 'application/json' } });
        const data = await res.json();
        _current.is_liked    = data.liked;
        _current.likes_count = data.count;
        allPosts[_current.id].is_liked    = data.liked;
        allPosts[_current.id].likes_count = data.count;
        pmSetLike(data.liked, data.count);
    } catch (err) { console.error('Like error:', err); }
}

async function pmToggleSave() {
    if (!_current) return;
    const saved  = _current.is_faved;
    const url    = saved ? _current.unfav_url : _current.fav_url;
    const method = saved ? 'DELETE' : 'POST';
    try {
        const res  = await fetch(url, { method, headers: { 'X-CSRF-TOKEN': _csrf, 'Accept': 'application/json' } });
        const data = await res.json();
        _current.is_faved              = data.favorited;
        allPosts[_current.id].is_faved = data.favorited;
        pmSetSave(data.favorited);
    } catch (err) { console.error('Save error:', err); }
}

// Touch swipe on carousel
(function () {
    let sx = 0;
    const el = document.getElementById('pm-carousel');
    el.addEventListener('touchstart', e => { sx = e.touches[0].clientX; },          { passive: true });
    el.addEventListener('touchend',   e => {
        const diff = sx - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 40) pmGo(diff > 0 ? 1 : -1);
    }, { passive: true });
})();

// Keyboard shortcuts
document.addEventListener('keydown', e => {
    const postOpen   = !document.getElementById('post-modal').classList.contains('hidden');
    const followOpen = !document.getElementById('follow-modal').classList.contains('hidden');
    if (postOpen) {
        if (e.key === 'Escape')     closePostModal();
        if (e.key === 'ArrowLeft')  pmGo(-1);
        if (e.key === 'ArrowRight') pmGo(1);
    } else if (followOpen) {
        if (e.key === 'Escape') closeFollowModal();
    }
});

// ══════════════════════════════════════════════════════════
// Post Collections – Create
// ══════════════════════════════════════════════════════════
function openNewCollectionModal() {
    document.getElementById('nc-name').value = '';
    document.getElementById('new-collection-modal').classList.remove('hidden');
    setTimeout(() => document.getElementById('nc-name').focus(), 50);
}

async function submitNewCollection() {
    const name = document.getElementById('nc-name').value.trim();
    if (!name) return;

    const res = await fetch('/saved-collections', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': _csrf },
        body: JSON.stringify({ name }),
    });

    if (res.ok) {
        document.getElementById('new-collection-modal').classList.add('hidden');
        window.location.reload();
    }
}

// Close modal on backdrop click
document.getElementById('new-collection-modal').addEventListener('click', function(e) {
    if (e.target === this) this.classList.add('hidden');
});
</script>
@endpush
@endsection
