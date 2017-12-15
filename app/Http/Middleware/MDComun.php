<?php

namespace App\Http\Middleware;

use Closure;
use App\Evssa\EvssaConstantes;
use App\Evssa\EvssaPropertie;
class MDComun
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request use App\Evssa\EvssaConstantes; $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $usuario=\Auth::user();

      if($usuario->type=='E'){
        return response()->json([
            EvssaConstantes::NOTIFICACION=> EvssaConstantes::WARNING,
            EvssaConstantes::MSJ=>'comun',
        ]);
      }
      return $next($request);
    }
}
