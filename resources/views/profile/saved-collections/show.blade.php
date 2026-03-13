@extends('layout.app')

@section('title', $postCollection->name . ' · Saved Collection · Yarnly')

@section('content')
<div class="min-h-screen bg-zinc-950 text-white">
    <div class="mx-auto max-w-3xl px-4 py-10">

        {{-- Header --}}
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('profile.show') }}#saved"
               class="text-zinc-400 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div class="flex-1 min-w-0">
                <h1 id="collection-title" class="text-2xl font-bold truncate">{{ $postCollection->name }}</h1>
                <p class="text-sm text-zinc-400">{{ $posts->count() }} {{ Str::plural('post', $posts->count()) }}</p>
            </div>
            {{-- Rename button --}}
            <button onclick="openRenameModal()"
                    class="text-zinc-400 hover:text-white transition-colors p-2 rounded-lg hover:bg-zinc-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </button>
            {{-- Delete button --}}
            <button onclick="deleteCollection()"
                    class="text-zinc-400 hover:text-red-400 transition-colors p-2 rounded-lg hover:bg-zinc-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </button>
        </div>

        {{-- Posts grid --}}
        @if($posts->isEmpty())
        <div class="flex flex-col items-center justify-center py-24 text-center">
            <div class="w-20 h-20 rounded-full border-2 border-zinc-700 flex items-center justify-center mb-5">
                <svg class="w-10 h-10 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold mb-2">This collection is empty</h3>
            <p class="text-zinc-400 text-sm">Go to your Saved posts and add some to this collection.</p>
            <a href="{{ route('profile.show') }}#saved"
               class="mt-5 px-5 py-2 rounded-full bg-white text-black text-sm font-semibold hover:bg-zinc-200 transition-colors">
                View Saved Posts
            </a>
        </div>
        @else
        <div class="grid grid-cols-3 gap-0.5">
            @foreach($posts as $post)
            @php
                $firstImg  = $post->images->first();
                $imgUrl    = $firstImg ? asset('storage/' . $firstImg->image_path) : null;
                $multiImg  = $post->images->count() > 1;
            @endphp
            <div class="relative group aspect-square overflow-hidden bg-zinc-900">
                <a href="{{ route('posts.show', $post) }}" class="block w-full h-full">
                    @if($imgUrl)
                        <img src="{{ $imgUrl }}" alt="Post" loading="lazy"
                             class="w-full h-full object-cover transition duration-300 group-hover:brightness-50 group-hover:scale-105">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-violet-900/50 to-purple-900/50 flex items-center justify-center transition duration-300 group-hover:brightness-50">
                            <svg class="w-8 h-8 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                    {{-- Multi-image badge --}}
                    @if($multiImg)
                    <div class="absolute top-2 right-2 z-10">
                        <svg class="w-5 h-5 text-white drop-shadow" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="7" y="3" width="14" height="14" rx="2"/>
                            <path d="M3 7v12a2 2 0 002 2h12"/>
                        </svg>
                    </div>
                    @endif
                </a>
                {{-- Remove from collection button (hover) --}}
                <button data-remove-post-id="{{ $post->id }}"
                        title="Remove from collection"
                        class="absolute top-2 left-2 z-10 opacity-0 group-hover:opacity-100 transition-opacity
                               w-7 h-7 flex items-center justify-center rounded-full bg-black/60 text-white hover:bg-red-600">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            @endforeach
        </div>
        @endif

    </div>
</div>

{{-- ── Remove Post Confirm Modal ── --}}
<div id="remove-post-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm">
    <div class="bg-zinc-900 border border-zinc-700 rounded-2xl w-full max-w-sm p-6 shadow-2xl">
        <h3 class="text-lg font-bold text-white mb-2">Remove Post?</h3>
        <p class="text-sm text-zinc-400 mb-6">This post will be removed from the collection. It won't be deleted.</p>
        <div class="flex gap-3 justify-end">
            <button onclick="document.getElementById('remove-post-modal').classList.add('hidden')"
                    class="px-5 py-2 text-sm font-semibold text-zinc-400 hover:text-white transition-colors rounded-xl bg-zinc-800 hover:bg-zinc-700">
                Cancel
            </button>
            <button id="remove-post-confirm-btn"
                    class="px-5 py-2 text-sm font-semibold bg-red-600 hover:bg-red-500 text-white rounded-xl transition-colors">
                Remove
            </button>
        </div>
    </div>
</div>

{{-- ── Delete Collection Confirm Modal ── --}}
<div id="delete-collection-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm">
    <div class="bg-zinc-900 border border-zinc-700 rounded-2xl w-full max-w-sm p-6 shadow-2xl">
        <h3 class="text-lg font-bold text-white mb-2">Delete Collection?</h3>
        <p class="text-sm text-zinc-400 mb-6">The collection will be deleted. Your saved posts won't be affected.</p>
        <div class="flex gap-3 justify-end">
            <button onclick="document.getElementById('delete-collection-modal').classList.add('hidden')"
                    class="px-5 py-2 text-sm font-semibold text-zinc-400 hover:text-white transition-colors rounded-xl bg-zinc-800 hover:bg-zinc-700">
                Cancel
            </button>
            <button id="delete-collection-confirm-btn"
                    class="px-5 py-2 text-sm font-semibold bg-red-600 hover:bg-red-500 text-white rounded-xl transition-colors">
                Delete
            </button>
        </div>
    </div>
</div>

{{-- ── Rename Modal ── --}}
<div id="rename-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm">
    <div class="bg-zinc-900 border border-zinc-700 rounded-2xl w-full max-w-sm p-6 shadow-2xl">
        <h3 class="text-lg font-bold text-white mb-4">Rename Collection</h3>
        <input id="rename-input" type="text" maxlength="100"
               value="{{ $postCollection->name }}"
               class="w-full rounded-xl bg-zinc-800 border border-zinc-700 text-white px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-violet-500 mb-4">
        <div class="flex gap-3 justify-end">
            <button onclick="document.getElementById('rename-modal').classList.add('hidden')"
                    class="px-4 py-2 text-sm font-semibold text-zinc-400 hover:text-white transition-colors">
                Cancel
            </button>
            <button onclick="submitRename()"
                    class="px-5 py-2 text-sm font-semibold bg-violet-600 hover:bg-violet-500 text-white rounded-xl transition-colors">
                Save
            </button>
        </div>
    </div>
</div>

<script id="sc-config" type="application/json">@json(['id' => $postCollection->id, 'csrf' => csrf_token()])</script>
<script>
const _scConfig       = JSON.parse(document.getElementById('sc-config').textContent);
const _collectionId   = _scConfig.id;
const _csrf           = _scConfig.csrf;
const _removePostUrl  = (pId) => `/saved-collections/${_collectionId}/posts`;
const _renameUrl      = `/saved-collections/${_collectionId}/rename`;
const _destroyUrl     = `/saved-collections/${_collectionId}`;

function openRenameModal() {
    document.getElementById('rename-input').value = document.getElementById('collection-title').textContent.trim();
    document.getElementById('rename-modal').classList.remove('hidden');
}

async function submitRename() {
    const name = document.getElementById('rename-input').value.trim();
    if (!name) return;

    const res = await fetch(_renameUrl, {
        method: 'PATCH',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': _csrf },
        body: JSON.stringify({ name }),
    });
    if (res.ok) {
        document.getElementById('collection-title').textContent = name;
        document.getElementById('rename-modal').classList.add('hidden');
    }
}

// Remove-post confirm modal
let _pendingRemovePostId  = null;
let _pendingRemoveTile    = null;

document.addEventListener('click', function(e) {
    const btn = e.target.closest('[data-remove-post-id]');
    if (!btn) return;
    _pendingRemovePostId = parseInt(btn.dataset.removePostId);
    _pendingRemoveTile   = btn.closest('.group');
    document.getElementById('remove-post-modal').classList.remove('hidden');
});

document.getElementById('remove-post-confirm-btn').addEventListener('click', async function() {
    if (!_pendingRemovePostId) return;
    document.getElementById('remove-post-modal').classList.add('hidden');
    const res = await fetch(_removePostUrl(_pendingRemovePostId), {
        method: 'DELETE',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': _csrf },
        body: JSON.stringify({ post_id: _pendingRemovePostId }),
    });
    if (res.ok) {
        _pendingRemoveTile && _pendingRemoveTile.remove();
    }
    _pendingRemovePostId = null;
    _pendingRemoveTile   = null;
});

// Delete-collection confirm modal
function deleteCollection() {
    document.getElementById('delete-collection-modal').classList.remove('hidden');
}

document.getElementById('delete-collection-confirm-btn').addEventListener('click', async function() {
    document.getElementById('delete-collection-modal').classList.add('hidden');
    const res = await fetch(_destroyUrl, {
        method: 'DELETE',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': _csrf },
    });
    if (res.ok) {
        window.location.href = '{{ route("profile.show") }}';
    }
});

// Close modals on backdrop click
['rename-modal', 'remove-post-modal', 'delete-collection-modal'].forEach(id => {
    document.getElementById(id).addEventListener('click', function(e) {
        if (e.target === this) this.classList.add('hidden');
    });
});
</script>
@endsection
