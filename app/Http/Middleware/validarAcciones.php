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

         $accion_asg=DB::table('accion_perfil')->where(['accion_id'=>(int)$accion,'perfil_id'=>(int)$datos[0]['perfil']])->first();

        if(empty($accion_asg)==false)//si esta asignado
        {
            $accion_act=DB::table('acciones')->select('status_ac')->where(['id'=>(int)$accion,'status_ac'=>1])->first();

            if(empty($accion_asg)==false)//si esta habilitado
            {


            }
            

            
        }


        return $next($request);
    }
}
