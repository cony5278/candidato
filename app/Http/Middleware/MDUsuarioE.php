<?php

namespace App\Http\Middleware;

use Closure;

class MDUsuarioE
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
        $usuario=\Auth::user();
        if($usuario->type='E'){
          //  return  redirect('/')->withInput()->with("msj","Aun no ha sido asignado como usuario, consulte al administrador del sistema");
        }
        return $next($request);
    }
}