@extends('layout.app')

@section('title', 'Manage Patterns · Yarnly')

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
                <h1 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight">{{ __('Manage Patterns') }}</h1>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                    {{ number_format($total) }} {{ __('total patterns') }}
                </p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 rounded-xl bg-zinc-100 dark:bg-zinc-800 px-4 py-2 text-sm font-medium text-zinc-700 dark:text-zinc-300 hover:bg-zinc-200 dark:hover:bg-zinc-700 transition">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                {{ __('Back to Dashboard') }}
            </a>
        </div>

        {{-- Search & filter bar --}}
        <form method="GET" action="{{ route('admin.patterns') }}" class="fade-up mb-6 flex flex-wrap gap-3" style="animation-delay:.05s">
            <div class="relative flex-1 min-w-52">
                <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z"/></svg>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="{{ __('Search patterns…') }}"
                    class="w-full rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 pl-9 pr-4 py-2.5 text-sm text-zinc-900 dark:text-zinc-100 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-violet-500"
                >
            </div>
            <select name="craft_type" class="rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 px-3 py-2.5 text-sm text-zinc-700 dark:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-violet-500">
                <option value="">{{ __('All craft types') }}</option>
                <option value="crochet" @selected(request('craft_type') === 'crochet')>{{ __('Crochet') }}</option>
                <option value="knitting" @selected(request('craft_type') === 'knitting')>{{ __('Knitting') }}</option>
                <option value="embroidery" @selected(request('craft_type') === 'embroidery')>{{ __('Embroidery') }}</option>
            </select>
            <select name="difficulty" class="rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 px-3 py-2.5 text-sm text-zinc-700 dark:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-violet-500">
                <option value="">{{ __('All difficulties') }}</option>
                <option value="beginner" @selected(request('difficulty') === 'beginner')>{{ __('Beginner') }}</option>
                <option value="intermediate" @selected(request('difficulty') === 'intermediate')>{{ __('Intermediate') }}</option>
                <option value="advanced" @selected(request('difficulty') === 'advanced')>{{ __('Advanced') }}</option>
            </select>
            <select name="sort" class="rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 px-3 py-2.5 text-sm text-zinc-700 dark:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-violet-500">
                <option value="newest" @selected(request('sort','newest') === 'newest')>{{ __('Newest first') }}</option>
                <option value="oldest" @selected(request('sort') === 'oldest')>{{ __('Oldest first') }}</option>
                <option value="title" @selected(request('sort') === 'title')>{{ __('Title A–Z') }}</option>
                <option value="saved" @selected(request('sort') === 'saved')>{{ __('Most saved') }}</option>
            </select>
            <button type="submit" class="rounded-xl bg-violet-600 hover:bg-violet-700 px-5 py-2.5 text-sm font-semibold text-white transition">{{ __('Apply') }}</button>
            @if(request()->hasAny(['search','craft_type','difficulty','sort']))
                <a href="{{ route('admin.patterns') }}" class="rounded-xl border border-zinc-200 dark:border-zinc-700 px-4 py-2.5 text-sm text-zinc-500 dark:text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-200 transition">{{ __('Clear') }}</a>
            @endif
        </form>

        {{-- Patterns table --}}
        <div class="fade-up rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 shadow-sm overflow-hidden" style="animation-delay:.1s">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-zinc-100 dark:border-zinc-800">
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500">{{ __('Pattern') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500">{{ __('Author') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500 hidden md:table-cell">{{ __('Craft Type') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500 hidden md:table-cell">{{ __('Difficulty') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500 hidden lg:table-cell">{{ __('Saved') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500 hidden lg:table-cell">{{ __('Uploaded') }}</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-50 dark:divide-zinc-800/60">
                    @forelse($patterns as $pattern)
                    <tr class="row-hover">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($pattern->image_path)
                                    <img src="{{ asset('storage/' . $pattern->image_path) }}" 
                                         alt="{{ $pattern->title }}" 
                                         class="h-12 w-12 rounded-lg object-cover border border-zinc-200 dark:border-zinc-700">
                                @else
                                    <div class="h-12 w-12 rounded-lg bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center">
                                        <svg class="h-6 w-6 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="max-w-xs">
                                    <p class="font-medium text-zinc-900 dark:text-white truncate">{{ $pattern->title }}</p>
                                    <a href="{{ route('patterns.view', $pattern) }}" class="text-xs text-violet-600 dark:text-violet-400 hover:underline">View pattern</a>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('users.show', $pattern->user) }}" class="text-zinc-700 dark:text-zinc-300 hover:text-violet-600 dark:hover:text-violet-400">{{ $pattern->user->name }}</a>
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell">
                            <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-semibold bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300">
                                {{ ucfirst($pattern->craft_type ?? 'N/A') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell">
                            <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-semibold
                                {{ $pattern->difficulty === 'beginner' ? 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300' : '' }}
                                {{ $pattern->difficulty === 'intermediate' ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/40 dark:text-yellow-300' : '' }}
                                {{ $pattern->difficulty === 'advanced' ? 'bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-300' : '' }}">
                                {{ ucfirst($pattern->difficulty) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-zinc-700 dark:text-zinc-300 hidden lg:table-cell">{{ $pattern->makers_saved }}</td>
                        <td class="px-6 py-4 text-zinc-500 dark:text-zinc-400 hidden lg:table-cell">{{ $pattern->created_at->format('M j, Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <form method="POST" action="{{ route('patterns.destroy', $pattern) }}"
                                onsubmit="return confirm('Delete this pattern? This cannot be undone.')">
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
                            {{ __('No patterns found.') }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            @if($patterns->hasPages())
            <div class="border-t border-zinc-100 dark:border-zinc-800 px-6 py-4">
                {{ $patterns->withQueryString()->links() }}
            </div>
            @endif
        </div>

    </div>
</div>
@endsection
