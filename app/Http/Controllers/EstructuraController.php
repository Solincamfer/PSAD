<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstructuraController extends Controller
{
		public function cargar_header_sidebar_acciones()//obtiene desde la variable, la configuracion para el usuario logueado
	{

		
		$datos=\Session::get('sesion');
		$modulos=\Session::get('modulos');
		$submodulos=\Session::get('submodulos');
		$acciones=\Session::get('acciones');

		$nombre=$datos[0]['nombre'];
		$apellido=$datos[0]['apellido'];
		$acciones=$acciones[0];
		$modulos=$modulos[0];
		$submodulos=$submodulos[0];
	
		return (compact('nombre','apellido','modulos','submodulos','acciones'));
	}

	
	
	
	public function obtener_acciones_submodulo($submodulo_id,$vista)
	{
		$acc_=array();
		$acciones_sub=\DB::table('acciones')->where(['submodulo_id'=>$submodulo_id,'vista'=>$vista])->get();//obtiene las acciones para una vista
		
		foreach($acciones_sub as $acc) 
		{
			array_push($acc_, $acc->id);
		}
		return($acc_);
	}
	public function cargar_acciones_submodulo_perfil($acciones_perfil,$acciones_sm,$accion_agregar)//obtiene las acciones para un submodulo, asociadas a un perfil
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


	
		public function datos_vista_($datos_session,$consulta)
	{
		$valores_vista=array(
								'modulos'=>$datos_session['modulos'],//side bar
								'submodulos'=>$datos_session['submodulos'],//side bar
								'nombre'=>$datos_session['nombre'],//header
								'apellido'=>$datos_session['apellido'],//header
								'consulta'=>$consulta

			);

		return($valores_vista);
	}


	public function datos_vista($datos_session,$datos_acciones,$consulta,$extra=" ",$datosC1=" ",$datosC2=" ",$datosC3=" ",$datosC4=" ",$datosC5=" ",$datosC6=" ")//asocia en un vector los datos que deben pasarse a una vista
	{
		$valores_vista=array(
								'modulos'=>$datos_session['modulos'],//side bar
								'submodulos'=>$datos_session['submodulos'],//side bar
								'nombre'=>$datos_session['nombre'],//header
								'apellido'=>$datos_session['apellido'],//header
								'acciones'=>$datos_acciones['acciones'],//acciones
								'agregar'=>$datos_acciones['agregar'],//boton de agregar
								'consulta'=>$consulta,//registros provenientes de la base de datos
								'extra'=>$extra,
								'datosC1'=>$datosC1,
								'datosC2'=>$datosC2,
								'datosC3'=>$datosC3,
								'datosC4'=>$datosC4,
								'datosC5'=>$datosC5,
								'datosC6'=>$datosC6


								);

		return $valores_vista;	
	}

// Definicion de la estructura de la empresa como prestadora de servicio.

	public function departamentos_cargos($departamento_id)//Inicializacion del submodulo: /departamentos/cargos
	{
		$boton_agregar=7;
		$datos=$this->cargar_header_sidebar_acciones();
		$acc=$this->obtener_acciones_submodulo(2,2);//obtiene las acciones de un submodulo
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],$acc,$boton_agregar);//obtiene las opciones validas para la vista
		$nombre=\DB::table('departamentos')->where('id',$departamento_id)->value('descripcion');
		return view('Registros_Basicos\Departamentos\cargos',$this->datos_vista($datos,$acciones,\DB::table('cargos')->where('departamento_id',$departamento_id)->paginate(4),1,(int)$departamento_id,$nombre));
					
	}


	public function departamentos()//ventana principal de departamentos
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(1,2,3),4);
		
		return view('Registros_Basicos\Departamentos\departamentos',$this->datos_vista($datos,$acciones,\DB::table('departamentos')->get(),0));
					
	}


	public function departamentos_ingresar()
	{

		$nombreD= strtoupper(Request::get('textDpto'));//nombre del departamento, llevado a mayusculas
		$statusD= (int)Request::get('comboDpto');//status del departamento 


		$consulta=\DB::table('departamentos')->where('descripcion',$nombreD)->first();
		

		if (empty($consulta)) //si el registro no existe, se procede a ingresar los datos del departamento
		{
			 \DB::table('departamentos')->insert
					 	(

					 		['descripcion'=>$nombreD,'status'=>$statusD]
					 	);

			$respuesta= 1;
			
		}
		else{
			$respuesta= 0;
		}
		return (int)$respuesta;
	}



	public function cargos_ingresar($departamento_id)
	{
		
		$nombreC= strtoupper(Request::get('textCgo'));//nombre del cargo
		$statusC= (int)Request::get('comboCgo');//status del cargo
		

		$consulta=\DB::table('cargos')->where('descripcion',$nombreC)->first();

		if (empty($consulta)) //si el registro no existe, se procede a ingresar los datos del departamento
		{
			 \DB::table('cargos')->insert
					 	(

					 		['status'=>$statusC,'descripcion'=>$nombreC,'departamento_id'=>$departamento_id]
					 	);
		
	
			$resultado = 1;
		}
		else
		{
			$resultado = 0;
		}
	
		return $resultado;


	}
}
