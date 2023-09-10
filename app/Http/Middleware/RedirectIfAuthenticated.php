<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        if(Auth::guard('web')->check() )
            return redirect(RouteServiceProvider::PRODUCTS);
        return $next($request);
    }
}