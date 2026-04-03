<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    private const ALLOWED = ['en', 'bg'];

    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guest()) {
            App::setLocale('en');
            return $next($request);
        }

        $locale = $request->cookie('locale', config('app.locale'));

        if (in_array($locale, self::ALLOWED, true)) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
