@extends('layout.app')

@section('title', 'Admin Dashboard · Yarnly')

@section('content')
<style>
@keyframes fade-up { from{opacity:0;transform:translateY(16px)} to{opacity:1;transform:translateY(0)} }
@keyframes count-up { from{opacity:0;transform:scale(.85)} to{opacity:1;transform:scale(1)} }
.fade-up  { animation: fade-up  .5s cubic-bezier(.34,1.56,.64,1) both; }
.stat-val { animation: count-up .6s cubic-bezier(.34,1.56,.64,1) both; }
.stat-card { transition: transform .25s, box-shadow .25s; }
.stat-card:hover { transform: translateY(-4px); box-shadow: 0 12px 40px rgba(0,0,0,.12); }
.row-hover { transition: background .12s; }
.row-hover:hover { background: rgba(139,92,246,.07); }
</style>

<div class="min-h-screen bg-zinc-50 dark:bg-zinc-950 pt-6 pb-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- ── Header ─────────────────────────────────────────── --}}
        <div class="fade-up mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight">
                    Admin Dashboard
                </h1>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                    Platform overview &amp; statistics — as of {{ now()->format('F j, Y') }}
                </p>
            </div>
            <span class="inline-flex items-center gap-1.5 rounded-full bg-violet-100 px-3 py-1 text-xs font-semibold text-violet-700 dark:bg-violet-900/30 dark:text-violet-300 ring-1 ring-violet-200 dark:ring-violet-700">
                <span class="h-1.5 w-1.5 rounded-full bg-violet-500 animate-pulse"></span>
                Live
            </span>
        </div>

        {{-- ── Primary stat cards ─────────────────────────────── --}}
        <div class="grid grid-cols-2 gap-4 md:grid-cols-4 fade-up" style="animation-delay:.05s">

            {{-- Users --}}
            <div class="stat-card rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 p-5 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500">Total Users</span>
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-violet-100 dark:bg-violet-900/30">
                        <svg class="h-4 w-4 text-violet-600 dark:text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2M9 7a4 4 0 100 8 4 4 0 000-8zM23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                        </svg>
                    </div>
                </div>
                <p class="stat-val text-4xl font-black text-zinc-900 dark:text-white">{{ number_format($stats['total_users']) }}</p>
                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">+{{ $stats['new_users_month'] }} this month</p>
            </div>

            {{-- Patterns --}}
            <div class="stat-card rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 p-5 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500">Patterns</span>
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-100 dark:bg-emerald-900/30">
                        <svg class="h-4 w-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
                <p class="stat-val text-4xl font-black text-zinc-900 dark:text-white">{{ number_format($stats['total_patterns']) }}</p>
                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">+{{ $stats['new_patterns_month'] }} this month</p>
            </div>

            {{-- Posts --}}
            <div class="stat-card rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 p-5 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500">Posts</span>
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-100 dark:bg-blue-900/30">
                        <svg class="h-4 w-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
                <p class="stat-val text-4xl font-black text-zinc-900 dark:text-white">{{ number_format($stats['total_posts']) }}</p>
                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">+{{ $stats['new_posts_month'] }} this month</p>
            </div>

            {{-- Collections --}}
            <div class="stat-card rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 p-5 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500">Collections</span>
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-amber-100 dark:bg-amber-900/30">
                        <svg class="h-4 w-4 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                </div>
                <p class="stat-val text-4xl font-black text-zinc-900 dark:text-white">{{ number_format($stats['total_collections']) }}</p>
                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">+{{ $stats['new_collections_month'] }} this month</p>
            </div>

        </div>

        {{-- ── Secondary stat row ─────────────────────────────── --}}
        <div class="mt-4 grid grid-cols-2 gap-4 md:grid-cols-4 fade-up" style="animation-delay:.1s">

            <div class="stat-card rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500 mb-2">Total Likes</p>
                <p class="text-3xl font-black text-pink-500">{{ number_format($stats['total_likes']) }}</p>
            </div>

            <div class="stat-card rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500 mb-2">Total Comments</p>
                <p class="text-3xl font-black text-sky-500">{{ number_format($stats['total_comments']) }}</p>
            </div>

            <div class="stat-card rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500 mb-2">Admin Users</p>
                <p class="text-3xl font-black text-violet-500">{{ number_format($stats['admin_count']) }}</p>
            </div>

            <div class="stat-card rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500 mb-2">New Users Today</p>
                <p class="text-3xl font-black text-teal-500">{{ number_format($stats['new_users_today']) }}</p>
            </div>

        </div>

        {{-- ── Patterns breakdown ─────────────────────────────── --}}
        <div class="mt-8 grid gap-6 md:grid-cols-2 fade-up" style="animation-delay:.15s">

            <div class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 p-6 shadow-sm">
                <h2 class="text-base font-bold text-zinc-900 dark:text-white mb-4">Patterns by Type</h2>
                <div class="space-y-3">
                    @foreach($stats['patterns_by_type'] as $type => $count)
                    @php
                        $pct = $stats['total_patterns'] > 0 ? round($count / $stats['total_patterns'] * 100) : 0;
                    @endphp
                    <div>
                        <div class="mb-1 flex items-center justify-between text-sm">
                            <span class="font-medium capitalize text-zinc-700 dark:text-zinc-300">{{ $type }}</span>
                            <span class="text-zinc-500 dark:text-zinc-400">{{ number_format($count) }} <span class="text-xs">({{ $pct }}%)</span></span>
                        </div>
                        <div class="h-2 w-full rounded-full bg-zinc-100 dark:bg-zinc-800">
                            <div class="h-2 rounded-full bg-violet-500 transition-all duration-700" @style(["width:{$pct}%" => true])></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Posts by craft type --}}
            <div class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 p-6 shadow-sm">
                <h2 class="text-base font-bold text-zinc-900 dark:text-white mb-4">Posts by Craft Type</h2>
                <div class="space-y-3">
                    @foreach($stats['posts_by_craft'] as $craft => $count)
                    @php
                        $pct = $stats['total_posts'] > 0 ? round($count / $stats['total_posts'] * 100) : 0;
                    @endphp
                    <div>
                        <div class="mb-1 flex items-center justify-between text-sm">
                            <span class="font-medium capitalize text-zinc-700 dark:text-zinc-300">{{ $craft ?: 'Other' }}</span>
                            <span class="text-zinc-500 dark:text-zinc-400">{{ number_format($count) }} <span class="text-xs">({{ $pct }}%)</span></span>
                        </div>
                        <div class="h-2 w-full rounded-full bg-zinc-100 dark:bg-zinc-800">
                            <div class="h-2 rounded-full bg-violet-500 transition-all duration-700" @style(["width:{$pct}%" => true])></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>

        {{-- ── Recent users table ─────────────────────────────── --}}
        <div class="mt-8 fade-up" style="animation-delay:.2s">
            <div class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-zinc-100 dark:border-zinc-800 flex items-center justify-between">
                    <h2 class="text-base font-bold text-zinc-900 dark:text-white">Recently Joined Users</h2>
                    <a href="#manage-users" class="text-xs font-semibold text-violet-600 dark:text-violet-400 hover:underline">View all →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500 bg-zinc-50 dark:bg-zinc-900/60">
                                <th class="px-6 py-3">User</th>
                                <th class="px-6 py-3">Email</th>
                                <th class="px-6 py-3">Role</th>
                                <th class="px-6 py-3">Joined</th>
                                <th class="px-6 py-3 text-right">Patterns</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                            @forelse($recentUsers as $user)
                            <tr class="row-hover">
                                <td class="px-6 py-3">
                                    <div class="flex items-center gap-3">
                                        @if($user->profile_picture)
                                            <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                                 class="h-8 w-8 rounded-full object-cover ring-1 ring-zinc-200 dark:ring-zinc-700" alt="">
                                        @else
                                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-violet-100 dark:bg-violet-900/40 text-xs font-bold text-violet-700 dark:text-violet-300 ring-1 ring-zinc-200 dark:ring-zinc-700">
                                                {{ strtoupper(substr($user->name, 0, 2)) }}
                                            </div>
                                        @endif
                                        <span class="font-medium text-zinc-800 dark:text-zinc-200">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-3 text-zinc-500 dark:text-zinc-400">{{ $user->email }}</td>
                                <td class="px-6 py-3">
                                    @if($user->role === 'admin')
                                        <span class="inline-flex rounded-full bg-violet-100 dark:bg-violet-900/30 px-2 py-0.5 text-xs font-semibold text-violet-700 dark:text-violet-300">Admin</span>
                                    @else
                                        <span class="inline-flex rounded-full bg-zinc-100 dark:bg-zinc-800 px-2 py-0.5 text-xs font-semibold text-zinc-600 dark:text-zinc-400">User</span>
                                    @endif
                                </td>
                                <td class="px-6 py-3 text-zinc-500 dark:text-zinc-400">{{ $user->created_at->format('M j, Y') }}</td>
                                <td class="px-6 py-3 text-right font-semibold text-zinc-700 dark:text-zinc-300">{{ $user->patterns_count }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-zinc-400 dark:text-zinc-500">No users yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ── Recent patterns table ─────────────────────────── --}}
        <div class="mt-8 fade-up" style="animation-delay:.25s">
            <div class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-zinc-100 dark:border-zinc-800">
                    <h2 class="text-base font-bold text-zinc-900 dark:text-white">Recently Uploaded Patterns</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500 bg-zinc-50 dark:bg-zinc-900/60">
                                <th class="px-6 py-3">Title</th>
                                <th class="px-6 py-3">Category</th>
                                <th class="px-6 py-3">Difficulty</th>
                                <th class="px-6 py-3">Author</th>
                                <th class="px-6 py-3">Uploaded</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                            @forelse($recentPatterns as $pattern)
                            <tr class="row-hover">
                                <td class="px-6 py-3 font-medium text-zinc-800 dark:text-zinc-200">{{ $pattern->title }}</td>
                                <td class="px-6 py-3">
                                    @php
                                        $catColors = ['crochet'=>'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300','knitting'=>'bg-violet-100 text-violet-700 dark:bg-violet-900/30 dark:text-violet-300','embroidery'=>'bg-pink-100 text-pink-700 dark:bg-pink-900/30 dark:text-pink-300'];
                                        $catColor = $catColors[$pattern->category] ?? 'bg-zinc-100 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400';
                                    @endphp
                                    <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-semibold {{ $catColor }} capitalize">{{ $pattern->category }}</span>
                                </td>
                                <td class="px-6 py-3 capitalize text-zinc-500 dark:text-zinc-400">{{ $pattern->difficulty ?? '—' }}</td>
                                <td class="px-6 py-3 text-zinc-500 dark:text-zinc-400">{{ optional($pattern->user)->name ?? '—' }}</td>
                                <td class="px-6 py-3 text-zinc-500 dark:text-zinc-400">{{ $pattern->created_at->format('M j, Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-zinc-400 dark:text-zinc-500">No patterns yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
