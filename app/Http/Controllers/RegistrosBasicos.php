<?php

namespace App\Http\Controllers;


use Session;
use DB;
use Request;
use App\Perfil;
use App\Horario;
use App\Bitacora;
use App\Plan;
use App\Empleado;
use App\Usuario;
use App\Departamento;
use App\Area;
use App\Cargo;
use App\Cedula;
use App\Rif;
use App\Correo;
use App\Direccion;
use App\Telefono;
use App\TIpo;
use App\Modulo;
use App\Submodulo;
use App\Accion;
use Response;


class RegistrosBasicos extends Controller 
{
    

	
		

//////////////////////////metodos comunes///////////////////////////////////////////////////////////////////


	public function cargar_header_sidebar_acciones()//obtiene desde la variable, la configuracion para el usuario logueado
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

	
	
	
	public function obtener_acciones_submodulo($submodulo_id,$vista)
	{
		$acc_=array();
		$acciones_sub=DB::table('acciones')->where(['submodulo_id'=>$submodulo_id,'vista'=>$vista])->get();//obtiene las acciones para una vista
		
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




	
public function capturar_datos_responsables()
	{
		
		$nombres=Request::get('nomRpb1');//nombres del responsable 
		
		$apellidos=Request::get('apellRpb1');//apellidos del responsable 
		
		$tipoCedula=(int)Request::get('selciRpb');//tipo cedula 
		
		$cedula=Request::get('txtci');//numero de cedula RpMda4
		
		$cargo=Request::get('cgoRpb');//cargo seltlfRpb
		
		$codigoMovil=(int)Request::get('seltlfRpb');//tipo codigo
		
		$numeroMovil=Request::get('numTelclRpb');//numero telefono numTelclRpb
		
		$codigoLocal=(int)Request::get('seltlfmRpb');//ctipo codigo seltlfmRpb
		
		$numeroLocal=Request::get('numTelmvlRpb');//numero fijo
	
		$correo=Request::get('mail2');//correo 

		return array(

					'nombre' => $nombres,'apellido'=>$apellidos,'tipoCedula'=>$tipoCedula,'cedula'=>$cedula,
					'cargo'=>$cargo,'codigoC'=>$codigoMovil,'codigoL'=>$codigoLocal,'numeroC'=>$numeroMovil,
					'numeroL'=>$numeroLocal,'correo'=>$correo);

	}
	
	
	

	public function consulta_ingresar_responsable($formulario,$cliente_id)
	{
		
		$idC=DB::table('cedulas')->insertGetId//cedula del cliente
		(['numero'=>$formulario['cedula'],'rol'=>'cliente','tipo_id'=>$formulario['tipoCedula']]);

		$idCo=DB::table('contactos')->insertGetId//contacto del responsable
		(['tipo_id'=>$formulario['codigoC'],'tipo__id'=>$formulario['codigoL'],'telefono_m'=>$formulario['numeroC'],'telefono_f'=>$formulario['numeroL'],'correo'=>$formulario['correo']]);

		DB::table('personas')->insert//insertar datos del responsable
		(['p_nombre'=>$formulario['nombre'],'p_apellido'=>$formulario['apellido'],'cargo'=>$formulario['cargo'],'cedula_id'=>$idC,'contacto_id'=>$idCo,'cliente_id'=>(int)$cliente_id]);

	}

	
	
	public function formulario_actualizar_responsable()
	{
		$Pnombre=Request::get('nomRpb1');//nombre
		$Papellido=Request::get('apellRpb1');//apellido
		$cargo=Request::get('cgoRpb');//cargo
		$numeroC=(int)Request::get('RpMda4');//numero cedula selciRpb
		$tipoC=(int)Request::get('selciRpb');//tipo cedula
		$codigoC=(int)Request::get('seltlfRpb');//codigo celular RpMda4 seltlfRpb
		$codigoL=(int)Request::get('seltlfmRpb');//codigo local
		$telefonoC=Request::get('numTelclRpb');//numero celular cgoRpb numTelclRpb
		$telefonoL=Request::get('numTelmvlRpb');//numero local seltlfmRpb numTelmvlRpb
		$correo=Request::get('mail2');//correp mail2

		$id_responsable=(int)Request::get('Registroid');//hiiden que trae el id del registro a modificar

		return array('nombre'=>$Pnombre,'apellido'=>$Papellido,'cargo'=>$cargo,'cedula'=>$numeroC,'tipoC'=>$tipoC,
					'codigoC'=>$codigoC,'codigoL'=>$codigoL,'telefonoC'=>$telefonoC,'telefonoL'=>$telefonoL,'correo'=>$correo,'responsableId'=>$id_responsable);

	}

	public function consulta_actualizar_responsable($formulario)
	{

		$persona=DB::table('personas')->where('id',$formulario['responsableId'])->first();//ubicar datos de la persona amodificar
		if(empty($persona)==false)//si existe
			{

				DB::table('personas')->where('id',$persona->id)//actualizar nombre, apellido y cargo
									 ->update(['p_nombre'=>$formulario['nombre'],'p_apellido'=>$formulario['apellido'],'cargo'=>$formulario['cargo']]);	

				DB::table('cedulas')->where('id',$persona->cedula_id)->update(['numero'=>$formulario['cedula'],'tipo_id'=>$formulario['tipoC']]);//actualizar numero de cedula y tipo		

				DB::table('contactos')->where('id',$persona->contacto_id)->update(['tipo_id'=>$formulario['codigoC'],'tipo__id'=>$formulario['codigoL'],'telefono_m'=>$formulario['telefonoC'],'telefono_f'=>$formulario['telefonoL'],'correo'=>$formulario['correo']]);	//actualizar datos de contactos		 
			}


	}
	
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////submodulo departamentos ////////////////////////////////////////////////////////////


	public function departamentos_cargos($departamento_id)//Inicializacion del submodulo: /departamentos/cargos
	{
		$boton_agregar=7;
		$datos=$this->cargar_header_sidebar_acciones();
		$acc=$this->obtener_acciones_submodulo(2,2);//obtiene las acciones de un submodulo
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],$acc,$boton_agregar);//obtiene las opciones validas para la vista
		$nombre=DB::table('departamentos')->where('id',$departamento_id)->value('descripcion');
		return view('Registros_Basicos\Departamentos\cargos',$this->datos_vista($datos,$acciones,DB::table('cargos')->where('departamento_id',$departamento_id)->paginate(4),1,(int)$departamento_id,$nombre));
					
	}


	public function departamentos()//ventana principal de departamentos
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(1,2,3),4);
		
		return view('Registros_Basicos\Departamentos\departamentos',$this->datos_vista($datos,$acciones,DB::table('departamentos')->paginate(11),0));
					
	}


	public function departamentos_ingresar()
	{

		$nombreD= strtoupper(Request::get('textDpto'));//nombre del departamento, llevado a mayusculas
		$statusD= (int)Request::get('comboDpto');//status del departamento 


		$consulta=DB::table('departamentos')->where('descripcion',$nombreD)->first();
		

		if (empty($consulta)) //si el registro no existe, se procede a ingresar los datos del departamento
		{
			 DB::table('departamentos')->insert
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
		

		$consulta=DB::table('cargos')->where('descripcion',$nombreC)->first();

		if (empty($consulta)) //si el registro no existe, se procede a ingresar los datos del departamento
		{
			 DB::table('cargos')->insert
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


///////////////////////// Metodos para traer informacion al presionar el boton modificar  //////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////

	
	

	//Metodo para realizar la consulta a las tablas que muestran informacion en el modal modificar de cada ventana
	//Args: registryId: Id del registro que se captura al pulsar el boton modificar, table: es un valor entero que representa a la tabla que
	//se relaciona con la ventana modificar de turno indices: departamentos{0},cargos{1},perfiles{2}
	//variables: boards: contiene los nombres de las tablas a los cuales se accederemos usando table como indice del arreglo
	//retorno: 1 registro que coincida con el argumento : registryId

	public function buscarRegistro($registryId,$table)
	{
		$boards=["departamentos","cargos","perfiles"];
		$registry=DB::table($boards[$table])->where('id',$registryId)->first();
		return ($registry);
	}

	public function buscarCategorias($registryId)
	{
		$registry=DB::table('categorias')->where('id',$registryId)
		                                 ->select('categorias.id AS id',
		                                 	      'categorias.nombre AS descripcion',
		                                 	      'categorias.status AS status',
		                                 	      'categorias.cliente_id AS padreId')
		                                 ->first();
		return ($registry);
	}

	public function buscarPlanes($registryId)
	{
		$registry=DB::table('planes')->where('id',$registryId)
		                             ->select('planes.nombreP AS descripcion','planes.descuento AS descuento','planes.status AS status')
		                             ->first();
		return ($registry);

	}

	public function buscarSucursales($registryId)
	{
	$sucursal=DB::table('sucursales')-> where('sucursales.id',$registryId)
		                             ->select('sucursales.razon_s AS razonS','sucursales.nombre_c AS nombreC','sucursales.status AS status','sucursales.rif_id AS rifId','sucursales.tipo_id AS idTipocontribuyente','sucursales.direccion_id AS idDireccionFiscal','sucursales.direccion__id AS idDireccionComercial','sucursales.contacto_id AS contactoId','sucursales.cliente_id AS matrizId','sucursales.categoria_id AS categoriaId')
		                             ->first();

		$rif=DB::table('rifs')->where('rifs.id',$sucursal->rifId)
							  ->select('rifs.numero AS numero','rifs.tipo_id As tipoRif')
							  ->first();

		$contribuyente=DB::table('tipos')->where('tipos.id',$sucursal->idTipocontribuyente)
										 ->select('tipos.descripcion AS descripcion','tipos.id AS codigoIdContribuyente')
										 ->first();

		$direccionFiscal=DB::table('direcciones')->join('municipios','direcciones.municipio_id','=','municipios.id')
		                                         ->join('regiones','direcciones.region_id','=','regiones.id')
		                                         ->join('estados','direcciones.estado_id','=','estados.id')
		                                         ->join('paises','direcciones.pais_id','=','paises.id')
		                                         ->select('municipios.id AS municipioId','municipios.descripcion AS municipio',
		                                     			  'estados.id AS estadoId','estados.descripcion AS estado',
		                                     			  'regiones.id AS regionId','regiones.descripcion AS region','paises.id AS paisId','paises.descripcion AS pais','direcciones.descripcion AS direccion')
		                                         ->where('direcciones.id',$sucursal->idDireccionFiscal)
		                                         ->first();


		$direccionComercial=DB::table('direcciones')->join('municipios','direcciones.municipio_id','=','municipios.id')
		                                         ->join('regiones','direcciones.region_id','=','regiones.id')
		                                         ->join('estados','direcciones.estado_id','=','estados.id')
		                                         ->join('paises','direcciones.pais_id','=','paises.id')
		                                         ->select('municipios.id AS municipioId','municipios.descripcion AS municipio',
		                                     			  'estados.id AS estadoId','estados.descripcion AS estado',
		                                     			  'regiones.id AS regionId','regiones.descripcion AS region','paises.id AS paisId','paises.descripcion AS pais','direcciones.descripcion AS direccion')
		                                         ->where('direcciones.id',$sucursal->idDireccionComercial)
		                                         ->first();

		 $celularCorr=DB::table('contactos')->join('tipos','contactos.tipo_id','=','tipos.id')
                                         ->select('contactos.correo AS correoUsuario','tipos.descripcion AS codigoCel','tipos.id AS codigoCelid','contactos.telefono_m AS celular')
		                                 ->where('contactos.id',$sucursal->contactoId)
		 							     ->first();

		$fijo=DB::table('contactos')->join('tipos','contactos.tipo__id','=','tipos.id')
								    ->select('contactos.telefono_f AS telefonoLocal','tipos.descripcion AS codigoFij',
								    	     'tipos.id AS codigoFijId')
								    ->where('contactos.id',$sucursal->contactoId)
								    ->first();


		
		



		$data=array(
					"razonS"=>$sucursal->razonS,
					"nombreC"=>$sucursal->nombreC,
					"tipoRif"=>$rif->tipoRif,
					"numeroRif"=>$rif->numero,
					"tipoContribuyente"=>$contribuyente->codigoIdContribuyente,
					"contribuyente"=>$contribuyente->descripcion,
					"idPaisF"=>$direccionFiscal->paisId,
					"paisF"=>$direccionFiscal->pais,
					"idRegionF"=>$direccionFiscal->regionId,
					"regionF"=>$direccionFiscal->region,
					"idEstadoF"=>$direccionFiscal->estadoId,
					"estadoF"=>$direccionFiscal->estado,
					"idMunicipioF"=>$direccionFiscal->municipioId,
					"municipioF"=>$direccionFiscal->municipio,
					"direccionF"=>$direccionFiscal->direccion,
					"idPaisC"=>$direccionComercial->paisId,
					"paisC"=>$direccionComercial->pais,
					"idRegionC"=>$direccionComercial->regionId,
					"regionC"=>$direccionComercial->region,
					"idestadoC"=>$direccionComercial->estadoId,
					"estadoC"=>$direccionComercial->estado,
				    "idMunicipioC"=>$direccionComercial->municipioId,
				    "municipioC"=>$direccionComercial->municipio,
				    "direccionC"=>$direccionComercial->municipio,
				    "idCodigoFij"=>$fijo->codigoFijId,
				    "codigoFij"=>$fijo->codigoFij,
				    "telefonoFij"=>$fijo->telefonoLocal,
				    "idCodigoCel"=>$celularCorr->codigoCelid,
				    "codigoCel"=>$celularCorr->codigoCel,
				    "telefonoCel"=>$celularCorr->celular,
				    "correoUsuario"=>$celularCorr->correoUsuario);

		return ($data);
	}


	public function buscarClientes($registryId)
	{
	


			$cliente=DB::table('clientes')
					  ->join('rifs','clientes.rif_id','=','rifs.id')
					  ->join('contactos','clientes.contacto_id','=','contactos.id')
					  ->join('tipos','clientes.tipo_id','=','tipos.id')
					  

					  ->select('clientes.razon_s AS razonS','clientes.nombre_c AS nombreC','rifs.numero As numeroR','rifs.tipo_id AS tipoR',
					  		   'contactos.tipo_id AS codigoC','contactos.telefono_m AS telefonoC','contactos.tipo__id AS codigoL',
					  		   'contactos.telefono_f AS telefonoF','contactos.correo','tipos.id As idtipoContribuyente','tipos.descripcion As Contribuyente')
					  ->where('clientes.id',$registryId)->first();


		$direccionF=DB::table('clientes')->join('direcciones','clientes.direccion_id','=','direcciones.id')

										->join('paises','paises.id','=','direcciones.pais_id')
										->join('regiones','regiones.id','=','direcciones.region_id')
										->join('estados','estados.id','=','direcciones.estado_id')
										->join('municipios','municipios.id','=','direcciones.municipio_id')

										->select('paises.id As idpaisF','paises.descripcion As paisF',
												 'regiones.id As idregionF','regiones.descripcion As regionF ',
												 'estados.id As idestadoF','estados.descripcion As estadoF',
												 'municipios.id As idmunicipioF','municipios.descripcion As municipiosF',
												 'direcciones.id As iddireccionF','direcciones.descripcion As direccionF')
												
										
										->where('clientes.id',$registryId)->first();

		$direccionC=DB::table('clientes')->join('direcciones','clientes.direccion__id','=','direcciones.id')

										->join('paises','paises.id','=','direcciones.pais_id')
										->join('regiones','regiones.id','=','direcciones.region_id')
										->join('estados','estados.id','=','direcciones.estado_id')
										->join('municipios','municipios.id','=','direcciones.municipio_id')

										->select('paises.id As idpaisC','paises.descripcion As paisC',
												 'regiones.id As idregionC','regiones.descripcion As regionC ',
												 'estados.id As idestadoC','estados.descripcion As estadoC',
												 'municipios.id As idmunicipioC','municipios.descripcion As municipiosC',
												 'direcciones.id As iddireccionC','direcciones.descripcion As direccionC')
												
										
										->where('clientes.id',$registryId)->first();

		


		$data= array(
						'razonS'=>$cliente->razonS,
						'nombreC'=>$cliente->nombreC,
						'numeroRif'=>$cliente->numeroR,
						'tipoRif'=>$cliente->tipoR,
						'codigoCelular'=>$cliente->codigoC,
						'telefonoCelular'=>$cliente->telefonoC,
						'codigoLocal'=>$cliente->codigoL,
						'telefonoFijo'=>$cliente->telefonoF,
						'correoUsuario'=>$cliente->correo,
						'idTipoContribuyente'=>$cliente->idtipoContribuyente,
						'tipoContribuyente'=>$cliente->Contribuyente,
						'paisId'=>$direccionF->idpaisF,
						'paisFiscal'=>$direccionF->paisF,
						'regionIdF'=>$direccionF->idregionF,
						'regionFiscal'=>$direccionF->regionF,
						'estadoIdF'=>$direccionF->idestadoF,
						'estadoF'=>$direccionF->estadoF,
						'municipioidF'=>$direccionF->idmunicipioF,
						'municipiosF'=>$direccionF->municipiosF,
						'idDireccionFiscal'=>$direccionF->iddireccionF,
						'direccionFiscal'=>$direccionF->direccionF,
						'paisIdC'=>$direccionC->idpaisC,
						'paisC'=>$direccionC->paisC,
						'regionIdC'=>$direccionC->idregionC,
						'regionC'=>$direccionC->regionC,
						'estadoidC'=>$direccionC->idestadoC,
						'estadoC'=>$direccionC->estadoC,
						'municipioIdC'=>$direccionC->idmunicipioC,
						'municipiosC'=>$direccionC->municipiosC,
						'direcionIdC'=>$direccionC->iddireccionC,
						'direccionC'=>$direccionC->direccionC);

		//$data=json_encode($data);

		return ($data);
	}


	//Metodo que realiza la consulta de datos en la tabla empleados , recibe como parametro el id del
	//registro de empleado consultado y retorna un objeto json

	public function buscarEmpleados($registryId)
	{

		

		$registry=DB::table('empleados')->join('cedulas','empleados.cedula_id','=','cedulas.id')
										->join('tipos','cedulas.tipo_id','=','tipos.id')
										->join('rifs','empleados.rif_id','=','rifs.id')
										->join('departamentos','empleados.departamento_id','=','departamentos.id')
										->join('cargos','empleados.cargo_id','=','cargos.id')
										->join('usuarios','empleados.usuario_id','=','usuarios.id')
										->join('contactos','empleados.contacto_id','=','contactos.id')
										->join('direcciones','empleados.direccion_id','=','direcciones.id')
										
										->join('municipios','direcciones.municipio_id','=','municipios.id')
										->join('regiones','direcciones.region_id','=','regiones.id')
										->join('estados','direcciones.estado_id','=','estados.id')
										->join('paises','direcciones.pais_id','=','paises.id')
										->select(	'empleados.id AS empleadoId',
													'empleados.contacto_id AS contactoId',
													'empleados.nombre AS primerNombre',
													'empleados.nombre_ AS segundoNombre',
												 	'empleados.apellido AS primerApellido',
												 	'empleados.apellido_ AS segundoApellido',
												 	'empleados.fechaN AS fechaNacimiento',
												 	'cedulas.numero AS numeroCedula',
												 	'cedulas.rol AS rol',
												 	'tipos.descripcion AS tipoCedula',
												 	'tipos.id AS tipoCedulaId',
												 	'departamentos.descripcion AS nombreDepartamento',
												 	'departamentos.id AS departamentoId',
												 	'cargos.descripcion AS nombreCargo',
												 	'cargos.id AS cargoId',
												 	'usuarios.n_usuario AS nombreUsuario','usuarios.clave AS claveUsuario',
												 	'usuarios.status AS statusUsuario',
												 	'contactos.correo AS correoUsuario',
												 	'paises.id AS paisId',
												 	'paises.descripcion AS nombrePais',
												     'estados.id AS estadoId',
												     'estados.descripcion AS nombreEstado',
												 	 'municipios.id AS municipioId',
												 	 'municipios.descripcion AS nombreMunicipio',
												 	 'regiones.id AS regionId',
												 	 'regiones.descripcion AS nombreRegion',
												 	 'direcciones.descripcion AS descripcionDireccion',
												 	 'empleados.rif_id AS rifId')
										->where('empleados.id',$registryId)->first();


		$rif=DB::table('rifs')->join('tipos','rifs.tipo_id','=','tipos.id')
							  ->select('rifs.numero AS numeroRif','tipos.descripcion AS tipoRif')
							  ->where('rifs.id',$registry->rifId)->first();
							 
		$telfL=DB::table('contactos')->join('tipos','tipos.id','contactos.tipo__id')
									 ->select('tipos.descripcion AS codigoTelefonoFijo','contactos.telefono_f AS telefonoLocal','tipos.id AS fijCodigo')
									 ->where('contactos.id',$registry->contactoId)->first();

		$telfC=DB::table('contactos')->join('tipos','tipos.id','contactos.tipo_id')
									 ->select('tipos.descripcion AS codigoTelefonoCelular','contactos.telefono_m AS telefonoCelular','tipos.id AS celCodigoId')
									 ->where('contactos.id',$registry->contactoId)->first();


	
		
		

		$data = array('primerNombre' =>$registry->primerNombre,
					  'segundoNombre'=>$registry->segundoNombre,
					  'primerApellido'=>$registry->primerApellido,
					  'segundoApellido'=>$registry->segundoApellido,
					  'fechaNacimiento'=>$registry->fechaNacimiento,
					  'tipoCedulaId'=>$registry->tipoCedulaId,
					  'tipoCedula'=>$registry->tipoCedula,
					  'numeroCedula'=>$registry->numeroCedula,
					  'departamentoId'=>$registry->departamentoId,
					  'nombreDepartamento'=>$registry->nombreDepartamento,
					  'cargoId'=>$registry->cargoId,
					  'nombreCargo'=>$registry->nombreCargo,
					  'nombreUsuario'=>$registry->nombreUsuario,
					  'claveUsuario'=>$registry->claveUsuario,
					  'statusUsuario'=>$registry->statusUsuario,
					  'correoUsuario'=>$registry->correoUsuario,
					  'paisId'=>$registry->paisId,
					  'nombrePais'=>$registry->nombrePais,
					  'estadoId'=>$registry->estadoId,
					  'nombreEstado'=>$registry->nombreEstado,
					  'municipioId'=>$registry->municipioId,
					  'nombreMunicipio'=>$registry->nombreMunicipio,
					  'regionId'=>$registry->regionId,
					  'nombreRegion'=>$registry->nombreRegion,
					  'descripcionDireccion'=>$registry->descripcionDireccion,
					  'rifId'=>$registry->rifId,
					  'numeroRif' =>$rif->numeroRif,
					  'tipoRif'=>$rif->tipoRif,
					  'tipoCodigoCel'=>$telfC->celCodigoId,
					  'codigoCel'=>$telfC->codigoTelefonoCelular,
					  'numeroCel'=>$telfC->telefonoCelular,
					  'tipoCodigoFij'=>$telfL->fijCodigo,
					  'codigoFij'=>$telfL->codigoTelefonoFijo,
					  'telefonoLocal'=>$telfL->telefonoLocal);

		
		return $data;
	
	}


	

    ///metodo que obtiene la informacion enviada por los script JS, que contienen la informacion correspondiente al boton modificar
    //Args: Table: entero que es el identificador de la tabla que contiene los datos para el modal, registry: es el id del registro
    //Asociado al boton modificar pulsado 


	public function modificar_registrosCD()
		{
			
			$table=Request::get('table');
			$registryId=Request::get('registry');
			if ($table==0||$table==1||$table==2) 
				{
					$registry=$this->buscarRegistro($registryId,$table);
				}
			else if($table==3)
				{
					$registry=$this->buscarCategorias($registryId);
				}
			else if ($table==4)
				{
					$registry=$this->buscarEmpleados($registryId);
				}
			else if ($table==5)
				{
					$registry=$this->buscarPlanes($registryId);
				}
			else if($table==6)
				{
					$registry=$this->buscarClientes($registryId);
				}
			else if($table==7)
				{
					$registry=$this->buscarSucursales($registryId);
				}
		
			
			
			return (json_encode($registry));
		
		}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///metodos utilizados para verificar que el registro no exista en la tabla 

public function isCargo($descripcion,$registry)
{
	
	$departamento=DB::table('cargos')->select('departamento_id')->where('id',$registry)->first();
	$cargoConsulta=DB::table('cargos')->where(['descripcion'=>$descripcion,'departamento_id'=>$departamento->departamento_id])->get();

	$cantidad=count($cargoConsulta);

	return($cantidad);
}



public function updatePosition($descripcion,$status,$registry)
{
	$update=DB::table('cargos')->where('id',$registry)->update(['descripcion'=>$descripcion,'status'=>$status]);
	return ($update);

}





public function duplicate($table,$descripcion,$registry)
{
	if($table==1)
	{
		$respuesta=$this->isCargo($descripcion,$registry);
	}

	return($respuesta);
}




	

public function updateData($table,$registry,$form)
{
	if($table==1)
	{
       $update=$this->updatePosition($form['descripcion'],$form['status'],$registry);
	}

	return($update);
}


public function selectMessage($table,$duplicate,$update,$entity,$father)
{
	if ($duplicate>0)
	{


		if($table==1)
		{
			$message='El cargo: '.$entity.' , Se encuentra registrado para el departamento: '.$father;
		}
	}
}

/////metodos utilizados para realizar la actualizacion en la tabla de la informacion contenida en los formularios de modificar



///////////////////metodo que realiza  la recepcion de los datos del formulario modificar y llama a los metodos correspondientes

public function actualizar_registrosCD()
{     //actualizar departamentos y cargos, segun lo agregado en el modal modificar
	
	$table=(int)Request::get('table');
	$registry=(int)Request::get('registry');
	$form=Request::get('datosFormulario');
	
	

	$duplicado=$this->duplicate($table,$form['descripcion'],$registry);
	if($duplicado==0)
	{
		$update=$this->updateData($table,$registry,$form);
	}
	
	return($duplicado);

}

	
	
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////submodulos planes y servicios ////////////////////////////////////////////////////


public function planes_servicios()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(65,66,67),64);
		return view ('Registros_Basicos\PlaneS\planes',$this->datos_vista($datos,$acciones,DB::table('planes')->paginate(11),5));

		
	}

public function planesIngresar()
{

	$formulario=['nombreP'=>strtoupper(Request::get('nomPn')),'descuento'=>Request::get('porDes'),'status'=>Request::get('stPn')];
	$duplicate=Plan::where('nombreP',$formulario['nombreP'])->count();
	$insert=false;

	if($duplicate==0)
	{
		$nuevoPlan=new Plan;
		$nuevoPlan->nombreP=$formulario['nombreP'];
		$nuevoPlan->status=$formulario['status'];
		$nuevoPlan->descuento=$formulario['descuento'];
		$insert=$nuevoPlan->save();
		if($insert)
		{
			$this->registroBitacora($nuevoPlan->id,'Agregar Plan',json_encode($nuevoPlan),'Planes -> Agregar Plan');
		}
		
	}

	
	return Response()->json(['duplicate'=>$duplicate,'insert'=>$insert]);	
}
	

public function planes_servicios_servicios($id_plan)
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(),false);//identificar acciones para la vista de servicios
		$nombre=DB::table('planes')->where('id',$id_plan)->value('nombreP');
		return view ('Registros_Basicos\PlaneS\servicios',$this->datos_vista($datos,$acciones,array(),$id_plan,$nombre));

		
	}
///////////////////////// CARGAR DATOS EN LOS MODALES DE SERVICIOS ASOCIADOS A UN PLAN ///////////////////////////////////////
public function valores_servicios(){
	$id= Request::get('datos');
	//dd($id);
	$tablas=	array(	's1' => 'horarios',
				  		's2' => 'presenciales',
				  		's3' => 'remotos',
				  		's4' => 'telefonicos',
				  		's5' => 'respuestas'
				);
	$consulta=DB::table($tablas[$id[0]])->where('plan_id',$id[1])->first();
	if (count($consulta) == 1) {
		if ($id[0] == 's1') {
			$respuesta= array(	$consulta->horaI,
								$consulta->horaF,
								$consulta->diaI,
								$consulta->diaF,
								$consulta->precio
						);
		}
		elseif ($id[0] == 's2' || $id[0] == 's3' || $id[0] == 's4') {
			$respuesta= array(	$consulta->etiqueta,
								$consulta->valor,
								$consulta->precio,
						);
		}	
		elseif ($id[0] == 's5') {
			$respuesta= array(	's5',
								$consulta->maximo,
								$consulta->precio
						);
		}
	}
	elseif (count($consulta) == 0){
		$respuesta = array('1' => '' );
	}

return $respuesta;
}

////////////////////////// INSERTAR Y ACTUALIZAR REGISTROS DE LOS SERVICIOS ASOCIADOS A UN PLAN //////////////////////////////

public function insertar_servicios(){
	$datos=Request::get('datos');
	if($datos[2]=='s1'){
		DB::table('horarios')->where('plan_id','=',$datos[1])->delete();
		DB::table('horarios')->insert
				 	(

				 		[	'plan_id'=>$datos[1],
				 			'horaI'=> $datos[0][0],
				 			'horaF'=> $datos[0][1],
				 			'diaI' => $datos[0][2],
				 			'diaF' => $datos[0][3],
				 			'precio'=>$datos[0][4],

				 		]
				 	);

		$respuesta= 1;

	}
	elseif($datos[2]=='s2'){
		DB::table('presenciales')->where('plan_id','=',$datos[1])->delete();
		DB::table('presenciales')->insert
				 	(

				 		[	'plan_id'=>$datos[1],
				 			'etiqueta'=> $datos[0][0],
				 			'valor'=> $datos[0][1],
				 			'precio' => $datos[0][2],
				 		]
				 	);
		$respuesta= 1;
	}
	elseif($datos[2]=='s3'){
		DB::table('remotos')->where('plan_id','=',$datos[1])->delete();
		DB::table('remotos')->insert
				 	(

				 		[	'plan_id'=>$datos[1],
				 			'etiqueta'=> $datos[0][0],
				 			'valor'=> $datos[0][1],
				 			'precio' => $datos[0][2],
				 		]
				 	);
		$respuesta= 1;
	}
	elseif($datos[2]=='s4'){
		DB::table('telefonicos')->where('plan_id','=',$datos[1])->delete();
		DB::table('telefonicos')->insert
				 	(

				 		[	'plan_id'=>$datos[1],
				 			'etiqueta'=> $datos[0][0],
				 			'valor'=> $datos[0][1],
				 			'precio' => $datos[0][2],
				 		]
				 	);
		$respuesta= 1;
	}
	elseif($datos[2]=='s5'){
		DB::table('respuestas')->where('plan_id','=',$datos[1])->delete();
		DB::table('respuestas')->insert
				 	(

				 		[	'plan_id'=>$datos[1],
				 			'maximo'=> $datos[0][0],
				 			'precio' => $datos[0][1],
				 		]
				 	);
		$respuesta= 1;
	}
	else{
		$respuesta= 0;
	}
	return $respuesta;
}
///////////////////////////////////////   actualizar los datos del modal  //////////////////////////////

public function planesActualizar()
{
	
	$formulario=['nombreP'=>strtoupper(Request::get('nomPlan')),'descuento'=>Request::get('porDesc'),'status'=>Request::get('statusPlan'),'id'=>Request::get('registroPlan')];

	$indicadores=['update'=>false,'duplicate'=>1];
	$cambios=[];
	//////////////////////////////Verificar si el registro existe en el sistema /////////////////////////////////////////////////////
	$indicadores['duplicate']=Plan::where('nombreP',$formulario['nombreP'])->count();
	//////////////////////////////////////Si no hay registros duplicados ////////////////////////////////////////////////////////////
	if($indicadores['duplicate']==0)
	{
       $aux=$this->compararCampos($formulario,$indicadores['duplicate'],Plan::find($formulario['id']));
       $indicadores['update']=$aux['update'];
       if($indicadores['update']==true)
       {
       	$cambios=(string) json_encode($aux['cambios']);
       	$this->registroBitacora($formulario['id'],'Modificar Plan',$cambios,'Planes -> Modificar Plan');
       }

	}



	return Response()->json($indicadores);
	
}
////////////////////////////////////// cargar datos al modal///////////////////////////////////////////////////////

public function planesModificar()
{
   $registry=Request::get('registry');
   $plan=Plan::find($registry);
   return $plan;


}

function planesModificarStatus()
{
	$status=[1,0];
	$registry=Request::get('registry');
	$aux=false;
	///////////// Busqueda del perfil y cambio de status ////////////////////////
	$plan=Plan::find($registry);
	$plan->status=$status[$plan->status];
	$aux=$plan->save();
	/////////////////////////////////////////////////////////////////////////////////////////////////////
    $this->registroBitacora($registry,'Cambiar Status','{"status":"'.$status[$plan->status].' -> '.$plan->status.'"}','Planes');
    /////////////////////////////////////////////////////////////////////////////////////////////////////

	return Response()->json(['update'=>$aux]);

}
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////// submodulos empleados /////////////////////////////////////////////////////////////////


public function empleados()
{
		$tipoR=DB::table('tipos')->where('numero_c',1)->get();
		$tipoD=DB::table('tipos')->where('numero_c',5)->get();
		$paises=DB::table('paises')->get();
		$codigoC=DB::table('tipos')->where('numero_c',2)->get();
		$codigoL=DB::table('tipos')->where('numero_c',3)->get();
		$directores=DB::table('directores')->where('status',1)->get();
		$perfilEmpleados=DB::table('empleado_usuario')->get();

		$empleados_usuario=[];

		foreach($perfilEmpleados as $usuario)
		{
			array_push($empleados_usuario,$usuario->empleado_id);
		}


	$datos=$this->cargar_header_sidebar_acciones();
	$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(76,77,78),75);
	return view ('Registros_Basicos\empleados\empleados',$this->datos_vista($datos,$acciones,DB::table('empleados')->get(),$tipoR,$tipoD,$paises,$codigoC,$codigoL,$directores,$empleados_usuario));//el 3 significa que es la vista 3
}

public function empleados_perfiles($empleado_id)
{
	
	$datos=$this->cargar_header_sidebar_acciones();
	$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(),false);
	
	$empleado=Empleado::find($empleado_id);
	$usuario=$empleado->usuarios;
	$usuario=$usuario[0];

	$perfil=Perfil::find($usuario->perfil_id);



	

	

	
	return view ('Registros_Basicos\empleados\empleados_perfil',$this->datos_vista($datos,$acciones,
						DB::table('perfiles')->where('id','<>',13)->where('id','<>',16)->get(),
						$usuario->n_usuario,//extra
						$perfil->id,//datosC1
						$usuario->id//datosC2
					
						));
}

public function empleados_asignar_perfil()
{
	$valores=Request::get('datos');//usuario [0] , perfil [1]
	
	$usuario=(int)$valores[0];
	$perfil=(int)$valores[1];

	$actualizacion=DB::table('usuarios')->where('id',$usuario)->update(['perfil_id'=>$perfil]);
	return $actualizacion;
	
}

public function empleadosModificar()
{
	$empleado=Empleado::find(Request::get('registry'));
	return Response::json([$empleado]);
}

public function cargar_modal_agregar(){
	$parametro= Request::get('datos');
	$id=$parametro[0];
	
	if ($id==1) {
		$consulta = DB::table('cargos')->where('departamento_id',$parametro[1])->where('status',1)->get();
	}
	elseif ($id==2) {
		$consulta = DB::table('regiones')->where('pais_id',$parametro[1])->get();
	}
	elseif ($id==3) {
		$consulta = DB::table('estados')->where('region_id',$parametro[1])->get();
	}
	elseif ($id==4) {
		$consulta = DB::table('municipios')->where('estado_id',$parametro[1])->get();
	}
	return $consulta;
}

///////////////////////////////////Insertar empleados : submoduloEmpleados ///////////////////////////////////////////////////////



public function empleadosStatus()
{
	$status=[1,0];
	$registry=Request::get('registry');
	$aux=false;
	/////////////////Busqueda del empleado y cambio de status ////////////////////////////////////////////
	$empleado=Empleado::find($registry);
	$empleado->status=$status[$empleado->status];
	$aux=$empleado->save();
	/////////////////////////////////////////////////////////////////////////////////////////////////////
    $this->registroBitacora($registry,'Cambiar Status','{"status":"'.$status[$empleado->status].' -> '.$empleado->status.'"}','Empleados');
    /////////////////////////////////////////////////////////////////////////////////////////////////////

	return Response()->json(['update'=>$aux]);
}



public function selectStructura()
{

	$idRegistro=Request::get('idRegistro');
	$caso=(int)Request::get('caso');
	$resultado=null;

	if($caso==1)
	{
		$resultado=Departamento::where(['director_id'=>$idRegistro,'status'=>1])->select('descripcion','id')->get();
	}
	else if($caso==2)
	{
		$resultado=Area::where(['departamento_id'=>$idRegistro,'status'=>1])->select('descripcion','id')->get();
	}
	else if($caso==3)
	{
		$resultado=Cargo::where(['area_id'=>$idRegistro,'status'=>1])->select('descripcion','id')->get();
	}



	return Response::json($resultado);
}
public function caprturarFormularioEmpleado()
{
	$formulario=array(

						'primerNombre'=>strtoupper(Request::get('nomEmp1')),
						'segundoNombre'=>strtoupper(Request::get('nomEmp2')),
						'primerApellido'=>strtoupper(Request::get('apellEmp1')),
						'segundoApellido'=>strtoupper(Request::get('apellEmp2')),
						'tipoRif'=>Request::get('TrifEmp'),
						'numeroRif'=>Request::get('rifEmp'),
						'tipoCedula'=>Request::get('TciEmp'),
						'numeroCedula'=>Request::get('ciEmp'),
						'fechaNacimiento'=>Request::get('fnEmp'),
						'director'=>Request::get('direccionEmpr'),
						'departamento'=>Request::get('departamentoEmp'),
						'area'=>Request::get('areaEmp_agr'),
						'cargo'=>Request::get('cgoEmp'),
						'pais'=>Request::get('pdhe'),
						'region'=>Request::get('rgdhe'),
						'estado'=>Request::get('edodhe'),
						'municipio'=>Request::get('mundhe'),
						'codigoPostal'=>Request::get('codigoPostal'),
						'descripcionDireccion'=>Request::get('descpdhe'),
						'telefonoLocal1Codigo'=>Request::get('numerol_1c'),
						'telefonoLocal1Numero'=>Request::get('numerol_1t'),
						'telefonoLocal2Codigo'=>Request::get('numerol_2c'),
						'telefonoLocal2Numero'=>Request::get('numerol_2t'),
						'telefonoMovilCodigo'=>Request::get('numerom_c'),
						'telefonoMovil'=>Request::get('numerom_t'),
						'correo'=>Request::get('correo_agr'),
						'nombreUsuario'=>Request::get('nomUs_agr'),
						'password'=>Request::get('psw_agr'),
						'status'=>Request::get('statusEm_agr')


						);
				


	return $formulario;
}


public function certificarCedulaRif($cedula,$rif)
{

		$duplicado=array('cedula_id'=>0,'rif_id'=>0,'codigo'=>0,'extra'=>0);
		$consultaCedula=Cedula::where(['numero'=>$cedula['numero'],'tipo_id'=>$cedula['tipo'],'rol'=>'EMPLEADO'])->first();
		$consultaRif=Rif::where(['numero'=>$rif['numero'],'tipo_id'=>$rif['tipo'],'rol'=>'EMPLEADO'])->first();

		if(count($consultaCedula)!=0)
		{
			
			$duplicado['cedula_id']=$consultaCedula->id;
		}

		if(count($consultaRif)!=0)
		{
			
			$duplicado['rif_id']=$consultaRif->id;
		}

		return($duplicado);

}



public function insertar_empleado()
{
	$formulario=$this->caprturarFormularioEmpleado();
	$duplicado=$this->certificarCedulaRif(array('numero'=>$formulario['numeroCedula'],'tipo'=>$formulario['tipoCedula']), array('numero'=>$formulario['numeroRif'],'tipo'=>$formulario['tipoRif']));
	$mensaje="";
	



	   

	if($duplicado['cedula_id']==0 && $duplicado['rif_id']==0)
	{

		$cedula=new Cedula();
		$cedula->numero=$formulario['numeroCedula'];
		$cedula->tipo_id=$formulario['tipoCedula'];
		$cedula->rol='EMPLEADO';
		$cedula->save();

		$rif=new Rif();
		$rif->numero=$formulario['numeroRif'];
		$rif->rol="EMPLEADO";
		$rif->tipo_id=$formulario['tipoRif'];
		$rif->save();


		$correo=new Correo();
		$correo->correo=$formulario['correo'];
		$correo->save();


		$direccion=new Direccion();
		$direccion->descripcion=$formulario['descripcionDireccion'];
		$direccion->codigoPostal=$formulario['codigoPostal'];
		$direccion->municipio_id=$formulario['municipio'];
		$direccion->pais_id=$formulario['pais'];
		$direccion->region_id=$formulario['region'];
		$direccion->estado_id=$formulario['estado'];
		$direccion->save();


		$empleado=new Empleado();
		$empleado->primerNombre=$formulario['primerNombre'];
		$empleado->segundoNombre=$formulario['segundoNombre'];
		$empleado->primerApellido=$formulario['primerApellido'];
		$empleado->segundoApellido=$formulario['segundoApellido'];
		$empleado->fechaNacimiento=$formulario['fechaNacimiento'];
		$empleado->status=$formulario['status'];
		$empleado->cedula_id=$cedula->id;
		$empleado->rif_id=$rif->id;
		$empleado->correo_id=$correo->id;
		$empleado->direccion_id=$direccion->id;
		$empleado->cargo_id=$formulario['cargo'];
		$empleado->save();


		$telefonoLocal1=new Telefono();
		$telefonoLocal1->telefono=$formulario['telefonoLocal1Numero'];
		$telefonoLocal1->codigo=$formulario['telefonoLocal1Codigo'];
		$telefonoLocal1->tipo=1;
		$telefonoLocal1->save();

		$telefonoLocal2=new Telefono();
		$telefonoLocal2->telefono=$formulario['telefonoLocal2Numero'];
		$telefonoLocal2->codigo=$formulario['telefonoLocal2Codigo'];
		$telefonoLocal2->tipo=1;
		$telefonoLocal2->save();

		
		$codigoMovil=Tipo::where('id',$formulario['telefonoMovilCodigo'])->select('descripcion')->first();

		$telefonoMovil=new Telefono();
		$telefonoMovil->telefono=$formulario['telefonoMovil'];
		$telefonoMovil->codigo=$codigoMovil->descripcion;
		$telefonoMovil->tipo=2;
		$telefonoMovil->save();


		$empleado->telefonos()->attach($telefonoLocal1->id);
		$empleado->telefonos()->attach($telefonoLocal2->id);
		$empleado->telefonos()->attach($telefonoMovil->id);

		$usuario=new Usuario();
		$usuario->n_usuario=$formulario['numeroCedula'];
		$usuario->clave=$formulario['password'];
		$usuario->status=$formulario['status'];
		$usuario->perfil_id=16;
		$usuario->save();
		$usuario->empleados()->attach($empleado->id);
		


		$duplicado['codigo']=1;


	}   
	else if($duplicado['cedula_id']!=0 && $duplicado['rif_id']!=0)//primera capa de mensajes  aqui se genera el error porque consulta un foreignKey que no existe
	{
		$duplicado['codigo']=2;///los datos de rif y cedula ya estan registrados
		$empleado=Empleado::where(['cedula_id'=>$duplicado['cedula_id'],'rif_id'=>$duplicado['rif_id']])->select('primerNombre','primerApellido')->first();
		$duplicado['extra']=$empleado->primerNombre.' '.$empleado->primerApellido;

	}

	

	



	

	

	return Response::json($duplicado);
}





public function selectEstructura()
{


}



public function cargar_combos(){
	$opcion=Request::get('opcion');
	$padreId=Request::get('padreId');
	if($opcion==1){
		
		$respuesta = DB::table('cargos')
		                ->select('cargos.id AS id','cargos.departamento_id AS padreId',
		            			 'cargos.descripcion AS descripcion')
		                ->where(['status'=>1,'departamento_id'=>$padreId])
		                ->get();
	}
	elseif($opcion==2){
		$respuesta = DB::table('regiones')
		                ->select('regiones.id AS id','regiones.pais_id AS padreId','regiones.descripcion AS descripcion')
		                ->where('pais_id',$padreId)->get();
	}
	elseif($opcion==3){
		$respuesta = DB::table('estados')->select('estados.id AS id','estados.region_id AS padreId','estados.descripcion AS descripcion')
		                 ->where('region_id',$padreId)->get();
	}
	elseif($opcion==4){
		$respuesta=DB::table('municipios')->select('municipios.id AS id','municipios.estado_id AS padreId','municipios.descripcion AS descripcion')
		                                 ->where('estado_id',$padreId)->get();
	}
	return json_encode($respuesta);
}
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////submodulo perfiles///////////////////////////////////////////////////////////////////////

public function perfiles()//ventana perfiles
{
	$datos=$this->cargar_header_sidebar_acciones();
	$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(84,85,86),83);
	return view('Registros_Basicos\Perfiles\perfiles',$this->datos_vista($datos,$acciones,DB::table('perfiles')->where('id','<>',13)->where('id','<>',16)->paginate(11),2));
}




public function configurarPerfil($perfil_id)
{
	$modulos=Modulo::all();
	$submodulos=Submodulo::all();
	$acciones=Accion::all();

	foreach ($modulos as $modulo) 
	{
		
		if($modulo->status_m==1)
		{
			DB::table('modulo_perfil')->insert(['perfil_id'=>$perfil_id,'modulo_id'=>$modulo->id,'status'=>0]);
		}
	}

	foreach ($submodulos as $submodulo) 
	{
		if($submodulo->status_sm==1)
		{
			DB::table('perfil_submodulo')->insert(['perfil_id'=>$perfil_id,'submodulo_id'=>$submodulo->id,'status'=>0]);
		}
	}

	foreach($acciones as $accion)
	{
		if($accion->status_ac==1)
		{
			DB::table('accion_perfil')->insert(['perfil_id'=>$perfil_id,'accion_id'=>$accion->id,'status'=>0]);
		}
	}


	return 0;

}




public function perfiles_insertar()
{
	
	$formulario=['descripcion'=>strtoupper(Request::get('DescripcionAdd')),'status'=>Request::get('StatusAdd')];
	$duplicate=Perfil::where('descripcion',$formulario['descripcion'])->count();
	$insert=false;

	if($duplicate==0)
	{
		$nuevoPerfil=new Perfil;
		$nuevoPerfil->descripcion=$formulario['descripcion'];
		$nuevoPerfil->status=$formulario['status'];
		$insert=$nuevoPerfil->save();
		if($insert)
		{
			$this->registroBitacora($nuevoPerfil->id,'Agregar Perfil',json_encode($nuevoPerfil),'Perfil -> Agregar Perfil');
		}
		
	}

	$this->configurarPerfil($nuevoPerfil->id);

	
	return Response()->json(['duplicate'=>$duplicate,'insert'=>$insert]);

}

public function registroBitacora($registry,$accion,$detalles,$ventana)
{

	$datos=Session::get('sesion');
	$usuario=$datos[0]['nombre'].' '.$datos[0]['apellido'];
	

	$bitacora=new Bitacora;
	$bitacora->usuario=$usuario;
	$bitacora->accion=$accion;
	$bitacora->registro_id=$registry;
	$bitacora->detalles=$detalles;
	$bitacora->ventana=$ventana;

     return $bitacora->save();

}

public function perfilesModificarStatus()
{

	$status=[1,0];
	$registry=Request::get('registry');
	$aux=false;
	///////////// Busqueda del perfil y cambio de status ////////////////////////
	$perfil=Perfil::find($registry);
	$perfil->status=$status[$perfil->status];
	$aux=$perfil->save();
	/////////////////////////////////////////////////////////////////////////////////////////////////////
    $this->registroBitacora($registry,'Cambiar Status','{"status":"'.$status[$perfil->status].' -> '.$perfil->status.'"}','Perfil');
    /////////////////////////////////////////////////////////////////////////////////////////////////////

	return Response()->json(['update'=>$aux]);
}

public function perfilesModificar()//obtiene la informacion que va al modal modificar
{

	$registry=Request::get('registry');
	$consultaPerfil=Perfil::find($registry);//retorna los datos del perfil consultado
	return $consultaPerfil;
}

public function compararCampos($formulario,$duplicado,$registro)
{
    $cambios=[];
    $update=false;

	
		foreach ($formulario as $llave => $valor) 
		{
			if($llave!='id')//si no es el campo id
			{
				if($registro->$llave!=$formulario[$llave])//si existe diferencias entre un campo del formulario y la base de datos
				{
					$cambios[strtoupper($llave)]=$registro->$llave.' -> '.$formulario[$llave];
					$registro->$llave=$formulario[$llave];
					$aux=$registro->save();
					if($aux==true)
						{$update=$aux;}
				}
			}
		}
	return ['cambios'=>$cambios,'update'=>$update];
}


public function perfilesActualizar()
{

	$formulario=['descripcion'=>strtoupper(Request::get('Descripcion')),'status'=>Request::get('Status'),'id'=>Request::get('Registro')];
	$indicadores=['update'=>false,'duplicate'=>1];
	$cambios=[];
	

	//////////////////////////////Verificar si el registro existe en el sistema /////////////////////////////////////////////////////
	$indicadores['duplicate']=Perfil::where('descripcion',$formulario['descripcion'])->count();
	//////////////////////////////////////Si no hay registros duplicados ////////////////////////////////////////////////////////////
	if($indicadores['duplicate']==0)
	{
       $aux=$this->compararCampos($formulario,$indicadores['duplicate'],Perfil::find($formulario['id']));
       $indicadores['update']=$aux['update'];
       if($indicadores['update']==true)
       {
       	$cambios=(string) json_encode($aux['cambios']);
       	$this->registroBitacora($formulario['id'],'Modificar Perfil',$cambios,'Perfil -> Modificar Perfil');
       }

	}

	

   return Response()->json($indicadores);
}


public function perfiles_permisos($perfil_id)
{
	$perfil=Perfil::find($perfil_id);
	//$modulos=DB::table('modulos')->where('status_m',1)->get();//$perfil->modulos; //trae los modulos asociados a un perfil

		
	$registros=DB::table('perfiles')
				  ->join('modulo_perfil','perfiles.id','=','modulo_perfil.perfil_id')
				  ->join('modulos','modulo_perfil.modulo_id','=','modulos.id')

				  ->select('perfiles.id AS perfilId','perfiles.descripcion AS perfilNom','perfiles.status AS perfilSta','modulo_perfil.status AS status','modulo_perfil.id AS registroId',
				  		   'modulos.id AS moduloId','modulos.descripcion AS moduloNom','modulos.status_m AS moduloSta')
				  ->where(['modulos.status_m'=>1,'perfiles.id'=>$perfil_id])->get();

	$modulos=$perfil->modulos;
	$datos=$this->cargar_header_sidebar_acciones();
	$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(84,85),83);
	return view('Registros_Basicos\Perfiles\perfiles_modificar',$this->datos_vista($datos,$acciones,$registros,(int)$perfil_id,$perfil->descripcion));
}


public function perfiles_configurar_moduloDependencias()//usado cuando se activa o desactiva un check/afecta al modulo y a los submodulos
{
	
	/*Controlador empleado cuando se checkea un check de modulos en la ventana permisos para actualizar el status de un modulo y de sus dependencias
		actualiza el status de los submodulos asociados al modulo seleccionado y al perfil seleccionado actualmente, lo mismo pasa con los submodulos y las acciones.

		*las variables actualizar son solo contadores, ya que cada una obtiene el numero de registros que actualiza la sentencia update
		*el perfil actual es obtenido de la primera consulta, donde con el id del registro a modificar en la tabla (perfil_modulos) obtengo el id,perfil_id y modulo_id
	
	*/

	$valores=[1,0];
	$c=array();
	$actualizar=0;
	$datos=Request::get('datos');
	$modulo=DB::table('modulo_perfil')->where('id',$datos)->first();
	$actualizar_m=DB::table('modulo_perfil')->where('id',$datos)->update(['status'=>$valores[$modulo->status]]);
	$actualizar_s=DB::table('perfil_submodulo')->join('submodulos','perfil_submodulo.submodulo_id','=','submodulos.id')->where(['submodulos.modulo_id'=>$modulo->modulo_id,'perfil_submodulo.perfil_id'=>$modulo->perfil_id])->where(['submodulos.status_sm'=>1,'submodulos.padre'=>1])->update(['perfil_submodulo.status'=>$valores[$modulo->status]]);
	$submodulos=DB::table('submodulos')->where('modulo_id',$modulo->modulo_id)->where(['status_sm'=>1,'padre'=>1])->get();
	$actualizar_ac=0;
	
	foreach ($submodulos as $submodulo) //recorre cada submodulo asociado al perfil y al modulo seleccionado, actualizando sus acciones
	{
		$actualizar_ac=$actualizar_ac+DB::table('acciones')->join('accion_perfil','accion_perfil.accion_id','=','acciones.id')->where(['acciones.submodulo_id'=>$submodulo->id,'accion_perfil.perfil_id'=>$modulo->perfil_id])->where('accion_perfil.status','<>',$valores[$modulo->status])->update(['accion_perfil.status'=>$valores[$modulo->status]]);
		
	}

	return(($actualizar_m+$actualizar_s+$actualizar_ac));//cantidad de actualizaciones realizadas

}



public function perfiles_configurar_modulo()//lo activa el submodulo, cuando el modulo padre esta desactivado o activado y no hay submodulos asociados activos
{

	$valores=[1,0];
	$datos=(int)Request::get('datos');//solo registro
	$consulta=DB::table('modulo_perfil')->where('id',$datos)->first();
	$actualizar=DB::table('modulo_perfil')->where('id',$datos)->update(["status"=>$valores[$consulta->status]]);
	return($actualizar);
}


public function perfiles_configurar_submoduloDependencias()
{
	$valores=[1,0];
	$datos=(int)Request::get('datos');//solo el registro
	$submodulo=DB::table('perfil_submodulo')->where('id',$datos)->first();
	$actualizar_s=DB::table('perfil_submodulo')->where('id',$datos)->update(["status"=>$valores[$submodulo->status]]);
	$actualizar_ac=DB::table('acciones')->join('accion_perfil','accion_perfil.accion_id','=','acciones.id')->where(['acciones.submodulo_id'=>$submodulo->submodulo_id,'accion_perfil.perfil_id'=>$submodulo->perfil_id])->where('accion_perfil.status','<>',$valores[$submodulo->status])->update(['accion_perfil.status'=>$valores[$submodulo->status]]);

	return($actualizar_s+$actualizar_ac);
}

public function perfiles_configurar_submodulo()
{
	$valores=[1,0];
	$datos=(int)Request::get('datos');//solo el registro
	$consulta=DB::table('perfil_submodulo')->where('id',$datos)->first();
	$actualizar=DB::table('perfil_submodulo')->where('id',$datos)->update(["status"=>$valores[$consulta->status]]);

	return($actualizar);
}

public function perfiles_configurar_accion()
{
	$valores=[1,0];
	$datos=(int)Request::get('datos');//solo el registro
	$consulta=DB::table('accion_perfil')->where('id',$datos)->first();
	$actualizar=DB::table('accion_perfil')->where('id',$datos)->update(["status"=>$valores[$consulta->status]]);

	return($actualizar);
}


public function mostrar_submodulos()//muestra los submodulos asociados a un modulo
{
	
	//
	//$submodulos_=array();//submodulos que se mostraran en la vista
	
	$datos=Request::get('valores');//id del perfil para el cual se desea mostrar los submodulos
	
	$submodulos=DB::table('submodulos')
					->join('perfil_submodulo','submodulos.id','=','perfil_submodulo.submodulo_id')
					->join('perfiles','perfiles.id','=','perfil_submodulo.perfil_id')

					->select('submodulos.id AS submoduloId','submodulos.descripcion AS descripcion','submodulos.modulo_id AS padre',
							 'submodulos.status_sm AS submoduloStatus','perfiles.id AS perfilId','perfiles.descripcion AS perfilDescripcion',
							 'perfil_submodulo.id AS registro','perfil_submodulo.status AS Status')
					->where(['submodulos.modulo_id'=>$datos[1],'perfiles.id'=>$datos[0],'submodulos.status_sm'=>1,'submodulos.padre'=>1])->get();




	//$submodulos_=DB::table('submodulos')->where(['modulo_id'=>$datos[1],'status_sm'=>1,'padre'=>1])->get();

	return $submodulos;
}


public function mostrar_acciones()
{
	$acciones_=array();
	$datos=Request::get('valoresAcc');

	$acciones=DB::table('acciones')
					->join('accion_perfil','acciones.id','=','accion_perfil.accion_id')
					->join('perfiles','perfiles.id','=','accion_perfil.perfil_id')

					->select('acciones.id AS accionId','acciones.ventana AS ventana','acciones.descripcion AS descripcion','acciones.submodulo_id AS padre',
							 'acciones.status_ac AS accionStatus','acciones.accion_id AS dependencia','acciones.ventana AS ventana','perfiles.id AS perfilId','perfiles.descripcion AS perfilDescripcion',
							 'accion_perfil.id AS registro','accion_perfil.status AS Status')
					->where(['acciones.submodulo_id'=>$datos[1],'perfiles.id'=>$datos[0],'acciones.status_ac'=>1])->orderBy('orden', 'asc')->get();



	//$acciones_=DB::table('acciones')->where('submodulo_id',$datos[1])->get();
	

  return $acciones;
}
	
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////// submodulo clientes////////////////////////////////////////////////////////////////////////

//////////////////////////////////Cliente Matriz//////////////////////////////////////////////////////////////////////////////

public function clientes()//inicializacion del submodulo: clientes
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(9,10,11,12),8);

		$consulta=DB::table('clientes')->get();
		$tipoR=DB::table('tipos')->where('numero_c',1)->get();
		$tipoC=DB::table('tipos')->where('numero_c',4)->get();
		$paises=DB::table('paises')->get();
		$regiones=DB::table('regiones')->get();
		$estados=DB::table('estados')->orderBy('descripcion')->get();
		$municipios=DB::table('municipios')->orderBy('descripcion')->get();
		$codigoC=DB::table('tipos')->where('numero_c',2)->get();
		$codigoL=DB::table('tipos')->where('numero_c',3)->get();
		

		return view('Registros_Basicos\Clientes\clientes',
															['modulos'=>$datos['modulos'],//side bar
															 'submodulos'=>$datos['submodulos'],//side bar
															 'nombre'=>$datos['nombre'],//header
															 'apellido'=>$datos['apellido'],//header
															 'acciones'=>$acciones['acciones'],//acciones
															 'agregar'=>$acciones['agregar'],//boton de agregar
															 'consulta'=>$consulta,//registros provenientes de la base de datos
															 'tipoR'=>$tipoR,
															 'tipoC'=>$tipoC,
															 'paises'=>$paises,
															 'regiones'=>$regiones,
															 'estados'=>$estados,
															 'municipios'=>$municipios,
															 'codigoC'=>$codigoC,
															 'codigoL'=>$codigoL,
															 'extra'=>6



															]


			); 
	}
	

	

	public function clientes_registrar()//manejo de los select para direcciones del cliente matriz 
	{	
		
		$seleccion=Request::get('vector');


		if ($seleccion[0]=="paisdf" or $seleccion[0]=="paisdc") //se seleccionan paises

		{
			$valor=(int)$seleccion[1];
			$opciones=DB::table('regiones')->select('id','descripcion')->where('pais_id',$valor)->get();
			return $opciones;


		}
		elseif ($seleccion[0]=="regiondf" or $seleccion[0]=="regiondc")//se selecciona la region
		{
			$valor=(int)$seleccion[1];
			$opciones=DB::table('estados')->select('id','descripcion')->where('region_id',$valor)->get();
			return $opciones;
	
		}
		elseif ($seleccion[0]=="edodf" or $seleccion[0]=="edodc") //se selecciona el estado

		 {
			$valor=(int)$seleccion[1];
			$opciones=DB::table('municipios')->select('id','descripcion')->where('estado_id',$valor)->get();
			return $opciones;
		}



	}
	
	
	
	public function clientes_insertar()//inserta en la base de datos un nuevo cliente matriz
	{
		
		//capturar datos del formulario

		$razonS=Request::get('rsnew');//razon social
		$nombreC=Request::get('ncnew');//nombre comercial
		
		$tipoR=(int) Request::get('tiporif');//tipo rif
		$numeroR= Request::get('numerorif');//numero rif
		
		$tipoC=(int)Request::get('tipConnew');//tipo de contribuyente
		
		
		
		$direccionF=Request::get('descDirdf');//direccion fiscal
		$paisF=(int)Request::get('paisdf');//pais fiscal
		$regionF=(int)Request::get('regiondf');//region fiscal
		$estadoF=(int)Request::get('edodf');//estado fiscal
		$municipioF=(int)Request::get('mundf');//municipiofiscal
		
		$direccionC=Request::get('descDirdc');//direccion comercial
		$paisC=(int)Request::get('paisdc');//pais comercial
		$regionC=(int)Request::get('regiondc');//region comercial
		$estadoC=(int)Request::get('edodc');//estado comercial
		$municipioC=(int)Request::get('mundc');//municipio comercial

		
		$codigoL=Request::get('tlflsv');//codigo local
		$codigoM=Request::get('tlfmvlsv');//codigo movil

		$telefonoM=Request::get('tmvlsv');//nro movil
		$telefonoL=Request::get('tclsv');//nro local
		

		$correo=Request::get('mailsv');//correo electronico

		

		

		////inserciones
		
				$idR= DB::table('rifs')->insertGetId//insertar rif 
						(
							['numero'=>$numeroR,'rol'=>'cliente','tipo_id'=>$tipoR]
						);

					
					$idC=DB::table('contactos')->insertGetId//insercion de contacto
						(

						   ['tipo_id'=>$codigoM,'tipo__id'=>$codigoL,'telefono_m'=>$telefonoM,'telefono_f'=>$telefonoL,'correo'=>$correo]
						);


					
					$iddF=(integer) DB::table('direcciones')->insertGetId//insercion de direcciones direccion fiscal
						(

							['descripcion'=>$direccionF,'municipio_id'=>$municipioF,'pais_id'=>$paisF,'region_id'=>$regionF,'estado_id'=>$estadoF]
						);

					$iddC=(integer)DB::table('direcciones')->insertGetId//insercion de direcciones direccion comercial
						(

							['descripcion'=>$direccionC,'municipio_id'=>$municipioC,'pais_id'=>$paisC,'region_id'=>$regionC,'estado_id'=>$estadoC]
						);

					 DB::table('clientes')->insert
					 	(

					 		['razon_s'=>$razonS,'nombre_c'=>$nombreC,'rif_id'=>$idR,'tipo_id'=>$tipoC,'direccion_id'=>$iddF,'direccion__id'=>$iddC,'contacto_id'=>$idC]
					 	);
		
	


		return redirect('/menu/registros/clientes');//retorna a la vista clientes listado todos los clientes matriz de la base de datos;
	}

	
	
public function clientes_modificar()//metodo que consulta los datos de un cliente matriz para mostrarlos en el nodal modificar cliente
	{
		$id=(int)Request::get('idCliente');

	


		$cliente=DB::table('clientes')
					  ->join('rifs','clientes.rif_id','=','rifs.id')
					  ->join('contactos','clientes.contacto_id','=','contactos.id')
					  ->join('tipos','clientes.tipo_id','=','tipos.id')
					  

					  ->select('clientes.razon_s AS razonS','clientes.nombre_c AS nombreC','rifs.numero As numeroR','rifs.tipo_id AS tipoR',
					  		   'contactos.tipo_id AS codigoC','contactos.telefono_m AS telefonoC','contactos.tipo__id AS codigoL',
					  		   'contactos.telefono_f AS telefonoF','contactos.correo','tipos.id As idtipoContribuyente','tipos.descripcion As Contribuyente')
					  ->where('clientes.id',$id)->first();


		$direccionF=DB::table('clientes')->join('direcciones','clientes.direccion_id','=','direcciones.id')

										->join('paises','paises.id','=','direcciones.pais_id')
										->join('regiones','regiones.id','=','direcciones.region_id')
										->join('estados','estados.id','=','direcciones.estado_id')
										->join('municipios','municipios.id','=','direcciones.municipio_id')

										->select('paises.id As idpaisF','paises.descripcion As paisF',
												 'regiones.id As idregionF','regiones.descripcion As regionF ',
												 'estados.id As idestadoF','estados.descripcion As estadoF',
												 'municipios.id As idmunicipioF','municipios.descripcion As municipiosF',
												 'direcciones.id As iddireccionF','direcciones.descripcion As direccionF')
												
										
										->where('clientes.id',$id)->first();

		$direccionC=DB::table('clientes')->join('direcciones','clientes.direccion__id','=','direcciones.id')

										->join('paises','paises.id','=','direcciones.pais_id')
										->join('regiones','regiones.id','=','direcciones.region_id')
										->join('estados','estados.id','=','direcciones.estado_id')
										->join('municipios','municipios.id','=','direcciones.municipio_id')

										->select('paises.id As idpaisC','paises.descripcion As paisC',
												 'regiones.id As idregionC','regiones.descripcion As regionC ',
												 'estados.id As idestadoC','estados.descripcion As estadoC',
												 'municipios.id As idmunicipioC','municipios.descripcion As municipiosC',
												 'direcciones.id As iddireccionC','direcciones.descripcion As direccionC')
												
										
										->where('clientes.id',$id)->first();

		// 0 id cliente/ 1 razonS /2 nombreC /3 numeroRif / 4 tipo Rif / 5 tipo codigoCelular 
		//  6 numero Celular / 7 codigo telefono local / 8 numero de telefono local /9 correo 
		//10 id tipo contirbuyente/11 descripcion tipo de contribuyente
		//12 paisidF /13 paisF/14 regionidF/15 regionF /16 estadoidF/17 estadoF /18 municipioidF/19 municipio F/20 iddireccionF/21 direccionF
		//22 paisidC /23 paisC/24 regionidC/25 regionC /26 estadoidC/27 estadoC /28 municipioidC/29 municipioC /30 iddireccionC/31 direccionC


		return array($cliente->razonS,$cliente->nombreC,$cliente->numeroR,$cliente->tipoR,$cliente->codigoC,$cliente->telefonoC,
							  $cliente->codigoL,$cliente->telefonoF,$cliente->correo,$cliente->idtipoContribuyente,$cliente->Contribuyente,
							  $direccionF->idpaisF,$direccionF->paisF,$direccionF->idregionF,$direccionF->regionF,$direccionF->idestadoF,
							  $direccionF->estadoF,$direccionF->idmunicipioF,$direccionF->municipiosF,$direccionF->iddireccionF,$direccionF->direccionF,
							  $direccionC->idpaisC,$direccionC->paisC,$direccionC->idregionC,$direccionC->regionC,$direccionC->idestadoC,
							  $direccionC->estadoC,$direccionC->idmunicipioC,$direccionC->municipiosC,$direccionC->iddireccionC,$direccionC->direccionC);

		
	}




	public function clientes_actualizar()//metodo para actualizar en la base de datos los datos de un cliente matriz
	{

		$razonS=Request::get('rs');//razon social
		$nombreC=Request::get('nc');//nombre comercial
		
		$tipoR=(int) Request::get('rif');//tipo rif
		$numeroR= Request::get('df');//numero rif
		
		$tipoC=(int)Request::get('tipCon');//tipo de contribuyente
		
		
		
		$direccionF=Request::get('descDirdf');//direccion fiscal
		$paisF=(int)Request::get('paisdf');//pais fiscal
		$regionF=(int)Request::get('regiondf');//region fiscal
		$estadoF=(int)Request::get('edodf');//estado fiscal
		$municipioF=(int)Request::get('mundf');//municipiofiscal
		
		$direccionC=Request::get('descDirdc');//direccion comercial
		$paisC=(int)Request::get('paisdc');//pais comercial
		$regionC=(int)Request::get('regiondc');//region comercial
		$estadoC=(int)Request::get('edodc');//estado comercial
		$municipioC=(int)Request::get('mundc');//municipio comercial

		
		$codigoL=Request::get('tlflcl');//codigo local
		$codigoC=Request::get('tlfmvl');//codigo movil

		$telefonoM=Request::get('tmvl');//nro movil
		$telefonoL=Request::get('tcl');//nro local
		

		$correo=Request::get('mail');//correo electronico

		


		$id_cliente=(int)Request::get('Clienteid');//id del cliente a modificar

		$cliente=DB::table('clientes')->where('id',$id_cliente)->first();//cliente a modificar

		if (empty($cliente)==false)//si el cliente a modifica existe
			{	//////modificacion de razonS, nombreC y tipo contribuyente
				DB::table('clientes')->where('id',$id_cliente)->update(['razon_s'=>$razonS,'nombre_c'=>$nombreC,'tipo_id'=>$tipoC]);
				// ////modificacion del rif 
				 DB::table('rifs')->where('id',$cliente->rif_id)->update(['numero'=>$numeroR,'tipo_id'=>$tipoR]);
				// ///modificacion de la direccion Fiscal
				 DB::table('direcciones')->where('id',$cliente->direccion_id)->update(['descripcion'=>$direccionF,'municipio_id'=>$municipioF,'pais_id'=>$paisF,'region_id'=>$regionF,'estado_id'=>$estadoF]);
				// ///modificacion de la direccion comercial
				 DB::table('direcciones')->where('id',$cliente->direccion__id)->update(['descripcion'=>$direccionC,'municipio_id'=>$municipioC,'pais_id'=>$paisC,'region_id'=>$regionC,'estado_id'=>$estadoC]);
				// //modificacion contactos
				DB::table('contactos')->where('contactos.id',$cliente->contacto_id)->update(['tipo_id'=>$codigoC,'tipo__id'=>$codigoL,'telefono_m'=>$telefonoM,'telefono_f'=>$telefonoL,'correo'=>$correo]);
			}

		return redirect('/menu/registros/clientes');

	}
	
	
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////Responsables del cliente matriz/////////////////////////////////////////////



	public function clientes_responsables($cliente_id)//ventana de responsables para un cliente matriz
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(14,15),13);
		
		return view ('Registros_Basicos\Clientes\clientes_responsables',$this->datos_vista($datos,$acciones,
					  DB::table('personas')->where('cliente_id',$cliente_id)->get(),$cliente_id,
					  DB::table('tipos')->where('numero_c',5)->get(),//tipos de cedula para los select
					  DB::table('tipos')->where('numero_c',2)->get(),//tipos de codigos de telefonos para los select
					  DB::table('tipos')->where('numero_c',3)->get()));//tipos de codigos locales para los select 
					
	}

	public function clientes_insertar_responsable($cliente_id)//agregar posibles responsables a una matriz
	{
		
	
		$formulario=$this->capturar_datos_responsables();
		$this->consulta_ingresar_responsable($formulario,$cliente_id);
		return redirect('/menu/registros/clientes/responsable/'.(string)$cliente_id);//redirecciona a la venta que lista los responsables de un cliente matriz especifico: indicado por: $cliente_id
	}
	
	
			
	public function clientes_modificar_responsables()//consulta que muestra los datos del responsable de una matriz en e modal mofificar
	{

		$id=(int)Request::get('idResponsable');//campo hiiden con el id del registro a modificar
		
		$resp=DB::table('personas')
					->join('cedulas','personas.cedula_id','=','cedulas.id')
					->join('contactos','personas.contacto_id','=','contactos.id')
					->join('tipos','cedulas.tipo_id','=','tipos.id')

					->select('personas.p_nombre As nombre','personas.p_apellido As apellido','personas.cargo As cargo',
						     'cedulas.numero As numeroC','cedulas.tipo_id As tipoC','tipos.descripcion As tipoCV',
						     'contactos.tipo_id As codigoC','contactos.telefono_m As telefonoC','contactos.tipo__id As codigoL',
						     'contactos.telefono_f As telefonoL','personas.cliente_id As matriz','contactos.correo As correo')->where('personas.id',(int)$id)->first();

		return array($resp->nombre,$resp->apellido,$resp->cargo,$resp->numeroC,$resp->tipoC,$resp->tipoCV,
					 $resp->codigoC,$resp->telefonoC,$resp->codigoL,$resp->telefonoL,$resp->matriz,$resp->correo);
		
		
	}
	
	
	
	public function clientes_actualizar_responsable($id_cliente)//modifica en la base de datos la informacion de los responsables de una matriz
	{

		$formulario=$this->formulario_actualizar_responsable();
		$this->consulta_actualizar_responsable($formulario);
		$id_cliente=(int)$id_cliente;


		

			return redirect('/menu/registros/clientes/responsable/'.(string)$id_cliente);
	}
	

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////categorias de un cliente matriz //////////////////////////////////////////////////////////


public function clientes_categoria($cliente_id)//vista de categorias de un cliente matriz
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(16,17,18,19),20);
		return view ('Registros_Basicos\Clientes\clientes_categoria',$this->datos_vista($datos,$acciones,DB::table('categorias')->where('cliente_id',$cliente_id)->get(),$cliente_id,3));
						
	}

	
	
	

	public function clientes_categoria_agregar($id_cliente)///asociar categorias a un cliente matriz
	{
		$id=(int)$id_cliente;
		$nombreC=strtoupper(Request::get('nomCat'));//nombre de la categoria en mayusculas
		$statusC=(int)Request::get('stCat');//status de la categoria
		

		if(empty(DB::table('categorias')->where(['categorias.nombre'=>$nombreC,'categorias.cliente_id'=>$id_cliente])->first())==true)//si no existe
		{

			DB::table('categorias')->insert
			(['nombre'=>$nombreC,'status'=>$statusC,'cliente_id'=>$id]);
			
		}
		return redirect('/menu/registros/clientes/categoria/'.(string)$id);

						
	}
	
	
	public function clientes_categorias_modificar()//carga datos al modal modificar categoria
	{
		$categoria_id=(int)Request::get('idCategoria');
		$categorias=DB::table('categorias')->where('id',$categoria_id)->first();//buscar categoria por id
		return array($categorias->nombre,$categorias->status,$categorias->cliente_id);
		
	}

	public function clientes_categorias_actualizar($cliente_id)//actualiza los datos de una categoria en la base de datos
	{
		$nombreC=Request::get('nomCat');
		$statusC=(int)Request::get('stCat');
		$categoria_id=(int)Request::get('Categoriaid');

		DB::table('categorias')->where('id',$categoria_id)->update(['nombre'=>$nombreC,'status'=>$statusC]);

		return redirect('/menu/registros/clientes/categoria/'.(string)$cliente_id);
	}
	
	
	
	public function clientes_categoria_responsable($categoria_id)//listar responsables de una categoria
	{
		$categoria=$categoria_id;
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(22,23),21);
		$responsablesC=DB::table('categoria_persona')->where('categoria_id',$categoria_id)->first();
		if (empty($responsablesC)==false) //si esta lleno
		{
			$id=(int)$responsablesC->persona_id;//id del responsable de una categoria (radio button)
		}
		else
		{

			$id=0;//cuando la categoria no tiene responsable asignado
		}
		$consulta=DB::table('categorias')->where('categorias.id',$categoria)->first();
		return view ('Registros_Basicos\Clientes\clientes_categoria_responsable',$this->datos_vista($datos,$acciones,DB::table('categorias')->join('clientes','clientes.id','=','categorias.cliente_id')
								   ->join('personas','personas.cliente_id','=','clientes.id')
								   ->select('personas.id','personas.p_nombre','personas.p_apellido')
								   ->where('categorias.id','=',$categoria_id)->get(),
								   $id,
								   $categoria_id,
								   DB::table('tipos')->where('numero_c',5)->get(),//tipos de cedula $datosC2
								   DB::table('tipos')->where('numero_c',2)->get(),//tipos de codigo de celular $datosC3
								   DB::table('tipos')->where('numero_c',3)->get(),$consulta->cliente_id));//tipos dle codigos loca
						
	}

	
	
	



	public function clientes_insertar_responsable_categoria($categoria_id)//agregar posibles responsables a una categoria
		{

		
			$categoria=DB::table('categorias')->where('id',(int)$categoria_id)->first();
			if(empty($categoria)==false)
			{
				$formulario=$this->capturar_datos_responsables();
				$this->consulta_ingresar_responsable($formulario,$categoria->cliente_id);
				
			}
		
			return redirect('/menu/registros/clientes/categoria/responsable/'.(string)$categoria_id);
			
		}

		


	public function categorias_actualizar_responsables($id_categoria)
	{

		$formulario=$this->formulario_actualizar_responsable();
		$this->consulta_actualizar_responsable($formulario);

		return redirect('/menu/registros/clientes/categoria/responsable/'.(string)$id_categoria);
	}

////////////////////////////////////////////sucursales/////////////////////////////////////////////////////////////////////////


public function clientes_sucursales($categoria_id)//vista de sucursales de una categoria,lista las sucursales asociadas a un cliente matriz
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(25,26,27,28,29,30),24);//acciones 
		


		$consulta=DB::table('sucursales')->where('categoria_id',$categoria_id)->get();//sucursales asociadas a la categoria seleccionada
		$consulta_=DB::table('categorias')->where('id',$categoria_id)->first();
		$tipoR=DB::table('tipos')->where('numero_c',1)->get();//tipo de rif 
		$tipoC=DB::table('tipos')->where('numero_c',4)->get();//tipo de contribuyente
		$paises=DB::table('paises')->get();//paises 
		$regiones=DB::table('regiones')->get();//regiones
		$estados=DB::table('estados')->orderBy('descripcion')->get();//estados
		$municipios=DB::table('municipios')->orderBy('descripcion')->get();//municipios
		$codigoC=DB::table('tipos')->where('numero_c',2)->get();//codigo de celular
		$codigoL=DB::table('tipos')->where('numero_c',3)->get();//codigo de telefono fijo 
		

		return view('Registros_Basicos\Clientes\clientes_sucursales',
															['modulos'=>$datos['modulos'],//side bar
															 'submodulos'=>$datos['submodulos'],//side bar
															 'nombre'=>$datos['nombre'],//header
															 'apellido'=>$datos['apellido'],//header
															 'acciones'=>$acciones['acciones'],//acciones
															 'agregar'=>$acciones['agregar'],//boton de agregar
															 'consulta'=>$consulta,//registros provenientes de la base de datos
															 'tipoR'=>$tipoR,
															 'tipoC'=>$tipoC,
															 'paises'=>$paises,
															 'regiones'=>$regiones,
															 'estados'=>$estados,
															 'municipios'=>$municipios,
															 'codigoC'=>$codigoC,
															 'codigoL'=>$codigoL,
															 'clienteId'=>$consulta_->cliente_id,
															 'categoriaId'=>$categoria_id,
															 'extra'=>7]);

						
	}


	public function clientes_sucursales_responsable($sucursal_id)
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(32,33),31);
		$consulta=DB::table('sucursales')->where('id',$sucursal_id)->first();
		return view 
		(
			'Registros_Basicos\Clientes\clientes_sucursales_responsable',
			$this->datos_vista($datos,$acciones,array(),$sucursal_id,$consulta->categoria_id)
		);
						
	}

	public function clientes_sucursales_plan($sucursal_id)
		{
			$datos=$this->cargar_header_sidebar_acciones();
			$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(37),false);///reisar vista para boton agregar
			$consulta=DB::table('sucursales')->where('id',$sucursal_id)->first();
			return view ('Registros_Basicos\Clientes\clientes_sucursales_plan',$this->datos_vista($datos,$acciones,DB::table('planes')->paginate(11),$sucursal_id,$consulta->categoria_id));
							
		}
		

	public function clientes_sucursales_plan_servicios()
		{
			$datos=$this->cargar_header_sidebar_acciones();
			$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(40,39),38);
			return view ('Registros_Basicos\Clientes\clientes_sucursales_plan_servicios',$this->datos_vista($datos,$acciones,array()));
							
		}


	public function clientes_sucursales_equipos($sucursal_id)//vista de equipos de una sucursal
		{
			$datos=$this->cargar_header_sidebar_acciones();
			$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(42,43,44,49),41);
			$consulta=DB::table('sucursales')->where('id',$sucursal_id)->first();
			$tipoEquipo=DB::table('tequipos')->get();
			return view ('Registros_Basicos\Clientes\clientes_sucursales_equipos',$this->datos_vista($datos,$acciones,DB::table('equipos')->where('sucursal_id',$sucursal_id)->paginate(11),$sucursal_id,$consulta->categoria_id,$tipoEquipo,7));
							
		}

	public function clientes_sucursales_equipos_componentes($equipo_id)//vista de componentes de un equipo
		{
			$datos=$this->cargar_header_sidebar_acciones();
			$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(46,47,48),45);
			return view ('Registros_Basicos\Clientes\clientes_sucursales_equipos_componentes',$this->datos_vista($datos,$acciones,DB::table('componentes')->where('equipo_id',$equipo_id)->paginate(11),$equipo_id,8));
							
		}

	public function clientes_sucursales_equipos_aplicaciones($equipo_id)//vista de aplicaciones de un equipo
		{
			$datos=$this->cargar_header_sidebar_acciones();
			$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(51,52),50);
			return view ('Registros_Basicos\Clientes\clientes_sucursales_equipos_componentes_aplicaciones',$this->datos_vista($datos,$acciones,DB::table('aplicaciones')->where('equipo_id',$equipo_id)->paginate(11),$equipo_id,10));
							
		}
	
		public function clientes_sucursales_equipos_piezas($componente_id)//vista de piezas de un componente
		{
			$datos=$this->cargar_header_sidebar_acciones();
			$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(54,55),53);
			return view ('Registros_Basicos\Clientes\clientes_sucursales_equipos_componentes_piezas',$this->datos_vista($datos,$acciones,DB::table('piezas')->where('componente_id',$componente_id)->paginate(11),$componente_id,9));
							
		}


		public function clientes_sucursales_usuarios($sucursal_id)
			{
				$datos=$this->cargar_header_sidebar_acciones();
				$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(57,58,59),56);
				return view ('Registros_Basicos\Clientes\clientes_sucursales_usuarios',$this->datos_vista($datos,$acciones,array()));
								
			}

		public function clientes_sucursales_usuarios_perfil()
		{
			$datos=$this->cargar_header_sidebar_acciones();//crear acciones
			$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(61,62,63),60);
			return view ('Registros_Basicos\Clientes\clientes_sucursales_usuarios_perfil',$this->datos_vista($datos,$acciones,array()));
		}

		public function consultar_plan(){
			$id=Request::get('plan');
			
			$plan=DB::table('planes')->where('id',$id)->first();
			$horario=DB::table('horarios')->where('plan_id',$id)->first();
			$soporteP=DB::table('presenciales')->where('plan_id',$id)->first();
			$soporteR=DB::table('remotos')->where('plan_id',$id)->first();
			$soporteT=DB::table('telefonicos')->where('plan_id',$id)->first();
			$respuesta=DB::table('respuestas')->where('plan_id',$id)->first();
			$descuento=$plan->descuento;
			$precioH = $horario->precio;
			$precioP = $soporteP->precio;
			$precioR = $soporteR->precio;
			$precioT = $soporteT->precio;
			$precioRE = $respuesta->precio;
			$precioSD=  $precioH+$precioP+$precioR+$precioT+$precioRE;
			$precio = ($precioSD * $descuento) /100;
			$pt=$precioSD - $precio;
			$datos = 	array(	$horario->horaI,
								$horario->horaF,
								$horario->diaI,
								$horario->diaF,
								$soporteP->etiqueta,
								$soporteP->valor,
								$soporteR->etiqueta,
								$soporteR->valor,
								$soporteT->etiqueta,
								$soporteT->valor,
								$respuesta->maximo,
								$precio,
								$plan->nombreP
						);
			return $datos;
		}





	
	
	
		
			///////////////////////////////////javascript//////////////////////////////////////
		public function btn_modificar_pieza()
		{
			$piezaId=Request::get('datos');
			$registro=DB::table('piezas')->where('id',$piezaId)->first();
			$retorno=0;
			if (count($registro)!=0) 
			{
				$retorno=array($registro->descripcion,$registro->serial,$registro->marca,$registro->modelo,$registro->status,$registro->componente_id);
				
			}

			return($retorno);
		}

		public function btn_modificar_componente()
		{
			$componenteId=Request::get('datos');
			$registro=DB::table('componentes')->where('id',$componenteId)->first();
			$retorno=0;
			if (count($registro)!=0) 
			{
				$retorno=array($registro->descripcion,$registro->serial,$registro->marca,$registro->modelo,$registro->status,$registro->equipo_id);
				
			}

			return($retorno);
		}

		public function btn_modificar_aplicacion()
		{
			$aplicacionId=Request::get('datos');
			$registro=DB::table('aplicaciones')->where('id',$aplicacionId)->first();
			$retorno=0;
			if (count($registro)!=0) 
			{
				$retorno=array($registro->descripcion,$registro->licencia,$registro->version,$registro->status,$registro->equipo_id);
				
			}

			return($retorno);
		}

		public function btn_modificar_equipo()
		{
			$equipoId=Request::get('datos');
			$registro=DB::table('equipos')->where('id',$equipoId)->first();
			$retorno=0;
			if (count($registro)!=0) 
			{
				$retorno=array($registro->descripcion,$registro->tipo,$registro->marca,$registro->modelo,$registro->serial,$registro->status,$registro->sucursal_id);
				
			}

			return($retorno);
		}

		public function select_equipos()
		{
			$tablas=array("tequipos");
			$intermedias=array("emarca_tequipo");
			$datos=Request::get('datos');
			$descripcionEq=$datos[0];
			$tabla=$datos[1];
			$registros=0;


			//////////////////buscar la descripcion en la tabla/////////////////
			
			if ($tabla==0) 
			{
				$id=DB::table('tequipos')->where('descripcion',$descripcionEq)->first();//ya tengo el id
				$marcas=array();
				$dependencias=DB::table('emarca_tequipo')->where('tequipo_id',$id->id)->get();//obtiene el id de las marcas
				foreach ($dependencias as $marca) 
				{
					array_push($marcas,DB::table('emarcas')->where('id',$marca->emarca_id)->first());
				}
				$registros=$marcas;
			}
		
			return($registros);

		}





	
	
	


	
	



//////////////////////////////////////////////////////////Datos complementarios////////////////////////////////////////////////////////////////////


	public function datos_complementarios()
	{
		$datos=$this->cargar_header_sidebar_acciones();//
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(88,89,90,91),false);
		return view('Registros_Basicos\Datos_Complementarios\datos',$this->datos_vista($datos,$acciones,array()));// $datos (datos de la sesion ) $acciones(acciones para la vista) //array() consulta proveniente de la base d datos
		
	}

	public function tipo_equipos()
	{

		$datos=$this->cargar_header_sidebar_acciones();
		
		return view('Registros_Basicos\Datos_Complementarios\tipoequipos',$this->datos_vista_($datos,DB::table('tequipos')->orderBy('id','desc')->get()));
	}

	public function marca_equipos()
	{

		$datos=$this->cargar_header_sidebar_acciones();
		
		return view('Registros_Basicos\Datos_Complementarios\marcaequipos',$this->datos_vista_($datos,DB::table('tequipos')->orderBy('id','desc')->get()));
	}

	public function marca_componentes()
	{

		$datos=$this->cargar_header_sidebar_acciones();
		
		return view('Registros_Basicos\Datos_Complementarios\marcacomponentes',$this->datos_vista_($datos,DB::table('tequipos')->orderBy('id','desc')->get()));
	}

	public function marca_piezas()
	{

		$datos=$this->cargar_header_sidebar_acciones();
		
		return view('Registros_Basicos\Datos_Complementarios\marcapiezas',$this->datos_vista_($datos,DB::table('tequipos')->orderBy('id','desc')->get()));
	}


	public function datos_tipo_equipos()//insertar buscar tipo de equipo 
	{
		$descripcionEq=strtoupper(Request::get('datos'));
		$consEq=DB::table('tequipos')->where('descripcion',$descripcionEq)->first();
		$registros=array();
		$existe=0;
		$asociado=0;
		$tequipoId=0;



		if (empty($consEq)==false)//si existe
		 {
			$existe=1;


			$equipoComp=DB::table('ecomponente_tequipo')->where('tequipo_id',$consEq->id)->first();
			
			if (count($equipoComp)!=0) //si posee componentes asociados
			{
				$asociado=1;
			}
		

		}
		else if (empty($consEq)==true)//si no existe
		{
			$tequipoId=DB::table('tequipos')->insertGetId(['descripcion'=>$descripcionEq]);//obtiene el ide del equipo
			$registros=DB::table('tequipos')->orderBy('id', 'desc')->get();			
		}	
		
		return([$existe,$registros,$asociado,$tequipoId]);
	}





	public function datos_tequipo_componente()//carga los componetes relacionados a un equipo
	{

		$idEquipo=Request::get('datos');//id del tipo de equipo consultado 
		$consulta=0;
		$consComEqp=DB::table('ecomponentes')->join('ecomponente_tequipo','ecomponentes.id','=','ecomponente_tequipo.ecomponente_id')
											 ->select('ecomponentes.id AS id','ecomponentes.descripcion AS descripcion')
											 ->where('ecomponente_tequipo.tequipo_id','=',$idEquipo)->orderBy('ecomponentes.id', 'asc')->get();
		

		
		if (count($consComEqp)!=0) //si no es vacia
		{
			$consulta=1;
		}

		return([$consComEqp,$consulta,$idEquipo]);
		
	}



	public function insertar_componente_()//insertar componentes
	{
		$datos=Request::get('datos');//[0]->descripcion del componente, [1]->id del tequipo
		$equipoId=(int)$datos[1];
		$descripcionCom=strtoupper($datos[0]);
		$registros=array();
		$existe=0;
		$asociado=0;

		
		$consComEqp=DB::table('ecomponentes')->join('ecomponente_tequipo','ecomponentes.id','=','ecomponente_tequipo.ecomponente_id')
											 ->select('ecomponentes.id AS id','ecomponentes.descripcion AS descripcion')
											 ->where('ecomponente_tequipo.tequipo_id','=',$equipoId)->where('ecomponentes.descripcion','=',$descripcionCom)->first();

			
		
		
		if (count($consComEqp)!=0) //si existe
		{
			
			$piezas=DB::table('ecomponente_epieza')->where('ecomponente_id',$consComEqp->id)->first();
			$existe=1;
			if (count($piezas)!=0) 
			{
				$asociado=1;
			}


		}
		else if (count($consComEqp)==0)//si no existe
		{

			$consComEqp=DB::table('ecomponentes')->insertGetId(['descripcion'=>$descripcionCom]);//obtiene el id del componete ingresado
			$registros=DB::table('ecomponente_tequipo')->insert(['ecomponente_tequipo.ecomponente_id'=>$consComEqp,'ecomponente_tequipo.tequipo_id'=>$equipoId]);//se asocia el componente con el equipo crrespondiente
			
		}

		
		return([$registros,$existe,$asociado]);

	}


	public function insertar_piezas()
	{
		$datos=Request::get('datos');
		$componenteId=(integer)$datos[1];//oobtiene el id del componente con el cual debe relacionarce la pieza insertada
		$piezaDescripcion=strtoupper($datos[0]);//obtiene la descripcion de la pieza que se desea agregar
		$existe=0;//no existe y fue agregado
		$asociar=0;//se encuentra asociada a un componente
		$piezas=DB::table('epiezas')->join('ecomponente_epieza','epiezas.id','=','ecomponente_epieza.epieza_id')
									->select('epiezas.id AS id','epiezas.descripcion AS descripcion')
									->where('ecomponente_epieza.ecomponente_id','=',$componenteId)->where('epiezas.descripcion','=',$piezaDescripcion)->orderBy('epiezas.id','desc')->get();

		
		if (count($piezas)!=0)//si existe 
		{
			$existe=1;

		}
		else
		{
			$pieza=DB::table('epiezas')->insertGetId(['descripcion'=>$piezaDescripcion]);//obtiene el id de la pieza que fue insertada
			$asociar=DB::table('ecomponente_epieza')->insert(['ecomponente_epieza.ecomponente_id'=>$componenteId,'ecomponente_epieza.epieza_id'=>$pieza]);//insercion en la tabla intermedia 
			$existe=0;

		}


		
		return([$asociar,$existe]);

	}


public function eliminar_componentes()
	{
		
		$datos=Request::get('datos');
		$idTablaTequipoEcom=(integer)$datos[0];//tabla ecomponentes-tequipo
		$idTablaEcomponentes=(integer)$datos[1];//tabla componentes
		$eliminado=0;

		/////////////////////////////////////////// eliminar relacion con piezas ////////////////////////////////
		$intermediaPiezas=DB::table('ecomponente_epieza')->where('ecomponente_epieza.ecomponente_id','=',$idTablaEcomponentes)->get();//obtiene la relacion de piezas
		$eliminado=DB::table('ecomponente_epieza')->where('ecomponente_epieza.ecomponente_id','=',$idTablaEcomponentes)->delete();//borra la relacion (componente-piezas)
		
			
		foreach ($intermediaPiezas as $comP) //borra cada una de las piezas
			{
				$eliminado=$eliminado+(DB::table('epiezas')->where('epiezas.id','=',$comP->epieza_id)->delete());//borra cada una de las piezas asociadas
			}
		

		////////////////////////////////////////eliminar relacion con tequipos ////////////////////////////////////////////////////////////////
		
			$eliminado=DB::table('ecomponente_tequipo')->where('ecomponente_tequipo.ecomponente_id','=',$idTablaEcomponentes)->delete();//borra la relacion equipo-componentes

			if($eliminado!=0)//eliminar el componente
			{
				$eliminado=DB::table('ecomponentes')->where('ecomponentes.id','=',$idTablaEcomponentes)->delete();
			}
		

		
		return($eliminado);


	}




	public function eliminar_piezas()
	{
		
		$datos=Request::get('datos');
		$tablaIntermedia=(integer)$datos[0];
		$tablaPiezas=(integer)$datos[1];
		$eliminado=0;
		$inter=DB::table('ecomponente_epieza')->where('ecomponente_epieza.epieza_id','=',$tablaIntermedia)->delete();
		$original=DB::table('epiezas')->where('epiezas.id','=',$tablaPiezas)->delete();

		if ($inter!=0 && $original) 
		{
			$existe=1;
		}
		return($existe);
	}


	public function datos_componentes_piezas()//(Piezas pertenecientes a un componete )consultadas por el boton , usadas para la busqueda
	{
		$componenteId=Request::get('datos');//id del componente
		$piezas=DB::table('epiezas')->join('ecomponente_epieza','epiezas.id','=','ecomponente_epieza.epieza_id')
									->select('epiezas.id AS id','epiezas.descripcion AS descripcion','ecomponente_epieza.id AS registro')
									->where('ecomponente_epieza.ecomponente_id','=',$componenteId)
									->orderBy('epiezas.id','desc')->get();
		$existe=0;

		if (count($piezas)!=0) //si existen piezas
		{
			
			$existe=1;
			
		}


		return([$piezas,$existe,$componenteId]);
		
	}


	

	public function datos_consulta_dinamica( )//tipo de equipo, componente y pieza
	{
		

		$datos=Request::get('datos');
		$patron=strtoupper($datos[0]);

		$tabla=(int)$datos[1];//tabla donde se hara la consulta

		$dependencia=(int)$datos[2];//id de la dependencia 
		
		$patron='/'.$patron.'/';//comienza por el patron

		$registros=array();
		

		if ($tabla==0) //tipo de equipos
		{
			$consulta=DB::table('tequipos')->orderBy('id','desc')->get();//tipos de equipos
		}
		else if ($tabla==1)//componentes de un tipo de equipo
		{
			$consulta=DB::table('ecomponentes')->join('ecomponente_tequipo','ecomponentes.id','=','ecomponente_tequipo.ecomponente_id')
											 	->select('ecomponentes.id AS id','ecomponentes.descripcion AS descripcion','ecomponente_tequipo.id AS registro')->where('ecomponente_tequipo.tequipo_id','=',$dependencia)->orderBy('ecomponentes.id', 'asc')->get();
		}
		else if($tabla==2)//piezas de un componente
		{
			$consulta=DB::table('epiezas')->join('ecomponente_epieza','epiezas.id','=','ecomponente_epieza.epieza_id')
									->select('epiezas.id AS id','epiezas.descripcion AS descripcion','ecomponente_epieza.id AS registro')
									->where('ecomponente_epieza.ecomponente_id','=',$dependencia)
									->orderBy('epiezas.id','desc')->get();

		}

		
		foreach ($consulta as $registro) 
		{
			if (preg_match($patron, $registro->descripcion)) 
			{
				
				array_push($registros,$registro);

			}
		}

		return($registros);

	}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	




	


	

/////////////////////////////configuraciones/////////////////////////////////////////////////

		public function cambio_registros()//cambio en los check de estatus para cada registro
		{
			//[valor,registro,tabla]

			$tablas=array("departamentos","cargos","perfiles","planes","clientes","categorias","sucursales","equipos","componentes","piezas","aplicaciones","empleados");//listado de las tablas de la base de datos
			$valores=array(1,0);

			$datos=Request::get('datos');
			
			$tabla=$tablas[(int)$datos[2]];
			$valor=$valores[(int)$datos[0]];
			$registro=(int)$datos[1];

			$respuesta=0;

			$consulta=DB::table($tabla)->where('id',$registro)->first();

			if(empty($consulta)==false)//si consigue valores 
			{
				$consulta=DB::table($tabla)->where('id',$registro)
										   ->update(['status'=>$valor]);	

				$respuesta=count($consulta);
			}
			
			return($respuesta);

		}



		public function perfil_inicial($perfil_id)//configuracion basica para un perfil
		{
			$modulos=DB::table('modulos')->get();
			$submodulos=DB::table('submodulos')->get();
			$acciones=DB::table('acciones')->get();
			$status=1;//valor por defecto (habilitado)

			foreach ($modulos as $modulo) //configuracion de modulos para el el perfil
			{
				
				$asignacion=DB::table('modulo_perfil')->insert
				(
					["perfil_id"=>$perfil_id,"modulo_id"=>$modulo->id,"status"=>$status]

				);

			}



			foreach ($submodulos as $submodulo) //configuracion de modulos para el el perfil
			{
				
				$asignacion=DB::table('perfil_submodulo')->insert
				(
					["perfil_id"=>$perfil_id,"submodulo_id"=>$submodulo->id,"status"=>$status]

				);

			}


			foreach ($acciones as $accion) //configuracion de modulos para el el perfil
			{
				
				$asignacion=DB::table('accion_perfil')->insert
				(
					["perfil_id"=>$perfil_id,"accion_id"=>$accion->id,"status"=>$status]

				);

			}



		

		}
/////////////////////////////////////////////// actualizar acciones //////////////////////////////////////////


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

	
}


    public function actualizar_perfiles($id_accion)
    {
    	$perfiles=DB::table('perfiles')->get();
    	$perfilAccion=0;
    	foreach ($perfiles as $perfil) 
    	{
    		$perfilAccion=$perfilAccion+(DB::table('accion_perfil')->insert(['accion_id'=>$id_accion,'perfil_id'=>$perfil->id,'status'=>0]));//se agrega la nueva accion para los perfiles existentes ya activa
    	}

    	
    }


    public function agregar_accion()
    {
    	
   		//$this->crear_accion($status_ac=1,$descripcion=" ",$url=" ",$data_toogle=" ",$clase_css=" ",$ventana=0,$submodulo_id,$accion_id=true);
	
   		$acciones=[88,89,90,91];
   		foreach ($acciones as $accion) 
   		{
   			$this->actualizar_perfiles($accion);
   		}
   		
    }


//////////////////////////////////////////////pruebas ////////////////////////////////////////////////			

	public function pruebas_()
	{
		

		  /*$actualizar=DB::table('accion_perfil')->where('accion_id',88)->delete();
		  $actualizar=DB::table('accion_perfil')->where('accion_id',89)->delete();
		  $actualizar=DB::table('accion_perfil')->where('accion_id',90)->delete();
		  $actualizar=DB::table('accion_perfil')->where('accion_id',91)->delete();
		 
		  $perfiles=DB::table('perfiles')->get();

		 $acciones=array(88,89,90,91);//acciones a relacionar
		 foreach ($perfiles as $perfil) 
		 {
		 	foreach ($acciones as $accion) 
		 	{
		 		DB::table('accion_perfil')->insert(['perfil_id'=>$perfil->id,'accion_id'=>$accion]);
		 	}
		 }*/



	}
}