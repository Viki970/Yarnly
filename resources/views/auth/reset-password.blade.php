<x-guest-layout>
<div class="bg-zinc-900 rounded-2xl shadow-2xl ring-1 ring-zinc-800 p-8">

    <div class="mb-7">
        <h1 class="text-2xl font-bold text-white">{{ __('Reset your password') }}</h1>
        <p class="mt-1 text-sm text-zinc-400">{{ __('Choose a strong new password for your account.') }}</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label for="email" class="block text-xs font-semibold uppercase tracking-wide text-zinc-400 mb-1.5">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                   class="w-full rounded-xl bg-zinc-800 border px-4 py-2.5 text-sm text-zinc-100 placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition {{ $errors->has('email') ? 'border-red-500' : 'border-zinc-700' }}">
            @error('email')
                <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-xs font-semibold uppercase tracking-wide text-zinc-400 mb-1.5">{{ __('New Password') }}</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   class="w-full rounded-xl bg-zinc-800 border px-4 py-2.5 text-sm text-zinc-100 placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition {{ $errors->has('password') ? 'border-red-500' : 'border-zinc-700' }}">
            @error('password')
                <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-wide text-zinc-400 mb-1.5">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                   class="w-full rounded-xl bg-zinc-800 border px-4 py-2.5 text-sm text-zinc-100 placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition {{ $errors->has('password_confirmation') ? 'border-red-500' : 'border-zinc-700' }}">
            @error('password_confirmation')
                <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full rounded-xl bg-gradient-to-r from-violet-600 to-fuchsia-600 hover:from-violet-500 hover:to-fuchsia-500 px-4 py-2.5 text-sm font-bold text-white shadow-lg shadow-violet-600/25 transition transform hover:-translate-y-0.5 active:translate-y-0">
            {{ __('Reset Password') }}
        </button>
    </form>
</div>
</x-guest-layout>
