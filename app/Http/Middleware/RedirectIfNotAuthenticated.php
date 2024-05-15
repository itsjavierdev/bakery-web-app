<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RedirectIfNotAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check()) {
            Session::put('previous_url', $request->url());
            switch ($guard) {
                case 'customer':
                    return redirect()->route('customer.login');
                case 'web':
                default:
                    return redirect()->to('admin/login');
            }
        }

        return $next($request);
    }
}
