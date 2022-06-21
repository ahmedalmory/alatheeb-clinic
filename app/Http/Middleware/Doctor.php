<?php

namespace App\Http\Middleware;

use Closure;

class Doctor
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
        if (auth()->check() && auth()->user()->isDoctor()) {
            return $next($request);
        }
        return redirect(url('login'));
    }
}
