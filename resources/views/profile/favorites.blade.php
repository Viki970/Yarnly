@extends('layout.app')

@section('title', 'My Favorites - Yarnly')

@section('content')
<section class="relative overflow-hidden bg-gradient-to-br from-pink-50 via-rose-50 to-red-50 py-16 dark:from-zinc-900 dark:via-gray-900 dark:to-black">
    <div class="absolute -left-20 top-10 h-48 w-48 rounded-full bg-pink-300/30 blur-3xl dark:bg-pink-500/40"></div>
    <div class="absolute -right-12 bottom-10 h-64 w-64 rounded-full bg-rose-300/25 blur-3xl dark:bg-rose-600/20"></div>
    <div class="relative max-w-6xl mx-auto px-6 lg:px-12">
        <p class="inline-flex items-center gap-2 rounded-full bg-white/70 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-pink-700 ring-1 ring-pink-200 dark:bg-zinc-800/50 dark:text-pink-300 dark:ring-pink-500/60">
            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
            </svg>
            My Collection
        </p>
        <div class="mt-6 flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div class="max-w-3xl">
                <h1 class="text-4xl font-bold tracking-tight text-pink-900 sm:text-5xl dark:text-pink-100">Your favorite patterns</h1>
                <p class="mt-4 text-lg leading-relaxed text-zinc-600 dark:text-zinc-400">
                    All the crochet patterns you've saved for later. Your personal collection of inspiration and future projects.
                </p>
            </div>
            <div class="rounded-2xl bg-white/80 p-6 shadow-xl ring-1 ring-pink-100 backdrop-blur dark:bg-zinc-800/60 dark:ring-pink-500/50">
                <div class="text-center">
                    <p class="text-sm font-medium text-pink-400 dark:text-pink-300">{{ $tab == 'patterns' ? 'Saved patterns' : 'Saved collections' }}</p>
                    <p class="mt-2 text-3xl font-bold text-pink-900 dark:text-white">{{ $tab == 'patterns' ? $totalPatterns : $totalCollections }}</p>
                    <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">Ready to create</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-white py-12 dark:bg-gray-900">
    <div class="max-w-6xl mx-auto px-6 lg:px-12">
        <!-- Tab Navigation -->
        <div class="mb-8 relative bg-gradient-to-br from-pink-50 via-rose-50 to-red-50 dark:from-gray-800/80 dark:via-gray-800/80 dark:to-gray-800/80 rounded-2xl p-2 shadow-sm border border-pink-100 dark:border-pink-500/30">
            <div class="flex gap-2 relative z-10">
                <button data-tab="patterns" class="tab-button flex-1 text-center px-6 py-3 rounded-xl text-sm font-semibold transition-all duration-300 ease-in-out {{ $tab == 'patterns' ? 'text-white' : 'text-pink-700 dark:text-pink-300 hover:bg-white/50 dark:hover:bg-pink-500/20' }}">
                    <svg class="inline-block h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    Favorite Patterns
                </button>
                <button data-tab="collections" class="tab-button flex-1 text-center px-6 py-3 rounded-xl text-sm font-semibold transition-all duration-300 ease-in-out {{ $tab == 'collections' ? 'text-white' : 'text-pink-700 dark:text-pink-300 hover:bg-white/50 dark:hover:bg-pink-500/20' }}">
                    <svg class="inline-block h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Favorite Collections
                </button>
            </div>
            <div id="tab-indicator" class="absolute top-2 {{ $tab == 'patterns' ? 'left-2' : 'left-1/2' }} w-[calc(50%-0.5rem)] h-[calc(100%-1rem)] bg-gradient-to-r from-pink-300 to-pink-400 rounded-xl shadow-md transition-all duration-500 ease-out z-0"></div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800/70 rounded-2xl p-6 shadow-lg border border-pink-100 dark:border-pink-500/40">
                <div class="flex items-center">
                    <div class="p-5 rounded-full bg-pink-100 dark:bg-pink-500/20">
                        <svg class="h-16 w-16 text-pink-400 dark:text-pink-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">{{ $tab == 'patterns' ? 'Total Patterns' : 'Total Collections' }}</p>
                        <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $tab == 'patterns' ? $totalPatterns : $totalCollections }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800/70 rounded-2xl p-6 shadow-lg border border-pink-100 dark:border-pink-500/40">
                <div class="flex items-center">
                    <div class="p-5 rounded-full bg-pink-100 dark:bg-pink-500/20">
                        <svg class="h-16 w-16 text-pink-500 dark:text-pink-400 transform rotate-45" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2c-1.2 0-2.2.8-2.2 1.8v8.4c-.2.1-.4.3-.4.6l-.3 8.4c0 .2.1.3.2.4.1.1.3.2.4.2h1.8c.2 0 .3-.1.4-.2.1-.1.2-.2.2-.4l-.3-8.4c0-.2-.1-.4-.3-.5V4.6c0-.1 0-.1 0-.1 0 0 .1 0 .1 0 .1 0 .2.1.2.2v.6c0 .3.3.6.6.6.7 0 1.2-.5 1.2-1.2v-.3C13.2 2.8 12.4 2 12 2z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Crochet</p>
                        <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $tab == 'patterns' ? $crochetPatterns->count() : $crochetCollections->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800/70 rounded-2xl p-6 shadow-lg border border-pink-100 dark:border-pink-500/40">
                <div class="flex items-center">
                    <div class="p-5 rounded-full bg-pink-100 dark:bg-pink-500/20">
                        <svg class="h-16 w-16 text-pink-500 dark:text-pink-400 transform" fill="currentColor" viewBox="0 0 512 768">
                            <path d="M506.267,495.415l-224.299-78.02l121.182-42.146c10.795,15.573,28.774,25.822,49.118,25.822c32.93,0,59.733-26.803,59.733-59.733c0-32.93-26.803-59.733-59.733-59.733c-32.93,0-59.733,26.803-59.733,59.733c0,6.46,1.067,12.672,2.97,18.5l-139.503,48.529l-139.503-48.529c1.903-5.828,2.97-12.041,2.97-18.5c0-32.93-26.803-59.733-59.733-59.733S0.002,308.407,0.002,341.337c0,32.93,26.803,59.733,59.733,59.733c20.343,0,38.323-10.24,49.118-25.822l121.182,42.146L5.736,495.415c-4.463,1.545-6.81,6.409-5.257,10.854c1.22,3.524,4.523,5.734,8.055,5.734c0.93,0,1.877-0.154,2.799-0.478l244.668-85.103l244.668,85.103c0.922,0.324,1.869,0.478,2.799,0.478c3.533,0,6.835-2.21,8.055-5.734C513.077,501.823,510.73,496.959,506.267,495.415z M460.802,315.737c4.719,0,8.533,3.814,8.533,8.533c0,4.719-3.814,8.533-8.533,8.533c-9.412,0-17.067,7.654-17.067,17.067c0,4.719-3.814,8.533-8.533,8.533s-8.533-3.814-8.533-8.533C426.668,331.046,441.977,315.737,460.802,315.737z M68.268,332.803c-9.412,0-17.067,7.654-17.067,17.067c0,4.719-3.814,8.533-8.533,8.533s-8.533-3.814-8.533-8.533c0-18.825,15.309-34.133,34.133-34.133c4.719,0,8.533,3.814,8.533,8.533C76.802,328.989,72.987,332.803,68.268,332.803z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Knitting</p>
                        <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $tab == 'patterns' ? $knittingPatterns->count() : $knittingCollections->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800/70 rounded-2xl p-6 shadow-lg border border-pink-100 dark:border-pink-500/40">
                <div class="flex items-center">
                    <div class="p-5 rounded-full bg-pink-100 dark:bg-pink-500/20">
                        <svg class="h-14 w-14 text-pink-500 dark:text-pink-400" fill="currentColor" viewBox="0 0 274 274">
                            <path d="M262.353,170.603c-0.792-2.288-19.578-56.177-45.5-69.878c-1.554-0.818-3.18-1.652-4.847-2.501c7.783-26.139,10.299-47.996,5.188-66.953c-4.981-18.491-22.059-32.213-38.856-31.219c-14.794,0.865-25.295,12.718-28.097,31.701c-0.88,5.965-0.834,11.387-0.171,16.43c-3.469,4.836-5.841,9.036-6.543,10.325L13.143,266.149c-0.997,1.579-2.231,3.547-0.955,5.872l1.229,2.206h2.509c2.201,0,3.379-1.476,4.513-2.895L170.42,83.093c9.569,8.114,21.034,14.245,31.375,19.49c-4.635,14.333-10.776,30.049-18.046,47.328c-19.957,47.483-10.657,86.687,3.401,95.64c0.705,0.451,1.492,0.663,2.279,0.663c1.402,0,2.77-0.694,3.583-1.968c1.248-1.973,0.673-4.604-1.305-5.852c-9.896-6.302-18.662-41.109-0.135-85.19c7.13-16.953,13.204-32.467,17.875-46.753c1.186,0.605,2.34,1.201,3.453,1.786c22.96,12.138,41.26,64.612,41.436,65.136c0.767,2.217,3.18,3.392,5.396,2.631C261.934,175.227,263.115,172.814,262.353,170.603z M153.986,80.063l-8.353,6.902l3.299-10.325c0.973-3.024,2.791-8.383,5.203-14.131c1.885,4.085,4.272,7.819,7.048,11.236C157.973,76.713,155.27,79.002,153.986,80.063z M167.345,67.781c-3.671-4.722-6.426-10.077-7.954-16.181c4.106-7.322,9.021-13.241,14.209-13.241c1.435,0,2.817,0.409,4.096,1.222c2.123,1.341,3.319,3.365,3.48,5.851C181.564,51.579,174.481,60.464,167.345,67.781z M204.333,94.345c-9.823-5.007-20.164-10.651-28.589-17.891c5.634-7.28,16.669-23.229,15.198-34.932c-0.513-4.096-2.517-7.482-5.789-9.792c-2.714-1.9-5.686-2.874-8.839-2.874c-6.551,0-12.868,4.339-18.201,9.704c0.083-1.802,0.232-3.646,0.518-5.571c2.2-14.934,9.569-23.855,20.205-24.477c0.378-0.021,0.771-0.037,1.16-0.037c11.143,0,24.72,9.088,29.013,24.995C213.57,50.414,211.343,70.354,204.333,94.345z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Embroidery</p>
                        <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $tab == 'patterns' ? $embroideryPatterns->count() : $embroideryCollections->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter by Craft Type -->
        @if(($tab == 'patterns' && $totalPatterns > 0) || ($tab == 'collections' && $totalCollections > 0))
            <div class="mb-8 bg-gradient-to-br from-pink-50 via-rose-50 to-red-50 dark:from-gray-800/70 dark:via-gray-800/70 dark:to-gray-800/70 rounded-2xl p-6 shadow-sm border border-pink-100 dark:border-pink-500/40">
                <h3 class="text-sm font-semibold text-pink-900 dark:text-pink-200 mb-4">Filter by craft type:</h3>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('patterns.favorites', ['tab' => $tab, 'filter' => 'all']) }}" 
                       class="px-6 py-3 rounded-full text-sm font-semibold transition-all duration-300 ease-in-out {{ $craftFilter == 'all' ? 'bg-gradient-to-r from-pink-300 to-pink-400 text-white shadow-md scale-105' : 'bg-white dark:bg-gray-700/50 text-zinc-700 dark:text-zinc-300 hover:bg-gradient-to-r hover:from-pink-50 hover:to-rose-50 dark:hover:from-pink-500/20 dark:hover:to-pink-400/20 hover:text-pink-700 dark:hover:text-pink-300 hover:shadow-sm hover:scale-105' }}">
                        All {{ $tab == 'patterns' ? 'Patterns' : 'Collections' }}
                    </a>
                    <a href="{{ route('patterns.favorites', ['tab' => $tab, 'filter' => 'crochet']) }}" 
                       class="px-6 py-3 rounded-full text-sm font-semibold transition-all duration-300 ease-in-out flex items-center gap-2 {{ $craftFilter == 'crochet' ? 'bg-gradient-to-r from-pink-300 to-pink-400 text-white shadow-md scale-105' : 'bg-white dark:bg-gray-700/50 text-zinc-700 dark:text-zinc-300 hover:bg-gradient-to-r hover:from-pink-50 hover:to-pink-100 dark:hover:from-pink-500/20 dark:hover:to-pink-400/20 hover:text-pink-600 dark:hover:text-pink-300 hover:shadow-sm hover:scale-105' }}">
                        <svg class="h-5 w-5 transform rotate-45" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2c-1.2 0-2.2.8-2.2 1.8v8.4c-.2.1-.4.3-.4.6l-.3 8.4c0 .2.1.3.2.4.1.1.3.2.4.2h1.8c.2 0 .3-.1.4-.2.1-.1.2-.2.2-.4l-.3-8.4c0-.2-.1-.4-.3-.5V4.6c0-.1 0-.1 0-.1 0 0 .1 0 .1 0 .1 0 .2.1.2.2v.6c0 .3.3.6.6.6.7 0 1.2-.5 1.2-1.2v-.3C13.2 2.8 12.4 2 12 2z" />
                        </svg>
                        Crochet
                    </a>
                    <a href="{{ route('patterns.favorites', ['tab' => $tab, 'filter' => 'knitting']) }}" 
                       class="px-6 py-3 rounded-full text-sm font-semibold transition-all duration-300 ease-in-out flex items-center gap-2 {{ $craftFilter == 'knitting' ? 'bg-gradient-to-r from-pink-300 to-pink-400 text-white shadow-md scale-105' : 'bg-white dark:bg-gray-700/50 text-zinc-700 dark:text-zinc-300 hover:bg-gradient-to-r hover:from-pink-50 hover:to-pink-100 dark:hover:from-pink-500/20 dark:hover:to-pink-400/20 hover:text-pink-600 dark:hover:text-pink-300 hover:shadow-sm hover:scale-105' }}">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 512 768">
                            <path d="M506.267,495.415l-224.299-78.02l121.182-42.146c10.795,15.573,28.774,25.822,49.118,25.822c32.93,0,59.733-26.803,59.733-59.733c0-32.93-26.803-59.733-59.733-59.733c-32.93,0-59.733,26.803-59.733,59.733c0,6.46,1.067,12.672,2.97,18.5l-139.503,48.529l-139.503-48.529c1.903-5.828,2.97-12.041,2.97-18.5c0-32.93-26.803-59.733-59.733-59.733S0.002,308.407,0.002,341.337c0,32.93,26.803,59.733,59.733,59.733c20.343,0,38.323-10.24,49.118-25.822l121.182,42.146L5.736,495.415c-4.463,1.545-6.81,6.409-5.257,10.854c1.22,3.524,4.523,5.734,8.055,5.734c0.93,0,1.877-0.154,2.799-0.478l244.668-85.103l244.668,85.103c0.922,0.324,1.869,0.478,2.799,0.478c3.533,0,6.835-2.21,8.055-5.734C513.077,501.823,510.73,496.959,506.267,495.415z M460.802,315.737c4.719,0,8.533,3.814,8.533,8.533c0,4.719-3.814,8.533-8.533,8.533c-9.412,0-17.067,7.654-17.067,17.067c0,4.719-3.814,8.533-8.533,8.533s-8.533-3.814-8.533-8.533C426.668,331.046,441.977,315.737,460.802,315.737z M68.268,332.803c-9.412,0-17.067,7.654-17.067,17.067c0,4.719-3.814,8.533-8.533,8.533s-8.533-3.814-8.533-8.533c0-18.825,15.309-34.133,34.133-34.133c4.719,0,8.533,3.814,8.533,8.533C76.802,328.989,72.987,332.803,68.268,332.803z" />
                        </svg>
                        Knitting
                    </a>
                    <a href="{{ route('patterns.favorites', ['tab' => $tab, 'filter' => 'embroidery']) }}" 
                       class="px-6 py-3 rounded-full text-sm font-semibold transition-all duration-300 ease-in-out flex items-center gap-2 {{ $craftFilter == 'embroidery' ? 'bg-gradient-to-r from-pink-300 to-pink-400 text-white shadow-md scale-105' : 'bg-white dark:bg-gray-700/50 text-zinc-700 dark:text-zinc-300 hover:bg-gradient-to-r hover:from-pink-50 hover:to-pink-100 dark:hover:from-pink-500/20 dark:hover:to-pink-400/20 hover:text-pink-600 dark:hover:text-pink-300 hover:shadow-sm hover:scale-105' }}">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 274 274">
                            <path d="M262.353,170.603c-0.792-2.288-19.578-56.177-45.5-69.878c-1.554-0.818-3.18-1.652-4.847-2.501c7.783-26.139,10.299-47.996,5.188-66.953c-4.981-18.491-22.059-32.213-38.856-31.219c-14.794,0.865-25.295,12.718-28.097,31.701c-0.88,5.965-0.834,11.387-0.171,16.43c-3.469,4.836-5.841,9.036-6.543,10.325L13.143,266.149c-0.997,1.579-2.231,3.547-0.955,5.872l1.229,2.206h2.509c2.201,0,3.379-1.476,4.513-2.895L170.42,83.093c9.569,8.114,21.034,14.245,31.375,19.49c-4.635,14.333-10.776,30.049-18.046,47.328c-19.957,47.483-10.657,86.687,3.401,95.64c0.705,0.451,1.492,0.663,2.279,0.663c1.402,0,2.77-0.694,3.583-1.968c1.248-1.973,0.673-4.604-1.305-5.852c-9.896-6.302-18.662-41.109-0.135-85.19c7.13-16.953,13.204-32.467,17.875-46.753c1.186,0.605,2.34,1.201,3.453,1.786c22.96,12.138,41.26,64.612,41.436,65.136c0.767,2.217,3.18,3.392,5.396,2.631C261.934,175.227,263.115,172.814,262.353,170.603z M153.986,80.063l-8.353,6.902l3.299-10.325c0.973-3.024,2.791-8.383,5.203-14.131c1.885,4.085,4.272,7.819,7.048,11.236C157.973,76.713,155.27,79.002,153.986,80.063z M167.345,67.781c-3.671-4.722-6.426-10.077-7.954-16.181c4.106-7.322,9.021-13.241,14.209-13.241c1.435,0,2.817,0.409,4.096,1.222c2.123,1.341,3.319,3.365,3.48,5.851C181.564,51.579,174.481,60.464,167.345,67.781z M204.333,94.345c-9.823-5.007-20.164-10.651-28.589-17.891c5.634-7.28,16.669-23.229,15.198-34.932c-0.513-4.096-2.517-7.482-5.789-9.792c-2.714-1.9-5.686-2.874-8.839-2.874c-6.551,0-12.868,4.339-18.201,9.704c0.083-1.802,0.232-3.646,0.518-5.571c2.2-14.934,9.569-23.855,20.205-24.477c0.378-0.021,0.771-0.037,1.16-0.037c11.143,0,24.72,9.088,29.013,24.995C213.57,50.414,211.343,70.354,204.333,94.345z" />
                        </svg>
                        Embroidery
                    </a>
                </div>
            </div>
        @endif

        @if($tab == 'patterns')
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-pink-700 dark:text-pink-200">Your collection</p>
                <h2 class="text-3xl font-bold text-zinc-900 dark:text-white">Favorite patterns</h2>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">Patterns you've saved to create later</p>
            </div>
            <a href="{{ route('patterns.crochet') }}" class="text-sm font-semibold text-zinc-600 underline-offset-4 hover:underline dark:text-zinc-300">Browse more patterns</a>
        </div>

        <!-- Patterns Section -->
        @if($favoritePatterns && $favoritePatterns->count() > 0)
            <div class="mt-8 grid gap-6 md:grid-cols-3">
                @foreach($favoritePatterns as $pattern)
                    <article class="group rounded-2xl border border-pink-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-pink-500/30 dark:bg-gray-800/60">
                        @if($pattern->image_path)
                            <div class="mb-4 aspect-[3/4] w-full overflow-hidden rounded-xl bg-zinc-100 dark:bg-zinc-700/30">
                                <img 
                                    src="{{ asset('storage/' . $pattern->image_path) }}" 
                                    alt="{{ $pattern->title }}"
                                    class="h-full w-full object-cover" 
                                    loading="lazy">
                            </div>
                        @endif
                        <div class="flex items-center justify-between">
                            <div class="rounded-lg px-3 py-1 text-xs font-semibold @if($pattern->difficulty === 'beginner') bg-pink-100 text-pink-700 dark:bg-pink-200/20 dark:text-pink-300 @elseif($pattern->difficulty === 'intermediate') bg-pink-200 text-pink-800 dark:bg-pink-300/20 dark:text-pink-400 @else bg-pink-300 text-pink-900 dark:bg-pink-400/20 dark:text-pink-500 @endif">
                                {{ ucfirst($pattern->difficulty) }}
                            </div>
                            @if($pattern->estimated_hours)
                                <span class="text-xs font-medium text-pink-700 dark:text-pink-200">≈ {{ $pattern->estimated_hours }} hrs</span>
                            @endif
                        </div>
                        <h3 class="mt-4 text-lg font-bold text-zinc-900 dark:text-white">{{ $pattern->title }}</h3>
                        <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">{{ Str::limit($pattern->description, 80) }}</p>
                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex items-center gap-3 text-xs font-semibold text-pink-700 dark:text-pink-200">
                                <span class="inline-flex h-2 w-2 rounded-full bg-pink-300"></span>
                                <span class="makers-saved-{{ $pattern->id }}">{{ $pattern->makers_saved }}</span> makers saved
                            </div>
                            <button class="favorite-btn p-2 rounded-full transition-all duration-200 hover:scale-110 text-pink-400 hover:text-pink-500"
                                    data-pattern-id="{{ $pattern->id }}"
                                    data-favorited="true">
                                <svg class="h-5 w-5 fill-current" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>
                        @if($pattern->pdf_file)
                            <div class="mt-5 flex gap-2">
                                <a href="{{ route('patterns.view', $pattern->id) }}" class="flex-1 rounded-lg bg-pink-500 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-pink-600">View Pattern</a>
                                <a href="{{ route('patterns.download', $pattern) }}" class="flex-1 rounded-lg bg-pink-300 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-pink-400">Download PDF</a>
                            </div>
                        @else
                            <button disabled class="mt-5 block w-full rounded-lg bg-zinc-200 px-4 py-2 text-center text-sm font-semibold text-zinc-500 cursor-not-allowed dark:bg-zinc-600/30 dark:text-zinc-400">PDF Coming Soon</button>
                        @endif
                        
                        <div class="mt-3 flex flex-wrap gap-1 text-xs font-semibold text-pink-700 dark:text-pink-200">
                            <span class="rounded-full bg-pink-100 px-2 py-1 dark:bg-pink-900/40">{{ $pattern->getCategoryLabel() }}</span>
                            <span class="rounded-full bg-pink-100 px-2 py-1 dark:bg-pink-900/40">Saved {{ $pattern->pivot->created_at->diffForHumans() }}</span>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="mt-12 rounded-2xl border border-dashed border-pink-200 bg-pink-50 p-12 text-center dark:border-pink-500/40 dark:bg-gray-800/60">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-pink-100 dark:bg-pink-500/20">
                    <svg class="h-8 w-8 text-pink-400 dark:text-pink-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-pink-900 dark:text-white">No favorite patterns{{ $craftFilter != 'all' ? ' for ' . ucfirst($craftFilter) : '' }}</h3>
                <p class="mt-2 text-sm text-pink-700 dark:text-pink-300">Start exploring patterns and save your favorites by clicking the heart icon!</p>
                <a href="{{ route('patterns.crochet') }}" class="mt-6 inline-block rounded-lg bg-pink-300 px-6 py-3 text-sm font-semibold text-white transition hover:bg-pink-400">Browse Patterns</a>
            </div>
        @endif
        @else
        <!-- Collections Section -->
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between mb-8">
            <div>
                <p class="text-sm font-semibold text-pink-700 dark:text-pink-200">Your collection</p>
                <h2 class="text-3xl font-bold text-zinc-900 dark:text-white">Favorite collections</h2>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">Collections you've saved for inspiration</p>
            </div>
            <a href="{{ route('my-collections') }}" class="text-sm font-semibold text-zinc-600 underline-offset-4 hover:underline dark:text-zinc-300">Browse more collections</a>
        </div>

        @if($favoriteCollections && $favoriteCollections->count() > 0)
            <div class="grid gap-6 md:grid-cols-3">
                @foreach($favoriteCollections as $collection)
                    @include('collections.partials.collection-card', ['collection' => $collection, 'color' => 'pink'])
                @endforeach
            </div>
        @else
            <div class="mt-12 rounded-2xl border border-dashed border-pink-200 bg-pink-50 p-12 text-center dark:border-pink-500/40 dark:bg-gray-800/60">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-pink-100 dark:bg-pink-500/20">
                    <svg class="h-8 w-8 text-pink-400 dark:text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-pink-900 dark:text-white">No favorite collections{{ $craftFilter != 'all' ? ' for ' . ucfirst($craftFilter) : '' }}</h3>
                <p class="mt-2 text-sm text-pink-700 dark:text-pink-300">Discover collections created by other makers and save your favorites!</p>
                <a href="{{ route('my-collections') }}" class="mt-6 inline-block rounded-lg bg-pink-300 px-6 py-3 text-sm font-semibold text-white transition hover:bg-pink-400">Browse Collections</a>
            </div>
        @endif
        @endif
    </div>
</section>

<script>
// Smooth tab switching with visual feedback
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabIndicator = document.getElementById('tab-indicator');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const targetTab = this.dataset.tab;
            const currentUrl = new URL(window.location);
            currentUrl.searchParams.set('tab', targetTab);
            
            // Add loading state
            this.style.opacity = '0.7';
            this.style.pointerEvents = 'none';
            
            // Smooth indicator transition before navigation
            if (targetTab === 'patterns') {
                tabIndicator.style.left = '0.5rem';
            } else {
                tabIndicator.style.left = '50%';
            }
            
            // Navigate after animation
            setTimeout(() => {
                window.location.href = currentUrl;
            }, 300);
        });
        
        // Smooth hover effect - shift indicator slightly
        button.addEventListener('mouseenter', function() {
            const targetTab = this.dataset.tab;
            const currentTab = '{{ $tab }}';
            
            if (targetTab !== currentTab) {
                const rect = this.getBoundingClientRect();
                const parentRect = this.parentElement.getBoundingClientRect();
                const offset = rect.left - parentRect.left;
                
                // Create subtle hover preview
                tabIndicator.style.opacity = '0.7';
                if (targetTab === 'patterns') {
                    tabIndicator.style.transform = 'translateX(-4px)';
                } else {
                    tabIndicator.style.transform = 'translateX(4px)';
                }
            }
        });
        
        button.addEventListener('mouseleave', function() {
            tabIndicator.style.opacity = '1';
            tabIndicator.style.transform = 'translateX(0)';
        });
    });
});

// Event delegation for favorite buttons
document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('click', function(e) {
        if (e.target.closest('.favorite-btn')) {
            e.preventDefault();
            const button = e.target.closest('.favorite-btn');
            const patternId = button.dataset.patternId;
            const isFavorited = button.dataset.favorited === 'true';
            
            // Disable button during request and add loading state
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
                    const article = button.closest('article');
                    
                    if (data.favorited) {
                        button.classList.remove('text-zinc-400', 'hover:text-pink-500');
                        button.classList.add('text-pink-400', 'hover:text-pink-500');
                        button.dataset.favorited = 'true';
                        svg.classList.add('fill-current');
                        svg.setAttribute('fill', 'currentColor');
                    } else {
                        // If unfavorited on favorites page, remove the entire article with animation
                        article.style.transition = 'opacity 0.3s ease-out, transform 0.3s ease-out';
                        article.style.opacity = '0';
                        article.style.transform = 'scale(0.95)';
                        setTimeout(() => {
                            article.remove();
                            // Check if no favorites left
                            const articlesLeft = document.querySelectorAll('article').length;
                            if (articlesLeft === 0) {
                                location.reload(); // Reload to show the "no favorites" message
                            }
                        }, 300);
                    }
                    
                    // Update makers saved count
                    const countSpan = document.querySelector(`.makers-saved-${patternId}`);
                    if (countSpan) {
                        countSpan.textContent = data.makers_saved;
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
</script>
@endsection