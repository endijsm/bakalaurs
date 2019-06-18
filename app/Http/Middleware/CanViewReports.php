<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CanViewReports
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
        if (Auth::check() && Auth::user()->canViewReports()) {
            return $next($request);
        }
        else {
            return redirect('/');
        }
    }
}
