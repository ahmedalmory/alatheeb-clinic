<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LangLoc
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('lang_loc'))
            app()->setLocale(session('lang_loc'));
//        dd(app()->getLocale());
        return $next($request);
    }
}
