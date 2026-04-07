@extends('layout.app')

@section('title', 'Manage Posts · Yarnly')

@section('content')
<style>
@keyframes fade-up { from{opacity:0;transform:translateY(16px)} to{opacity:1;transform:translateY(0)} }
.fade-up  { animation: fade-up .5s cubic-bezier(.34,1.56,.64,1) both; }
.row-hover { transition: background .12s; }
.row-hover:hover { background: rgba(139,92,246,.07); }
</style>

<div class="min-h-screen bg-zinc-50 dark:bg-zinc-950 pt-6 pb-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="fade-up mb-8 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight">{{ __('Manage Posts') }}</h1>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                    {{ number_format($total) }} {{ __('total posts') }}
                </p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 rounded-xl bg-zinc-100 dark:bg-zinc-800 px-4 py-2 text-sm font-medium text-zinc-700 dark:text-zinc-300 hover:bg-zinc-200 dark:hover:bg-zinc-700 transition">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                {{ __('Back to Dashboard') }}
            </a>
        </div>

        {{-- Search & filter bar --}}
        <form method="GET" action="{{ route('admin.posts') }}" class="fade-up mb-6 flex flex-wrap gap-3" style="animation-delay:.05s">
            <div class="relative flex-1 min-w-52">
                <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z"/></svg>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="{{ __('Search posts…') }}"
                    class="w-full rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 pl-9 pr-4 py-2.5 text-sm text-zinc-900 dark:text-zinc-100 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-violet-500"
                >
            </div>
            <select name="craft_type" class="rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 px-3 py-2.5 text-sm text-zinc-700 dark:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-violet-500">
                <option value="">{{ __('All crafts') }}</option>
                <option value="crochet" @selected(request('craft_type') === 'crochet')>{{ __('Crochet') }}</option>
                <option value="knitting" @selected(request('craft_type') === 'knitting')>{{ __('Knitting') }}</option>
                <option value="embroidery" @selected(request('craft_type') === 'embroidery')>{{ __('Embroidery') }}</option>
            </select>
            <select name="sort" class="rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 px-3 py-2.5 text-sm text-zinc-700 dark:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-violet-500">
                <option value="newest" @selected(request('sort','newest') === 'newest')>{{ __('Newest first') }}</option>
                <option value="oldest" @selected(request('sort') === 'oldest')>{{ __('Oldest first') }}</option>
                <option value="likes" @selected(request('sort') === 'likes')>{{ __('Most liked') }}</option>
                <option value="comments" @selected(request('sort') === 'comments')>{{ __('Most commented') }}</option>
            </select>
            <button type="submit" class="rounded-xl bg-violet-600 hover:bg-violet-700 px-5 py-2.5 text-sm font-semibold text-white transition">{{ __('Apply') }}</button>
            @if(request()->hasAny(['search','craft_type','sort']))
                <a href="{{ route('admin.posts') }}" class="rounded-xl border border-zinc-200 dark:border-zinc-700 px-4 py-2.5 text-sm text-zinc-500 dark:text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-200 transition">{{ __('Clear') }}</a>
            @endif
        </form>

        {{-- Posts table --}}
        <div class="fade-up rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 shadow-sm overflow-hidden" style="animation-delay:.1s">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-zinc-100 dark:border-zinc-800">
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500">{{ __('Post') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500">{{ __('Author') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500 hidden md:table-cell">{{ __('Craft') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500 hidden md:table-cell">{{ __('Likes') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500 hidden lg:table-cell">{{ __('Comments') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500 hidden lg:table-cell">{{ __('Posted') }}</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-50 dark:divide-zinc-800/60">
                    @forelse($posts as $post)
                    <tr class="row-hover">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($post->images->first())
                                    <img src="{{ asset('storage/' . $post->images->first()->image_path) }}" 
                                         alt="Post" 
                                         class="h-12 w-12 rounded-lg object-cover border border-zinc-200 dark:border-zinc-700">
                                @else
                                    <div class="h-12 w-12 rounded-lg bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center">
                                        <svg class="h-6 w-6 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="max-w-xs">
                                    <p class="font-medium text-zinc-900 dark:text-white truncate">{{ $post->description ?: 'No description' }}</p>
                                    <a href="{{ route('posts.show', $post) }}" class="text-xs text-violet-600 dark:text-violet-400 hover:underline">View post</a>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('users.show', $post->user) }}" class="text-zinc-700 dark:text-zinc-300 hover:text-violet-600 dark:hover:text-violet-400">{{ $post->user->name }}</a>
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell">
                            <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-semibold
                                {{ $post->craft_type === 'crochet' ? 'bg-sky-100 text-sky-700 dark:bg-sky-900/40 dark:text-sky-300' : '' }}
                                {{ $post->craft_type === 'knitting' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300' : '' }}
                                {{ $post->craft_type === 'embroidery' ? 'bg-rose-100 text-rose-700 dark:bg-rose-900/40 dark:text-rose-300' : '' }}">
                                {{ ucfirst($post->craft_type) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-zinc-700 dark:text-zinc-300 hidden md:table-cell">{{ $post->likes_count }}</td>
                        <td class="px-6 py-4 text-zinc-700 dark:text-zinc-300 hidden lg:table-cell">{{ $post->comments_count }}</td>
                        <td class="px-6 py-4 text-zinc-500 dark:text-zinc-400 hidden lg:table-cell">{{ $post->created_at->format('M j, Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <form method="POST" action="{{ route('posts.destroy', $post) }}"
                                onsubmit="return confirm('Delete this post? This cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="rounded-lg px-3 py-1.5 text-xs font-medium bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:bg-red-50 hover:text-red-600 dark:hover:bg-red-900/20 dark:hover:text-red-400 transition">
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center text-zinc-400 dark:text-zinc-500">
                            {{ __('No posts found.') }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            @if($posts->hasPages())
            <div class="border-t border-zinc-100 dark:border-zinc-800 px-6 py-4">
                {{ $posts->withQueryString()->links() }}
            </div>
            @endif
        </div>

    </div>
</div>
@endsection
