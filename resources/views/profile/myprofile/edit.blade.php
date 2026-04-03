@extends('layout.app')

@section('title', 'Edit Profile · Yarnly')

@section('content')
<div class="min-h-screen bg-zinc-950 text-white py-10">
    <div class="max-w-xl mx-auto px-4">

        {{-- Header --}}
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('profile.show') }}" class="text-zinc-400 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h1 class="text-xl font-bold">{{ __('Edit Profile') }}</h1>
        </div>

        {{-- Avatar preview --}}
        <div class="flex flex-col items-center mb-8">
            <div class="relative group cursor-pointer" onclick="document.getElementById('profile_picture').click()">
                @if(auth()->user()->hasProfileImage())
                    <img id="avatar-preview"
                         src="{{ asset('storage/' . auth()->user()->profile_picture) }}"
                         alt="Profile picture"
                         class="w-24 h-24 rounded-full object-cover ring-2 ring-zinc-700">
                @else
                    @php $initBg = auth()->user()->avatarColor() ? 'background-color: ' . auth()->user()->avatarColor() : 'background: linear-gradient(135deg, #8b5cf6, #a855f7, #6366f1)'; @endphp
                    <div id="avatar-initials"
                         class="w-24 h-24 rounded-full flex items-center justify-center text-3xl font-bold text-white ring-2 ring-zinc-700"
                         style="<?= e($initBg) ?>">
                        {{ auth()->user()->initials() }}
                    </div>
                    <img id="avatar-preview" src="" alt="Profile picture" class="w-24 h-24 rounded-full object-cover ring-2 ring-zinc-700 hidden">
                @endif
                <div class="absolute inset-0 rounded-full bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </div>
            <button type="button" onclick="document.getElementById('profile_picture').click()"
                    class="mt-3 text-sm font-semibold text-violet-400 hover:text-violet-300 transition-colors">
                {{ __('Change photo') }}
            </button>
            <p class="mt-1 text-xs text-zinc-500">{{ __('jpg, jpeg, png, gif, webp — max 5 MB') }}</p>

            {{-- Color picker — only shown when there is no real profile photo --}}
            @if(!auth()->user()->hasProfileImage())
            <div id="color-picker-section" class="mt-5 w-full">
                <p class="text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-3 text-center">{{ __('Or choose a circle color') }}</p>
                <div class="flex flex-wrap justify-center gap-2" id="color-swatches">
                    @php
                        $swatches = [
                            '#ef4444' => 'Red',
                            '#f97316' => 'Orange',
                            '#f59e0b' => 'Amber',
                            '#84cc16' => 'Lime',
                            '#10b981' => 'Emerald',
                            '#14b8a6' => 'Teal',
                            '#06b6d4' => 'Cyan',
                            '#3b82f6' => 'Blue',
                            '#6366f1' => 'Indigo',
                            '#8b5cf6' => 'Violet',
                            '#e879f9' => 'Fuchsia',
                            '#ec4899' => 'Pink',
                        ];
                        $currentColor = auth()->user()->avatarColor() ?? '#8b5cf6';
                    @endphp
                    @foreach($swatches as $hex => $label)
                        @php $swatchStyle = 'background-color: ' . $hex; @endphp
                        <button type="button"
                                onclick="selectColor('{{ $hex }}')"
                                title="{{ $label }}"
                                class="swatch-btn w-8 h-8 rounded-full transition-all duration-150 ring-2 {{ $currentColor === $hex ? 'ring-white scale-110' : 'ring-transparent hover:scale-105' }}"
                                style="<?= e($swatchStyle) ?>"
                                data-color="{{ $hex }}">
                        </button>
                    @endforeach
                    {{-- Custom color input --}}
                    <label class="w-8 h-8 rounded-full ring-2 ring-zinc-600 hover:ring-zinc-400 overflow-hidden cursor-pointer transition-all" title="Custom color">
                        <input type="color" id="custom-color-input"
                               value="{{ $currentColor }}"
                               onchange="selectColor(this.value)"
                               class="opacity-0 w-0 h-0 absolute">
                        <span class="flex w-full h-full items-center justify-center text-zinc-400 text-lg">+</span>
                    </label>
                </div>
            </div>
            @endif
        </div>

        {{-- Profile Info Form --}}
        <form id="profile-update-form" method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('patch')

            <input type="hidden" name="avatar_color" id="avatar_color_input" value="{{ $currentColor }}">

            <input id="profile_picture" name="profile_picture" type="file"
                   accept="image/jpeg,image/png,image/gif,image/webp,image/bmp"
                   class="hidden"
                   onchange="previewAvatar(this)">

            @error('profile_picture')
                <p class="text-sm text-red-400">{{ $message }}</p>
            @enderror

            {{-- Username --}}
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1.5">{{ __('Username') }}</label>
                <input type="text" name="username" value="{{ old('username', auth()->user()->username) }}" required
                       class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition">
                @error('username')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Full name --}}
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1.5">{{ __('Full Name') }}</label>
                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                       class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition">
                @error('name')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Bio --}}
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1.5">{{ __('Bio') }}</label>
                <textarea name="bio" maxlength="200" rows="3"
                          x-data="{ count: {{ strlen(old('bio', auth()->user()->bio ?? '')) }} }"
                          x-on:input="count = $el.value.length"
                          class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition resize-none"
                          placeholder="{{ __('Write a short bio...') }}">{{ old('bio', auth()->user()->bio) }}</textarea>
                <p class="mt-1 text-xs text-zinc-500 text-right"><span x-text="count">{{ strlen(old('bio', auth()->user()->bio ?? '')) }}</span>/200</p>
                @error('bio')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email (read-only) --}}
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1.5">{{ __('Email') }}</label>
                <div class="flex items-center gap-3 px-4 py-3.5 bg-zinc-900 border border-zinc-700 rounded-xl">
                    <svg class="w-5 h-5 text-zinc-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-base text-zinc-300">{{ auth()->user()->email }}</span>
                    <span class="ml-auto text-sm text-zinc-500 whitespace-nowrap">{{ __('Change in') }}
                        <a href="{{ route('profile.settings') }}?tab=password" class="text-violet-400 hover:text-violet-300 underline underline-offset-2">{{ __('Settings') }}</a>
                    </span>
                </div>
            </div>

            {{-- Save button --}}
            <div class="pt-2">
                <button type="submit"
                        class="px-8 py-2.5 rounded-xl bg-violet-600 hover:bg-violet-500 text-white text-sm font-semibold transition-colors">
                    {{ __('Save') }}
                </button>
            </div>
        </form>

    </div>
</div>

<script>
function previewAvatar(input) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        const preview = document.getElementById('avatar-preview');
        const initials = document.getElementById('avatar-initials');
        preview.src = e.target.result;
        preview.classList.remove('hidden');
        if (initials) initials.classList.add('hidden');
        // Hide color picker once a photo is chosen
        const section = document.getElementById('color-picker-section');
        if (section) section.classList.add('hidden');
    };
    reader.readAsDataURL(input.files[0]);
}

function selectColor(hex) {
    const initials = document.getElementById('avatar-initials');
    if (initials) {
        initials.style.background = hex;
    }
    // Update hidden input
    const input = document.getElementById('avatar_color_input');
    if (input) input.value = hex;
    // Update custom color picker value
    const customInput = document.getElementById('custom-color-input');
    if (customInput) customInput.value = hex;
    // Update swatch ring
    document.querySelectorAll('.swatch-btn').forEach(btn => {
        const isActive = btn.dataset.color === hex;
        btn.classList.toggle('ring-white', isActive);
        btn.classList.toggle('scale-110', isActive);
        btn.classList.toggle('ring-transparent', !isActive);
    });
}
</script>
@endsection
