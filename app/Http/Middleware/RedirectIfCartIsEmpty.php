<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Facades\Cart as CartFacade;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfCartIsEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $cart = CartFacade::get();
        $cartCount = count($cart['products']);
        if ($cartCount == 0) {

            return redirect()->route('customer.index');
        }

        return $next($request);
    }

}
