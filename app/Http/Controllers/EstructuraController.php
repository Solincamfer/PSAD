<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Director;
use App\Departamento;

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

	public function departamentos()//ventana principal de Estructura
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(1,2,3),4);
		$direcciones= \App\Director::all();
		$direccionesf=\DB::table('departamentos')->join('directores','departamentos.director_id','=','directores.id')
								   			     ->select('directores.*')
									             ->whereNotNull('departamentos.director_id')
									             ->distinct()
									             ->get();
		$departamentos=\App\Departamento::all();
		$areas=\App\Area::all();
		$cargos=\App\Cargo::all();

		return view('Registros_Basicos.Departamentos.departamentos',$this->datos_vista($datos,$acciones,$direcciones,$departamentos,$areas,$cargos,$direccionesf));

	}

	public function mostrarEstructuraDireccion(){ //Obtener el id de la direccion y buscar departamentos, areas y cargos asociados.
		$argumento=\Request::get('data');
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(1,2,3),4);

		if ($argumento[1]=='dep') {
			$consulta=\DB::table('departamentos')->join('directores','departamentos.director_id','=','directores.id')
								   			     ->select('directores.*')
								   			     ->where('directores.id',$argumento[0])
									             ->whereNotNull('departamentos.director_id')
									             ->distinct()
									             ->get();
			$query=\App\Departamento::where('director_id',$argumento[0])->get();
			return view('Registros_Basicos.Departamentos.partials.listaDatos',$this->datos_vista(0,$acciones,$consulta,$query));
		}
		elseif ($argumento[1]=='area') {
			$consulta=\DB::table('areas')->join('departamentos','areas.departamento_id','=','departamentos.id')
										 ->join('directores','departamentos.director_id','=','directores.id')
						   			     ->select('departamentos.*')
						   			     ->where('directores.id',$argumento[0])
							             ->whereNotNull('areas.departamento_id')
							             ->distinct()
							             ->get();
			$query=\DB::table('areas')->join('departamentos','areas.departamento_id','=','departamentos.id')
									  ->join('directores','departamentos.director_id','=','directores.id')
									  ->select('areas.*')
									  ->where('directores.id',$argumento[0])->get();

			return view('Registros_Basicos.Departamentos.partials.listarAreas',$this->datos_vista(0,$acciones,$consulta,$query));
		}
		else {
			$consulta=\DB::table('cargos')->join('areas','cargos.area_id','=','areas.id')
										  ->join('departamentos','areas.departamento_id','=','departamentos.id')
										  ->join('directores','departamentos.director_id','=','directores.id')
						   			      ->select('areas.*')
						   			      ->where('directores.id',$argumento[0])
							              ->whereNotNull('cargos.area_id')
							              ->distinct()
							              ->get();

			$query=\DB::table('cargos')->join('areas','cargos.area_id','=','areas.id')
									   ->join('departamentos','areas.departamento_id','=','departamentos.id')
									   ->join('directores','departamentos.director_id','=','directores.id')
									   ->select('cargos.*')
									   ->where('directores.id',$argumento[0])->get();
			return view('Registros_Basicos\Departamentos\partials\listarCargos',$this->datos_vista(0,$acciones,$consulta,$query));
		}
	}


	public function mostrarEstructuraTodos(){ // METODO UTILIZADO PARA MOSTRAR TODOS LOS REGISTROS EN CASO QUE NO SE SELECCIONE NINGUNA 											 DIRECCION, DEPENDIENDO DE LA PESTAÑA QUE ESTE ACTIVA
		$argumento=\Request::get('data');
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(1,2,3),4);
		if ($argumento[1]=='dep') {
			$consulta=\DB::table('departamentos')->join('directores','departamentos.director_id','=','directores.id')
								   			     ->select('directores.*')
									             ->whereNotNull('departamentos.director_id')
									             ->distinct()
									             ->get();
			$query=\App\Departamento::all();
			return view('Registros_Basicos.Departamentos.partials.listaDatos',$this->datos_vista(0,$acciones,$consulta,$query));
		}
		elseif ($argumento[1]=='area') {
			$consulta=\DB::table('areas')->join('departamentos','areas.departamento_id','=','departamentos.id')
								   			     ->select('departamentos.*')
									             ->whereNotNull('areas.departamento_id')
									             ->distinct()
									             ->get();
			$query=\App\Area::all();
			return view('Registros_Basicos.Departamentos.partials.listarAreas',$this->datos_vista(0,$acciones,$consulta,$query));
		}
		else {
			$consulta=\DB::table('cargos')->join('areas','cargos.area_id','=','areas.id')
								   			     ->select('areas.*')
									             ->whereNotNull('cargos.area_id')
									             ->distinct()
									             ->get();
			$query=\App\Cargo::all();
			return view('Registros_Basicos.Departamentos.partials.listarCargos',$this->datos_vista(0,$acciones,$consulta,$query));
		}
	}

	public Function buscarDepartamentos(){
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(1,2,3),4);
		$direccionId=\Request::get('data');
		if ($direccionId!=0) {
			$consulta=\DB::table('departamentos')->join('directores','departamentos.director_id','=','directores.id')
								   			     ->select('directores.*')
								   			     ->where('directores.id',$direccionId)
									             ->whereNotNull('departamentos.director_id')
									             ->distinct()
									             ->get();
			$query=\DB::table('departamentos')->join('directores','departamentos.director_id','=','directores.id')
											  ->select('departamentos.*')
											  ->where('directores.id',$direccionId)->get();
		}
		else {
			$consulta=\DB::table('departamentos')->join('directores','departamentos.director_id','=','directores.id')
								   			     ->select('directores.*')
									             ->whereNotNull('departamentos.director_id')
									             ->distinct()
									             ->get();
			$query=\App\Departamento::all();
		}

		return view('Registros_Basicos.Departamentos.partials.listaDatos',$this->datos_vista(0,$acciones,$consulta,$query));
	}

	public Function buscarAreas(){
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(1,2,3),4);
		$data=\Request::get('data');
		if(empty($data[1])){
			if ($data[0]==0) {
				$consulta=\DB::table('areas')->join('departamentos','areas.departamento_id','=','departamentos.id')
									   			     ->select('departamentos.*')
										             ->whereNotNull('areas.departamento_id')
										             ->distinct()
										             ->get();
				$query=\App\Area::all();
			}
			else {
				$consulta=\DB::table('areas')->join('departamentos','areas.departamento_id','=','departamentos.id')
											 ->join('directores','departamentos.director_id','=','directores.id')
							   			     ->select('departamentos.*')
							   			     ->where('directores.id',$data[0])
								             ->whereNotNull('areas.departamento_id')
								             ->distinct()
								             ->get();
				$query=\DB::table('areas')->join('departamentos','areas.departamento_id','=','departamentos.id')
																	->join('directores','departamentos.director_id','=','directores.id')
																	->select('areas.*')
																	->where('directores.id',$data[0])->get();
			}
		}
		else{
			$consulta=array();
			$longitud=count($data[1]);
			$filtro=array();
			for ($i=0; $i<$longitud; $i++) { 
				$consulta[]=\DB::table('areas')->where('departamento_id',$data[1][$i])->get();
			}
			for ($i=0; $i <$longitud; $i++) { 
				if(count($consulta[$i])!=''){
					$filtro[]=$consulta[$i];
				}
			}
		}
			
	return dd($filtro);
	}

	public function buscarCargos(){
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(1,2,3),4);
		$direccionId=\Request::get('data');
		if ($direccionId!=0) {
			$consulta=\DB::table('cargos')->join('areas','cargos.area_id','=','areas.id')
										  ->join('departamentos','areas.departamento_id','=','departamentos.id')
										  ->join('directores','departamentos.director_id','=','directores.id')
						   			      ->select('areas.*')
						   			      ->where('directores.id',$direccionId)
							              ->whereNotNull('cargos.area_id')
							              ->distinct()
							              ->get();
			$query=\DB::table('cargos')->join('areas','cargos.area_id','=','areas.id')
																 ->join('departamentos','areas.departamento_id','=','departamentos.id')
																 ->join('directores','departamentos.director_id','=','directores.id')
																 ->select('cargos.*')
																 ->where('directores.id',$direccionId)->get();
		}
		else {
			$consulta=\DB::table('cargos')->join('areas','cargos.area_id','=','areas.id')
								   			     ->select('areas.*')
									             ->whereNotNull('cargos.area_id')
									             ->distinct()
									             ->get();
			$query=\App\Cargo::all();
		}

		return view('Registros_Basicos.Departamentos.partials.listarCargos',$this->datos_vista(0,$acciones,$consulta,$query));
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
