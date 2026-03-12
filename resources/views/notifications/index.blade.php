@extends('layout.app')

@section('title', 'Notifications – Yarnly')

@section('content')
<div class="mx-auto max-w-2xl px-4 py-10">

    {{-- Page header --}}
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-violet-600 via-purple-500 to-indigo-500 bg-clip-text text-transparent dark:from-violet-400 dark:via-purple-300 dark:to-indigo-400">
                Notifications
            </h1>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Stay up to date with your activity</p>
        </div>
        @if($notifications->total() > 0)
        <form method="POST" action="{{ route('notifications.markAllRead') }}">
            @csrf
            <button type="submit" class="inline-flex items-center gap-1.5 rounded-lg bg-violet-50 px-4 py-2 text-sm font-semibold text-violet-700 ring-1 ring-violet-200 transition hover:bg-violet-100 dark:bg-violet-500/10 dark:text-violet-300 dark:ring-violet-500/30 dark:hover:bg-violet-500/20">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Mark all as read
            </button>
        </form>
        @endif
    </div>

    <div class="space-y-3">
        @forelse($notifications as $notification)
        @php $type = $notification->data['type'] ?? 'general'; @endphp
        <a
            href="{{ route('notifications.markRead', $notification->id) }}"
            class="flex items-start gap-4 rounded-2xl px-5 py-4 ring-1 transition-all duration-200
                {{ $notification->read_at
                    ? 'bg-white ring-zinc-100 hover:ring-zinc-200 dark:bg-zinc-800/40 dark:ring-zinc-700/50 dark:hover:ring-zinc-600'
                    : 'bg-gradient-to-r from-violet-50 to-indigo-50 ring-violet-200 hover:from-violet-100 hover:to-indigo-100 dark:from-violet-500/10 dark:to-indigo-500/10 dark:ring-violet-500/30 dark:hover:from-violet-500/15 dark:hover:to-indigo-500/15'
                }}"
        >
            {{-- Coloured icon --}}
            <div class="mt-0.5 flex-shrink-0">
                @if($type === 'like')
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-rose-400 to-red-500 text-white shadow-md shadow-red-500/30">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                    </svg>
                </span>
                @elseif($type === 'follow')
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-400 to-cyan-500 text-white shadow-md shadow-blue-500/30">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </span>
                @elseif($type === 'comment')
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-amber-400 to-orange-500 text-white shadow-md shadow-amber-500/30">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </span>
                @elseif($type === 'new_post')
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-violet-500 to-purple-600 text-white shadow-md shadow-violet-500/30">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </span>
                @elseif($type === 'new_pattern')
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-400 to-teal-500 text-white shadow-md shadow-emerald-500/30">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                </span>
                @else
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-zinc-400 to-zinc-500 text-white shadow-md shadow-zinc-500/20">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </span>
                @endif
            </div>

            <div class="flex-1 min-w-0">
                <p class="text-sm leading-snug text-zinc-800 dark:text-zinc-100 {{ $notification->read_at ? '' : 'font-semibold' }}">
                    {{ $notification->data['message'] ?? '' }}
                </p>
                <p class="mt-1 text-xs font-medium
                    {{ $notification->read_at ? 'text-zinc-400 dark:text-zinc-500' : 'text-violet-500 dark:text-violet-400' }}">
                    {{ $notification->created_at->diffForHumans() }}
                </p>
            </div>

            @if(!$notification->read_at)
            <span class="mt-2 flex-shrink-0 h-2.5 w-2.5 rounded-full bg-violet-500 shadow shadow-violet-400/60 self-start"></span>
            @endif
        </a>
        @empty
        <div class="flex flex-col items-center justify-center rounded-2xl py-24 ring-1 ring-zinc-100 dark:ring-zinc-800 text-zinc-400 dark:text-zinc-500">
            <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-violet-100 to-indigo-100 dark:from-violet-900/20 dark:to-indigo-900/20">
                <svg class="h-8 w-8 text-violet-400 dark:text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
            </div>
            <p class="text-base font-semibold text-zinc-600 dark:text-zinc-300">You're all caught up!</p>
            <p class="text-sm mt-1">No notifications yet.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $notifications->links() }}
    </div>
</div>
@endsection
