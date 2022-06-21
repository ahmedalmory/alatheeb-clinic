<?php

namespace App\Http\Middleware;

use Closure;

class Accountant
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (auth()->user()->isAccountant()) {
            return $next($request);
        }
        return abort(403);
    }
}
