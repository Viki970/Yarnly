@extends('layout.app')

@section('title', 'Yarnly - Home')

@push('scripts')
@fluxScripts
@endpush

@section('content')

<!-- ============================================ -->
<!-- HERO SECTION - Blue (matches Home navbar icon) -->
<!-- Purpose: Main landing section with welcome message and CTA buttons -->
<!-- ============================================ -->
<section id="home" class="relative overflow-hidden bg-gradient-to-br from-blue-50 via-indigo-50 to-sky-50 py-20 dark:from-blue-950/40 dark:via-indigo-950/40 dark:to-sky-950/40">
    <div class="absolute -left-16 top-10 h-64 w-64 rounded-full bg-blue-400/30 blur-3xl dark:bg-blue-700/30"></div>
    <div class="absolute -right-10 bottom-10 h-72 w-72 rounded-full bg-sky-300/25 blur-3xl dark:bg-sky-600/25"></div>
    <div class="max-w-6xl mx-auto px-6 text-center lg:px-12">
        <div class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-sky-500 mb-6 shadow-xl shadow-blue-500/30">
            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
        </div>
        <h1 class="bg-gradient-to-r from-blue-600 via-indigo-600 to-sky-600 bg-clip-text text-5xl font-bold tracking-tight text-transparent sm:text-6xl lg:text-7xl dark:from-blue-400 dark:via-indigo-400 dark:to-sky-400">
            Welcome to Yarnly
        </h1>
        <p class="mt-6 max-w-3xl mx-auto text-xl leading-relaxed text-zinc-600 dark:text-zinc-300">
            Your complete yarn crafting studio. Explore patterns, manage projects, organize your stash, learn new techniques, and connect with a vibrant community.
        </p>
        <div class="mt-10 flex flex-wrap justify-center gap-4">
            @guest
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-blue-600 via-indigo-600 to-sky-600 px-10 py-4 text-sm font-bold text-white shadow-2xl shadow-blue-500/50 transition hover:scale-110 hover:shadow-blue-600/60">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                    <path d="M8.03339 3.65784C8.37932 2.78072 9.62068 2.78072 9.96661 3.65785L11.0386 6.37599C11.1442 6.64378 11.3562 6.85576 11.624 6.96137L14.3422 8.03339C15.2193 8.37932 15.2193 9.62068 14.3422 9.96661L11.624 11.0386C11.3562 11.1442 11.1442 11.3562 11.0386 11.624L9.96661 14.3422C9.62067 15.2193 8.37932 15.2193 8.03339 14.3422L6.96137 11.624C6.85575 11.3562 6.64378 11.1442 6.37599 11.0386L3.65784 9.96661C2.78072 9.62067 2.78072 8.37932 3.65785 8.03339L6.37599 6.96137C6.64378 6.85575 6.85576 6.64378 6.96137 6.37599L8.03339 3.65784Z" stroke="currentColor" stroke-width="1.5"/>
                    <path d="M16.4885 13.3481C16.6715 12.884 17.3285 12.884 17.5115 13.3481L18.3121 15.3781C18.368 15.5198 18.4802 15.632 18.6219 15.6879L20.6519 16.4885C21.116 16.6715 21.116 17.3285 20.6519 17.5115L18.6219 18.3121C18.4802 18.368 18.368 18.4802 18.3121 18.6219L17.5115 20.6519C17.3285 21.116 16.6715 21.116 16.4885 20.6519L15.6879 18.6219C15.632 18.4802 15.5198 18.368 15.3781 18.3121L13.3481 17.5115C12.884 17.3285 12.884 16.6715 13.3481 16.4885L15.3781 15.6879C15.5198 15.632 15.632 15.5198 15.6879 15.3781L16.4885 13.3481Z" stroke="currentColor" stroke-width="1.5"/>
                </svg>
                Start Creating
            </a>
            @endif
            @if (Route::has('login'))
            <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-blue-300 bg-white/80 px-10 py-4 text-sm font-bold text-blue-700 shadow-lg transition hover:border-blue-400 hover:bg-white dark:border-blue-700 dark:bg-zinc-900/80 dark:text-blue-300 dark:hover:border-blue-600">
                Sign In
            </a>
            @endif
            @else
            <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-blue-600 via-indigo-600 to-sky-600 px-10 py-4 text-sm font-bold text-white shadow-2xl shadow-blue-500/50 transition hover:scale-110 hover:shadow-blue-600/60">
                <span>🚀</span> Go to Dashboard
            </a>
            @endguest
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- PATTERNS SECTION - Emerald (matches Patterns navbar icon) -->
<!-- Purpose: Showcase pattern types - Crochet, Knitting, Embroidery -->
<!-- ============================================ -->
<section id="patterns" class="relative overflow-hidden bg-gradient-to-br from-emerald-50 via-teal-50 to-green-50 py-20 dark:from-emerald-950/40 dark:via-teal-950/40 dark:to-green-950/40">
    <div class="absolute -left-20 top-20 h-80 w-80 rounded-full bg-emerald-400/20 blur-3xl dark:bg-emerald-700/25"></div>
    <div class="absolute -right-16 bottom-20 h-64 w-64 rounded-full bg-teal-300/25 blur-3xl dark:bg-teal-600/20"></div>
    <div class="max-w-6xl mx-auto px-6 lg:px-12">
        <div class="text-center mb-12">
            <div class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-500 mb-6 shadow-xl shadow-emerald-500/30">
                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
            </div>
            <h2 class="bg-gradient-to-r from-emerald-600 via-teal-600 to-green-600 bg-clip-text text-4xl font-bold tracking-tight text-transparent sm:text-5xl dark:from-emerald-400 dark:via-teal-400 dark:to-green-400">
                Pattern Library
            </h2>
            <p class="mt-4 max-w-2xl mx-auto text-lg text-zinc-600 dark:text-zinc-300">
                Discover thousands of crochet, knitting, and embroidery patterns. AI-powered organization keeps everything searchable.
            </p>
        </div>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <article class="rounded-3xl border border-emerald-300/70 bg-gradient-to-br from-emerald-100 to-teal-100 p-6 shadow-xl shadow-emerald-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-emerald-500/40 dark:from-emerald-900/50 dark:to-teal-900/50">
                <h3 class="text-xl font-bold text-emerald-900 dark:text-white">🧶 Crochet</h3>
                <p class="mt-2 text-sm text-emerald-800/80 dark:text-emerald-100">Blankets, amigurumi & more. Browse 850+ patterns with step-by-step guides.</p>
            </article>
            <article class="rounded-3xl border border-violet-300/70 bg-gradient-to-br from-violet-100 to-purple-100 p-6 shadow-xl shadow-violet-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-violet-500/40 dark:from-violet-900/50 dark:to-purple-900/50">
                <h3 class="text-xl font-bold text-violet-900 dark:text-white">🧵 Knitting</h3>
                <p class="mt-2 text-sm text-violet-800/80 dark:text-violet-100">Sweaters, scarves & more. 1,200+ patterns with gauge calculators.</p>
            </article>
            <article class="rounded-3xl border border-rose-300/70 bg-gradient-to-br from-rose-100 to-pink-100 p-6 shadow-xl shadow-rose-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-rose-500/40 dark:from-rose-900/50 dark:to-pink-900/50">
                <h3 class="text-xl font-bold text-rose-900 dark:text-white">✂️ Embroidery</h3>
                <p class="mt-2 text-sm text-rose-800/80 dark:text-rose-100">Cross stitch, needlepoint. 450+ patterns with color charts.</p>
            </article>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- MODELS SECTION - Purple (matches Models navbar icon) -->
<!-- Purpose: Display 3D model features - Gallery, Top Rated, Recently Added, Create Model -->
<!-- ============================================ -->
<section id="models" class="relative overflow-hidden bg-gradient-to-br from-purple-50 via-violet-50 to-fuchsia-50 py-20 dark:from-purple-950/40 dark:via-violet-950/40 dark:to-fuchsia-950/40">
    <div class="absolute -right-20 top-10 h-72 w-72 rounded-full bg-purple-400/25 blur-3xl dark:bg-purple-700/30"></div>
    <div class="absolute -left-16 bottom-10 h-64 w-64 rounded-full bg-violet-300/20 blur-3xl dark:bg-violet-600/25"></div>
    <div class="max-w-6xl mx-auto px-6 lg:px-12">
        <div class="text-center mb-12">
            <div class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-purple-500 to-violet-500 mb-6 shadow-xl shadow-purple-500/30">
                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
            <h2 class="bg-gradient-to-r from-purple-600 via-violet-600 to-fuchsia-600 bg-clip-text text-4xl font-bold tracking-tight text-transparent sm:text-5xl dark:from-purple-400 dark:via-violet-400 dark:to-fuchsia-400">
                Model Gallery
            </h2>
            <p class="mt-4 max-w-2xl mx-auto text-lg text-zinc-600 dark:text-zinc-300">
                Browse finished projects, get inspired, and share your own creations with the community.
            </p>
        </div>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            <article class="rounded-3xl border border-blue-300/70 bg-gradient-to-br from-blue-100 to-indigo-100 p-6 shadow-xl shadow-blue-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-blue-500/40 dark:from-blue-900/50 dark:to-indigo-900/50">
                <h3 class="text-lg font-bold text-blue-900 dark:text-white">📸 Gallery</h3>
                <p class="mt-2 text-sm text-blue-800/80 dark:text-blue-100">Browse all completed models</p>
            </article>
            <article class="rounded-3xl border border-yellow-300/70 bg-gradient-to-br from-yellow-100 to-amber-100 p-6 shadow-xl shadow-yellow-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-yellow-500/40 dark:from-yellow-900/50 dark:to-amber-900/50">
                <h3 class="text-lg font-bold text-yellow-900 dark:text-white">⭐ Top Rated</h3>
                <p class="mt-2 text-sm text-yellow-800/80 dark:text-yellow-100">Community favorites</p>
            </article>
            <article class="rounded-3xl border border-green-300/70 bg-gradient-to-br from-green-100 to-emerald-100 p-6 shadow-xl shadow-green-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-green-500/40 dark:from-green-900/50 dark:to-emerald-900/50">
                <h3 class="text-lg font-bold text-green-900 dark:text-white">🕐 Recently Added</h3>
                <p class="mt-2 text-sm text-green-800/80 dark:text-green-100">Latest uploads</p>
            </article>
            <article class="rounded-3xl border border-purple-300/70 bg-gradient-to-br from-purple-100 to-violet-100 p-6 shadow-xl shadow-purple-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-purple-500/40 dark:from-purple-900/50 dark:to-violet-900/50">
                <h3 class="text-lg font-bold text-purple-900 dark:text-white">➕ Create Model</h3>
                <p class="mt-2 text-sm text-purple-800/80 dark:text-purple-100">Upload your work</p>
            </article>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- TUTORIALS SECTION - Orange (matches Tutorials navbar icon) -->
<!-- Purpose: Learning resources - Beginner Course, Stitches, Techniques, Videos, Progress, Favorites -->
<!-- ============================================ -->
<section id="tutorials" class="relative overflow-hidden bg-gradient-to-br from-orange-50 via-amber-50 to-yellow-50 py-20 dark:from-orange-950/40 dark:via-amber-950/40 dark:to-yellow-950/40">
    <div class="absolute -left-20 top-20 h-80 w-80 rounded-full bg-orange-400/20 blur-3xl dark:bg-orange-700/25"></div>
    <div class="absolute -right-16 bottom-20 h-64 w-64 rounded-full bg-amber-300/25 blur-3xl dark:bg-amber-600/20"></div>
    <div class="max-w-6xl mx-auto px-6 lg:px-12">
        <div class="text-center mb-12">
            <div class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-orange-500 to-amber-500 mb-6 shadow-xl shadow-orange-500/30">
                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <h2 class="bg-gradient-to-r from-orange-600 via-amber-600 to-yellow-600 bg-clip-text text-4xl font-bold tracking-tight text-transparent sm:text-5xl dark:from-orange-400 dark:via-amber-400 dark:to-yellow-400">
                Learn & Master
            </h2>
            <p class="mt-4 max-w-2xl mx-auto text-lg text-zinc-600 dark:text-zinc-300">
                Step-by-step tutorials, video lessons, and technique guides to level up your crafting skills.
            </p>
        </div>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <article class="rounded-3xl border border-green-300/70 bg-gradient-to-br from-green-100 to-emerald-100 p-6 shadow-xl shadow-green-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-green-500/40 dark:from-green-900/50 dark:to-emerald-900/50">
                <h3 class="text-xl font-bold text-green-900 dark:text-white">▶️ Beginner Course</h3>
                <p class="mt-2 text-sm text-green-800/80 dark:text-green-100">Start your crafting journey from scratch</p>
            </article>
            <article class="rounded-3xl border border-blue-300/70 bg-gradient-to-br from-blue-100 to-cyan-100 p-6 shadow-xl shadow-blue-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-blue-500/40 dark:from-blue-900/50 dark:to-cyan-900/50">
                <h3 class="text-xl font-bold text-blue-900 dark:text-white">✂️ Stitches</h3>
                <p class="mt-2 text-sm text-blue-800/80 dark:text-blue-100">Learn basic and advanced stitch techniques</p>
            </article>
            <article class="rounded-3xl border border-purple-300/70 bg-gradient-to-br from-purple-100 to-violet-100 p-6 shadow-xl shadow-purple-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-purple-500/40 dark:from-purple-900/50 dark:to-violet-900/50">
                <h3 class="text-xl font-bold text-purple-900 dark:text-white">🤚 Techniques</h3>
                <p class="mt-2 text-sm text-purple-800/80 dark:text-purple-100">Advanced methods and finishing</p>
            </article>
            <article class="rounded-3xl border border-red-300/70 bg-gradient-to-br from-red-100 to-rose-100 p-6 shadow-xl shadow-red-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-red-500/40 dark:from-red-900/50 dark:to-rose-900/50">
                <h3 class="text-xl font-bold text-red-900 dark:text-white">🎥 Video Lessons</h3>
                <p class="mt-2 text-sm text-red-800/80 dark:text-red-100">Step-by-step video guides</p>
            </article>
            <article class="rounded-3xl border border-orange-300/70 bg-gradient-to-br from-orange-100 to-amber-100 p-6 shadow-xl shadow-orange-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-orange-500/40 dark:from-orange-900/50 dark:to-amber-900/50">
                <h3 class="text-xl font-bold text-orange-900 dark:text-white">📈 Progress</h3>
                <p class="mt-2 text-sm text-orange-800/80 dark:text-orange-100">Track your learning journey</p>
            </article>
            <article class="rounded-3xl border border-pink-300/70 bg-gradient-to-br from-pink-100 to-rose-100 p-6 shadow-xl shadow-pink-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-pink-500/40 dark:from-pink-900/50 dark:to-rose-900/50">
                <h3 class="text-xl font-bold text-pink-900 dark:text-white">💖 Favorites</h3>
                <p class="mt-2 text-sm text-pink-800/80 dark:text-pink-100">Your saved tutorials</p>
            </article>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- AI ASSISTANT SECTION - Yellow (matches AI Assistant navbar icon) -->
<!-- Purpose: AI-powered tools - Pattern Analysis, Gauge Calculator, Yarn Substitution -->
<!-- ============================================ -->
<section id="ai-assistant" class="relative overflow-hidden bg-gradient-to-br from-yellow-50 via-amber-50 to-orange-50 py-20 dark:from-yellow-950/40 dark:via-amber-950/40 dark:to-orange-950/40">
    <div class="absolute -right-20 top-10 h-72 w-72 rounded-full bg-yellow-400/25 blur-3xl dark:bg-yellow-700/30"></div>
    <div class="absolute -left-16 bottom-10 h-64 w-64 rounded-full bg-amber-300/20 blur-3xl dark:bg-amber-600/25"></div>
    <div class="max-w-6xl mx-auto px-6 lg:px-12">
        <div class="text-center mb-12">
            <div class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-yellow-500 to-amber-500 mb-6 shadow-xl shadow-yellow-500/30">
                <svg class="h-8 w-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14 2C14 2.74028 13.5978 3.38663 13 3.73244V4H20C21.6569 4 23 5.34315 23 7V19C23 20.6569 21.6569 22 20 22H4C2.34315 22 1 20.6569 1 19V7C1 5.34315 2.34315 4 4 4H11V3.73244C10.4022 3.38663 10 2.74028 10 2C10 0.895431 10.8954 0 12 0C13.1046 0 14 0.895431 14 2ZM4 6H11H13H20C20.5523 6 21 6.44772 21 7V19C21 19.5523 20.5523 20 20 20H4C3.44772 20 3 19.5523 3 19V7C3 6.44772 3.44772 6 4 6ZM15 11.5C15 10.6716 15.6716 10 16.5 10C17.3284 10 18 10.6716 18 11.5C18 12.3284 17.3284 13 16.5 13C15.6716 13 15 12.3284 15 11.5ZM16.5 8C14.567 8 13 9.567 13 11.5C13 13.433 14.567 15 16.5 15C18.433 15 20 13.433 20 11.5C20 9.567 18.433 8 16.5 8ZM7.5 10C6.67157 10 6 10.6716 6 11.5C6 12.3284 6.67157 13 7.5 13C8.32843 13 9 12.3284 9 11.5C9 10.6716 8.32843 10 7.5 10ZM4 11.5C4 9.567 5.567 8 7.5 8C9.433 8 11 9.567 11 11.5C11 13.433 9.433 15 7.5 15C5.567 15 4 13.433 4 11.5ZM10.8944 16.5528C10.6474 16.0588 10.0468 15.8586 9.55279 16.1056C9.05881 16.3526 8.85858 16.9532 9.10557 17.4472C9.68052 18.5971 10.9822 19 12 19C13.0178 19 14.3195 18.5971 14.8944 17.4472C15.1414 16.9532 14.9412 16.3526 14.4472 16.1056C13.9532 15.8586 13.3526 16.0588 13.1056 16.5528C13.0139 16.7362 12.6488 17 12 17C11.3512 17 10.9861 16.7362 10.8944 16.5528Z" />
                </svg>
            </div>
            <h2 class="bg-gradient-to-r from-yellow-600 via-amber-600 to-orange-600 bg-clip-text text-4xl font-bold tracking-tight text-transparent sm:text-5xl dark:from-yellow-400 dark:via-amber-400 dark:to-orange-400">
                AI-Powered Assistant
            </h2>
            <p class="mt-4 max-w-2xl mx-auto text-lg text-zinc-600 dark:text-zinc-300">
                Get instant help with pattern questions, yarn substitutions, gauge calculations, and more.
            </p>
        </div>
        <div class="grid gap-6 md:grid-cols-3">
            <article class="rounded-3xl border border-yellow-300/70 bg-gradient-to-br from-yellow-100 to-amber-100 p-8 shadow-xl shadow-yellow-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-yellow-500/40 dark:from-yellow-900/50 dark:to-amber-900/50">
                <div class="text-5xl mb-4">🤖</div>
                <h3 class="text-xl font-bold text-yellow-900 dark:text-white">Smart Pattern Analysis</h3>
                <p class="mt-2 text-sm text-yellow-800/80 dark:text-yellow-100">AI reads your patterns and answers questions instantly</p>
            </article>
            <article class="rounded-3xl border border-amber-300/70 bg-gradient-to-br from-amber-100 to-orange-100 p-8 shadow-xl shadow-amber-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-amber-500/40 dark:from-amber-900/50 dark:to-orange-900/50">
                <div class="text-5xl mb-4">🧮</div>
                <h3 class="text-xl font-bold text-amber-900 dark:text-white">Gauge Calculator</h3>
                <p class="mt-2 text-sm text-amber-800/80 dark:text-amber-100">Automatic stitch and row calculations for any size</p>
            </article>
            <article class="rounded-3xl border border-orange-300/70 bg-gradient-to-br from-orange-100 to-red-100 p-8 shadow-xl shadow-orange-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-orange-500/40 dark:from-orange-900/50 dark:to-red-900/50">
                <div class="text-5xl mb-4">🧶</div>
                <h3 class="text-xl font-bold text-orange-900 dark:text-white">Yarn Substitution</h3>
                <p class="mt-2 text-sm text-orange-800/80 dark:text-orange-100">Find perfect alternatives for any yarn type</p>
            </article>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- COMMUNITY SECTION - Pink (matches Community navbar icon) -->
<!-- Purpose: Social features - Forums & Discussions, Monthly Challenges -->
<!-- ============================================ -->
<section id="community" class="relative overflow-hidden bg-gradient-to-br from-pink-50 via-rose-50 to-red-50 py-20 dark:from-pink-950/40 dark:via-rose-950/40 dark:to-red-950/40">
    <div class="absolute -left-20 top-20 h-80 w-80 rounded-full bg-pink-400/20 blur-3xl dark:bg-pink-700/25"></div>
    <div class="absolute -right-16 bottom-20 h-64 w-64 rounded-full bg-rose-300/25 blur-3xl dark:bg-rose-600/20"></div>
    <div class="max-w-6xl mx-auto px-6 lg:px-12">
        <div class="text-center mb-12">
            <div class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-pink-500 to-rose-500 mb-6 shadow-xl shadow-pink-500/30">
                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                </svg>
            </div>
            <h2 class="bg-gradient-to-r from-pink-600 via-rose-600 to-red-600 bg-clip-text text-4xl font-bold tracking-tight text-transparent sm:text-5xl dark:from-pink-400 dark:via-rose-400 dark:to-red-400">
                Join the Community
            </h2>
            <p class="mt-4 max-w-2xl mx-auto text-lg text-zinc-600 dark:text-zinc-300">
                Connect with fellow crafters, share your projects, get feedback, and participate in challenges.
            </p>
        </div>
        <div class="grid gap-6 md:grid-cols-2">
            <article class="rounded-3xl border border-pink-300/70 bg-gradient-to-br from-pink-100 to-rose-100 p-8 shadow-xl shadow-pink-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-pink-500/40 dark:from-pink-900/50 dark:to-rose-900/50">
                <div class="flex items-center gap-3 mb-4">
                    <div class="h-14 w-14 rounded-2xl bg-gradient-to-br from-pink-500 to-rose-500 flex items-center justify-center text-2xl font-bold text-white shadow-lg">💬</div>
                    <div>
                        <h3 class="text-lg font-bold text-pink-900 dark:text-white">Forums & Discussions</h3>
                        <p class="text-xs text-pink-700 dark:text-pink-100">18 members online now</p>
                    </div>
                </div>
                <p class="text-sm text-pink-800/80 dark:text-pink-100">Ask questions, share tips, and learn from experienced crafters</p>
            </article>
            <article class="rounded-3xl border border-rose-300/70 bg-gradient-to-br from-rose-100 to-red-100 p-8 shadow-xl shadow-rose-200/30 transition hover:-translate-y-2 hover:shadow-2xl dark:border-rose-500/40 dark:from-rose-900/50 dark:to-red-900/50">
                <div class="flex items-center gap-3 mb-4">
                    <div class="h-14 w-14 rounded-2xl bg-gradient-to-br from-rose-500 to-red-500 flex items-center justify-center text-2xl font-bold text-white shadow-lg">🏆</div>
                    <div>
                        <h3 class="text-lg font-bold text-rose-900 dark:text-white">Monthly Challenges</h3>
                        <p class="text-xs text-rose-700 dark:text-rose-100">Next challenge in 5 days</p>
                    </div>
                </div>
                <p class="text-sm text-rose-800/80 dark:text-rose-100">Participate in themed challenges and win prizes</p>
            </article>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- FINAL CTA SECTION - Call to Action -->
<!-- Purpose: Encourage user registration or navigation with buttons -->
<!-- ============================================ -->
<section class="bg-gradient-to-br from-violet-50 via-fuchsia-50 to-rose-50 py-16 dark:from-violet-950/40 dark:via-fuchsia-950/40 dark:to-rose-950/40">
    <div class="max-w-5xl mx-auto px-6 text-center lg:px-12">
        <div class="flex flex-wrap justify-center gap-4">
            @guest
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-fuchsia-600 via-violet-600 to-sky-600 px-10 py-4 text-sm font-bold text-white shadow-2xl shadow-violet-500/50 transition hover:scale-110 hover:shadow-violet-600/60">
                <span>✨</span> Create free account
            </a>
            @endif
            @else
            <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-fuchsia-600 via-violet-600 to-sky-600 px-10 py-4 text-sm font-bold text-white shadow-2xl shadow-violet-500/50 transition hover:scale-110 hover:shadow-violet-600/60">
                <span>🚀</span> Continue in dashboard
            </a>
            @endguest
            <a href="#patterns" class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-violet-300 bg-white/80 px-10 py-4 text-sm font-bold text-violet-700 shadow-lg transition hover:border-violet-400 hover:bg-white dark:border-violet-700 dark:bg-zinc-900/80 dark:text-violet-300 dark:hover:border-violet-600">
                Explore the pieces
            </a>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- CONTACT FORM SECTION -->
<!-- Purpose: Allow users to send messages/inquiries -->
<!-- ============================================ -->
<section id="contact" class="relative overflow-hidden bg-gradient-to-br from-blue-50 via-indigo-50 to-sky-50 py-20 dark:from-blue-950/40 dark:via-indigo-950/40 dark:to-sky-950/40">
    <div class="absolute -left-20 top-20 h-80 w-80 rounded-full bg-blue-400/20 blur-3xl"></div>
    <div class="absolute -right-16 bottom-20 h-64 w-64 rounded-full bg-sky-300/25 blur-3xl"></div>
    
    <div class="relative max-w-4xl mx-auto px-6 lg:px-12">
        <div class="text-center mb-12">
            <div class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-sky-500 mb-6 shadow-xl shadow-blue-500/30">
                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <h2 class="bg-gradient-to-r from-blue-600 via-indigo-600 to-sky-600 bg-clip-text text-4xl font-bold tracking-tight text-transparent sm:text-5xl dark:from-blue-400 dark:via-indigo-400 dark:to-sky-400">Get in Touch</h2>
            <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-300">Have questions? We'd love to hear from you.</p>
        </div>

        <form class="space-y-6 relative">
            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="name" class="block text-sm font-bold text-blue-700 dark:text-blue-300 mb-2">Name</label>
                    <input type="text" id="name" name="name" required 
                        class="w-full rounded-xl border-2 border-blue-200 bg-white px-4 py-3 text-zinc-900 shadow-md transition-all duration-300 
                        hover:border-blue-400 hover:shadow-lg hover:shadow-blue-200/50 hover:-translate-y-0.5
                        focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/20 focus:shadow-xl focus:shadow-indigo-300/30
                        dark:border-blue-700 dark:bg-zinc-800 dark:text-white 
                        dark:hover:border-blue-500 dark:hover:shadow-blue-500/30
                        dark:focus:border-indigo-400 dark:focus:ring-indigo-400/20" 
                        placeholder="Your name">
                </div>
                <div>
                    <label for="email" class="block text-sm font-bold text-indigo-700 dark:text-indigo-300 mb-2">Email</label>
                    <input type="email" id="email" name="email" required 
                        class="w-full rounded-xl border-2 border-indigo-200 bg-white px-4 py-3 text-zinc-900 shadow-md transition-all duration-300
                        hover:border-indigo-400 hover:shadow-lg hover:shadow-indigo-200/50 hover:-translate-y-0.5
                        focus:border-sky-500 focus:outline-none focus:ring-4 focus:ring-sky-500/20 focus:shadow-xl focus:shadow-sky-300/30
                        dark:border-indigo-700 dark:bg-zinc-800 dark:text-white
                        dark:hover:border-indigo-500 dark:hover:shadow-indigo-500/30
                        dark:focus:border-sky-400 dark:focus:ring-sky-400/20" 
                        placeholder="your@email.com">
                </div>
            </div>
            <div>
                <label for="subject" class="block text-sm font-bold text-sky-700 dark:text-sky-300 mb-2">Subject</label>
                <input type="text" id="subject" name="subject" required 
                    class="w-full rounded-xl border-2 border-sky-200 bg-white px-4 py-3 text-zinc-900 shadow-md transition-all duration-300
                    hover:border-sky-400 hover:shadow-lg hover:shadow-sky-200/50 hover:-translate-y-0.5
                    focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:shadow-xl focus:shadow-blue-300/30
                    dark:border-sky-700 dark:bg-zinc-800 dark:text-white
                    dark:hover:border-sky-500 dark:hover:shadow-sky-500/30
                    dark:focus:border-blue-400 dark:focus:ring-blue-400/20" 
                    placeholder="What's this about?">
            </div>
            <div>
                <label for="message" class="block text-sm font-bold text-blue-700 dark:text-blue-300 mb-2">Message</label>
                <textarea id="message" name="message" rows="6" required 
                    class="w-full rounded-xl border-2 border-blue-200 bg-white px-4 py-3 text-zinc-900 shadow-md transition-all duration-300 resize-none
                    hover:border-blue-400 hover:shadow-lg hover:shadow-blue-200/50 hover:-translate-y-0.5
                    focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/20 focus:shadow-xl focus:shadow-indigo-300/30
                    dark:border-blue-700 dark:bg-zinc-800 dark:text-white
                    dark:hover:border-blue-500 dark:hover:shadow-blue-500/30
                    dark:focus:border-indigo-400 dark:focus:ring-indigo-400/20" 
                    placeholder="Your message..."></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-blue-600 via-indigo-600 to-sky-600 px-10 py-4 text-sm font-bold text-white shadow-2xl shadow-blue-500/50 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-indigo-500/60 hover:-translate-y-1">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                    Send Message
                </button>
            </div>
        </form>
    </div>
</section>

<!-- ============================================ -->
<!-- FOOTER - Copyright -->
<!-- Purpose: Copyright notice and legal information -->
<!-- ============================================ -->
<footer class="border-t border-zinc-200 bg-zinc-50 py-8 dark:border-zinc-800 dark:bg-zinc-900">
    <div class="max-w-6xl mx-auto px-6 lg:px-12">
        <div class="text-center text-sm text-zinc-600 dark:text-zinc-400">
            <p>&copy; {{ date('Y') }} Yarnly. All rights reserved.</p>
            <p class="mt-2">Made with <span class="text-rose-500">❤</span> for the yarn crafting community</p>
        </div>
    </div>
</footer>
@endsection
@section('slices')
<!-- Slices Section -->
<div class="absolute right-0 top-0 h-24 w-24 -translate-y-8 translate-x-8 rounded-full bg-emerald-400/30 blur-2xl"></div>
<p class="text-xs font-bold uppercase tracking-widest text-emerald-700 dark:text-emerald-200">🎯 Projects</p>
<h3 class="mt-3 text-xl font-bold text-emerald-900 dark:text-white">Boards that stay calm</h3>
<p class="mt-2 text-sm text-emerald-900/80 dark:text-emerald-50">Current lane: Focus · 3 milestones due this week · blockers flagged with yarn requirements.</p>
<div class="mt-4 inline-flex items-center gap-2 rounded-full bg-white/90 px-4 py-2 text-xs font-bold text-emerald-700 shadow-lg shadow-emerald-200/50 dark:bg-emerald-900/60 dark:text-emerald-100">→ Open project view</div>
</article>
<article id="patterns" class="relative h-full overflow-hidden rounded-3xl border border-amber-300/70 bg-gradient-to-br from-amber-100 via-orange-100 to-yellow-100 p-6 shadow-xl shadow-amber-300/30 transition hover:-translate-y-2 hover:shadow-2xl hover:shadow-amber-400/40 dark:border-amber-500/40 dark:from-amber-900/50 dark:via-orange-900/50 dark:to-yellow-900/50">
    <div class="absolute right-0 top-0 h-24 w-24 -translate-y-8 translate-x-8 rounded-full bg-amber-400/30 blur-2xl"></div>
    <p class="text-xs font-bold uppercase tracking-widest text-amber-700 dark:text-amber-200">📐 Pattern library</p>
    <h3 class="mt-3 text-xl font-bold text-amber-900 dark:text-white">AI-smart pattern brain</h3>
    <p class="mt-2 text-sm text-amber-900/80 dark:text-amber-50">Recent uploads parsed · stitch counts aligned with gauge · substitutions approved for two palettes.</p>
    <div class="mt-4 inline-flex items-center gap-2 rounded-full bg-white/90 px-4 py-2 text-xs font-bold text-amber-700 shadow-lg shadow-amber-200/50 dark:bg-amber-900/60 dark:text-amber-100">→ View latest patterns</div>
</article>
<article id="stash" class="relative h-full overflow-hidden rounded-3xl border border-rose-300/70 bg-gradient-to-br from-rose-100 via-pink-100 to-fuchsia-100 p-6 shadow-xl shadow-rose-300/30 transition hover:-translate-y-2 hover:shadow-2xl hover:shadow-rose-400/40 dark:border-rose-500/40 dark:from-rose-900/50 dark:via-pink-900/50 dark:to-fuchsia-900/50">
    <div class="absolute right-0 top-0 h-24 w-24 -translate-y-8 translate-x-8 rounded-full bg-rose-400/30 blur-2xl"></div>
    <p class="text-xs font-bold uppercase tracking-widest text-rose-700 dark:text-rose-200">🧶 Stash + suppliers</p>
    <h3 class="mt-3 text-xl font-bold text-rose-900 dark:text-white">Inventory without spreadsheets</h3>
    <p class="mt-2 text-sm text-rose-900/80 dark:text-rose-50">Auto depletion on handoffs, low-stock pings, and preferred suppliers one tap away.</p>
    <div class="mt-4 inline-flex items-center gap-2 rounded-full bg-white/90 px-4 py-2 text-xs font-bold text-rose-700 shadow-lg shadow-rose-200/50 dark:bg-rose-900/60 dark:text-rose-100">→ Check stash health</div>
</article>
<article id="community" class="relative h-full overflow-hidden rounded-3xl border border-sky-300/70 bg-gradient-to-br from-sky-100 via-indigo-100 to-violet-100 p-6 shadow-xl shadow-sky-300/30 transition hover:-translate-y-2 hover:shadow-2xl hover:shadow-sky-400/40 dark:border-sky-500/40 dark:from-sky-900/50 dark:via-indigo-900/50 dark:to-violet-900/50">
    <div class="absolute right-0 top-0 h-24 w-24 -translate-y-8 translate-x-8 rounded-full bg-sky-400/30 blur-2xl"></div>
    <p class="text-xs font-bold uppercase tracking-widest text-sky-700 dark:text-sky-200">👥 Community + learning</p>
    <h3 class="mt-3 text-xl font-bold text-sky-900 dark:text-white">Guild energy, threaded</h3>
    <p class="mt-2 text-sm text-sky-900/80 dark:text-sky-50">Live threads, class replays, and polls keep every maker looped in without leaving Yarnly.</p>
    <div class="mt-4 inline-flex items-center gap-2 rounded-full bg-white/90 px-4 py-2 text-xs font-bold text-sky-700 shadow-lg shadow-sky-200/50 dark:bg-sky-900/60 dark:text-sky-100">→ Visit community</div>
</article>
</div>
</div>
</section>

<section id="projects" class="bg-gradient-to-br from-emerald-50 via-teal-50 to-cyan-50 py-16 dark:from-emerald-950/40 dark:via-teal-950/40 dark:to-cyan-950/40">
    <div class="max-w-6xl mx-auto px-6 lg:px-12">
        <div class="grid gap-12 lg:grid-cols-[0.9fr_1.1fr]">
            <div class="space-y-4">
                <p class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.32em] text-transparent bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text">🎯 Workflow taste</p>
                <h2 class="text-3xl font-semibold tracking-tight text-zinc-900 dark:text-white">See how projects, patterns, and stash talk to each other.</h2>
                <p class="text-base text-zinc-600 dark:text-zinc-300">This slice mirrors the actual flow you’ll find inside: capture a pattern, set milestones, sync stash, and share progress without leaving the board.</p>
                <ul class="mt-6 space-y-5 text-sm text-zinc-600 dark:text-zinc-300">
                    <li class="flex gap-4">
                        <span class="mt-1 inline-flex h-9 w-9 items-center justify-center rounded-full bg-white shadow-sm dark:bg-zinc-800">1</span>
                        <div>
                            <h3 class="font-semibold text-zinc-900 dark:text-white">Capture</h3>
                            <p>Drop PDFs or voice notes. AI tags yarn weight, skill level, and alerts on gauge drift.</p>
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <span class="mt-1 inline-flex h-9 w-9 items-center justify-center rounded-full bg-white shadow-sm dark:bg-zinc-800">2</span>
                        <div>
                            <h3 class="font-semibold text-zinc-900 dark:text-white">Plan</h3>
                            <p>Milestones auto-calc yarn needs and reserve stash. Suppliers stay attached to each task.</p>
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <span class="mt-1 inline-flex h-9 w-9 items-center justify-center rounded-full bg-white shadow-sm dark:bg-zinc-800">3</span>
                        <div>
                            <h3 class="font-semibold text-zinc-900 dark:text-white">Share</h3>
                            <p>Thread updates, quick polls, and one-click invites keep collaborators aligned.</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="relative overflow-hidden rounded-[2rem] border border-zinc-200 bg-white p-8 shadow-xl dark:border-zinc-800 dark:bg-zinc-950">
                <div class="grid gap-6">
                    <div class="rounded-2xl border border-emerald-300/60 bg-gradient-to-br from-emerald-100 to-teal-100 p-5 shadow-lg shadow-emerald-200/30 dark:border-emerald-500/40 dark:from-emerald-900/50 dark:to-teal-900/50">
                        <div class="flex items-center justify-between text-xs font-bold uppercase tracking-widest text-emerald-700 dark:text-emerald-200">
                            <span class="flex items-center gap-1">🎯 Board</span>
                            <span class="rounded-full bg-emerald-500/30 px-2 py-1">✓ Synced</span>
                        </div>
                        <p class="mt-2 text-lg font-bold text-emerald-900 dark:text-white">Focus lane · 3 cards</p>
                        <p class="text-sm text-emerald-800/80 dark:text-emerald-100">Tasks grouped by fiber type and deadline, with stash auto-reserved.</p>
                    </div>
                    <div class="rounded-2xl border border-amber-300/70 bg-gradient-to-br from-amber-100 to-orange-100 p-5 shadow-lg shadow-amber-200/30 dark:border-amber-500/40 dark:from-amber-900/50 dark:to-orange-900/50">
                        <p class="flex items-center gap-1 text-xs font-bold uppercase tracking-widest text-amber-700 dark:text-amber-200">📐 Pattern brain</p>
                        <p class="mt-2 text-lg font-bold text-amber-900 dark:text-white">Stitch math verified</p>
                        <p class="text-sm text-amber-800/80 dark:text-amber-100">Latest chart matched to DK gauge · 2 substitutions approved.</p>
                    </div>
                    <div class="rounded-2xl border border-rose-300/70 bg-gradient-to-br from-rose-100 to-pink-100 p-5 shadow-lg shadow-rose-200/30 dark:border-rose-500/40 dark:from-rose-900/50 dark:to-pink-900/50">
                        <p class="flex items-center gap-1 text-xs font-bold uppercase tracking-widest text-rose-700 dark:text-rose-200">🧶 Stash pulse</p>
                        <p class="mt-2 text-lg font-bold text-rose-900 dark:text-white">Balanced</p>
                        <p class="text-sm text-rose-800/80 dark:text-rose-100">Reserve 2 skeins for Atlas Socks · reorder reminder set for Moonlit DK.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="relative border-y border-sky-200 bg-gradient-to-br from-sky-50 via-indigo-50 to-violet-50 py-16 dark:border-sky-900 dark:from-sky-950/40 dark:via-indigo-950/40 dark:to-violet-950/40">
    <div class="max-w-6xl mx-auto grid gap-12 px-6 lg:grid-cols-[1.1fr_0.9fr] lg:px-12">
        <div class="space-y-4">
            <p class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.4em] text-transparent bg-gradient-to-r from-sky-600 to-indigo-600 bg-clip-text">👥 Community + learning</p>
            <h2 class="text-3xl font-semibold tracking-tight text-zinc-900 dark:text-white">Threads, classes, and drops you can preview from home.</h2>
            <p class="text-base text-zinc-600 dark:text-zinc-300">Tap into upcoming events, trending threads, and spotlight drops without leaving the homepage. Each tile mirrors the feel of the community hub.</p>
            <div class="space-y-4">
                <article class="rounded-3xl border border-sky-300/80 bg-gradient-to-br from-sky-100 to-indigo-100 p-6 shadow-xl shadow-sky-200/40 dark:border-sky-500/40 dark:from-sky-900/50 dark:to-indigo-900/50">
                    <div class="flex items-center gap-3">
                        <div class="h-14 w-14 rounded-2xl bg-gradient-to-br from-emerald-500 via-teal-500 to-sky-500 p-0.5 shadow-lg">
                            <div class="flex h-full items-center justify-center rounded-[14px] bg-gradient-to-br from-emerald-400 to-sky-500 text-2xl font-bold text-white">G</div>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-sky-900 dark:text-white">Guild check-in</p>
                            <p class="flex items-center gap-1 text-xs font-semibold uppercase tracking-widest text-sky-700 dark:text-sky-100">⏱️ Starts in 45 minutes</p>
                        </div>
                    </div>
                    <p class="mt-4 text-sm text-sky-900/90 dark:text-sky-50">🔥 Palette swaps thread is hot · 💬 18 typing · 📊 2 polls closing soon.</p>
                </article>
                <article class="rounded-3xl border border-amber-300/80 bg-gradient-to-br from-amber-100 to-orange-100 p-6 shadow-xl shadow-amber-200/40 dark:border-amber-500/40 dark:from-amber-900/50 dark:to-orange-900/50">
                    <div class="flex items-center gap-3">
                        <div class="h-14 w-14 rounded-2xl bg-gradient-to-br from-amber-500 via-orange-500 to-rose-500 p-0.5 shadow-lg">
                            <div class="flex h-full items-center justify-center rounded-[14px] bg-gradient-to-br from-amber-400 to-rose-500 text-2xl font-bold text-white">S</div>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-amber-900 dark:text-white">Spotlight drop</p>
                            <p class="flex items-center gap-1 text-xs font-semibold uppercase tracking-widest text-amber-700 dark:text-amber-100">✨ Aurora Fade Shawl</p>
                        </div>
                    </div>
                    <p class="mt-4 text-sm text-amber-900/90 dark:text-amber-50">👥 128 makers contributed · 🧶 14 suppliers · 🎥 replays and kit links pinned.</p>
                </article>
            </div>
        </div>
        <div class="relative overflow-hidden rounded-[2.5rem] border border-violet-300/80 bg-gradient-to-br from-fuchsia-500 via-violet-500 via-sky-500 to-emerald-500 p-8 text-white shadow-2xl shadow-violet-500/40 dark:border-violet-500/60">
            <div class="absolute right-0 top-0 h-32 w-32 -translate-y-8 translate-x-8 rounded-full bg-white/20 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 h-28 w-28 translate-x-4 translate-y-4 rounded-full bg-white/10 blur-2xl"></div>
            <div class="relative flex items-center justify-between text-xs font-bold uppercase tracking-widest text-white/90">
                <span class="flex items-center gap-1">📊 Community metrics</span>
                <span class="inline-flex h-2 w-2 animate-pulse rounded-full bg-white"></span>
            </div>
            <div class="mt-10 grid gap-6 text-sm">
                <div>
                    <p class="text-white/70">Monthly makers onboarded</p>
                    <p class="text-4xl font-semibold">+640</p>
                </div>
                <div>
                    <p class="text-white/70">Patterns launched this week</p>
                    <p class="text-4xl font-semibold">87</p>
                </div>
                <div>
                    <p class="text-white/70">Shared checklists completed</p>
                    <p class="text-4xl font-semibold">1,204</p>
                </div>
            </div>
            <div class="mt-10 rounded-3xl bg-white/10 p-5 backdrop-blur">
                <p class="text-xs uppercase tracking-[0.4em] text-white/70">Next up</p>
                <p class="mt-3 text-lg font-semibold">Live finishing class</p>
                <p class="text-sm text-white/80">Blocking masterclass with Nova Fibers · replay auto-saved.</p>
            </div>
        </div>
    </div>
</section>

<section class="bg-gradient-to-br from-violet-50 via-fuchsia-50 to-rose-50 py-20 dark:from-violet-950/40 dark:via-fuchsia-950/40 dark:to-rose-950/40">
    <div class="max-w-5xl mx-auto px-6 text-center lg:px-12">
        <p class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.3em] text-transparent bg-gradient-to-r from-fuchsia-600 via-violet-600 to-rose-600 bg-clip-text">🎯 Everything in reach</p>
        <h2 class="mt-3 bg-gradient-to-r from-violet-600 via-fuchsia-600 to-rose-600 bg-clip-text text-3xl font-bold tracking-tight text-transparent dark:from-violet-400 dark:via-fuchsia-400 dark:to-rose-400">Jump from this homepage into any part of Yarnly with confidence.</h2>
        <p class="mt-4 text-base text-zinc-600 dark:text-zinc-300">Pick a slice—projects, patterns, stash, or community—and continue exactly where the preview left off.</p>

        <div class="mt-10 flex flex-wrap justify-center gap-4">
            @guest
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-fuchsia-600 via-violet-600 to-sky-600 px-10 py-4 text-sm font-bold text-white shadow-2xl shadow-violet-500/50 transition hover:scale-110 hover:shadow-violet-600/60">
                <span>✨</span> Create free account
            </a>
            @endif
            @else
            <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-fuchsia-600 via-violet-600 to-sky-600 px-10 py-4 text-sm font-bold text-white shadow-2xl shadow-violet-500/50 transition hover:scale-110 hover:shadow-violet-600/60">
                <span>🚀</span> Continue in dashboard
            </a>
            @endguest
            <a href="#flyover" class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-violet-300 bg-white/80 px-10 py-4 text-sm font-bold text-violet-700 shadow-lg transition hover:border-violet-400 hover:bg-white dark:border-violet-700 dark:bg-zinc-900/80 dark:text-violet-300 dark:hover:border-violet-600">
                Explore the pieces
            </a>
        </div>
    </div>
</section>

@endsection