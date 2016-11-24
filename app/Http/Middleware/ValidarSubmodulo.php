<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Session;

class ValidarSubmodulo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$submodulo)
    {
        $datos=Session::get('sesion');//obtener datos de la session 
        
        $submodulo_asig=DB::table('perfil_submodulo')->where(['perfil_id'=>$datos[0]['perfil'],'submodulo_id'=>(int)$submodulo])->first();//si el modulo esta asignado al perfil logueado
       

        if(empty($submodulo_asig)==false)//si esta asignado
        {
            $estatus=DB::table('submodulos')->select('status_sm')->where(['id'=>(int)$submodulo,'status_sm'=>1])->first();//si es submodulo esta activo
            if(empty($estatus)==false)
               {

                return $next($request);
               } 
              else
              {

                 return redirect('/menu');
              } 
        }
        else
        {
            return redirect('/menu');
        }

        return $next($request);
    }




}
