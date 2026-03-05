{{-- Usage: <x-post-card :post="$post" /> --}}
@php
    $firstImage = $post->images->first();
    $liked      = Auth::check() && $post->isLikedBy(Auth::user());
    $favorited  = Auth::check() && $post->isFavoritedBy(Auth::user());
    $craftColors = [
        'crochet'    => 'bg-sky-100 text-sky-700 dark:bg-sky-900/40 dark:text-sky-300',
        'knitting'   => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300',
        'embroidery' => 'bg-rose-100 text-rose-700 dark:bg-rose-900/40 dark:text-rose-300',
    ];
    $craftEmojis = ['crochet' => '🧶', 'knitting' => '🪡', 'embroidery' => '🪢'];
@endphp

<div class="group bg-white dark:bg-zinc-900 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg border border-zinc-100 dark:border-zinc-800 transition-all duration-300">

    {{-- Image --}}
    <a href="{{ route('posts.show', $post) }}" class="block relative aspect-square overflow-hidden bg-zinc-100 dark:bg-zinc-800">
        @if($firstImage)
            <img src="{{ asset('storage/' . $firstImage->image_path) }}"
                 alt="Post by {{ $post->user->name }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            @if($post->images->count() > 1)
            <div class="absolute top-2 right-2 bg-black/50 backdrop-blur-sm text-white text-xs font-semibold px-2 py-1 rounded-full">
                1 / {{ $post->images->count() }}
            </div>
            @endif
        @else
            <div class="w-full h-full flex items-center justify-center text-zinc-300 dark:text-zinc-600">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        @endif
    </a>

    {{-- Body --}}
    <div class="p-4">
        {{-- Author + craft badge --}}
        <div class="flex items-center justify-between mb-3">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-full bg-gradient-to-br from-violet-400 to-purple-500 flex items-center justify-center text-white text-xs font-bold">
                    {{ strtoupper(substr($post->user->name, 0, 1)) }}
                </div>
                <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ $post->user->name }}</span>
            </div>
            <span class="text-xs font-semibold px-2 py-1 rounded-full {{ $craftColors[$post->craft_type] ?? 'bg-zinc-100 text-zinc-600' }}">
                {{ $craftEmojis[$post->craft_type] ?? '' }} {{ ucfirst($post->craft_type) }}
            </span>
        </div>

        {{-- Description --}}
        @if($post->description)
        <p class="text-sm text-zinc-600 dark:text-zinc-400 line-clamp-2 mb-3">{{ $post->description }}</p>
        @endif

        {{-- Tags --}}
        @if($post->tags)
        <div class="flex flex-wrap gap-1 mb-3">
            @foreach($post->tags_array as $tag)
            <span class="text-xs bg-zinc-100 dark:bg-zinc-800 text-zinc-500 dark:text-zinc-400 px-2 py-0.5 rounded-full">#{{ $tag }}</span>
            @endforeach
        </div>
        @endif

        {{-- Actions --}}
        <div class="flex items-center justify-between pt-2 border-t border-zinc-100 dark:border-zinc-800">
            <x-post-like-button :post="$post" :liked="$liked" />
            <x-post-save-button :post="$post" :favorited="$favorited" />
        </div>
    </div>
</div>
