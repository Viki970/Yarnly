<?php

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Features;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        $user = $this->validateCredentials();

        if (Features::canManageTwoFactorAuthentication() && $user->hasEnabledTwoFactorAuthentication()) {
            Session::put([
                'login.id' => $user->getKey(),
                'login.remember' => $this->remember,
            ]);

            $this->redirect(route('two-factor.login'), navigate: true);

            return;
        }

        Auth::login($user, $this->remember);

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('home', absolute: false), navigate: true);
    }

    /**
     * Validate the user's credentials.
     */
    protected function validateCredentials(): User
    {
        $user = Auth::getProvider()->retrieveByCredentials(['email' => $this->email, 'password' => $this->password]);

        if (! $user || ! Auth::getProvider()->validateCredentials($user, ['password' => $this->password])) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        return $user;
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}; ?>

<!-- Welcome Back to Yarnly - Enhanced Login -->
<div class="flex flex-col gap-8">
    <!-- Enhanced Header with Yarn/Craft Theme -->
    <div class="text-center space-y-4">
        <div class="inline-flex h-20 w-20 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 via-indigo-500 to-sky-500 mb-4 shadow-xl shadow-blue-500/30">
            <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
        </div>
        <h1 class="bg-gradient-to-r from-blue-600 via-indigo-600 to-sky-600 bg-clip-text text-3xl font-bold text-transparent dark:from-blue-400 dark:via-indigo-400 dark:to-sky-400">
            Welcome Back to Yarnly
        </h1>
        <p class="text-zinc-600 dark:text-zinc-300">
            Sign in to continue your crafting journey
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <!-- Enhanced Form with Better Styling -->
    <form method="POST" wire:submit="login" class="flex flex-col gap-6">
        <!-- Email Address -->
        <div class="space-y-2">
            <flux:input
                wire:model="email"
                :label="__('Email address')"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="your@email.com"
                class="border-zinc-200 focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:focus:border-blue-400"
            />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <div class="relative">
                <flux:input
                    wire:model="password"
                    :label="__('Password')"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Enter your password')"
                    viewable
                    class="border-zinc-200 focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:focus:border-blue-400"
                />

                @if (Route::has('password.request'))
                    <div class="mt-2 text-right">
                        <flux:link 
                            class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300" 
                            :href="route('password.request')" 
                            wire:navigate
                        >
                            {{ __('Forgot your password?') }}
                        </flux:link>
                    </div>
                @endif
            </div>
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <flux:checkbox 
                wire:model="remember" 
                :label="__('Remember me')" 
                class="text-blue-600 focus:ring-blue-500 dark:text-blue-400"
            />
        </div>

        <!-- Enhanced Submit Button -->
        <div class="space-y-4">
            <flux:button 
                variant="primary" 
                type="submit" 
                class="w-full bg-gradient-to-r from-blue-600 via-indigo-600 to-sky-600 hover:from-blue-700 hover:via-indigo-700 hover:to-sky-700 text-white font-semibold py-3 px-4 rounded-xl shadow-lg shadow-blue-500/30 transition-all duration-200 hover:shadow-blue-600/40 hover:scale-[1.02]" 
                data-test="login-button"
            >
                <span class="flex items-center justify-center gap-2">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    {{ __('Sign In') }}
                </span>
            </flux:button>
        </div>
    </form>

    <!-- Enhanced Sign Up Link -->
    @if (Route::has('register'))
        <div class="text-center">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-zinc-200 dark:border-zinc-700"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-zinc-500 dark:bg-zinc-900 dark:text-zinc-400">
                        New to Yarnly?
                    </span>
                </div>
            </div>
            <div class="mt-4">
                <flux:link 
                    :href="route('register')" 
                    wire:navigate
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl border-2 border-blue-200 bg-blue-50 text-blue-700 font-semibold transition-all duration-200 hover:border-blue-300 hover:bg-blue-100 dark:border-blue-700 dark:bg-blue-900/20 dark:text-blue-300 dark:hover:border-blue-600 dark:hover:bg-blue-900/40"
                >
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    {{ __('Create Account') }}
                </flux:link>
            </div>
        </div>
    @endif
</div>
