<x-guest-layout>
<div class="bg-zinc-900 rounded-2xl shadow-2xl ring-1 ring-zinc-800 p-8">

    <div class="mb-7">
        <h1 class="text-2xl font-bold text-white">{{ __('Welcome back') }}</h1>
        <p class="mt-1 text-sm text-zinc-400">{{ __('Sign in to your Yarnly account') }}</p>
    </div>

    {{-- Session Status --}}
    @if(session('status'))
        <div class="mb-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 px-4 py-3 text-sm text-emerald-400">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        {{-- Email --}}
        <div>
            <label for="email" class="block text-xs font-semibold uppercase tracking-wide text-zinc-400 mb-1.5">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   class="w-full rounded-xl bg-zinc-800 border px-4 py-2.5 text-sm text-zinc-100 placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition {{ $errors->has('email') ? 'border-red-500' : 'border-zinc-700' }}">
            @error('email')
                <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="block text-xs font-semibold uppercase tracking-wide text-zinc-400">{{ __('Password') }}</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs text-violet-400 hover:text-violet-300 transition">{{ __('Forgot password?') }}</a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="w-full rounded-xl bg-zinc-800 border px-4 py-2.5 text-sm text-zinc-100 placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition {{ $errors->has('password') ? 'border-red-500' : 'border-zinc-700' }}">
            @error('password')
                <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        {{-- Remember me --}}
        <div class="flex items-center gap-2">
            <input id="remember_me" type="checkbox" name="remember"
                   class="rounded border-zinc-600 bg-zinc-800 text-violet-600 focus:ring-violet-500 focus:ring-offset-zinc-900">
            <label for="remember_me" class="text-sm text-zinc-400">{{ __('Remember me') }}</label>
        </div>

        {{-- Submit --}}
        <button type="submit"
                class="w-full rounded-xl bg-gradient-to-r from-violet-600 to-fuchsia-600 hover:from-violet-500 hover:to-fuchsia-500 px-4 py-2.5 text-sm font-bold text-white shadow-lg shadow-violet-600/25 transition transform hover:-translate-y-0.5 active:translate-y-0">
            {{ __('Sign In') }}
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-zinc-500">
        {{ __("Don't have an account?") }}
        <a href="{{ route('register') }}" class="text-violet-400 hover:text-violet-300 font-semibold transition">{{ __('Create one') }}</a>
    </p>
</div>
</x-guest-layout>
