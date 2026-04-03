<div
    x-data="{ open: false }"
    @click.outside="open = false"
    @close-bell.window="open = false"
    wire:poll.10s="loadNotifications">
    {{-- Bell Button --}}
    <button
        type="button"
        @click="
            open = !open;
            if (open) {
                $wire.loadNotifications();
                document.querySelectorAll('[data-dropdown-toggle]').forEach(function(btn) {
                    var el = document.getElementById(btn.getAttribute('data-dropdown-toggle'));
                    if (el && !el.classList.contains('hidden')) {
                        var inner = el.querySelector('div');
                        if (inner) { inner.style.transform = 'scale(0.95) translateY(-8px)'; inner.style.opacity = '0'; inner.style.transition = 'all 0.15s ease'; }
                        var arrow = btn.querySelector('.dropdown-arrow');
                        if (arrow) arrow.classList.remove('rotate-180');
                        setTimeout(function() { el.classList.add('hidden'); if (inner) { inner.style.transform = ''; inner.style.opacity = ''; inner.style.transition = ''; } }, 150);
                    }
                });
            }
        "
        class="relative flex h-10 w-10 items-center justify-center rounded-lg text-zinc-600 transition-all duration-300 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-100 cursor-pointer"
        aria-label="Notifications">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>

        @if($unreadCount > 0)
        <span class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-xs font-bold text-white shadow">
            {{ $unreadCount > 9 ? '9+' : $unreadCount }}
        </span>
        @endif
    </button>

    {{-- Dropdown --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
        class="absolute right-0 top-full mt-6 w-80 max-w-[calc(100vw-1rem)] origin-top-right z-50"
        style="display:none;">
        <div class="rounded-xl bg-white/95 backdrop-blur-xl shadow-xl ring-1 ring-black/5 border border-white/20 dark:bg-zinc-900/95 dark:ring-white/10 dark:border-zinc-700/50">
            {{-- Header --}}
            <div class="flex items-center justify-between px-4 py-3 border-b border-zinc-200 dark:border-zinc-700">
                <span class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">{{ __('Notifications') }}</span>
                @if($unreadCount > 0)
                <button
                    type="button"
                    wire:click="markAllRead"
                    class="text-xs text-violet-600 hover:text-violet-700 dark:text-violet-400 dark:hover:text-violet-300 font-medium transition">
                    Mark all as read
                </button>
                @endif
            </div>

            {{-- List --}}
            <div class="max-h-80 overflow-y-auto divide-y divide-zinc-100 dark:divide-zinc-800">
                @forelse($notifications as $notification)
                <a
                    href="{{ $notification['url'] }}"
                    wire:click="markRead('{{ $notification['id'] }}')"
                    class="flex items-start gap-3 px-4 py-3 transition hover:bg-zinc-50 dark:hover:bg-zinc-800/60 {{ $notification['read'] ? 'opacity-70' : '' }}">
                    {{-- Icon by type --}}
                    <div class="mt-0.5 flex-shrink-0">
                        @if($notification['type'] === 'like')
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-red-100 text-red-500 dark:bg-red-900/30 dark:text-red-400">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                            </svg>
                        </span>
                        @elseif($notification['type'] === 'follow')
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 text-blue-500 dark:bg-blue-900/30 dark:text-blue-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        @elseif($notification['type'] === 'comment')
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-amber-100 text-amber-500 dark:bg-amber-900/30 dark:text-amber-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </span>
                        @elseif($notification['type'] === 'new_post')
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-purple-100 text-purple-500 dark:bg-purple-900/30 dark:text-purple-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </span>
                        @elseif($notification['type'] === 'new_pattern')
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-100 text-emerald-500 dark:bg-emerald-900/30 dark:text-emerald-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </span>
                        @elseif($notification['type'] === 'new_collection')
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-sky-100 text-sky-500 dark:bg-sky-900/30 dark:text-sky-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </span>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </span>
                        @else
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-zinc-100 text-zinc-500 dark:bg-zinc-800 dark:text-zinc-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </span>
                        @endif
                    </div>

                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-zinc-800 dark:text-zinc-100 leading-snug {{ $notification['read'] ? '' : 'font-medium' }}">
                            {{ $notification['message'] }}
                        </p>
                        <p class="mt-0.5 text-xs text-zinc-400 dark:text-zinc-500">{{ $notification['created_at'] }}</p>
                    </div>

                    @if(!$notification['read'])
                    <span class="mt-2 flex-shrink-0 h-2 w-2 rounded-full bg-violet-500"></span>
                    @endif
                </a>
                @empty
                <div class="flex flex-col items-center justify-center py-10 text-zinc-400 dark:text-zinc-500">
                    <svg class="mb-2 h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <p class="text-sm">{{ __('No notifications yet') }}</p>
                </div>
                @endforelse
            </div>

            {{-- Footer --}}
            <div class="border-t border-zinc-200 dark:border-zinc-700 px-4 py-2">
                <a
                    href="{{ route('notifications.index') }}"
                    class="block text-center text-xs text-violet-600 hover:text-violet-700 dark:text-violet-400 dark:hover:text-violet-300 font-medium py-1 transition">
                    {{ __('See all notifications') }}
                </a>
            </div>
        </div>
    </div>
</div>