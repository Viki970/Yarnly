@extends('layout.app')

@section('title', 'My Collections - Yarnly')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-br from-teal-50 via-emerald-50 to-green-50 py-16 dark:from-zinc-900 dark:via-gray-900 dark:to-black">
    <div class="absolute -left-20 top-10 h-48 w-48 rounded-full bg-teal-300/30 blur-3xl dark:bg-teal-500/40"></div>
    <div class="absolute -right-12 bottom-10 h-64 w-64 rounded-full bg-emerald-300/25 blur-3xl dark:bg-emerald-600/20"></div>
    <div class="relative max-w-6xl mx-auto px-6 lg:px-12">
        <p class="inline-flex items-center gap-2 rounded-full bg-white/70 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-teal-700 ring-1 ring-teal-200 dark:bg-zinc-800/50 dark:text-teal-300 dark:ring-teal-500/60">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
            {{ __('My Workshop') }}
        </p>
        <div class="mt-6 flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div class="max-w-3xl">
                <h1 class="text-4xl font-bold tracking-tight text-teal-900 sm:text-5xl dark:text-teal-100">My Collections</h1>
                <p class="mt-4 text-lg leading-relaxed text-zinc-600 dark:text-zinc-400">
                    {{ __('Organize and manage your pattern collections. Share curated sets with the community.') }}
                </p>
            </div>
            <div class="flex flex-col items-center gap-4">
                <div class="rounded-2xl bg-white/80 p-6 shadow-xl ring-1 ring-teal-100 backdrop-blur dark:bg-zinc-800/60 dark:ring-teal-500/50">
                    <div class="text-center">
                        <p class="text-sm font-medium text-teal-400 dark:text-teal-300">{{ __('Created collections') }}</p>
                        <p class="mt-2 text-3xl font-bold text-teal-900 dark:text-white">{{ $totalCollections }}</p>
                        <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">{{ __('Ready to share') }}</p>
                    </div>
                </div>
                <a href="{{ route('collections.select-patterns') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-teal-500 to-emerald-500 text-white font-semibold hover:from-teal-600 hover:to-emerald-600 transform hover:scale-105 transition-all duration-200 shadow-lg">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    {{ __('Create New Collection') }}
                </a>
            </div>
        </div>
    </div>
</section>

<section class="bg-white py-12 dark:bg-gray-900">
    <div class="max-w-6xl mx-auto px-6 lg:px-12">

        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-teal-50 dark:bg-teal-900/30 border border-teal-200 dark:border-teal-800">
                <p class="text-teal-700 dark:text-teal-300">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800/70 rounded-2xl p-6 shadow-lg border border-teal-100 dark:border-teal-500/40">
                <div class="flex items-center">
                    <div class="p-5 rounded-full bg-teal-100 dark:bg-teal-500/20">
                        <svg class="h-16 w-16 text-teal-500 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">{{ __('Total Collections') }}</p>
                        <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $totalCollections }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800/70 rounded-2xl p-6 shadow-lg border border-teal-100 dark:border-teal-500/40">
                <div class="flex items-center">
                    <div class="p-5 rounded-full bg-emerald-100 dark:bg-emerald-500/20">
                        <svg class="h-16 w-16 text-emerald-500 dark:text-emerald-400 transform rotate-45" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2c-1.2 0-2.2.8-2.2 1.8v8.4c-.2.1-.4.3-.4.6l-.3 8.4c0 .2.1.3.2.4.1.1.3.2.4.2h1.8c.2 0 .3-.1.4-.2.1-.1.2-.2.2-.4l-.3-8.4c0-.2-.1-.4-.3-.5V4.6c0-.1 0-.1 0-.1 0 0 .1 0 .1 0 .1 0 .2.1.2.2v.6c0 .3.3.6.6.6.7 0 1.2-.5 1.2-1.2v-.3C13.2 2.8 12.4 2 12 2z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">{{ __('Crochet') }}</p>
                        <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $crochetCollections->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800/70 rounded-2xl p-6 shadow-lg border border-teal-100 dark:border-teal-500/40">
                <div class="flex items-center">
                    <div class="p-5 rounded-full bg-indigo-100 dark:bg-indigo-500/20">
                        <svg class="h-16 w-16 text-indigo-500 dark:text-indigo-400" fill="currentColor" viewBox="0 0 512 768">
                            <path d="M506.267,495.415l-224.299-78.02l121.182-42.146c10.795,15.573,28.774,25.822,49.118,25.822c32.93,0,59.733-26.803,59.733-59.733c0-32.93-26.803-59.733-59.733-59.733c-32.93,0-59.733,26.803-59.733,59.733c0,6.46,1.067,12.672,2.97,18.5l-139.503,48.529l-139.503-48.529c1.903-5.828,2.97-12.041,2.97-18.5c0-32.93-26.803-59.733-59.733-59.733S0.002,308.407,0.002,341.337c0,32.93,26.803,59.733,59.733,59.733c20.343,0,38.323-10.24,49.118-25.822l121.182,42.146L5.736,495.415c-4.463,1.545-6.81,6.409-5.257,10.854c1.22,3.524,4.523,5.734,8.055,5.734c0.93,0,1.877-0.154,2.799-0.478l244.668-85.103l244.668,85.103c0.922,0.324,1.869,0.478,2.799,0.478c3.533,0,6.835-2.21,8.055-5.734C513.077,501.823,510.73,496.959,506.267,495.415z M460.802,315.737c4.719,0,8.533,3.814,8.533,8.533c0,4.719-3.814,8.533-8.533,8.533c-9.412,0-17.067,7.654-17.067,17.067c0,4.719-3.814,8.533-8.533,8.533s-8.533-3.814-8.533-8.533C426.668,331.046,441.977,315.737,460.802,315.737z M68.268,332.803c-9.412,0-17.067,7.654-17.067,17.067c0,4.719-3.814,8.533-8.533,8.533s-8.533-3.814-8.533-8.533c0-18.825,15.309-34.133,34.133-34.133c4.719,0,8.533,3.814,8.533,8.533C76.802,328.989,72.987,332.803,68.268,332.803z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">{{ __('Knitting') }}</p>
                        <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $knittingCollections->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800/70 rounded-2xl p-6 shadow-lg border border-teal-100 dark:border-teal-500/40">
                <div class="flex items-center">
                    <div class="p-5 rounded-full bg-purple-100 dark:bg-purple-500/20">
                        <svg class="h-14 w-14 text-purple-500 dark:text-purple-400" fill="currentColor" viewBox="0 0 274 274">
                            <path d="M262.353,170.603c-0.792-2.288-19.578-56.177-45.5-69.878c-1.554-0.818-3.18-1.652-4.847-2.501c7.783-26.139,10.299-47.996,5.188-66.953c-4.981-18.491-22.059-32.213-38.856-31.219c-14.794,0.865-25.295,12.718-28.097,31.701c-0.88,5.965-0.834,11.387-0.171,16.43c-3.469,4.836-5.841,9.036-6.543,10.325L13.143,266.149c-0.997,1.579-2.231,3.547-0.955,5.872l1.229,2.206h2.509c2.201,0,3.379-1.476,4.513-2.895L170.42,83.093c9.569,8.114,21.034,14.245,31.375,19.49c-4.635,14.333-10.776,30.049-18.046,47.328c-19.957,47.483-10.657,86.687,3.401,95.64c0.705,0.451,1.492,0.663,2.279,0.663c1.402,0,2.77-0.694,3.583-1.968c1.248-1.973,0.673-4.604-1.305-5.852c-9.896-6.302-18.662-41.109-0.135-85.19c7.13-16.953,13.204-32.467,17.875-46.753c1.186,0.605,2.34,1.201,3.453,1.786c22.96,12.138,41.26,64.612,41.436,65.136c0.767,2.217,3.18,3.392,5.396,2.631C261.934,175.227,263.115,172.814,262.353,170.603z M153.986,80.063l-8.353,6.902l3.299-10.325c0.973-3.024,2.791-8.383,5.203-14.131c1.885,4.085,4.272,7.819,7.048,11.236C157.973,76.713,155.27,79.002,153.986,80.063z M167.345,67.781c-3.671-4.722-6.426-10.077-7.954-16.181c4.106-7.322,9.021-13.241,14.209-13.241c1.435,0,2.817,0.409,4.096,1.222c2.123,1.341,3.319,3.365,3.48,5.851C181.564,51.579,174.481,60.464,167.345,67.781z M204.333,94.345c-9.823-5.007-20.164-10.651-28.589-17.891c5.634-7.28,16.669-23.229,15.198-34.932c-0.513-4.096-2.517-7.482-5.789-9.792c-2.714-1.9-5.686-2.874-8.839-2.874c-6.551,0-12.868,4.339-18.201,9.704c0.083-1.802,0.232-3.646,0.518-5.571c2.2-14.934,9.569-23.855,20.205-24.477c0.378-0.021,0.771-0.037,1.16-0.037c11.143,0,24.72,9.088,29.013,24.995C213.57,50.414,211.343,70.354,204.333,94.345z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">{{ __('Embroidery') }}</p>
                        <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $embroideryCollections->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter & Sort Bar -->
        <div class="mb-8 flex flex-wrap items-end gap-4 rounded-2xl bg-white dark:bg-gray-800/70 border border-zinc-200 dark:border-zinc-700 px-6 py-5 shadow-sm">

            <div class="flex flex-col gap-1.5 min-w-[140px]">
                <label for="f-craft" class="text-xs font-semibold uppercase tracking-wide text-teal-600 dark:text-teal-400">{{ __('Craft type') }}</label>
                <div class="relative">
                    <select id="f-craft"
                        class="w-full appearance-none rounded-lg border border-teal-200 dark:border-teal-700/60 bg-white dark:bg-zinc-700 pl-3 pr-8 py-2 text-sm font-medium text-zinc-800 dark:text-zinc-100 focus:outline-none focus:ring-2 focus:ring-teal-400 cursor-pointer">
                        <option value="all">{{ __('All crafts') }}</option>
                        <option value="crochet">{{ __('Crochet') }}</option>
                        <option value="knitting">{{ __('Knitting') }}</option>
                        <option value="embroidery">{{ __('Embroidery') }}</option>
                    </select>
                    <svg class="pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 h-4 w-4 text-teal-400 dark:text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
            </div>

            <div class="flex flex-col gap-1.5 min-w-[165px]">
                <label for="f-sort" class="text-xs font-semibold uppercase tracking-wide text-teal-600 dark:text-teal-400">{{ __('Sort by') }}</label>
                <div class="relative">
                    <select id="f-sort"
                        class="w-full appearance-none rounded-lg border border-teal-200 dark:border-teal-700/60 bg-white dark:bg-zinc-700 pl-3 pr-8 py-2 text-sm font-medium text-zinc-800 dark:text-zinc-100 focus:outline-none focus:ring-2 focus:ring-teal-400 cursor-pointer">
                        <option value="newest">{{ __('Newest first') }}</option>
                        <option value="oldest">{{ __('Oldest first') }}</option>
                        <option value="most_patterns">{{ __('Most patterns') }}</option>
                        <option value="title_asc">{{ __('Title A-Z') }}</option>
                    </select>
                    <svg class="pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 h-4 w-4 text-teal-400 dark:text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
            </div>

            <button id="clear-filters" type="button"
                class="hidden ml-auto self-end rounded-lg border border-zinc-300 dark:border-zinc-600 px-4 py-2 text-sm font-semibold text-zinc-500 dark:text-zinc-400 hover:border-red-300 hover:text-red-500 transition-colors">
                {{ __('Clear filters') }}
            </button>
        </div>

        <!-- Section heading -->
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between mb-8">
            <div>
                <p class="text-sm font-semibold text-teal-700 dark:text-teal-200">{{ __('Your workshop') }}</p>
                <h2 class="text-3xl font-bold text-zinc-900 dark:text-white">{{ __('All collections') }}</h2>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">
                    Showing <span id="visible-count">{{ $totalCollections }}</span> of {{ $totalCollections }} collection{{ $totalCollections !== 1 ? 's' : '' }}
                </p>
            </div>
            <a href="{{ route('patterns.crochet') }}" class="text-sm font-semibold text-zinc-600 underline-offset-4 hover:underline dark:text-zinc-300">{{ __('Browse community patterns') }}</a>
        </div>

        <!-- Collections Grid -->
        @if($collections->isEmpty())
            <div class="mt-4 rounded-2xl border border-dashed border-teal-200 bg-teal-50 p-12 text-center dark:border-teal-500/40 dark:bg-gray-800/60">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-teal-100 dark:bg-teal-500/20">
                    <svg class="h-8 w-8 text-teal-500 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-teal-900 dark:text-white">{{ __('No collections yet') }}</h3>
                <p class="mt-2 text-sm text-teal-700 dark:text-teal-300">{{ __('Start organizing your patterns into collections to make them easier to find and share!') }}</p>
                <a href="{{ route('collections.select-patterns') }}"
                    class="mt-6 inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-teal-500 to-emerald-500 px-6 py-3 text-sm font-semibold text-white transition hover:from-teal-600 hover:to-emerald-600">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    {{ __('Create Your First Collection') }}
                </a>
            </div>
        @else
            <div id="collections-grid" class="grid gap-6 md:grid-cols-3">
                @foreach($collections as $collection)
                    @php
                        $color = match($collection->craft_type) {
                            'crochet'    => 'emerald',
                            'knitting'   => 'indigo',
                            'embroidery' => 'purple',
                            default      => 'teal',
                        };
                    @endphp
                    <div class="collection-card"
                        data-craft="{{ $collection->craft_type }}"
                        data-created="{{ $collection->created_at->timestamp }}"
                        data-patterns="{{ $collection->patterns->count() }}"
                        data-title="{{ strtolower($collection->name) }}">
                        @include('collections.partials.collection-card', ['collection' => $collection, 'color' => $color])
                    </div>
                @endforeach
            </div>

            <!-- No results message -->
            <div id="no-results" class="hidden mt-4 rounded-2xl border border-dashed border-teal-200 bg-teal-50 p-12 text-center dark:border-teal-500/40 dark:bg-gray-800/60">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-teal-100 dark:bg-teal-500/20">
                    <svg class="h-8 w-8 text-teal-500 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-teal-900 dark:text-white">{{ __('No collections match your filters') }}</h3>
                <p class="mt-2 text-sm text-teal-700 dark:text-teal-300">{{ __('Try adjusting the filters above.') }}</p>
            </div>
        @endif
    </div>
</section>

@auth
<script>
document.addEventListener('DOMContentLoaded', function () {
    const craftSelect  = document.getElementById('f-craft');
    const sortSelect   = document.getElementById('f-sort');
    const clearBtn     = document.getElementById('clear-filters');
    const grid         = document.getElementById('collections-grid');
    const noResults    = document.getElementById('no-results');
    const visibleCount = document.getElementById('visible-count');

    if (!grid) return;

    const allCards = Array.from(grid.querySelectorAll('.collection-card'));

    function applyFilters() {
        const craft = craftSelect.value;
        const sort  = sortSelect.value;

        const isFiltered = craft !== 'all' || sort !== 'newest';
        clearBtn.classList.toggle('hidden', !isFiltered);

        let visible = allCards.filter(card => {
            return craft === 'all' || card.dataset.craft === craft;
        });

        visible.sort((a, b) => {
            if (sort === 'oldest')        return a.dataset.created  - b.dataset.created;
            if (sort === 'most_patterns') return b.dataset.patterns - a.dataset.patterns;
            if (sort === 'title_asc')     return a.dataset.title.localeCompare(b.dataset.title);
            return b.dataset.created - a.dataset.created; // newest
        });

        allCards.forEach(c => c.classList.add('hidden'));
        visible.forEach(c => {
            c.classList.remove('hidden');
            grid.appendChild(c);
        });

        if (noResults) noResults.classList.toggle('hidden', visible.length > 0);
        if (visibleCount) visibleCount.textContent = visible.length;
    }

    craftSelect.addEventListener('change', applyFilters);
    sortSelect.addEventListener('change', applyFilters);

    clearBtn && clearBtn.addEventListener('click', function () {
        craftSelect.value = 'all';
        sortSelect.value  = 'newest';
        applyFilters();
    });

    // Favorite collection toggle
    document.querySelectorAll('.favorite-collection-btn').forEach(button => {
        button.addEventListener('click', async function (e) {
            e.preventDefault();
            const collectionId = this.dataset.collectionId;

            try {
                const response = await fetch(`/collections/${collectionId}/toggle-favorite`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();

                if (data.success) {
                    this.dataset.favorited = data.favorited ? 'true' : 'false';
                    const svg = this.querySelector('svg');

                    if (data.favorited) {
                        this.classList.remove('text-zinc-400', 'hover:text-pink-500');
                        this.classList.add('text-pink-600', 'hover:text-pink-700');
                        svg.classList.add('fill-current');
                        svg.setAttribute('fill', 'currentColor');
                    } else {
                        this.classList.remove('text-pink-600', 'hover:text-pink-700');
                        this.classList.add('text-zinc-400', 'hover:text-pink-500');
                        svg.classList.remove('fill-current');
                        svg.setAttribute('fill', 'none');
                    }

                    const countEl = document.querySelector('.favorites-count-' + collectionId);
                    if (countEl) countEl.textContent = data.favorites_count;
                }
            } catch (error) {
                console.error('Error toggling collection favorite:', error);
            }
        });
    });
});
</script>
@endauth

@endsection

