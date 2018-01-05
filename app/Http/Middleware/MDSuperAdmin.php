<?php

namespace App\Http\Middleware;

use Closure;
use App\Evssa\EvssaUtil;
use App\Evssa\EvssaConstantes;
use App\Evssa\EvssaPropertie;
use Illuminate\Support\Facades\Session;
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
          if($request->ajax()) {
            return response()->json([
                EvssaConstantes::NOTIFICACION=> EvssaConstantes::DANGER,
                EvssaConstantes::MSJ=>"No tiene privilegios para acceder a este recurso consulte al administrador del sistema",
            ],400);
          }else{
            Session::flash(EvssaConstantes::NOTIFICACION,EvssaConstantes::DANGER);
            Session::flash(EvssaConstantes::MSJ,"No tiene privilegios para acceder a este recurso consulte al administrador del sistema");
            return redirect()->to("home");
          }

        }
        return $next($request);
    }
}
