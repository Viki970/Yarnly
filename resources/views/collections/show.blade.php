@extends('layout.app')

@section('title', $collection->name . ' - Yarnly')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-teal-50 via-white to-emerald-50 dark:from-zinc-950 dark:via-zinc-900 dark:to-teal-950/20">
    <!-- Collection Header -->
    <section class="relative overflow-hidden bg-gradient-to-br from-emerald-50 via-teal-50 to-sky-50 dark:from-emerald-950/30 dark:via-teal-950/30 dark:to-sky-950/30 py-16">
        <div class="absolute -left-20 top-10 h-48 w-48 rounded-full bg-emerald-300/30 blur-3xl dark:bg-emerald-700/30"></div>
        <div class="absolute -right-12 bottom-10 h-64 w-64 rounded-full bg-teal-300/25 blur-3xl dark:bg-teal-700/25"></div>
        
        <div class="relative max-w-6xl mx-auto px-6 lg:px-12">
            <div class="flex items-center gap-3 mb-4">
                <a href="{{ route('my-collections') }}" class="text-sm font-semibold text-emerald-700 dark:text-emerald-300 hover:underline underline-offset-4">
                    ← Back to My Collections
                </a>
            </div>

            @if($collection->cover_image_path)
                <div class="mb-8 aspect-[21/9] w-full overflow-hidden rounded-2xl shadow-2xl">
                    <img src="{{ asset('storage/' . $collection->cover_image_path) }}" 
                        alt="{{ $collection->name }}" 
                        class="h-full w-full object-cover">
                </div>
            @endif

            <div class="bg-white/80 dark:bg-zinc-900/70 backdrop-blur rounded-2xl p-8 shadow-xl ring-1 ring-emerald-100 dark:ring-emerald-900/40">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="inline-flex items-center rounded-lg px-3 py-1.5 text-xs font-semibold bg-
                                @if($collection->craft_type === 'crochet')
                                    emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-200
                                @elseif($collection->craft_type === 'knitting')
                                    blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-200
                                @else
                                    purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-200
                                @endif
                            ">
                                {{ ucfirst($collection->craft_type) }}
                            </span>
                            @if($collection->is_public)
                                <span class="inline-flex items-center rounded-lg px-3 py-1.5 text-xs font-semibold bg-teal-100 text-teal-700 dark:bg-teal-900/40 dark:text-teal-200">
                                    <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Public
                                </span>
                            @else
                                <span class="inline-flex items-center rounded-lg px-3 py-1.5 text-xs font-semibold bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                    <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                    Private
                                </span>
                            @endif
                        </div>
                        <h1 class="text-4xl font-bold text-emerald-900 dark:text-white mb-3">{{ $collection->name }}</h1>
                        @if($collection->description)
                            <p class="text-lg text-zinc-600 dark:text-zinc-300 leading-relaxed">{{ $collection->description }}</p>
                        @endif
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-emerald-100 dark:border-emerald-900/40 flex items-center justify-between">
                    <div class="flex items-center gap-6">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center text-white font-bold">
                                {{ substr($collection->user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-xs text-zinc-600 dark:text-zinc-400">Created by</p>
                                <p class="text-sm font-semibold text-zinc-900 dark:text-white">{{ $collection->user->name }}</p>
                            </div>
                        </div>
                        <div class="h-8 w-px bg-emerald-200 dark:bg-emerald-800"></div>
                        <div>
                            <p class="text-xs text-zinc-600 dark:text-zinc-400">Created</p>
                            <p class="text-sm font-semibold text-zinc-900 dark:text-white">{{ $collection->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-zinc-600 dark:text-zinc-400">Patterns</p>
                        <p class="text-3xl font-bold text-
                            @if($collection->craft_type === 'crochet')
                                emerald-600 dark:text-emerald-400
                            @elseif($collection->craft_type === 'knitting')
                                blue-600 dark:text-blue-400
                            @else
                                purple-600 dark:text-purple-400
                            @endif
                        ">{{ $collection->patterns->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Patterns Section -->
    <section class="py-12">
        <div class="max-w-6xl mx-auto px-6 lg:px-12">
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-zinc-900 dark:text-white mb-2">Patterns in this collection</h2>
                    <p class="text-zinc-600 dark:text-zinc-400">{{ $collection->patterns->count() }} {{ Str::plural('pattern', $collection->patterns->count()) }} ready to start</p>
                </div>
                @if($collection->patterns->count() > 0 && $collection->patterns->where('pdf_file', '!=', null)->count() > 0)
                    <a href="{{ route('collections.downloadAll', $collection) }}" 
                       class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-emerald-600 to-teal-600 px-6 py-3 text-sm font-semibold text-white shadow-lg transition hover:from-emerald-700 hover:to-teal-700 hover:shadow-xl transform hover:-translate-y-0.5">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Download All Patterns
                    </a>
                @endif
            </div>

            @if($collection->patterns->count() > 0)
                <div class="grid gap-6 md:grid-cols-3">
                    @foreach($collection->patterns as $pattern)
                        <article class="group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-emerald-900/40 dark:bg-zinc-900/70">
                            @if($pattern->image_path)
                                <div class="mb-4 aspect-[3/4] w-full overflow-hidden rounded-xl bg-zinc-100 dark:bg-zinc-800">
                                    <img 
                                        src="{{ asset('storage/' . $pattern->image_path) }}" 
                                        alt="{{ $pattern->title }}"
                                        class="h-full w-full object-cover" 
                                        loading="lazy">
                                </div>
                            @endif
                            <div class="flex items-center justify-between">
                                <div class="rounded-lg px-3 py-1 text-xs font-semibold 
                                    @if($pattern->difficulty === 'beginner') 
                                        bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-200 
                                    @elseif($pattern->difficulty === 'intermediate') 
                                        bg-teal-100 text-teal-800 dark:bg-teal-900/40 dark:text-teal-200 
                                    @else 
                                        bg-orange-100 text-orange-800 dark:bg-orange-900/40 dark:text-orange-200 
                                    @endif">
                                    {{ ucfirst($pattern->difficulty) }}
                                </div>
                                @if($pattern->estimated_hours)
                                    <span class="text-xs font-medium text-emerald-700 dark:text-emerald-200">≈ {{ $pattern->estimated_hours }} hrs</span>
                                @endif
                            </div>
                            <h3 class="mt-4 text-lg font-bold text-zinc-900 dark:text-white">{{ $pattern->title }}</h3>
                            <div class="mt-4 flex items-center justify-between">
                                <div class="flex items-center gap-3 text-xs font-semibold text-emerald-700 dark:text-emerald-200">
                                    <span class="inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                                    <span>{{ $pattern->makers_saved }}</span> makers saved
                                </div>
                                @auth
                                    <button class="favorite-btn p-2 rounded-full transition-all duration-200 hover:scale-110 {{ Auth::user()->hasFavorited($pattern) ? 'text-pink-600 hover:text-pink-700' : 'text-zinc-400 hover:text-pink-500' }}"
                                            data-pattern-id="{{ $pattern->id }}"
                                            data-favorited="{{ Auth::user()->hasFavorited($pattern) ? 'true' : 'false' }}">
                                        <svg class="h-5 w-5 {{ Auth::user()->hasFavorited($pattern) ? 'fill-current' : '' }}" fill="{{ Auth::user()->hasFavorited($pattern) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                @endauth
                            </div>
                            @if($pattern->pdf_file)
                                <div class="mt-5 flex gap-2">
                                    <a href="{{ route('patterns.view', $pattern->id) }}" class="flex-1 rounded-lg bg-teal-600 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-teal-700">View Pattern</a>
                                    <a href="{{ route('patterns.download', $pattern) }}" class="flex-1 rounded-lg bg-emerald-600 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-emerald-700 dark:hover:bg-emerald-500">Download PDF</a>
                                </div>
                            @else
                                <button disabled class="mt-5 block w-full rounded-lg bg-zinc-200 px-4 py-2 text-center text-sm font-semibold text-zinc-500 cursor-not-allowed dark:bg-zinc-700 dark:text-zinc-400">PDF Coming Soon</button>
                            @endif
                        </article>
                    @endforeach
                </div>
            @else
                <div class="mt-8 rounded-2xl border border-dashed border-emerald-200 bg-emerald-50 p-12 text-center dark:border-emerald-900/40 dark:bg-zinc-900/70">
                    <h3 class="text-lg font-bold text-emerald-900 dark:text-white">No patterns yet</h3>
                    <p class="mt-2 text-sm text-emerald-700 dark:text-emerald-300">This collection is empty. Add some patterns to get started!</p>
                </div>
            @endif
        </div>
    </section>
</div>

@auth
<script>
    // Favorite button functionality
    document.querySelectorAll('.favorite-btn').forEach(button => {
        button.addEventListener('click', async function(e) {
            e.preventDefault();
            const patternId = this.dataset.patternId;
            const isFavorited = this.dataset.favorited === 'true';
            
            try {
                const response = await fetch(`/patterns/${patternId}/toggle-favorite`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Toggle the button state
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
                    
                    // Update makers saved count
                    const makersSavedElement = this.closest('article').querySelector('.makers-saved-' + patternId);
                    if (makersSavedElement) {
                        const currentCount = parseInt(makersSavedElement.textContent);
                        makersSavedElement.textContent = data.favorited ? currentCount + 1 : currentCount - 1;
                    }
                }
            } catch (error) {
                console.error('Error toggling favorite:', error);
            }
        });
    });
</script>
@endauth
@endsection
