<?php

namespace App\Http\Controllers;


use Session;
use DB;
use Request;
use App\Perfil;

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


	

	public function datos_vista($datos_session,$datos_acciones,$consulta,$extra=" ",$datosC1=" ",$datosC2=" ",$datosC3=" ",$datosC4=" ")//asocia en un vector los datos que deben pasarse a una vista
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
								'datosC4'=>$datosC4


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
		(['numero'=>$formulario['cedula'],'tipo_id'=>$formulario['tipoCedula']]);

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
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(5,6),7);
		return view('Registros_Basicos\Departamentos\cargos',$this->datos_vista($datos,$acciones,DB::table('cargos')->where('departamento_id',$departamento_id)->get()));
					
	}


	public function departamentos()//ventana principal de departamentos
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(1,2,3),4);
		
		return view('Registros_Basicos\Departamentos\departamentos',$this->datos_vista($datos,$acciones,DB::table('departamentos')->get()));
					
	}




	
	
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////submodulos planes y servicios ////////////////////////////////////////////////////


public function planes_servicios()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(65,66,67),64);
		return view ('Registros_Basicos\PlaneS\planes',$this->datos_vista($datos,$acciones,array()));

		
	}
	



	public function planes_servicios_servicios()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(73,74),72);
		return view ('Registros_Basicos\PlaneS\servicios',$this->datos_vista($datos,$acciones,array()));

		
	}
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////// submodulos empleados /////////////////////////////////////////////////////////////////


public function empleados()
{
	$datos=$this->cargar_header_sidebar_acciones();
	$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(76,77,78),75);
	return view ('Registros_Basicos\empleados\empleados',$this->datos_vista($datos,$acciones,DB::table('empleados')->get()));
}

public function empleados_perfiles($empleado_id)
{
	
	$datos=$this->cargar_header_sidebar_acciones();
	$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(80,81,82),79);
	
	$consulta=DB::table('perfiles')->join('usuarios','perfiles.id','=','usuarios.perfil_id')
								   ->join('empleados','usuarios.id','=','empleados.id')
								   ->select('empleados.nombre As nombreE','empleados.apellido As apellidoE',
								   			'usuarios.n_usuario As usuarioE','usuarios.id As idU','perfiles.id As perfilE')
								   ->where('empleados.id',$empleado_id)->first();
	

	

	
	return view ('Registros_Basicos\empleados\empleados_perfil',$this->datos_vista($datos,$acciones,
						DB::table('perfiles')->get(),
						$consulta->nombreE." ".$consulta->apellidoE,//extra
						$consulta->perfilE,//datosC1
						$consulta->usuarioE,//datosC2
						$consulta->idU//datosC3
						));
}
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////submodulo perfiles///////////////////////////////////////////////////////////////////////

public function perfiles()//ventana perfiles
{
	$datos=$this->cargar_header_sidebar_acciones();
	$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(84,85),83);
	return view('Registros_Basicos\Perfiles\perfiles',$this->datos_vista($datos,$acciones,DB::table('perfiles')->get()));
}


public function perfiles_modificar($perfil_id)
{
	$perfil=Perfil::find($perfil_id);
	$modulos=$perfil->modulos; //trae los modulos asociados a un perfil

	$datos=$this->cargar_header_sidebar_acciones();
	$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(84,85),83);
	return view('Registros_Basicos\Perfiles\perfiles_modificar',$this->datos_vista($datos,$acciones,$modulos,(int)$perfil_id));
}

public function mostrar_submodulos()//muestra los submodulos asociados a un modulo
{
	
	//
	//$submodulos_=array();//submodulos que se mostraran en la vista
	
	$datos=Request::get('valores');//id del perfil para el cual se desea mostrar los submodulos
	//$modulo_id=(int)Request::get('idModulo');//captura el id del modulo
	
	/*$perfil=Perfil::find($datos[0]);//ubica en la base de datos el perfil indicado por $perfil_id

	
	$submodulos=$perfil->submodulos;//captura los submodulos asociados al perfil

	foreach ($submodulos as $submodulo) 
	{
		if($submodulo->modulo_id==$datos[1])
		{
			array_push($submodulos_, $submodulo);//agrega los submodulos asociados al modulo_id
		}
	}*/
	$submodulos_=DB::table('submodulos')->where(['modulo_id'=>$datos[1],'status_sm'=>1,'padre'=>1])->get();

	return $submodulos_;
}


public function mostrar_acciones()
{
	$acciones_=array();
	$datos=Request::get('valoresAcc');
	//$perfil_id=(int)Request::get('idPerfil');
	$acciones_=DB::table('acciones')->where('submodulo_id',$datos[1])->get();
	/*$submodulo_id=(int)Request::get('idSubmodulo');
	$perfil=Perfil::find($perfil_id);
	$acciones=$perfil->acciones;

	foreach($acciones as $accion)
	{
		if($accion->submodulo_id==$submodulo_id)
		{
			array_push($acciones_, $accion);
		}

	}*/

  return $acciones_;
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
															 'codigoL'=>$codigoL



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
							['numero'=>$numeroR,'tipo_id'=>$tipoR]
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


public function clientes_categoria($cliente_id)//listar categorias
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(16,17,18,19),20);
		return view ('Registros_Basicos\Clientes\clientes_categoria',$this->datos_vista($datos,$acciones,DB::table('categorias')->where('cliente_id',$cliente_id)->get(),$cliente_id));
						
	}

	
	
	

	public function clientes_categoria_agregar($id_cliente)///asociar categorias a un cliente matriz
	{
		$id=(int)$id_cliente;
		$nombreC=strtoupper(Request::get('nomCat'));//nombre de la categoria en mayusculas
		$statusC=(int)Request::get('stCat');//status de la categoria
		

		if(empty(DB::table('categorias')->where(['categorias.nombre'=>$nombreC,'categorias.cliente_id'=>$id_cliente])->first())==true)//si no existe
		{

			DB::table('categorias')->insert
			(['nombre'=>$nombreC,'status_c'=>$statusC,'cliente_id'=>$id]);
			
		}
		return redirect('/menu/registros/clientes/categoria/'.(string)$id);

						
	}
	
	
	public function clientes_categorias_modificar()//carga datos al modal modificar categoria
	{
		$categoria_id=(int)Request::get('idCategoria');
		$categorias=DB::table('categorias')->where('id',$categoria_id)->first();//buscar categoria por id
		return array($categorias->nombre,$categorias->status_c,$categorias->cliente_id);
		
	}

	public function clientes_categorias_actualizar($cliente_id)//actualiza los datos de una categoria en la base de datos
	{
		$nombreC=Request::get('nomCat');
		$statusC=(int)Request::get('stCat');
		$categoria_id=(int)Request::get('Categoriaid');

		DB::table('categorias')->where('id',$categoria_id)->update(['nombre'=>$nombreC,'status_c'=>$statusC]);

		return redirect('/menu/registros/clientes/categoria/'.(string)$cliente_id);
	}
	
	
	
	public function clientes_categoria_responsable($categoria_id)//listar responsables de una categoria
	{
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
		return view ('Registros_Basicos\Clientes\clientes_categoria_responsable',$this->datos_vista($datos,$acciones,DB::table('categorias')->join('clientes','clientes.id','=','categorias.cliente_id')
								   ->join('personas','personas.cliente_id','=','clientes.id')
								   ->select('personas.id','personas.p_nombre','personas.p_apellido')
								   ->where('categorias.id','=',$categoria_id)->get(),
								   $id,
								   $categoria_id,
								   DB::table('tipos')->where('numero_c',5)->get(),//tipos de cedula $datosC2
								   DB::table('tipos')->where('numero_c',2)->get(),//tipos de codigo de celular $datosC3
								   DB::table('tipos')->where('numero_c',3)->get()));//tipos dle codigos loca
						
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



	public function clientes_sucursales($categoria_id)//lista las sucursales asociadas a un cliente matriz
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
															 'categoriaId'=>$categoria_id]);

						
	}


	public function clientes_sucursales_responsable()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(32,33),31);
		return view ('Registros_Basicos\Clientes\clientes_sucursales_responsable',$this->datos_vista($datos,$acciones,array()));
						
	}

	public function clientes_sucursales_plan()
		{
			$datos=$this->cargar_header_sidebar_acciones();
			$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(35,36,37),34);
			return view ('Registros_Basicos\Clientes\clientes_sucursales_plan',$this->datos_vista($datos,$acciones,array()));
							
		}
		

	public function clientes_sucursales_plan_servicios()
		{
			$datos=$this->cargar_header_sidebar_acciones();
			$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(40,39),38);
			return view ('Registros_Basicos\Clientes\clientes_sucursales_plan_servicios',$this->datos_vista($datos,$acciones,array()));
							
		}


	public function clientes_sucursales_equipos()//
		{
			$datos=$this->cargar_header_sidebar_acciones();
			$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(42,43,44),41);
			return view ('Registros_Basicos\Clientes\clientes_sucursales_equipos',$this->datos_vista($datos,$acciones,array()));
							
		}

	public function clientes_sucursales_equipos_componentes()
		{
			$datos=$this->cargar_header_sidebar_acciones();
			$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(46,47,48,49),45);
			return view ('Registros_Basicos\Clientes\clientes_sucursales_equipos_componentes',$this->datos_vista($datos,$acciones,array()));
							
		}

	public function clientes_sucursales_equipos_aplicaciones()//crear formulario
		{
			$datos=$this->cargar_header_sidebar_acciones();
			$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(51,52),50);
			return view ('Registros_Basicos\Clientes\clientes_sucursales_equipos_componentes_aplicaciones',$this->datos_vista($datos,$acciones,array()));
							
		}
	
		public function clientes_sucursales_equipos_piezas()//crear formulario
		{
			$datos=$this->cargar_header_sidebar_acciones();
			$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(54,55),53);
			return view ('Registros_Basicos\Clientes\clientes_sucursales_equipos_componentes_piezas',$this->datos_vista($datos,$acciones,array()));
							
		}


		public function clientes_sucursales_usuarios()
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


	
	
	


	
	



	




	


	











}
