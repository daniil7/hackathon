<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        if (Auth::user() and Auth::user()->is_admin == true) {
            return $next($request);
        }

        abort(403, 'Access denied');    
    }
}

