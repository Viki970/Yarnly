<x-guest-layout>
<div class="bg-zinc-900 rounded-2xl shadow-2xl ring-1 ring-zinc-800 p-8">

    <div class="mb-7">
        <h1 class="text-2xl font-bold text-white">{{ __('Create your account') }}</h1>
        <p class="mt-1 text-sm text-zinc-400">{{ __('Join the Yarnly crafting community') }}</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        {{-- Name --}}
        <div>
            <label for="name" class="block text-xs font-semibold uppercase tracking-wide text-zinc-400 mb-1.5">{{ __('Full Name') }}</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                   class="w-full rounded-xl bg-zinc-800 border px-4 py-2.5 text-sm text-zinc-100 placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition {{ $errors->has('name') ? 'border-red-500' : 'border-zinc-700' }}">
            @error('name')
                <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        {{-- Username --}}
        <div>
            <label for="username" class="block text-xs font-semibold uppercase tracking-wide text-zinc-400 mb-1.5">{{ __('Username') }}</label>
            <input id="username" type="text" name="username" value="{{ old('username') }}" required autocomplete="off"
                   class="w-full rounded-xl bg-zinc-800 border px-4 py-2.5 text-sm text-zinc-100 placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition {{ $errors->has('username') ? 'border-red-500' : 'border-zinc-700' }}">
            @error('username')
                <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-xs font-semibold uppercase tracking-wide text-zinc-400 mb-1.5">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                   class="w-full rounded-xl bg-zinc-800 border px-4 py-2.5 text-sm text-zinc-100 placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition {{ $errors->has('email') ? 'border-red-500' : 'border-zinc-700' }}">
            @error('email')
                <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-xs font-semibold uppercase tracking-wide text-zinc-400 mb-1.5">{{ __('Password') }}</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   class="w-full rounded-xl bg-zinc-800 border px-4 py-2.5 text-sm text-zinc-100 placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition {{ $errors->has('password') ? 'border-red-500' : 'border-zinc-700' }}">
            @error('password')
                <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div>
            <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-wide text-zinc-400 mb-1.5">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                   class="w-full rounded-xl bg-zinc-800 border px-4 py-2.5 text-sm text-zinc-100 placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition {{ $errors->has('password_confirmation') ? 'border-red-500' : 'border-zinc-700' }}">
            @error('password_confirmation')
                <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit --}}
        <button type="submit"
                class="mt-2 w-full rounded-xl bg-gradient-to-r from-violet-600 to-fuchsia-600 hover:from-violet-500 hover:to-fuchsia-500 px-4 py-2.5 text-sm font-bold text-white shadow-lg shadow-violet-600/25 transition transform hover:-translate-y-0.5 active:translate-y-0">
            {{ __('Create Account') }}
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-zinc-500">
        {{ __('Already have an account?') }}
        <a href="{{ route('login') }}" class="text-violet-400 hover:text-violet-300 font-semibold transition">{{ __('Sign in') }}</a>
    </p>
</div>
</x-guest-layout>
