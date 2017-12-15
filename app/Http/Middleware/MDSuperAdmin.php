<?php

namespace App\Http\Middleware;

use Closure;
use App\Evssa\EvssaUtil;
use App\Evssa\EvssaConstantes;
use App\Evssa\EvssaPropertie;
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
          return response()->json([
              EvssaConstantes::NOTIFICACION=> EvssaConstantes::WARNING,
              EvssaConstantes::MSJ=>'super',
          ]);
        }
        return $next($request);
    }
}
