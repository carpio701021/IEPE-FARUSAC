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
        if($rol=='secretario_decano_jefe_bienestar'){
            $user=Auth::guard('admin')->user();
            if (!$user->tieneRol('secretario') && !$user->tieneRol('decano') && !$user->tieneRol('jefe_bienestar')) {
                // Redirect...
                return Response('Error: La página que buscas no existe o no tienes acceso', 403);
            }
        }else if($rol=='directores'){
            $user=Auth::guard('admin')->user();
            if (!$user->tieneRol('director_arquitectura') && !$user->tieneRol('director_disenio_grafico')) {
                // Redirect...
                return Response('Error: La página que buscas no existe o no tienes acceso', 403);
            }
        }else
            if (! Auth::guard('admin')->user()->tieneRol($rol)) {
                // Redirect...
                return Response('Error: La página que buscas no existe o no tienes acceso', 403);
            }

        return $next($request);
    }
}
