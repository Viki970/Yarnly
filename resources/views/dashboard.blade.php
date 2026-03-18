@extends('layout.app')

@section('title', 'My Dashboard · Yarnly')

@section('content')
<style>
@keyframes fade-up { from{opacity:0;transform:translateY(14px)} to{opacity:1;transform:translateY(0)} }
.fade-up  { animation: fade-up .45s cubic-bezier(.34,1.56,.64,1) both; }
.card-hover { transition: transform .2s, box-shadow .2s; }
.card-hover:hover { transform: translateY(-3px); box-shadow: 0 10px 32px rgba(0,0,0,.10); }
</style>

<div class="min-h-screen bg-zinc-50 dark:bg-zinc-950 pt-6 pb-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- ── Welcome banner ─────────────────────────────────── --}}
        <div class="fade-up mb-8 flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-4">
                @if(auth()->user()->profile_picture)
                    <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}"
                         class="h-14 w-14 rounded-2xl object-cover ring-2 ring-violet-300 dark:ring-violet-700" alt="">
                @else
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-violet-500 to-fuchsia-500 text-xl font-black text-white shadow">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                @endif
                <div>
                    <h1 class="text-2xl font-black text-zinc-900 dark:text-white">
                        Welcome back, {{ auth()->user()->name }} 👋
                    </h1>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Here's what's happening with your account.</p>
                </div>
            </div>
            <div class="flex gap-2 mt-3 sm:mt-0">
                <a href="{{ route('patterns.create') }}"
                   class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-violet-600 to-fuchsia-600 px-4 py-2 text-sm font-semibold text-white shadow hover:brightness-110 transition">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    New Pattern
                </a>
                <a href="{{ route('posts.create') }}"
                   class="inline-flex items-center gap-2 rounded-xl bg-zinc-800 dark:bg-zinc-700 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-zinc-700 dark:hover:bg-zinc-600 transition">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    New Post
                </a>
            </div>
        </div>

        {{-- ── Stat cards ──────────────────────────────────────── --}}
        <div class="fade-up grid grid-cols-2 gap-4 md:grid-cols-4" style="animation-delay:.05s">

            <div class="card-hover rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500 mb-2">Patterns</p>
                <p class="text-4xl font-black text-violet-600 dark:text-violet-400">{{ $patternsCount }}</p>
                <a href="{{ route('my-patterns') }}" class="mt-2 inline-block text-xs text-violet-500 hover:underline">View all →</a>
            </div>

            <div class="card-hover rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500 mb-2">Posts</p>
                <p class="text-4xl font-black text-blue-600 dark:text-blue-400">{{ $postsCount }}</p>
                <a href="{{ route('posts.index') }}" class="mt-2 inline-block text-xs text-blue-500 hover:underline">View all →</a>
            </div>

            <div class="card-hover rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500 mb-2">Followers</p>
                <p class="text-4xl font-black text-pink-500">{{ $followersCount }}</p>
                <a href="{{ route('users.show', auth()->user()) }}" class="mt-2 inline-block text-xs text-pink-500 hover:underline">My profile →</a>
            </div>

            <div class="card-hover rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500 mb-2">Following</p>
                <p class="text-4xl font-black text-teal-500">{{ $followingCount }}</p>
                <a href="{{ route('users.show', auth()->user()) }}" class="mt-2 inline-block text-xs text-teal-500 hover:underline">My profile →</a>
            </div>

        </div>

        {{-- ── Activity statistics ────────────────────────────── --}}
        <div class="mt-6 fade-up" style="animation-delay:.08s">
            <div class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 p-6 shadow-sm">
                <h2 class="text-base font-bold text-zinc-900 dark:text-white mb-5">My Activity</h2>
                <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">

                    <div class="flex flex-col items-center justify-center rounded-xl bg-pink-50 dark:bg-pink-900/20 py-4 px-3 text-center">
                        <svg class="h-5 w-5 text-pink-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        <p class="text-2xl font-black text-pink-600 dark:text-pink-400">{{ number_format($likesReceived) }}</p>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Likes Received</p>
                    </div>

                    <div class="flex flex-col items-center justify-center rounded-xl bg-sky-50 dark:bg-sky-900/20 py-4 px-3 text-center">
                        <svg class="h-5 w-5 text-sky-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        <p class="text-2xl font-black text-sky-600 dark:text-sky-400">{{ number_format($commentsReceived) }}</p>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Comments Received</p>
                    </div>

                    <div class="flex flex-col items-center justify-center rounded-xl bg-amber-50 dark:bg-amber-900/20 py-4 px-3 text-center">
                        <svg class="h-5 w-5 text-amber-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                        <p class="text-2xl font-black text-amber-600 dark:text-amber-400">{{ number_format($patternsSaved) }}</p>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Patterns Saved</p>
                    </div>

                    <div class="flex flex-col items-center justify-center rounded-xl bg-violet-50 dark:bg-violet-900/20 py-4 px-3 text-center">
                        <svg class="h-5 w-5 text-violet-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <p class="text-2xl font-black text-violet-600 dark:text-violet-400">{{ $patternsThisMonth }}</p>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Patterns This Month</p>
                    </div>

                    <div class="flex flex-col items-center justify-center rounded-xl bg-blue-50 dark:bg-blue-900/20 py-4 px-3 text-center">
                        <svg class="h-5 w-5 text-blue-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <p class="text-2xl font-black text-blue-600 dark:text-blue-400">{{ $postsThisMonth }}</p>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Posts This Month</p>
                    </div>

                    <div class="flex flex-col items-center justify-center rounded-xl bg-emerald-50 dark:bg-emerald-900/20 py-4 px-3 text-center">
                        <svg class="h-5 w-5 text-emerald-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-3 3v-3z"/></svg>
                        <p class="text-2xl font-black text-emerald-600 dark:text-emerald-400">{{ number_format($commentsGiven) }}</p>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Comments Given</p>
                    </div>

                </div>
            </div>
        </div>

        {{-- ── Main two-column area ────────────────────────────── --}}
        <div class="mt-8 grid gap-8 lg:grid-cols-3">

            {{-- Recent Patterns (2/3 width) --}}
            <div class="lg:col-span-2 fade-up" style="animation-delay:.1s">
                <div class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 shadow-sm overflow-hidden">
                    <div class="flex items-center justify-between px-6 py-4 border-b border-zinc-100 dark:border-zinc-800">
                        <h2 class="text-base font-bold text-zinc-900 dark:text-white">My Recent Patterns</h2>
                        <a href="{{ route('my-patterns') }}" class="text-xs font-semibold text-violet-600 dark:text-violet-400 hover:underline">View all →</a>
                    </div>

                    @if($recentPatterns->isEmpty())
                        <div class="flex flex-col items-center justify-center py-16 text-zinc-400 dark:text-zinc-500">
                            <svg class="h-10 w-10 mb-3 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <p class="text-sm">No patterns yet.</p>
                            <a href="{{ route('patterns.create') }}" class="mt-3 text-xs font-semibold text-violet-600 hover:underline">Upload your first pattern</a>
                        </div>
                    @else
                        <div class="divide-y divide-zinc-100 dark:divide-zinc-800">
                            @foreach($recentPatterns as $pattern)
                            <div class="flex items-center gap-4 px-6 py-4 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition">
                                @if($pattern->image_path)
                                    <img src="{{ asset('storage/' . $pattern->image_path) }}"
                                         class="h-12 w-12 rounded-xl object-cover flex-shrink-0" alt="">
                                @else
                                    <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl bg-violet-100 dark:bg-violet-900/30">
                                        <svg class="h-5 w-5 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-sm text-zinc-800 dark:text-zinc-200 truncate">{{ $pattern->title }}</p>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-400 capitalize">{{ $pattern->category }} · {{ $pattern->difficulty ?? 'No difficulty set' }}</p>
                                </div>
                                <div class="flex items-center gap-3 flex-shrink-0">
                                    <span class="text-xs text-zinc-400 dark:text-zinc-500">{{ $pattern->created_at->diffForHumans() }}</span>
                                    <a href="{{ route('patterns.view', $pattern) }}" class="text-xs font-semibold text-violet-600 dark:text-violet-400 hover:underline">View</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- ── This Week Stats --}}
                <div class="mt-6 rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 p-6 shadow-sm fade-up" style="animation-delay:.12s">
                    <div class="flex items-center justify-between mb-5">
                        <h2 class="text-base font-bold text-zinc-900 dark:text-white">This Week</h2>
                        <span class="text-xs text-zinc-400 dark:text-zinc-500">{{ now()->startOfWeek()->format('M j') }} – {{ now()->endOfWeek()->format('M j') }}</span>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="rounded-xl bg-pink-50 dark:bg-pink-900/20 p-4 text-center">
                            <p class="text-2xl font-bold text-pink-600 dark:text-pink-400">{{ $likesThisWeek }}</p>
                            <p class="mt-1 text-xs font-medium text-pink-500 dark:text-pink-400">Likes</p>
                        </div>
                        <div class="rounded-xl bg-sky-50 dark:bg-sky-900/20 p-4 text-center">
                            <p class="text-2xl font-bold text-sky-600 dark:text-sky-400">{{ $commentsThisWeek }}</p>
                            <p class="mt-1 text-xs font-medium text-sky-500 dark:text-sky-400">Comments</p>
                        </div>
                        <div class="rounded-xl bg-violet-50 dark:bg-violet-900/20 p-4 text-center">
                            <p class="text-2xl font-bold text-violet-600 dark:text-violet-400">{{ $followersThisWeek }}</p>
                            <p class="mt-1 text-xs font-medium text-violet-500 dark:text-violet-400">New Followers</p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end lg:col-span-2 --}}

            <div class="space-y-6 fade-up" style="animation-delay:.15s">

                {{-- Quick links --}}
                <div class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 p-5 shadow-sm">
                    <h2 class="text-base font-bold text-zinc-900 dark:text-white mb-4">Quick Links</h2>
                    <div class="space-y-1">
                        <a href="{{ route('my-collections') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-zinc-700 dark:text-zinc-300 hover:bg-violet-50 dark:hover:bg-violet-900/20 hover:text-violet-700 dark:hover:text-violet-300 transition">
                            <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            My Collections
                        </a>
                        <a href="{{ route('patterns.favorites') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-zinc-700 dark:text-zinc-300 hover:bg-pink-50 dark:hover:bg-pink-900/20 hover:text-pink-700 dark:hover:text-pink-300 transition">
                            <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            Favorited Patterns
                        </a>
                        <a href="{{ route('posts.liked') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-zinc-700 dark:text-zinc-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-700 dark:hover:text-blue-300 transition">
                            <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/></svg>
                            Liked Posts
                        </a>
                        <a href="{{ route('post-collections.index') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-zinc-700 dark:text-zinc-300 hover:bg-amber-50 dark:hover:bg-amber-900/20 hover:text-amber-700 dark:hover:text-amber-300 transition">
                            <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                            Saved Posts
                        </a>
                        <a href="{{ route('profile.settings') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition">
                            <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Settings
                        </a>
                    </div>
                </div>

                {{-- Recent posts --}}
                <div class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 p-5 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-base font-bold text-zinc-900 dark:text-white">My Recent Posts</h2>
                        <a href="{{ route('posts.index') }}" class="text-xs font-semibold text-blue-600 dark:text-blue-400 hover:underline">All posts →</a>
                    </div>
                    @if($recentPosts->isEmpty())
                        <p class="text-sm text-zinc-400 dark:text-zinc-500 text-center py-6">No posts yet.</p>
                    @else
                        <div class="space-y-3">
                            @foreach($recentPosts as $post)
                            <a href="{{ route('posts.show', $post) }}" class="flex items-center gap-3 group">
                                @if($post->images->first())
                                    <img src="{{ asset('storage/' . $post->images->first()->image_path) }}"
                                         class="h-10 w-10 rounded-lg object-cover flex-shrink-0" alt="">
                                @else
                                    <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-900/30">
                                        <svg class="h-4 w-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-medium text-zinc-700 dark:text-zinc-300 truncate group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">
                                        {{ $post->description ? Str::limit($post->description, 50) : 'No description' }}
                                    </p>
                                    <p class="text-xs text-zinc-400 dark:text-zinc-500">
                                        {{ $post->likes_count }} likes · {{ $post->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
