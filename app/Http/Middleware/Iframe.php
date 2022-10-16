<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class Iframe
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
         $response = $next($request);
         $response->header('X-Frame-Options', 'ALLOW FROM http://devapps.intelligra.io:108/');
         return $response;

    }
}


