<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Session;

class validarAcciones
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$accion)
    {
       
         $datos=Session::get('sesion');//obtener datos de la session 

        return $next($request);
    }
}
