{{-- Post card partial – mirrors the Instagram-style card in the screenshot --}}
@php
    $likesCount    = $model->likes_count    ?? rand(12, 980);
    $commentsCount = $model->comments_count ?? rand(0, 60);
    $craftType     = $model->craft_type     ?? ($model->type ?? 'crochet');

    // Colour accent based on craft type – matches navbar icon colours
    $accentMap = [
        'crochet'    => ['ring' => 'ring-emerald-400',   'bg' => 'bg-emerald-500',  'text' => 'text-emerald-600',  'light' => 'bg-emerald-50',  'dark_bg' => 'dark:bg-emerald-900/30', 'dark_text' => 'dark:text-emerald-300'],
        'knitting'   => ['ring' => 'ring-violet-400',    'bg' => 'bg-violet-500',   'text' => 'text-violet-600',   'light' => 'bg-violet-50',   'dark_bg' => 'dark:bg-violet-900/30',  'dark_text' => 'dark:text-violet-300'],
        'embroidery' => ['ring' => 'ring-rose-400',      'bg' => 'bg-rose-500',     'text' => 'text-rose-600',     'light' => 'bg-rose-50',     'dark_bg' => 'dark:bg-rose-900/30',    'dark_text' => 'dark:text-rose-300'],
        'model'      => ['ring' => 'ring-purple-400',    'bg' => 'bg-purple-500',   'text' => 'text-purple-600',   'light' => 'bg-purple-50',   'dark_bg' => 'dark:bg-purple-900/30',  'dark_text' => 'dark:text-purple-300'],
    ];
    $accent = $accentMap[$craftType] ?? $accentMap['model'];

    $authorName   = $model->user->name      ?? 'Anonymous';
    $authorAvatar = $model->user->avatar    ?? null;
    $authorInitial = strtoupper(substr($authorName, 0, 1));

    $createdAt = $model->created_at ?? now();
    $timeAgo   = \Carbon\Carbon::parse($createdAt)->diffForHumans(null, true, true);

    $imageUrl   = $model->image_url ?? ($model->cover_image ? asset('storage/' . $model->cover_image) : null);
    $modelTitle = $model->title     ?? 'Untitled Model';
    $modelDesc  = $model->description ?? '';
    $modelId    = $model->id ?? 0;
@endphp

<div class="gallery-item post-card group rounded-2xl bg-white ring-1 ring-zinc-200/80 shadow-sm hover:shadow-lg hover:ring-purple-200 transition-all duration-300 overflow-hidden dark:bg-zinc-800/70 dark:ring-zinc-700/60 dark:hover:ring-purple-700/50">

    {{-- ── Author header ── --}}
    <div class="flex items-center justify-between px-4 pt-4 pb-3">
        <div class="flex items-center gap-3">
            @if($authorAvatar)
                <img src="{{ $authorAvatar }}" alt="{{ $authorName }}"
                     class="h-9 w-9 rounded-full object-cover ring-2 {{ $accent['ring'] }}">
            @else
                <div class="flex h-9 w-9 items-center justify-center rounded-full {{ $accent['bg'] }} ring-2 {{ $accent['ring'] }} text-sm font-bold text-white shadow">
                    {{ $authorInitial }}
                </div>
            @endif
            <div>
                <p class="text-sm font-semibold text-zinc-900 dark:text-white leading-none">{{ $authorName }}</p>
                <p class="mt-0.5 text-xs text-zinc-400 dark:text-zinc-500">{{ $timeAgo }}</p>
            </div>
        </div>

        {{-- Craft type badge --}}
        <span class="inline-flex items-center rounded-full {{ $accent['light'] }} {{ $accent['dark_bg'] }} {{ $accent['text'] }} {{ $accent['dark_text'] }} px-2.5 py-0.5 text-xs font-semibold capitalize">
            {{ $craftType }}
        </span>
    </div>

    {{-- ── Image ── --}}
    @if($imageUrl)
        <div class="relative overflow-hidden bg-zinc-100 dark:bg-zinc-700">
            <img src="{{ $imageUrl }}"
                 alt="{{ $modelTitle }}"
                 class="w-full object-cover transition-transform duration-500 group-hover:scale-[1.03]"
                 loading="lazy">
        </div>
    @else
        {{-- Placeholder when no image --}}
        <div class="flex h-52 items-center justify-center bg-gradient-to-br from-purple-100 to-violet-100 dark:from-purple-900/20 dark:to-violet-900/20">
            <svg class="h-16 w-16 text-purple-300 dark:text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
    @endif

    {{-- ── Actions row ── --}}
    <div class="flex items-center justify-between px-4 pt-3 pb-2">
        <div class="flex items-center gap-4">
            {{-- Heart --}}
            <button
                onclick="toggleHeart(this, { $modelId })"
                class="heart-btn group/heart flex items-center gap-1.5 text-zinc-500 hover:text-red-500 dark:text-zinc-400 dark:hover:text-red-400 transition-colors duration-200">
                <svg class="h-6 w-6 stroke-2 transition-transform duration-150 group-hover/heart:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                <span class="heart-count text-sm font-medium">{{ $likesCount }}</span>
            </button>

            {{-- Comment --}}
            <button class="flex items-center gap-1.5 text-zinc-500 hover:text-purple-500 dark:text-zinc-400 dark:hover:text-purple-400 transition-colors duration-200">
                <svg class="h-6 w-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                <span class="text-sm font-medium">{{ $commentsCount }}</span>
            </button>

            {{-- Share --}}
            <button class="flex items-center gap-1.5 text-zinc-500 hover:text-violet-500 dark:text-zinc-400 dark:hover:text-violet-400 transition-colors duration-200">
                <svg class="h-6 w-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                </svg>
            </button>
        </div>

        {{-- Save / bookmark --}}
        <button class="flex items-center text-zinc-400 hover:text-purple-500 dark:hover:text-purple-400 transition-colors duration-200">
            <svg class="h-6 w-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
            </svg>
        </button>
    </div>

    {{-- ── Caption ── --}}
    <div class="px-4 pb-4">
        <p class="text-sm font-semibold text-zinc-900 dark:text-white">{{ $modelTitle }}</p>
        @if($modelDesc)
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400 line-clamp-2">{{ $modelDesc }}</p>
        @endif
    </div>

</div>
