{{-- Post card partial – Instagram-style --}}
@php
    $likesCount    = $model->likes_count    ?? 0;
    $commentsCount = $model->comments_count ?? 0;
    $craftType     = $model->craft_type     ?? ($model->type ?? 'crochet');

    $accentMap = [
        'crochet'    => ['ring' => 'ring-emerald-400', 'bg' => 'bg-emerald-500', 'text' => 'text-emerald-600', 'light' => 'bg-emerald-50',  'dark_bg' => 'dark:bg-emerald-900/30', 'dark_text' => 'dark:text-emerald-300'],
        'knitting'   => ['ring' => 'ring-violet-400',  'bg' => 'bg-violet-500',  'text' => 'text-violet-600',  'light' => 'bg-violet-50',   'dark_bg' => 'dark:bg-violet-900/30',  'dark_text' => 'dark:text-violet-300'],
        'embroidery' => ['ring' => 'ring-rose-400',    'bg' => 'bg-rose-500',    'text' => 'text-rose-600',    'light' => 'bg-rose-50',     'dark_bg' => 'dark:bg-rose-900/30',    'dark_text' => 'dark:text-rose-300'],
        'model'      => ['ring' => 'ring-purple-400',  'bg' => 'bg-purple-500',  'text' => 'text-purple-600',  'light' => 'bg-purple-50',   'dark_bg' => 'dark:bg-purple-900/30',  'dark_text' => 'dark:text-purple-300'],
    ];
    $accent = $accentMap[$craftType] ?? $accentMap['model'];

    $authorName    = $model->user->name ?? 'Anonymous';
    $authorAvatar  = ($model->user->profile_picture ?? null)
                        ? asset('storage/' . $model->user->profile_picture)
                        : null;
    $authorInitial = strtoupper(substr($authorName, 0, 1));

    $createdAt = $model->created_at ?? now();
    $timeAgo   = \Carbon\Carbon::parse($createdAt)->diffForHumans(null, true, true);

    $allImages = isset($model->images) && $model->images->count()
        ? $model->images->map(fn($img) => asset('storage/' . $img->image_path))->values()
        : collect();

    // Fallback for Pattern-style models
    if ($allImages->isEmpty()) {
        $fallback = $model->image_url ?? ($model->cover_image ? asset('storage/' . $model->cover_image) : null);
        if ($fallback) $allImages = collect([$fallback]);
    }

    $imageCount  = $allImages->count();
    $modelDesc   = $model->description ?? ($model->title ?? '');
    $modelId     = $model->id ?? 0;
    $carouselId  = 'carousel-' . $modelId . '-' . uniqid();
    $isLiked     = $model->liked_by_user     ?? false;
    $isFavorited = $model->faved_by_user ?? false;
    $likeUrl     = route('posts.like',       $modelId);
    $unlikeUrl   = route('posts.unlike',     $modelId);
    $favUrl      = route('posts.favorite',   $modelId);
    $unfavUrl    = route('posts.unfavorite', $modelId);

    // Follow state – $followingIds is passed from the gallery controller (array of followed user IDs)
    $postAuthorId  = $model->user->id ?? null;
    $showFollowBtn = auth()->check() && $postAuthorId && auth()->id() !== $postAuthorId;
    $isFollowing   = $showFollowBtn && isset($followingIds) && in_array($postAuthorId, $followingIds);
    $followUrl     = $showFollowBtn ? route('users.follow',   $postAuthorId) : '#';
    $unfollowUrl   = $showFollowBtn ? route('users.unfollow', $postAuthorId) : '#';
@endphp

<div class="gallery-item post-card group rounded-2xl bg-white ring-1 ring-zinc-200/80 shadow-sm hover:shadow-lg hover:ring-purple-200 transition-all duration-300 overflow-hidden dark:bg-zinc-800/70 dark:ring-zinc-700/60 dark:hover:ring-purple-700/50">

    {{-- ── Author header ── --}}
    <div class="flex items-center justify-between px-4 pt-4 pb-3">
        <div class="flex items-center gap-3">
            @if($authorAvatar)
                <img src="{{ $authorAvatar }}" alt="{{ $authorName }}"
                     class="h-9 w-9 rounded-full object-cover">
            @else
                <div class="flex h-9 w-9 items-center justify-center rounded-full {{ $accent['bg'] }} text-sm font-bold text-white shadow">
                    {{ $authorInitial }}
                </div>
            @endif
            <div>
                <div class="flex items-center gap-2 min-w-0">
                    <p class="text-sm font-semibold text-zinc-900 dark:text-white leading-none truncate">{{ $authorName }}</p>
                    @if($showFollowBtn)
                    <button
                        data-author-id="{{ $postAuthorId }}"
                        data-following="{{ $isFollowing ? 'true' : 'false' }}"
                        data-follow-url="{{ $followUrl }}"
                        data-unfollow-url="{{ $unfollowUrl }}"
                        onclick="postToggleFollow(this)"
                        class="follow-btn flex-shrink-0 text-xs font-semibold leading-none px-2 py-0.5 rounded-full border transition-colors duration-200
                               {{ $isFollowing
                                   ? 'border-zinc-300 text-zinc-500 hover:border-red-400 hover:text-red-500 dark:border-zinc-600 dark:text-zinc-400 dark:hover:border-red-500 dark:hover:text-red-400'
                                   : 'border-purple-400 text-purple-600 hover:bg-purple-500 hover:text-white dark:border-purple-500 dark:text-purple-400 dark:hover:bg-purple-600 dark:hover:text-white' }}">
                        {{ $isFollowing ? 'Following' : '+ Follow' }}
                    </button>
                    @endif
                </div>
                <p class="mt-0.5 text-xs text-zinc-400 dark:text-zinc-500">{{ $timeAgo }}</p>
            </div>
        </div>
        <span class="inline-flex items-center rounded-full {{ $accent['light'] }} {{ $accent['dark_bg'] }} {{ $accent['text'] }} {{ $accent['dark_text'] }} px-2.5 py-0.5 text-xs font-semibold capitalize">
            {{ $craftType }}
        </span>
    </div>

    {{-- ── Image / Carousel ── --}}
    @if($imageCount > 0)
        <div class="carousel-wrapper relative bg-zinc-950 overflow-hidden cursor-pointer"
             id="{{ $carouselId }}"
             data-open-post="{{ $modelId }}"
             style="min-height:120px">

            {{-- Absolutely-positioned track: slides sit side-by-side in a row wider than the wrapper --}}
            <div class="carousel-track absolute inset-0 flex transition-transform duration-300 ease-in-out">
                @foreach($allImages as $imgUrl)
                    <div class="carousel-slide flex-none w-full h-full flex items-center justify-center">
                        <img src="{{ $imgUrl }}"
                             alt="Post image"
                             class="w-full h-full object-contain"
                             loading="lazy"
                             onload="carouselSetHeight('{{ $carouselId }}')">
                    </div>
                @endforeach
            </div>

            {{-- Dots – bottom of image --}}
            @if($imageCount > 1)
                <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex items-center gap-1.5 z-10">
                    @for($i = 0; $i < $imageCount; $i++)
                        <button
                            onclick="event.stopPropagation(); carouselGo('{{ $carouselId }}', {{ $i }})"
                            class="carousel-dot h-1.5 rounded-full transition-all duration-200 {{ $i === 0 ? 'w-4 bg-white' : 'w-1.5 bg-white/40' }}">
                        </button>
                    @endfor
                </div>

                {{-- Prev arrow --}}
                <button onclick="event.stopPropagation(); carouselPrev('{{ $carouselId }}')"
                        class="absolute left-1.5 top-1/2 -translate-y-1/2 z-10 flex h-6 w-6 items-center justify-center rounded-full bg-black/35 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-200 hover:bg-black/55">
                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                {{-- Next arrow --}}
                <button onclick="event.stopPropagation(); carouselNext('{{ $carouselId }}')"
                        class="absolute right-1.5 top-1/2 -translate-y-1/2 z-10 flex h-6 w-6 items-center justify-center rounded-full bg-black/35 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-200 hover:bg-black/55">
                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            @endif
        </div>
    @else
        <div class="flex h-52 items-center justify-center bg-gradient-to-br from-purple-100 to-violet-100 dark:from-purple-900/20 dark:to-violet-900/20 cursor-pointer"
             data-open-post="{{ $modelId }}">
            <svg class="h-16 w-16 text-purple-300 dark:text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
    @endif

    {{-- ── Actions row ── --}}
    <div class="flex items-center justify-between px-4 pt-3 pb-2">
        <div class="flex items-center gap-4">

            {{-- Heart --}}
            @auth
            <button
                data-post-id="{{ $modelId }}"
                data-liked="{{ $isLiked ? 'true' : 'false' }}"
                data-like-url="{{ $likeUrl }}"
                data-unlike-url="{{ $unlikeUrl }}"
                onclick="postToggleLike(this)"
                class="like-btn group/heart flex items-center gap-1.5 transition-colors duration-200
                       {{ $isLiked ? 'text-red-500' : 'text-zinc-500 hover:text-red-500 dark:text-zinc-400 dark:hover:text-red-400' }}">
                <svg class="h-6 w-6 stroke-2 transition-transform duration-150 group-hover/heart:scale-110"
                     fill="{{ $isLiked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                <span class="like-count text-sm font-medium">{{ $likesCount }}</span>
            </button>
            @else
            <button onclick="openLoginModal()"
                    class="flex items-center gap-1.5 text-zinc-500 hover:text-red-500 dark:text-zinc-400 dark:hover:text-red-400 transition-colors duration-200">
                <svg class="h-6 w-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                <span class="text-sm font-medium">{{ $likesCount }}</span>
            </button>
            @endauth

            {{-- Comment --}}
            <button data-comment-link="{{ $modelId }}"
                    onclick="galOpenModal('{{ $modelId }}')"
                    class="flex items-center gap-1.5 text-zinc-500 hover:text-purple-500 dark:text-zinc-400 dark:hover:text-purple-400 transition-colors duration-200">
                <svg class="h-6 w-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                <span class="comment-count text-sm font-medium">{{ $commentsCount }}</span>
            </button>

            {{-- Share --}}
            <button class="flex items-center gap-1.5 text-zinc-500 hover:text-violet-500 dark:text-zinc-400 dark:hover:text-violet-400 transition-colors duration-200">
                <svg class="h-6 w-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                </svg>
            </button>
        </div>

        {{-- Bookmark --}}
        @auth
        <button
            data-post-id="{{ $modelId }}"
            data-faved="{{ $isFavorited ? 'true' : 'false' }}"
            data-fav-url="{{ $favUrl }}"
            data-unfav-url="{{ $unfavUrl }}"
            onclick="postToggleFav(this)"
            class="fav-btn flex items-center transition-colors duration-200
                   {{ $isFavorited ? 'text-purple-500' : 'text-zinc-400 hover:text-purple-500 dark:hover:text-purple-400' }}">
            <svg class="h-6 w-6 stroke-2" fill="{{ $isFavorited ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
            </svg>
        </button>
        @else
        <button onclick="openLoginModal()" class="flex items-center text-zinc-400 hover:text-purple-500 dark:hover:text-purple-400 transition-colors duration-200">
            <svg class="h-6 w-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
            </svg>
        </button>
        @endauth
    </div>

    {{-- ── Caption (Instagram style: bold username + description inline) ── --}}
    @if($modelDesc)
        <div class="px-4 pb-4">
            <p class="text-sm text-zinc-700 dark:text-zinc-300 line-clamp-3">
                <span class="font-semibold text-zinc-900 dark:text-white mr-1">{{ $authorName }}</span>{{ $modelDesc }}
            </p>
        </div>
    @endif

</div>

@once
@push('scripts')
<script>
// ─── Carousel ────────────────────────────────────────────────────────────────
const _carouselState = {};

function carouselSetHeight(id) {
    const wrapper = document.getElementById(id);
    if (!wrapper) return;
    let maxRatio = 0;
    wrapper.querySelectorAll('.carousel-slide img').forEach(img => {
        if (!img.complete || !img.naturalWidth) return;
        const ratio = img.naturalHeight / img.naturalWidth;
        if (ratio > maxRatio) maxRatio = ratio;
    });
    // aspect-ratio works even when inside a hidden tab (no offsetWidth dependency)
    if (maxRatio > 0) {
        wrapper.style.aspectRatio = '1 / ' + maxRatio.toFixed(6);
        wrapper.style.minHeight = '';
    }
}

function carouselGo(id, index) {
    const wrapper = document.getElementById(id);
    if (!wrapper) return;
    const track = wrapper.querySelector('.carousel-track');
    const dots  = wrapper.querySelectorAll('.carousel-dot');
    const total = wrapper.querySelectorAll('.carousel-slide').length;
    index = Math.max(0, Math.min(index, total - 1));
    _carouselState[id] = index;
    track.style.transform = `translateX(-${index * 100}%)`;
    dots.forEach((d, i) => {
        d.classList.toggle('w-4',         i === index);
        d.classList.toggle('bg-white',    i === index);
        d.classList.toggle('w-1.5',       i !== index);
        d.classList.toggle('bg-white/40', i !== index);
    });
}

function carouselNext(id) {
    const wrapper = document.getElementById(id);
    if (!wrapper) return;
    const total = wrapper.querySelectorAll('.carousel-slide').length;
    const current = _carouselState[id] ?? 0;
    if (current < total - 1) carouselGo(id, current + 1);
}

function carouselPrev(id) {
    const wrapper = document.getElementById(id);
    if (!wrapper) return;
    const current = _carouselState[id] ?? 0;
    if (current > 0) carouselGo(id, current - 1);
}

// ─── Like / Favorite AJAX ────────────────────────────────────────────────────
const _csrf = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

async function postToggleLike(btn) {
    const liked  = btn.dataset.liked === 'true';
    const url    = liked ? btn.dataset.unlikeUrl : btn.dataset.likeUrl;
    const method = liked ? 'DELETE' : 'POST';
    try {
        const res  = await fetch(url, {
            method,
            headers: { 'X-CSRF-TOKEN': _csrf, 'Accept': 'application/json' },
        });
        const data = await res.json();
        const svg  = btn.querySelector('svg');
        const cnt  = btn.querySelector('.like-count');
        btn.dataset.liked = data.liked ? 'true' : 'false';
        svg.setAttribute('fill', data.liked ? 'currentColor' : 'none');
        btn.classList.toggle('text-red-500',      data.liked);
        btn.classList.toggle('text-zinc-500',     !data.liked);
        btn.classList.toggle('dark:text-zinc-400', !data.liked);
        if (cnt) cnt.textContent = data.count;
    } catch (e) { console.error(e); }
}

async function postToggleFav(btn) {
    const faved  = btn.dataset.faved === 'true';
    const url    = faved ? btn.dataset.unfavUrl : btn.dataset.favUrl;
    const method = faved ? 'DELETE' : 'POST';
    try {
        const res  = await fetch(url, {
            method,
            headers: { 'X-CSRF-TOKEN': _csrf, 'Accept': 'application/json' },
        });
        const data = await res.json();
        const svg  = btn.querySelector('svg');
        btn.dataset.faved = data.favorited ? 'true' : 'false';
        svg.setAttribute('fill', data.favorited ? 'currentColor' : 'none');
        btn.classList.toggle('text-purple-500', data.favorited);
        btn.classList.toggle('text-zinc-400',   !data.favorited);
    } catch (e) { console.error(e); }
}

async function postToggleFollow(btn) {
    const following   = btn.dataset.following === 'true';
    const url         = following ? btn.dataset.unfollowUrl : btn.dataset.followUrl;
    const method      = following ? 'DELETE' : 'POST';
    try {
        const res  = await fetch(url, {
            method,
            headers: { 'X-CSRF-TOKEN': _csrf, 'Accept': 'application/json' },
        });
        const data = await res.json();
        const nowFollowing = data.following;
        btn.dataset.following = nowFollowing ? 'true' : 'false';
        btn.textContent = nowFollowing ? 'Following' : '+ Follow';
        // Swap styling
        btn.classList.toggle('border-purple-400',  !nowFollowing);
        btn.classList.toggle('text-purple-600',    !nowFollowing);
        btn.classList.toggle('dark:border-purple-500', !nowFollowing);
        btn.classList.toggle('dark:text-purple-400',   !nowFollowing);
        btn.classList.toggle('hover:bg-purple-500',    !nowFollowing);
        btn.classList.toggle('hover:text-white',       !nowFollowing);
        btn.classList.toggle('dark:hover:bg-purple-600', !nowFollowing);
        btn.classList.toggle('border-zinc-300',    nowFollowing);
        btn.classList.toggle('text-zinc-500',      nowFollowing);
        btn.classList.toggle('hover:border-red-400',   nowFollowing);
        btn.classList.toggle('hover:text-red-500',     nowFollowing);
        btn.classList.toggle('dark:border-zinc-600',   nowFollowing);
        btn.classList.toggle('dark:text-zinc-400',     nowFollowing);
        btn.classList.toggle('dark:hover:border-red-500', nowFollowing);
        btn.classList.toggle('dark:hover:text-red-400',   nowFollowing);
        // Update ALL follow buttons for the same author on the page
        document.querySelectorAll(`.follow-btn[data-author-id="${btn.dataset.authorId}"]`).forEach(b => {
            if (b === btn) return;
            b.dataset.following = nowFollowing ? 'true' : 'false';
            b.textContent = nowFollowing ? 'Following' : '+ Follow';
        });
    } catch (e) { console.error(e); }
}

// ─── Touch / swipe support ───────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.carousel-wrapper').forEach(wrapper => {
        const id = wrapper.id;
        let startX = 0, isDragging = false;

        wrapper.addEventListener('touchstart', e => {
            startX = e.touches[0].clientX;
            isDragging = true;
        }, { passive: true });

        wrapper.addEventListener('touchend', e => {
            if (!isDragging) return;
            isDragging = false;
            const diff = startX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 40) {
                diff > 0 ? carouselNext(id) : carouselPrev(id);
            }
        }, { passive: true });

        // Mouse drag (desktop)
        wrapper.addEventListener('mousedown', e => {
            startX = e.clientX;
            isDragging = true;
        });
        wrapper.addEventListener('mouseup', e => {
            if (!isDragging) return;
            isDragging = false;
            const diff = startX - e.clientX;
            if (Math.abs(diff) > 40) {
                diff > 0 ? carouselNext(id) : carouselPrev(id);
            }
        });
        wrapper.addEventListener('mouseleave', () => { isDragging = false; });
    });
});
</script>
@endpush
@endonce
