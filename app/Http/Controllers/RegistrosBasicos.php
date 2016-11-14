<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;


class RegistrosBasicos extends Controller 
{
    
	public function cargar_header_sidebar_acciones()
	{

		
		$datos=Session::get('sesion');
		$modulos=Session::get('modulos');
		$submodulos=Session::get('submodulos');
		$acciones=Session::get('acciones');

		$nombre=$datos[0]['nombre'];
		$apellido=$datos[0]['apellido'];
		$acciones=$acciones[0];
		$modulos=$modulos[0];
		$submodulos=$submodulos[0];
	
		return (compact('nombre','apellido','modulos','submodulos','acciones'));
	}

	
	
	
	public function cargar_acciones_submodulo_perfil($acciones_perfil,$acciones_sm,$accion_agregar)
	{
		

		$acciones=array();
		$agregar=false;


		foreach ($acciones_perfil as $accion) 
			{
				if((in_array($accion->id, $acciones_sm) )and ($accion->status_ac==1))
				{
					array_push($acciones, $accion);
				}
				else if (($accion->id==$accion_agregar)and($accion->status_ac==1))
			 	{
					$agregar=true;
				}
			}
        return(compact('acciones','agregar'));

	}



	public function cargos($departamento_id)
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(5,6),7);

		$cargos=DB::table('cargos')->where('departamento_id',$departamento_id)->get();

		return view('cargos',
					['modulos'=>$datos['modulos'],
					 'submodulos'=>$datos['submodulos'],
					 'nombre'=>$datos['nombre'],
					 'apellido'=>$datos['apellido'],
					 'cargos'=>$cargos,
					 'acciones'=>$acciones['acciones'],
					 'agregar'=>$acciones['agregar']
					 ]
					 );
	}



	public function departamentos()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(1,2,3),4);
		$departamentos=DB::table('departamentos')->get();

		return view('departamentos',
					[
					 'modulos'=>$datos['modulos'],
					 'submodulos'=>$datos['submodulos'],
					 'acciones'=>$acciones['acciones'],
					 'nombre'=>$datos['nombre'],
					 'apellido'=>$datos['apellido'],
					 'departamentos'=>$departamentos,
					 'agregar'=>$acciones['agregar']
					 ]
					 );
	}



	public function servicios()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view('planes', 
					[
					 'modulos'=>$datos['modulos'],
					 'submodulos'=>$datos['submodulos'],
					 'nombre'=>$datos['nombre'],
					 'apellido'=>$datos['apellido'],
					 ]
					 );
	}
	


	public function clientes()
	{
		$datos=$this->cargar_header_sidebar_acciones();
			return view('clientes', 
					[
					 'modulos'=>$datos['modulos'],
					 'submodulos'=>$datos['submodulos'],
					 'nombre'=>$datos['nombre'],
					 'apellido'=>$datos['apellido'],
					 ]
					 );
	}

}
