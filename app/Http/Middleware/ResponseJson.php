<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;

class ResponseJson
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
        $uri = ltrim($request->getRequestUri(),'/');

        if (Str::startsWith(strtolower($uri),'api')) {
            $request->headers->set('Accept', 'application/json');
        }

        return $next($request);
    }
}
