<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use App\Evssa\EvssaConstantes;
use App\Evssa\EvssaPropertie;
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
        if($usuario->type=='E'){
          return response()->json([
              EvssaConstantes::NOTIFICACION=> EvssaConstantes::DANGER,
              EvssaConstantes::MSJ=>'admin',
          ]);
        }
        return $next($request);
    }
}
