@extends('layout.app')

@section('title', 'Saved Posts')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-violet-50 via-white to-purple-50 dark:from-zinc-950 dark:via-zinc-900 dark:to-violet-950/10 py-12">
    <div class="container mx-auto px-4 max-w-6xl">

        <!-- Header -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-br from-violet-100 to-purple-100 dark:from-violet-900/30 dark:to-purple-900/30 shadow-inner mb-4">
                <svg class="w-8 h-8 text-violet-500 dark:text-violet-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                </svg>
            </div>
            <h1 class="text-4xl font-extrabold tracking-tight mb-2">
                <span class="bg-gradient-to-r from-violet-700 via-purple-500 to-violet-400 dark:from-violet-300 dark:via-purple-200 dark:to-violet-200 bg-clip-text text-transparent">
                    Saved Posts
                </span>
            </h1>
            <div class="flex items-center justify-center gap-2 mb-3">
                <span class="h-px w-12 bg-gradient-to-r from-transparent to-violet-400 rounded-full"></span>
                <span class="text-violet-500 dark:text-violet-300 text-xs font-semibold uppercase tracking-widest">{{ $posts->total() }} {{ Str::plural('post', $posts->total()) }}</span>
                <span class="h-px w-12 bg-gradient-to-l from-transparent to-violet-400 rounded-full"></span>
            </div>
            <p class="text-zinc-500 dark:text-zinc-400 text-sm">Your personal collection of saved posts</p>
        </div>

        @if($posts->isEmpty())
        <div class="flex flex-col items-center justify-center py-24 text-center">
            <div class="w-24 h-24 rounded-full bg-violet-50 dark:bg-violet-900/20 flex items-center justify-center mb-6">
                <svg class="w-12 h-12 text-violet-300 dark:text-violet-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-zinc-700 dark:text-zinc-300 mb-2">No saved posts yet</h3>
            <p class="text-zinc-500 dark:text-zinc-400 text-sm mb-6">Hit the bookmark icon on any post to save it here</p>
            <a href="{{ route('posts.index') }}"
               class="px-6 py-3 rounded-full bg-gradient-to-r from-violet-500 to-purple-500 text-white font-semibold hover:from-violet-600 hover:to-purple-600 transition-all shadow-md shadow-violet-200 dark:shadow-violet-900/30">
                Browse Posts
            </a>
        </div>
        @else
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @foreach($posts as $post)
            <x-post-card :post="$post" />
            @endforeach
        </div>

        @if($posts->hasPages())
        <div class="mt-10 flex justify-center">
            {{ $posts->links() }}
        </div>
        @endif
        @endif

    </div>
</div>
@endsection
