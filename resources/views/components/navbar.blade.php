@php($navbarId = uniqid('navbar'))

<nav class="sticky top-0 z-50 border-b border-zinc-200/70 bg-white/80 shadow-sm backdrop-blur lg:border-transparent lg:bg-white/70 dark:border-zinc-800/70 dark:bg-zinc-900/80 dark:shadow-[0_1px_0_rgba(255,255,255,0.05)] dark:lg:bg-zinc-900/70">
    <div class="mx-auto flex max-w-full items-center gap-4 px-5 py-4 xl:px-8">
        <a href="/" class="flex items-center gap-3 text-base font-semibold tracking-tight text-zinc-900 transition hover:text-zinc-700 dark:text-zinc-100 dark:hover:text-zinc-300">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-violet-500 via-purple-500 to-indigo-500 text-2xl font-bold text-white shadow-sm shadow-violet-500/30">
                Y
            </span>
            <span class="text-lg">Yarnly</span>
        </a>

        <div class="hidden flex-1 items-center justify-center gap-2 xl:flex">
            <!-- Main Navigation -->
            <div class="flex items-center justify-evenly flex-1 max-w-4xl gap-3 text-sm font-medium text-zinc-500">
                <!-- Home -->
                <a href="#home" class="flex items-center gap-2 px-2 py-2 rounded-lg transition-all duration-200 hover:text-zinc-900 hover:bg-zinc-100/50 dark:text-zinc-400 dark:hover:text-zinc-100 dark:hover:bg-zinc-800/50">
                    <svg class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="font-medium">Home</span>
                </a>

                <!-- Patterns Dropdown -->
                <div class="relative">
                    <button type="button" data-dropdown-toggle="patterns-dropdown" class="flex items-center gap-2 px-2 py-2 rounded-lg transition-all duration-200 hover:text-zinc-900 hover:bg-zinc-100/50 dark:text-zinc-400 dark:hover:text-zinc-100 dark:hover:bg-zinc-800/50 cursor-pointer">
                        <svg class="h-5 w-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        <span class="font-medium">Patterns</span>
                        <svg class="h-4 w-4 transition-transform duration-300 ease-out dropdown-arrow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="patterns-dropdown" class="hidden absolute left-0 top-full mt-3 w-56 origin-top-left">
                        <div class="rounded-xl bg-white/95 backdrop-blur-xl shadow-xl ring-1 ring-black/5 border border-white/20 dark:bg-zinc-900/95 dark:ring-white/10 dark:border-zinc-700/50">
                            <div class="p-2">
                                <a href="#crochet" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 hover:text-emerald-700 dark:text-zinc-200 dark:hover:from-emerald-900/20 dark:hover:to-teal-900/20 dark:hover:text-emerald-300">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600 group-hover:bg-emerald-200 dark:bg-emerald-900/30 dark:text-emerald-400 dark:group-hover:bg-emerald-800/40">
                                        <svg class="h-4 w-4 transform rotate-45" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2c-1.2 0-2.2.8-2.2 1.8v8.4c-.2.1-.4.3-.4.6l-.3 8.4c0 .2.1.3.2.4.1.1.3.2.4.2h1.8c.2 0 .3-.1.4-.2.1-.1.2-.2.2-.4l-.3-8.4c0-.2-.1-.4-.3-.5V4.6c0-.1 0-.1 0-.1 0 0 .1 0 .1 0 .1 0 .2.1.2.2v.6c0 .3.3.6.6.6.7 0 1.2-.5 1.2-1.2v-.3C13.2 2.8 12.4 2 12 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold">Crochet</div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">Blankets, amigurumi & more</div>
                                    </div>
                                </a>
                                <a href="#knitting" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-violet-50 hover:to-purple-50 hover:text-violet-700 dark:text-zinc-200 dark:hover:from-violet-900/20 dark:hover:to-purple-900/20 dark:hover:text-violet-300">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-violet-100 text-violet-600 group-hover:bg-violet-200 dark:bg-violet-900/30 dark:text-violet-400 dark:group-hover:bg-violet-800/40">
                                        <svg class="h-6 w-10 transform" fill="currentColor" viewBox="0 0 512 768">
                                            <path d="M506.267,495.415l-224.299-78.02l121.182-42.146c10.795,15.573,28.774,25.822,49.118,25.822     c32.93,0,59.733-26.803,59.733-59.733c0-32.93-26.803-59.733-59.733-59.733c-32.93,0-59.733,26.803-59.733,59.733     c0,6.46,1.067,12.672,2.97,18.5l-139.503,48.529l-139.503-48.529c1.903-5.828,2.97-12.041,2.97-18.5     c0-32.93-26.803-59.733-59.733-59.733S0.002,308.407,0.002,341.337c0,32.93,26.803,59.733,59.733,59.733     c20.343,0,38.323-10.24,49.118-25.822l121.182,42.146L5.736,495.415c-4.463,1.545-6.81,6.409-5.257,10.854     c1.22,3.524,4.523,5.734,8.055,5.734c0.93,0,1.877-0.154,2.799-0.478l244.668-85.103l244.668,85.103     c0.922,0.324,1.869,0.478,2.799,0.478c3.533,0,6.835-2.21,8.055-5.734C513.077,501.823,510.73,496.959,506.267,495.415z      M460.802,315.737c4.719,0,8.533,3.814,8.533,8.533c0,4.719-3.814,8.533-8.533,8.533c-9.412,0-17.067,7.654-17.067,17.067     c0,4.719-3.814,8.533-8.533,8.533s-8.533-3.814-8.533-8.533C426.668,331.046,441.977,315.737,460.802,315.737z M68.268,332.803     c-9.412,0-17.067,7.654-17.067,17.067c0,4.719-3.814,8.533-8.533,8.533s-8.533-3.814-8.533-8.533     c0-18.825,15.309-34.133,34.133-34.133c4.719,0,8.533,3.814,8.533,8.533C76.802,328.989,72.987,332.803,68.268,332.803z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold">Knitting</div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">Sweaters, scarves & more</div>
                                    </div>
                                </a>
                                <a href="#embroidery" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-rose-50 hover:to-pink-50 hover:text-rose-700 dark:text-zinc-200 dark:hover:from-rose-900/20 dark:hover:to-pink-900/20 dark:hover:text-rose-300">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-rose-100 text-rose-600 group-hover:bg-rose-200 dark:bg-rose-900/30 dark:text-rose-400 dark:group-hover:bg-rose-800/40">
                                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 274 274">
                                            <path d="M262.353,170.603c-0.792-2.288-19.578-56.177-45.5-69.878c-1.554-0.818-3.18-1.652-4.847-2.501    c7.783-26.139,10.299-47.996,5.188-66.953c-4.981-18.491-22.059-32.213-38.856-31.219c-14.794,0.865-25.295,12.718-28.097,31.701    c-0.88,5.965-0.834,11.387-0.171,16.43c-3.469,4.836-5.841,9.036-6.543,10.325L13.143,266.149    c-0.997,1.579-2.231,3.547-0.955,5.872l1.229,2.206h2.509c2.201,0,3.379-1.476,4.513-2.895L170.42,83.093    c9.569,8.114,21.034,14.245,31.375,19.49c-4.635,14.333-10.776,30.049-18.046,47.328c-19.957,47.483-10.657,86.687,3.401,95.64    c0.705,0.451,1.492,0.663,2.279,0.663c1.402,0,2.77-0.694,3.583-1.968c1.248-1.973,0.673-4.604-1.305-5.852    c-9.896-6.302-18.662-41.109-0.135-85.19c7.13-16.953,13.204-32.467,17.875-46.753c1.186,0.605,2.34,1.201,3.453,1.786    c22.96,12.138,41.26,64.612,41.436,65.136c0.767,2.217,3.18,3.392,5.396,2.631C261.934,175.227,263.115,172.814,262.353,170.603z     M153.986,80.063l-8.353,6.902l3.299-10.325c0.973-3.024,2.791-8.383,5.203-14.131c1.885,4.085,4.272,7.819,7.048,11.236    C157.973,76.713,155.27,79.002,153.986,80.063z M167.345,67.781c-3.671-4.722-6.426-10.077-7.954-16.181    c4.106-7.322,9.021-13.241,14.209-13.241c1.435,0,2.817,0.409,4.096,1.222c2.123,1.341,3.319,3.365,3.48,5.851    C181.564,51.579,174.481,60.464,167.345,67.781z M204.333,94.345c-9.823-5.007-20.164-10.651-28.589-17.891    c5.634-7.28,16.669-23.229,15.198-34.932c-0.513-4.096-2.517-7.482-5.789-9.792c-2.714-1.9-5.686-2.874-8.839-2.874    c-6.551,0-12.868,4.339-18.201,9.704c0.083-1.802,0.232-3.646,0.518-5.571c2.2-14.934,9.569-23.855,20.205-24.477    c0.378-0.021,0.771-0.037,1.16-0.037c11.143,0,24.72,9.088,29.013,24.995C213.57,50.414,211.343,70.354,204.333,94.345z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold">Embroidery</div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">Cross stitch, needlepoint</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Models Dropdown -->
                <div class="relative">
                    <button type="button" data-dropdown-toggle="models-dropdown" class="flex items-center gap-2 px-2 py-2 rounded-lg transition-all duration-200 hover:text-zinc-900 hover:bg-zinc-100/50 dark:text-zinc-400 dark:hover:text-zinc-100 dark:hover:bg-zinc-800/50 cursor-pointer">
                        <svg class="h-5 w-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <span class="font-medium">Models</span>
                        <svg class="h-4 w-4 transition-transform duration-300 ease-out dropdown-arrow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="models-dropdown" class="hidden absolute left-0 top-full mt-3 w-60 origin-top-left">
                        <div class="rounded-xl bg-white/95 backdrop-blur-xl shadow-xl ring-1 ring-black/5 border border-white/20 dark:bg-zinc-900/95 dark:ring-white/10 dark:border-zinc-700/50">
                            <div class="p-2">
                                <a href="#gallery" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:text-blue-700 dark:text-zinc-200 dark:hover:from-blue-900/20 dark:hover:to-indigo-900/20 dark:hover:text-blue-300">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-600 group-hover:bg-blue-200 dark:bg-blue-900/30 dark:text-blue-400 dark:group-hover:bg-blue-800/40">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold">Gallery</div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">Browse all models</div>
                                    </div>
                                </a>
                                <a href="#top-rated" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-yellow-50 hover:to-amber-50 hover:text-yellow-700 dark:text-zinc-200 dark:hover:from-yellow-900/20 dark:hover:to-amber-900/20 dark:hover:text-yellow-300">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-yellow-100 text-yellow-600 group-hover:bg-yellow-200 dark:bg-yellow-900/30 dark:text-yellow-400 dark:group-hover:bg-yellow-800/40">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold">Top Rated</div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">Community favorites</div>
                                    </div>
                                </a>
                                <a href="#recently-added" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-green-50 hover:to-emerald-50 hover:text-green-700 dark:text-zinc-200 dark:hover:from-green-900/20 dark:hover:to-emerald-900/20 dark:hover:text-green-300">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-green-100 text-green-600 group-hover:bg-green-200 dark:bg-green-900/30 dark:text-green-400 dark:group-hover:bg-green-800/40">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold">Recently Added</div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">Latest uploads</div>
                                    </div>
                                </a>
                                <a href="#create-model" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-purple-50 hover:to-violet-50 hover:text-purple-700 dark:text-zinc-200 dark:hover:from-purple-900/20 dark:hover:to-violet-900/20 dark:hover:text-purple-300">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-purple-100 text-purple-600 group-hover:bg-purple-200 dark:bg-purple-900/30 dark:text-purple-400 dark:group-hover:bg-purple-800/40">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold">Create Model</div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">Upload your work</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tutorials Dropdown -->
                <div class="relative">
                    <button type="button" data-dropdown-toggle="tutorials-dropdown" class="flex items-center gap-2 px-2 py-2 rounded-lg transition-all duration-200 hover:text-zinc-900 hover:bg-zinc-100/50 dark:text-zinc-400 dark:hover:text-zinc-100 dark:hover:bg-zinc-800/50 cursor-pointer">
                        <svg class="h-5 w-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="font-medium">Tutorials</span>
                        <svg class="h-4 w-4 transition-transform duration-300 ease-out dropdown-arrow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="tutorials-dropdown" class="hidden absolute left-0 top-full mt-3 w-64 origin-top-left">
                        <div class="rounded-xl bg-white/95 backdrop-blur-xl shadow-xl ring-1 ring-black/5 border border-white/20 dark:bg-zinc-900/95 dark:ring-white/10 dark:border-zinc-700/50">
                            <div class="p-2">
                                <a href="#beginner-course" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-green-50 hover:to-emerald-50 hover:text-green-700 dark:text-zinc-200 dark:hover:from-green-900/20 dark:hover:to-emerald-900/20 dark:hover:text-green-300">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-green-100 text-green-600 group-hover:bg-green-200 dark:bg-green-900/30 dark:text-green-400 dark:group-hover:bg-green-800/40">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5v14l11-7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold">Beginner Course</div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">Start your journey</div>
                                    </div>
                                </a>
                                <a href="#stitches" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-blue-50 hover:to-cyan-50 hover:text-blue-700 dark:text-zinc-200 dark:hover:from-blue-900/20 dark:hover:to-cyan-900/20 dark:hover:text-blue-300">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-600 group-hover:bg-blue-200 dark:bg-blue-900/30 dark:text-blue-400 dark:group-hover:bg-blue-800/40">
                                        <svg class="h-4 w-4 transform rotate-45" fill="currentColor" viewBox="0 0 307 307">
                                            <path d="M96.111,153.428c0-9.445-7.656-17.111-17.106-17.111c-3.824,0-7.316,1.31-10.165,3.425h5.774    c7.542,0,13.68,6.128,13.68,13.681c0,7.542-6.139,13.684-13.68,13.684H68.84c2.848,2.117,6.341,3.428,10.165,3.428    C88.455,170.539,96.111,162.875,96.111,153.428z" />
                                            <path d="M85.04,153.428c0-5.398-4.375-9.779-9.779-9.779H18.245c-5.398,0-9.779,4.375-9.779,9.779    c0,5.409,4.381,9.774,9.779,9.774h57.016C80.665,163.202,85.04,158.836,85.04,153.428z" />
                                            <path d="M27.275,167.116h-7.562c-7.55,0-13.686-6.141-13.686-13.688c0-7.552,6.136-13.681,13.686-13.681h7.562    c-2.848-2.115-6.343-3.425-10.165-3.425C7.661,136.322,0,143.983,0,153.433c0,9.447,7.656,17.11,17.111,17.11    C20.927,170.539,24.422,169.234,27.275,167.116z" />
                                            <path d="M200.704,153.428c0-9.445-7.653-17.111-17.108-17.111c-3.821,0-7.322,1.31-10.17,3.425h5.773    c7.544,0,13.686,6.128,13.686,13.681c0,7.542-6.142,13.684-13.686,13.684h-5.773c2.848,2.117,6.349,3.428,10.17,3.428    C193.04,170.539,200.704,162.875,200.704,153.428z" />
                                            <path d="M189.628,153.428c0-5.398-4.376-9.779-9.776-9.779H122.83c-5.398,0-9.773,4.375-9.773,9.779    c0,5.409,4.375,9.774,9.773,9.774h57.021C185.252,163.202,189.628,158.836,189.628,153.428z" />
                                            <path d="M110.612,153.428c0-7.552,6.141-13.681,13.686-13.681h7.563c-2.848-2.115-6.343-3.425-10.167-3.425    c-9.442,0-17.108,7.661-17.108,17.111c0,9.447,7.661,17.11,17.108,17.11c3.824,0,7.319-1.305,10.167-3.428h-7.563    C116.759,167.116,110.612,160.975,110.612,153.428z" />
                                            <path d="M289.747,136.322c-3.821,0-7.312,1.31-10.16,3.425h5.769c7.54,0,13.691,6.128,13.691,13.681    c0,7.547-6.151,13.688-13.691,13.688h-5.769c2.849,2.113,6.339,3.423,10.16,3.423c9.45,0,17.113-7.658,17.113-17.111    C306.855,143.983,299.197,136.322,289.747,136.322z" />
                                            <path d="M295.774,153.428c0-5.398-4.371-9.779-9.776-9.779h-57.012c-5.396,0-9.771,4.375-9.771,9.779    c0,5.409,4.375,9.774,9.771,9.774h57.021C291.403,163.202,295.774,158.836,295.774,153.428z" />
                                            <path d="M227.853,170.539c3.816,0,7.316-1.305,10.16-3.423h-7.556c-7.55,0-13.69-6.141-13.69-13.688    c0-7.552,6.141-13.681,13.69-13.681h7.556c-2.844-2.115-6.344-3.425-10.16-3.425c-9.45,0-17.113,7.661-17.113,17.111    C210.739,162.875,218.402,170.539,227.853,170.539z" />
                                        </svg>
                                        <svg class="h-4 w-4 absolute" fill="currentColor" viewBox="0 0 307 307" style="transform: rotate(135deg);">
                                            <path d="M96.111,153.428c0-9.445-7.656-17.111-17.106-17.111c-3.824,0-7.316,1.31-10.165,3.425h5.774    c7.542,0,13.68,6.128,13.68,13.681c0,7.542-6.139,13.684-13.68,13.684H68.84c2.848,2.117,6.341,3.428,10.165,3.428    C88.455,170.539,96.111,162.875,96.111,153.428z" />
                                            <path d="M85.04,153.428c0-5.398-4.375-9.779-9.779-9.779H18.245c-5.398,0-9.779,4.375-9.779,9.779    c0,5.409,4.381,9.774,9.779,9.774h57.016C80.665,163.202,85.04,158.836,85.04,153.428z" />
                                            <path d="M27.275,167.116h-7.562c-7.55,0-13.686-6.141-13.686-13.688c0-7.552,6.136-13.681,13.686-13.681h7.562    c-2.848-2.115-6.343-3.425-10.165-3.425C7.661,136.322,0,143.983,0,153.433c0,9.447,7.656,17.11,17.111,17.11    C20.927,170.539,24.422,169.234,27.275,167.116z" />
                                            <path d="M200.704,153.428c0-9.445-7.653-17.111-17.108-17.111c-3.821,0-7.322,1.31-10.17,3.425h5.773    c7.544,0,13.686,6.128,13.686,13.681c0,7.542-6.142,13.684-13.686,13.684h-5.773c2.848,2.117,6.349,3.428,10.17,3.428    C193.04,170.539,200.704,162.875,200.704,153.428z" />
                                            <path d="M189.628,153.428c0-5.398-4.376-9.779-9.776-9.779H122.83c-5.398,0-9.773,4.375-9.773,9.779    c0,5.409,4.375,9.774,9.773,9.774h57.021C185.252,163.202,189.628,158.836,189.628,153.428z" />
                                            <path d="M110.612,153.428c0-7.552,6.141-13.681,13.686-13.681h7.563c-2.848-2.115-6.343-3.425-10.167-3.425    c-9.442,0-17.108,7.661-17.108,17.111c0,9.447,7.661,17.11,17.108,17.11c3.824,0,7.319-1.305,10.167-3.428h-7.563    C116.759,167.116,110.612,160.975,110.612,153.428z" />
                                            <path d="M289.747,136.322c-3.821,0-7.312,1.31-10.16,3.425h5.769c7.54,0,13.691,6.128,13.691,13.681    c0,7.547-6.151,13.688-13.691,13.688h-5.769c2.849,2.113,6.339,3.423,10.16,3.423c9.45,0,17.113-7.658,17.113-17.111    C306.855,143.983,299.197,136.322,289.747,136.322z" />
                                            <path d="M295.774,153.428c0-5.398-4.371-9.779-9.776-9.779h-57.012c-5.396,0-9.771,4.375-9.771,9.779    c0,5.409,4.375,9.774,9.771,9.774h57.021C291.403,163.202,295.774,158.836,295.774,153.428z" />
                                            <path d="M227.853,170.539c3.816,0,7.316-1.305,10.16-3.423h-7.556c-7.55,0-13.69-6.141-13.69-13.688    c0-7.552,6.141-13.681,13.69-13.681h7.556c-2.844-2.115-6.344-3.425-10.16-3.425c-9.45,0-17.113,7.661-17.113,17.111    C210.739,162.875,218.402,170.539,227.853,170.539z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold">Stitches</div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">Learn basic stitches</div>
                                    </div>
                                </a>
                                <a href="#techniques" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-purple-50 hover:to-violet-50 hover:text-purple-700 dark:text-zinc-200 dark:hover:from-purple-900/20 dark:hover:to-violet-900/20 dark:hover:text-purple-300">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-purple-100 text-purple-600 group-hover:bg-purple-200 dark:bg-purple-900/30 dark:text-purple-400 dark:group-hover:bg-purple-800/40">
                                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 512 512">
                                            <path d="M222.837,164.727v-17.752h0.001c0-15.645-12.728-28.373-28.374-28.373c-4.702,0-9.138,1.157-13.047,3.19v-1.994    c0-15.645-12.728-28.373-28.373-28.373c-4.807,0-9.338,1.206-13.309,3.325c-1.868-13.849-13.758-24.563-28.109-24.563    c-8.164,0-15.529,3.471-20.711,9.008c-5.181-5.538-12.546-9.008-20.71-9.008c-15.645,0-28.373,12.728-28.373,28.373v111.764    c-4.007-2.169-8.593-3.403-13.462-3.403C12.728,206.922,0,219.65,0,235.294v91.996c0,0.956,0.179,1.904,0.528,2.793    l41.834,106.855c1.149,2.938,3.981,4.87,7.135,4.87h128.317c24.994,0,45.328-20.334,45.328-45.328V256.836L222.837,164.727z     M207.819,396.48h-0.002c0,16.543-13.459,30.002-30.002,30.002H54.727L15.326,325.843v-90.549c0-7.194,5.853-13.047,13.047-13.047    S41.42,228.1,41.42,235.294v51.409c0,3.653,2.617,6.805,6.198,7.522c1.501,0.3,36.754,7.855,36.754,51.278    c0,4.232,3.43,7.663,7.663,7.663c4.233,0,7.663-3.431,7.663-7.663c0-29.26-13.284-45.754-24.428-54.439    c-6.857-5.344-13.754-8.423-18.523-10.103v-4.559c0.265-0.777,0.415-1.605,0.415-2.472V98.561c0-7.194,5.853-13.047,13.047-13.047    s13.045,5.854,13.045,13.047v63.14v70.582c0,4.232,3.43,7.663,7.663,7.663c4.233,0,7.663-3.431,7.663-7.663v-70.582v-63.14    c0-7.194,5.854-13.047,13.048-13.047s13.047,5.853,13.047,13.047v21.237v17.751v94.785c0,4.232,3.43,7.663,7.663,7.663    c4.233,0,7.663-3.431,7.663-7.663v-94.785v-17.751c0-7.194,5.853-13.047,13.047-13.047s13.047,5.853,13.047,13.047v27.177v17.751    v67.608c0,4.232,3.43,7.663,7.663,7.663c4.233,0,7.663-3.431,7.663-7.663v-67.608v-17.751c0-7.194,5.853-13.047,13.047-13.047    c7.194,0,13.048,5.853,13.048,13.047v17.776l0.305,92.109V396.48z" />
                                            <path d="M483.627,206.922c-4.869,0-9.454,1.234-13.463,3.403V98.561c0-15.645-12.728-28.373-28.373-28.373    c-8.164,0-15.529,3.471-20.71,9.008c-5.181-5.538-12.546-9.008-20.71-9.008c-14.353,0-26.243,10.714-28.111,24.563    c-3.971-2.119-8.502-3.325-13.309-3.325c-15.645,0-28.373,12.728-28.373,28.373v1.995c-3.909-2.033-8.344-3.19-13.047-3.19    c-15.645,0-28.373,12.728-28.373,28.373v17.725l-0.115,35.077c-0.237,1.054-0.25,2.169-0.011,3.282l-0.178,53.801v47.026    c0,0.017,0,0.034,0,0.051v92.542c0,24.994,20.333,45.328,45.327,45.328h128.317c3.154,0,5.985-1.932,7.135-4.87l41.835-106.855    c0.349-0.891,0.528-1.838,0.528-2.794v-91.996C512,219.65,499.272,206.922,483.627,206.922z M358.953,106.751    c7.194,0,13.047,5.853,13.047,13.047v17.751v33.419l-26.093,7.775v-14.016v-17.751v-27.177h-0.001    C345.907,112.604,351.759,106.751,358.953,106.751z M304.488,146.975c0-7.194,5.853-13.047,13.047-13.047    c7.194,0,13.047,5.853,13.047,13.047v17.751v18.583l-26.179,7.8l0.087-26.383v-17.751H304.488z M496.677,325.843h-0.003    l-39.402,100.639H334.184c-16.542,0-30.001-13.459-30.001-30.002v-86.767l61.514-18.328c4.056-1.209,6.365-5.476,5.156-9.532    c-1.209-4.056-5.479-6.366-9.532-5.156l-57.138,17.024v-36.835l0.165-49.77l26.233-7.816v33.034c0,4.232,3.43,7.663,7.663,7.663    c4.233,0,7.663-3.431,7.663-7.663v-37.601l26.093-7.775v45.375c0,4.232,3.43,7.663,7.663,7.663s7.663-3.431,7.663-7.663v-49.942    l12.306-3.667c4.056-1.209,6.365-5.476,5.156-9.532c-1.209-4.056-5.48-6.365-9.532-5.156l-7.93,2.362v-28.851v-17.751V98.561    c0-7.194,5.854-13.047,13.048-13.047s13.047,5.853,13.047,13.047v63.14v70.582c0,4.232,3.43,7.663,7.663,7.663    c4.233,0,7.663-3.431,7.663-7.663v-70.582v-63.14c0-7.194,5.853-13.047,13.047-13.047c7.194,0,13.047,5.853,13.047,13.047V273.93    c0,0.866,0.15,1.695,0.415,2.472v4.559c-4.77,1.681-11.666,4.759-18.523,10.103c-11.144,8.685-24.428,25.179-24.428,54.439    c0,4.232,3.43,7.663,7.663,7.663c4.233,0,7.663-3.431,7.663-7.663c0-43.424,35.253-50.977,36.717-51.271    c3.617-0.686,6.236-3.848,6.236-7.529v-51.409c0-7.194,5.854-13.047,13.048-13.047s13.047,5.853,13.047,13.047V325.843z" />
                                            <path d="M185.826,324.207c-2.275-3.568-7.012-4.615-10.581-2.34l-52.315,33.366c-3.568,2.275-4.616,7.013-2.34,10.581    c1.462,2.292,3.938,3.543,6.468,3.543c1.41,0,2.836-0.389,4.114-1.204l52.315-33.366    C187.055,332.513,188.103,327.775,185.826,324.207z" />
                                            <path d="M185.826,357.574c-2.276-3.568-7.011-4.616-10.581-2.34L122.93,388.6c-3.568,2.275-4.616,7.013-2.34,10.581    c1.462,2.291,3.938,3.543,6.468,3.543c1.41,0,2.836-0.388,4.114-1.204l52.315-33.366    C187.055,365.879,188.103,361.141,185.826,357.574z" />
                                            <path d="M383.779,308.945c-1.209-4.056-5.482-6.365-9.533-5.156l-43.052,12.828c-4.056,1.209-6.365,5.476-5.156,9.532    c0.991,3.326,4.039,5.477,7.341,5.477c0.724,0,1.462-0.104,2.192-0.321l43.052-12.828    C382.68,317.268,384.988,313.002,383.779,308.945z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold">Techniques</div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">Advanced methods</div>
                                    </div>
                                </a>
                                <a href="#video-lessons" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-red-50 hover:to-rose-50 hover:text-red-700 dark:text-zinc-200 dark:hover:from-red-900/20 dark:hover:to-rose-900/20 dark:hover:text-red-300">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-red-100 text-red-600 group-hover:bg-red-200 dark:bg-red-900/30 dark:text-red-400 dark:group-hover:bg-red-800/40">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10" />
                                            <polygon points="10,8 16,12 10,16" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold">Video Lessons</div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">Step-by-step guides</div>
                                    </div>
                                </a>
                                <a href="#progress" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-orange-50 hover:to-amber-50 hover:text-orange-700 dark:text-zinc-200 dark:hover:from-orange-900/20 dark:hover:to-amber-900/20 dark:hover:text-orange-300">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-100 text-orange-600 group-hover:bg-orange-200 dark:bg-orange-900/30 dark:text-orange-400 dark:group-hover:bg-orange-800/40">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold">Progress</div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">Track your learning</div>
                                    </div>
                                </a>
                                <a href="#favorites" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-pink-50 hover:to-rose-50 hover:text-pink-700 dark:text-zinc-200 dark:hover:from-pink-900/20 dark:hover:to-rose-900/20 dark:hover:text-pink-300">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-pink-100 text-pink-600 group-hover:bg-pink-200 dark:bg-pink-900/30 dark:text-pink-400 dark:group-hover:bg-pink-800/40">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold">Favorites</div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">Saved tutorials</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- AI Assistant -->
                <a href="#ai-assistant" class="flex items-center gap-2 px-2 py-2 rounded-lg transition-all duration-200 hover:text-zinc-900 hover:bg-zinc-100/50 dark:text-zinc-400 dark:hover:text-zinc-100 dark:hover:bg-zinc-800/50">
                    <svg class="h-5 w-5 text-yellow-600 dark:text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14 2C14 2.74028 13.5978 3.38663 13 3.73244V4H20C21.6569 4 23 5.34315 23 7V19C23 20.6569 21.6569 22 20 22H4C2.34315 22 1 20.6569 1 19V7C1 5.34315 2.34315 4 4 4H11V3.73244C10.4022 3.38663 10 2.74028 10 2C10 0.895431 10.8954 0 12 0C13.1046 0 14 0.895431 14 2ZM4 6H11H13H20C20.5523 6 21 6.44772 21 7V19C21 19.5523 20.5523 20 20 20H4C3.44772 20 3 19.5523 3 19V7C3 6.44772 3.44772 6 4 6ZM15 11.5C15 10.6716 15.6716 10 16.5 10C17.3284 10 18 10.6716 18 11.5C18 12.3284 17.3284 13 16.5 13C15.6716 13 15 12.3284 15 11.5ZM16.5 8C14.567 8 13 9.567 13 11.5C13 13.433 14.567 15 16.5 15C18.433 15 20 13.433 20 11.5C20 9.567 18.433 8 16.5 8ZM7.5 10C6.67157 10 6 10.6716 6 11.5C6 12.3284 6.67157 13 7.5 13C8.32843 13 9 12.3284 9 11.5C9 10.6716 8.32843 10 7.5 10ZM4 11.5C4 9.567 5.567 8 7.5 8C9.433 8 11 9.567 11 11.5C11 13.433 9.433 15 7.5 15C5.567 15 4 13.433 4 11.5ZM10.8944 16.5528C10.6474 16.0588 10.0468 15.8586 9.55279 16.1056C9.05881 16.3526 8.85858 16.9532 9.10557 17.4472C9.68052 18.5971 10.9822 19 12 19C13.0178 19 14.3195 18.5971 14.8944 17.4472C15.1414 16.9532 14.9412 16.3526 14.4472 16.1056C13.9532 15.8586 13.3526 16.0588 13.1056 16.5528C13.0139 16.7362 12.6488 17 12 17C11.3512 17 10.9861 16.7362 10.8944 16.5528Z" />
                    </svg>
                    <span class="font-medium">AI Assistant</span>
                </a>

                <!-- Community -->
                <a href="#community" class="flex items-center gap-2 px-2 py-2 rounded-lg transition-all duration-200 hover:text-zinc-900 hover:bg-zinc-100/50 dark:text-zinc-400 dark:hover:text-zinc-100 dark:hover:bg-zinc-800/50">
                    <svg class="h-5 w-5 text-pink-600 dark:text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                    </svg>
                    <span class="font-medium">Community</span>
                </a>

                @auth
                <!-- Admin Panel (only for admins) -->
                @if(auth()->user()->isAdmin ?? false)
                <div class="relative">
                    <button type="button" data-dropdown-toggle="admin-dropdown" class="flex items-center gap-2 px-2 py-2 rounded-lg transition-all duration-200 hover:text-zinc-900 hover:bg-zinc-100/50 dark:text-zinc-400 dark:hover:text-zinc-100 dark:hover:bg-zinc-800/50 cursor-pointer">
                        <svg class="h-5 w-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="font-medium">Admin Panel</span>
                        <svg class="h-4 w-4 transition-transform duration-300 ease-out dropdown-arrow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="admin-dropdown" class="hidden absolute right-0 top-full mt-3 w-64 origin-top-right">
                        <div class="rounded-xl bg-white/95 backdrop-blur-xl shadow-xl ring-1 ring-black/5 border border-white/20 dark:bg-zinc-900/95 dark:ring-white/10 dark:border-zinc-700/50">
                            <div class="p-2">
                                <a href="#approve-models" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-green-50 hover:to-emerald-50 hover:text-green-700 dark:text-zinc-200 dark:hover:from-green-900/20 dark:hover:to-emerald-900/20 dark:hover:text-green-300">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-green-100 text-green-600 group-hover:bg-green-200 dark:bg-green-900/30 dark:text-green-400 dark:group-hover:bg-green-800/40">✅</div>
                                    <div>
                                        <div class="font-semibold">Approve Models</div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">Review submissions</div>
                                    </div>
                                </a>
                                <a href="#manage-users" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:text-blue-700 dark:text-zinc-200 dark:hover:from-blue-900/20 dark:hover:to-indigo-900/20 dark:hover:text-blue-300">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-600 group-hover:bg-blue-200 dark:bg-blue-900/30 dark:text-blue-400 dark:group-hover:bg-blue-800/40">👥</div>
                                    <div>
                                        <div class="font-semibold">Manage Users</div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">User administration</div>
                                    </div>
                                </a>
                                <a href="#manage-materials" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-purple-50 hover:to-violet-50 hover:text-purple-700 dark:text-zinc-200 dark:hover:from-purple-900/20 dark:hover:to-violet-900/20 dark:hover:text-purple-300">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-purple-100 text-purple-600 group-hover:bg-purple-200 dark:bg-purple-900/30 dark:text-purple-400 dark:group-hover:bg-purple-800/40">🧵</div>
                                    <div>
                                        <div class="font-semibold">Add/Edit Materials</div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">Manage resources</div>
                                    </div>
                                </a>
                                <a href="#statistics" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-orange-50 hover:to-amber-50 hover:text-orange-700 dark:text-zinc-200 dark:hover:from-orange-900/20 dark:hover:to-amber-900/20 dark:hover:text-orange-300">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-100 text-orange-600 group-hover:bg-orange-200 dark:bg-orange-900/30 dark:text-orange-400 dark:group-hover:bg-orange-800/40">📈</div>
                                    <div>
                                        <div class="font-semibold">Statistics</div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">Platform analytics</div>
                                    </div>
                                </a>
                                <a href="#notifications" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-yellow-50 hover:to-amber-50 hover:text-yellow-700 dark:text-zinc-200 dark:hover:from-yellow-900/20 dark:hover:to-amber-900/20 dark:hover:text-yellow-300">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-yellow-100 text-yellow-600 group-hover:bg-yellow-200 dark:bg-yellow-900/30 dark:text-yellow-400 dark:group-hover:bg-yellow-800/40">🔔</div>
                                    <div>
                                        <div class="font-semibold">Notifications</div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">System alerts</div>
                                    </div>
                                </a>
                                <a href="#reports" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-red-50 hover:to-rose-50 hover:text-red-700 dark:text-zinc-200 dark:hover:from-red-900/20 dark:hover:to-rose-900/20 dark:hover:text-red-300">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-red-100 text-red-600 group-hover:bg-red-200 dark:bg-red-900/30 dark:text-red-400 dark:group-hover:bg-red-800/40">📋</div>
                                    <div>
                                        <div class="font-semibold">Reports</div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">Content moderation</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endauth
            </div>

            <!-- Right side: Search, Theme Toggle, Account -->
            <div class="flex items-center gap-2 ml-auto">
                <!-- Search Section -->
                <div class="relative flex items-center">
                    <!-- Search Icon -->
                    <button type="button" id="search-toggle" class="relative flex h-10 w-10 items-center justify-center rounded-lg text-zinc-600 transition-all duration-300 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-100 cursor-pointer">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                    
                    <!-- Search Box -->
                    <div id="search-box" class="fixed top-[76px] right-1 opacity-0 invisible translate-y-[-10px] transition-all duration-400 ease-out pointer-events-none z-50">
                        <div class="bg-white/95 dark:bg-zinc-900/95 backdrop-blur-xl border border-zinc-200/50 dark:border-zinc-700/50 rounded-2xl shadow-2xl shadow-black/10 dark:shadow-black/30 w-[400px] p-2">
                            <div class="flex items-center gap-2">
                                <div class="flex-1 relative">
                                    <input type="text" id="search-input" placeholder="Search patterns, tutorials..." class="w-full pl-10 pr-4 py-3 text-sm bg-zinc-50/80 dark:bg-zinc-800/80 border-0 rounded-xl focus:outline-none focus:ring-2 focus:ring-violet-400/50 focus:bg-white dark:focus:bg-zinc-800 text-zinc-900 dark:text-zinc-100 placeholder-zinc-500 dark:placeholder-zinc-400 transition-all duration-200" autocomplete="off">
                                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-zinc-400 pointer-events-none">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <button type="button" id="search-submit" class="flex items-center justify-center h-10 w-10 bg-gradient-to-r from-violet-500 to-purple-600 hover:from-violet-600 hover:to-purple-700 text-white rounded-xl transition-all duration-200 hover:shadow-lg hover:shadow-violet-500/25 hover:scale-105 active:scale-95">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style=" transform: rotate(90deg); ">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Theme Toggle -->
                <button type="button" id="theme-toggle" class="relative flex h-10 w-10 items-center justify-center rounded-lg text-zinc-600 transition-all duration-300 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-100 cursor-pointer">
                    <!-- Sun Icon (visible in dark mode) -->
                    <svg id="sun-icon" class="h-5 w-5 text-amber-500 transition-all duration-300 transform scale-0 rotate-90 opacity-0 dark:scale-100 dark:rotate-0 dark:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <!-- Moon Icon (visible in light mode) -->
                    <svg id="moon-icon" class="absolute h-5 w-5 text-indigo-600 transition-all duration-300 transform scale-100 rotate-0 opacity-100 dark:scale-0 dark:-rotate-90 dark:opacity-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>

                @guest
                @if (Route::has('login'))
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-md border border-zinc-200 px-4 py-2 text-sm font-medium text-zinc-700 transition-all duration-200 hover:border-violet-300 hover:bg-violet-50 hover:text-violet-700 hover:shadow-md hover:scale-105 dark:border-zinc-700 dark:text-zinc-200 dark:hover:border-violet-500 dark:hover:bg-violet-900/20 dark:hover:text-violet-300">Log in</a>
                @endif
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-md bg-gradient-to-r from-violet-500 via-purple-500 to-indigo-500 px-4 py-2 text-sm font-semibold text-white shadow-sm shadow-violet-500/40 transition-all duration-200 hover:shadow-lg hover:shadow-violet-500/60 hover:scale-105 hover:brightness-110 hover:-translate-y-0.5">Sign up</a>
                @endif
                @else
                <!-- Account Dropdown -->
                <div class="relative">
                    <button type="button" data-dropdown-toggle="account-dropdown" class="flex items-center gap-2 px-2 py-2 rounded-lg transition-all duration-200 hover:text-zinc-900 hover:bg-zinc-100/50 dark:text-zinc-400 dark:hover:text-zinc-100 dark:hover:bg-zinc-800/50 cursor-pointer">
                        <svg class="h-5 w-5 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="font-medium">{{ Auth::user()->name ?? 'Account' }}</span>
                        <svg class="h-4 w-4 transition-transform duration-300 ease-out dropdown-arrow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="account-dropdown" class="hidden absolute right-0 top-full mt-3 w-64 origin-top-right">
                        <div class="rounded-xl bg-white/95 backdrop-blur-xl shadow-xl ring-1 ring-black/5 border border-white/20 dark:bg-zinc-900/95 dark:ring-white/10 dark:border-zinc-700/50">
                            <div class="p-2">
                                <a href="#my-profile" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:text-blue-700 dark:text-zinc-200 dark:hover:from-blue-900/20 dark:hover:to-indigo-900/20 dark:hover:text-blue-300">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-600 group-hover:bg-blue-200 dark:bg-blue-900/30 dark:text-blue-400 dark:group-hover:bg-blue-800/40">👤</div>
                                    <div>
                                        <div class="font-semibold">My Profile</div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">View and edit profile</div>
                                    </div>
                                </a>
                                <a href="#uploads" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-green-50 hover:to-emerald-50 hover:text-green-700 dark:text-zinc-200 dark:hover:from-green-900/20 dark:hover:to-emerald-900/20 dark:hover:text-green-300">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-green-100 text-green-600 group-hover:bg-green-200 dark:bg-green-900/30 dark:text-green-400 dark:group-hover:bg-green-800/40">📤</div>
                                    <div>
                                        <div class="font-semibold">Uploads</div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">Your contributions</div>
                                    </div>
                                </a>
                                <a href="#my-patterns" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-purple-50 hover:to-violet-50 hover:text-purple-700 dark:text-zinc-200 dark:hover:from-purple-900/20 dark:hover:to-violet-900/20 dark:hover:text-purple-300">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-purple-100 text-purple-600 group-hover:bg-purple-200 dark:bg-purple-900/30 dark:text-purple-400 dark:group-hover:bg-purple-800/40">🧶</div>
                                    <div>
                                        <div class="font-semibold">My Patterns</div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">Created patterns</div>
                                    </div>
                                </a>
                                <a href="#favorites" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-pink-50 hover:to-rose-50 hover:text-pink-700 dark:text-zinc-200 dark:hover:from-pink-900/20 dark:hover:to-rose-900/20 dark:hover:text-pink-300">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-pink-100 text-pink-600 group-hover:bg-pink-200 dark:bg-pink-900/30 dark:text-pink-400 dark:group-hover:bg-pink-800/40">💖</div>
                                    <div>
                                        <div class="font-semibold">Favorites</div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">Liked content</div>
                                    </div>
                                </a>
                                <a href="#courses" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-orange-50 hover:to-amber-50 hover:text-orange-700 dark:text-zinc-200 dark:hover:from-orange-900/20 dark:hover:to-amber-900/20 dark:hover:text-orange-300">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-100 text-orange-600 group-hover:bg-orange-200 dark:bg-orange-900/30 dark:text-orange-400 dark:group-hover:bg-orange-800/40">📚</div>
                                    <div>
                                        <div class="font-semibold">Courses</div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">Learning progress</div>
                                    </div>
                                </a>
                                <a href="#settings" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-gray-50 hover:to-zinc-50 hover:text-gray-700 dark:text-zinc-200 dark:hover:from-gray-900/20 dark:hover:to-zinc-900/20 dark:hover:text-gray-300">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-600 group-hover:bg-gray-200 dark:bg-gray-900/30 dark:text-gray-400 dark:group-hover:bg-gray-800/40">⚙️</div>
                                    <div>
                                        <div class="font-semibold">Settings</div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">Account preferences</div>
                                    </div>
                                </a>
                                <div class="border-t border-zinc-200 dark:border-zinc-700 my-2"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="group flex w-full items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-red-50 hover:to-rose-50 hover:text-red-700 dark:text-zinc-200 dark:hover:from-red-900/20 dark:hover:to-rose-900/20 dark:hover:text-red-300">
                                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-red-100 text-red-600 group-hover:bg-red-200 dark:bg-red-900/30 dark:text-red-400 dark:group-hover:bg-red-800/40">🚪</div>
                                        <div>
                                            <div class="font-semibold">Logout</div>
                                            <div class="text-xs text-zinc-500 dark:text-zinc-400">Sign out of account</div>
                                        </div>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endguest
            </div>
        </div>

        <!-- Mobile actions: Search, Theme, Menu -->
        <div class="flex items-center gap-2 ml-auto xl:hidden">
            <!-- Search Section (Mobile) -->
            <div class="relative flex items-center">
                <!-- Search Icon (Mobile) -->
                <button type="button" id="search-toggle-mobile" class="relative flex h-10 w-10 items-center justify-center rounded-lg text-zinc-600 transition-all duration-300 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-100 cursor-pointer">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
                
                <!-- Search Box (Mobile) -->
                <div id="search-box-mobile" class="absolute right-0 top-16 opacity-0 invisible translate-y-[-10px] transition-all duration-400 ease-out pointer-events-none z-50">
                    <div class="bg-white/95 dark:bg-zinc-900/95 backdrop-blur-xl border border-zinc-200/50 dark:border-zinc-700/50 rounded-2xl shadow-2xl shadow-black/10 dark:shadow-black/30 w-[320px] p-2">
                        <div class="flex items-center gap-2">
                            <div class="flex-1 relative">
                                <input type="text" id="search-input-mobile" placeholder="Search patterns, tutorials..." class="w-full pl-10 pr-4 py-3 text-sm bg-zinc-50/80 dark:bg-zinc-800/80 border-0 rounded-xl focus:outline-none focus:ring-2 focus:ring-violet-400/50 focus:bg-white dark:focus:bg-zinc-800 text-zinc-900 dark:text-zinc-100 placeholder-zinc-500 dark:placeholder-zinc-400 transition-all duration-200" autocomplete="off">
                                <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-zinc-400 pointer-events-none">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                            <button type="button" id="search-submit-mobile" class="flex items-center justify-center h-10 w-10 bg-gradient-to-r from-violet-500 to-purple-600 hover:from-violet-600 hover:to-purple-700 text-white rounded-xl transition-all duration-200 hover:shadow-lg hover:shadow-violet-500/25 hover:scale-105 active:scale-95">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style=" transform: rotate(90deg); ">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Theme Toggle (Mobile) -->
            <button type="button" id="theme-toggle-mobile" class="relative flex h-10 w-10 items-center justify-center rounded-lg text-zinc-600 transition-all duration-300 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-100 cursor-pointer">
                <!-- Sun Icon (visible in dark mode) -->
                <svg class="sun-icon h-5 w-5 text-amber-500 transition-all duration-300 transform scale-0 rotate-90 opacity-0 dark:scale-100 dark:rotate-0 dark:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <!-- Moon Icon (visible in light mode) -->
                <svg class="moon-icon absolute h-5 w-5 text-indigo-600 transition-all duration-300 transform scale-100 rotate-0 opacity-100 dark:scale-0 dark:-rotate-90 dark:opacity-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
            </button>

            <!-- Mobile menu button -->
            <button type="button" data-navbar-toggle data-target="{{ $navbarId }}" class="inline-flex items-center justify-center rounded-md border border-zinc-200 p-2 text-zinc-600 transition hover:bg-zinc-100 focus:outline-none focus:ring-2 focus:ring-violet-400 focus:ring-offset-2 focus:ring-offset-white dark:border-zinc-700 dark:text-zinc-300 dark:hover:bg-zinc-800 dark:focus:ring-violet-500 dark:focus:ring-offset-zinc-900 cursor-pointer" aria-expanded="false" aria-controls="{{ $navbarId }}">
                <span class="sr-only">Toggle navigation</span>
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile menu -->
    <div id="{{ $navbarId }}" class="hidden fixed top-16 right-0 w-80 max-w-sm h-screen bg-white/95 backdrop-blur-xl shadow-2xl border-l border-zinc-200/70 dark:bg-zinc-900/95 dark:border-zinc-700/70 transform translate-x-full transition-transform duration-300 ease-out z-50 overflow-y-auto lg:hidden" style="display: none;">
        <div class="flex flex-col gap-4 p-5">
            <div class="grid gap-2 text-sm font-medium text-zinc-600 dark:text-zinc-300">
                <!-- Home -->
                <a href="#home" class="flex items-center gap-3 rounded-lg px-4 py-3 transition-all duration-200 hover:bg-zinc-100/80 hover:text-zinc-900 dark:hover:bg-zinc-800/80 dark:hover:text-zinc-100">
                    <svg class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="font-medium">Home</span>
                </a>

                <!-- Patterns Mobile Dropdown -->
                <div class="relative">
                    <button type="button" data-mobile-dropdown-toggle="mobile-patterns-dropdown" class="flex w-full items-center justify-between gap-3 rounded-lg px-4 py-3 transition-all duration-200 hover:bg-zinc-100/80 hover:text-zinc-900 dark:hover:bg-zinc-800/80 dark:hover:text-zinc-100 cursor-pointer">
                        <div class="flex items-center gap-3">
                            <svg class="h-5 w-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                            <span class="font-medium">Patterns</span>
                        </div>
                        <svg class="h-4 w-4 transition-transform duration-300 ease-out mobile-dropdown-arrow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="mobile-patterns-dropdown" class="hidden mt-3 bg-white/95 backdrop-blur-xl rounded-xl shadow-lg ring-1 ring-black/5 border border-white/20 dark:bg-zinc-900/95 dark:ring-white/10 dark:border-zinc-700/50">
                        <div class="p-2">
                            <a href="#crochet" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 hover:text-emerald-700 dark:text-zinc-200 dark:hover:from-emerald-900/20 dark:hover:to-teal-900/20 dark:hover:text-emerald-300">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600 group-hover:bg-emerald-200 dark:bg-emerald-900/30 dark:text-emerald-400 dark:group-hover:bg-emerald-800/40">
                                    <svg class="h-4 w-4 transform rotate-45" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2c-1.2 0-2.2.8-2.2 1.8v8.4c-.2.1-.4.3-.4.6l-.3 8.4c0 .2.1.3.2.4.1.1.3.2.4.2h1.8c.2 0 .3-.1.4-.2.1-.1.2-.2.2-.4l-.3-8.4c0-.2-.1-.4-.3-.5V4.6c0-.1 0-.1 0-.1 0 0 .1 0 .1 0 .1 0 .2.1.2.2v.6c0 .3.3.6.6.6.7 0 1.2-.5 1.2-1.2v-.3C13.2 2.8 12.4 2 12 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Crochet</div>
                                    <div class="text-xs text-zinc-500 dark:text-zinc-400">Blankets, amigurumi & more</div>
                                </div>
                            </a>
                            <a href="#knitting" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-violet-50 hover:to-purple-50 hover:text-violet-700 dark:text-zinc-200 dark:hover:from-violet-900/20 dark:hover:to-purple-900/20 dark:hover:text-violet-300">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-violet-100 text-violet-600 group-hover:bg-violet-200 dark:bg-violet-900/30 dark:text-violet-400 dark:group-hover:bg-violet-800/40">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 512 512">
                                        <path d="M506.267,495.415l-224.299-78.02l121.182-42.146c10.795,15.573,28.774,25.822,49.118,25.822     c32.93,0,59.733-26.803,59.733-59.733c0-32.93-26.803-59.733-59.733-59.733c-32.93,0-59.733,26.803-59.733,59.733     c0,6.46,1.067,12.672,2.97,18.5l-139.503,48.529l-139.503-48.529c1.903-5.828,2.97-12.041,2.97-18.5     c0-32.93-26.803-59.733-59.733-59.733S0.002,308.407,0.002,341.337c0,32.93,26.803,59.733,59.733,59.733     c20.343,0,38.323-10.24,49.118-25.822l121.182,42.146L5.736,495.415c-4.463,1.545-6.81,6.409-5.257,10.854     c1.22,3.524,4.523,5.734,8.055,5.734c0.93,0,1.877-0.154,2.799-0.478l244.668-85.103l244.668,85.103     c0.922,0.324,1.869,0.478,2.799,0.478c3.533,0,6.835-2.21,8.055-5.734C513.077,501.823,510.73,496.959,506.267,495.415z      M460.802,315.737c4.719,0,8.533,3.814,8.533,8.533c0,4.719-3.814,8.533-8.533,8.533c-9.412,0-17.067,7.654-17.067,17.067     c0,4.719-3.814,8.533-8.533,8.533s-8.533-3.814-8.533-8.533C426.668,331.046,441.977,315.737,460.802,315.737z M68.268,332.803     c-9.412,0-17.067,7.654-17.067,17.067c0,4.719-3.814,8.533-8.533,8.533s-8.533-3.814-8.533-8.533     c0-18.825,15.309-34.133,34.133-34.133c4.719,0,8.533,3.814,8.533,8.533C76.802,328.989,72.987,332.803,68.268,332.803z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Knitting</div>
                                    <div class="text-xs text-zinc-500 dark:text-zinc-400">Sweaters, scarves & more</div>
                                </div>
                            </a>
                            <a href="#embroidery" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-rose-50 hover:to-pink-50 hover:text-rose-700 dark:text-zinc-200 dark:hover:from-rose-900/20 dark:hover:to-pink-900/20 dark:hover:text-rose-300">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-rose-100 text-rose-600 group-hover:bg-rose-200 dark:bg-rose-900/30 dark:text-rose-400 dark:group-hover:bg-rose-800/40">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 274 274" style="transform: scale(0.7);">
                                        <path d="M262.353,170.603c-0.792-2.288-19.578-56.177-45.5-69.878c-1.554-0.818-3.18-1.652-4.847-2.501    c7.783-26.139,10.299-47.996,5.188-66.953c-4.981-18.491-22.059-32.213-38.856-31.219c-14.794,0.865-25.295,12.718-28.097,31.701    c-0.88,5.965-0.834,11.387-0.171,16.43c-3.469,4.836-5.841,9.036-6.543,10.325L13.143,266.149    c-0.997,1.579-2.231,3.547-0.955,5.872l1.229,2.206h2.509c2.201,0,3.379-1.476,4.513-2.895L170.42,83.093    c9.569,8.114,21.034,14.245,31.375,19.49c-4.635,14.333-10.776,30.049-18.046,47.328c-19.957,47.483-10.657,86.687,3.401,95.64    c0.705,0.451,1.492,0.663,2.279,0.663c1.402,0,2.77-0.694,3.583-1.968c1.248-1.973,0.673-4.604-1.305-5.852    c-9.896-6.302-18.662-41.109-0.135-85.19c7.13-16.953,13.204-32.467,17.875-46.753c1.186,0.605,2.34,1.201,3.453,1.786    c22.96,12.138,41.26,64.612,41.436,65.136c0.767,2.217,3.18,3.392,5.396,2.631C261.934,175.227,263.115,172.814,262.353,170.603z     M153.986,80.063l-8.353,6.902l3.299-10.325c0.973-3.024,2.791-8.383,5.203-14.131c1.885,4.085,4.272,7.819,7.048,11.236    C157.973,76.713,155.27,79.002,153.986,80.063z M167.345,67.781c-3.671-4.722-6.426-10.077-7.954-16.181    c4.106-7.322,9.021-13.241,14.209-13.241c1.435,0,2.817,0.409,4.096,1.222c2.123,1.341,3.319,3.365,3.48,5.851    C181.564,51.579,174.481,60.464,167.345,67.781z M204.333,94.345c-9.823-5.007-20.164-10.651-28.589-17.891    c5.634-7.28,16.669-23.229,15.198-34.932c-0.513-4.096-2.517-7.482-5.789-9.792c-2.714-1.9-5.686-2.874-8.839-2.874    c-6.551,0-12.868,4.339-18.201,9.704c0.083-1.802,0.232-3.646,0.518-5.571c2.2-14.934,9.569-23.855,20.205-24.477    c0.378-0.021,0.771-0.037,1.16-0.037c11.143,0,24.72,9.088,29.013,24.995C213.57,50.414,211.343,70.354,204.333,94.345z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Embroidery</div>
                                    <div class="text-xs text-zinc-500 dark:text-zinc-400">Cross stitch, needlepoint</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Models Mobile Dropdown -->
                <div class="relative">
                    <button type="button" data-mobile-dropdown-toggle="mobile-models-dropdown" class="flex w-full items-center justify-between gap-3 rounded-lg px-4 py-3 transition-all duration-200 hover:bg-zinc-100/80 hover:text-zinc-900 dark:hover:bg-zinc-800/80 dark:hover:text-zinc-100 cursor-pointer">
                        <div class="flex items-center gap-3">
                            <svg class="h-5 w-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            <span class="font-medium">Models</span>
                        </div>
                        <svg class="h-4 w-4 transition-transform duration-300 ease-out mobile-dropdown-arrow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="mobile-models-dropdown" class="hidden mt-3 bg-white/95 backdrop-blur-xl rounded-xl shadow-lg ring-1 ring-black/5 border border-white/20 dark:bg-zinc-900/95 dark:ring-white/10 dark:border-zinc-700/50">
                        <div class="p-2">
                            <a href="#gallery" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:text-blue-700 dark:text-zinc-200 dark:hover:from-blue-900/20 dark:hover:to-indigo-900/20 dark:hover:text-blue-300">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-600 group-hover:bg-blue-200 dark:bg-blue-900/30 dark:text-blue-400 dark:group-hover:bg-blue-800/40">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Gallery</div>
                                    <div class="text-xs text-zinc-500 dark:text-zinc-400">Browse all models</div>
                                </div>
                            </a>
                            <a href="#top-rated" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-yellow-50 hover:to-amber-50 hover:text-yellow-700 dark:text-zinc-200 dark:hover:from-yellow-900/20 dark:hover:to-amber-900/20 dark:hover:text-yellow-300">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-yellow-100 text-yellow-600 group-hover:bg-yellow-200 dark:bg-yellow-900/30 dark:text-yellow-400 dark:group-hover:bg-yellow-800/40">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Top Rated</div>
                                    <div class="text-xs text-zinc-500 dark:text-zinc-400">Community favorites</div>
                                </div>
                            </a>
                            <a href="#recently-added" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-green-50 hover:to-emerald-50 hover:text-green-700 dark:text-zinc-200 dark:hover:from-green-900/20 dark:hover:to-emerald-900/20 dark:hover:text-green-300">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-green-100 text-green-600 group-hover:bg-green-200 dark:bg-green-900/30 dark:text-green-400 dark:group-hover:bg-green-800/40">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Recently Added</div>
                                    <div class="text-xs text-zinc-500 dark:text-zinc-400">Latest uploads</div>
                                </div>
                            </a>
                            <a href="#create-model" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-purple-50 hover:to-violet-50 hover:text-purple-700 dark:text-zinc-200 dark:hover:from-purple-900/20 dark:hover:to-violet-900/20 dark:hover:text-purple-300">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-purple-100 text-purple-600 group-hover:bg-purple-200 dark:bg-purple-900/30 dark:text-purple-400 dark:group-hover:bg-purple-800/40">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Create Model</div>
                                    <div class="text-xs text-zinc-500 dark:text-zinc-400">Upload your work</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tutorials Mobile Dropdown -->
                <div class="relative">
                    <button type="button" data-mobile-dropdown-toggle="mobile-tutorials-dropdown" class="flex w-full items-center justify-between gap-3 rounded-lg px-4 py-3 transition-all duration-200 hover:bg-zinc-100/80 hover:text-zinc-900 dark:hover:bg-zinc-800/80 dark:hover:text-zinc-100 cursor-pointer">
                        <div class="flex items-center gap-3">
                            <svg class="h-5 w-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="font-medium">Tutorials</span>
                        </div>
                        <svg class="h-4 w-4 transition-transform duration-300 ease-out mobile-dropdown-arrow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="mobile-tutorials-dropdown" class="hidden mt-3 bg-white/95 backdrop-blur-xl rounded-xl shadow-lg ring-1 ring-black/5 border border-white/20 dark:bg-zinc-900/95 dark:ring-white/10 dark:border-zinc-700/50">
                        <div class="p-2">
                            <a href="#beginner-course" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-green-50 hover:to-emerald-50 hover:text-green-700 dark:text-zinc-200 dark:hover:from-green-900/20 dark:hover:to-emerald-900/20 dark:hover:text-green-300">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-green-100 text-green-600 group-hover:bg-green-200 dark:bg-green-900/30 dark:text-green-400 dark:group-hover:bg-green-800/40">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5v14l11-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Beginner Course</div>
                                    <div class="text-xs text-zinc-500 dark:text-zinc-400">Start your journey</div>
                                </div>
                            </a>
                            <a href="#stitches" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-blue-50 hover:to-cyan-50 hover:text-blue-700 dark:text-zinc-200 dark:hover:from-blue-900/20 dark:hover:to-cyan-900/20 dark:hover:text-blue-300">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-600 group-hover:bg-blue-200 dark:bg-blue-900/30 dark:text-blue-400 dark:group-hover:bg-blue-800/40">
                                    <svg class="h-4 w-4 transform rotate-45" fill="currentColor" viewBox="0 0 307 307" style="transform: scale(0.7) rotate(45deg);">
                                        <path d="M96.111,153.428c0-9.445-7.656-17.111-17.106-17.111c-3.824,0-7.316,1.31-10.165,3.425h5.774    c7.542,0,13.68,6.128,13.68,13.681c0,7.542-6.139,13.684-13.68,13.684H68.84c2.848,2.117,6.341,3.428,10.165,3.428    C88.455,170.539,96.111,162.875,96.111,153.428z" />
                                        <path d="M85.04,153.428c0-5.398-4.375-9.779-9.779-9.779H18.245c-5.398,0-9.779,4.375-9.779,9.779    c0,5.409,4.381,9.774,9.779,9.774h57.016C80.665,163.202,85.04,158.836,85.04,153.428z" />
                                        <path d="M27.275,167.116h-7.562c-7.55,0-13.686-6.141-13.686-13.688c0-7.552,6.136-13.681,13.686-13.681h7.562    c-2.848-2.115-6.343-3.425-10.165-3.425C7.661,136.322,0,143.983,0,153.433c0,9.447,7.656,17.11,17.111,17.11    C20.927,170.539,24.422,169.234,27.275,167.116z" />
                                        <path d="M200.704,153.428c0-9.445-7.653-17.111-17.108-17.111c-3.821,0-7.322,1.31-10.17,3.425h5.773    c7.544,0,13.686,6.128,13.686,13.681c0,7.542-6.142,13.684-13.686,13.684h-5.773c2.848,2.117,6.349,3.428,10.17,3.428    C193.04,170.539,200.704,162.875,200.704,153.428z" />
                                        <path d="M189.628,153.428c0-5.398-4.376-9.779-9.776-9.779H122.83c-5.398,0-9.773,4.375-9.773,9.779    c0,5.409,4.375,9.774,9.773,9.774h57.021C185.252,163.202,189.628,158.836,189.628,153.428z" />
                                        <path d="M110.612,153.428c0-7.552,6.141-13.681,13.686-13.681h7.563c-2.848-2.115-6.343-3.425-10.167-3.425    c-9.442,0-17.108,7.661-17.108,17.111c0,9.447,7.661,17.11,17.108,17.11c3.824,0,7.319-1.305,10.167-3.428h-7.563    C116.759,167.116,110.612,160.975,110.612,153.428z" />
                                        <path d="M289.747,136.322c-3.821,0-7.312,1.31-10.16,3.425h5.769c7.54,0,13.691,6.128,13.691,13.681    c0,7.547-6.151,13.688-13.691,13.688h-5.769c2.849,2.113,6.339,3.423,10.16,3.423c9.45,0,17.113-7.658,17.113-17.111    C306.855,143.983,299.197,136.322,289.747,136.322z" />
                                        <path d="M295.774,153.428c0-5.398-4.371-9.779-9.776-9.779h-57.012c-5.396,0-9.771,4.375-9.771,9.779    c0,5.409,4.375,9.774,9.771,9.774h57.021C291.403,163.202,295.774,158.836,295.774,153.428z" />
                                        <path d="M227.853,170.539c3.816,0,7.316-1.305,10.16-3.423h-7.556c-7.55,0-13.69-6.141-13.69-13.688    c0-7.552,6.141-13.681,13.69-13.681h7.556c-2.844-2.115-6.344-3.425-10.16-3.425c-9.45,0-17.113,7.661-17.113,17.111    C210.739,162.875,218.402,170.539,227.853,170.539z" />
                                    </svg>
                                    <svg class="h-4 w-4 absolute" fill="currentColor" viewBox="0 0 307 307" style="transform: scale(0.7) rotate(315deg);">
                                        <path d="M96.111,153.428c0-9.445-7.656-17.111-17.106-17.111c-3.824,0-7.316,1.31-10.165,3.425h5.774    c7.542,0,13.68,6.128,13.68,13.681c0,7.542-6.139,13.684-13.68,13.684H68.84c2.848,2.117,6.341,3.428,10.165,3.428    C88.455,170.539,96.111,162.875,96.111,153.428z" />
                                        <path d="M85.04,153.428c0-5.398-4.375-9.779-9.779-9.779H18.245c-5.398,0-9.779,4.375-9.779,9.779    c0,5.409,4.381,9.774,9.779,9.774h57.016C80.665,163.202,85.04,158.836,85.04,153.428z" />
                                        <path d="M27.275,167.116h-7.562c-7.55,0-13.686-6.141-13.686-13.688c0-7.552,6.136-13.681,13.686-13.681h7.562    c-2.848-2.115-6.343-3.425-10.165-3.425C7.661,136.322,0,143.983,0,153.433c0,9.447,7.656,17.11,17.111,17.11    C20.927,170.539,24.422,169.234,27.275,167.116z" />
                                        <path d="M200.704,153.428c0-9.445-7.653-17.111-17.108-17.111c-3.821,0-7.322,1.31-10.17,3.425h5.773    c7.544,0,13.686,6.128,13.686,13.681c0,7.542-6.142,13.684-13.686,13.684h-5.773c2.848,2.117,6.349,3.428,10.17,3.428    C193.04,170.539,200.704,162.875,200.704,153.428z" />
                                        <path d="M189.628,153.428c0-5.398-4.376-9.779-9.776-9.779H122.83c-5.398,0-9.773,4.375-9.773,9.779    c0,5.409,4.375,9.774,9.773,9.774h57.021C185.252,163.202,189.628,158.836,189.628,153.428z" />
                                        <path d="M110.612,153.428c0-7.552,6.141-13.681,13.686-13.681h7.563c-2.848-2.115-6.343-3.425-10.167-3.425    c-9.442,0-17.108,7.661-17.108,17.111c0,9.447,7.661,17.11,17.108,17.11c3.824,0,7.319-1.305,10.167-3.428h-7.563    C116.759,167.116,110.612,160.975,110.612,153.428z" />
                                        <path d="M289.747,136.322c-3.821,0-7.312,1.31-10.16,3.425h5.769c7.54,0,13.691,6.128,13.691,13.681    c0,7.547-6.151,13.688-13.691,13.688h-5.769c2.849,2.113,6.339,3.423,10.16,3.423c9.45,0,17.113-7.658,17.113-17.111    C306.855,143.983,299.197,136.322,289.747,136.322z" />
                                        <path d="M295.774,153.428c0-5.398-4.371-9.779-9.776-9.779h-57.012c-5.396,0-9.771,4.375-9.771,9.779    c0,5.409,4.375,9.774,9.771,9.774h57.021C291.403,163.202,295.774,158.836,295.774,153.428z" />
                                        <path d="M227.853,170.539c3.816,0,7.316-1.305,10.16-3.423h-7.556c-7.55,0-13.69-6.141-13.69-13.688    c0-7.552,6.141-13.681,13.69-13.681h7.556c-2.844-2.115-6.344-3.425-10.16-3.425c-9.45,0-17.113,7.661-17.113,17.111    C210.739,162.875,218.402,170.539,227.853,170.539z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Stitches</div>
                                    <div class="text-xs text-zinc-500 dark:text-zinc-400">Learn basic stitches</div>
                                </div>
                            </a>
                            <a href="#techniques" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-purple-50 hover:to-violet-50 hover:text-purple-700 dark:text-zinc-200 dark:hover:from-purple-900/20 dark:hover:to-violet-900/20 dark:hover:text-purple-300">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-purple-100 text-purple-600 group-hover:bg-purple-200 dark:bg-purple-900/30 dark:text-purple-400 dark:group-hover:bg-purple-800/40">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 512 512" style="transform: scale(0.7);">

                                        <path d="M222.837,164.727v-17.752h0.001c0-15.645-12.728-28.373-28.374-28.373c-4.702,0-9.138,1.157-13.047,3.19v-1.994    c0-15.645-12.728-28.373-28.373-28.373c-4.807,0-9.338,1.206-13.309,3.325c-1.868-13.849-13.758-24.563-28.109-24.563    c-8.164,0-15.529,3.471-20.711,9.008c-5.181-5.538-12.546-9.008-20.71-9.008c-15.645,0-28.373,12.728-28.373,28.373v111.764    c-4.007-2.169-8.593-3.403-13.462-3.403C12.728,206.922,0,219.65,0,235.294v91.996c0,0.956,0.179,1.904,0.528,2.793    l41.834,106.855c1.149,2.938,3.981,4.87,7.135,4.87h128.317c24.994,0,45.328-20.334,45.328-45.328V256.836L222.837,164.727z     M207.819,396.48h-0.002c0,16.543-13.459,30.002-30.002,30.002H54.727L15.326,325.843v-90.549c0-7.194,5.853-13.047,13.047-13.047    S41.42,228.1,41.42,235.294v51.409c0,3.653,2.617,6.805,6.198,7.522c1.501,0.3,36.754,7.855,36.754,51.278    c0,4.232,3.43,7.663,7.663,7.663c4.233,0,7.663-3.431,7.663-7.663c0-29.26-13.284-45.754-24.428-54.439    c-6.857-5.344-13.754-8.423-18.523-10.103v-4.559c0.265-0.777,0.415-1.605,0.415-2.472V98.561c0-7.194,5.853-13.047,13.047-13.047    s13.045,5.854,13.045,13.047v63.14v70.582c0,4.232,3.43,7.663,7.663,7.663c4.233,0,7.663-3.431,7.663-7.663v-70.582v-63.14    c0-7.194,5.854-13.047,13.048-13.047s13.047,5.853,13.047,13.047v21.237v17.751v94.785c0,4.232,3.43,7.663,7.663,7.663    c4.233,0,7.663-3.431,7.663-7.663v-94.785v-17.751c0-7.194,5.853-13.047,13.047-13.047s13.047,5.853,13.047,13.047v27.177v17.751    v67.608c0,4.232,3.43,7.663,7.663,7.663c4.233,0,7.663-3.431,7.663-7.663v-67.608v-17.751c0-7.194,5.853-13.047,13.047-13.047    c7.194,0,13.048,5.853,13.048,13.047v17.776l0.305,92.109V396.48z" />

                                        <path d="M483.627,206.922c-4.869,0-9.454,1.234-13.463,3.403V98.561c0-15.645-12.728-28.373-28.373-28.373    c-8.164,0-15.529,3.471-20.71,9.008c-5.181-5.538-12.546-9.008-20.71-9.008c-14.353,0-26.243,10.714-28.111,24.563    c-3.971-2.119-8.502-3.325-13.309-3.325c-15.645,0-28.373,12.728-28.373,28.373v1.995c-3.909-2.033-8.344-3.19-13.047-3.19    c-15.645,0-28.373,12.728-28.373,28.373v17.725l-0.115,35.077c-0.237,1.054-0.25,2.169-0.011,3.282l-0.178,53.801v47.026    c0,0.017,0,0.034,0,0.051v92.542c0,24.994,20.333,45.328,45.327,45.328h128.317c3.154,0,5.985-1.932,7.135-4.87l41.835-106.855    c0.349-0.891,0.528-1.838,0.528-2.794v-91.996C512,219.65,499.272,206.922,483.627,206.922z M358.953,106.751    c7.194,0,13.047,5.853,13.047,13.047v17.751v33.419l-26.093,7.775v-14.016v-17.751v-27.177h-0.001    C345.907,112.604,351.759,106.751,358.953,106.751z M304.488,146.975c0-7.194,5.853-13.047,13.047-13.047    c7.194,0,13.047,5.853,13.047,13.047v17.751v18.583l-26.179,7.8l0.087-26.383v-17.751H304.488z M496.677,325.843h-0.003    l-39.402,100.639H334.184c-16.542,0-30.001-13.459-30.001-30.002v-86.767l61.514-18.328c4.056-1.209,6.365-5.476,5.156-9.532    c-1.209-4.056-5.479-6.366-9.532-5.156l-57.138,17.024v-36.835l0.165-49.77l26.233-7.816v33.034c0,4.232,3.43,7.663,7.663,7.663    c4.233,0,7.663-3.431,7.663-7.663v-37.601l26.093-7.775v45.375c0,4.232,3.43,7.663,7.663,7.663s7.663-3.431,7.663-7.663v-49.942    l12.306-3.667c4.056-1.209,6.365-5.476,5.156-9.532c-1.209-4.056-5.48-6.365-9.532-5.156l-7.93,2.362v-28.851v-17.751V98.561    c0-7.194,5.854-13.047,13.048-13.047s13.047,5.853,13.047,13.047v63.14v70.582c0,4.232,3.43,7.663,7.663,7.663    c4.233,0,7.663-3.431,7.663-7.663v-70.582v-63.14c0-7.194,5.853-13.047,13.047-13.047c7.194,0,13.047,5.853,13.047,13.047V273.93    c0,0.866,0.15,1.695,0.415,2.472v4.559c-4.77,1.681-11.666,4.759-18.523,10.103c-11.144,8.685-24.428,25.179-24.428,54.439    c0,4.232,3.43,7.663,7.663,7.663c4.233,0,7.663-3.431,7.663-7.663c0-43.424,35.253-50.977,36.717-51.271    c3.617-0.686,6.236-3.848,6.236-7.529v-51.409c0-7.194,5.854-13.047,13.048-13.047s13.047,5.853,13.047,13.047V325.843z" />

                                        <path d="M185.826,324.207c-2.275-3.568-7.012-4.615-10.581-2.34l-52.315,33.366c-3.568,2.275-4.616,7.013-2.34,10.581    c1.462,2.292,3.938,3.543,6.468,3.543c1.41,0,2.836-0.389,4.114-1.204l52.315-33.366    C187.055,332.513,188.103,327.775,185.826,324.207z" />

                                        <path d="M185.826,357.574c-2.276-3.568-7.011-4.616-10.581-2.34L122.93,388.6c-3.568,2.275-4.616,7.013-2.34,10.581    c1.462,2.291,3.938,3.543,6.468,3.543c1.41,0,2.836-0.388,4.114-1.204l52.315-33.366    C187.055,365.879,188.103,361.141,185.826,357.574z" />

                                        <path d="M383.779,308.945c-1.209-4.056-5.482-6.365-9.533-5.156l-43.052,12.828c-4.056,1.209-6.365,5.476-5.156,9.532    c0.991,3.326,4.039,5.477,7.341,5.477c0.724,0,1.462-0.104,2.192-0.321l43.052-12.828    C382.68,317.268,384.988,313.002,383.779,308.945z" />

                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Techniques</div>
                                    <div class="text-xs text-zinc-500 dark:text-zinc-400">Advanced methods</div>
                                </div>
                            </a>
                            <a href="#video-lessons" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-red-50 hover:to-rose-50 hover:text-red-700 dark:text-zinc-200 dark:hover:from-red-900/20 dark:hover:to-rose-900/20 dark:hover:text-red-300">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-red-100 text-red-600 group-hover:bg-red-200 dark:bg-red-900/30 dark:text-red-400 dark:group-hover:bg-red-800/40">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10" />
                                        <polygon points="10,8 16,12 10,16" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Video Lessons</div>
                                    <div class="text-xs text-zinc-500 dark:text-zinc-400">Step-by-step guides</div>
                                </div>
                            </a>
                            <a href="#progress" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-orange-50 hover:to-amber-50 hover:text-orange-700 dark:text-zinc-200 dark:hover:from-orange-900/20 dark:hover:to-amber-900/20 dark:hover:text-orange-300">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-100 text-orange-600 group-hover:bg-orange-200 dark:bg-orange-900/30 dark:text-orange-400 dark:group-hover:bg-orange-800/40">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Progress</div>
                                    <div class="text-xs text-zinc-500 dark:text-zinc-400">Track your learning</div>
                                </div>
                            </a>
                            <a href="#favorites" class="group flex items-center gap-3 px-4 py-3 text-sm font-medium text-zinc-700 rounded-lg transition-all duration-200 hover:bg-gradient-to-r hover:from-pink-50 hover:to-rose-50 hover:text-pink-700 dark:text-zinc-200 dark:hover:from-pink-900/20 dark:hover:to-rose-900/20 dark:hover:text-pink-300">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-pink-100 text-pink-600 group-hover:bg-pink-200 dark:bg-pink-900/30 dark:text-pink-400 dark:group-hover:bg-pink-800/40">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Favorites</div>
                                    <div class="text-xs text-zinc-500 dark:text-zinc-400">Liked content</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- AI Assistant -->
                <a href="#ai-assistant" class="flex items-center gap-3 rounded-lg px-4 py-3 transition-all duration-200 hover:bg-zinc-100/80 hover:text-zinc-900 dark:hover:bg-zinc-800/80 dark:hover:text-zinc-100">
                    <svg class="h-5 w-5 text-yellow-600 dark:text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14 2C14 2.74028 13.5978 3.38663 13 3.73244V4H20C21.6569 4 23 5.34315 23 7V19C23 20.6569 21.6569 22 20 22H4C2.34315 22 1 20.6569 1 19V7C1 5.34315 2.34315 4 4 4H11V3.73244C10.4022 3.38663 10 2.74028 10 2C10 0.895431 10.8954 0 12 0C13.1046 0 14 0.895431 14 2ZM4 6H11H13H20C20.5523 6 21 6.44772 21 7V19C21 19.5523 20.5523 20 20 20H4C3.44772 20 3 19.5523 3 19V7C3 6.44772 3.44772 6 4 6ZM15 11.5C15 10.6716 15.6716 10 16.5 10C17.3284 10 18 10.6716 18 11.5C18 12.3284 17.3284 13 16.5 13C15.6716 13 15 12.3284 15 11.5ZM16.5 8C14.567 8 13 9.567 13 11.5C13 13.433 14.567 15 16.5 15C18.433 15 20 13.433 20 11.5C20 9.567 18.433 8 16.5 8ZM7.5 10C6.67157 10 6 10.6716 6 11.5C6 12.3284 6.67157 13 7.5 13C8.32843 13 9 12.3284 9 11.5C9 10.6716 8.32843 10 7.5 10ZM4 11.5C4 9.567 5.567 8 7.5 8C9.433 8 11 9.567 11 11.5C11 13.433 9.433 15 7.5 15C5.567 15 4 13.433 4 11.5ZM10.8944 16.5528C10.6474 16.0588 10.0468 15.8586 9.55279 16.1056C9.05881 16.3526 8.85858 16.9532 9.10557 17.4472C9.68052 18.5971 10.9822 19 12 19C13.0178 19 14.3195 18.5971 14.8944 17.4472C15.1414 16.9532 14.9412 16.3526 14.4472 16.1056C13.9532 15.8586 13.3526 16.0588 13.1056 16.5528C13.0139 16.7362 12.6488 17 12 17C11.3512 17 10.9861 16.7362 10.8944 16.5528Z" />
                    </svg>
                    <span class="font-medium">AI Assistant</span>
                </a>

                <!-- Community -->
                <a href="#community" class="flex items-center gap-3 rounded-lg px-4 py-3 transition-all duration-200 hover:bg-zinc-100/80 hover:text-zinc-900 dark:hover:bg-zinc-800/80 dark:hover:text-zinc-100">
                    <svg class="h-5 w-5 text-pink-600 dark:text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                    </svg>
                    <span class="font-medium">Community</span>
                </a>

                @auth
                <!-- Admin Panel Mobile Dropdown (only for admins) -->
                @if(auth()->user()->isAdmin ?? false)
                <div class="relative">
                    <button type="button" data-mobile-dropdown-toggle="mobile-admin-dropdown" class="flex w-full items-center justify-between gap-3 rounded-lg px-4 py-3 transition-all duration-200 hover:bg-zinc-100/80 hover:text-zinc-900 dark:hover:bg-zinc-800/80 dark:hover:text-zinc-100 cursor-pointer">
                        <div class="flex items-center gap-3">
                            <svg class="h-5 w-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="font-medium">Admin Panel</span>
                        </div>
                        <svg class="h-4 w-4 transition-transform duration-300 ease-out mobile-dropdown-arrow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="mobile-admin-dropdown" class="hidden mt-2 ml-6 space-y-1">
                        <a href="#approve-models" class="flex items-center gap-3 rounded-lg px-4 py-2 text-sm transition-all duration-200 hover:bg-green-50 hover:text-green-700 dark:hover:bg-green-900/20 dark:hover:text-green-300">
                            <span>✅</span>
                            <span>Approve Models</span>
                        </a>
                        <a href="#manage-users" class="flex items-center gap-3 rounded-lg px-4 py-2 text-sm transition-all duration-200 hover:bg-blue-50 hover:text-blue-700 dark:hover:bg-blue-900/20 dark:hover:text-blue-300">
                            <span>👥</span>
                            <span>Manage Users</span>
                        </a>
                        <a href="#manage-materials" class="flex items-center gap-3 rounded-lg px-4 py-2 text-sm transition-all duration-200 hover:bg-purple-50 hover:text-purple-700 dark:hover:bg-purple-900/20 dark:hover:text-purple-300">
                            <span>🧵</span>
                            <span>Add/Edit Materials</span>
                        </a>
                        <a href="#statistics" class="flex items-center gap-3 rounded-lg px-4 py-2 text-sm transition-all duration-200 hover:bg-orange-50 hover:text-orange-700 dark:hover:bg-orange-900/20 dark:hover:text-orange-300">
                            <span>📈</span>
                            <span>Statistics</span>
                        </a>
                        <a href="#notifications" class="flex items-center gap-3 rounded-lg px-4 py-2 text-sm transition-all duration-200 hover:bg-yellow-50 hover:text-yellow-700 dark:hover:bg-yellow-900/20 dark:hover:text-yellow-300">
                            <span>🔔</span>
                            <span>Notifications</span>
                        </a>
                        <a href="#reports" class="flex items-center gap-3 rounded-lg px-4 py-2 text-sm transition-all duration-200 hover:bg-red-50 hover:text-red-700 dark:hover:bg-red-900/20 dark:hover:text-red-300">
                            <span>📋</span>
                            <span>Reports</span>
                        </a>
                    </div>
                </div>
                @endif

                <!-- 👤 Account Mobile Dropdown -->
                <div class="relative">
                    <button type="button" data-mobile-dropdown-toggle="mobile-account-dropdown" class="flex w-full items-center justify-between gap-3 rounded-lg px-4 py-3 transition-all duration-200 hover:bg-zinc-100/80 hover:text-zinc-900 dark:hover:bg-zinc-800/80 dark:hover:text-zinc-100 cursor-pointer">
                        <div class="flex items-center gap-3">
                            <span>👤</span>
                            <span class="font-medium">{{ Auth::user()->name ?? 'Account' }}</span>
                        </div>
                        <svg class="h-4 w-4 transition-transform duration-300 ease-out mobile-dropdown-arrow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="mobile-account-dropdown" class="hidden mt-2 ml-6 space-y-1">
                        <a href="#my-profile" class="flex items-center gap-3 rounded-lg px-4 py-2 text-sm transition-all duration-200 hover:bg-blue-50 hover:text-blue-700 dark:hover:bg-blue-900/20 dark:hover:text-blue-300">
                            <span>👤</span>
                            <span>My Profile</span>
                        </a>
                        <a href="#uploads" class="flex items-center gap-3 rounded-lg px-4 py-2 text-sm transition-all duration-200 hover:bg-green-50 hover:text-green-700 dark:hover:bg-green-900/20 dark:hover:text-green-300">
                            <span>📤</span>
                            <span>Uploads</span>
                        </a>
                        <a href="#my-patterns" class="flex items-center gap-3 rounded-lg px-4 py-2 text-sm transition-all duration-200 hover:bg-purple-50 hover:text-purple-700 dark:hover:bg-purple-900/20 dark:hover:text-purple-300">
                            <span>🧶</span>
                            <span>My Patterns</span>
                        </a>
                        <a href="#favorites" class="flex items-center gap-3 rounded-lg px-4 py-2 text-sm transition-all duration-200 hover:bg-pink-50 hover:text-pink-700 dark:hover:bg-pink-900/20 dark:hover:text-pink-300">
                            <span>💖</span>
                            <span>Favorites</span>
                        </a>
                        <a href="#courses" class="flex items-center gap-3 rounded-lg px-4 py-2 text-sm transition-all duration-200 hover:bg-orange-50 hover:text-orange-700 dark:hover:bg-orange-900/20 dark:hover:text-orange-300">
                            <span>📚</span>
                            <span>Courses</span>
                        </a>
                        <a href="#settings" class="flex items-center gap-3 rounded-lg px-4 py-2 text-sm transition-all duration-200 hover:bg-gray-50 hover:text-gray-700 dark:hover:bg-gray-900/20 dark:hover:text-gray-300">
                            <span>⚙️</span>
                            <span>Settings</span>
                        </a>
                        <div class="border-t border-zinc-200 dark:border-zinc-700 my-2"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center gap-3 rounded-lg px-4 py-2 text-sm transition-all duration-200 hover:bg-red-50 hover:text-red-700 dark:hover:bg-red-900/20 dark:hover:text-red-300">
                                <span>🚪</span>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <!-- Guest user buttons -->
                <div class="border-t border-zinc-200/70 dark:border-zinc-800/70 pt-4">
                    @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 rounded-lg border border-zinc-200 px-4 py-3 text-sm font-medium text-zinc-700 transition-all duration-200 hover:border-violet-300 hover:bg-violet-50 hover:text-violet-700 dark:border-zinc-700 dark:text-zinc-200 dark:hover:border-violet-500 dark:hover:bg-violet-900/20 dark:hover:text-violet-300">
                        <span>Log in</span>
                    </a>
                    @endif
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="mt-3 flex items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-violet-500 via-purple-500 to-indigo-500 px-4 py-3 text-sm font-semibold text-white shadow-sm shadow-violet-500/40 transition-all duration-200 hover:brightness-110">
                        <span>Sign up</span>
                    </a>
                    @endif
                </div>
                @endauth
            </div>
        </div>
    </div>


</nav>

@once
<script>
    (function() {
        if (window.__yarnlyNavbarInit) {
            return;
        }
        window.__yarnlyNavbarInit = true;
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile navbar toggle functionality
            document.querySelectorAll('[data-navbar-toggle]').forEach(function(toggle) {
                toggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    var targetId = toggle.getAttribute('data-target');
                    var target = document.getElementById(targetId);
                    if (!target) {
                        return;
                    }
                    
                    // Toggle the mobile menu visibility
                    var isHidden = target.classList.contains('hidden') || target.style.display === 'none';
                    
                    if (isHidden) {
                        // Show mobile menu
                        target.style.display = 'block';
                        target.classList.remove('hidden');
                        // Small delay to ensure display is set before removing transform
                        setTimeout(function() {
                            target.classList.remove('translate-x-full');
                        }, 10);
                        toggle.setAttribute('aria-expanded', 'true');
                    } else {
                        // Hide mobile menu
                        target.classList.add('translate-x-full');
                        // Add hidden class and set display none after animation completes
                        setTimeout(function() {
                            target.classList.add('hidden');
                            target.style.display = 'none';
                        }, 300);
                        toggle.setAttribute('aria-expanded', 'false');
                    }
                });
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(e) {
                var mobileMenus = document.querySelectorAll('[data-navbar-toggle]');
                mobileMenus.forEach(function(toggle) {
                    var targetId = toggle.getAttribute('data-target');
                    var target = document.getElementById(targetId);
                    if (target && !target.contains(e.target) && !toggle.contains(e.target)) {
                        if (!target.classList.contains('hidden') && target.style.display !== 'none') {
                            target.classList.add('translate-x-full');
                            setTimeout(function() {
                                target.classList.add('hidden');
                                target.style.display = 'none';
                            }, 300);
                            toggle.setAttribute('aria-expanded', 'false');
                        }
                    }
                });
            });

            // Dropdown toggle functionality with modern animations
            document.querySelectorAll('[data-dropdown-toggle]').forEach(function(toggle) {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    var targetId = toggle.getAttribute('data-dropdown-toggle');
                    var target = document.getElementById(targetId);
                    var arrow = toggle.querySelector('.dropdown-arrow');
                    var dropdownContent = target ? target.querySelector('div') : null;

                    if (!target) {
                        return;
                    }

                    // Close all other dropdowns with animation
                    document.querySelectorAll('[data-dropdown-toggle]').forEach(function(otherToggle) {
                        if (otherToggle !== toggle) {
                            var otherTargetId = otherToggle.getAttribute('data-dropdown-toggle');
                            var otherTarget = document.getElementById(otherTargetId);
                            var otherArrow = otherToggle.querySelector('.dropdown-arrow');
                            var otherDropdownContent = otherTarget ? otherTarget.querySelector('div') : null;

                            if (otherTarget && !otherTarget.classList.contains('hidden')) {
                                // Animate out
                                if (otherDropdownContent) {
                                    otherDropdownContent.style.transform = 'scale(0.95) translateY(-8px)';
                                    otherDropdownContent.style.opacity = '0';
                                }
                                if (otherArrow) {
                                    otherArrow.classList.remove('rotate-180');
                                }
                                setTimeout(function() {
                                    otherTarget.classList.add('hidden');
                                    if (otherDropdownContent) {
                                        otherDropdownContent.style.transform = '';
                                        otherDropdownContent.style.opacity = '';
                                    }
                                }, 150);
                            }
                        }
                    });

                    // Toggle current dropdown with animation
                    var isHidden = target.classList.contains('hidden');

                    if (isHidden) {
                        // Show dropdown
                        target.classList.remove('hidden');
                        if (dropdownContent) {
                            dropdownContent.style.transform = 'scale(0.95) translateY(-8px)';
                            dropdownContent.style.opacity = '0';
                            // Force reflow
                            dropdownContent.offsetHeight;
                            dropdownContent.style.transition = 'all 0.2s cubic-bezier(0.16, 1, 0.3, 1)';
                            dropdownContent.style.transform = 'scale(1) translateY(0)';
                            dropdownContent.style.opacity = '1';
                        }
                        if (arrow) {
                            arrow.classList.add('rotate-180');
                        }
                    } else {
                        // Hide dropdown
                        if (dropdownContent) {
                            dropdownContent.style.transform = 'scale(0.95) translateY(-8px)';
                            dropdownContent.style.opacity = '0';
                        }
                        if (arrow) {
                            arrow.classList.remove('rotate-180');
                        }
                        setTimeout(function() {
                            target.classList.add('hidden');
                            if (dropdownContent) {
                                dropdownContent.style.transform = '';
                                dropdownContent.style.opacity = '';
                                dropdownContent.style.transition = '';
                            }
                        }, 150);
                    }
                });
            });

            // Close dropdowns when clicking outside with animation
            document.addEventListener('click', function(e) {
                var isDropdownToggle = e.target.closest('[data-dropdown-toggle]');
                var isDropdownContent = e.target.closest('[id$="-dropdown"]');

                if (!isDropdownToggle && !isDropdownContent) {
                    document.querySelectorAll('[data-dropdown-toggle]').forEach(function(toggle) {
                        var targetId = toggle.getAttribute('data-dropdown-toggle');
                        var target = document.getElementById(targetId);
                        var arrow = toggle.querySelector('.dropdown-arrow');
                        var dropdownContent = target ? target.querySelector('div') : null;

                        if (target && !target.classList.contains('hidden')) {
                            // Animate out
                            if (dropdownContent) {
                                dropdownContent.style.transform = 'scale(0.95) translateY(-8px)';
                                dropdownContent.style.opacity = '0';
                            }
                            if (arrow) {
                                arrow.classList.remove('rotate-180');
                            }
                            setTimeout(function() {
                                target.classList.add('hidden');
                                if (dropdownContent) {
                                    dropdownContent.style.transform = '';
                                    dropdownContent.style.opacity = '';
                                    dropdownContent.style.transition = '';
                                }
                            }, 150);
                        }
                    });
                }
            });

            // Theme toggle functionality (both desktop and mobile)
            const themeToggle = document.getElementById('theme-toggle');
            const themeToggleMobile = document.getElementById('theme-toggle-mobile');
            const sunIcon = document.getElementById('sun-icon');
            const moonIcon = document.getElementById('moon-icon');
            
            function toggleTheme(button) {
                const isDark = document.documentElement.classList.contains('dark');
                
                // Add a brief scale animation to the clicked button
                button.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    button.style.transform = 'scale(1)';
                }, 150);
                
                // Toggle theme
                document.documentElement.classList.toggle('dark', !isDark);
                localStorage.setItem('theme', isDark ? 'light' : 'dark');
            }
            
            // Desktop theme toggle
            if (themeToggle && sunIcon && moonIcon) {
                themeToggle.addEventListener('click', function() {
                    toggleTheme(themeToggle);
                });
            }
            
            // Mobile theme toggle
            if (themeToggleMobile) {
                themeToggleMobile.addEventListener('click', function() {
                    toggleTheme(themeToggleMobile);
                });
            }

            // Mobile dropdown toggle functionality
            document.querySelectorAll('[data-mobile-dropdown-toggle]').forEach(function(toggle) {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    var targetId = toggle.getAttribute('data-mobile-dropdown-toggle');
                    var target = document.getElementById(targetId);
                    var arrow = toggle.querySelector('.mobile-dropdown-arrow');

                    if (!target) {
                        return;
                    }

                    // Close all other mobile dropdowns
                    document.querySelectorAll('[data-mobile-dropdown-toggle]').forEach(function(otherToggle) {
                        if (otherToggle !== toggle) {
                            var otherTargetId = otherToggle.getAttribute('data-mobile-dropdown-toggle');
                            var otherTarget = document.getElementById(otherTargetId);
                            var otherArrow = otherToggle.querySelector('.mobile-dropdown-arrow');
                            if (otherTarget && !otherTarget.classList.contains('hidden')) {
                                otherTarget.classList.add('hidden');
                                if (otherArrow) {
                                    otherArrow.classList.remove('rotate-180');
                                }
                            }
                        }
                    });

                    // Toggle current mobile dropdown
                    var isHidden = target.classList.contains('hidden');
                    target.classList.toggle('hidden', !isHidden);

                    // Rotate arrow if it exists
                    if (arrow) {
                        arrow.classList.toggle('rotate-180', isHidden);
                    }
                });
            });

            // Search functionality
            const searchToggle = document.getElementById('search-toggle');
            const searchToggleMobile = document.getElementById('search-toggle-mobile');
            const searchBox = document.getElementById('search-box');
            const searchBoxMobile = document.getElementById('search-box-mobile');
            const searchInput = document.getElementById('search-input');
            const searchInputMobile = document.getElementById('search-input-mobile');
            const searchSubmit = document.getElementById('search-submit');
            const searchSubmitMobile = document.getElementById('search-submit-mobile');
            
            // Search function
            function performSearch(query) {
                if (query.trim()) {
                    // Add your search logic here
                    console.log('Searching for:', query);
                    // Example: window.location.href = '/search?q=' + encodeURIComponent(query);
                    alert('Search functionality will be implemented here for: ' + query);
                }
            }
            
            // Desktop search toggle
            if (searchToggle && searchBox) {
                searchToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    
                    if (searchBox.classList.contains('opacity-0')) {
                        // Show search box
                        searchBox.classList.remove('opacity-0', 'invisible', 'translate-y-[-10px]', 'pointer-events-none');
                        searchBox.classList.add('opacity-100', 'visible', 'translate-y-0', 'pointer-events-auto');
                        
                        // Focus the input after animation
                        setTimeout(() => {
                            if (searchInput) searchInput.focus();
                        }, 200);
                    } else {
                        // Hide search box
                        searchBox.classList.remove('opacity-100', 'visible', 'translate-y-0', 'pointer-events-auto');
                        searchBox.classList.add('opacity-0', 'invisible', 'translate-y-[-10px]', 'pointer-events-none');
                    }
                });

                // Close search box when clicking outside
                document.addEventListener('click', function(e) {
                    if (!searchBox.contains(e.target) && e.target !== searchToggle) {
                        searchBox.classList.remove('opacity-100', 'visible', 'translate-y-0', 'pointer-events-auto');
                        searchBox.classList.add('opacity-0', 'invisible', 'translate-y-[-10px]', 'pointer-events-none');
                    }
                });

                if (searchSubmit) {
                    searchSubmit.addEventListener('click', function() {
                        if (searchInput) {
                            performSearch(searchInput.value);
                        }
                    });
                }
            }

            // Mobile search toggle
            if (searchToggleMobile && searchBoxMobile) {
                searchToggleMobile.addEventListener('click', function(e) {
                    e.stopPropagation();
                    
                    if (searchBoxMobile.classList.contains('opacity-0')) {
                        // Show search box
                        searchBoxMobile.classList.remove('opacity-0', 'invisible', 'translate-y-[-10px]', 'pointer-events-none');
                        searchBoxMobile.classList.add('opacity-100', 'visible', 'translate-y-0', 'pointer-events-auto');
                        
                        // Focus the input after animation
                        setTimeout(() => {
                            if (searchInputMobile) searchInputMobile.focus();
                        }, 200);
                    } else {
                        // Hide search box
                        searchBoxMobile.classList.remove('opacity-100', 'visible', 'translate-y-0', 'pointer-events-auto');
                        searchBoxMobile.classList.add('opacity-0', 'invisible', 'translate-y-[-10px]', 'pointer-events-none');
                    }
                });

                // Close search box when clicking outside
                document.addEventListener('click', function(e) {
                    if (!searchBoxMobile.contains(e.target) && e.target !== searchToggleMobile) {
                        searchBoxMobile.classList.remove('opacity-100', 'visible', 'translate-y-0', 'pointer-events-auto');
                        searchBoxMobile.classList.add('opacity-0', 'invisible', 'translate-y-[-10px]', 'pointer-events-none');
                    }
                });

                if (searchSubmitMobile) {
                    searchSubmitMobile.addEventListener('click', function() {
                        if (searchInputMobile) {
                            performSearch(searchInputMobile.value);
                        }
                    });
                }
            }
        });
    })();
</script>
@endonce