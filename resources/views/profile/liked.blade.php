@extends('layout.app')

@section('title', 'Liked Posts')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-red-50 via-white to-rose-50 dark:from-zinc-950 dark:via-zinc-900 dark:to-red-950/10 py-12">
    <div class="container mx-auto px-4 max-w-6xl">

        <!-- Header -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-br from-red-100 to-rose-100 dark:from-red-900/30 dark:to-rose-900/30 shadow-inner mb-4">
                <svg class="w-8 h-8 text-red-500 dark:text-red-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </div>
            <h1 class="text-4xl font-extrabold tracking-tight mb-2">
                <span class="bg-gradient-to-r from-red-600 via-rose-500 to-red-400 dark:from-red-300 dark:via-rose-200 dark:to-red-200 bg-clip-text text-transparent">
                    Liked Posts
                </span>
            </h1>
            <div class="flex items-center justify-center gap-2 mb-3">
                <span class="h-px w-12 bg-gradient-to-r from-transparent to-red-400 rounded-full"></span>
                <span class="text-red-500 dark:text-red-300 text-xs font-semibold uppercase tracking-widest">{{ $posts->total() }} {{ Str::plural('post', $posts->total()) }}</span>
                <span class="h-px w-12 bg-gradient-to-l from-transparent to-red-400 rounded-full"></span>
            </div>
            <p class="text-zinc-500 dark:text-zinc-400 text-sm">Posts you've shown some love to</p>
        </div>

        @if($posts->isEmpty())
        <div class="flex flex-col items-center justify-center py-24 text-center">
            <div class="w-24 h-24 rounded-full bg-red-50 dark:bg-red-900/20 flex items-center justify-center mb-6">
                <svg class="w-12 h-12 text-red-300 dark:text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-zinc-700 dark:text-zinc-300 mb-2">No liked posts yet</h3>
            <p class="text-zinc-500 dark:text-zinc-400 text-sm mb-6">Browse posts and heart the ones you love</p>
            <a href="{{ route('posts.index') }}"
               class="px-6 py-3 rounded-full bg-gradient-to-r from-red-500 to-rose-500 text-white font-semibold hover:from-red-600 hover:to-rose-600 transition-all shadow-md shadow-red-200 dark:shadow-red-900/30">
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
