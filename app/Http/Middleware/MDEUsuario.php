<?php

namespace App\Http\Middleware;

use Closure;

class MDEUsuario
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
        if($usuario->type='A'){
            return view('alert.mensaje')->with("msj","Aun no ha sido asignado como usuario, consulte al administrador del sistema");
        }
        return $next($request);
    }
}
