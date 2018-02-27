<?php

namespace App\Http\Middleware\Star;

use Closure;
use Illuminate\Support\Facades\Session;

class FlushQueryMiddleare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Session::has('query')) {
            Session::forget('query');
        }

        return $next($request);
    }
}
