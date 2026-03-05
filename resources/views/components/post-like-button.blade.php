{{-- Usage: <x-post-like-button :post="$post" :liked="$liked" /> --}}
@auth
<form method="POST"
      action="{{ $liked ? route('posts.unlike', $post) : route('posts.like', $post) }}"
      class="inline">
    @csrf
    @if($liked) @method('DELETE') @endif
    <button type="submit"
            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-semibold transition-all duration-200
                   {{ $liked
                       ? 'bg-red-100 text-red-600 hover:bg-red-200 dark:bg-red-900/30 dark:text-red-400 dark:hover:bg-red-900/50'
                       : 'bg-zinc-100 text-zinc-600 hover:bg-red-50 hover:text-red-500 dark:bg-zinc-800 dark:text-zinc-400 dark:hover:bg-red-900/20 dark:hover:text-red-400' }}">
        <svg class="w-4 h-4 {{ $liked ? 'fill-current' : '' }}" fill="{{ $liked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
        </svg>
        <span>{{ $post->likes_count ?? $post->likes()->count() }}</span>
    </button>
</form>
@else
<a href="{{ route('login') }}"
   class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-semibold bg-zinc-100 text-zinc-500 hover:bg-red-50 hover:text-red-400 transition-all duration-200 dark:bg-zinc-800 dark:text-zinc-400">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
    </svg>
    <span>{{ $post->likes_count ?? $post->likes()->count() }}</span>
</a>
@endauth
