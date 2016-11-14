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

	
	
	


	public function cargos($departamento_id)
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$cargos=DB::table('cargos')->where('departamento_id',$departamento_id)->get();
		$agregar=false;
		$acciones=array();
		$acciones_sd=array(5,6);

		foreach ($datos['acciones'] as $accion) 
			{
				if((in_array($accion->id, $acciones_sd) )and ($accion->status_ac==1))
				{
					array_push($acciones, $accion);
				}
				else if (($accion->id==7)and($accion->status_ac==1))
			 	{
					$agregar=true;
				}
			}

		return view('cargos',
					['modulos'=>$datos['modulos'],
					 'submodulos'=>$datos['submodulos'],
					 'nombre'=>$datos['nombre'],
					 'apellido'=>$datos['apellido'],
					 'cargos'=>$cargos,
					 'acciones'=>$acciones,
					 'agregar'=>$agregar
					 ]
					 );
	}



	public function departamentos()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		
		$agregar=false;
		$acciones=array();
		$acciones_sd=array(1,2,3);
		foreach ($datos['acciones'] as $accion) 
			{
				if((in_array($accion->id, $acciones_sd) )and ($accion->status_ac==1))
				{
					array_push($acciones, $accion);
				}
				else if (($accion->id==4)and($accion->status_ac==1))
			 	{
					$agregar=true;
				}
			}
		
		$departamentos=DB::table('departamentos')->get();


		return view('departamentos',
					[
					 'modulos'=>$datos['modulos'],
					 'submodulos'=>$datos['submodulos'],
					 'acciones'=>$acciones,
					 'nombre'=>$datos['nombre'],
					 'apellido'=>$datos['apellido'],
					 'departamentos'=>$departamentos,
					 'agregar'=>$agregar
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
