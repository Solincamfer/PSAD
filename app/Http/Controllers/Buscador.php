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



	public function prueba_metodo($registryId=1)
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
		                                     			  'regiones.id AS regionId','regiones.descripcion AS region','paises.id AS paisId','paises.descripcion AS pais')
		                                         ->where('direcciones.id',$sucursal->idDireccionFiscal)
		                                         ->first();


		$direccionComercial=DB::table('direcciones')->join('municipios','direcciones.municipio_id','=','municipios.id')
		                                         ->join('regiones','direcciones.region_id','=','regiones.id')
		                                         ->join('estados','direcciones.estado_id','=','estados.id')
		                                         ->join('paises','direcciones.pais_id','=','paises.id')
		                                         ->select('municipios.id AS municipioId','municipios.descripcion AS municipio',
		                                     			  'estados.id AS estadoid','estados.descripcion AS estado',
		                                     			  'regiones.id AS regionId','regiones.descripcion AS region','paises.id AS paisId','paises.descripcion AS pais')
		                                         ->where('direcciones.id',$sucursal->idDireccionComercial)
		                                         ->first();

		 $celularCorr=DB::table('contactos')->join('tipos','contactos.tipo_id','=','tipos.id')
                                         ->select('contactos.correo AS correousuario','tipos.descripcion AS codigoCel','tipos.id AS codigoCelid','contactos.telefono_m AS celular')
		                                 ->where('contactos.id',$sucursal->contactoId)
		 							     ->first();

		$fijo=DB::table('contactos')->join('tipos','contactos.tipo__id','=','tipos.id')
								    ->select('contactos.telefono_f AS telefonoLocal','tipos.descripcion AS codigoFij',
								    	     'tipos.id AS codigoFijId')->first();


		
		



		$data=array(
					"razonsocial"=>$sucursal->razonS,
					"nombreC",=>$sucursal->nombreC,
					"tiporif"=>$rif->tipoRif,
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
					"direccionF"=>$direccionFiscal->,
					""=>,
					""=>,
					""=>,
					""=>,
					""=>,
					""=>);
	
	}
}
