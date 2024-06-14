<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        // Check if the user is authenticated and not verified
        if (!Auth::guard('customer')->user()->customer->verified) {
            return redirect()->route('customer.not.verified');
        }


        // Allow the request to proceed if the user is verified
        return $next($request);
    }
}