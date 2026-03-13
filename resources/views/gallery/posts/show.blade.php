@extends('layout.app')

@section('title', 'Post by ' . $post->user->name . ' · Yarnly')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

    {{-- Back link --}}
    <a href="{{ route('models.gallery') }}"
       class="inline-flex items-center gap-1.5 text-sm text-zinc-500 dark:text-zinc-400 hover:text-purple-600 dark:hover:text-purple-400 mb-6 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to Gallery
    </a>

    {{-- ── Image gallery ── --}}
    @if($post->images->count() > 0)
        @if($post->images->count() === 1)
        <div class="rounded-2xl overflow-hidden bg-zinc-100 dark:bg-zinc-800 mb-6">
            <img src="{{ asset('storage/' . $post->images->first()->image_path) }}"
                 alt="Post image"
                 class="w-full object-cover max-h-[560px]">
        </div>
        @else
        <div class="grid grid-cols-2 gap-2 mb-6">
            @foreach($post->images as $index => $image)
            <div class="rounded-xl overflow-hidden bg-zinc-100 dark:bg-zinc-800 {{ $index === 0 && $post->images->count() % 2 !== 0 ? 'col-span-2' : '' }}">
                <img src="{{ asset('storage/' . $image->image_path) }}"
                     alt="Post image {{ $index + 1 }}"
                     class="w-full h-64 object-cover">
            </div>
            @endforeach
        </div>
        @endif
    @endif

    {{-- ── Post info ── --}}
    <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 p-5 mb-4">

        {{-- Author row --}}
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('users.show', $post->user) }}" class="block shrink-0">
                @if($post->user->profile_picture)
                    <img src="{{ asset('storage/' . $post->user->profile_picture) }}"
                         alt="{{ $post->user->name }}"
                         class="w-10 h-10 rounded-full object-cover">
                @else
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-violet-400 to-purple-500 flex items-center justify-center text-white text-sm font-bold">
                        {{ strtoupper(substr($post->user->name, 0, 1)) }}
                    </div>
                @endif
                </a>
                <div>
                    <a href="{{ route('users.show', $post->user) }}" class="text-sm font-semibold text-zinc-800 dark:text-zinc-200 hover:underline">{{ $post->user->name }}</a>
                    <p class="text-xs text-zinc-400">{{ $post->created_at->diffForHumans() }}</p>
                </div>
            </div>

            {{-- Craft badge --}}
            @php
                $craftColors = [
                    'crochet'    => 'bg-sky-100 text-sky-700 dark:bg-sky-900/40 dark:text-sky-300',
                    'knitting'   => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300',
                    'embroidery' => 'bg-rose-100 text-rose-700 dark:bg-rose-900/40 dark:text-rose-300',
                ];
                $craftEmojis = ['crochet' => '🧶', 'knitting' => '🪡', 'embroidery' => '🪢'];
            @endphp
            <span class="text-xs font-semibold px-3 py-1 rounded-full {{ $craftColors[$post->craft_type] ?? 'bg-zinc-100 text-zinc-600' }}">
                {{ $craftEmojis[$post->craft_type] ?? '' }} {{ ucfirst($post->craft_type) }}
            </span>
        </div>

        {{-- Description --}}
        @if($post->description)
        <p class="text-sm text-zinc-700 dark:text-zinc-300 leading-relaxed mb-4">{{ $post->description }}</p>
        @endif

        {{-- Tags --}}
        @if($post->tags)
        <div class="flex flex-wrap gap-1.5 mb-4">
            @foreach($post->tags_array as $tag)
            <span class="text-xs bg-zinc-100 dark:bg-zinc-800 text-zinc-500 dark:text-zinc-400 px-2.5 py-1 rounded-full">#{{ $tag }}</span>
            @endforeach
        </div>
        @endif

        {{-- Actions --}}
        <div class="flex items-center gap-3 pt-3 border-t border-zinc-100 dark:border-zinc-800">
            <x-post-like-button :post="$post" :liked="$liked" />
            <x-post-save-button :post="$post" :favorited="$favorited" />

            {{-- Comment count badge --}}
            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-semibold bg-zinc-100 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <span>{{ $post->comments_count }}</span>
            </span>

            {{-- Delete button (only for post owner) --}}
            @auth
            @if(Auth::id() === $post->user_id)
            <form method="POST" action="{{ route('posts.destroy', $post) }}" class="ml-auto"
                  onsubmit="return confirm('Delete this post? This cannot be undone.')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="text-xs text-red-500 hover:text-red-600 dark:text-red-400 font-semibold transition-colors">
                    Delete Post
                </button>
            </form>
            @endif
            @endauth
        </div>
    </div>

    {{-- ── Comments (Livewire) ── --}}
    <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 p-5">
        <livewire:post-comments :postId="$post->id" />
    </div>

</div>
@endsection
