<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check()) {
            switch ($guard) {
                case 'customer':
                    return redirect()->route('customer.login');
                case 'web':
                default:
                    return redirect()->route('login');
            }
        }

        return $next($request);
    }
}
