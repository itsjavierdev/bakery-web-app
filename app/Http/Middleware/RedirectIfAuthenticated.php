<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            switch ($guard) {
                case 'customer':
                    return redirect()->route('customer.index');
                case 'web':
                default:
                    return redirect()->route('admin');
            }
        }

        return $next($request);
    }
}