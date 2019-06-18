<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CanDefineCatalogs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->canDefineCatalog()) {
            return $next($request);
        }
        else {
            return redirect('/');
        }
    }
}
