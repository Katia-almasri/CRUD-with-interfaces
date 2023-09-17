<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class isAdmin
{
    
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->is_admin==1)
            return $next($request);
        //unauthorized
        abort(403);

    }
}
