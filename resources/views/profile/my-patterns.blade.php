@extends('layout.app')

@section('title', 'My Patterns - Yarnly')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-br from-emerald-50 via-teal-50 to-green-50 py-16 dark:from-zinc-900 dark:via-gray-900 dark:to-black">
    <div class="absolute -left-20 top-10 h-48 w-48 rounded-full bg-emerald-300/30 blur-3xl dark:bg-emerald-500/40"></div>
    <div class="absolute -right-12 bottom-10 h-64 w-64 rounded-full bg-teal-300/25 blur-3xl dark:bg-teal-600/20"></div>
    <div class="relative max-w-6xl mx-auto px-6 lg:px-12">
        <p class="inline-flex items-center gap-2 rounded-full bg-white/70 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-emerald-700 ring-1 ring-emerald-200 dark:bg-zinc-800/50 dark:text-emerald-300 dark:ring-emerald-500/60">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            {{ __('My Workshop') }}
        </p>
        <div class="mt-6 flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div class="max-w-3xl">
                <h1 class="text-4xl font-bold tracking-tight text-emerald-900 sm:text-5xl dark:text-emerald-100">My Patterns</h1>
                <p class="mt-4 text-lg leading-relaxed text-zinc-600 dark:text-zinc-400">
                    {{ __('Manage and view all your created patterns. Share your craft with the community.') }}
                </p>
            </div>
            <div class="flex flex-col items-center gap-4">
                <div class="rounded-2xl bg-white/80 p-6 shadow-xl ring-1 ring-emerald-100 backdrop-blur dark:bg-zinc-800/60 dark:ring-emerald-500/50">
                    <div class="text-center">
                        <p class="text-sm font-medium text-emerald-400 dark:text-emerald-300">{{ __('Created patterns') }}</p>
                        <p class="mt-2 text-3xl font-bold text-emerald-900 dark:text-white">{{ $totalPatterns }}</p>
                        <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">{{ __('Ready to share') }}</p>
                    </div>
                </div>
                <a href="{{ route('patterns.create') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-semibold hover:from-emerald-600 hover:to-teal-600 transform hover:scale-105 transition-all duration-200 shadow-lg">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    {{ __('Create New Pattern') }}
                </a>
            </div>
        </div>
    </div>
</section>

<section class="bg-white py-12 dark:bg-gray-900">
    <div class="max-w-6xl mx-auto px-6 lg:px-12">

        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800">
                <p class="text-emerald-700 dark:text-emerald-300">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 rounded-lg bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800">
                <p class="text-red-700 dark:text-red-300">{{ session('error') }}</p>
            </div>
        @endif

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800/70 rounded-2xl p-6 shadow-lg border border-emerald-100 dark:border-emerald-500/40">
                <div class="flex items-center">
                    <div class="p-5 rounded-full bg-emerald-100 dark:bg-emerald-500/20">
                        <svg class="h-16 w-16 text-emerald-500 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">{{ __('Total Patterns') }}</p>
                        <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $totalPatterns }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800/70 rounded-2xl p-6 shadow-lg border border-emerald-100 dark:border-emerald-500/40">
                <div class="flex items-center">
                    <div class="p-5 rounded-full bg-emerald-100 dark:bg-emerald-500/20">
                        <svg class="h-16 w-16 text-teal-500 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">{{ __('Categories') }}</p>
                        <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $patterns->groupBy('category')->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800/70 rounded-2xl p-6 shadow-lg border border-emerald-100 dark:border-emerald-500/40">
                <div class="flex items-center">
                    <div class="p-5 rounded-full bg-emerald-100 dark:bg-emerald-500/20">
                        <svg class="h-16 w-16 text-orange-500 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">{{ __('Avg Difficulty') }}</p>
                        <p class="text-2xl font-bold text-zinc-900 dark:text-white">
                            @if($patterns->isNotEmpty())
                                @php
                                    $difficulties = $patterns->pluck('difficulty')->countBy();
                                    $mostCommon = $difficulties->keys()->first();
                                @endphp
                                {{ ucfirst($mostCommon ?? 'Mixed') }}
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter & Sort Bar -->
        <div class="mb-8 flex flex-wrap items-end gap-4 rounded-2xl bg-white dark:bg-gray-800/70 border border-zinc-200 dark:border-zinc-700 px-6 py-5 shadow-sm">

            {{-- Craft type --}}
            <div class="flex flex-col gap-1.5 min-w-[140px]">
                <label for="f-craft" class="text-xs font-semibold uppercase tracking-wide text-emerald-600 dark:text-emerald-400">{{ __('Craft type') }}</label>
                <div class="relative">
                    <select id="f-craft"
                        class="w-full appearance-none rounded-lg border border-emerald-200 dark:border-emerald-700/60 bg-white dark:bg-zinc-700 pl-3 pr-8 py-2 text-sm font-medium text-zinc-800 dark:text-zinc-100 focus:outline-none focus:ring-2 focus:ring-emerald-400 cursor-pointer">
                        <option value="all">{{ __('All crafts') }}</option>
                        <option value="crochet">{{ __('Crochet') }}</option>
                        <option value="knitting">{{ __('Knitting') }}</option>
                        <option value="embroidery">{{ __('Embroidery') }}</option>
                    </select>
                    <svg class="pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 h-4 w-4 text-emerald-400 dark:text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
            </div>

            {{-- Difficulty --}}
            <div class="flex flex-col gap-1.5 min-w-[150px]">
                <label for="f-difficulty" class="text-xs font-semibold uppercase tracking-wide text-emerald-600 dark:text-emerald-400">{{ __('Difficulty') }}</label>
                <div class="relative">
                    <select id="f-difficulty"
                        class="w-full appearance-none rounded-lg border border-emerald-200 dark:border-emerald-700/60 bg-white dark:bg-zinc-700 pl-3 pr-8 py-2 text-sm font-medium text-zinc-800 dark:text-zinc-100 focus:outline-none focus:ring-2 focus:ring-emerald-400 cursor-pointer">
                        <option value="all">{{ __('All levels') }}</option>
                        <option value="beginner">{{ __('Beginner') }}</option>
                        <option value="intermediate">{{ __('Intermediate') }}</option>
                        <option value="advanced">{{ __('Advanced') }}</option>
                    </select>
                    <svg class="pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 h-4 w-4 text-emerald-400 dark:text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
            </div>

            {{-- Sort --}}
            <div class="flex flex-col gap-1.5 min-w-[165px]">
                <label for="f-sort" class="text-xs font-semibold uppercase tracking-wide text-emerald-600 dark:text-emerald-400">{{ __('Sort by') }}</label>
                <div class="relative">
                    <select id="f-sort"
                        class="w-full appearance-none rounded-lg border border-emerald-200 dark:border-emerald-700/60 bg-white dark:bg-zinc-700 pl-3 pr-8 py-2 text-sm font-medium text-zinc-800 dark:text-zinc-100 focus:outline-none focus:ring-2 focus:ring-emerald-400 cursor-pointer">
                        <option value="newest">{{ __('Newest first') }}</option>
                        <option value="oldest">{{ __('Oldest first') }}</option>
                        <option value="most_saved">{{ __('Most saved') }}</option>
                        <option value="title_asc">{{ __('Title A-Z') }}</option>
                    </select>
                    <svg class="pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 h-4 w-4 text-emerald-400 dark:text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
            </div>

            {{-- Clear button --}}
            <button id="clear-filters" type="button"
                class="hidden ml-auto self-end rounded-lg border border-zinc-300 dark:border-zinc-600 px-4 py-2 text-sm font-semibold text-zinc-500 dark:text-zinc-400 hover:border-red-300 hover:text-red-500 transition-colors">
                {{ __('Clear filters') }}
            </button>
        </div>

        <!-- Section heading -->
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between mb-8">
            <div>
                <p class="text-sm font-semibold text-emerald-700 dark:text-emerald-200">{{ __('Your workshop') }}</p>
                <h2 class="text-3xl font-bold text-zinc-900 dark:text-white">{{ __('All patterns') }}</h2>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">
                    Showing <span id="visible-count">{{ $totalPatterns }}</span> of {{ $totalPatterns }} pattern{{ $totalPatterns !== 1 ? 's' : '' }}
                </p>
            </div>
            <a href="{{ route('patterns.crochet') }}" class="text-sm font-semibold text-zinc-600 underline-offset-4 hover:underline dark:text-zinc-300">{{ __('Browse community patterns') }}</a>
        </div>

        <!-- Patterns Grid -->
        @if($patterns->isEmpty())
            <div class="mt-4 rounded-2xl border border-dashed border-emerald-200 bg-emerald-50 p-12 text-center dark:border-emerald-500/40 dark:bg-gray-800/60">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-emerald-100 dark:bg-emerald-500/20">
                    <svg class="h-8 w-8 text-emerald-500 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-emerald-900 dark:text-white">{{ __('No patterns yet') }}</h3>
                <p class="mt-2 text-sm text-emerald-700 dark:text-emerald-300">{{ __('Start creating patterns and share your craft with the community!') }}</p>
                <a href="{{ route('patterns.create') }}"
                    class="mt-6 inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-emerald-500 to-teal-500 px-6 py-3 text-sm font-semibold text-white transition hover:from-emerald-600 hover:to-teal-600">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    {{ __('Create Your First Pattern') }}
                </a>
            </div>
        @else
            <div id="patterns-grid" class="grid gap-6 md:grid-cols-3">
                @foreach($patterns as $pattern)
                    <article class="pattern-card group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-emerald-500/30 dark:bg-gray-800/60"
                        data-craft="{{ $pattern->craft_type }}"
                        data-difficulty="{{ $pattern->difficulty }}"
                        data-created="{{ $pattern->created_at->timestamp }}"
                        data-saved="{{ $pattern->makers_saved }}"
                        data-title="{{ strtolower($pattern->title) }}">

                        @if($pattern->image_path)
                            <div class="mb-4 aspect-[3/4] w-full overflow-hidden rounded-xl bg-zinc-100 dark:bg-zinc-700/30">
                                <img
                                    src="{{ asset('storage/' . $pattern->image_path) }}"
                                    alt="{{ $pattern->title }}"
                                    class="h-full w-full object-cover"
                                    loading="lazy">
                            </div>
                        @else
                            <div class="mb-4 aspect-[3/4] w-full overflow-hidden rounded-xl bg-gradient-to-br from-emerald-100 to-teal-100 dark:from-emerald-900/40 dark:to-teal-900/40 flex items-center justify-center">
                                <svg class="h-16 w-16 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                        @endif

                        <div class="flex items-center justify-between">
                            <div class="rounded-lg px-3 py-1 text-xs font-semibold
                                @if($pattern->difficulty === 'beginner') bg-emerald-100 text-emerald-700 dark:bg-emerald-200/20 dark:text-emerald-300
                                @elseif($pattern->difficulty === 'intermediate') bg-teal-100 text-teal-800 dark:bg-teal-300/20 dark:text-teal-400
                                @else bg-orange-100 text-orange-800 dark:bg-orange-400/20 dark:text-orange-400 @endif">
                                {{ ucfirst($pattern->difficulty) }}
                            </div>
                            @if($pattern->estimated_hours)
                                <span class="text-xs font-medium text-emerald-700 dark:text-emerald-200">≈ {{ $pattern->estimated_hours }} hrs</span>
                            @endif
                        </div>

                        <h3 class="mt-4 text-lg font-bold text-zinc-900 dark:text-white">{{ $pattern->title }}</h3>
                        <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">{{ Str::limit($pattern->description, 80) }}</p>

                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex items-center gap-3 text-xs font-semibold text-emerald-700 dark:text-emerald-200">
                                <span class="inline-flex h-2 w-2 rounded-full bg-emerald-400"></span>
                                {{ $pattern->makers_saved }} {{ __('makers saved') }}
                            </div>
                            <button
                                type="button"
                                data-pattern-id="{{ $pattern->id }}"
                                class="delete-pattern-btn p-2 rounded-full transition-all duration-200 hover:scale-110 text-red-400 hover:text-red-500">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>

                        <div class="mt-5 flex gap-2">
                            <a href="{{ route('patterns.view', $pattern) }}"
                                class="flex-1 rounded-lg bg-emerald-500 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-emerald-600">{{ __('View Pattern') }}</a>
                            @if($pattern->pdf_file)
                                <a href="{{ route('patterns.download', $pattern) }}"
                                    class="flex-1 rounded-lg bg-teal-400 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-teal-500">{{ __('Download PDF') }}</a>
                            @endif
                        </div>

                        <div class="mt-3 flex flex-wrap gap-1 text-xs font-semibold text-emerald-700 dark:text-emerald-200">
                            <span class="rounded-full bg-emerald-100 px-2 py-1 dark:bg-emerald-900/40">{{ $pattern->getCategoryLabel() }}</span>
                            <span class="rounded-full bg-emerald-100 px-2 py-1 dark:bg-emerald-900/40">Created {{ $pattern->created_at->diffForHumans() }}</span>
                        </div>

                        <!-- Hidden delete form -->
                        <form id="delete-form-{{ $pattern->id }}" action="{{ route('patterns.destroy', $pattern) }}" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </article>
                @endforeach
            </div>

            <!-- No results message -->
            <div id="no-results" class="hidden mt-4 rounded-2xl border border-dashed border-emerald-200 bg-emerald-50 p-12 text-center dark:border-emerald-500/40 dark:bg-gray-800/60">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-emerald-100 dark:bg-emerald-500/20">
                    <svg class="h-8 w-8 text-emerald-500 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-emerald-900 dark:text-white">{{ __('No patterns match your filters') }}</h3>
                <p class="mt-2 text-sm text-emerald-700 dark:text-emerald-300">{{ __('Try adjusting the filters above.') }}</p>
            </div>
        @endif
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const craftSelect      = document.getElementById('f-craft');
    const difficultySelect = document.getElementById('f-difficulty');
    const sortSelect       = document.getElementById('f-sort');
    const clearBtn         = document.getElementById('clear-filters');
    const grid             = document.getElementById('patterns-grid');
    const noResults        = document.getElementById('no-results');
    const visibleCount     = document.getElementById('visible-count');

    if (!grid) return; // no patterns at all — nothing to do

    const allCards = Array.from(grid.querySelectorAll('.pattern-card'));

    function applyFilters() {
        const craft      = craftSelect.value;
        const difficulty = difficultySelect.value;
        const sort       = sortSelect.value;

        // Show/hide clear button
        const isFiltered = craft !== 'all' || difficulty !== 'all' || sort !== 'newest';
        clearBtn.classList.toggle('hidden', !isFiltered);

        // Filter
        let visible = allCards.filter(card => {
            const matchCraft      = craft === 'all'      || card.dataset.craft      === craft;
            const matchDifficulty = difficulty === 'all' || card.dataset.difficulty === difficulty;
            return matchCraft && matchDifficulty;
        });

        // Sort
        visible.sort((a, b) => {
            if (sort === 'oldest')     return a.dataset.created - b.dataset.created;
            if (sort === 'most_saved') return b.dataset.saved   - a.dataset.saved;
            if (sort === 'title_asc')  return a.dataset.title.localeCompare(b.dataset.title);
            return b.dataset.created - a.dataset.created; // newest
        });

        // Hide all, then re-append visible in sorted order with fade
        allCards.forEach(c => c.classList.add('hidden'));
        visible.forEach(c => {
            c.classList.remove('hidden');
            grid.appendChild(c); // re-order in DOM
        });

        // Toggle no-results state
        if (noResults) noResults.classList.toggle('hidden', visible.length > 0);
        if (visibleCount) visibleCount.textContent = visible.length;
    }

    craftSelect.addEventListener('change', applyFilters);
    difficultySelect.addEventListener('change', applyFilters);
    sortSelect.addEventListener('change', applyFilters);

    clearBtn && clearBtn.addEventListener('click', function () {
        craftSelect.value      = 'all';
        difficultySelect.value = 'all';
        sortSelect.value       = 'newest';
        applyFilters();
    });

    // Delete confirmation
    document.addEventListener('click', function (e) {
        if (e.target.closest('.delete-pattern-btn')) {
            const button = e.target.closest('.delete-pattern-btn');
            const patternId = button.getAttribute('data-pattern-id');
            if (confirm("{{ __('Are you sure you want to delete this pattern? This action cannot be undone.') }}")) {
                document.getElementById('delete-form-' + patternId).submit();
            }
        }
    });
});
</script>
@endsection