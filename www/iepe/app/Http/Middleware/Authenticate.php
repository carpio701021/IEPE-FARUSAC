<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
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

        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                if($guard=='admin')
                    return redirect()->guest( action('AuthAdmin\AuthController@showLoginForm') );
                else
                    return redirect()->guest( action('Auth\AuthController@showLoginForm') );
            }
        }

        if($guard=='aspirante_web')
        if(!($request->path() == 'aspirante/actualizarCUI' || $request->path() == 'aspirantes')){
            if(! isset(Auth::user()->CUI ))
                return redirect( action('formularioController@actualizarCUI') );
            else if(!($request->path() == 'aspirante/formulario' || $request->path() == 'aspirantes')){
                if(!Auth::user()->getFormulario())
                    return redirect( action('formularioController@index') );
            }
        }

        return $next($request);
    }
}
