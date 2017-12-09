<?php

namespace App\Http\Middleware;

use Closure;

class MDSuperAdmin
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
        if($usuario->type=='A' || $usuario->type=='E'){
          return  redirect('/')->withInput()->with(["notificacion"=>"DANGER","msj"=>"No tiene privilegios para acceder a este recurso consulte al administrador del sistema"]);
        }
        return $next($request);
    }
}
