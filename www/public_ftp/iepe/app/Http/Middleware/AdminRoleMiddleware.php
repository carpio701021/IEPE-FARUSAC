<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $rol)
    {
        //dd(Auth::guard('admin')->user());
        if (! Auth::guard('admin')->user()->tieneRol($rol)) {
            // Redirect...
            return Response('Error: La página que buscas no existe o no tienes acceso', 403);
        }

        return $next($request);
    }
}
