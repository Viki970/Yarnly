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

    // SVG icons per craft type (same as navbar)
    $craftIcons = [
        'crochet'    => '<svg class="h-4 w-4 transform rotate-45" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2c-1.2 0-2.2.8-2.2 1.8v8.4c-.2.1-.4.3-.4.6l-.3 8.4c0 .2.1.3.2.4.1.1.3.2.4.2h1.8c.2 0 .3-.1.4-.2.1-.1.2-.2.2-.4l-.3-8.4c0-.2-.1-.4-.3-.5V4.6c0-.1 0-.1 0-.1 0 0 .1 0 .1 0 .1 0 .2.1.2.2v.6c0 .3.3.6.6.6.7 0 1.2-.5 1.2-1.2v-.3C13.2 2.8 12.4 2 12 2z" /></svg>',
        'knitting'   => '<svg class="h-4 w-5" fill="currentColor" viewBox="0 0 512 768"><path d="M506.267,495.415l-224.299-78.02l121.182-42.146c10.795,15.573,28.774,25.822,49.118,25.822c32.93,0,59.733-26.803,59.733-59.733c0-32.93-26.803-59.733-59.733-59.733c-32.93,0-59.733,26.803-59.733,59.733c0,6.46,1.067,12.672,2.97,18.5l-139.503,48.529l-139.503-48.529c1.903-5.828,2.97-12.041,2.97-18.5c0-32.93-26.803-59.733-59.733-59.733S0.002,308.407,0.002,341.337c0,32.93,26.803,59.733,59.733,59.733c20.343,0,38.323-10.24,49.118-25.822l121.182,42.146L5.736,495.415c-4.463,1.545-6.81,6.409-5.257,10.854c1.22,3.524,4.523,5.734,8.055,5.734c0.93,0,1.877-0.154,2.799-0.478l244.668-85.103l244.668,85.103c0.922,0.324,1.869,0.478,2.799,0.478c3.533,0,6.835-2.21,8.055-5.734C513.077,501.823,510.73,496.959,506.267,495.415z M460.802,315.737c4.719,0,8.533,3.814,8.533,8.533c0,4.719-3.814,8.533-8.533,8.533c-9.412,0-17.067,7.654-17.067,17.067c0,4.719-3.814,8.533-8.533,8.533s-8.533-3.814-8.533-8.533C426.668,331.046,441.977,315.737,460.802,315.737z M68.268,332.803c-9.412,0-17.067,7.654-17.067,17.067c0,4.719-3.814,8.533-8.533,8.533s-8.533-3.814-8.533-8.533c0-18.825,15.309-34.133,34.133-34.133c4.719,0,8.533,3.814,8.533,8.533C76.802,328.989,72.987,332.803,68.268,332.803z" /></svg>',
        'embroidery' => '<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 274 274"><path d="M262.353,170.603c-0.792-2.288-19.578-56.177-45.5-69.878c-1.554-0.818-3.18-1.652-4.847-2.501c7.783-26.139,10.299-47.996,5.188-66.953c-4.981-18.491-22.059-32.213-38.856-31.219c-14.794,0.865-25.295,12.718-28.097,31.701c-0.88,5.965-0.834,11.387-0.171,16.43c-3.469,4.836-5.841,9.036-6.543,10.325L13.143,266.149c-0.997,1.579-2.231,3.547-0.955,5.872l1.229,2.206h2.509c2.201,0,3.379-1.476,4.513-2.895L170.42,83.093c9.569,8.114,21.034,14.245,31.375,19.49c-4.635,14.333-10.776,30.049-18.046,47.328c-19.957,47.483-10.657,86.687,3.401,95.64c0.705,0.451,1.492,0.663,2.279,0.663c1.402,0,2.77-0.694,3.583-1.968c1.248-1.973,0.673-4.604-1.305-5.852c-9.896-6.302-18.662-41.109-0.135-85.19c7.13-16.953,13.204-32.467,17.875-46.753c1.186,0.605,2.34,1.201,3.453,1.786c22.96,12.138,41.26,64.612,41.436,65.136c0.767,2.217,3.18,3.392,5.396,2.631C261.934,175.227,263.115,172.814,262.353,170.603z M153.986,80.063l-8.353,6.902l3.299-10.325c0.973-3.024,2.791-8.383,5.203-14.131c1.885,4.085,4.272,7.819,7.048,11.236C157.973,76.713,155.27,79.002,153.986,80.063z M167.345,67.781c-3.671-4.722-6.426-10.077-7.954-16.181c4.106-7.322,9.021-13.241,14.209-13.241c1.435,0,2.817,0.409,4.096,1.222c2.123,1.341,3.319,3.365,3.48,5.851C181.564,51.579,174.481,60.464,167.345,67.781z M204.333,94.345c-9.823-5.007-20.164-10.651-28.589-17.891c5.634-7.28,16.669-23.229,15.198-34.932c-0.513-4.096-2.517-7.482-5.789-9.792c-2.714-1.9-5.686-2.874-8.839-2.874c-6.551,0-12.868,4.339-18.201,9.704c0.083-1.802,0.232-3.646,0.518-5.571c2.2-14.934,9.569-23.855,20.205-24.477c0.378-0.021,0.771-0.037,1.16-0.037c11.143,0,24.72,9.088,29.013,24.995C213.57,50.414,211.343,70.354,204.333,94.345z" /></svg>',
        'model'      => '<svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><polygon points="12 2 22 8.5 22 15.5 12 22 2 15.5 2 8.5"/><line x1="12" y1="22" x2="12" y2="15.5"/><polyline points="22 8.5 12 15.5 2 8.5"/></svg>',
    ];
    $craftIcon = $craftIcons[$craftType] ?? $craftIcons['model'];

    $authorName    = $model->user->name ?? 'Anonymous';
    $authorAvatar  = ($model->user ?? null) && $model->user->hasProfileImage()
                        ? asset('storage/' . $model->user->profile_picture)
                        : null;
    $authorAvatarColor = ($model->user ?? null) ? $model->user->avatarColor() : null;
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
    // Unique per-feed card ID to avoid duplicate element IDs when the same post
    // appears in multiple feed tabs rendered simultaneously in the DOM.
    $cardUid     = ($feedPrefix ?? 'c') . '-' . $modelId;
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
    $authorProfileUrl = $postAuthorId ? route('users.show', $postAuthorId) : '#';
@endphp

<div class="gallery-item post-card group rounded-xl sm:rounded-2xl bg-white ring-1 ring-zinc-200/80 shadow-sm hover:shadow-lg hover:ring-purple-200 transition-all duration-300 overflow-hidden dark:bg-zinc-800/70 dark:ring-zinc-700/60 dark:hover:ring-purple-700/50">

    {{-- ── Author header ── --}}
    <div class="flex items-center justify-between px-3 sm:px-4 pt-3 sm:pt-4 pb-2 sm:pb-3">
        <div class="flex items-center gap-3 min-w-0 flex-1">
            <a href="{{ $authorProfileUrl }}" class="shrink-0 block">
            @if($authorAvatar)
                <img src="{{ $authorAvatar }}" alt="{{ $authorName }}"
                     class="h-9 w-9 rounded-full object-cover">
            @else
                <div class="flex h-9 w-9 items-center justify-center rounded-full text-sm font-bold text-white shadow {{ $authorAvatarColor ? '' : $accent['bg'] }}"
                     {!! $authorAvatarColor ? 'style="background-color: ' . e($authorAvatarColor) . '"' : '' !!}>
                    {{ $authorInitial }}
                </div>
            @endif
            </a>
            <div class="min-w-0 flex-1">
                <div class="flex items-center gap-2 min-w-0">
                    <a href="{{ $authorProfileUrl }}" class="text-xs sm:text-sm font-semibold text-zinc-900 dark:text-white leading-none truncate hover:underline">{{ $authorName }}</a>
                    @if($showFollowBtn)
                    <button
                        data-author-id="{{ $postAuthorId }}"
                        data-following="{{ $isFollowing ? 'true' : 'false' }}"
                        data-follow-url="{{ $followUrl }}"
                        data-unfollow-url="{{ $unfollowUrl }}"
                        onclick="postToggleFollow(this)"
                        class="follow-btn flex-shrink-0 text-xs font-semibold leading-none px-2 py-0.5 rounded-full border border-purple-400 text-purple-600 hover:bg-purple-500 hover:text-white dark:border-purple-500 dark:text-purple-400 dark:hover:bg-purple-600 dark:hover:text-white transition-colors duration-200 {{ $isFollowing ? 'hidden' : '' }}">
                        + Follow
                    </button>
                    @endif
                </div>
                <p class="mt-0.5 text-xs text-zinc-400 dark:text-zinc-500">{{ $timeAgo }}</p>
            </div>
        </div>
        <span class="flex-shrink-0 inline-flex items-center justify-center rounded-full {{ $accent['light'] }} {{ $accent['dark_bg'] }} {{ $accent['text'] }} {{ $accent['dark_text'] }} p-1.5" title="{{ ucfirst($craftType) }}">
            {!! $craftIcon !!}
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
                        class="carousel-arrow absolute left-1.5 top-1/2 -translate-y-1/2 z-10 flex h-7 w-7 items-center justify-center rounded-full bg-black/35 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-200 hover:bg-black/55">
                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                {{-- Next arrow --}}
                <button onclick="event.stopPropagation(); carouselNext('{{ $carouselId }}')"
                        class="carousel-arrow absolute right-1.5 top-1/2 -translate-y-1/2 z-10 flex h-7 w-7 items-center justify-center rounded-full bg-black/35 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-200 hover:bg-black/55">
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
    <div class="flex items-center justify-between px-3 sm:px-4 pt-2 sm:pt-3 pb-2">
        <div class="flex items-center gap-3 sm:gap-4">

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
            @auth
            <button data-comment-link="{{ $modelId }}"
                    onclick="cardCommentClick('{{ $cardUid }}', '{{ $modelId }}')"
                    class="flex items-center gap-1.5 text-zinc-500 hover:text-purple-500 dark:text-zinc-400 dark:hover:text-purple-400 transition-colors duration-200">
                <svg class="h-6 w-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                <span class="comment-count text-sm font-medium">{{ $commentsCount }}</span>
            </button>
            @else
            <button onclick="openLoginModal()"
                    class="flex items-center gap-1.5 text-zinc-500 hover:text-purple-500 dark:text-zinc-400 dark:hover:text-purple-400 transition-colors duration-200">
                <svg class="h-6 w-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                <span class="text-sm font-medium">{{ $commentsCount }}</span>
            </button>
            @endauth

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
        <div class="px-3 sm:px-4 pb-3">
            <p class="text-xs sm:text-sm text-zinc-700 dark:text-zinc-300 line-clamp-3">
                <span class="font-semibold text-zinc-900 dark:text-white mr-1">{{ $authorName }}</span>{{ $modelDesc }}
            </p>
        </div>
    @endif

    {{-- ── Mobile inline comments (hidden on desktop via md:hidden) ── --}}
    <div id="mc-{{ $cardUid }}"
         class="hidden border-t border-zinc-100 dark:border-zinc-700 md:hidden mc-section"
         data-mc-loaded="false">
        <div id="mc-loading-{{ $cardUid }}" class="hidden justify-center py-4">
            <div class="h-4 w-4 animate-spin rounded-full border-2 border-zinc-200 border-t-purple-500"></div>
        </div>
        <div id="mc-list-{{ $cardUid }}" class="px-3 sm:px-4 pt-3 space-y-3"></div>
        @auth
        {{-- Replying-to pill --}}
        <div id="mc-reply-banner-{{ $cardUid }}" class="hidden items-center gap-2 px-3 sm:px-4 pb-1 text-xs text-zinc-500 dark:text-zinc-400">
            <span>Replying to <span id="mc-reply-to-{{ $cardUid }}" class="text-purple-500 font-semibold"></span></span>
            <button onclick="mcCancelReply('{{ $cardUid }}')" class="ml-auto text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200 transition-colors">✕</button>
        </div>
        <div class="flex items-center gap-2 px-3 sm:px-4 pt-2 pb-3 mt-2 border-t border-zinc-100 dark:border-zinc-700">
            @php $mcAuthColor = auth()->user()->avatarColor(); @endphp
            @if(auth()->user()->hasProfileImage())
            <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}"
                 class="w-7 h-7 rounded-full object-cover flex-none" alt="">
            @else
            <div class="w-7 h-7 rounded-full flex-none flex items-center justify-center text-white text-xs font-bold select-none {{ $mcAuthColor ? '' : 'bg-gradient-to-br from-violet-400 to-purple-500' }}"
                 {!! $mcAuthColor ? 'style="background-color: ' . e($mcAuthColor) . '"' : '' !!}>
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            @endif
            <input type="text"
                   id="mc-input-{{ $cardUid }}"
                   placeholder="Add a comment…"
                   class="flex-1 bg-transparent text-sm text-zinc-700 dark:text-zinc-300 placeholder-zinc-400 dark:placeholder-zinc-600 outline-none py-1"
                   maxlength="500"
                   oninput="document.getElementById('mc-btn-{{ $cardUid }}').disabled = this.value.trim().length === 0"
                   onkeydown="if(event.key==='Enter'){event.preventDefault();mobilePostComment('{{ $cardUid }}', '{{ $modelId }}');}"/>
            <button id="mc-btn-{{ $cardUid }}"
                    onclick="mobilePostComment('{{ $cardUid }}', '{{ $modelId }}')"
                    class="text-sm font-semibold text-purple-500 hover:text-purple-600 transition-colors disabled:opacity-40 disabled:cursor-not-allowed"
                    disabled>Post</button>
        </div>
        @else
        <div class="px-3 sm:px-4 pb-3 text-center">
            <a href="{{ route('login') }}" class="text-sm text-purple-500 hover:underline">Sign in to comment</a>
        </div>
        @endauth
    </div>

</div>

@once
@push('scripts')<style>
/* Show carousel arrows always on touch devices */
@media (hover: none) and (pointer: coarse) {
    .carousel-wrapper .carousel-arrow { opacity: 0.75 !important; }
}
</style><script>
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

// Touch swipe support for post card carousels
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.carousel-wrapper').forEach(el => {
        let sx = 0;
        el.addEventListener('touchstart', e => { sx = e.touches[0].clientX; }, { passive: true });
        el.addEventListener('touchend', e => {
            const diff = sx - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 40) {
                diff > 0 ? carouselNext(el.id) : carouselPrev(el.id);
            }
        }, { passive: true });
    });
});

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

        // After saving (not unsaving), offer to add to a collection
        if (data.favorited) {
            _showCollectionQuickPicker(btn, parseInt(btn.dataset.postId));
        } else {
            _hideCollectionQuickPicker();
        }
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
        // Hide when following, show when unfollowing
        if (nowFollowing) {
            btn.classList.add('hidden');
        } else {
            btn.classList.remove('hidden');
        }
        // Sync ALL follow buttons for the same author on the page
        document.querySelectorAll(`.follow-btn[data-author-id="${btn.dataset.authorId}"]`).forEach(b => {
            b.dataset.following = nowFollowing ? 'true' : 'false';
            if (nowFollowing) { b.classList.add('hidden'); }
            else              { b.classList.remove('hidden'); }
        });
    } catch (e) { console.error(e); }
}

// ─── Collection Quick Picker ────────────────────────────────────────────────
let _cpqPostId = null;

function _getOrCreateQuickPicker() {
    let el = document.getElementById('cp-quick-picker');
    if (el) return el;
    el = document.createElement('div');
    el.id = 'cp-quick-picker';
    el.className = 'fixed z-[200] bg-zinc-900 border border-zinc-700 rounded-2xl shadow-2xl w-56 overflow-hidden pointer-events-none';
    el.style.cssText = 'opacity:0; transform:scale(0.95) translateY(-4px); transition:opacity 80ms ease,transform 80ms ease; transform-origin:top right;';
    el.innerHTML = `
        <div class="px-4 py-2.5 border-b border-zinc-800">
            <p class="text-xs font-semibold text-zinc-400 uppercase tracking-wider">Save to collection</p>
        </div>
        <div id="cpq-list" class="max-h-52 overflow-y-auto divide-y divide-zinc-800/50"></div>
    `;
    document.body.appendChild(el);
    return el;
}

function _hideCollectionQuickPicker() {
    const el = document.getElementById('cp-quick-picker');
    if (!el) return;
    el.style.opacity   = '0';
    el.style.transform = 'scale(0.95) translateY(-4px)';
    el.style.pointerEvents = 'none';
    _cpqPostId = null;
}

async function _showCollectionQuickPicker(btn, postId) {
    // Fetch the user's named collections
    let collections = [];
    try {
        const res = await fetch('/saved-collections', { headers: { 'Accept': 'application/json' } });
        const data = await res.json();
        collections = data.collections ?? [];
    } catch (e) { return; }

    // Only show if the user has at least one named collection
    if (!collections.length) return;

    _cpqPostId = postId;
    const picker = _getOrCreateQuickPicker();
    const list   = document.getElementById('cpq-list');

    list.innerHTML = collections.map(col => `
        <button class="cpq-col-btn w-full text-left px-4 py-2.5 text-sm text-white hover:bg-zinc-800 transition-colors flex items-center gap-3"
                data-col-id="${col.id}">
            <svg class="w-4 h-4 text-zinc-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
            <span>${col.name}</span>
        </button>
    `).join('');

    // Position near the bookmark button (fixed = viewport-relative, no scroll offset)
    const rect  = btn.getBoundingClientRect();
    const pW    = 224; // matches w-56
    const pHEst = 40 + collections.length * 42;
    let top  = rect.bottom + 8;
    let left = rect.right  - pW;
    if (left < 8) left = 8;
    if (left + pW > window.innerWidth - 8) left = window.innerWidth - pW - 8;
    if (top + pHEst > window.innerHeight - 8) top = rect.top - pHEst - 8;
    picker.style.top  = top  + 'px';
    picker.style.left = left + 'px';

    // Animate in
    picker.style.opacity      = '0';
    picker.style.transform    = 'scale(0.95) translateY(-4px)';
    picker.style.pointerEvents = 'auto';
    // Force reflow so the start state is painted before the transition fires
    picker.getBoundingClientRect();
    picker.style.opacity   = '1';
    picker.style.transform = 'scale(1) translateY(0)';
}

// Handle collection selection
document.addEventListener('click', async function(e) {
    const colBtn = e.target.closest('.cpq-col-btn');
    if (colBtn && _cpqPostId) {
        const colId = parseInt(colBtn.dataset.colId);
        colBtn.disabled = true;
        try {
            await fetch(`/saved-collections/${colId}/posts`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': _csrf },
                body: JSON.stringify({ post_id: _cpqPostId }),
            });
        } catch (e) { console.error(e); }
        // Visual tick feedback then close
        colBtn.innerHTML = `<svg class="w-4 h-4 text-violet-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg><span class="text-violet-400">${colBtn.querySelector('span').textContent}</span>`;
        setTimeout(_hideCollectionQuickPicker, 700);
        return;
    }

    // Close picker on outside click (not on the bookmark button itself)
    const picker = document.getElementById('cp-quick-picker');
    if (picker && picker.style.opacity !== '0' && parseFloat(picker.style.opacity) > 0 &&
        !picker.contains(e.target) && !e.target.closest('.fav-btn')) {
        _hideCollectionQuickPicker();
    }
});


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
