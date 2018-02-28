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
use App\Pais;
use App\Region;
use App\Estado;
use App\Municipio;
use App\Respuesta;
use App\Presencial;
use App\Remoto;
use App\Telefonico;
use App\Cliente;
use App\Persona;
use App\Categoria;
use App\Sucursal;
use App\Tipoequipo;
use App\Marca;
use App\Modelo;
use App\Equipo;
use App\Aplicacion;
use App\Ncomponente;
use App\Componente;
use App\Npieza;
use App\Pieza;

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
		
		$form=(object)array
				('nombre'=>strtoupper(Request::get('nomRpb1')),
				 'apellido'=>strtoupper(Request::get('apellRpb1')),
				 'cedula_id'=>Request::get('selciRpb'),
				 'numeroCedula'=>Request::get('txtci'),
				 'cargo'=>Request::get('cgoRpb'),
				 'codigoMovil'=>Request::get('seltlfRpb'),
				 'numeroMovil'=>Request::get('numTelclRpb'),
				 'codigoFijo'=>Request::get('seltlfmRpb'),
				 'numeroFijo'=>Request::get('numTelmvlRpb'),
				 'correo'=>Request::get('mail2'),
				 'cliente_id'=>Request::get('_clienteMatriz_'),
				 'registro'=>Request::get('idRegistroMod_')


				);

				return $form;

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
	
	
//




///////////////////////////////////////////Submodulo movimientos por usuario ////////////////////////////////////
public function	movimientosUsuario()
{	    $datos=$this->cargar_header_sidebar_acciones();
	return view('Registros_Basicos\Bitacoras\movimientos_por_usuario',$this->datos_vista_($datos,DB::table('departamentos')->get()));
}

public function mostrarUsuarios()
{
	$registry=Request::get('registry');
	$departamento=Departamento::find($registry);
	$usuarios=DB::table('usuarios')
				->join('empleado_usuario','empleado_usuario.usuario_id','=','usuarios.id')
				->join('empleados','empleados.id','=','empleado_usuario.empleado_id')
				->join('cargos','cargos.id','=','empleados.cargo_id')
				->join('areas','cargos.area_id','=','areas.id')
				->join('departamentos','areas.departamento_id','=','departamentos.id')
				->where(['departamentos.id'=>$registry,'usuarios.status'=>1])
				->select('usuarios.id AS id','usuarios.n_usuario AS descripcion','empleados.primerNombre AS primerNombre','empleados.primerApellido AS primerApellido')
				->get();
	
	return Response::json($usuarios);
}

public function movUsuariosReg()
{

	$usuario=Request::get('registry');
	$usuario=DB::table('usuarios')
				->join('empleado_usuario','empleado_usuario.usuario_id','=','usuarios.id')
				->join('empleados','empleados.id','=','empleado_usuario.empleado_id')
				->select('empleados.primerNombre AS primerNombre','empleados.primerApellido AS primerApellido','usuarios.n_usuario AS usuario')
				->where('usuarios.id',$usuario)
				->first();

	$bitacora=Bitacora::where('usuario',$usuario->primerNombre.' '.$usuario->primerApellido)->get();


	return view ('Registros_Basicos\Bitacoras\movimientos_usuario',compact('bitacora'));
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
												 	 'empleados.rif_id AS ri')
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
			$this->registroBitacora('Id del registro creado: '.$nuevoPlan->id,'Agregar Plan','{"Registro el plan":'.'"'.$nuevoPlan->nombreP.'"'.'}','Planes -> Agregar Plan');


			/////////////////////Crear servicios para el plan //////////////////////////////////

			$horario=new Horario();
			$horario->plan_id=$nuevoPlan->id;
			$horario->save();

			$presencial=new Presencial();
			$presencial->plan_id=$nuevoPlan->id;
			$presencial->save();

			$remoto=new Remoto();
			$remoto->plan_id=$nuevoPlan->id;
			$remoto->save();

			$telefonico= new Telefonico();
			$telefonico->plan_id=$nuevoPlan->id;
			$telefonico->save();

			$respuesta=new Respuesta();
			$respuesta->plan_id=$nuevoPlan->id;
			$respuesta->save();

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
	$cambios=array();
	$update=false;
	$datos=Request::get('datos');
	$planPadre=Plan::find($datos[1]);
	if($datos[2]=='s1'){
		$horario=Horario::where('plan_id',$datos[1])->first();

		$horario->plan_id=$datos[1];

		$cambio=$this->detectarCambios($datos[0][0],$horario->horaI,'Tiempo de inicio');
        $cambios=$this->agregarCambios($cambio,$cambios);
		$horario->horaI=$datos[0][0];

		$cambio=$this->detectarCambios($datos[0][1],$horario->horaF,'Tiempo final');
        $cambios=$this->agregarCambios($cambio,$cambios);
		$horario->horaF=$datos[0][1];

		$cambio=$this->detectarCambios($datos[0][2],$horario->diaI,'Dia inicial');
        $cambios=$this->agregarCambios($cambio,$cambios);
		$horario->diaI=$datos[0][2];

		$cambio=$this->detectarCambios($datos[0][3],$horario->diaF,'Dia final');
        $cambios=$this->agregarCambios($cambio,$cambios);
		$horario->diaF=$datos[0][3];


		$cambio=$this->detectarCambios($datos[0][4],$horario->precio,'Precio');
        $cambios=$this->agregarCambios($cambio,$cambios);
		$horario->precio=$datos[0][4];

		$update=$horario->save();
		if($update)
		{

			$cambios=$this->documentarCambios($cambios);
       		$this->registroBitacora('Plan:  '.$planPadre->nombreP.' , Servicio: Horarios','Crear/Modificar servicios',$cambios,$planPadre->nombreP.' - '.'Horarios');

       		$respuesta= 1;
		}
	
		

	}
	elseif($datos[2]=='s2'){

		$presencial= Presencial::where('plan_id',$datos[1])->first();
		
		
		$cambio=$this->detectarCambios($datos[0][0],$presencial->etiqueta,'Etiqueta');
        $cambios=$this->agregarCambios($cambio,$cambios);
		$presencial->etiqueta=$datos[0][0];
		
		$cambio=$this->detectarCambios($datos[0][1],$presencial->valor,'Valor');
        $cambios=$this->agregarCambios($cambio,$cambios);
		$presencial->valor=$datos[0][1];
		
		$cambio=$this->detectarCambios($datos[0][2],$presencial->precio,'Precio');
        $cambios=$this->agregarCambios($cambio,$cambios);
		$presencial->precio=$datos[0][2];
		
		

		$update=$presencial->save();
		if($update)
		{

			$cambios=$this->documentarCambios($cambios);
       		$this->registroBitacora('Plan:  '.$planPadre->nombreP.' , Servicio: Soporte Presencial','Crear/Modificar servicios',$cambios,$planPadre->nombreP.' - '.'Soporte Presencial');

       		$respuesta= 1;
		}
	
	}
	elseif($datos[2]=='s3'){


		$remoto= Remoto::where('plan_id',$datos[1])->first();
		
		$cambio=$this->detectarCambios($datos[0][0],$remoto->etiqueta,'Etiqueta');
        $cambios=$this->agregarCambios($cambio,$cambios);
		$remoto->etiqueta=$datos[0][0];
		
		$cambio=$this->detectarCambios($datos[0][1],$remoto->valor,'Valor');
        $cambios=$this->agregarCambios($cambio,$cambios);
		$remoto->valor=$datos[0][1];
		
		$cambio=$this->detectarCambios($datos[0][2],$remoto->precio,'Precio');
        $cambios=$this->agregarCambios($cambio,$cambios);
		$remoto->precio=$datos[0][2];
		
		

		$update=$remoto->save();
		if($update)
		{

			$cambios=$this->documentarCambios($cambios);
       		$this->registroBitacora('Plan:  '.$planPadre->nombreP.' , Servicio: Soporte Remoto','Crear/Modificar servicios',$cambios,$planPadre->nombreP.' - '.'Soporte Remoto');

       		$respuesta= 1;
		}
		
	}
	elseif($datos[2]=='s4'){

		$telefonico= Telefonico::where('plan_id',$datos[1])->first();
		
		$cambio=$this->detectarCambios($datos[0][0],$telefonico->etiqueta,'Etiqueta');
        $cambios=$this->agregarCambios($cambio,$cambios);
		$telefonico->etiqueta=$datos[0][0];
		
		$cambio=$this->detectarCambios($datos[0][1],$telefonico->valor,'Valor');
        $cambios=$this->agregarCambios($cambio,$cambios);
		$telefonico->valor=$datos[0][1];
		
		$cambio=$this->detectarCambios($datos[0][2],$telefonico->precio,'Precio');
        $cambios=$this->agregarCambios($cambio,$cambios);
		$telefonico->precio=$datos[0][2];
		
		

		$update=$telefonico->save();
		if($update)
		{

			$cambios=$this->documentarCambios($cambios);
       		$this->registroBitacora('Plan:  '.$planPadre->nombreP.' , Servicio: Soporte Telefonico','Crear/Modificar servicios',$cambios,$planPadre->nombreP.' - '.'Soporte Telefonico');

       		$respuesta= 1;
		}

		
	}
	elseif($datos[2]=='s5'){


		$respuesta=	Respuesta::where('plan_id',$datos[1])->first();

		$cambio=$this->detectarCambios($datos[0][0],$respuesta->maximo,'Tiempo respuesta maximo');
        $cambios=$this->agregarCambios($cambio,$cambios);
		$respuesta->maximo=$datos[0][0];


		$cambio=$this->detectarCambios($datos[0][1],$respuesta->precio,'Precio');
        $cambios=$this->agregarCambios($cambio,$cambios);
		$respuesta->precio=$datos[0][1];

		$update=$respuesta->save();
		if($update)
		{

			$cambios=$this->documentarCambios($cambios);
       		$this->registroBitacora('Plan:  '.$planPadre->nombreP.' , Servicio: Tiempo de respuesta','Crear/Modificar servicios',$cambios,$planPadre->nombreP.' - '.'Tiempo de respuesta');

       		$respuesta= 1;
		}


		
		
	}
	else{
		$respuesta= 0;
	}
	return $respuesta;
}
///////////////////////////////////////   actualizar los datos del modal  //////////////////////////////

public function planesActualizar()
{
	
	$formulario=(object)['nombreP'=>strtoupper(Request::get('nomPlan')),'descuento'=>Request::get('porDesc'),'status'=>Request::get('statusPlan'),'id'=>Request::get('registroPlan')];

	$indicadores=['update'=>false,'duplicate'=>1];
	$cambios=array();
	//////////////////////////////Verificar si el registro existe en el sistema /////////////////////////////////////////////////////
	$indicadores['duplicate']=Plan::where('nombreP',$formulario->nombreP)->count();
	//////////////////////////////////////Si no hay registros duplicados ////////////////////////////////////////////////////////////
	if($indicadores['duplicate']==0)
	{
       $plan=Plan::find($formulario->id);
       
       $cambio=$this->detectarCambios($formulario->nombreP,$plan->nombreP,'Nombre del plan');
       $cambios=$this->agregarCambios($cambio,$cambios);
       $plan->nombreP=$formulario->nombreP;

       
       $cambio=$this->detectarCambios($formulario->descuento,$plan->descuento,'Porcentaje descuento');
       $cambios=$this->agregarCambios($cambio,$cambios);
       $plan->descuento=$formulario->descuento;


       $traduccionBd=$this->traducirId($plan->status,10);
       $traduccionFor=$this->traducirId($formulario->status,10);
       $cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Status');
       $cambios=$this->agregarCambios($cambio,$cambios);
       $plan->status=$formulario->status;
       $indicadores['update']=$plan->save();

        
       if($indicadores['update']==true)
       {
       	
       	$cambios=$this->documentarCambios($cambios);
       	$this->registroBitacora('Id del registro modificado: '.$plan->id,'Modificar Plan',$cambios,'Planes -> Modificar Plan');
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
	$status_=['HABILITADO','INHABILITADO'];
	$status__=['INHABILITADO','HABILITADO'];
	$registry=Request::get('registry');
	$aux=false;
	///////////// Busqueda del perfil y cambio de status ////////////////////////
	$plan=Plan::find($registry);
	$plan->status=$status[$plan->status];
	$aux=$plan->save();
	/////////////////////////////////////////////////////////////////////////////////////////////////////
    $this->registroBitacora('Plan: '.$plan->nombreP,'Cambiar Status','{"Status":"Cambio de: '.$status_[$plan->status].' a: '.$status__[$plan->status].'"}','Planes');
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
						DB::table('perfiles')->where('descripcion','<>','STANDAR')->where('descripcion','<>','ROOT')->get(),
						$usuario->n_usuario,//extra
						$perfil->id,//datosC1
						$usuario->id//datosC2
					
						));
}

public function empleados_asignar_perfil()
{
	$valores=Request::get('datos');//usuario [0] , perfil [1]
	
	$usuario_id=(int)$valores[0];//id del usuario, viene de la vista
	$perfil_id=(int)$valores[1];//id del perfil, viene de la vista

	$empleado=DB::table('empleado_usuario')
				->join('empleados','empleados.id','=','empleado_usuario.empleado_id')
				->select('empleados.primerNombre AS primerNombre','empleados.primerApellido AS primerApellido')
				->where('usuario_id',$usuario_id)
				->first();//

	$usuario=Usuario::find($usuario_id);//obtiene la informacion actual del usuario 
	$perfilActual=Perfil::find($usuario->perfil_id);//obtiene la informacion del perfil actual del usuario
	$perfilNuevo=Perfil::find($perfil_id);//informacion del nuevo perfil 

	$actualizacion=DB::table('usuarios')->where('id',$usuario_id)->update(['perfil_id'=>$perfil_id]);
	$this->registroBitacora('Usuario: '.$usuario->n_usuario.' - '.$empleado->primerNombre.' '.$empleado->primerApellido,'Asignar Perfil','{'.'"Perfil":'.'"'.$perfilActual->descripcion.' , Fue cambiado a: '.$perfilNuevo->descripcion.'"}','Empleados -> Permisos');
	
	return $actualizacion;
	
}

public function selectDireccionEmp()
{
	$registry=Request::get('registry');
	$caso=Request::get('caso');
	$retorno=null;

	if($caso==0)
	{
		$retorno=Region::where('pais_id',$registry)->get();
	}
	else if($caso==1)
	{
		$retorno=Estado::where('region_id',$registry)->get();
	}
	else if($caso==2)
	{
		$retorno=Municipio::where('estado_id',$registry)->get();
	}


    return Response::json($retorno);
}


public function obtenerFormularioActualizar()
{
  
	$formulario=array(

						'primerNombre'=>strtoupper(Request::get('nomEmp1m')),
						'segundoNombre'=>strtoupper(Request::get('nomEmp2m')),
						'primerApellido'=>strtoupper(Request::get('apellEmp1m')),
						'segundoApellido'=>strtoupper(Request::get('apellEmp2m')),
						'tipoRif'=>Request::get('TrifEmpm'),
						'numeroRif'=>Request::get('rifEmpm'),
						'tipoCedula'=>Request::get('TciEmpm'),
						'numeroCedula'=>Request::get('ciEmpm'),
						'fechaNacimiento'=>Request::get('fnEmpmm'),
						'director'=>Request::get('direccionEmprm'),
						'departamento'=>Request::get('departamentoEmpm'),
						'area'=>Request::get('areaEmp_m'),
						'cargo'=>Request::get('cgoEmpm'),
						'pais'=>Request::get('pdhem'),
						'region'=>Request::get('rgdhem'),
						'estado'=>Request::get('edodhem'),
						'municipio'=>Request::get('mundhem'),
						'codigoPostal'=>Request::get('codigoPostalm'),
						'descripcionDireccion'=>Request::get('descpdhem'),
						'telefonoLocal1Codigo'=>Request::get('numerol_1cm'),
						'telefonoLocal1Numero'=>Request::get('numerol_1tm'),
						'telefonoLocal2Codigo'=>Request::get('numerol_2cm'),
						'telefonoLocal2Numero'=>Request::get('numerol_2tm'),
						'telefonoMovilCodigo'=>Request::get('numerom_cm'),
						'telefonoMovil'=>Request::get('numerom_tm'),
						'correo'=>Request::get('correo_m'),
						'nombreUsuario'=>Request::get('nomUs_m'),
						'password'=>Request::get('psw_m'),
						'status'=>Request::get('statusEm_m'),
						'empleado_id'=>Request::get('empleadoId')



						);

	return (object) $formulario;
}

public function traducirId($traducir,$campo,$registro_id=null)
{

	$status=['INHABILITADO','HABILITADO'];

	if($campo==0||$campo==1||$campo==7)//se refiere a tipo de : rif, cedula y codigo de telefono movil
	{
		$retorno=DB::table('tipos')->where('id',$traducir)->select('descripcion AS descripcion')->first();
		$retorno=$retorno->descripcion;
		
	}
	else if($campo==2)//se refiere al id del pais
	{
		$retorno=DB::table('paises')->where('id',$traducir)->select('descripcion AS descripcion')->first();
		$retorno=$retorno->descripcion;
	}
	else if($campo==3)
	{
		$retorno=DB::table('regiones')->where('id',$traducir)->select('descripcion AS descripcion')->first();
		$retorno=$retorno->descripcion;
	}
	else if($campo==4)
	{
		$retorno=DB::table('estados')->where('id',$traducir)->select('descripcion AS descripcion')->first();
		$retorno=$retorno->descripcion;
	}
	else if($campo==5)
	{
		$retorno=DB::table('municipios')->where('id',$traducir)->select('descripcion AS descripcion')->first();
		$retorno=$retorno->descripcion;
	}
	else if($campo==6)
	{
		$retorno=DB::table('cargos')->where('id',$traducir)->select('descripcion AS descripcion')->first();
		$retorno=$retorno->descripcion;
	}
	else if($campo==8)
	{
		$retorno=DB::table('empleados')->where('id',$registro_id)->select('status AS status')->first();
		$retorno=$status[$retorno->status];

	}
	else if($campo==9)
	{
		$retorno=DB::table('usuarios')->where('id',$registro_id)->select('status AS status')->first();
		$retorno=$status[$retorno->status];
	}
	else if($campo==10)
	{
		
		$retorno=$status[$traducir];
	}
	else if($campo==11)
	{
		$retorno=DB::table('tipos')->where('id',$traducir)->select('descripcion AS descripcion')->first();
		$retorno=$retorno->descripcion;
	}
	else if($campo==12)
	{
		$retorno=DB::table('tipoequipos')->where('id',$traducir)->select('descripcion AS descripcion')->first();
		$retorno=$retorno->descripcion;
	}
	else if($campo==13)
	{
		$retorno=DB::table('marcas')->where('id',$traducir)->select('descripcion AS descripcion')->first();
		$retorno=$retorno->descripcion;
	}
	else if($campo==14)
	{
		$retorno=DB::table('modelos')->where('id',$traducir)->select('descripcion AS descripcion')->first();
		$retorno=$retorno->descripcion;
	}
	else if($campo==15)
	{
		$retorno=DB::table('ncomponentes')->where('id',$traducir)->select('descripcion AS descripcion')->first();
		$retorno=$retorno->descripcion;
	}
	else if($campo==16)
	{
		$retorno=DB::table('npiezas')->where('id',$traducir)->select('descripcion AS descripcion')->first();
		$retorno=$retorno->descripcion;
	}


	

	return $retorno;
}

public function detectarCambios($valorForm,$valorBd,$campo)
{
	$retorno=null;
	if(strcmp((string)$valorForm,(string)$valorBd)!=0)
	{
		$retorno=(object)array('campo'=>$campo,'cambio'=>$valorBd.' ,Fue cambiado a:  '.$valorForm);
	}
	return $retorno;
}

public function documentarCambios($cambios)
{
	$registro='{';
    $longitud=count($cambios);
    for ($i=0; $i <$longitud ; $i++) 
    { 
    	$registro=$registro.'"'.$cambios[$i]->campo.'"'.':'.'"'.$cambios[$i]->cambio.'"';
    	if($i!==$longitud-1)
    	{
    		$registro=$registro.',';
    	}
    }
    $registro=$registro.'}';

    return $registro;
  }



 public function agregarCambios($cambio,$cambios)
 {
 	$cambios=$cambios;

 	if($cambio!=null)
    		{
    			array_push($cambios,$cambio);
    		}
   	return $cambios;
 }




public function empleadosActualizar()
{

   $cambios=array();
   $formulario=$this->obtenerFormularioActualizar();
   $empleado=Empleado::where('id',$formulario->empleado_id)->first();
   // ///////////////verificar si el usuario esta duplicado, para el resto de empleados //////////////
   $empleadoUsu=DB::table('empleado_usuario')
   					->join('usuarios','usuarios.id','=','empleado_usuario.usuario_id')
   					->where('empleado_usuario.empleado_id',$formulario->empleado_id)
   					->select('usuarios.n_usuario AS usuario','usuarios.id AS usuario_id')
   					->first();////captura el username y el id de ese registro en la base de datos que est asociado al empleado a modificar

   	$mensaje=(object)array('usuario'=>0,'cedula'=>0,'rif'=>0,'mensaje'=>'');


   // 	///Buscar usuario duplicado 

   $usuarioDuplicado=DB::table('usuarios')->where('id','<>',$empleadoUsu->usuario_id)->where('n_usuario','=',$formulario->nombreUsuario)->first();

   //  ////Verificar si existe la cedula insertada en el formulario 
   	$verificarCedula=DB::table('cedulas')->where(['numero'=>$formulario->numeroCedula,'rol'=>'EMPLEADO','tipo_id'=>$formulario->tipoCedula])->where('id','<>',$empleado->cedula_id)->first();

   //  ///Verificar si existe el rif  insertado en el formulario 
    $verificarRif=DB::table('rifs')->where(['numero'=>$formulario->numeroRif,'rol'=>'EMPLEADO','tipo_id'=>$formulario->tipoRif])->where('id','<>',$empleado->rif_id)->first();

   //  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    if(count($usuarioDuplicado)>0){$mensaje->usuario=1;$mensaje->mensaje=$mensaje->mensaje.'<br>El usuario: '.$formulario->nombreUsuario.', existe en el sistema!!!';}
    if(count($verificarCedula)>0)
    	{
    		$empleadoDup=Empleado::where('cedula_id',$verificarCedula->id)->select('primerNombre AS nombre','primerApellido AS apellido')->first();
    		$mensaje->cedula=1;
    		$mensaje->mensaje=$mensaje->mensaje.'<br>La cedula: '.$formulario->numeroCedula.' , se encuentra asignada a: '.$empleadoDup->nombre.' '.$empleadoDup->apellido;
    	}
    if(count($verificarRif)>0)
    {
    	    $empleadoDup=Empleado::where('rif_id',$verificarRif->id)->select('primerNombre AS nombre','primerApellido AS apellido')->first();
    	    $mensaje->rif=1;
    	    $mensaje->mensaje=$mensaje->mensaje.'<br>El rif: '.$formulario->numeroRif.' , se encuentra asignado a: '.$empleadoDup->nombre.' '.$empleadoDup->apellido;
    }



    if($mensaje->mensaje=='')//si no existe ningun mensaje 
    {
    		////////Informacion usuario /////////////////////////////
    		$usuario=Usuario::find($empleadoUsu->usuario_id);
    		
    		$cambio=$this->detectarCambios($formulario->nombreUsuario,$usuario->n_usuario,'Usuario');
    		$cambios=$this->agregarCambios($cambio,$cambios);
    		$usuario->n_usuario=$formulario->nombreUsuario;
    		

    		$cambio=$this->detectarCambios($formulario->password,$usuario->clave,'Contraseña');
    		$cambios=$this->agregarCambios($cambio,$cambios);
    		$usuario->clave=$formulario->password;


    		
    		$usuario->status=$formulario->status;
    		$usuario->save();

    		///////Informacion Correo ////////////////////////////////
    		$correo=Correo::find($empleado->correo_id);

    		$cambio=$this->detectarCambios($formulario->correo,$correo->correo,'Correo');
    		$cambios=$this->agregarCambios($cambio,$cambios);
    		$correo->correo=$formulario->correo;
    		$correo->save();

    		///////Informacion Cedula //////////////////////////////////
    		$cedula=Cedula::find($empleado->cedula_id);

    		$cambio=$this->detectarCambios($formulario->numeroCedula,$cedula->numero,'Numero Cedula');
    		$cambios=$this->agregarCambios($cambio,$cambios);
    		$cedula->numero=$formulario->numeroCedula;


    		$traduccionBd=$this->traducirId($cedula->tipo_id,1);
    		$traduccionFor=$this->traducirId($formulario->tipoCedula,1);
    		$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Tipo Cedula');
    		$cambios=$this->agregarCambios($cambio,$cambios);
    		$cedula->tipo_id=$formulario->tipoCedula;
    		$cedula->save();


    		///////Informacion Rif ////////////////////////////////////////////////////////////////////
    		$rif=Rif::find($empleado->rif_id);

    		$cambio=$this->detectarCambios($formulario->numeroRif,$rif->numero,'Numero Rif');
    		$cambios=$this->agregarCambios($cambio,$cambios);
    		$rif->numero=$formulario->numeroRif;

    		$traduccionBd=$this->traducirId($rif->tipo_id,0);
    		$traduccionFor=$this->traducirId($formulario->tipoRif,0);
    		$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Tipo Rif');
    		$cambios=$this->agregarCambios($cambio,$cambios);
    		$rif->tipo_id=$formulario->tipoRif;
    		$rif->save();

    		//////Informacion Direccion ///////////////////////////////////////////////////////////////
    		$direccion=Direccion::find($empleado->direccion_id);
    		
    		$cambio=$this->detectarCambios($formulario->descripcionDireccion,$direccion->descripcion,'Direccion');
    		$cambios=$this->agregarCambios($cambio,$cambios);
    		$direccion->descripcion=$formulario->descripcionDireccion;
    		
    		$cambio=$this->detectarCambios($formulario->codigoPostal,$direccion->codigoPostal,'Codigo Postal');
    		$cambios=$this->agregarCambios($cambio,$cambios);
    		$direccion->codigoPostal=$formulario->codigoPostal;
    		

    		$traduccionBd=$this->traducirId($direccion->municipio_id,5);
    		$traduccionFor=$this->traducirId($formulario->municipio,5);
    		$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Municipio');
    		$cambios=$this->agregarCambios($cambio,$cambios);
    		$direccion->municipio_id=$formulario->municipio;
    		
    		$traduccionBd=$this->traducirId($direccion->estado_id,4);
    		$traduccionFor=$this->traducirId($formulario->estado,4);
    		$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Estado');
    		$cambios=$this->agregarCambios($cambio,$cambios);
    		$direccion->estado_id=$formulario->estado;
    		
    		$traduccionBd=$this->traducirId($direccion->region_id,3);
    		$traduccionFor=$this->traducirId($formulario->region,3);
    		$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Region');
    		$cambios=$this->agregarCambios($cambio,$cambios);
    		$direccion->region_id=$formulario->region;
    		
    		$traduccionBd=$this->traducirId($direccion->pais_id,2);
    		$traduccionFor=$this->traducirId($formulario->pais,2);
    		$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Pais');
    		$cambios=$this->agregarCambios($cambio,$cambios);
    		$direccion->pais_id=$formulario->pais;
    		

    		$direccion->save();

    		
 			//////Informacion Telefono /////////////////////////////////////////////////////////////////
    		$empleadoTelefono=DB::table('empleado_telefono')->where('empleado_id',$empleado->id)->get();
    		foreach ($empleadoTelefono as $empTe) 
    		{
    			$telefono=Telefono::find($empTe->telefono_id);
    			if($telefono->tipo==0) 
    			{
    				$cambio=$this->detectarCambios($formulario->telefonoLocal1Codigo,$telefono->codigo,'Codigo Local 1');
    				$cambios=$this->agregarCambios($cambio,$cambios);
    				$telefono->codigo=$formulario->telefonoLocal1Codigo;

    				$cambio=$this->detectarCambios($formulario->telefonoLocal1Numero,$telefono->telefono,'Numero Local 1');
    				$cambios=$this->agregarCambios($cambio,$cambios);
    				$telefono->telefono=$formulario->telefonoLocal1Numero;
    				$telefono->save();
    			}
    			else if($telefono->tipo==1)
    			{
    				
    				$cambio=$this->detectarCambios($formulario->telefonoLocal2Codigo,$telefono->codigo,'Codigo Local 2');
    				$cambios=$this->agregarCambios($cambio,$cambios);
    				$telefono->codigo=$formulario->telefonoLocal2Codigo;

    				$cambio=$this->detectarCambios($formulario->telefonoLocal2Numero,$telefono->telefono,'Numero Local 2');
    				$cambios=$this->agregarCambios($cambio,$cambios);
    				$telefono->telefono=$formulario->telefonoLocal2Numero;
    				$telefono->save();
    			}
    			else if($telefono->tipo==2)
    			{
    				$tipo=DB::table('tipos')->where('id',$formulario->telefonoMovilCodigo)->first();
    				$tipoActual=DB::table('tipos')->where('descripcion',$telefono->codigo)->first();

    				$traduccionBd=$this->traducirId($tipoActual->id,7);
    				$traduccionFor=$this->traducirId($formulario->telefonoMovilCodigo,7);
    				$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Codigo Movil');
    				$cambios=$this->agregarCambios($cambio,$cambios);
    				$telefono->codigo=$tipo->descripcion;
    				
    				$cambio=$this->detectarCambios($formulario->telefonoMovil,$telefono->telefono,'Telefono Movil');
    				$cambios=$this->agregarCambios($cambio,$cambios);
    				$telefono->telefono=$formulario->telefonoMovil;
    				$telefono->save();
    			}
    		}

    		
    		////////Informacion del empleado ////////////////////////////////////////////////////////////////
    		$empleado=Empleado::find($formulario->empleado_id);

    		$cambio=$this->detectarCambios($formulario->primerNombre,$empleado->primerNombre,'Primer Nombre');
    		$cambios=$this->agregarCambios($cambio,$cambios);
    		$empleado->primerNombre=$formulario->primerNombre;

    		$cambio=$this->detectarCambios($formulario->segundoNombre,$empleado->segundoNombre,'Segundo Nombre');
    		$cambios=$this->agregarCambios($cambio,$cambios);
    		$empleado->segundoNombre=$formulario->segundoNombre;

    		$cambio=$this->detectarCambios($formulario->primerApellido,$empleado->primerApellido,'Primer Apellido');
    		$cambios=$this->agregarCambios($cambio,$cambios);
    		$empleado->primerApellido=$formulario->primerApellido;

    		$cambio=$this->detectarCambios($formulario->segundoApellido,$empleado->segundoApellido,'Segundo Apellido');
    		$cambios=$this->agregarCambios($cambio,$cambios);
    		$empleado->segundoApellido=$formulario->segundoApellido;

    		$cambio=$this->detectarCambios($formulario->fechaNacimiento,$empleado->fechaNacimiento,'Fecha Nacimiento');
    		$cambios=$this->agregarCambios($cambio,$cambios);
    		$empleado->fechaNacimiento=$formulario->fechaNacimiento;

    		// $cambio=$this->detectarCambios($formulario->telefonoLocal2Codigo,$telefono->codigo,'Codigo Local 2');
    		// $cambios=$this->agregarCambios($cambio,$cambios);
    		$empleado->status=$formulario->status;
    		$empleado->save();
    		$longitud=count($cambios);
    		$cambios=$this->documentarCambios($cambios);
    		
    	if($longitud>0)
    	 {

    		$this->registroBitacora('Id del registro modificado: '.$empleado->id,'Modificar Empleado',$cambios,'Empleados');
    	 }
   

    }


 

 return Response::json($mensaje);
}



public function empleadosModificar()
{
	$empleado=Empleado::find(Request::get('registry'));
	$cedula=DB::table('cedulas')->where('id',$empleado->cedula_id)->first();
	$rif=DB::table('rifs')->where('id',$empleado->rif_id)->first();

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$estructura=DB::table('cargos')
	              ->join('areas','cargos.area_id','=','areas.id')
	              ->join('departamentos','areas.departamento_id','departamentos.id')
	              ->join('directores','directores.id','=','departamentos.director_id')
	              ->select('cargos.id AS cargo_id','cargos.descripcion AS cargo','areas.id AS area_id','areas.descripcion AS area','departamentos.id AS departamento_id','departamentos.descripcion','directores.id AS director_id','directores.descripcion AS director')
	              ->where('cargos.id',$empleado->cargo_id)
	              ->first();

	 $selectStructura=array();
	 
	 $selectStructura['departamentos']=DB::table('departamentos')->where('director_id',$estructura->director_id)->get();
	 $selectStructura['areas']=DB::table('areas')->where('departamento_id',$estructura->departamento_id)->get();
	 $selectStructura['cargos']=DB::table('cargos')->where('area_id',$estructura->area_id)->get();
	 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	 $direccion=DB::table('direcciones')->join('paises','direcciones.pais_id','=','paises.id')
	 								    ->join('regiones','direcciones.region_id','=','regiones.id')
	 								    ->join('estados','direcciones.estado_id','=','estados.id')
	 								    ->join('municipios','direcciones.municipio_id','=','municipios.id')
	 								    ->select('paises.id AS pais_id','paises.descripcion AS pais','regiones.id AS region_id','regiones.descripcion AS region',
	 								             'estados.id AS estado_id','estados.descripcion AS estado','municipios.id AS municipio_id','municipios.descripcion AS municipio','direcciones.descripcion AS direccion','direcciones.codigoPostal AS codigoPostal')
	 								    ->where('direcciones.id',$empleado->direccion_id)
	 								    ->first();

	$selectDireccion=array();
	$selectDireccion['regiones']=DB::table('regiones')->where('pais_id',$direccion->pais_id)->get();
	$selectDireccion['estados']=DB::table('estados')->where('region_id',$direccion->region_id)->get();
	$selectDireccion['municipios']=DB::table('municipios')->where('estado_id',$direccion->estado_id)->get();


 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$correo=DB::table('correos')->where('id',$empleado->correo_id)->first();
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$telefonos=DB::table('empleado_telefono')
			->join('telefonos','empleado_telefono.telefono_id','=','telefonos.id')
			->where('empleado_telefono.empleado_id',$empleado->id)
			->select('telefonos.codigo AS codigo','telefonos.telefono AS numero','telefonos.tipo AS tipo')
			->get();

$codigoMovil=DB::table('tipos')->where('descripcion',$telefonos[2]->codigo)->select('id AS codigo')->first();

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$usuario=DB::table('empleado_usuario')
			->join('usuarios','empleado_usuario.usuario_id','=','usuarios.id')
			->select('usuarios.n_usuario AS usuario','usuarios.clave AS clave ','usuarios.status AS status')
			->where('empleado_usuario.empleado_id',$empleado->id)
			->first();

if(count($usuario)==0)
{$usuario=null;}


	return Response::json([$empleado,$rif,$cedula,$estructura,$selectStructura,$direccion,$selectDireccion,$correo,$telefonos,$codigoMovil,$usuario]);
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
	$status_=['HABILITADO','INHABILITADO'];
	$status__=['INHABILITADO','HABILITADO'];
	$registry=Request::get('registry');
	$aux=false;
	/////////////////Busqueda del empleado y cambio de status ////////////////////////////////////////////
	$empleado=Empleado::find($registry);
	$empleado->status=$status[$empleado->status];
	$aux=$empleado->save();
	/////////////////////////////////////////////////////////////////////////////////////////////////////
	$cedula=DB::table('cedulas')->join('tipos','tipos.id','=','cedulas.tipo_id')
				->select('cedulas.numero AS numero','tipos.descripcion AS tipoCedula')
				->where('cedulas.id',$empleado->cedula_id)
				->first();

    $this->registroBitacora($empleado->primerNombre.' '.$empleado->primerApellido.' - '.$cedula->tipoCedula.' '.$cedula->numero,'Cambiar Status','{"Status":"'.$status_[$empleado->status].' -> '.$status__[$empleado->status].'"}','Empleados');
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
		$telefonoLocal1->tipo=0;
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
		$usuario->perfil_id=27;
		$usuario->save();
		$usuario->empleados()->attach($empleado->id);


		$traduccionTipoCedula=$this->traducirId($cedula->tipo_id,1);
		$this->registroBitacora('Id del registro creado: '.$empleado->id,'Agregar Empleado','{'.'"Registro al empleado":'.'"'.$empleado->primerNombre.' '.$empleado->primerApellido.' , C.i: '.$traduccionTipoCedula.' '.$cedula->numero.'"}','Agregar Empleado');
		


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
	return view('Registros_Basicos\Perfiles\perfiles',$this->datos_vista($datos,$acciones,DB::table('perfiles')->where('descripcion','<>','ROOT')->where('descripcion','<>','STANDAR')->paginate(11),2));
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
			$this->registroBitacora('Id del registro creado: '.$nuevoPerfil->id,'Agregar Perfil','{"Registro el perfil":'.'"'.$nuevoPerfil->descripcion.'"'.'}','Perfil -> Agregar Perfil');
		}

		$this->configurarPerfil($nuevoPerfil->id);//configuracion de todo los modulos aceptados para el perfil normalmente tarda 
		
	}

	

	
	return Response()->json(['duplicate'=>$duplicate,'insert'=>$insert]);

}

public function registroBitacora($registry,$accion,$detalles,$ventana)
{

	$datos=Session::get('sesion');
	$usuario=$datos[0]['nombre'].' '.$datos[0]['apellido'];
	$username=$datos[0]['usuario'];
	

	$bitacora=new Bitacora;
	$bitacora->usuario=$usuario;
	$bitacora->username=$username;
	$bitacora->accion=$accion;
	$bitacora->registro=$registry;
	$bitacora->detalles=$detalles;
	$bitacora->ventana=$ventana;

     return $bitacora->save();

}

public function perfilesModificarStatus()
{

	$status=[1,0];
	$status_=['HABILITADO','INHABILITADO'];
	$status__=['INHABILITADO','HABILITADO'];
	$registry=Request::get('registry');
	$aux=false;
	///////////// Busqueda del perfil y cambio de status ////////////////////////
	$perfil=Perfil::find($registry);
	$perfil->status=$status[$perfil->status];
	$aux=$perfil->save();
	/////////////////////////////////////////////////////////////////////////////////////////////////////
    $this->registroBitacora('Perfil: '.$perfil->descripcion,'Cambiar Status','{"Status":" Cambio de: '.$status_[$perfil->status].' a: '.$status__[$perfil->status].'"}','Perfil');
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

	$formulario=(object)['descripcion'=>strtoupper(Request::get('Descripcion')),'status'=>Request::get('Status'),'id'=>Request::get('Registro')];
	$indicadores=['update'=>false,'duplicate'=>1];
	$cambios=array();
	

	//////////////////////////////Verificar si el registro existe en el sistema /////////////////////////////////////////////////////
	$indicadores['duplicate']=Perfil::where('descripcion',$formulario->descripcion)->count();
	//////////////////////////////////////Si no hay registros duplicados ////////////////////////////////////////////////////////////
	if($indicadores['duplicate']==0)
	{
      
       $perfil=Perfil::find($formulario->id);
       
       $cambio=$this->detectarCambios($formulario->descripcion,$perfil->descripcion,'Nombre del perfil');
       $cambios=$this->agregarCambios($cambio,$cambios);
       $perfil->descripcion=$formulario->descripcion;

       $traduccionBd=$this->traducirId($perfil->status,10);
       $traduccionFor=$this->traducirId($formulario->status,10);
       $cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Status');
       $cambios=$this->agregarCambios($cambio,$cambios);
       $perfil->status=$formulario->status;
       $indicadores['update']=$perfil->save();


       if($indicadores['update']==true)
       {
        $cambios=$this->documentarCambios($cambios);
       	$this->registroBitacora('Id del registro modificado: '.$perfil->id,'Modificar Perfil',$cambios,'Perfil -> Modificar Perfil');
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

public function clientesMostrar()//inicializacion del submodulo: clientes
	{
		$paginas=10;
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(9,10,11,12),8);

		$consulta=DB::table('clientes')->paginate($paginas);
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
	
	
	public function formularioClientes()
	{
		$formulario=(object)array
								('razonSocial'=>strtoupper(Request::get('rsnew')),
								 'nombreComercial'=>strtoupper(Request::get('ncnew')),
								 'rif_id'=>(int) Request::get('tiporif'),
								 'numeroRif'=> Request::get('numerorif'),
								 'tipoContribuyente_id'=>(int)Request::get('tipConnew'),
								 'direccionFiscal'=>strtoupper(Request::get('descDirdf')),
								 'paisF'=>(int)Request::get('paisdf'),
								 'regionF'=>(int)Request::get('regiondf'),
								 'estadoF'=>(int)Request::get('edodf'),
								 'municipioF'=>(int)Request::get('mundf'),
								 'direccionComercial'=>strtoupper(Request::get('descDirdc')),
								 'paisC'=>(int)Request::get('paisdc'),
								 'regionC'=>(int)Request::get('regiondc'),
								 'estadoC'=>(int)Request::get('edodc'),
								 'municipioC'=>(int)Request::get('mundc'),
								 'codigoL'=>Request::get('tlflsv'),
								 'codigoM'=>Request::get('tlfmvlsv'),
								 'telefonoM'=>Request::get('tmvlsv'),
								 'telefonoL'=>Request::get('tclsv'),
								 'correo'=>Request::get('mailsv')
								 );

								return $formulario;
	}


	public function verificarRifCliente($rif)//contiene el numero y el tipo
	{

		$rif=(object)$rif;
		$retorno=(object)array('codigo'=>0,'extra'=>0);

		$verificarRif=Rif::where(['numero'=>$rif->numero,'tipo_id'=>$rif->tipo_id,'rol'=>'CLIENTE'])->first();
		if($verificarRif!=null)//si existe
		{
			$retorno->codigo=2;//duplicado
			$cliente=Cliente::where('rif_id',$verificarRif->id)->first();
			$retorno->extra=$cliente->nombreComercial;
		}

		return $retorno;
	}

	public function clientes_insertar()//inserta en la base de datos un nuevo cliente matriz
	{
		
		
		$cliente=$this->formularioClientes();
		$duplicado=$this->verificarRifCliente(array('numero'=>$cliente->numeroRif,'tipo_id'=>$cliente->rif_id));
		if($duplicado->codigo==0)//si no se encuentra registrado el rif de un cliente
		{
			/////////////////////////////Obtener direccion fiscal del cliente //////////////////////////////////
			$direccionFiscal=new Direccion();
			$direccionFiscal->descripcion=$cliente->direccionFiscal;
			$direccionFiscal->pais_id=$cliente->paisF;
			$direccionFiscal->region_id=$cliente->regionF;
			$direccionFiscal->estado_id=$cliente->estadoF;
			$direccionFiscal->municipio_id=$cliente->municipioF;
			$direccionFiscal->save();


			//////////////////////////Obtener direccion comercial del cliente //////////////////////////////////
			$direccionComercial=new Direccion();
			$direccionComercial->descripcion=$cliente->direccionComercial;
			$direccionComercial->pais_id=$cliente->paisC;
			$direccionComercial->region_id=$cliente->regionC;
			$direccionComercial->estado_id=$cliente->estadoC;
			$direccionComercial->municipio_id=$cliente->municipioC;
			$direccionComercial->save();

			/////////////////////////Obtener Rif del cliente ///////////////////////////////////////////////////
			$rif=new Rif();
			$rif->numero=$cliente->numeroRif;
			$rif->tipo_id=$cliente->rif_id;
			$rif->rol='CLIENTE';
			$rif->save();

			////////////////////////Obtener correo del Cliente ////////////////////////////////////////////////
			$correo=new Correo();
			$correo->correo=$cliente->correo;
			$correo->save();
			//////////////////////Obtener telefono Local del cliente ////////////////////////////////////////////

			$codigoL=Tipo::where('id',$cliente->codigoL)->first();
			$telefonoL=new Telefono();
			$telefonoL->codigo=$codigoL->descripcion;
			$telefonoL->telefono=$cliente->telefonoL;
			$telefonoL->tipo=0;
			$telefonoL->save();

			/////////////////////Obtener el telefono movil del Cliente //////////////////////////////////////////
			$codigoM=Tipo::where('id',$cliente->codigoM)->first();
			$telefonoM=new Telefono();
			$telefonoM->codigo=$codigoM->descripcion;
			$telefonoM->telefono=$cliente->telefonoM;
			$telefonoM->tipo=2;
			$telefonoM->save();


			///////////////////////Crear registro para el cliente ////////////////////////////////////////////////
			$clienteN=new Cliente();
			$clienteN->razonSocial=$cliente->razonSocial;
			$clienteN->nombreComercial=$cliente->nombreComercial;
			$clienteN->rif_id=$rif->id;
			$clienteN->direccionFiscal_id=$direccionFiscal->id;
			$clienteN->direccionComercial_id=$direccionComercial->id;
			$clienteN->correo_id=$correo->id;
			$clienteN->tipoContribuyente_id=$cliente->tipoContribuyente_id;
			$update=$clienteN->save();

			///////////////////asociar telefonos al cliente //////////////////////////////////////////////////////
			DB::table('cliente_telefono')->insert(['telefono_id'=>$telefonoL->id,'cliente_id'=>$clienteN->id]);
			DB::table('cliente_telefono')->insert(['telefono_id'=>$telefonoM->id,'cliente_id'=>$clienteN->id]);
			///////////////////////////////////////////////////////////////////////////////////////////////////////////

			$tipoRif=Tipo::where('id',$rif->tipo_id)->first();//descripcion del tipo de rif ingresado para el cliente 


			if($update)
			{
				$duplicado->codigo=1;
				$this->registroBitacora('Id del registro creado: '.$clienteN->id,'Agregar Cliente Matriz','{"Registro el Cliente":'.'"'.$clienteN->nombreComercial.' - '.$tipoRif->descripcion.' '.$rif->numero.'"'.'}','Clientes -> Agregar cliente Matriz');
			}
		}



		
	
		
		
		
		
		
		
		
		
	 return Response::json($duplicado);
	}
		
public function consultarTelefono($cliente_id,$tipo)//0 local, 1 local, 2 movil
{
		$telefono=DB::table('telefonos')
							->join('cliente_telefono','telefonos.id','=','cliente_telefono.telefono_id')
							->join('tipos','telefonos.codigo','=','tipos.descripcion')
							->where(['cliente_telefono.cliente_id'=>$cliente_id,'telefonos.tipo'=>$tipo])
							->select('telefonos.id AS id','telefonos.codigo AS codigo','telefonos.telefono AS numero','tipos.id AS tipo_id')
							->first();
		return $telefono;
}
	
public function clientes_modificar()//metodo que consulta los datos de un cliente matriz para mostrarlos en el nodal modificar cliente
	{
		
		$cliente_id=Request::get('registry');

		$cliente=Cliente::find($cliente_id);
		$rif=Rif::find($cliente->rif_id);
		$direccionFiscal=Direccion::find($cliente->direccionFiscal_id);
		$direccionComercial=Direccion::find($cliente->direccionComercial_id);
		$correo=Correo::find($cliente->correo_id);
		$telefonoLocal=$this->consultarTelefono($cliente->id,0);
		$telefonoMovil=$this->consultarTelefono($cliente->id,2);

		/////////////////////////Opciones dependientes Direccion Fiscal/////////////
		$regionesF=$this->opcionesDependientes(0,$direccionFiscal->pais_id);
		$estadosF=$this->opcionesDependientes(1,$direccionFiscal->region_id);
		$municipiosF=$this->opcionesDependientes(2,$direccionFiscal->estado_id);
		$dependenciasF=['regiones'=>$regionesF,'estados'=>$estadosF,'municipios'=>$municipiosF];

		/////////////////////////Opciones dependientes Direccion Comercial/////////////
		$regionesC=$this->opcionesDependientes(0,$direccionComercial->pais_id);
		$estadosC=$this->opcionesDependientes(1,$direccionComercial->region_id);
		$municipiosC=$this->opcionesDependientes(2,$direccionComercial->estado_id);
		$dependenciasC=['regiones'=>$regionesC,'estados'=>$estadosC,'municipios'=>$municipiosC];
	




		return Response::json(['cliente'=>$cliente,'rif'=>$rif,'direccionFiscal'=>$direccionFiscal,'direccionComercial'=>$direccionComercial,'correo'=>$correo,'telefonoLocal'=>$telefonoLocal,'telefonoMovil'=>$telefonoMovil,'dependenciasF'=>$dependenciasF,'dependenciasC'=>$dependenciasC]);
		
	}


	public function formularioActualizarCliente()
	{
		$formulario=(object)array
								('razonSocial'=>Request::get('rs'),
								 'nombreComercial'=>Request::get('nc'),
								 'rif_id'=>(int) Request::get('rif'),
								 'numeroRif'=>Request::get('df'),
								 'tipoContribuyente_id'=>(int)Request::get('tipCon'),
								 'direccionFiscal'=>strtoupper(Request::get('descDirdf')),
								 'paisF'=>(int)Request::get('paisdf'),
								 'regionF'=>(int)Request::get('regiondf'),
								 'estadoF'=>(int)Request::get('edodf'),
								 'municipioF'=>(int)Request::get('mundf'),
								 'direccionComercial'=>strtoupper(Request::get('descDirdc')),
								 'paisC'=>(int)Request::get('paisdc'),
								 'regionC'=>(int)Request::get('regiondc'),
								 'estadoC'=>(int)Request::get('edodc'),
								 'municipioC'=>(int)Request::get('mundc'),
								 'codigoL'=>Request::get('tlflcl'),
								 'codigoM'=>Request::get('tlfmvl'),
								 'telefonoL'=>Request::get('tcl'),
								 'telefonoM'=>Request::get('tmvl'),
								 'correo'=>Request::get('mail'),
								 'cliente_id'=>Request::get('_idCliente_')
								);
		return $formulario;
	}
    public function verificarRif($rif,$cliente_id)
    {
    	$rifC=Rif::where(['numero'=>$rif->numero,'tipo_id'=>$rif->tipo_id,'rol'=>'CLIENTE'])->first();
    	$retorno=(object)array('codigo'=>0,'extra'=>0);
    	if($rifC!=null)
    	{
    		$cliente=Cliente::where('rif_id',$rifC->id)->where('id','<>',$cliente_id)->first();
    		if($cliente!=null)
    		{
    			$retorno->codigo=2;
    			$retorno->extra=$cliente->razonSocial;//si esta duplicado
    		}
    	}
    	return $retorno;

    }


    public function telefonoIdGet($tipo,$cliente_id)
    {
    	$telefonoLId=DB::table('cliente_telefono')
							->join('telefonos','telefonos.id','=','cliente_telefono.telefono_id')
							->where(['telefonos.tipo'=>$tipo,'cliente_telefono.cliente_id'=>$cliente_id])
							->select('telefonos.id AS id')->first();
		return $telefonoLId->id;

    }

     public function telefonoIdGetS($tipo,$cliente_id)
    {
    	$telefonoLId=DB::table('sucursal_telefono')
							->join('telefonos','telefonos.id','=','sucursal_telefono.telefono_id')
							->where(['telefonos.tipo'=>$tipo,'sucursal_telefono.sucursal_id'=>$cliente_id])
							->select('telefonos.id AS id')->first();
		return $telefonoLId->id;

    }


	public function clientes_actualizar()//metodo para actualizar en la base de datos los datos de un cliente matriz
	{

		$cambios=array();
		$clienteForm=$this->formularioActualizarCliente();
		$duplicado=$this->verificarRif((object)array('numero'=>$clienteForm->numeroRif,'tipo_id'=>$clienteForm->rif_id),$clienteForm->cliente_id);
		if($duplicado->codigo==0)//si el cliente no utiliza el rif de algun cliente
		{
			//////////////obtener los datos del cliente /////////////////////////////////////////////
			$cliente=Cliente::find($clienteForm->cliente_id);

			/////////////obtener los datos del rif ////////////////////////////////////////////////
			$rif=Rif::find($cliente->rif_id);

			$traduccionBd=$this->traducirId($rif->tipo_id,0);
    		$traduccionFor=$this->traducirId($clienteForm->rif_id,0);
    		$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Tipo Rif');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$rif->tipo_id=$clienteForm->rif_id;
			
			$cambio=$this->detectarCambios($clienteForm->numeroRif,$rif->numero,'Numero Rif');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$rif->numero=$clienteForm->numeroRif;
			$rif->save();

			//////////////Obtener los datos de la direccion fiscal ////////////////////////////////

			$direccionFiscal=Direccion::find($cliente->direccionFiscal_id);

			$cambio=$this->detectarCambios($clienteForm->direccionFiscal,$direccionFiscal->descripcion,'Direccion Fiscal');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$direccionFiscal->descripcion=$clienteForm->direccionFiscal;


			$traduccionBd=$this->traducirId($direccionFiscal->pais_id,2);
    		$traduccionFor=$this->traducirId($clienteForm->paisF,2);
    		$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Pais Direccion Fiscal');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$direccionFiscal->pais_id=$clienteForm->paisF;

			$traduccionBd=$this->traducirId($direccionFiscal->region_id,3);
    		$traduccionFor=$this->traducirId($clienteForm->regionF,3);
    		$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Region Direccion Fiscal');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$direccionFiscal->region_id=$clienteForm->regionF;

			$traduccionBd=$this->traducirId($direccionFiscal->estado_id,4);
    		$traduccionFor=$this->traducirId($clienteForm->estadoF,4);
    		$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Estado Direccion Fiscal');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$direccionFiscal->estado_id=$clienteForm->estadoF;


			$traduccionBd=$this->traducirId($direccionFiscal->municipio_id,5);
    		$traduccionFor=$this->traducirId($clienteForm->municipioF,5);
    		$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Municipio Direccion Fiscal');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$direccionFiscal->municipio_id=$clienteForm->municipioF;
			$direccionFiscal->save();

			//////////////Obtener los datos de la direccion comercial ////////////////////////////////

			$direccionComercial=Direccion::find($cliente->direccionComercial_id);

			$cambio=$this->detectarCambios($clienteForm->direccionComercial,$direccionComercial->descripcion,'Direccion Comercial');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$direccionComercial->descripcion=$clienteForm->direccionComercial;


			$traduccionBd=$this->traducirId($direccionComercial->pais_id,2);
    		$traduccionFor=$this->traducirId($clienteForm->paisC,2);
    		$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Pais Direccion Comercial');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$direccionComercial->pais_id=$clienteForm->paisC;

			$traduccionBd=$this->traducirId($direccionComercial->region_id,3);
    		$traduccionFor=$this->traducirId($clienteForm->regionC,3);
    		$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Region Direccion Comercial');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$direccionComercial->region_id=$clienteForm->regionC;

			$traduccionBd=$this->traducirId($direccionComercial->estado_id,4);
    		$traduccionFor=$this->traducirId($clienteForm->estadoC,4);
    		$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Estado Direccion Comercial');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$direccionComercial->estado_id=$clienteForm->estadoC;


			$traduccionBd=$this->traducirId($direccionComercial->municipio_id,5);
    		$traduccionFor=$this->traducirId($clienteForm->municipioC,5);
    		$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Municipio Direccion Comercial');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$direccionComercial->municipio_id=$clienteForm->municipioC;
			$direccionComercial->save();

			////////////////////Obtener datos del correo ////////////////////////////////////////////////////////////////
			$correo=Correo::find($cliente->correo_id);

			$cambio=$this->detectarCambios($clienteForm->correo,$correo->correo,'Correo');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$correo->correo=$clienteForm->correo;
			$correo->save();

			////////////////////Obtener los datos basicos  del cliente //////////////////////////////////////
			
			$cambio=$this->detectarCambios($clienteForm->razonSocial,$cliente->razonSocial,'Razon Social');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$cliente->razonSocial=$clienteForm->razonSocial;
			
			$cambio=$this->detectarCambios($clienteForm->nombreComercial,$cliente->nombreComercial,'Nombre Comercial');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$cliente->nombreComercial=$clienteForm->nombreComercial;
			
			$traduccionBd=$this->traducirId($cliente->tipoContribuyente_id,11);
    		$traduccionFor=$this->traducirId($clienteForm->tipoContribuyente_id,11);
    		$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Tipo Contribuyente');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$cliente->tipoContribuyente_id=$clienteForm->tipoContribuyente_id;
			$cliente->save();

			//////////////////Obtener los datos del telefono Local /////////////////////////////////////////////////////////
			$telefonoLocal=Telefono::find($this->telefonoIdGet(0,$cliente->id));

			$cambio=$this->detectarCambios($clienteForm->telefonoL,$telefonoLocal->telefono,'Nro.Telf. Local');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$telefonoLocal->telefono=$clienteForm->telefonoL;
			
			$traduccionFor=$this->traducirId($clienteForm->codigoL,7);
			$cambio=$this->detectarCambios($traduccionFor,$telefonoLocal->codigo,'Codigo Telf. Local');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$telefonoLocal->codigo=$traduccionFor;
			

			$telefonoLocal->save();



			/////////////////Obtener los datos del telefono Movil ////////////////////////////////////////////////////////////
			$telefonoMovil=Telefono::find($this->telefonoIdGet(2,$cliente->id));
			
			$cambio=$this->detectarCambios($clienteForm->telefonoM,$telefonoMovil->telefono,'Nro.Telf. Movil');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$telefonoMovil->telefono=$clienteForm->telefonoM;
			
			$traduccionFor=$this->traducirId($clienteForm->codigoM,7);
			$cambio=$this->detectarCambios($traduccionFor,$telefonoMovil->codigo,'Codigo Telf. Movil');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$telefonoMovil->codigo=$traduccionFor;
			
			
			$telefonoMovil->save();




			$longitud=count($cambios);
    		$cambios=$this->documentarCambios($cambios);

    		if($longitud>0)
    	 	{

    			$this->registroBitacora('Id del registro modificado: '.$cliente->id,'Modificar Cliente Matriz',$cambios,'Clientes -> Cliente Matriz');
    			$duplicado->codigo=1;
    		}




		}




		return Response::json($duplicado);
		


		

	}
	

	public function clientesStatus()
	{

		$status=[1,0];
		$status_=['HABILITADO','INHABILITADO'];
		$status__=['INHABILITADO','HABILITADO'];
		$registry=Request::get('registry');
		$aux=false;
		/////////////////Busqueda del cliente y cambio de status ////////////////////////////////////////////
		$cliente=Cliente::find($registry);
		$cliente->status=$status[$cliente->status];
		$aux=$cliente->save();
		/////////////////////////////////////////////////////////////////////////////////////////////////////
		$rif=DB::table('rifs')->join('tipos','tipos.id','=','rifs.tipo_id')
					->select('rifs.numero AS numero','tipos.descripcion AS tipoRif')
					->where('rifs.id',$cliente->rif_id)
					->first();

	    $this->registroBitacora($cliente->nombreComercial.' - '.$rif->tipoRif.' '.$rif->numero,'Cambiar Status','{"Status":"'.$status_[$cliente->status].' -> '.$status__[$cliente->status].'"}','Clientes ->Cliente Matriz');
	    /////////////////////////////////////////////////////////////////////////////////////////////////////

		return Response()->json(['update'=>$aux]);
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
					  DB::table('tipos')->where('numero_c',3)->get(),
					  $cliente_id,
					  DB::table('clientes')->where('id',$cliente_id)->select('nombreComercial AS nombreComercial')->first()
					  ));//tipos de codigos locales para los select 
					
	}

	
	public function verificarCedulaResponsable($cedula_)
	{
		$duplicado=(object)array('codigo'=>0,'extra'=>0,'adicional'=>0);
		$cedula=DB::table('cedulas')->where(['numero'=>$cedula_->numero,'rol'=>'ENCARGADO'])->first();
		if($cedula!=null)
		{
			$persona=Persona::where('cedula_id',$cedula->id)->select('primerNombre AS nombre','primerApellido AS apellido')->first();
			$duplicado->codigo=2;
			$duplicado->extra=$persona->nombre.' '.$persona->apellido;
		}

		return $duplicado;
		
	}
	public function clientes_insertar_responsable()//agregar posibles responsables a una matriz
	{
		
	
		$formulario=$this->capturar_datos_responsables();
		$duplicado=$this->verificarCedulaResponsable((object)array('numero'=>$formulario->numeroCedula,'tipo_id'=>$formulario->cedula_id));
		if($duplicado->codigo==0)
		{
			
			//////////////crear la cedula//////////////////////////////////
			$cedula=new Cedula();
			$cedula->numero=$formulario->numeroCedula;
			$cedula->tipo_id=$formulario->cedula_id;
			$cedula->rol="ENCARGADO";
			$cedula->save();
			////////////////////////////////////////////////////////////////

			/////////////crear correo//////////////////////
			$correo=new Correo();
			$correo->correo=$formulario->correo;
			$correo->save();
			/////////////////////////////////////////////////

			//////////////Crear persona//////////////////
			$persona=new Persona();
			$persona->primerNombre=$formulario->nombre;
			$persona->primerApellido=$formulario->apellido;
			$persona->cargo=strtoupper($formulario->cargo);
			$persona->status=1;
			$persona->cedula_id=$cedula->id;
			$persona->correo_id=$correo->id;
			$persona->cliente_id=$formulario->cliente_id;
			$update=$persona->save();

			//////////////Numeros de telefono //////////

			$telefonoL=new Telefono();
			$traduccionForm=$this->traducirId($formulario->codigoFijo,7);
			$telefonoL->codigo=$traduccionForm;
			$telefonoL->telefono=$formulario->numeroFijo;
			$telefonoL->tipo=0;
			$telefonoL->save();

			$telefonoM=new Telefono();
			$traduccionForm=$this->traducirId($formulario->codigoMovil,7);
			$telefonoM->codigo=$traduccionForm;
			$telefonoM->telefono=$formulario->numeroMovil;
			$telefonoM->tipo=2;
			$telefonoM->save();

			DB::table('persona_telefono')->insert(['persona_id'=>$persona->id,'telefono_id'=>$telefonoL->id]);
			DB::table('persona_telefono')->insert(['persona_id'=>$persona->id,'telefono_id'=>$telefonoM->id]);

			if($update)
			{
				$duplicado->codigo=1;
				$this->registroBitacora('Id del registro creado: '.$persona->id,'Agregar Responsable','{"Registro al responsable":'.'"'.$persona->primerNombre.' '.$persona->primerApellido.'"}','Clientes -> Cliente Matriz -> Responsable');	
			}

			
		}
		return Response::json($duplicado);
	
	}
	
	
			
	public function clientes_modificar_responsables()//consulta que muestra los datos del responsable de una matriz en e modal mofificar
	{

	
		$formulario=$this->capturar_datos_responsables();
		$persona=Persona::find($formulario->registro);
		$cedula=Cedula::find($persona->cedula_id);
		$correo=Correo::find($persona->correo_id);
		$telefonoL=DB::table('persona_telefono')
							->join('telefonos','telefonos.id','=','persona_telefono.telefono_id')
							->join('tipos','telefonos.codigo','=','tipos.descripcion')
							->where(['persona_telefono.persona_id'=>$formulario->registro,'telefonos.tipo'=>0])
							->select('telefonos.codigo AS codigo','telefonos.id AS id','telefonos.telefono AS numero','tipos.descripcion AS codigo_id','tipos.id AS codigo_id')
							->first();

		$telefonoM=DB::table('persona_telefono')
							->join('telefonos','telefonos.id','=','persona_telefono.telefono_id')
							->join('tipos','telefonos.codigo','=','tipos.descripcion')
							->where(['persona_telefono.persona_id'=>$formulario->registro,'telefonos.tipo'=>2])
							->select('telefonos.codigo AS codigo','telefonos.id AS id','telefonos.telefono AS numero','tipos.descripcion AS codigo_id','tipos.id AS codigo_id')
							->first();
		
		
		
		return Response::json(['persona'=>$persona,'cedula'=>$cedula,'correo'=>$correo,'telefonoL'=>$telefonoL,'telefonoM'=>$telefonoM]);
	}
	
	
	function verificarCedulamod($cedula,$persona_id,$cliente_id)
	{
		$duplicado=(object)array('codigo'=>0,'extra'=>0);
		$cedula_=Cedula::where(['numero'=>$cedula->numero,'tipo_id'=>$cedula->tipo_id,'rol'=>'ENCARGADO'])->first();
		if($cedula_!=null)
		{
			$persona=DB::table('personas')->where('id','<>',$persona_id)->where('cedula_id',$cedula_->id)->where('cliente_id',$cliente_id)->first();
			if($persona!=null)
			{
			    $duplicado->codigo=2;
		        $duplicado->extra=$persona->primerNombre.' '.$persona->primerApellido;
			}
		
		}

		return $duplicado;
	}

	public function telefonoIdGetP($tipo,$persona_id)
	{
		$telefono=DB::table('persona_telefono')
					->join('telefonos','telefonos.id','=','persona_telefono.telefono_id')
					->where(['telefonos.tipo'=>$tipo,'persona_telefono.persona_id'=>$persona_id])
					->select('telefonos.id AS id ')->first();
		return $telefono->id;
	}
	public function clientes_actualizar_responsable()//modifica en la base de datos la informacion de los responsables de una matriz
	{

		$formulario=$this->capturar_datos_responsables();
		$duplicado=$this->verificarCedulamod((object)array('numero'=>$formulario->numeroCedula,'tipo_id'=>$formulario->cedula_id),$formulario->registro,$formulario->cliente_id);
		$cambios=array();

		if($duplicado->codigo==0)//si no esta duplicado
		{
			////////////Obtener el registro de la persona ///////////////////////////////////////////////////////////////
			$persona=Persona::find($formulario->registro);


			////////Obtener la cedula //////////////////
			$cedula=Cedula::find($persona->cedula_id);

			$cambio=$this->detectarCambios($formulario->numeroCedula,$cedula->numero,'Numero Cedula');
    		$cambios=$this->agregarCambios($cambio,$cambios);
    		$cedula->numero=$formulario->numeroCedula;
			

			$traduccionBd=$this->traducirId($cedula->tipo_id,1);
    		$traduccionFor=$this->traducirId($formulario->cedula_id,1);
    		$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Tipo Cedula');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$cedula->tipo_id=$formulario->cedula_id;

			$cedula->save();

			////////Obtener el correo /////////////////////////////////////////////////////////////////////////////////

			$correo=Correo::find($persona->correo_id);

			$cambio=$this->detectarCambios($formulario->correo,$correo->correo,'Correo');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$correo->correo=$formulario->correo;

			$correo->save();

			////////////////////////////////////////Actualizar persona///////////////////////////////////////////////////////////

			$cambio=$this->detectarCambios($formulario->nombre,$persona->primerNombre,'Nombre');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$persona->primerNombre=strtoupper($formulario->nombre);

			
			$cambio=$this->detectarCambios($formulario->apellido,$persona->primerApellido,'Apellido');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$persona->primerApellido=strtoupper($formulario->apellido);

			$cambio=$this->detectarCambios($formulario->cargo,$persona->cargo,'Cargo');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$persona->cargo=strtoupper($formulario->cargo);

			$update=$persona->save();

			//////////////////////////////////////////Obtener datos del telefono local /////////////////////////////////////////////

			$telefonoLocal=Telefono::find($this->telefonoIdGetP(0,$persona->id));

			$cambio=$this->detectarCambios($formulario->numeroFijo,$telefonoLocal->telefono,'Nro.Telf. Local');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$telefonoLocal->telefono=$formulario->numeroFijo;
			
			$traduccionFor=$this->traducirId($formulario->codigoFijo,7);
			$cambio=$this->detectarCambios($traduccionFor,$telefonoLocal->codigo,'Codigo Telf. Local');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$telefonoLocal->codigo=$traduccionFor;
			

			$telefonoLocal->save();

			////////////////Obtener datos del telefono movil ////////////////////////////////////////

			$telefonoMovil=Telefono::find($this->telefonoIdGetP(2,$persona->id));
			
			$cambio=$this->detectarCambios($formulario->numeroMovil,$telefonoMovil->telefono,'Nro.Telf. Movil');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$telefonoMovil->telefono=$formulario->numeroMovil;
			
			$traduccionFor=$this->traducirId($formulario->codigoMovil,7);
			$cambio=$this->detectarCambios($traduccionFor,$telefonoMovil->codigo,'Codigo Telf. Movil');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$telefonoMovil->codigo=$traduccionFor;
			
			
			$telefonoMovil->save();



			/////////////////////////////////////////////////////////////////////////////////////////


			$longitud=count($cambios);
    		$cambios=$this->documentarCambios($cambios);

    		if($longitud>0)
    	 	{

    			$this->registroBitacora('Id del registro modificado: '.$persona->id,'Modificar Responsable',$cambios,'Clientes -> Cliente Matriz');
    			$duplicado->codigo=1;
    		}

		




		}
		

		

		return Response::json($duplicado);
	}
	
    function responsables_status()
    {
    	$status=[1,0];
		$status_=['HABILITADO','INHABILITADO'];
		$status__=['INHABILITADO','HABILITADO'];
		$registry=Request::get('registry');
		$aux=false;
		///////////// Busqueda del perfil y cambio de status ////////////////////////
		$persona=Persona::find($registry);
		$persona->status=$status[$persona->status];
		$aux=$persona->save();
		/////////////////////////////////////////////////////////////////////////////////////////////////////
	    $this->registroBitacora('Persona: '.$persona->primerNombre.' '.$persona->primerApellido,'Cambiar Status','{"Status":"Cambio de: '.$status_[$persona->status].' a: '.$status__[$persona->status].'"}','Clientes->responsable');
	    /////////////////////////////////////////////////////////////////////////////////////////////////////

		return Response()->json(['update'=>$aux]);
    }


    function responsablesMatriz_asignar()
    {

    	$retorno=0;
    	$anterior=Request::get('anterior');
    	$nuevo=Request::get('nuevo');

    	if($anterior!=0)
    	{
    		$personaAn=Persona::find($anterior);
    		$personaAn->encargado=0;
    		$personaAn->save();
    	}
    	

    	$personaNu=Persona::find($nuevo);
    	$personaNu->encargado=1;
    	$update=$personaNu->save();

    	if($update)
    	{
    		$retorno=1;
    	}

    	return Response::json(['retorno'=>$retorno]);
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////categorias de un cliente matriz //////////////////////////////////////////////////////////


public function clientes_categoria($cliente_id)//vista de categorias de un cliente matriz
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$cliente=Cliente::find($cliente_id);
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(16,17,18,19),20);
		return view ('Registros_Basicos\Clientes\clientes_categoria',$this->datos_vista($datos,$acciones,DB::table('categorias')->where('cliente_id',$cliente_id)->get(),$cliente));
						
	}

	
	
	


	public function categoriaDuplicada($nombreCategoria,$cliente_id)
	{
		$duplicado=(object)array('codigo'=>0,'extra'=>0);
		$categoria=DB::table('categorias')->where(['nombre'=>$nombreCategoria,'cliente_id'=>$cliente_id])->first();
		if($categoria!=null)
		{
			$cliente=Cliente::find($cliente_id);
			$duplicado->codigo=2;
			$duplicado->extra='La categoria: '.$categoria->nombre.' ,Se encuentra creada para el cliente: '.$cliente->nombreComercial;
		}

		return $duplicado;
	}

	public function clientes_categoria_agregar()
	{
		
		$nombreCategoria=Request::get('nomCat');
		$status=Request::get('stCat');
		$cliente_id=Request::get('cliente_id__');
		$duplicado=$this->categoriaDuplicada($nombreCategoria,$cliente_id);

		if($duplicado->codigo==0)
		{


				///////////////////////////////////////////////////////////////////////////////////
				$categoria=new Categoria();
				$categoria->nombre=strtoupper($nombreCategoria);
				$categoria->status=$status;
				$categoria->cliente_id=$cliente_id;
				$update=$categoria->save();

				if($update)
				{
					$this->registroBitacora('Id del registro creado: '.$categoria->id,'Agregar Categoria','{"Registro la categoria":'.'"'.$categoria->nombre.'"'.'}','Clientes -> Categoria');

					$duplicado->codigo=1;
				}

		}

		return Response::json($duplicado);

						
	}
	
	
	public function clientes_categoria_status()
	{

		$status=[1,0];
		$status_=['HABILITADO','INHABILITADO'];
		$status__=['INHABILITADO','HABILITADO'];
		$registry=Request::get('registry');
		$aux=false;
		/////////////////Busqueda del cliente y cambio de status ////////////////////////////////////////////
		$categoria=Categoria::find($registry);
		$categoria->status=$status[$categoria->status];
		$aux=$categoria->save();
		// /////////////////////////////////////////////////////////////////////////////////////////////////////
		// $rif=DB::table('rifs')->join('tipos','tipos.id','=','rifs.tipo_id')
		// 			->select('rifs.numero AS numero','tipos.descripcion AS tipoRif')
		// 			->where('rifs.id',$cliente->rif_id)
		// 			->first();

	    $this->registroBitacora($categoria->nombre,'Cambiar Status','{"Status":"'.$status_[$categoria->status].' -> '.$status__[$categoria->status].'"}','Clientes ->Categoria Matriz ');
	    /////////////////////////////////////////////////////////////////////////////////////////////////////

		return Response()->json(['update'=>$aux]);

	}

	public function clientes_categorias_modificar()//carga datos al modal modificar categoria
	{
		$registry=Request::get('registry');
		$categoria=Categoria::find($registry);

		return Response::json($categoria);
		
	}

	public function categoriaDuplicadaMod($categoria_id,$nombreCategoria,$cliente_id)
	{
		$duplicado=(object)array('codigo'=>0,'extra'=>0);
		$categoria=DB::table('categorias')->where('id','<>',$categoria_id)->where('nombre','=',$nombreCategoria)->where('cliente_id',$cliente_id)->first();
		if($categoria!=null)
		{
			$cliente=Cliente::find($categoria->cliente_id);
			if ($cliente!=null) 
			{
				$duplicado->codigo=2;
				$duplicado->extra='La categoria: '.$nombreCategoria.' , se encuentra creada para el cliente: <br>'.$cliente->nombreComercial;
			}
		}
		return $duplicado;
	}


	public function clientes_categorias_actualizar()//actualiza los datos de una categoria en la base de datos
	{
		
		
		$cambios=array();
		$nombreCategoria=strtoupper(Request::get('nomCat'));
		$status=Request::get('stCat');
		$categoria_id=Request::get('_idCategoria_');


		$categoria=Categoria::find($categoria_id);
		$duplicado=$this->categoriaDuplicadaMod($categoria_id,$nombreCategoria,$categoria->cliente_id);
		if ($duplicado->codigo==0) 
		{
			
		
			$cambio=$this->detectarCambios($nombreCategoria,$categoria->nombre,'Nombre Categoria');
	    	$cambios=$this->agregarCambios($cambio,$cambios);
			$categoria->nombre=$nombreCategoria;
			$categoria->status=$status;
			$update=$categoria->save();
			$longitud=count($cambios);
    		$cambios=$this->documentarCambios($cambios);

    		if($longitud>0)
    	 	{

    			$this->registroBitacora('Id del registro modificado: '.$categoria->id,'Modificar Categoria',$cambios,'Clientes -> Cliente Matriz ->Categoria');
    			$duplicado->codigo=1;
    		}

		}



		return Response::json($duplicado);
	}
	
	public function retornarResponsable($categoria_id)
	{
		$responsable=DB::table('categoria_persona')
						->where('categoria_persona.categoria_id',$categoria_id)
						->first();
		if ($responsable!=null) {$id=$responsable->persona_id;}else{$id=0;}
		return $id;

	}
	
	public function clientes_categoria_responsable($categoria_id)//listar responsables de una categoria
	{
		
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(22,23),21);
		$categoria=Categoria::find($categoria_id);
		$cliente=Cliente::find($categoria->cliente_id);
		$responsable=$this->retornarResponsable($categoria_id);
		$responsables=DB::table('personas')->where('cliente_id',$categoria->cliente_id)->get();
		$tiposCedula=DB::table('tipos')->where('numero_c',5)->get();
		$tiposCelular=DB::table('tipos')->where('numero_c',2)->get();
		$tiposFijo=DB::table('tipos')->where('numero_c',3)->get();


		
		
		return view ('Registros_Basicos\Clientes\clientes_categoria_responsable',$this->datos_vista($datos,$acciones,$responsables,$responsable,$cliente,$tiposCedula,$tiposCelular,$tiposFijo,$categoria));//tipos dle codigos loca
						
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


	public function categoriasAsignarResponsable()
	{
		$retorno=0;
		$nuevo=Request::get('nuevo');
		$anterior=Request::get('anterior');
		$categoria=Request::get('categoria');
		if ($anterior==0) 
		{
			$update=DB::table('categoria_persona')->insert(['persona_id'=>$nuevo,'categoria_id'=>$categoria]);
		}
		else
		{
			$update=DB::table('categoria_persona')->where(['persona_id'=>$anterior,'categoria_id'=>$categoria])
			->update(['persona_id'=>$nuevo]);
		}

		if ($update){$retorno=1;}

		return Response::json(['retorno'=>$retorno]);
	}

	public function respCatStatus()
	{
		$status=[1,0];
		$status_=['HABILITADO','INHABILITADO'];
		$status__=['INHABILITADO','HABILITADO'];
		$registry=Request::get('registry');
		$aux=false;
		///////////// Busqueda del perfil y cambio de status ////////////////////////
		$persona=Persona::find($registry);
		$persona->status=$status[$persona->status];
		$aux=$persona->save();
		/////////////////////////////////////////////////////////////////////////////////////////////////////
	    $this->registroBitacora('Persona: '.$persona->primerNombre.' '.$persona->primerApellido,'Cambiar Status','{"Status":"Cambio de: '.$status_[$persona->status].' a: '.$status__[$persona->status].'"}','Clientes->Categoria->responsable');
	    /////////////////////////////////////////////////////////////////////////////////////////////////////

		return Response()->json(['update'=>$aux]);
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
		$cliente=Cliente::find($consulta_->cliente_id);
		$categoria=Categoria::find($categoria_id);
		

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
															 'cliente'=>$cliente,
															 'categoria'=>$categoria
															]);

						
	}

	
	public function datosSucursal()
	{
		$formulario=(object)
							array(
									'razonSocial'=>strtoupper(Request::get('rs')),
									'nombreComercial'=>strtoupper(Request::get('nc')),
									'rif_id'=>Request::get('rif'),
									'numeroRif'=>Request::get('df'),
									'tipoContribuyente_id'=>Request::get('tipCon'),
									'paisF'=>Request::get('paisdf'),
									'regionF'=>Request::get('regiondf'),
									'estadoF'=>Request::get('edodf'),
									'municipioF'=>Request::get('mundf'),
									'direccionFiscal'=>Request::get('descDirdf'),
									'paisC'=>Request::get('paisdc'),
									'regionC'=>Request::get('regiondc'),
									'estadoC'=>Request::get('edodc'),
									'municipioC'=>Request::get('mundc'),
									'direccionComercial'=>Request::get('descDirdc'),
									'codigoLocal'=>Request::get('tlflcl'),
									'numeroLocal'=>Request::get('tcl'),
									'codigoMovil'=>Request::get('tlfmvl'),
									'numeroMovil'=>Request::get('tmvl'),
									'correo'=>Request::get('mail'),
									'categoria'=>Request::get('categoria__id'),
									'cliente'=>Request::get('cliente__id'),
									'registro'=>Request::get('registroSucursal')
								 );

		return $formulario;

	}

	public function sucursalesAgregar()
	{
			$formulario=$this->datosSucursal();
			$duplicado=(object) array('codigo'=>0,'extra'=>0);
		
		// $duplicado=$this->verificarRifCliente(array('numero'=>$cliente->numeroRif,'tipo_id'=>$cliente->rif_id));
		// if($duplicado->codigo==0)//si no se encuentra registrado el rif de un cliente
		// {
		// 	/////////////////////////////Obtener direccion fiscal del cliente //////////////////////////////////
			$direccionFiscal=new Direccion();
			$direccionFiscal->descripcion=$formulario->direccionFiscal;
			$direccionFiscal->pais_id=$formulario->paisF;
			$direccionFiscal->region_id=$formulario->regionF;
			$direccionFiscal->estado_id=$formulario->estadoF;
			$direccionFiscal->municipio_id=$formulario->municipioF;
			$direccionFiscal->save();


			//////////////////////////Obtener direccion comercial del formulario //////////////////////////////////
			$direccionComercial=new Direccion();
			$direccionComercial->descripcion=$formulario->direccionComercial;
			$direccionComercial->pais_id=$formulario->paisC;
			$direccionComercial->region_id=$formulario->regionC;
			$direccionComercial->estado_id=$formulario->estadoC;
			$direccionComercial->municipio_id=$formulario->municipioC;
			$direccionComercial->save();

			/////////////////////////Obtener Rif del cliente ///////////////////////////////////////////////////
			$rif=new Rif();
			$rif->numero=$formulario->numeroRif;
			$rif->tipo_id=$formulario->rif_id;
			$rif->rol='SUCURSAL';
			$rif->save();

			////////////////////////Obtener correo del Cliente ////////////////////////////////////////////////
			$correo=new Correo();
			$correo->correo=$formulario->correo;
			$correo->save();
			//////////////////////Obtener telefono Local del cliente ////////////////////////////////////////////

			$codigoL=Tipo::where('id',$formulario->codigoLocal)->first();
			$telefonoL=new Telefono();
			$telefonoL->codigo=$codigoL->descripcion;
			$telefonoL->telefono=$formulario->numeroLocal;
			$telefonoL->tipo=0;
			$telefonoL->save();

			/////////////////////Obtener el telefono movil del Cliente //////////////////////////////////////////
			$codigoM=Tipo::where('id',$formulario->codigoMovil)->first();
			$telefonoM=new Telefono();
			$telefonoM->codigo=$codigoM->descripcion;
			$telefonoM->telefono=$formulario->numeroMovil;
			$telefonoM->tipo=2;
			$telefonoM->save();


			///////////////////////Crear registro para el cliente ////////////////////////////////////////////////
			$sucursal=new Sucursal();
			$sucursal->razonSocial=$formulario->razonSocial;
			$sucursal->nombreComercial=$formulario->nombreComercial;
			$sucursal->rif_id=$rif->id;
			$sucursal->direccionFiscal_id=$direccionFiscal->id;
			$sucursal->direccionComercial_id=$direccionComercial->id;
			$sucursal->correo_id=$correo->id;
			$sucursal->tipoContribuyente_id=$formulario->tipoContribuyente_id;
			$sucursal->categoria_id=$formulario->categoria;
			$update=$sucursal->save();

			///////////////////asociar telefonos al cliente //////////////////////////////////////////////////////
			DB::table('sucursal_telefono')->insert(['telefono_id'=>$telefonoL->id,'sucursal_id'=>$sucursal->id]);
			DB::table('sucursal_telefono')->insert(['telefono_id'=>$telefonoM->id,'sucursal_id'=>$sucursal->id]);
			///////////////////////////////////////////////////////////////////////////////////////////////////////////

			$tipoRif=Tipo::where('id',$rif->tipo_id)->first();//descripcion del tipo de rif ingresado para el cliente 


			if($update)
			{
				$duplicado->codigo=1;
				$this->registroBitacora('Id del registro creado: '.$sucursal->id,'Agregar Sucursal','{"Registro la sucursal":'.'"'.$sucursal->nombreComercial.' - '.$tipoRif->descripcion.' '.$rif->numero.'"'.'}','Clientes -> Categorias ->Sucursal');
			}
		//}








		return Response::json($duplicado);
		
	}

	
	public function sucursalPlan()
	{
		$nuevo=Request::get('nuevo');
		$anterior=Request::get('anterior');
		$sucursal=Request::get('sucursal');
		$retorno=0;

		if ($anterior==0)
		{
			$update=DB::table('plan_sucursal')->insert(['sucursal_id'=>$sucursal,'plan_id'=>$nuevo]);
		}
		else
		{
			$update=DB::table('plan_sucursal')->where(['sucursal_id'=>$sucursal,'plan_id'=>$anterior])->update(['plan_id'=>$nuevo]);
		}

		if ($update==true) {$retorno=1;}

		return Response::json(['retorno'=>$retorno]);
	}

	public function planesInfo()
	{
		$plan_id=Request::get('plan_id');
		$plan=Plan::find($plan_id);
		$plan=$plan->nombreP;
		$horarios=Horario::where('plan_id',$plan_id)->first();
		$respuestas=Respuesta::where('plan_id',$plan_id)->first();
		$presenciales=Presencial::where('plan_id',$plan_id)->first();
		$remotos=Remoto::where('plan_id',$plan_id)->first();
		$telefonicos=Telefonico::where('plan_id',$plan_id)->first();
		return Response::json(compact('horarios','respuestas','presenciales','remotos','telefonicos','plan'));
	}

	public function sucursalesStatus()
	{

		$status=[1,0];
		$status_=['HABILITADO','INHABILITADO'];
		$status__=['INHABILITADO','HABILITADO'];
		$registry=Request::get('registry');
		$aux=false;
		///////////// Busqueda del perfil y cambio de status ////////////////////////
		$sucursal=Sucursal::find($registry);
		$sucursal->status=$status[$sucursal->status];
		$aux=$sucursal->save();
		/////////////////////////////////////////////////////////////////////////////////////////////////////
	    $this->registroBitacora('Sucursal: '.$sucursal->nombreComercial,'Cambiar Status','{"Status":"Cambio de: '.$status_[$sucursal->status].' a: '.$status__[$sucursal->status].'"}','Sucursales');
	    /////////////////////////////////////////////////////////////////////////////////////////////////////

		return Response()->json(['update'=>$aux]);

	}




	public function consultarTelefonoSuc($sucursal_id,$tipo)//0 local, 1 local, 2 movil
	{
		$telefono=DB::table('telefonos')
					  ->join('sucursal_telefono','telefonos.id','=','sucursal_telefono.telefono_id')
					  ->join('tipos','telefonos.codigo','=','tipos.descripcion')
					  ->where(['sucursal_telefono.sucursal_id'=>$sucursal_id,'telefonos.tipo'=>$tipo])
					  ->select('telefonos.id AS id','telefonos.codigo AS codigo','telefonos.telefono AS numero','tipos.id AS tipo_id')
					  ->first();

				return $telefono;
	}

	public function opcionesDependientes($lista,$padre_id)
	{
		if($lista==0)
		{
			$retorno=DB::table('regiones')->where('pais_id',$padre_id)->get();
		}
		else if($lista==1)
		{
			$retorno=DB::table('estados')->where('region_id',$padre_id)->get();
		}
		else if($lista==2)
		{
			$retorno=DB::table('municipios')->where('estado_id',$padre_id)->get();
		}

		return $retorno;
	}


	public function sucursalesModificar()
	{
		$registry=Request::get('registry');
		$sucursal=Sucursal::find($registry);
		$rif=Rif::find($sucursal->rif_id);
		$direccionFiscal=Direccion::find($sucursal->direccionFiscal_id);
		$direccionComercial=Direccion::find($sucursal->direccionComercial_id);
		$correo=Correo::find($sucursal->correo_id);
		$telefonoLocal=$this->consultarTelefonoSuc($sucursal->id,0);
		$telefonoMovil=$this->consultarTelefonoSuc($sucursal->id,2);

		/////////////////////////Opciones dependientes Direccion Fiscal/////////////
		$regionesF=$this->opcionesDependientes(0,$direccionFiscal->pais_id);
		$estadosF=$this->opcionesDependientes(1,$direccionFiscal->region_id);
		$municipiosF=$this->opcionesDependientes(2,$direccionFiscal->estado_id);
		$dependenciasF=['regiones'=>$regionesF,'estados'=>$estadosF,'municipios'=>$municipiosF];

		/////////////////////////Opciones dependientes Direccion Comercial/////////////
		$regionesC=$this->opcionesDependientes(0,$direccionComercial->pais_id);
		$estadosC=$this->opcionesDependientes(1,$direccionComercial->region_id);
		$municipiosC=$this->opcionesDependientes(2,$direccionComercial->estado_id);
		$dependenciasC=['regiones'=>$regionesC,'estados'=>$estadosC,'municipios'=>$municipiosC];


		

		return Response::json(compact('sucursal','rif','direccionFiscal','direccionComercial','correo','telefonoLocal','telefonoMovil','dependenciasF','dependenciasC'));
	}

	public function equiposStatus()
	{


		$status=[1,0];
		$status_=['HABILITADO','INHABILITADO'];
		$status__=['INHABILITADO','HABILITADO'];
		$registry=Request::get('registry');
		$aux=false;
		///////////// Busqueda del perfil y cambio de status ////////////////////////
		$equipo=equipo::find($registry);
		$equipo->status=$status[$equipo->status];
		$aux=$equipo->save();
		/////////////////////////////////////////////////////////////////////////////////////////////////////
	    $this->registroBitacora('Equipo: '.$equipo->descripcion,'Cambiar Status','{"Status":"Cambio de: '.$status_[$equipo->status].' a: '.$status__[$equipo->status].'"}','Equipos');
	    /////////////////////////////////////////////////////////////////////////////////////////////////////

		return Response()->json(['update'=>$aux]);


	}

	public function sucursalesActualizar()
	{

		$formulario=$this->datosSucursal();
		$duplicado=(object) array('codigo'=>0,'extra'=>0);
		$cambios=array();
			
			//////////////////Datos de la sucursal ////////////////////
			$sucursal=Sucursal::find($formulario->registro);

			/////////////////Datos del rif ////////////////////////////
			$rif=Rif::find($sucursal->rif_id);

			$traduccionBd=$this->traducirId($rif->tipo_id,0);
    		$traduccionFor=$this->traducirId($formulario->rif_id,0);
    		$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Tipo Rif');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$rif->tipo_id=$formulario->rif_id;
			
			$cambio=$this->detectarCambios($formulario->numeroRif,$rif->numero,'Numero Rif');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$rif->numero=$formulario->numeroRif;
			$rif->save();

			////////////////Obtener datos de la direccion fiscal ///////////////////////
			$direccionFiscal=Direccion::find($sucursal->direccionFiscal_id);

			$cambio=$this->detectarCambios($formulario->direccionFiscal,$direccionFiscal->descripcion,'Direccion Fiscal');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$direccionFiscal->descripcion=$formulario->direccionFiscal;


			$traduccionBd=$this->traducirId($direccionFiscal->pais_id,2);
    		$traduccionFor=$this->traducirId($formulario->paisF,2);
    		$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Pais Direccion Fiscal');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$direccionFiscal->pais_id=$formulario->paisF;

			$traduccionBd=$this->traducirId($direccionFiscal->region_id,3);
    		$traduccionFor=$this->traducirId($formulario->regionF,3);
    		$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Region Direccion Fiscal');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$direccionFiscal->region_id=$formulario->regionF;

			$traduccionBd=$this->traducirId($direccionFiscal->estado_id,4);
    		$traduccionFor=$this->traducirId($formulario->estadoF,4);
    		$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Estado Direccion Fiscal');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$direccionFiscal->estado_id=$formulario->estadoF;


			$traduccionBd=$this->traducirId($direccionFiscal->municipio_id,5);
    		$traduccionFor=$this->traducirId($formulario->municipioF,5);
    		$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Municipio Direccion Fiscal');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$direccionFiscal->municipio_id=$formulario->municipioF;
			$direccionFiscal->save();

			/////////////////////Obtener datos de la direccion comrcial ///////////////////////////////////////////

			$direccionComercial=Direccion::find($sucursal->direccionComercial_id);

			$cambio=$this->detectarCambios($formulario->direccionComercial,$direccionComercial->descripcion,'Direccion Comercial');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$direccionComercial->descripcion=$formulario->direccionComercial;


			$traduccionBd=$this->traducirId($direccionComercial->pais_id,2);
    		$traduccionFor=$this->traducirId($formulario->paisC,2);
    		$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Pais Direccion Comercial');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$direccionComercial->pais_id=$formulario->paisC;

			$traduccionBd=$this->traducirId($direccionComercial->region_id,3);
    		$traduccionFor=$this->traducirId($formulario->regionC,3);
    		$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Region Direccion Comercial');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$direccionComercial->region_id=$formulario->regionC;

			$traduccionBd=$this->traducirId($direccionComercial->estado_id,4);
    		$traduccionFor=$this->traducirId($formulario->estadoC,4);
    		$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Estado Direccion Comercial');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$direccionComercial->estado_id=$formulario->estadoC;


			$traduccionBd=$this->traducirId($direccionComercial->municipio_id,5);
    		$traduccionFor=$this->traducirId($formulario->municipioC,5);
    		$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Municipio Direccion Comercial');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$direccionComercial->municipio_id=$formulario->municipioC;
			$direccionComercial->save();

			////////////////////Obtener datos del correo ////////////////////////////////////////////////////////////////
			$correo=Correo::find($sucursal->correo_id);

			$cambio=$this->detectarCambios($formulario->correo,$correo->correo,'Correo');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$correo->correo=$formulario->correo;
			$correo->save();

			//////////////////Obtener datos basicos de la sucursal ///////////////////////////////////////////////////////

			////////////////////Obtener los datos basicos  del cliente //////////////////////////////////////
			
			$cambio=$this->detectarCambios($formulario->razonSocial,$sucursal->razonSocial,'Razon Social');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$sucursal->razonSocial=$formulario->razonSocial;
			
			$cambio=$this->detectarCambios($formulario->nombreComercial,$sucursal->nombreComercial,'Nombre Comercial');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$sucursal->nombreComercial=$formulario->nombreComercial;
			
			$traduccionBd=$this->traducirId($sucursal->tipoContribuyente_id,11);
    		$traduccionFor=$this->traducirId($formulario->tipoContribuyente_id,11);
    		$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Tipo Contribuyente');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$sucursal->tipoContribuyente_id=$formulario->tipoContribuyente_id;
			$sucursal->save();

			// //////////////////Obtener los datos del telefono Local /////////////////////////////////////////////////////////
			$telefonoLocal=Telefono::find($this->telefonoIdGetS(0,$sucursal->id));

			$cambio=$this->detectarCambios($formulario->numeroLocal,$telefonoLocal->telefono,'Nro.Telf. Local');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$telefonoLocal->telefono=$formulario->numeroLocal;
			
			$traduccionFor=$this->traducirId($formulario->codigoLocal,7);
			$cambio=$this->detectarCambios($traduccionFor,$telefonoLocal->codigo,'Codigo Telf. Local');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$telefonoLocal->codigo=$traduccionFor;
			

			$telefonoLocal->save();



			/////////////////Obtener los datos del telefono Movil ////////////////////////////////////////////////////////////
			$telefonoMovil=Telefono::find($this->telefonoIdGetS(2,$sucursal->id));
			
			$cambio=$this->detectarCambios($formulario->numeroMovil,$telefonoMovil->telefono,'Nro.Telf. Movil');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$telefonoMovil->telefono=$formulario->numeroMovil;
			
			$traduccionFor=$this->traducirId($formulario->codigoMovil,7);
			$cambio=$this->detectarCambios($traduccionFor,$telefonoMovil->codigo,'Codigo Telf. Movil');
    		$cambios=$this->agregarCambios($cambio,$cambios);
			$telefonoMovil->codigo=$traduccionFor;
			
			
			$telefonoMovil->save();

			$longitud=count($cambios);
    		$cambios=$this->documentarCambios($cambios);

    		if($longitud>0)
    	 	{

    			$this->registroBitacora('Id del registro modificado: '.$sucursal->id,'Modificar Sucursal ',$cambios,'Clientes -> Cliente Matriz -> Categorias ->Sucursales');
    			$duplicado->codigo=1;
    		}







	return Response::json($duplicado);
	}


	public function clientes_sucursales_responsable($sucursal_id)
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(32,33),31);
		$cliente_id=DB::table('sucursales')
								->join('categorias','categorias.id','=','sucursales.categoria_id')
								->join('clientes','clientes.id','=','categorias.cliente_id')
								->select('clientes.id AS id')
								->where('sucursales.id',$sucursal_id)->first();

		$responsables=DB::table('personas')->where('cliente_id',$cliente_id->id)->get();
		$sucursal=Sucursal::find($sucursal_id);
		$categoria=Categoria::find($sucursal->categoria_id);
		$tipoCedula=DB::table('tipos')->where('numero_c',5)->get();
		$tipoCodigoCel=DB::table('tipos')->where('numero_c',2)->get();
		$tipoCodigoFijo=DB::table('tipos')->where('numero_c',3)->get();
		$respSucursal=DB::table('persona_sucursal')->where('sucursal_id',$sucursal_id)->first();

		if($respSucursal!=null)
		{
			$responsable=$respSucursal->persona_id;
		}
		else
		{
			$responsable=0;
		}
	
		return view 
		(
			'Registros_Basicos\Clientes\clientes_sucursales_responsable',
			$this->datos_vista($datos,$acciones,$responsables,$sucursal,$categoria,$cliente_id->id,$tipoCedula,$tipoCodigoCel,$tipoCodigoFijo,$responsable)
		);
						
	}

	public function clientes_sucursales_plan($sucursal_id)
		{
			$datos=$this->cargar_header_sidebar_acciones();
			$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(37),false);///reisar vista 
			$sucursal=Sucursal::find($sucursal_id);
			$categoria=Categoria::find($sucursal->categoria_id);
			
			$consultaPlan=DB::table('plan_sucursal')->where('sucursal_id',$sucursal->id)->first();
			if ($consultaPlan!=null) 
			{
				$planId=$consultaPlan->plan_id;
			}
			else
			{
				$planId=0;
			}

			return view ('Registros_Basicos\Clientes\clientes_sucursales_plan',$this->datos_vista($datos,$acciones,DB::table('planes')->paginate(11),$sucursal,$categoria,$planId));
							
		}

		public function sucursalAsignarResponsable()
		{

			$retorno=0;
			$nuevo=Request::get('nuevo');
			$anterior=Request::get('anterior');
			$sucursal=Request::get('sucursal');
			if ($anterior==0) 
			{
				$update=DB::table('persona_sucursal')->insert(['persona_id'=>$nuevo,'sucursal_id'=>$sucursal]);
			}
			else
			{
				$update=DB::table('persona_sucursal')->where(['persona_id'=>$anterior,'sucursal_id'=>$sucursal])
				->update(['persona_id'=>$nuevo]);
			}

			if ($update){$retorno=1;}

			return Response::json(['retorno'=>$retorno]);

		}

		public function sucursalResponsableStatus()
		{

			$status=[1,0];
			$status_=['HABILITADO','INHABILITADO'];
			$status__=['INHABILITADO','HABILITADO'];
			$registry=Request::get('registry');
			$aux=false;
			///////////// Busqueda del perfil y cambio de status ////////////////////////
			$persona=Persona::find($registry);
			$persona->status=$status[$persona->status];
			$aux=$persona->save();
			/////////////////////////////////////////////////////////////////////////////////////////////////////
		    $this->registroBitacora('Persona: '.$persona->primerNombre.' '.$persona->primerApellido,'Cambiar Status','{"Status":"Cambio de: '.$status_[$persona->status].' a: '.$status__[$persona->status].'"}','Sucursales->responsable');
		    /////////////////////////////////////////////////////////////////////////////////////////////////////

			return Response()->json(['update'=>$aux]);

		}
		

	public function clientes_sucursales_plan_servicios()
		{
			$datos=$this->cargar_header_sidebar_acciones();
			$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(40,39),38);
			return view ('Registros_Basicos\Clientes\clientes_sucursales_plan_servicios',$this->datos_vista($datos,$acciones,array()));
							
		}
/////////////////////////////////////////////////////////equipos ////////////////////////////////////////////

	public function datosEquipo()
	{
		$formulario=(object) array(
							 		 'nombre'=>strtoupper(Request::get('nomEq')),
							 		 'tipoEquipo'=>Request::get('_tpEq'),
							 		 'marca'=>Request::get('mkEq'),
							 		 'modelo'=>Request::get('modEq'),
							 		 'serial'=>strtoupper(Request::get('duPfl')),
							 		 'status'=>Request::get('stPfl'),
							 		 'sucursal'=>Request::get('_sucursal_id_'),
							 		 'registro'=>Request::get('_sucursalRegistro')



								  );

		return $formulario;
	}


	public function equipoDuplicado($nombre,$sucursal_id,$equipo_id=0)
	{
		$duplicado=(object) array('codigo'=>0,'extra'=>0);

		if($equipo_id==0)
		{

			$consulta=DB::table('equipos')->where(['descripcion'=>$nombre,'sucursal_id'=>$sucursal_id])->first();
			if($consulta!=null)
			{
				$sucursal=Sucursal::find($sucursal_id);
				if($sucursal!=null)
				{
					$duplicado->extra='Ya existe un equipo de nombre: '.$nombre.' ,para la sucursal: '.$sucursal->nombreComercial;
					$duplicado->codigo=2;
				}
			}
		}
		else
		{
			$consulta=DB::table('equipos')->where(['descripcion'=>$nombre,'sucursal_id'=>$sucursal_id])->where('id','<>',$equipo_id)->first();

			if($consulta!=null)
			{
				$sucursal=Sucursal::find($sucursal_id);
				if($sucursal!=null)
				{
					$duplicado->extra='Ya existe un equipo de nombre: '.$nombre.' ,para la sucursal: '.$sucursal->nombreComercial;
					$duplicado->codigo=2;
				}
			}

		}

		return $duplicado;
	}

		

	public function equiposActualizar()
	{
		$datos=$this->datosEquipo();
		$duplicado=$this->equipoDuplicado($datos->nombre,$datos->sucursal,$datos->registro);
		$cambios=array();
		if($duplicado->codigo==0)
		{
			$equipo=Equipo::find($datos->registro);///obtener los datos del equipo
			
			$cambio=$this->detectarCambios($datos->nombre,$equipo->descripcion,'Nombre Equipo');
   			$cambios=$this->agregarCambios($cambio,$cambios);
			$equipo->descripcion=$datos->nombre;



		
			$traduccion=$this->traducirId($datos->tipoEquipo,12);
			$cambio=$this->detectarCambios($traduccion,$equipo->tipoequipo,'Tipo de Equipo');
			$cambios=$this->agregarCambios($cambio,$cambios);
			$equipo->tipoEquipo=$traduccion;

			$traduccion=$this->traducirId($datos->marca,13);
			$cambio=$this->detectarCambios($traduccion,$equipo->marca,'Marca');
			$cambios=$this->agregarCambios($cambio,$cambios);
			$equipo->marca=$traduccion;

			$traduccion=$this->traducirId($datos->modelo,14);
			$cambio=$this->detectarCambios($traduccion,$equipo->modelo,'Modelo');
			$cambios=$this->agregarCambios($cambio,$cambios);
			$equipo->modelo=$traduccion;
			

			$cambio=$this->detectarCambios($datos->serial,$equipo->serial,'Serial');
			$cambios=$this->agregarCambios($cambio,$cambios);
			$equipo->serial=$datos->serial;
			

			
			$cambio=$this->detectarCambios($datos->status,$equipo->status,'Status');
			$cambios=$this->agregarCambios($cambio,$cambios);
			$equipo->status=$datos->status;
			

			$update=$equipo->save();

			$longitud=count($cambios);
			$cambios=$this->documentarCambios($cambios);

			if($longitud>0)
    	 	{

    			$this->registroBitacora('Id del registro modificado: '.$equipo->id,'Modificar equipo ',$cambios,'Equipos -> Modificar Equipos');
    			$duplicado->codigo=1;
    		}
		}



		return Response::json($duplicado);

	} 

	public function equiposInsertar()
	{
		$datos=$this->datosEquipo();
		$duplicado=$this->equipoDuplicado($datos->nombre,$datos->sucursal);
		if($duplicado->codigo==0)
		{

				$equipo=new Equipo();
				$equipo->descripcion=$datos->nombre;
				$traduccion=$this->traducirId($datos->tipoEquipo,12);
				$equipo->tipoEquipo=$traduccion;

				$traduccion=$this->traducirId($datos->marca,13);
				$equipo->marca=$traduccion;

				$traduccion=$this->traducirId($datos->modelo,14);
				$equipo->modelo=$traduccion;
				$equipo->serial=$datos->serial;
				$equipo->status=$datos->status;
				$equipo->sucursal_id=$datos->sucursal;
				$update=$equipo->save();

				if($update)
				{
					$duplicado->codigo=1;
					$this->registroBitacora('Id del registro creado: '.$equipo->id,'Agregar Equipo','{"Registro el Equipo":'.'"'.$equipo->descripcion.' - '.$equipo->serial.'"'.'}','Equipos -> Agregar Equipo');
				}
		}

		return Response::json($duplicado);
	}






	public function clientes_sucursales_equipos($sucursal_id)//vista de equipos de una sucursal
		{
			$datos=$this->cargar_header_sidebar_acciones();
			$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(42,43,44,49),41);
			$sucursal=Sucursal::find($sucursal_id);
			$categoria=Categoria::find($sucursal->categoria_id);
			$tipoequipo=Tipoequipo::all();
			
			return view ('Registros_Basicos\Clientes\clientes_sucursales_equipos',$this->datos_vista($datos,$acciones,DB::table('equipos')->where('sucursal_id',$sucursal_id)->paginate(11),$sucursal,$categoria,$tipoequipo));
							
		}


	public function sucursalSelectEquipos()
	{
		

		$registry=Request::get('registry');
		$caso=Request::get('caso');
		$auxiliar=Request::get('auxiliar');//para obtener el valor del tipo de equipo seleccionado
		$retorno=null;

		if($caso==0)//se selecciona el tipo de equipo
		{
			$tipoEquipo=Tipoequipo::find($registry);
			$retorno=$tipoEquipo->marcas;
		}
		else if($caso==1)
		{
			//$marca=Marca::find($registry);

			$retorno=DB::table('modelos')
						->join('modelo_tipoequipo','modelo_tipoequipo.modelo_id','=','modelos.id')
						->join('marca_modelo','marca_modelo.modelo_id','=','modelos.id')
						->where(['modelo_tipoequipo.tipoequipo_id'=>$auxiliar,'marca_modelo.marca_id'=>$registry,'modelos.status'=>1])
						->select('modelos.descripcion AS descripcion','modelos.id AS id')
						->get();
				return $retorno;
		}

		return Response::json($retorno);
	}

	public function clientes_sucursales_equipos_componentes($equipo_id)//vista de componentes de un equipo
		{
			$datos=$this->cargar_header_sidebar_acciones();
			$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(46,47,48),45);
			$equipo=Equipo::find($equipo_id);
			$sucursal=Sucursal::find($equipo->sucursal_id);
			$tipoequipo=Tipoequipo::where('descripcion',$equipo->tipoequipo)->first();
			$ncomponente=$tipoequipo->componentes;
			return view ('Registros_Basicos\Clientes\clientes_sucursales_equipos_componentes',$this->datos_vista($datos,$acciones,DB::table('componentes')->where('equipo_id',$equipo_id)->paginate(11),$sucursal,$equipo,$ncomponente));
							
		}

	public function datosComponentes()
	{
		$formulario=(object)array('nombre'=>Request::get('selectNC'),
								  'serial'=>strtoupper(Request::get('serialCM')),
								  'marca'=>Request::get('selectMC'),
								  'modelo'=>Request::get('selectMOC'),
								  'equipo'=>Request::get('equipoPadre_'),
								  'status'=>Request::get('selectSC'),
								  'registro'=>Request::get('registroComp_')
									);

		return $formulario;
	}

	public function componentesInsertar()
	{
		$datos=$this->datosComponentes();
		$duplicado=(object)array('codigo'=>0,'duplicado'=>0);
		$componente=new Componente();
			$traduccion=$this->traducirId($datos->nombre,15);
			$componente->descripcion=$traduccion;

			$componente->serial=$datos->serial;

			$traduccion=$this->traducirId($datos->marca,13);
			$componente->marca=$traduccion;

			$traduccion=$this->traducirId($datos->modelo,14);
			$componente->modelo=$traduccion;

			$componente->status=$datos->status;

			$componente->equipo_id=$datos->equipo;

		$update=$componente->save();

		if($update)
		{
			$duplicado->codigo=1;
					$this->registroBitacora('Id del registro creado: '.$componente->id,'Agregar Componente','{"Registro el Componente":'.'"'.$componente->descripcion.'}','Equipos -> Agregar Componente');
		}


		return Response::json($duplicado);
	}

	public function componentesModificar()
	{
		$registry=Request::get('registroComp_');
		$componente=Componente::find($registry);
		$ncomponente=Ncomponente::where('descripcion',$componente->descripcion)->first();
		$marca=Marca::where('descripcion',$componente->marca)->first();
		$modelo=Modelo::where('descripcion',$componente->modelo)->first();
		$marcas=$ncomponente->marcas;
		$modelos=DB::table('modelos')
						->join('modelo_ncomponente','modelo_ncomponente.modelo_id','=','modelos.id')
						->join('marca_modelo','marca_modelo.modelo_id','=','modelos.id')
						->where(['modelos.status'=>1,'marca_modelo.marca_id'=>$marca->id,'modelo_ncomponente.ncomponente_id'=>$ncomponente->id])
						->select('modelos.descripcion AS descripcion ','modelos.id AS id')
						->get();



		return Response::json(['descripcion'=>$ncomponente->id,'marca'=>$marca->id,'modelo'=>$modelo->id,'serial'=>$componente->serial,'status'=>$componente->status,'marcas'=>$marcas,'modelos'=>$modelos]);
	}


	public function componentesActualizar()
	{
		$datos=$this->datosComponentes();
		$duplicado=(object)array('codigo'=>0,'extra'=>0);
		$cambios=array();
		if($duplicado->codigo==0)
		{
			$componente=Componente::find($datos->registro);
				$traducirForm=$this->traducirId($datos->nombre,15);
				$cambio=$this->detectarCambios($traducirForm,$componente->descripcion,'Nombre Componente');
				$cambios=$this->agregarCambios($cambio,$cambios);
				$componente->descripcion=$traducirForm;

				$cambio=$this->detectarCambios($datos->serial,$componente->serial,'Serial Componente');
				$cambios=$this->agregarCambios($cambio,$cambios);
				$componente->serial=$datos->serial;

				$traducirForm=$this->traducirId($datos->marca,13);
				$cambio=$this->detectarCambios($traducirForm,$componente->marca,'Marca Componente');
				$cambios=$this->agregarCambios($cambio,$cambios);
				$componente->marca=$traducirForm;

				$traducirForm=$this->traducirId($datos->modelo,14);
				$cambio=$this->detectarCambios($traducirForm,$componente->modelo,'Modelo Componente');
				$cambios=$this->agregarCambios($cambio,$cambios);
				$componente->modelo=$traducirForm;

				$traducirForm=$this->traducirId($datos->status,10);
				$traducirBd=$this->traducirId($componente->status,10);
				$cambio=$this->detectarCambios($traducirForm,$traducirBd,'Status Componente');

				$cambio=$this->detectarCambios($datos->status,$componente->status,'Status');
				$cambios=$this->agregarCambios($cambio,$cambios);
				$componente->status=$datos->status;
			$update=$componente->save();

			$longitud=count($cambios);
			$cambios=$this->documentarCambios($cambios);

			if($longitud>0)
    	 	{

    			$this->registroBitacora('Id del registro modificado: '.$componente->id,'Modificar componente ',$cambios,'Equipos -> Modificar Componente');
    			$duplicado->codigo=1;
    		}
		}


		return Response::json($duplicado);
	}

	public function componentesSelect()
	{

		$registry=Request::get('registry');
		$caso=Request::get('caso');
		$auxiliar=Request::get('auxiliar');

		if($caso==0)//carga las marcas
		{
			$componente=Ncomponente::find($registry);
			$retorno=$componente->marcas;
		}
		else if($caso==1)
		{
			$retorno=DB::table('modelos')
						->join('modelo_ncomponente','modelo_ncomponente.modelo_id','=','modelos.id')
						->join('marca_modelo','marca_modelo.modelo_id','=','modelos.id')
						->where(['modelos.status'=>1,'marca_modelo.marca_id'=>$registry,'modelo_ncomponente.ncomponente_id'=>$auxiliar])
						->select('modelos.descripcion AS descripcion ','modelos.id AS id')
						->get();
		}
		return Response::json($retorno);
	}


	public function componentesStatus()
	{
		$status=[1,0];
		$status_=['HABILITADO','INHABILITADO'];
		$status__=['INHABILITADO','HABILITADO'];
		$registry=Request::get('registry');
		$aux=false;
		///////////// Busqueda del perfil y cambio de status ////////////////////////
		$componente=componente::find($registry);
		$componente->status=$status[$componente->status];
		$aux=$componente->save();
		/////////////////////////////////////////////////////////////////////////////////////////////////////
	    $this->registroBitacora('Componente: '.$componente->descripcion,'Cambiar Status','{"Status":"Cambio de: '.$status_[$componente->status].' a: '.$status__[$componente->status].'"}','Componentes');
	    /////////////////////////////////////////////////////////////////////////////////////////////////////

		return Response()->json(['update'=>$aux]);
	}





	public function clientes_sucursales_equipos_aplicaciones($equipo_id)//vista de aplicaciones de un equipo
		{
			$datos=$this->cargar_header_sidebar_acciones();
			$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(51,52),50);
			$equipo=Equipo::find($equipo_id);
			$sucursal=Sucursal::find($equipo->sucursal_id);

			return view ('Registros_Basicos\Clientes\clientes_sucursales_equipos_componentes_aplicaciones',$this->datos_vista($datos,$acciones,DB::table('aplicaciones')->where('equipo_id',$equipo_id)->paginate(11),$equipo,$sucursal));
							
		}


		

		public function datosAplicacion()
		{

			$formulario=(object) array(
										'nombre'=>strtoupper(Request::get('nomAp')),
										'licencia'=>strtoupper(Request::get('LicAp')),
										'version'=>strtoupper(Request::get('VersAp')),
										'status'=>Request::get('selStAp'),
										'equipo'=>Request::get('__equipo__id__'),
										'registro'=>Request::get('regAplicacion_')

									);


			return $formulario;
		}


		public function aplicacionDuplicada($nombreApp,$equipo_id)
		{
			$duplicado=(object)array('codigo'=>0,'extra'=>0);

			$app=DB::table('aplicaciones')->where(['equipo_id'=>$equipo_id,'descripcion'=>$nombreApp])->first();
			if($app!=null)
			{
				$equipo=Equipo::find($equipo_id);
				if($equipo!=null)
				{
					$duplicado->extra="El equipo".$equipo->descripcion.' ya posee registrado una aplicacion de nombre : '.$nombreApp;
					$duplicado->codigo=2;
				}
			}

			return $duplicado;
		}

		public function aplicacionesInsertar()
		{
			
			$datos=$this->datosAplicacion();
			$duplicado=$this->aplicacionDuplicada($datos->nombre,$datos->equipo);

			if($duplicado->codigo==0)
			{
					$app=new Aplicacion();
					$app->descripcion=$datos->nombre;
					$app->licencia=$datos->licencia;
					$app->version=$datos->version;
					$app->status=$datos->status;
					$app->equipo_id=$datos->equipo;

					$update=$app->save();

					if($update)
					{

						$duplicado->codigo=1;
							$this->registroBitacora('Id del registro creado: '.$app->id,'Agregar aplicacion','{"Registro  la aplicacion":'.'"'.$app->descripcion.' - Version: '.$app->version.'"'.'}','Equipos -> Agregar Aplicacion');

					}
			}
		

			return Response::json($duplicado);
		}
	
		public function clientes_sucursales_equipos_piezas($componente_id)//vista de piezas de un componente
		{
			$datos=$this->cargar_header_sidebar_acciones();
			$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(54,55),53);
			$componente=Componente::find($componente_id);
			$ncomponente=DB::table('ncomponentes')->where('descripcion',$componente->descripcion)->first();
			$npiezas=DB::table('npiezas')->where('ncomponente_id',$ncomponente->id)->get();

			return view ('Registros_Basicos\Clientes\clientes_sucursales_equipos_componentes_piezas',$this->datos_vista($datos,$acciones,DB::table('piezas')->where('componente_id',$componente_id)->paginate(11),$componente,$npiezas));
							
		}


		public function datosPieza()
		{
			$formulario=(object) array(
										'nombre'=>strtoupper(Request::get('selectNP')),
										'serial'=>strtoupper(Request::get('serialPIZ')),
										'marca'=>strtoupper(Request::get('selectMP')),
										'modelo'=>Request::get('selectMOP'),
										'status'=>Request::get('selectSTP'),
										'componente'=>Request::get('RegComponente__'),
										'registro'=>Request::get('RegPieza__')

									);

			return $formulario;
		}



		public function piezasInsertar()
		{	
			$datos=$this->datosPieza();

			$duplicado=(object)array('codigo'=>0,'duplicado'=>0);
			$pieza=new Pieza();
			$traduccion=$this->traducirId($datos->nombre,16);
			$pieza->descripcion=$traduccion;

			$pieza->serial=$datos->serial;

			$traduccion=$this->traducirId($datos->marca,13);
			$pieza->marca=$traduccion;

			$traduccion=$this->traducirId($datos->modelo,14);
			$pieza->modelo=$traduccion;

			$pieza->status=$datos->status;

			$pieza->componente_id=$datos->componente;

		$update=$pieza->save();

		if($update)
		{
			$duplicado->codigo=1;
					$this->registroBitacora('Id del registro creado: '.$pieza->id,'Agregar Componente','{"Registro la pieza":'.'"'.$pieza->descripcion.'}','Equipos -> Agregar pieza');
		}
		

			return Response::json($duplicado);
	}



	public function piezasModificar()
	{


		$pieza=Request::get('registry');
		$pieza=Pieza::find($pieza);

		$npieza=DB::table('npiezas')->where('descripcion',$pieza->descripcion)->first();
		$marca=DB::table('marcas')->where('descripcion',$pieza->marca)->first();
		$modelo=DB::table('modelos')->where('descripcion',$pieza->modelo)->first();

		$npieza=Npieza::find($npieza->id);
		$marcas=$npieza->marcas;

		$modelos=DB::table('modelos')
							->join('modelo_npieza','modelo_npieza.modelo_id','=','modelos.id')
							->join('marca_modelo','marca_modelo.modelo_id','=','modelos.id')
							->where(['modelo_npieza.npieza_id'=>$npieza->id,'marca_modelo.marca_id'=>$marca->id,'modelos.status'=>1])
							->select('modelos.descripcion AS descripcion','modelos.id AS id ')
							->get();


		return Response::json(['descripcion'=>$npieza->id,'serial'=>$pieza->serial,'marca'=>$marca->id,'modelo'=>$modelo->id,'status'=>$pieza->status,'marcas'=>$marcas,'modelos'=>$modelos]);

	}



	public function piezasActualizar()
	{
		$datos=$this->datosPieza();
		$duplicado=(object)array('codigo'=>0,'extra'=>0);
		$cambios=array();
		if($duplicado->codigo==0)
		{
			$pieza=Pieza::find($datos->registro);
				$traducirForm=$this->traducirId($datos->nombre,16);
				$cambio=$this->detectarCambios($traducirForm,$pieza->descripcion,'Nombre Pieza');
				$cambios=$this->agregarCambios($cambio,$cambios);
				$pieza->descripcion=$traducirForm;

				$cambio=$this->detectarCambios($datos->serial,$pieza->serial,'Serial Pieza');
				$cambios=$this->agregarCambios($cambio,$cambios);
				$pieza->serial=$datos->serial;

				$traducirForm=$this->traducirId($datos->marca,13);
				$cambio=$this->detectarCambios($traducirForm,$pieza->marca,'Marca Pieza');
				$cambios=$this->agregarCambios($cambio,$cambios);
				$pieza->marca=$traducirForm;

				$traducirForm=$this->traducirId($datos->modelo,14);
				$cambio=$this->detectarCambios($traducirForm,$pieza->modelo,'Modelo Pieza');
				$cambios=$this->agregarCambios($cambio,$cambios);
				$pieza->modelo=$traducirForm;

				$traducirForm=$this->traducirId($datos->status,10);
				$traducirBd=$this->traducirId($pieza->status,10);
				$cambio=$this->detectarCambios($traducirForm,$traducirBd,'Status Pieza');

				$cambio=$this->detectarCambios($datos->status,$pieza->status,'Status');
				$cambios=$this->agregarCambios($cambio,$cambios);
				$pieza->status=$datos->status;
			$update=$pieza->save();

			$longitud=count($cambios);
			$cambios=$this->documentarCambios($cambios);

			if($longitud>0)
    	 	{

    			$this->registroBitacora('Id del registro modificado: '.$pieza->id,'Modificar Pieza ',$cambios,'Equipos -> Modificar Pieza');
    			$duplicado->codigo=1;
    		}
		}


		return Response::json($duplicado);
	}

	public function piezasStatus()
	{
		
		$status=[1,0];
		$status_=['HABILITADO','INHABILITADO'];
		$status__=['INHABILITADO','HABILITADO'];
		$registry=Request::get('registry');
		$aux=false;
		///////////// Busqueda del perfil y cambio de status ////////////////////////
		$pieza=Pieza::find($registry);
		$pieza->status=$status[$pieza->status];
		$aux=$pieza->save();
		/////////////////////////////////////////////////////////////////////////////////////////////////////
	    $this->registroBitacora('Pieza: '.$pieza->descripcion,'Cambiar Status','{"Status":"Cambio de: '.$status_[$pieza->status].' a: '.$status__[$pieza->status].'"}','Piezas');
	    /////////////////////////////////////////////////////////////////////////////////////////////////////

		return Response()->json(['update'=>$aux]);
	}






		public function piezasSelect()
		{
			$retorno=null;
			$registry=Request::get('registry');
			$caso=Request::get('caso');
			$auxiliar=Request::get('auxiliar');

			if($caso==0)
			{
				$npieza=Npieza::find($registry);
				$retorno=$npieza->marcas;
			}
			else if($caso==1)
			{
				$retorno=DB::table('modelos')
							->join('modelo_npieza','modelo_npieza.modelo_id','=','modelos.id')
							->join('marca_modelo','marca_modelo.modelo_id','=','modelos.id')
							->where(['modelo_npieza.npieza_id'=>$auxiliar,'marca_modelo.marca_id'=>$registry,'modelos.status'=>1])
							->select('modelos.descripcion AS descripcion','modelos.id AS id ')
							->get();
			}



			return Response::json($retorno);
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

		

		public function aplicacionesStatus()
		{
			$status=[1,0];
			$status_=['HABILITADO','INHABILITADO'];
			$status__=['INHABILITADO','HABILITADO'];
			$registry=Request::get('registry');
			$aux=false;
			///////////// Busqueda del perfil y cambio de status ////////////////////////
			$app=Aplicacion::find($registry);
			$app->status=$status[$app->status];
			$aux=$app->save();
			/////////////////////////////////////////////////////////////////////////////////////////////////////
		    $this->registroBitacora('Aplicacion: '.$app->descripcion,'Cambiar Status','{"Status":"Cambio de: '.$status_[$app->status].' a: '.$status__[$app->status].'"}','Aplicaciones ');
		    /////////////////////////////////////////////////////////////////////////////////////////////////////

			return Response()->json(['update'=>$aux]);
		}

		public function btn_modificar_aplicacion()
		{
			$registry=Request::get('registry');
			$app=Aplicacion::find($registry);

			return Response::json($app);
		}


		public function aplicacionesActualizar()
		{
			$datos=$this->datosAplicacion();
			$duplicado=(object)array('codigo'=>0,'extra'=>0);
			$cambios=array();

			$app=Aplicacion::find($datos->registro);
			$cambio=$this->detectarCambios($datos->nombre,$app->descripcion,'Nombre Aplicacion');
			if($cambio!=null)//si existen cambios
			{
				$aplicaciones=DB::table('aplicaciones')->where(['descripcion'=>$datos->nombre,'equipo_id'=>$app->equipo_id])->first();
				if($aplicaciones!=null)
				{
					$equipo=Equipo::find($app->equipo_id);
					if($equipo!=null)
					{
						$duplicado->codigo=2;
						$duplicado->extra="La aplicacion: ".$aplicaciones->descripcion.' ya se encuentra registrada, para el equipo: '.$equipo->descripcion;
					}
				}
			}

			if($duplicado->codigo==0)
			{
				$cambios=$this->agregarCambios($cambio,$cambios);
				$app->descripcion=$datos->nombre;


				$cambio=$this->detectarCambios($datos->licencia,$app->licencia,'Licencia Aplicacion');
				$cambios=$this->agregarCambios($cambio,$cambios);
				$app->licencia=$datos->licencia;

				$cambio=$this->detectarCambios($datos->version,$app->version,'Version Aplicacion');
				$cambios=$this->agregarCambios($cambio,$cambios);
				$app->version=$datos->version;

				
				$traduccionFor=$this->traducirId($datos->status,10);
				$traduccionBd=$this->traducirId($app->status,10);
				$cambio=$this->detectarCambios($traduccionFor,$traduccionBd,'Version Status');
				$cambios=$this->agregarCambios($cambio,$cambios);

				$cambio=$this->detectarCambios($datos->status,$app->status,'Status');
				$cambios=$this->agregarCambios($cambio,$cambios);
				$app->status=$datos->status;
				$app->save();


				$longitud=count($cambios);
	    		$cambios=$this->documentarCambios($cambios);

	    		if($longitud>0)
	    	 	{

	    			$this->registroBitacora('Id del registro modificado: '.$app->id,'Modificar Aplicacion ',$cambios,'Equipos -> Aplicaciones');
	    			$duplicado->codigo=1;
	    		}
			}
			
			return Response::json($duplicado);
		}



		public function btn_modificar_equipo()
		{
			
			$equip=(object)array('id'=>0,'descripcion'=>0,'tipoequipo'=>0,'marca'=>0,'modelo'=>0,'serial'=>0,'status'=>0,'sucursal_id'=>0);
			$registry=Request::get('_sucursalRegistro');
			$equipo=Equipo::find($registry);

			
			$tipoEquipo=DB::table('tipoequipos')->where('descripcion',$equipo->tipoequipo)->first();
			$marca=DB::table('marcas')->where('descripcion',$equipo->marca)->first();
			$modelo=DB::table('modelos')->where('descripcion',$equipo->modelo)->first();

			/////////////////dependencias///////////////////////////////////
			$te=Tipoequipo::find($tipoEquipo->id);
			$tipoEq=Tipoequipo::all();
			$marcas=$te->marcas;

			$mr=Marca::find($marca->id);
			$modelos=$mr->modelos;

			// ///////////////////////////////////////////////////////////////
			$equip->id=$equipo->id;
			$equip->descripcion=$equipo->descripcion;
			$equip->tipoequipo=$tipoEquipo->id;
			$equip->marca=$marca->id;
			$equip->modelo=$modelo->id;
			$equip->serial=$equipo->serial;
			$equip->status=$equipo->status;
			$equip->sucursal_id=$equipo->sucursal_id;








			return Response::json(['equipo'=>$equip,'tipoequipo'=>$tipoEq,'marcas'=>$marcas,'modelos'=>$modelos]);
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