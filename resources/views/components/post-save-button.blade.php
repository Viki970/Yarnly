{{-- Usage: <x-post-save-button :post="$post" :favorited="$favorited" /> --}}
@auth
<form method="POST"
      action="{{ $favorited ? route('posts.unfavorite', $post) : route('posts.favorite', $post) }}"
      class="inline">
    @csrf
    @if($favorited) @method('DELETE') @endif
    <button type="submit"
            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-semibold transition-all duration-200
                   {{ $favorited
                       ? 'bg-violet-100 text-violet-600 hover:bg-violet-200 dark:bg-violet-900/30 dark:text-violet-400 dark:hover:bg-violet-900/50'
                       : 'bg-zinc-100 text-zinc-600 hover:bg-violet-50 hover:text-violet-500 dark:bg-zinc-800 dark:text-zinc-400 dark:hover:bg-violet-900/20 dark:hover:text-violet-400' }}">
        <svg class="w-4 h-4" fill="{{ $favorited ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
        </svg>
        <span>{{ $favorited ? 'Saved' : 'Save' }}</span>
    </button>
</form>
@else
<a href="{{ route('login') }}"
   class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-semibold bg-zinc-100 text-zinc-500 hover:bg-violet-50 hover:text-violet-400 transition-all duration-200 dark:bg-zinc-800 dark:text-zinc-400">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
    </svg>
    <span>Save</span>
</a>
@endauth
