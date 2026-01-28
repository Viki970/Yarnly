@extends('layout.app')

@section('title', 'My Favorites - Yarnly')

@section('content')
<section class="relative overflow-hidden bg-gradient-to-br from-pink-50 via-rose-50 to-red-50 py-16 dark:from-pink-950/30 dark:via-rose-950/30 dark:to-red-950/30">
    <div class="absolute -left-20 top-10 h-48 w-48 rounded-full bg-pink-300/30 blur-3xl dark:bg-pink-700/30"></div>
    <div class="absolute -right-12 bottom-10 h-64 w-64 rounded-full bg-rose-300/25 blur-3xl dark:bg-rose-700/25"></div>
    <div class="relative max-w-6xl mx-auto px-6 lg:px-12">
        <p class="inline-flex items-center gap-2 rounded-full bg-white/70 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-pink-700 ring-1 ring-pink-200 dark:bg-zinc-900/70 dark:text-pink-200 dark:ring-pink-800/60">
            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
            </svg>
            My Collection
        </p>
        <div class="mt-6 flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div class="max-w-3xl">
                <h1 class="text-4xl font-bold tracking-tight text-pink-900 sm:text-5xl dark:text-white">Your favorite patterns</h1>
                <p class="mt-4 text-lg leading-relaxed text-zinc-600 dark:text-zinc-300">
                    All the crochet patterns you've saved for later. Your personal collection of inspiration and future projects.
                </p>
            </div>
            <div class="rounded-2xl bg-white/80 p-6 shadow-xl ring-1 ring-pink-100 backdrop-blur dark:bg-zinc-900/70 dark:ring-pink-900/40">
                <div class="text-center">
                    <p class="text-sm font-medium text-pink-600 dark:text-pink-400">Saved patterns</p>
                    <p class="mt-2 text-3xl font-bold text-pink-900 dark:text-white">{{ $favoritePatterns->count() }}</p>
                    <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-300">Ready to create</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-white py-12 dark:bg-zinc-900">
    <div class="max-w-6xl mx-auto px-6 lg:px-12">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-pink-700 dark:text-pink-200">Your collection</p>
                <h2 class="text-3xl font-bold text-zinc-900 dark:text-white">Favorite patterns</h2>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">Patterns you've saved to create later</p>
            </div>
            <a href="{{ route('patterns.crochet') }}" class="text-sm font-semibold text-zinc-600 underline-offset-4 hover:underline dark:text-zinc-300">Browse more patterns</a>
        </div>

        @if($favoritePatterns && $favoritePatterns->count() > 0)
            <div class="mt-8 grid gap-6 md:grid-cols-3">
                @foreach($favoritePatterns as $pattern)
                    <article class="group rounded-2xl border border-pink-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-pink-900/40 dark:bg-zinc-900/70">
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
                            <div class="rounded-lg px-3 py-1 text-xs font-semibold @if($pattern->difficulty === 'beginner') bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-200 @elseif($pattern->difficulty === 'intermediate') bg-teal-100 text-teal-800 dark:bg-teal-900/40 dark:text-teal-200 @else bg-orange-100 text-orange-800 dark:bg-orange-900/40 dark:text-orange-200 @endif">
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
                                <span class="inline-flex h-2 w-2 rounded-full bg-pink-500"></span>
                                <span class="makers-saved-{{ $pattern->id }}">{{ $pattern->makers_saved }}</span> makers saved
                            </div>
                            <button class="favorite-btn p-2 rounded-full transition-all duration-200 hover:scale-110 text-pink-600 hover:text-pink-700"
                                    data-pattern-id="{{ $pattern->id }}"
                                    data-favorited="true">
                                <svg class="h-5 w-5 fill-current" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>
                        @if($pattern->pdf_file)
                            <div class="mt-5 flex gap-2">
                                <a href="{{ route('patterns.view', $pattern->id) }}" class="flex-1 rounded-lg bg-teal-600 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-teal-700">View Pattern</a>
                                <a href="{{ asset('storage/' . $pattern->pdf_file) }}" download class="flex-1 rounded-lg bg-pink-600 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-pink-700">Download PDF</a>
                            </div>
                        @else
                            <button disabled class="mt-5 block w-full rounded-lg bg-zinc-200 px-4 py-2 text-center text-sm font-semibold text-zinc-500 cursor-not-allowed dark:bg-zinc-700 dark:text-zinc-400">PDF Coming Soon</button>
                        @endif
                        
                        <div class="mt-3 flex flex-wrap gap-1 text-xs font-semibold text-pink-700 dark:text-pink-200">
                            <span class="rounded-full bg-pink-100 px-2 py-1 dark:bg-pink-900/40">{{ $pattern->getCategoryLabel() }}</span>
                            <span class="rounded-full bg-pink-100 px-2 py-1 dark:bg-pink-900/40">Saved {{ $pattern->pivot->created_at->diffForHumans() }}</span>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="mt-12 rounded-2xl border border-dashed border-pink-200 bg-pink-50 p-12 text-center dark:border-pink-900/40 dark:bg-zinc-900/70">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-pink-100 dark:bg-pink-900/30">
                    <svg class="h-8 w-8 text-pink-600 dark:text-pink-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-pink-900 dark:text-white">No favorites yet</h3>
                <p class="mt-2 text-sm text-pink-700 dark:text-pink-300">Start exploring patterns and save your favorites by clicking the heart icon!</p>
                <a href="{{ route('patterns.crochet') }}" class="mt-6 inline-block rounded-lg bg-pink-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-pink-700">Browse Patterns</a>
            </div>
        @endif
    </div>
</section>

<script>
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
                        button.classList.add('text-pink-600', 'hover:text-pink-700');
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
                            // Update the counter
                            const counter = document.querySelector('.text-3xl.font-bold.text-pink-900');
                            if (counter) {
                                const currentCount = parseInt(counter.textContent);
                                counter.textContent = Math.max(0, currentCount - 1);
                            }
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