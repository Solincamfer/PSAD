<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Ajustes extends Controller
{
    
	public function crear_accion($status_ac=1,$descripcion=" ",$url=" ",$data_toogle=" ",$clase_css=" ",$ventana=0,$submodulo_id,$accion_id=true)
	{
		$proximo_id=DB::table('auxiliares')->where('id',1)->first();//obtiene la consulta del proximo id
		
		if ($accion_id==true) 
		{
			$accion_id=$proximo_id->id;//si la accion depende de ella misma
		}

		
		$proximo_id=DB::table('acciones')->insertGetId(
														['status_ac'=>$status_ac,
														'descripcion'=>$descripcion,
														'url'=>$url,
														'data_toogle'=>$data_toogle,
														'clase_css'=>$clase_css,
														'ventana'=>$ventana,
														'orden'=>$orden,
														'submodulo_id'=>$submodulo_id,
														'accion_id'=>$accion_id]
														);//inserta y obtiene el proximo id


		DB::table('auxiliares')->where('id',1)->update(['ultimo'=>$proximo_id]);

		$this->actualizar_perfiles($proximo_id);

	



    public function actualizar_perfiles($id_accion)
    {
    	$perfiles=DB::table('perfiles')->get();
    	$perfilAccion=0;
    	foreach ($perfiles as $perfil) 
    	{
    		$perfilAccion=$perfilAccion+(DB::table('accion_perfil')->insert(['accion_id'=>$id_accion,'perfil_id'=>$perfil->id,'status'=>0]);//se agrega la nueva accion para los perfiles existentes ya activa
    	}

    	
    }


    public function agregar_accion()
    {
    	
   		//$this->crear_accion($status_ac=1,$descripcion=" ",$url=" ",$data_toogle=" ",$clase_css=" ",$ventana=0,$submodulo_id,$accion_id=true);
	
   		$this->actualizar_perfiles(91);
    }



   }


