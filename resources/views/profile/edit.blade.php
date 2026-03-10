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
            <h1 class="text-xl font-bold">Edit Profile</h1>
        </div>

        {{-- Avatar preview --}}
        <div class="flex flex-col items-center mb-8">
            <div class="relative group cursor-pointer" onclick="document.getElementById('profile_picture').click()">
                @if(auth()->user()->profile_picture)
                    <img id="avatar-preview"
                         src="{{ asset('storage/' . auth()->user()->profile_picture) }}"
                         alt="Profile picture"
                         class="w-24 h-24 rounded-full object-cover ring-2 ring-zinc-700">
                @else
                    <div id="avatar-initials" class="w-24 h-24 rounded-full bg-gradient-to-br from-violet-500 via-purple-500 to-indigo-500 flex items-center justify-center text-3xl font-bold text-white ring-2 ring-zinc-700">
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
                Change photo
            </button>
            <p class="mt-1 text-xs text-zinc-500">jpg, jpeg, png, gif, webp &mdash; max 5 MB</p>
        </div>

        {{-- Profile Info Form --}}
        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('patch')

            <input id="profile_picture" name="profile_picture" type="file"
                   accept="image/jpeg,image/png,image/gif,image/webp,image/bmp"
                   class="hidden"
                   onchange="previewAvatar(this)">

            @error('profile_picture')
                <p class="text-sm text-red-400">{{ $message }}</p>
            @enderror

            {{-- Username --}}
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1.5">Username</label>
                <input type="text" name="username" value="{{ old('username', auth()->user()->username) }}" required
                       class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition">
                @error('username')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Full name --}}
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1.5">Full Name</label>
                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                       class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition">
                @error('name')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-zinc-400 mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                       class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition">
                @error('email')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror

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

            {{-- Save button --}}
            <div class="pt-2 flex items-center gap-4">
                <button type="submit"
                        class="px-8 py-2.5 rounded-xl bg-violet-600 hover:bg-violet-500 text-white text-sm font-semibold transition-colors">
                    Save
                </button>
                @if (session('status') === 'profile-updated')
                    <span x-data="{ show: true }" x-show="show" x-transition
                          x-init="setTimeout(() => show = false, 2000)"
                          class="text-sm text-green-400">Saved!</span>
                @endif
            </div>
        </form>

        <hr class="border-zinc-800 my-8">

        {{-- Change Password --}}
        <div>
            <h2 class="text-base font-bold mb-5">Change Password</h2>
            @include('profile.partials.update-password-form')
        </div>

        <hr class="border-zinc-800 my-8">

        {{-- Delete Account --}}
        <div>
            <h2 class="text-base font-bold text-red-400 mb-5">Danger Zone</h2>
            @include('profile.partials.delete-user-form')
        </div>

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
    };
    reader.readAsDataURL(input.files[0]);
}
</script>
@endsection
