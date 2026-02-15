<div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-lg border border-{{ $color }}-100 dark:border-{{ $color }}-900/40 overflow-hidden hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
    @if($collection->cover_image_path)
        <img src="{{ asset('storage/' . $collection->cover_image_path) }}" 
            alt="{{ $collection->name }}" 
            class="w-full h-48 object-cover">
    @else
        <div class="w-full h-48 bg-gradient-to-br from-{{ $color }}-100 to-{{ $color }}-200 dark:from-{{ $color }}-900/40 dark:to-{{ $color }}-800/40 flex items-center justify-center">
            @if($collection->craft_type === 'crochet')
                <svg class="h-20 w-20 text-{{ $color }}-500 transform rotate-45" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2c-1.2 0-2.2.8-2.2 1.8v8.4c-.2.1-.4.3-.4.6l-.3 8.4c0 .2.1.3.2.4.1.1.3.2.4.2h1.8c.2 0 .3-.1.4-.2.1-.1.2-.2.2-.4l-.3-8.4c0-.2-.1-.4-.3-.5V4.6c0-.1 0-.1 0-.1 0 0 .1 0 .1 0 .1 0 .2.1.2.2v.6c0 .3.3.6.6.6.7 0 1.2-.5 1.2-1.2v-.3C13.2 2.8 12.4 2 12 2z" />
                </svg>
            @elseif($collection->craft_type === 'knitting')
                <svg class="h-20 w-20 text-{{ $color }}-500 transform" fill="currentColor" viewBox="0 0 512 768">
                    <path d="M506.267,495.415l-224.299-78.02l121.182-42.146c10.795,15.573,28.774,25.822,49.118,25.822     c32.93,0,59.733-26.803,59.733-59.733c0-32.93-26.803-59.733-59.733-59.733c-32.93,0-59.733,26.803-59.733,59.733     c0,6.46,1.067,12.672,2.97,18.5l-139.503,48.529l-139.503-48.529c1.903-5.828,2.97-12.041,2.97-18.5     c0-32.93-26.803-59.733-59.733-59.733S0.002,308.407,0.002,341.337c0,32.93,26.803,59.733,59.733,59.733     c20.343,0,38.323-10.24,49.118-25.822l121.182,42.146L5.736,495.415c-4.463,1.545-6.81,6.409-5.257,10.854     c1.22,3.524,4.523,5.734,8.055,5.734c0.93,0,1.877-0.154,2.799-0.478l244.668-85.103l244.668,85.103     c0.922,0.324,1.869,0.478,2.799,0.478c3.533,0,6.835-2.21,8.055-5.734C513.077,501.823,510.73,496.959,506.267,495.415z      M460.802,315.737c4.719,0,8.533,3.814,8.533,8.533c0,4.719-3.814,8.533-8.533,8.533c-9.412,0-17.067,7.654-17.067,17.067     c0,4.719-3.814,8.533-8.533,8.533s-8.533-3.814-8.533-8.533C426.668,331.046,441.977,315.737,460.802,315.737z M68.268,332.803     c-9.412,0-17.067,7.654-17.067,17.067c0,4.719-3.814,8.533-8.533,8.533s-8.533-3.814-8.533-8.533     c0-18.825,15.309-34.133,34.133-34.133c4.719,0,8.533,3.814,8.533,8.533C76.802,328.989,72.987,332.803,68.268,332.803z" />
                </svg>
            @else
                <svg class="h-20 w-20 text-{{ $color }}-500" fill="currentColor" viewBox="0 0 274 274">
                    <path d="M262.353,170.603c-0.792-2.288-19.578-56.177-45.5-69.878c-1.554-0.818-3.18-1.652-4.847-2.501    c7.783-26.139,10.299-47.996,5.188-66.953c-4.981-18.491-22.059-32.213-38.856-31.219c-14.794,0.865-25.295,12.718-28.097,31.701    c-0.88,5.965-0.834,11.387-0.171,16.43c-3.469,4.836-5.841,9.036-6.543,10.325L13.143,266.149    c-0.997,1.579-2.231,3.547-0.955,5.872l1.229,2.206h2.509c2.201,0,3.379-1.476,4.513-2.895L170.42,83.093    c9.569,8.114,21.034,14.245,31.375,19.49c-4.635,14.333-10.776,30.049-18.046,47.328c-19.957,47.483-10.657,86.687,3.401,95.64    c0.705,0.451,1.492,0.663,2.279,0.663c1.402,0,2.77-0.694,3.583-1.968c1.248-1.973,0.673-4.604-1.305-5.852    c-9.896-6.302-18.662-41.109-0.135-85.19c7.13-16.953,13.204-32.467,17.875-46.753c1.186,0.605,2.34,1.201,3.453,1.786    c22.96,12.138,41.26,64.612,41.436,65.136c0.767,2.217,3.18,3.392,5.396,2.631C261.934,175.227,263.115,172.814,262.353,170.603z     M153.986,80.063l-8.353,6.902l3.299-10.325c0.973-3.024,2.791-8.383,5.203-14.131c1.885,4.085,4.272,7.819,7.048,11.236    C157.973,76.713,155.27,79.002,153.986,80.063z M167.345,67.781c-3.671-4.722-6.426-10.077-7.954-16.181    c4.106-7.322,9.021-13.241,14.209-13.241c1.435,0,2.817,0.409,4.096,1.222c2.123,1.341,3.319,3.365,3.48,5.851    C181.564,51.579,174.481,60.464,167.345,67.781z M204.333,94.345c-9.823-5.007-20.164-10.651-28.589-17.891    c5.634-7.28,16.669-23.229,15.198-34.932c-0.513-4.096-2.517-7.482-5.789-9.792c-2.714-1.9-5.686-2.874-8.839-2.874    c-6.551,0-12.868,4.339-18.201,9.704c0.083-1.802,0.232-3.646,0.518-5.571c2.2-14.934,9.569-23.855,20.205-24.477    c0.378-0.021,0.771-0.037,1.16-0.037c11.143,0,24.72,9.088,29.013,24.995C213.57,50.414,211.343,70.354,204.333,94.345z" />
                </svg>
            @endif
        </div>
    @endif

    <div class="p-6">
        <div class="flex items-start justify-between mb-2">
            <h3 class="text-xl font-bold text-zinc-900 dark:text-white">{{ $collection->name }}</h3>
            <span class="inline-flex items-center rounded-lg px-2 py-1 text-xs font-semibold bg-{{ $color }}-100 text-{{ $color }}-700 dark:bg-{{ $color }}-900/40 dark:text-{{ $color }}-200">
                {{ ucfirst($collection->craft_type) }}
            </span>
        </div>
        
        @if($collection->description)
            <p class="text-zinc-600 dark:text-zinc-400 text-sm mb-4 line-clamp-2">{{ Str::limit($collection->description, 100) }}</p>
        @endif
        
        <div class="flex items-center justify-between mb-4">
            <span class="inline-flex items-center rounded-lg px-3 py-1.5 text-sm font-bold bg-{{ $color }}-100 text-{{ $color }}-900 dark:bg-{{ $color }}-600 dark:text-white shadow-sm">
                <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                {{ $collection->patterns->count() }} {{ Str::plural('pattern', $collection->patterns->count()) }}
            </span>
        </div>

        <div class="flex gap-3">
            <button 
                class="flex-1 text-center px-4 py-2 rounded-lg bg-{{ $color }}-600 text-white font-semibold hover:bg-{{ $color }}-500 transition-colors">
                View Collection
            </button>
            <button 
                class="px-4 py-2 rounded-lg border border-zinc-300 dark:border-zinc-700 text-zinc-700 dark:text-zinc-300 font-semibold hover:bg-zinc-50 dark:hover:bg-zinc-800 transition-colors">
                Edit
            </button>
        </div>

        <div class="mt-3 text-xs text-zinc-500 dark:text-zinc-400">
            Created {{ $collection->created_at->diffForHumans() }}
        </div>
    </div>
</div>