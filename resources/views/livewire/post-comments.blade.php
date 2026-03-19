<?php

use App\Models\PostComment;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {

    public int $postId;
    public string $body = '';

    public function mount(int $postId): void
    {
        $this->postId = $postId;
    }

    public function addComment(): void
    {
        if (! Auth::check()) {
            $this->redirect(route('login'));
            return;
        }

        $this->validate([
            'body' => ['required', 'string', 'max:500'],
        ]);

        PostComment::create([
            'post_id' => $this->postId,
            'user_id' => Auth::id(),
            'body'    => $this->body,
        ]);

        $this->body = '';
    }

    public function with(): array
    {
        return [
            'comments' => PostComment::with('user')
                ->where('post_id', $this->postId)
                ->oldest()
                ->get(),
        ];
    }
};
?>

<div class="mt-8">
    <h3 class="text-base font-semibold text-zinc-800 dark:text-zinc-200 mb-4">
        Comments ({{ $comments->count() }})
    </h3>

    {{-- Comments list --}}
    <div class="space-y-4 mb-6">
        @forelse($comments as $comment)
        <div class="flex gap-3">
            {{-- Avatar --}}
            @if($comment->user->hasProfileImage())
                <img src="{{ asset('storage/' . $comment->user->profile_picture) }}"
                     alt="{{ $comment->user->name }}"
                     class="flex-shrink-0 w-8 h-8 rounded-full object-cover">
            @else
                @php $cAvatarColor = $comment->user->avatarColor(); @endphp
                <div class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center text-white text-xs font-bold {{ $cAvatarColor ? '' : 'bg-gradient-to-br from-violet-400 to-purple-500' }}"
                     {!! $cAvatarColor ? 'style="background-color: ' . e($cAvatarColor) . '"' : '' !!}>
                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                </div>
            @endif

            {{-- Content --}}
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2 mb-0.5">
                    <span class="text-sm font-semibold text-zinc-800 dark:text-zinc-200">{{ $comment->user->name }}</span>
                    <span class="text-xs text-zinc-400">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-sm text-zinc-600 dark:text-zinc-400 break-words">{{ $comment->body }}</p>
            </div>
        </div>
        @empty
        <p class="text-sm text-zinc-400 italic text-center py-4">No comments yet. Be the first!</p>
        @endforelse
    </div>

    {{-- Comment form --}}
    @auth
    <form wire:submit.prevent="addComment" class="flex gap-3">
        {{-- Commenter avatar --}}
        @if(Auth::user()->hasProfileImage())
            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                 alt="{{ Auth::user()->name }}"
                 class="flex-shrink-0 w-8 h-8 rounded-full object-cover mt-1">
        @else
            @php $authAvatarColor = Auth::user()->avatarColor(); @endphp
            <div class="flex-shrink-0 w-8 h-8 mt-1 rounded-full flex items-center justify-center text-white text-xs font-bold {{ $authAvatarColor ? '' : 'bg-gradient-to-br from-violet-400 to-purple-500' }}"
                 {!! $authAvatarColor ? 'style="background-color: ' . e($authAvatarColor) . '"' : '' !!}>
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        @endif

        <div class="flex-1">
            <textarea
                wire:model="body"
                placeholder="Add a comment…"
                rows="2"
                maxlength="500"
                class="w-full rounded-xl border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-800 px-3 py-2 text-sm text-zinc-700 dark:text-zinc-300 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-purple-400 resize-none transition"
            ></textarea>
            @error('body')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror

            <div class="flex justify-end mt-2">
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="px-4 py-1.5 rounded-full bg-purple-600 text-white text-sm font-semibold hover:bg-purple-700 disabled:opacity-50 transition-colors duration-200">
                    <span wire:loading.remove wire:target="addComment">Post</span>
                    <span wire:loading wire:target="addComment">Posting…</span>
                </button>
            </div>
        </div>
    </form>
    @else
    <a href="{{ route('login') }}"
       class="block w-full text-center text-sm text-purple-600 dark:text-purple-400 hover:underline py-2 rounded-xl border border-dashed border-purple-300 dark:border-purple-700">
        Sign in to leave a comment
    </a>
    @endauth
</div>
