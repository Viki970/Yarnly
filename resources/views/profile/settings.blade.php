﻿@extends('layout.app')

@section('title', 'Settings · Yarnly')

@push('scripts')
@fluxScripts
@endpush

@section('content')
<style>[x-cloak] { display: none !important; }</style>

<div class="min-h-screen bg-zinc-950 text-white py-10"
     x-data="{
         activeTab: (new URLSearchParams(window.location.search).get('tab')) || 'password',
         setTab(tab) {
             this.activeTab = tab;
             const url = new URL(window.location);
             url.searchParams.set('tab', tab);
             window.history.replaceState({}, '', url);
         }
     }">
    <div class="max-w-4xl mx-auto px-4">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-xl font-bold">Settings</h1>
            <p class="text-sm text-zinc-400 mt-0.5">Manage your account preferences</p>
        </div>

        <div class="flex gap-8 max-lg:flex-col">

            {{-- Sidebar --}}
            <aside class="w-52 shrink-0 max-lg:w-full">
                <nav class="flex flex-col gap-0.5 max-lg:flex-row max-lg:flex-wrap max-lg:gap-2">

                    @php
                    $tabs = [
                        ['id' => 'password',      'label' => 'Password & Security',
                         'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>'],
                        ['id' => 'notifications', 'label' => 'Notifications',
                         'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>'],
                        ['id' => 'privacy',       'label' => 'Privacy',
                         'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>'],
                        ['id' => 'theme',         'label' => 'Theme',
                         'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>'],
                        ['id' => 'language',      'label' => 'Language',
                         'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>'],
                        ['id' => 'danger',        'label' => 'Danger Zone',
                         'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>'],
                    ];
                    @endphp

                    @foreach($tabs as $i => $tab)
                        @if($i === count($tabs) - 1)
                        <div class="border-t border-zinc-800 my-1 max-lg:hidden"></div>
                        @endif
                        <button
                            @click="setTab('{{ $tab['id'] }}')"
                            :class="activeTab === '{{ $tab['id'] }}'
                                ? 'bg-zinc-800 text-white font-semibold'
                                : 'text-zinc-400 hover:text-white hover:bg-zinc-800/50'"
                            class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm transition-all text-left max-lg:w-auto max-lg:shrink-0">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $tab['icon'] !!}
                            </svg>
                            <span>{{ $tab['label'] }}</span>
                        </button>
                    @endforeach

                </nav>
            </aside>


            {{-- в”Ђв”Ђ Tab Panels в”Ђв”Ђ --}}
            <div class="flex-1 min-w-0">

                {{-- в•ђв•ђв•ђ PASSWORD & SECURITY в•ђв•ђв•ђ --}}
                <div x-show="activeTab === 'password'" x-cloak
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="space-y-4">
                    <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-9 h-9 rounded-xl bg-violet-500/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-base font-bold">Change Password</h2>
                                <p class="text-xs text-zinc-400">Use a long, random password to stay secure.</p>
                            </div>
                        </div>
                        <form method="post" action="{{ route('password.update') }}" class="space-y-5 max-w-md">
                            @csrf
                            @method('put')
                            <div>
                                <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1.5">Current Password</label>
                                <input type="password" name="current_password" autocomplete="current-password"
                                       class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition">
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                            </div>
                            <div>
                                <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1.5">New Password</label>
                                <input type="password" name="password" autocomplete="new-password"
                                       class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition">
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                            </div>
                            <div>
                                <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1.5">Confirm New Password</label>
                                <input type="password" name="password_confirmation" autocomplete="new-password"
                                       class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition">
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                            </div>
                            <div class="flex items-center gap-4 pt-1">
                                <button type="submit"
                                        class="px-8 py-2.5 rounded-xl bg-violet-600 hover:bg-violet-500 text-white text-sm font-semibold transition-colors">
                                    Update Password
                                </button>
                                @if (session('status') === 'password-updated')
                                    <span x-data="{ show: true }" x-show="show" x-transition
                                          x-init="setTimeout(() => show = false, 2000)"
                                          class="text-sm text-green-400">Password updated!</span>
                                @endif
                            </div>
                        </form>
                    </div>
                    <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-9 h-9 rounded-xl bg-blue-500/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-base font-bold">Account Email</h2>
                                <p class="text-xs text-zinc-400">Change your login email address.</p>
                            </div>
                        </div>
                        <form method="post" action="{{ route('profile.update') }}" class="space-y-4 max-w-md">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="_from" value="settings">
                            <div>
                                <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1.5">Email Address</label>
                                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                                       class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                                    <p class="mt-2 text-xs text-zinc-400">
                                        Your email is unverified.
                                        <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="inline">@csrf</form>
                                        <button form="send-verification" class="underline text-violet-400 hover:text-violet-300 ml-1">Resend verification</button>
                                    </p>
                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-1 text-xs text-green-400">Verification link sent!</p>
                                    @endif
                                @endif
                            </div>
                            {{-- hidden fields to pass through unchanged profile data --}}
                            <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                            <input type="hidden" name="username" value="{{ auth()->user()->username }}">
                            <button type="submit"
                                    class="px-8 py-2.5 rounded-xl bg-violet-600 hover:bg-violet-500 text-white text-sm font-semibold transition-colors">
                                Update Email
                            </button>
                        </form>
                    </div>
                </div>

                {{-- в•ђв•ђв•ђ NOTIFICATIONS в•ђв•ђв•ђ --}}
                <div x-show="activeTab === 'notifications'" x-cloak
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-9 h-9 rounded-xl bg-amber-500/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-base font-bold">Notification Preferences</h2>
                                <p class="text-xs text-zinc-400">Choose what you want to be notified about.</p>
                            </div>
                        </div>

                        @if(session('notification_prefs_saved'))
                        <div class="mb-4 flex items-center gap-2 rounded-xl bg-emerald-500/10 border border-emerald-500/20 px-4 py-2.5 text-sm text-emerald-400">
                            <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Preferences saved successfully.
                        </div>
                        @endif

                        <form method="POST" action="{{ route('profile.notifications.save') }}"
                              x-data="{
                                  prefs: {
                                      notify_followers:       {{ $notificationPrefs['notify_followers']       ? 'true' : 'false' }},
                                      notify_likes:           {{ $notificationPrefs['notify_likes']           ? 'true' : 'false' }},
                                      notify_comments:        {{ $notificationPrefs['notify_comments']        ? 'true' : 'false' }},
                                      notify_new_posts:       {{ $notificationPrefs['notify_new_posts']       ? 'true' : 'false' }},
                                      notify_new_patterns:    {{ $notificationPrefs['notify_new_patterns']    ? 'true' : 'false' }},
                                      notify_new_collections: {{ $notificationPrefs['notify_new_collections'] ? 'true' : 'false' }},
                                  }
                              }">
                            @csrf
                            {{-- Hidden inputs driven by Alpine toggles --}}
                            <template x-for="[key, val] in Object.entries(prefs)" :key="key">
                                <input type="hidden" :name="key" :value="val ? '1' : '0'">
                            </template>

                            <div class="space-y-3 max-w-md">
                                @foreach ([
                                    ['key' => 'notify_followers',       'label' => 'New followers',    'desc' => 'When someone follows you'],
                                    ['key' => 'notify_likes',           'label' => 'New likes',        'desc' => 'When someone likes your post'],
                                    ['key' => 'notify_comments',        'label' => 'New comments',     'desc' => 'When someone comments on your post'],
                                    ['key' => 'notify_new_posts',       'label' => 'New posts',        'desc' => 'New posts from people you follow'],
                                    ['key' => 'notify_new_patterns',    'label' => 'New patterns',     'desc' => 'New patterns from people you follow'],
                                    ['key' => 'notify_new_collections', 'label' => 'New collections',  'desc' => 'New collections from people you follow'],
                                ] as $item)
                                <div class="flex items-center justify-between gap-4 px-4 py-3.5 bg-zinc-800 rounded-xl">
                                    <div>
                                        <p class="text-sm font-medium text-white">{{ $item['label'] }}</p>
                                        <p class="text-xs text-zinc-400 mt-0.5">{{ $item['desc'] }}</p>
                                    </div>
                                    <button type="button"
                                            @click="prefs['{{ $item['key'] }}'] = !prefs['{{ $item['key'] }}']"
                                            :class="prefs['{{ $item['key'] }}'] ? 'bg-violet-600' : 'bg-zinc-600'"
                                            class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 focus:outline-none">
                                        <span :class="prefs['{{ $item['key'] }}'] ? 'translate-x-5' : 'translate-x-0'"
                                              class="inline-block h-5 w-5 transform rounded-full bg-white shadow transition duration-200"></span>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                            <div class="mt-6">
                                <button type="submit"
                                        class="px-8 py-2.5 rounded-xl bg-violet-600 hover:bg-violet-500 text-white text-sm font-semibold transition-colors">
                                    Save Preferences
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- в•ђв•ђв•ђ PRIVACY в•ђв•ђв•ђ --}}
                <div x-show="activeTab === 'privacy'" x-cloak
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-9 h-9 rounded-xl bg-emerald-500/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-base font-bold">Privacy Settings</h2>
                                <p class="text-xs text-zinc-400">Control who can see and interact with your content.</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('profile.privacy.save') }}">
                            @csrf
                            @if (session('privacy_prefs_saved'))
                            <div class="mb-4 flex items-center gap-2 rounded-xl bg-emerald-500/10 border border-emerald-500/20 px-4 py-2.5 text-sm text-emerald-400">
                                <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Privacy preferences saved.
                            </div>
                            @endif
                            <div class="space-y-3 max-w-md">
                                @foreach ([
                                    ['key' => 'searchable_profile',     'label' => 'Searchable profile',     'desc' => 'Let your profile appear in search and explore results'],
                                    ['key' => 'show_liked_posts',       'label' => 'Show liked posts',       'desc' => 'Let others see which posts you\'ve liked'],
                                    ['key' => 'show_saved_posts',       'label' => 'Show saved posts',       'desc' => 'Let others see which posts you\'ve saved'],
                                    ['key' => 'show_saved_patterns',    'label' => 'Show saved patterns',    'desc' => 'Let others see which patterns you\'ve favourited'],
                                    ['key' => 'show_saved_collections', 'label' => 'Show saved collections', 'desc' => 'Let others browse the collections you\'ve created'],
                                ] as $item)
                                @php $isOn = $privacyPrefs[$item['key']] ?? true; @endphp
                                <div class="flex items-center justify-between gap-4 px-4 py-3.5 bg-zinc-800 rounded-xl"
                                     x-data="{ on: {{ $isOn ? 'true' : 'false' }} }">
                                    <div>
                                        <p class="text-sm font-medium text-white">{{ $item['label'] }}</p>
                                        <p class="text-xs text-zinc-400 mt-0.5">{{ $item['desc'] }}</p>
                                    </div>
                                    <input type="hidden" :name="'{{ $item['key'] }}'" :value="on ? '1' : '0'">
                                    <button type="button" @click="on = !on"
                                            :class="on ? 'bg-violet-600' : 'bg-zinc-600'"
                                            class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 focus:outline-none">
                                        <span :class="on ? 'translate-x-5' : 'translate-x-0'"
                                              class="inline-block h-5 w-5 transform rounded-full bg-white shadow transition duration-200"></span>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                            <div class="mt-6">
                                <button type="submit" class="px-8 py-2.5 rounded-xl bg-violet-600 hover:bg-violet-500 text-white text-sm font-semibold transition-colors">
                                    Save Preferences
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- в•ђв•ђв•ђ THEME в•ђв•ђв•ђ --}}
                <div x-show="activeTab === 'theme'" x-cloak
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-data="{
                         theme:  localStorage.getItem('yarnly-theme')  || 'dark',
                         accent: localStorage.getItem('yarnly-accent') || 'violet',
                         size:   localStorage.getItem('yarnly-font')   || 'medium'
                     }">
                    <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 space-y-8">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-purple-500/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-base font-bold">Appearance</h2>
                                <p class="text-xs text-zinc-400">Choose how Yarnly looks for you.</p>
                            </div>
                        </div>

                        {{-- Colour mode --}}
                        <div>
                            <p class="text-sm font-semibold text-white mb-3">Colour Mode</p>
                            <div class="grid grid-cols-3 gap-3 max-w-sm">
                                @foreach ([
                                    ['value' => 'dark',   'label' => 'Dark',   'bg' => 'bg-zinc-900',  'bar' => 'bg-zinc-700'],
                                    ['value' => 'light',  'label' => 'Light',  'bg' => 'bg-white',     'bar' => 'bg-zinc-200'],
                                    ['value' => 'system', 'label' => 'System', 'bg' => 'bg-gradient-to-br from-zinc-900 to-white', 'bar' => 'bg-gradient-to-r from-zinc-700 to-zinc-200'],
                                ] as $t)
                                <button type="button"
                                        @click="theme = '{{ $t['value'] }}'; localStorage.setItem('yarnly-theme', '{{ $t['value'] }}')"
                                        :class="theme === '{{ $t['value'] }}'
                                            ? 'ring-2 ring-violet-500 ring-offset-2 ring-offset-zinc-950'
                                            : 'ring-1 ring-zinc-700 hover:ring-violet-400'"
                                        class="rounded-xl overflow-hidden transition-all cursor-pointer focus:outline-none">
                                    <div class="{{ $t['bg'] }} h-16 flex flex-col justify-end gap-1 p-2">
                                        <div class="{{ $t['bar'] }} rounded h-1.5 w-3/4 opacity-70"></div>
                                        <div class="{{ $t['bar'] }} rounded h-1.5 w-1/2 opacity-50"></div>
                                    </div>
                                    <div :class="theme === '{{ $t['value'] }}' ? 'bg-violet-600 text-white' : 'bg-zinc-800 text-zinc-400'"
                                         class="py-1.5 text-xs font-semibold text-center transition-colors">
                                        {{ $t['label'] }}
                                    </div>
                                </button>
                                @endforeach
                            </div>
                        </div>

                        {{-- Accent colour --}}
                        <div>
                            <p class="text-sm font-semibold text-white mb-3">Accent Colour</p>
                            <div class="flex items-center gap-3 flex-wrap">
                                @foreach ([
                                    ['value' => 'default', 'label' => 'Default', 'bg' => 'bg-[conic-gradient(from_0deg,_#f43f5e,_#f97316,_#eab308,_#22c55e,_#06b6d4,_#6366f1,_#a855f7,_#f43f5e)]'],
                                    ['value' => 'violet',  'label' => 'Violet',  'bg' => 'bg-violet-500'],
                                    ['value' => 'indigo',  'label' => 'Indigo',  'bg' => 'bg-indigo-500'],
                                    ['value' => 'rose',    'label' => 'Rose',    'bg' => 'bg-rose-500'],
                                    ['value' => 'emerald', 'label' => 'Emerald', 'bg' => 'bg-emerald-500'],
                                    ['value' => 'amber',   'label' => 'Amber',   'bg' => 'bg-amber-500'],
                                    ['value' => 'sky',     'label' => 'Sky',     'bg' => 'bg-sky-500'],
                                ] as $a)
                                <div class="flex flex-col items-center gap-1.5">
                                    <button type="button"
                                            @click="accent = '{{ $a['value'] }}'; localStorage.setItem('yarnly-accent', '{{ $a['value'] }}')"
                                            :class="accent === '{{ $a['value'] }}' ? 'ring-2 ring-white ring-offset-2 ring-offset-zinc-950 scale-110' : 'opacity-60 hover:opacity-100 hover:scale-110'"
                                            class="{{ $a['bg'] }} w-8 h-8 rounded-full block transition-all focus:outline-none cursor-pointer peer">
                                    </button>
                                    <span :class="accent === '{{ $a['value'] }}' ? 'opacity-100 text-white translate-y-0' : 'opacity-0 peer-hover:opacity-100 peer-hover:translate-y-0 text-zinc-400 -translate-y-1'"
                                          class="text-[10px] font-medium transition-all duration-150 pointer-events-none">{{ $a['label'] }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Font size --}}
                        <div>
                            <p class="text-sm font-semibold text-white mb-3">Font Size</p>
                            <div class="space-y-2 max-w-md">
                                @foreach ([
                                    ['value' => 'small',  'label' => 'Small',  'preview' => 'Aa', 'size' => 'text-sm',  'desc' => 'Compact — fits more on screen'],
                                    ['value' => 'medium', 'label' => 'Medium', 'preview' => 'Aa', 'size' => 'text-base','desc' => 'Default — balanced readability'],
                                    ['value' => 'large',  'label' => 'Large',  'preview' => 'Aa', 'size' => 'text-lg',  'desc' => 'Comfortable — easier on the eyes'],
                                ] as $f)
                                <button type="button"
                                        @click="size = '{{ $f['value'] }}'; localStorage.setItem('yarnly-font', '{{ $f['value'] }}'); document.documentElement.style.fontSize = ({ small: '13px', medium: '15px', large: '17px' })['{{ $f['value'] }}']"
                                        :class="size === '{{ $f['value'] }}'
                                            ? 'border-violet-500 bg-violet-500/10'
                                            : 'border-zinc-700 hover:border-zinc-500'"
                                        class="w-full flex items-center gap-4 px-4 py-3 rounded-xl border transition-all cursor-pointer focus:outline-none text-left">
                                    <div :class="size === '{{ $f['value'] }}' ? 'border-violet-500' : 'border-zinc-600'"
                                         class="w-4 h-4 rounded-full border-2 flex items-center justify-center shrink-0">
                                        <div x-show="size === '{{ $f['value'] }}'" class="w-2 h-2 rounded-full bg-violet-500"></div>
                                    </div>
                                    <span :class="size === '{{ $f['value'] }}' ? 'text-violet-400' : 'text-zinc-400'"
                                          class="{{ $f['size'] }} font-bold w-8 shrink-0 transition-colors">{{ $f['preview'] }}</span>
                                    <div>
                                        <p class="text-sm font-medium text-white">{{ $f['label'] }}</p>
                                        <p class="text-xs text-zinc-400">{{ $f['desc'] }}</p>
                                    </div>
                                </button>
                                @endforeach
                            </div>
                        </div>

                        <button class="px-8 py-2.5 rounded-xl bg-violet-600 hover:bg-violet-500 text-white text-sm font-semibold transition-colors">
                            Save Appearance
                        </button>
                    </div>
                </div>

                {{-- в•ђв•ђв•ђ LANGUAGE в•ђв•ђв•ђ --}}
                <div x-show="activeTab === 'language'" x-cloak
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-data="{ lang: '{{ app()->getLocale() }}', fmt: 'mdy' }">
                    <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 space-y-8">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-blue-500/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-base font-bold">Language & Region</h2>
                                <p class="text-xs text-zinc-400">Set your preferred language and regional format.</p>
                            </div>
                        </div>

                        {{-- Language list --}}
                        <div>
                            <p class="text-sm font-semibold text-white mb-3">Display Language</p>
                            <div class="space-y-2 max-w-md">
                                @foreach ([
                                    ['value' => 'en', 'label' => 'English',   'native' => 'English',    'flag' => '🇬🇧'],
                                    ['value' => 'bg', 'label' => 'Bulgarian', 'native' => 'Български', 'flag' => '🇧🇬'],
                                ] as $l)
                                <button type="button"
                                        @click="lang = '{{ $l['value'] }}'"
                                        :class="lang === '{{ $l['value'] }}'
                                            ? 'border-violet-500 bg-violet-500/10'
                                            : 'border-zinc-700 hover:border-zinc-500'"
                                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl border transition-all focus:outline-none text-left cursor-pointer">
                                    <div :class="lang === '{{ $l['value'] }}' ? 'border-violet-500' : 'border-zinc-600'"
                                         class="w-4 h-4 rounded-full border-2 flex items-center justify-center shrink-0">
                                        <div x-show="lang === '{{ $l['value'] }}'" class="w-2 h-2 rounded-full bg-violet-500"></div>
                                    </div>
                                    <span class="text-lg leading-none">{{ $l['flag'] }}</span>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-white">{{ $l['label'] }}</p>
                                        <p class="text-xs text-zinc-400">{{ $l['native'] }}</p>
                                    </div>
                                    <span x-show="lang === '{{ $l['value'] }}'"
                                          class="text-xs text-violet-400 font-semibold">Active</span>
                                </button>
                                @endforeach
                            </div>
                        </div>

                        <button class="px-8 py-2.5 rounded-xl bg-violet-600 hover:bg-violet-500 text-white text-sm font-semibold transition-colors">
                            Save Language
                        </button>
                    </div>
                </div>

                {{-- в•ђв•ђв•ђ DANGER ZONE в•ђв•ђв•ђ --}}
                <div x-show="activeTab === 'danger'" x-cloak
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-data="{ confirmingDeletion: false }">
                    <div class="bg-zinc-900 border border-red-900/40 rounded-2xl p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-9 h-9 rounded-xl bg-red-500/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-base font-bold text-red-400">Danger Zone</h2>
                                <p class="text-xs text-zinc-400">Irreversible and destructive actions.</p>
                            </div>
                        </div>
                        <div class="flex items-start justify-between gap-6 p-4 bg-zinc-800 rounded-xl border border-red-900/30">
                            <div>
                                <p class="text-sm font-semibold text-white">Delete Account</p>
                                <p class="text-xs text-zinc-400 mt-1 leading-relaxed">
                                    Once your account is deleted, all of its resources and data will be permanently removed.
                                    This action cannot be undone.
                                </p>
                            </div>
                            <button type="button" @click="confirmingDeletion = true"
                                    class="shrink-0 px-4 py-2 rounded-xl bg-red-600 hover:bg-red-500 text-white text-sm font-semibold transition-colors whitespace-nowrap">
                                Delete Account
                            </button>
                        </div>
                        <div x-show="confirmingDeletion"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0"
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm"
                             style="display: none;">
                            <div @click.outside="confirmingDeletion = false"
                                 class="w-full max-w-md bg-zinc-900 border border-zinc-700 rounded-2xl shadow-2xl p-6 space-y-4">
                                <h2 class="text-lg font-bold text-white">Are you sure?</h2>
                                <p class="text-sm text-zinc-400">
                                    Once your account is deleted, all of its resources and data will be permanently deleted.
                                    Please enter your password to confirm.
                                </p>
                                <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4 mt-2">
                                    @csrf
                                    @method('delete')
                                    <div>
                                        <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1.5">Password</label>
                                        <input type="password" name="password" placeholder="Enter your password"
                                               class="w-full bg-zinc-800 border border-zinc-600 rounded-xl px-4 py-2.5 text-sm text-white placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition">
                                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                    </div>
                                    <div class="flex justify-end gap-3 pt-1">
                                        <button type="button" @click="confirmingDeletion = false"
                                                class="px-5 py-2.5 rounded-xl bg-zinc-700 hover:bg-zinc-600 text-white text-sm font-semibold transition-colors">
                                            Cancel
                                        </button>
                                        <button type="submit"
                                                class="px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-500 text-white text-sm font-semibold transition-colors">
                                            Delete Account
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>{{-- /panels --}}
        </div>{{-- /flex --}}
    </div>
</div>

@if ($errors->updatePassword->any())
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const url = new URL(window.location);
        url.searchParams.set('tab', 'password');
        window.history.replaceState({}, '', url);
    });
</script>
@endif
@if ($errors->userDeletion->any())
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const url = new URL(window.location);
        url.searchParams.set('tab', 'danger');
        window.history.replaceState({}, '', url);
    });
</script>
@endif
@endsection
