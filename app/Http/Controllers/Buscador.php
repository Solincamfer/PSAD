<?php

namespace App\Http\Controllers;


use Session;
use DB;
use Request;
use App\Perfil;
use App\Horario;

class Buscador extends Controller
{
	public function acciones_sub($submodulo_id,$vista)
	{
		
		$acc_=array();
		$acciones_sub=DB::table('acciones')->where(['submodulo_id'=>$submodulo_id,'vista'=>$vista])->get();//obtiene las acciones para una vista
		
		foreach($acciones_sub as $acc) 
		{
			array_push($acc_, $acc->id);
		}
		return($acc_);
	}

	public function cargar_acciones_sub_per($acciones_perfil,$acciones_sm)//obtiene las acciones para un submodulo, asociadas a un perfil
	{
		

		$acciones=array();
		$agregar=false;


		foreach ($acciones_perfil as $accion) 
			{
				if((in_array($accion->id, $acciones_sm) )and ($accion->status_ac==1))
				{
					array_push($acciones, $accion);
				}
				
			}
        return(compact('acciones'));

	}


	public function buscarRegistros()
	{
		/////////obtener patron tabla, vista y submodulo donde se activo el buscador ///////////////////
		$datos=array('cargos','b','2','2');
		//$datos=Request::get('datos');
		$patron='%'.$datos[1].'%';
		$tabla=$datos[0];
		$submodulo=(integer)$datos[2];//obtiene el submodulop al cual pertenece la vista
		$vista=(integer)$datos[3];//obtiene la vista donde se activo el buscador
		////////////////////////////////////////////////////////////////////////////////////////

		//////////////////acciones pertenecientes a un submodulo ///////////////////////////////

		$acciones=Session::get('acciones');
		$acciones=$acciones[0];
		$acS=$this->acciones_sub($submodulo,$vista);
		$acciones=$this->cargar_acciones_sub_per($acciones,$acS);
		///////////////////////////////////////////////////////////////////////////////////////////////////////////

		
		
		
		$campos=array("cargos"=>"descripcion");

		$conId=$tabla.'.id as id';//seleccionar id
		$conDes=$tabla.'.'.$campos[$tabla].' '.'as descripcion';//seleccionar descripcion

		$consulta=DB::table($tabla)->select($conId,$conDes)->where($campos[$tabla],'like',$patron)->get();

		return([$acciones]);
	}



	public function prueba_metodo($registryId=6)
	{

		
		// /////////////////traer datos del empleado desde la base de datos ///////////////////////////////////////////
		// $registry=DB::table('empleados')->join('cedulas','empleados.cedula_id','=','cedulas.id')
		// 								->join('tipos','cedulas.tipo_id','=','tipos.id')
		// 								->join('rifs','empleados.rif_id','=','rifs.id')
		// 								->join('departamentos','empleados.departamento_id','=','departamentos.id')
		// 								->join('cargos','empleados.cargo_id','=','cargos.id')
		// 								->join('usuarios','empleados.usuario_id','=','usuarios.id')
		// 								->join('contactos','empleados.contacto_id','=','contactos.id')
		// 								->join('direcciones','empleados.direccion_id','=','direcciones.id')
										
		// 								->join('municipios','direcciones.municipio_id','=','municipios.id')
		// 								->join('regiones','direcciones.region_id','=','regiones.id')
		// 								->join('estados','direcciones.estado_id','=','estados.id')
		// 								->join('paises','direcciones.pais_id','=','paises.id')
		// 								->select(	'empleados.id AS empleadoId',
		// 											'empleados.contacto_id AS contactoId',
		// 											'empleados.nombre AS primerNombre',
		// 											'empleados.nombre_ AS segundoNombre',
		// 										 	'empleados.apellido AS primerApellido',
		// 										 	'empleados.apellido_ AS segundoApellido',
		// 										 	'empleados.fechaN AS fechaNacimiento',
		// 										 	'cedulas.numero AS numeroCedula',
		// 										 	'cedulas.rol AS rol',
		// 										 	'tipos.descripcion AS tipoCedula',
		// 										 	'tipos.id AS tipoCedulaId',
		// 										 	'departamentos.descripcion AS nombreDepartamento',
		// 										 	'departamentos.id AS departamentoId',
		// 										 	'cargos.descripcion AS nombreCargo',
		// 										 	'cargos.id AS cargoId',
		// 										 	'usuarios.n_usuario AS nombreUsuario','usuarios.clave AS claveUsuario',
		// 										 	'usuarios.status AS statusUsuario',
		// 										 	'contactos.correo AS correoUsuario',
		// 										 	'paises.id AS paisId',
		// 										 	'paises.descripcion AS nombrePais',
		// 										     'estados.id AS estadoId',
		// 										     'estados.descripcion AS nombreEstado',
		// 										 	 'municipios.id AS municipioId',
		// 										 	 'municipios.descripcion AS nombreMunicipio',
		// 										 	 'regiones.id AS regionId',
		// 										 	 'regiones.descripcion AS nombreRegion',
		// 										 	 'direcciones.descripcion AS descripcionDireccion',
		// 										 	 'empleados.rif_id AS rifId')
		// 								->where('empleados.id',$registryId)->first();


		// $rif=DB::table('rifs')->join('tipos','rifs.tipo_id','=','tipos.id')
		// 					  ->select('rifs.numero AS numeroRif','tipos.descripcion AS tipoRif')
		// 					  ->where('rifs.id',$registry->rifId)->first();
							 
		// $telfL=DB::table('contactos')->join('tipos','tipos.id','contactos.tipo__id')
		// 							 ->select('tipos.descripcion AS codigoTelefonoFijo','contactos.telefono_f AS telefonoLocal','tipos.id AS fijCodigo')
		// 							 ->where('contactos.id',$registry->contactoId)->first();

		// $telfC=DB::table('contactos')->join('tipos','tipos.id','contactos.tipo_id')
		// 							 ->select('tipos.descripcion AS codigoTelefonoCelular','contactos.telefono_m AS telefonoCelular','tipos.id AS celCodigoId')
		// 							 ->where('contactos.id',$registry->contactoId)->first();


	
		
		

		// $data = array('primerNombre' =>$registry->primerNombre,'segundoNombre'=>$registry->segundoNombre,
		// 			  'primerApellido'=>$registry->primerApellido,'segundoApellido'=>$registry->segundoApellido,
		// 			  'fechaNacimiento'=>$registry->fechaNacimiento,'tipoCedulaId'=>$registry->tipoCedulaId,
		// 			  'tipoCedula'=>$registry->tipoCedula,'numeroCedula'=>$registry->numeroCedula,
		// 			  'departamentoId'=>$registry->departamentoId,'nombreDepartamento'=>$registry->nombreDepartamento,
		// 			  'cargoId'=>$registry->cargoId,'nombreCargo'=>$registry->nombreCargo,
		// 			  'nombreUsuario'=>$registry->nombreUsuario,'claveUsuario'=>$registry->claveUsuario,
		// 			  'statusUsuario'=>$registry->statusUsuario,'correoUsuario'=>$registry->correoUsuario,
		// 			  'paisId'=>$registry->paisId,'nombrePais'=>$registry->nombrePais,
		// 			  'estadoId'=>$registry->estadoId,'nombreEstado'=>$registry->nombreEstado,
		// 			  'municipioId'=>$registry->municipioId,'nombreMunicipio'=>$registry->nombreMunicipio,
		// 			  'regionId'=>$registry->regionId,'nombreRegion'=>$registry->nombreRegion,
		// 			  'descripcionDireccion'=>$registry->descripcionDireccion,'rifId'=>$registry->rifId,
		// 			  'numeroRif' =>$rif->numeroRif,'tipoRif'=>$rif->tipoRif,
		// 			  'tipoCodigoCel'=>$telfC->celCodigoId,'codigoCel'=>$telfC->codigoTelefonoCelular,
		// 			  'numeroCel'=>$telfC->telefonoCelular,'tipoCodigoFij'=>$telfL->fijCodigo,
		// 			  'codigoFij'=>$telfL->codigoTelefonoFijo,'telefonoLocal'=>$telfL->telefonoLocal);

		// //$data=json_encode($data);
		// dd($data);
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

		// 0 id cliente/ 1 razonS /2 nombreC /3 numeroRif / 4 tipo Rif / 5 tipo codigoCelular 
		//  6 numero Celular / 7 codigo telefono local / 8 numero de telefono local /9 correo 
		//10 id tipo contirbuyente/11 descripcion tipo de contribuyente
		//12 paisidF /13 paisF/14 regionidF/15 regionF /16 estadoidF/17 estadoF /18 municipioidF/19 municipio F/20 iddireccionF/21 direccionF
		//22 paisidC /23 paisC/24 regionidC/25 regionC /26 estadoidC/27 estadoC /28 municipioidC/29 municipioC /30 iddireccionC/31 direccionC


		$data= array(
						'razonS'=>$cliente->razonS,'nombreC'=>$cliente->nombreC,
						'numeroRif'=>$cliente->numeroR,'tipoRif'=>$cliente->tipoR,
						'codigoCelular'=>$cliente->codigoC,'telefonoCelular'=>$cliente->telefonoC,
						'codigoLocal'=>$cliente->codigoL,'telefonoFijo'=>$cliente->telefonoF,
						'correoUsuario'=>$cliente->correo,'idTipoContribuyento'=>$cliente->idtipoContribuyente,
						'tipoContribuyente'=>$cliente->Contribuyente,'paisId'=>$direccionF->idpaisF,
						'paisFiscal'=>$direccionF->paisF,'regionIdF'=>$direccionF->idregionF,
						'regionFiscal'=>$direccionF->regionF,'estadoIdF'=>$direccionF->idestadoF,
						'estadoF'=>$direccionF->estadoF,'municipioidF'=>$direccionF->idmunicipioF,
						'municipiosF'=>$direccionF->municipiosF,'direccionIdFiscal'=>$direccionF->iddireccionF,
						'direccionIdFiscal'=>$direccionF->direccionF,'paisIdC'=>$direccionC->idpaisC,'paisC'=>$direccionC->paisC,'regionIdC'=>$direccionC->idregionC,'regionC'=>$direccionC->regionC,
						'estadoidC'=>$direccionC->idestadoC,'estadoC'=>$direccionC->estadoC,
						'municipioIdC'=>$direccionC->idmunicipioC,'municipiosC'=>$direccionC->municipiosC,
						'direcionIdC'=>$direccionC->iddireccionC,'direccionC'=>$direccionC->direccionC);

		//$data=json_encode($data);
		
		dd($data);
	
	}
}
