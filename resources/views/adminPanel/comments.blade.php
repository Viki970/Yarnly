@extends('layout.app')

@section('title', 'Manage Comments · Yarnly')

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
                <h1 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight">{{ __('Manage Comments') }}</h1>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                    {{ number_format($total) }} {{ __('total comments') }}
                </p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 rounded-xl bg-zinc-100 dark:bg-zinc-800 px-4 py-2 text-sm font-medium text-zinc-700 dark:text-zinc-300 hover:bg-zinc-200 dark:hover:bg-zinc-700 transition">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                {{ __('Back to Dashboard') }}
            </a>
        </div>

        {{-- Search & filter bar --}}
        <form method="GET" action="{{ route('admin.comments') }}" class="fade-up mb-6 flex flex-wrap gap-3" style="animation-delay:.05s">
            <div class="relative flex-1 min-w-52">
                <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z"/></svg>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="{{ __('Search comments…') }}"
                    class="w-full rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 pl-9 pr-4 py-2.5 text-sm text-zinc-900 dark:text-zinc-100 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-violet-500"
                >
            </div>
            <select name="sort" class="rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 px-3 py-2.5 text-sm text-zinc-700 dark:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-violet-500">
                <option value="newest" @selected(request('sort','newest') === 'newest')>{{ __('Newest first') }}</option>
                <option value="oldest" @selected(request('sort') === 'oldest')>{{ __('Oldest first') }}</option>
            </select>
            <button type="submit" class="rounded-xl bg-violet-600 hover:bg-violet-700 px-5 py-2.5 text-sm font-semibold text-white transition">{{ __('Apply') }}</button>
            @if(request()->hasAny(['search','sort']))
                <a href="{{ route('admin.comments') }}" class="rounded-xl border border-zinc-200 dark:border-zinc-700 px-4 py-2.5 text-sm text-zinc-500 dark:text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-200 transition">{{ __('Clear') }}</a>
            @endif
        </form>

        {{-- Comments table --}}
        <div class="fade-up rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 shadow-sm overflow-hidden" style="animation-delay:.1s">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-zinc-100 dark:border-zinc-800">
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500">{{ __('Comment') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500">{{ __('Author') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500 hidden md:table-cell">{{ __('Post') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500 hidden lg:table-cell">{{ __('Posted') }}</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-50 dark:divide-zinc-800/60">
                    @forelse($comments as $comment)
                    <tr class="row-hover">
                        <td class="px-6 py-4">
                            <div class="max-w-md">
                                <p class="text-zinc-700 dark:text-zinc-300 line-clamp-2">{{ $comment->body }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                @if($comment->user->profile_picture)
                                    <img src="{{ asset('storage/' . $comment->user->profile_picture) }}" 
                                         alt="{{ $comment->user->name }}" 
                                         class="h-8 w-8 rounded-full object-cover">
                                @else
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-violet-100 dark:bg-violet-900/30 text-xs font-bold text-violet-700 dark:text-violet-300">
                                        {{ strtoupper(substr($comment->user->name, 0, 2)) }}
                                    </div>
                                @endif
                                <a href="{{ route('users.show', $comment->user) }}" class="text-zinc-700 dark:text-zinc-300 hover:text-violet-600 dark:hover:text-violet-400">{{ $comment->user->name }}</a>
                            </div>
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell">
                            <a href="{{ route('posts.show', $comment->post) }}" class="text-violet-600 dark:text-violet-400 hover:underline">View post</a>
                        </td>
                        <td class="px-6 py-4 text-zinc-500 dark:text-zinc-400 hidden lg:table-cell">{{ $comment->created_at->format('M j, Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <form method="POST" action="{{ route('comments.destroy', $comment) }}"
                                onsubmit="return confirm('Delete this comment? This cannot be undone.')">
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
                        <td colspan="5" class="px-6 py-16 text-center text-zinc-400 dark:text-zinc-500">
                            {{ __('No comments found.') }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            @if($comments->hasPages())
            <div class="border-t border-zinc-100 dark:border-zinc-800 px-6 py-4">
                {{ $comments->withQueryString()->links() }}
            </div>
            @endif
        </div>

    </div>
</div>
@endsection
