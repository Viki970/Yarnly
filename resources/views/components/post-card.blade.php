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

    $showFollowBtn = Auth::check() && Auth::id() !== $post->user_id;
    $isFollowing   = $showFollowBtn && Auth::user()->isFollowing($post->user);
    $followUrl     = $showFollowBtn ? route('users.follow',   $post->user_id) : '#';
    $unfollowUrl   = $showFollowBtn ? route('users.unfollow', $post->user_id) : '#';
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
                <a href="{{ route('users.show', $post->user) }}" class="w-7 h-7 rounded-full bg-gradient-to-br from-violet-400 to-purple-500 flex items-center justify-center text-white text-xs font-bold">
                    {{ strtoupper(substr($post->user->name, 0, 1)) }}
                </a>
                <a href="{{ route('users.show', $post->user) }}" class="text-sm font-medium text-zinc-700 dark:text-zinc-300 hover:underline">{{ $post->user->name }}</a>
                @if($showFollowBtn)
                <form method="POST"
                      action="{{ $isFollowing ? $unfollowUrl : $followUrl }}"
                      class="inline">
                    @csrf
                    @if($isFollowing) @method('DELETE') @endif
                    <button type="submit"
                            class="text-xs font-semibold px-2 py-0.5 rounded-full border transition-colors duration-200
                                   {{ $isFollowing
                                       ? 'border-zinc-300 text-zinc-500 hover:border-red-400 hover:text-red-500 dark:border-zinc-600 dark:text-zinc-400'
                                       : 'border-purple-400 text-purple-600 hover:bg-purple-500 hover:text-white dark:border-purple-500 dark:text-purple-400 dark:hover:bg-purple-600 dark:hover:text-white' }}">
                        {{ $isFollowing ? 'Following' : '+ Follow' }}
                    </button>
                </form>
                @endif
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

            {{-- Comment count --}}
            <a href="{{ route('posts.show', $post) }}"
               class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-semibold bg-zinc-100 text-zinc-600 hover:bg-purple-50 hover:text-purple-600 dark:bg-zinc-800 dark:text-zinc-400 dark:hover:bg-purple-900/20 dark:hover:text-purple-400 transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <span>{{ $post->comments_count }}</span>
            </a>

            <x-post-save-button :post="$post" :favorited="$favorited" />
        </div>
    </div>
</div>
