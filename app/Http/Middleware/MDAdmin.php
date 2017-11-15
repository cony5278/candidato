<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;


class MDAdmin
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
        if($usuario->type=='A'){
            Session::flash("notificacion","DANGER");
            Session::flash("msj","No tiene privilegios para acceder a este recurso consulte al administrador del sistema");
         }
        return $next($request);
    }
}
