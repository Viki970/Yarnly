<x-guest-layout>
<div class="bg-zinc-900 rounded-2xl shadow-2xl ring-1 ring-zinc-800 p-8">

    <div class="mb-7">
        <h1 class="text-2xl font-bold text-white">{{ __('Forgot password?') }}</h1>
        <p class="mt-1 text-sm text-zinc-400">{{ __('No problem. Enter your email and we will send you a reset link.') }}</p>
    </div>

    @if(session('status'))
        <div class="mb-5 rounded-xl bg-emerald-500/10 border border-emerald-500/20 px-4 py-3 text-sm text-emerald-400">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-xs font-semibold uppercase tracking-wide text-zinc-400 mb-1.5">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="w-full rounded-xl bg-zinc-800 border px-4 py-2.5 text-sm text-zinc-100 placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition {{ $errors->has('email') ? 'border-red-500' : 'border-zinc-700' }}">
            @error('email')
                <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full rounded-xl bg-gradient-to-r from-violet-600 to-fuchsia-600 hover:from-violet-500 hover:to-fuchsia-500 px-4 py-2.5 text-sm font-bold text-white shadow-lg shadow-violet-600/25 transition transform hover:-translate-y-0.5 active:translate-y-0">
            {{ __('Send Reset Link') }}
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-zinc-500">
        <a href="{{ route('login') }}" class="text-violet-400 hover:text-violet-300 font-semibold transition">&larr; {{ __('Back to login') }}</a>
    </p>
</div>
</x-guest-layout>
