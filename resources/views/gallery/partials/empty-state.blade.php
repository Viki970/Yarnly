{{-- Empty state for gallery tabs --}}
<div class="flex flex-col items-center justify-center py-24 text-center">
    <div class="mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-purple-100 dark:bg-purple-900/30">
        <svg class="h-10 w-10 text-purple-400 dark:text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
    </div>
    <h3 class="text-xl font-bold text-zinc-900 dark:text-white">No posts yet</h3>
    <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400 max-w-xs">
        Nothing in the <span class="font-semibold text-purple-600 dark:text-purple-400">{{ $tab }}</span> feed yet.
        Be the first to share something!
    </p>
    @auth
        <a href="{{ route('posts.create') }}"
           class="mt-6 flex items-center gap-2 rounded-xl bg-gradient-to-r from-purple-600 to-violet-600 px-6 py-2.5 text-sm font-semibold text-white shadow-lg hover:from-purple-500 hover:to-violet-500 transition-all">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Share your first post
        </a>
    @else
        <a href="{{ route('login') }}"
           class="mt-6 rounded-xl bg-gradient-to-r from-purple-600 to-violet-600 px-6 py-2.5 text-sm font-semibold text-white shadow-lg hover:from-purple-500 hover:to-violet-500 transition-all">
            Sign in to share
        </a>
    @endauth
</div>
