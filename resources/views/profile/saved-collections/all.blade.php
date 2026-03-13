@extends('layout.app')

@section('title', 'All Posts · Saved · Yarnly')

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
                <h1 class="text-2xl font-bold">All Posts</h1>
                <p class="text-sm text-zinc-400">{{ $posts->count() }} {{ Str::plural('post', $posts->count()) }}</p>
            </div>
        </div>

        {{-- Posts grid --}}
        @if($posts->isEmpty())
        <div class="flex flex-col items-center justify-center py-24 text-center">
            <div class="w-20 h-20 rounded-full border-2 border-zinc-700 flex items-center justify-center mb-5">
                <svg class="w-10 h-10 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold mb-2">No saved posts yet</h3>
            <p class="text-zinc-400 text-sm">Save things you want to see again.</p>
        </div>
        @else
        <div class="grid grid-cols-3 gap-0.5">
            @foreach($posts as $post)
            @php
                $firstImg  = $post->images->first();
                $imgUrl    = $firstImg ? asset('storage/' . $firstImg->image_path) : null;
                $multiImg  = $post->images->count() > 1;
                $myColIds  = $postCollectionMemberships[$post->id] ?? [];
            @endphp
            <div class="relative group aspect-square overflow-hidden bg-zinc-900 cursor-pointer"
                 data-post-id="{{ $post->id }}"
                 data-post-url="{{ route('posts.show', $post) }}"
                 data-collection-ids="{{ json_encode($myColIds) }}">
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
                {{-- Add to collection button (hover) --}}
                <button data-add-btn
                        title="Add to collection"
                        class="absolute top-2 left-2 z-20 w-7 h-7 flex items-center justify-center rounded-full bg-black/60 text-white opacity-0 group-hover:opacity-100 transition-opacity hover:bg-violet-600"
                        onclick="openCollectionPicker(
                            parseInt(this.closest('[data-post-id]').dataset.postId),
                            JSON.parse(this.closest('[data-post-id]').dataset.collectionIds)
                        )">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                    </svg>
                </button>
            </div>
            @endforeach
        </div>
        @endif

    </div>
</div>

{{-- ══ "Add to Collection" Picker Modal ══ --}}
<div id="collection-picker-modal"
     class="hidden fixed inset-0 z-50 flex items-end sm:items-center justify-center p-4 bg-black/70 backdrop-blur-sm">
    <div class="bg-zinc-900 border border-zinc-700 rounded-2xl w-full max-w-sm shadow-2xl overflow-hidden">
        <div class="flex items-center justify-between px-5 pt-5 pb-3 border-b border-zinc-800">
            <h3 class="text-base font-bold text-white">Add to Collection</h3>
            <button onclick="closeCollectionPicker()" class="text-zinc-500 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div id="cp-collections-list" class="max-h-64 overflow-y-auto divide-y divide-zinc-800/60 py-1"></div>
        <div class="px-5 py-3 border-t border-zinc-800">
            <div id="cp-new-form" class="hidden mb-3">
                <input id="cp-new-name" type="text" maxlength="100" placeholder="Collection name"
                       class="w-full rounded-xl bg-zinc-800 border border-zinc-700 text-white text-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-violet-500 mb-2">
                <div class="flex gap-2">
                    <button onclick="document.getElementById('cp-new-form').classList.add('hidden')"
                            class="flex-1 py-2 text-sm font-semibold text-zinc-400 hover:text-white rounded-xl bg-zinc-800 hover:bg-zinc-700 transition-colors">Cancel</button>
                    <button onclick="createCollectionAndAdd()"
                            class="flex-1 py-2 text-sm font-semibold bg-violet-600 hover:bg-violet-500 text-white rounded-xl transition-colors">Create &amp; Add</button>
                </div>
            </div>
            <div class="flex gap-3">
                <button onclick="document.getElementById('cp-new-form').classList.toggle('hidden'); document.getElementById('cp-new-name').focus()"
                        class="flex-1 flex items-center justify-center gap-2 py-2 text-sm font-semibold text-violet-400 hover:text-violet-300 rounded-xl bg-zinc-800 hover:bg-zinc-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    New Collection
                </button>
                <button onclick="saveCollectionPicker()"
                        class="flex-1 py-2 text-sm font-semibold bg-white text-black rounded-xl hover:bg-zinc-100 transition-colors">Done</button>
            </div>
        </div>
    </div>
</div>

{{-- ══ "New Collection" Quick Create Modal ══ --}}
<div id="new-collection-modal"
     class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm">
    <div class="bg-zinc-900 border border-zinc-700 rounded-2xl w-full max-w-sm p-6 shadow-2xl">
        <h3 class="text-lg font-bold text-white mb-4">New Collection</h3>
        <input id="nc-name" type="text" maxlength="100" placeholder="Collection name"
               class="w-full rounded-xl bg-zinc-800 border border-zinc-700 text-white px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-violet-500 mb-4">
        <div class="flex gap-3 justify-end">
            <button onclick="document.getElementById('new-collection-modal').classList.add('hidden')"
                    class="px-4 py-2 text-sm font-semibold text-zinc-400 hover:text-white transition-colors">Cancel</button>
            <button onclick="submitNewCollection()"
                    class="px-5 py-2 text-sm font-semibold bg-violet-600 hover:bg-violet-500 text-white rounded-xl transition-colors">Create</button>
        </div>
    </div>
</div>

<script id="ap-collections" type="application/json">@json($postCollections->map(fn($c) => ['id' => $c->id, 'name' => $c->name])->values())</script>
<script>
const _csrf          = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
let _postCollections = JSON.parse(document.getElementById('ap-collections').textContent);
let _pickerPostId    = null;
let _pickerCurIds    = [];

// Navigate to post on thumbnail click (but not when the add-btn is clicked)
document.addEventListener('click', function(e) {
    const thumb = e.target.closest('[data-post-url]');
    if (thumb && !e.target.closest('[data-add-btn]')) {
        window.location.href = thumb.dataset.postUrl;
    }
});

function openCollectionPicker(postId, currentCollectionIds) {
    _pickerPostId = postId;
    _pickerCurIds = Array.isArray(currentCollectionIds) ? currentCollectionIds : [];
    _renderPickerList();
    document.getElementById('cp-new-form').classList.add('hidden');
    document.getElementById('cp-new-name').value = '';
    document.getElementById('collection-picker-modal').classList.remove('hidden');
}

function closeCollectionPicker() {
    document.getElementById('collection-picker-modal').classList.add('hidden');
    _pickerPostId = null;
    _pickerCurIds = [];
}

function _renderPickerList() {
    const list = document.getElementById('cp-collections-list');
    if (!_postCollections.length) {
        list.innerHTML = '<p class="px-5 py-4 text-sm text-zinc-500 text-center">No collections yet. Create one below.</p>';
        return;
    }
    list.innerHTML = _postCollections.map(col => {
        const checked = _pickerCurIds.includes(col.id) ? 'checked' : '';
        return `<label class="flex items-center gap-3 px-5 py-3 hover:bg-zinc-800/60 cursor-pointer transition-colors">
            <input type="checkbox" value="${col.id}" ${checked} class="w-4 h-4 accent-violet-500 rounded">
            <span class="text-sm text-white">${col.name}</span>
        </label>`;
    }).join('');
}

async function saveCollectionPicker() {
    if (!_pickerPostId) { closeCollectionPicker(); return; }
    const checkboxes = document.querySelectorAll('#cp-collections-list input[type=checkbox]');
    const promises   = [];
    for (const cb of checkboxes) {
        const colId = parseInt(cb.value);
        const wasIn = _pickerCurIds.includes(colId);
        if (!wasIn && cb.checked) {
            promises.push(fetch(`/saved-collections/${colId}/posts`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': _csrf },
                body: JSON.stringify({ post_id: _pickerPostId }),
            }));
        } else if (wasIn && !cb.checked) {
            promises.push(fetch(`/saved-collections/${colId}/posts`, {
                method: 'DELETE',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': _csrf },
                body: JSON.stringify({ post_id: _pickerPostId }),
            }));
        }
    }
    await Promise.all(promises);

    const thumb = document.querySelector(`[data-post-id="${_pickerPostId}"]`);
    if (thumb) {
        const newIds = Array.from(checkboxes).filter(cb => cb.checked).map(cb => parseInt(cb.value));
        thumb.dataset.collectionIds = JSON.stringify(newIds);
    }
    closeCollectionPicker();
}

async function createCollectionAndAdd() {
    const name = document.getElementById('cp-new-name').value.trim();
    if (!name) return;
    const res = await fetch('/saved-collections', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': _csrf },
        body: JSON.stringify({ name, post_id: _pickerPostId }),
    });
    if (res.ok) {
        const data = await res.json();
        _postCollections.unshift(data.collection);
        _pickerCurIds = [..._pickerCurIds, data.collection.id];
        _renderPickerList();
        document.getElementById('cp-new-form').classList.add('hidden');
        document.getElementById('cp-new-name').value = '';
    }
}

async function submitNewCollection() {
    const name = document.getElementById('nc-name').value.trim();
    if (!name) return;
    const res = await fetch('/saved-collections', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': _csrf },
        body: JSON.stringify({ name }),
    });
    if (res.ok) {
        const data = await res.json();
        _postCollections.unshift(data.collection);
        document.getElementById('new-collection-modal').classList.add('hidden');
    }
}

['collection-picker-modal', 'new-collection-modal'].forEach(id => {
    document.getElementById(id).addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
            if (id === 'collection-picker-modal') { _pickerPostId = null; _pickerCurIds = []; }
        }
    });
});
</script>
@endsection
