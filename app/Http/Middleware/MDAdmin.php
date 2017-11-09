<?php

namespace App\Http\Middleware;

use Closure;

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
        if($usuario->type='S'){
            return view('alert.mensaje')->with("msj","No tine suficientes privilegios para acceder a esta sección");
        }
        return $next($request);
    }
}
