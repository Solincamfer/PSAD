<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use App\Director;
use App\Departamento;
use App\Cargo;
use App\Area;

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
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(1,2,3,94,95,96),4);
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
		if (empty($argumento[2])) {
			$argumento[2]=[0];
		}
		if (empty($argumento[3])) {
			$argumento[3]=[0];
		}
		\Session::forget('depmarcados');
		\Session::push('depmarcados',$argumento[2]);
		\Session::forget('areamarcada');
		\Session::push('areamarcada',$argumento[3]);
		$marcados=\Session::get('depmarcados');
		$areamarcada=\Session::get('areamarcada');
		if ($argumento[1]=='dep') {
			$consulta=\DB::table('departamentos')->join('directores','departamentos.director_id','=','directores.id')
								   			     ->select('directores.*')
								   			     ->where('directores.id',$argumento[0])
									             ->whereNotNull('departamentos.director_id')
									             ->distinct()
									             ->get();
			$query=\App\Departamento::where('director_id',$argumento[0])->get();
			$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(94,95,96),4);
			return view('Registros_Basicos.Departamentos.partials.listaDatos',$this->datos_vista(0,$acciones,$consulta,$query,$marcados[0]));
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
			$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(7,98,99),4);
			return view('Registros_Basicos.Departamentos.partials.listarAreas',$this->datos_vista(0,$acciones,$consulta,$query,0,$areamarcada[0]));
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
			$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(5,6),4);
			return view('Registros_Basicos\Departamentos\partials\listarCargos',$this->datos_vista(0,$acciones,$consulta,$query));
		}
	}


	public function mostrarEstructuraTodos(){ // METODO UTILIZADO PARA MOSTRAR TODOS LOS REGISTROS EN CASO QUE NO SE SELECCIONE NINGUNA 											 DIRECCION, DEPENDIENDO DE LA PESTAÑA QUE ESTE ACTIVA
		$argumento=\Request::get('data');
		$datos=$this->cargar_header_sidebar_acciones();
		if (empty($argumento[2])) {
			$argumento[2]=[0];
		}
		if (empty($argumento[3])) {
			$argumento[3]=[0];
		}
		\Session::forget('depmarcados');
		\Session::push('depmarcados',$argumento[2]);
		\Session::forget('areamarcada');
		\Session::push('areamarcada',$argumento[3]);
		$marcados=\Session::get('depmarcados');
		$areamarcada=\Session::get('areamarcada');
		if ($argumento[1]=='dep') {
			$consulta=\DB::table('departamentos')->join('directores','departamentos.director_id','=','directores.id')
								   			     ->select('directores.*')
									             ->whereNotNull('departamentos.director_id')
									             ->distinct()
									             ->get();
			$query=\App\Departamento::all();
			$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(94,95,96),4);
			return view('Registros_Basicos.Departamentos.partials.listaDatos',$this->datos_vista(0,$acciones,$consulta,$query,$marcados[0]));
		}
		elseif ($argumento[1]=='area') {
			$consulta=\DB::table('areas')->join('departamentos','areas.departamento_id','=','departamentos.id')
								   			     ->select('departamentos.*')
									             ->whereNotNull('areas.departamento_id')
									             ->distinct()
									             ->get();
			$query=\App\Area::all();
			$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(7,98,99),4);
			return view('Registros_Basicos.Departamentos.partials.listarAreas',$this->datos_vista(0,$acciones,$consulta,$query,0,$areamarcada[0]));
		}
		else {
			$consulta=\DB::table('cargos')->join('areas','cargos.area_id','=','areas.id')
								   			     ->select('areas.*')
									             ->whereNotNull('cargos.area_id')
									             ->distinct()
									             ->get();
			$query=\App\Cargo::all();
			$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(5,6),4);
			return view('Registros_Basicos.Departamentos.partials.listarCargos',$this->datos_vista(0,$acciones,$consulta,$query));
		}
	}

	public Function buscarDepartamentos(){
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(94,95,96),4);
		$data=\Request::get('data');
		if(empty($data[1])){
			$data[1]=[0];
		}
		\Session::forget('depmarcados');
		\Session::push('depmarcados',$data[1]);
		$marcados=\Session::get('depmarcados');
		if ($data[0]!=0) {
			$consulta=\DB::table('departamentos')->join('directores','departamentos.director_id','=','directores.id')
								   			     ->select('directores.*')
								   			     ->where('directores.id',$data[0])
									             ->whereNotNull('departamentos.director_id')
									             ->distinct()
									             ->get();
			$query=\DB::table('departamentos')->join('directores','departamentos.director_id','=','directores.id')
											  ->select('departamentos.*')
											  ->where('directores.id',$data[0])->get();
		}
		else {
			$consulta=\DB::table('departamentos')->join('directores','departamentos.director_id','=','directores.id')
								   			     ->select('directores.*')
									             ->whereNotNull('departamentos.director_id')
									             ->distinct()
									             ->get();
			$query=\App\Departamento::all();
		}

		return view('Registros_Basicos.Departamentos.partials.listaDatos',$this->datos_vista(0,$acciones,$consulta,$query,$marcados[0]));

	}

	public Function buscarAreas(){
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(7,98,99),4);
		$data=\Request::get('data');
		$parametro = 0;
		if (empty($data[2])) {
			$data[2]=[0];
		}
		\Session::forget('areamarcada');
		\Session::push('areamarcada',$data[2]);
		$areamarcada=\Session::get('areamarcada');

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
			$areas=array();
			$longitud=count($data[1]);
			$query=array();
			$departamentos=array();
			$consulta=array();
			$parametro=1;
			for ($i=0; $i<$longitud; $i++) {
				$areas[]=\DB::table('areas')->where('departamento_id',$data[1][$i])->get();
				if(count($areas[$i])!=''){
					$query[]=$areas[$i];
				}
				$departamentos[]=\DB::table('areas')->join('departamentos','areas.departamento_id','=','departamentos.id')
							   			     ->select('departamentos.*')
							   			     ->where('areas.departamento_id',$data[1][$i])
							   			     ->distinct()
								             ->get();
				if(count($departamentos[$i])!=''){
					$consulta[]=$departamentos[$i];
				}
			}
		}

	return view('Registros_Basicos.Departamentos.partials.listarAreas',$this->datos_vista(0,$acciones,$consulta,$query,$parametro,$areamarcada[0]));
	}

	public function buscarCargos(){
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(5,6),4);
		$data=\Request::get('data');
		$parametro=0;
		if(empty($data[1]) && empty($data[2])){
			if ($data[0]!=0) {
			$consulta=\DB::table('cargos')->join('areas','cargos.area_id','=','areas.id')
										  ->join('departamentos','areas.departamento_id','=','departamentos.id')
										  ->join('directores','departamentos.director_id','=','directores.id')
						   			      ->select('areas.*')
						   			      ->where('directores.id',$data[0])
							              ->whereNotNull('cargos.area_id')
							              ->distinct()
							              ->get();
			$query=\DB::table('cargos')->join('areas','cargos.area_id','=','areas.id')
																 ->join('departamentos','areas.departamento_id','=','departamentos.id')
																 ->join('directores','departamentos.director_id','=','directores.id')
																 ->select('cargos.*')
																 ->where('directores.id',$data[0])->get();
			}
			else {
				$consulta=\DB::table('cargos')->join('areas','cargos.area_id','=','areas.id')
									   			     ->select('areas.*')
										             ->whereNotNull('cargos.area_id')
										             ->distinct()
										             ->get();
				$query=\App\Cargo::all();
			}
		}
		else{
			if ($data[2]!=0) {
				$cargos=array();
				$longitud=count($data[2]);
				$query=array();
				$areas=array();
				$consulta=array();
				$parametro=1;
				for ($i=0; $i<$longitud; $i++) {
					$cargos[]=\DB::table('cargos')->where('area_id',$data[2][$i])->get();
					if(count($cargos[$i])!=''){
						$query[]=$cargos[$i];
					}
					$areas[]=\DB::table('cargos')->join('areas','cargos.area_id','=','areas.id')
								   			     ->select('areas.*')
								   			     ->where('cargos.area_id',$data[2][$i])
								   			     ->distinct()
									             ->get();
					if(count($cargos[$i])!=''){
						$consulta[]=$areas[$i];
					}
				}
			}
			elseif(empty($data[2])){
				$cargos=array();
				$longitud=count($data[2]);
				$query=array();
				$areas=array();
				$consulta=array();
				$parametro=1;
				for ($i=0; $i<$longitud; $i++) {
					$cargos[]=\DB::table('cargos')->join('areas','cargos.area_id','=','areas.id')
												  ->join('departamentos','areas.departamento_id','departamentos.id')
												  ->select('cargos.*')
												  ->where('areas.departamento_id',$data[1][$i])
												  ->get();
					if(count($cargos[$i])!=''){
						$query[]=$cargos[$i];
					}
					$areas[]=\DB::table('cargos')->join('areas','cargos.area_id','=','areas.id')
												 ->join('departamentos','areas.departamento_id','departamentos.id')
								   			     ->select('areas.*')
								   			     ->where('areas.departamento_id',$data[1][$i])
								   			     ->distinct()
									             ->get();
					if(count($cargos[$i])!=''){
						$consulta[]=$areas[$i];
					}
				}
			}
		}
	return view('Registros_Basicos.Departamentos.partials.listarCargos',$this->datos_vista(0,$acciones,$consulta,$query,$parametro));
	}
	public function buscarDirecciones(){
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(1,2,3),4);
		$consulta=Director::all();
		return view('Registros_basicos.Departamentos.partials.listarDirecciones',$this->datos_vista(0,$acciones,$consulta));
	}

	public function ingresarDireccion(){
		$nombreDireccion= strtoupper(\Request::get('direccion'));//nombre de la direccion, llevado a mayusculas
		$statusDireccion=\Request::get('comboDireccion');//status de la direccion
		$consulta=\DB::table('directores')->where('descripcion',$nombreDireccion)->first(); //Consultar por el nombre la existencia de la direccion
		$respuesta=array(0);
		if (empty($consulta)) //si el registro no existe, se procede a ingresar los datos de la direccion
		{
			 $id=\DB::table('directores')->insertGetId
					 	(

					 		['descripcion'=>$nombreDireccion,
					 		 'status'=>$statusDireccion
					 		]);
			$ultimo=Director::where('id',$id)->first();
			$respuesta=array(1,$ultimo) ;

		}
		return $respuesta;
	}


	public function ingresarDepartamento(){
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(94,95,96),4);
		$data=Request::get('data');
		$departamentoSelect=$data[0];
		$direccionSelect=(int)$data[1];
		$nombreD=strtoupper($data[2]);//nombre del departamento, llevado a mayusculas
		$statusD=(int)$data[3];//status del departamento
		$padre=$data[4];
		$respuesta=0;
		$consulta=\DB::table('departamentos')->where('descripcion',$nombreD)
					 ->where('director_id',$padre)
				     ->first();
		if(empty($departamentoSelect)){
			$departamentoSelect=[0];
		}
		\Session::forget('depmarcados');
		\Session::push('depmarcados',$departamentoSelect);
		$marcados=\Session::get('depmarcados');
		if (count($consulta)==0) {  //si el registro no existe, se procede a ingresar los datos del departamento

			$departamentos=new Departamento;
			$departamentos->descripcion=$nombreD;
			$departamentos->status=$statusD;
			$departamentos->director_id=$padre;
			$departamentos->save();

			if ($direccionSelect!=0) {
				$listaDirectores=\DB::table('departamentos')->join('directores','departamentos.director_id','=','directores.id')
															->select('directores.*')
															->where('directores.id',$direccionSelect)
															->whereNotNull('departamentos.director_id')
															->distinct()
															->get();

				$query=\DB::table('departamentos')->join('directores','departamentos.director_id','=','directores.id')
												  ->select('departamentos.*')
												  ->where('directores.id',$direccionSelect)->get();
			}
			else {
				$listaDirectores=\DB::table('departamentos')->join('directores','departamentos.director_id','=','directores.id')
									   			     ->select('directores.*')
										             ->whereNotNull('departamentos.director_id')
										             ->distinct()
										             ->get();
				$query=Departamento::all();
			}

			$respuesta=view('Registros_Basicos.Departamentos.partials.listaDatos',$this->datos_vista(0,$acciones,$listaDirectores,$query,$marcados[0]));
		}
		return $respuesta;
	}
	public function ingresarArea(){

		$nombreA= strtoupper(\Request::get('area'));//nombre del area, llevado a mayusculas
		$statusA= \Request::get('comboArea');//status del area
		$padre= (int)\Request::get('padre');
		$respuesta=0;
		$consulta=\DB::table('areas')->where('descripcion',$nombreA)
					->where('departamento_id',$padre)
					->first();

		if (empty($consulta)) //si el registro no existe, se procede a ingresar los datos del area
		{
			 \DB::table('areas')->insert
					 	(
					 		[
					 			'descripcion'=>$nombreA,
					 			'status'=>$statusA,
					 			'departamento_id'=>$padre
					 		]);
			$respuesta=1;
		}
		return $respuesta;
	}

	public function ingresarCargo(){
		$nombreC= strtoupper(\Request::get('cargo'));//nombre del cargo, llevado a mayusculas
		$statusC= \Request::get('comboCargo');//status del cargo
		$padre= (int)\Request::get('padre');
		$respuesta=0;
		$consulta=\DB::table('cargos')->where('descripcion',$nombreC)
					->where('area_id',$padre)
					->first();

		if (empty($consulta)) //si el registro no existe, se procede a ingresar los cargos del area
		{
			 \DB::table('cargos')->insert
					 	(
					 		[
					 			'descripcion'=>$nombreC,
					 			'status'=>$statusC,
					 			'area_id'=>$padre
					 		]);
			$respuesta=1;
		}
		return $respuesta;
	}

	public function mostrarDatos(){
		$registro=(int)Request::get('registro');
		$modal=(int)Request::get('modal');
		$tablas=['directores','departamentos','areas','cargos'];
		$consulta=\DB::table($tablas[$modal])->where('id',$registro)->first();
		return response()->json($consulta);
	}

	public function actualizarDireccion(){
		//$padre=(int)Request::get('padre');
		$registro=(int)Request::get('registro');
		$respuesta=0;
		$descripcion=strtoupper(Request::get('campoD'));
		$estatus=Request::get('campoE');
		$buscar=Director::where('descripcion',$descripcion)
						  ->where('id','<>',$registro)
						  ->first();
		if (count($buscar)==0) {
			Director::where('id',$registro)->update([ 'descripcion' => $descripcion,
 													  'status'      => $estatus
													]);
			$datos=$this->cargar_header_sidebar_acciones();
			$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(1,2,3),4);
			$consulta=Director::all();
			$respuesta=view('Registros_basicos.Departamentos.partials.listarDirecciones',$this->datos_vista(0,$acciones,$consulta));
		}
		return $respuesta;
	}

	public function actualizarDepartamento(){
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(94,95,96),4);
		$direccionSelect=(int)Request::get('direccionSelect');
		$departamentoSelect=Request::get('departamentoSelect');
		$padre=(int)Request::get('padre');
		$registro=(int)Request::get('registro');
		$respuesta=0;
		$descripcion=strtoupper(Request::get('campoD'));
		$estatus=(int)Request::get('campoE');
		$buscar=Departamento::where('descripcion',$descripcion)
						  ->where('id','<>',$registro)
						  ->where('director_id',$padre)
						  ->first();
		if($departamentoSelect==0) {
			$departamentoSelect=[0];
	  	}
	  	\Session::forget('depmarcados');
		\Session::push('depmarcados',$departamentoSelect);
		$marcados=\Session::get('depmarcados');
		if (count($buscar)==0) {
			Departamento::where('id',$registro)->update([ 'descripcion' => $descripcion,
 													  	  'status'      => $estatus,
 													  	  'director_id' => $padre

													]);
			if ($direccionSelect!=0) {
				$listaDirectores=\DB::table('departamentos')->join('directores','departamentos.director_id','=','directores.id')
															->select('directores.*')
															->where('directores.id',$direccionSelect)
															->whereNotNull('departamentos.director_id')
															->distinct()
															->get();

				$query=\DB::table('departamentos')->join('directores','departamentos.director_id','=','directores.id')
												  ->select('departamentos.*')
												  ->where('directores.id',$direccionSelect)->get();
			}
			else {
				$listaDirectores=\DB::table('departamentos')->join('directores','departamentos.director_id','=','directores.id')
									   			     ->select('directores.*')
										             ->whereNotNull('departamentos.director_id')
										             ->distinct()
										             ->get();
				$query=Departamento::all();
			}

			$respuesta =view('Registros_Basicos.Departamentos.partials.listaDatos',$this->datos_vista(0,$acciones,$listaDirectores,$query,$marcados[0]));
		}
		return $respuesta;
	}

	public function actualizarArea(){
		$parametro = 0;
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(7,98,99),4);
		$direccionSelect=(int)Request::get('direccionSelect');
		$departamentoSelect=Request::get('departamentoSelect');
		$areaSelect=Request::get('areaSelect');
		$padre=(int)Request::get('padre');
		$registro=(int)Request::get('registro');
		$respuesta=0;
		$descripcion=strtoupper(Request::get('campoD'));
		$estatus=(int)Request::get('campoE');
		$buscar=Area::where('descripcion',$descripcion)
						  ->where('id','<>',$registro)
						  ->where('departamento_id',$padre)
						  ->first();
		if ($areaSelect==0){
			$areaSelect=[0];
		}
		\Session::forget('areamarcada');
		\Session::push('areamarcada',$areaSelect);
		$areamarcada=\Session::get('areamarcada');
		if (count($buscar)==0) {
			Area::where('id',$registro)->update([ 'descripcion' => $descripcion,
 													  	  'status'      => $estatus,
 													  	  'departamento_id' => $padre

													]);
			if($departamentoSelect==0){
				if ($direccionSelect==0) {
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
								   			     ->where('directores.id',$direccionSelect)
									             ->whereNotNull('areas.departamento_id')
									             ->distinct()
									             ->get();
					$query=\DB::table('areas')->join('departamentos','areas.departamento_id','=','departamentos.id')
																		->join('directores','departamentos.director_id','=','directores.id')
																		->select('areas.*')
																		->where('directores.id',$direccionSelect)->get();
				}
			}
			else{
				$areas=array();
				$longitud=count($departamentoSelect);
				$query=array();
				$departamentos=array();
				$consulta=array();
				$parametro=1;
				for ($i=0; $i<$longitud; $i++) {
					$areas[]=\DB::table('areas')->where('departamento_id',$departamentoSelect[$i])->get();
					if(count($areas[$i])!=''){
						$query[]=$areas[$i];
					}
					$departamentos[]=\DB::table('areas')->join('departamentos','areas.departamento_id','=','departamentos.id')
								   			     ->select('departamentos.*')
								   			     ->where('areas.departamento_id',$departamentoSelect[$i])
								   			     ->distinct()
									             ->get();
					if(count($departamentos[$i])!=''){
						$consulta[]=$departamentos[$i];
					}
				}
			}
			$respuesta = view('Registros_Basicos.Departamentos.partials.listarAreas',$this->datos_vista(0,$acciones,$consulta,$query,$parametro,$areamarcada[0]));
		}
		return $respuesta;
	}

	public function actualizarCargo(){
		$parametro = 0;
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(5,6),4);
		$direccionSelect=(int)Request::get('direccionSelect');
		$departamentoSelect=Request::get('departamentoSelect');
		$areaSelect=Request::get('areaSelect');
		$padre=(int)Request::get('padre');
		$registro=(int)Request::get('registro');
		$respuesta=0;
		$descripcion=strtoupper(Request::get('campoD'));
		$estatus=(int)Request::get('campoE');
		$buscar=Cargo::where('descripcion',$descripcion)
						  ->where('id','<>',$registro)
						  ->where('area_id',$padre)
						  ->first();
		if (count($buscar)==0) {
			Cargo::where('id',$registro)->update([ 'descripcion' => $descripcion,
 													  	  'status'      => $estatus,
 													  	  'area_id' => $padre

													]);
			if($areaSelect==0 && $departamentoSelect==0){
				if ($direccionSelect!=0) {
					$consulta=\DB::table('cargos')->join('areas','cargos.area_id','=','areas.id')
												  ->join('departamentos','areas.departamento_id','=','departamentos.id')
												  ->join('directores','departamentos.director_id','=','directores.id')
								   			      ->select('areas.*')
								   			      ->where('directores.id',$direccionSelect)
									              ->whereNotNull('cargos.area_id')
									              ->distinct()
									              ->get();
					$query=\DB::table('cargos')->join('areas','cargos.area_id','=','areas.id')
																		 ->join('departamentos','areas.departamento_id','=','departamentos.id')
																		 ->join('directores','departamentos.director_id','=','directores.id')
																		 ->select('cargos.*')
																		 ->where('directores.id',$direccionSelect)->get();
				}
				else {
					$consulta=\DB::table('cargos')->join('areas','cargos.area_id','=','areas.id')
										   			     ->select('areas.*')
											             ->whereNotNull('cargos.area_id')
											             ->distinct()
											             ->get();
					$query=\App\Cargo::all();
				}
			}
			else{
				if ($areaSelect!=0) {
					$cargos=array();
					$longitud=count($areaSelect);
					$query=array();
					$areas=array();
					$consulta=array();
					$parametro=1;
					for ($i=0; $i<$longitud; $i++) {
						$cargos[]=\DB::table('cargos')->where('area_id',$areaSelect[$i])->get();
						if(count($cargos[$i])!=''){
							$query[]=$cargos[$i];
						}
						$areas[]=\DB::table('cargos')->join('areas','cargos.area_id','=','areas.id')
									   			     ->select('areas.*')
									   			     ->where('cargos.area_id',$areaSelect[$i])
									   			     ->distinct()
										             ->get();
						if(count($cargos[$i])!=''){
							$consulta[]=$areas[$i];
						}
					}
				}
				elseif($areaSelect==0){
					$cargos=array();
					$longitud=count($areaSelect);
					$query=array();
					$areas=array();
					$consulta=array();
					$parametro=1;
					for ($i=0; $i<$longitud; $i++) {
						$cargos[]=\DB::table('cargos')->join('areas','cargos.area_id','=','areas.id')
													  ->join('departamentos','areas.departamento_id','departamentos.id')
													  ->select('cargos.*')
													  ->where('areas.departamento_id',$departamentoSelect[$i])
													  ->get();
						if(count($cargos[$i])!=''){
							$query[]=$cargos[$i];
						}
						$areas[]=\DB::table('cargos')->join('areas','cargos.area_id','=','areas.id')
													 ->join('departamentos','areas.departamento_id','departamentos.id')
									   			     ->select('areas.*')
									   			     ->where('areas.departamento_id',$departamentoSelect[$i])
									   			     ->distinct()
										             ->get();
						if(count($cargos[$i])!=''){
							$consulta[]=$areas[$i];
						}
					}
				}
			}
		$respuesta=view('Registros_Basicos.Departamentos.partials.listarCargos',$this->datos_vista(0,$acciones,$consulta,$query,$parametro));
	}
	return $respuesta;
	}

	public function modificarStatus(){
		$status=[1,0];
		$tablas=["directores","departamentos","areas","cargos"];
		$registro=(int)Request::get('registry');
		$tabla=(int)Request::get('tabla');
		$buscar=\DB::table($tablas[$tabla])->where('id',$registro)->first();
		$consulta=\DB::table($tablas[$tabla])->where('id',$registro)->update(['status' => $status[$buscar->status]]);
		$respuesta=1;
		return $respuesta;
	}
}
