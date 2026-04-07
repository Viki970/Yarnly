<?php

namespace App\Providers;

use App\Notifications\NotificationBell;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            return $user->role === 'admin' ? true : null;
        });

        Livewire::component('notification-bell', NotificationBell::class);
    }
}
