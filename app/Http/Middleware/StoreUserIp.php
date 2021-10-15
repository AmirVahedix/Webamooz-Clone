<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StoreUserIp
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
        if (auth()->check() && auth()->user()->ip != $request->ip()) {
            auth()->user()->update([ 'ip' => $request->ip() ]);
        }

        return $next($request);
    }
}
