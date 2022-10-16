<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = '')
    {
        if (!Auth::guard($guard)->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        if($user->superadmin != 1)
            {
                return redirect()->route('dashboard');
            }
        return $next($request);
    }
}
