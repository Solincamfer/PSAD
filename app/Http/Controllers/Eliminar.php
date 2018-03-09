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
use App\MarcaTipoEquipo;
use App\ModeloTipoEquipo;
use App\MarcaModelo;
use App\MarcaNcomponente;
use App\ModeloNcomponente;
use Response;

class Eliminar extends Controller
{
   

////////////////Metodos usados por otros//////////////////////////////

 public function eliminarSucursal_($sucursal_id)
    {
    	$retorno=0;
    	$sucursal=Sucursal::find($sucursal_id);
    	/////////////capturar los datos FK////////////////////////////////////////////////

    	$rif=Rif::find($sucursal->rif_id);
    	$direccionFiscal=Direccion::find($sucursal->direccionFiscal_id);
    	$direccionComercial=Direccion::find($sucursal->direccionComercial_id);
    	$correo=Correo::find($sucursal->correo_id);

    	///////////////////////Obtener los equipos asociados a una sucursal ///////////
    	$equipos=DB::table('equipos')->where('sucursal_id',$sucursal->id)->get();
    	//////////////////////////////////////////////////////////////////////////////

    	//////////////////////Eliminar los equipos asociados a una sucursal //////////
    	$equip=0;
    	foreach ($equipos as $equipo) 
    	{
    		$equip=$equip+$this->eliminarEquipo_($equipo->id);
    	}

    	// //////////////////////////////////////////////////////////////////////////////

    	////////////////////eliminar los datos de telefono////////////////////////////
    	$telefonos=DB::table('sucursal_telefono')->where('sucursal_id',$sucursal->id)->get();

    	foreach ($telefonos as $telefono) 
    	{
    		DB::table('telefonos')->where('id',$telefono->telefono_id)->delete();
    		DB::table('sucursal_telefono')->where('id',$telefono->id)->delete();
    	}

    	// ///////////////////eliminar asociacion con personas /////////////////////////////
    	DB::table('persona_sucursal')->where('sucursal_id',$sucursal->id)->delete();

    	//////////////////eliminar asociacion con planes    ////////////////////////////
    	DB::table('plan_sucursal')->where('sucursal_id',$sucursal->id)->delete();
    	/////////////////eliminar sucursal////////////////////////////////////////////
    	$delete=$sucursal->delete();

    	////////////////eliminar resto de datos///////////////////////////
    	$rif->delete();
    	$correo->delete();
    	$direccionComercial->delete();
    	$direccionFiscal->delete();

    	if($delete)
    	{
    		$retorno=1;
    	}

    	return $retorno;


    }


public function eliminarPersona($persona_id)
{
	$retorno=0;
	$persona=Persona::find($persona_id);
	$correo_id=$persona->correo_id;
	$cedula_id=$persona->cedula_id;

	////////////Eliminar datos de telefono///////////////////////
	$telefonos=DB::table('persona_telefono')->where('persona_id',$persona_id)->get();
	foreach ($telefonos as $telefono) 
	{
		DB::table('telefonos')->where('id',$telefono->telefono_id)->delete();
		DB::table('persona_telefono')->where('id',$telefono->id)->delete();
	}
	//////////////eliminar asociaciones a una categoria y a una sucursal ///////////////////////////
		DB::table('categoria_persona')->where('persona_id',$persona->id)->delete();
		DB::table('persona_sucursal')->where('persona_id',$persona->id)->delete();
	////////////////////////////////////////////////////////////////////////////////////////////////

	/////////////////////////////Eliminar el registro de la persona ////////////////////////////////
	$delete=$persona->delete();
	////////////////////////////////////////////////////////////////////////////////////////////////
	$deleteCorreo=Correo::find($correo_id);
	$deleteCedula=Cedula::find($cedula_id);

	$deleteCorreo->delete();
	$deleteCedula->delete();
	///////////////////////////////////////////////////////////////////////////////////////////////

	if(($delete && $deleteCorreo)&&($deleteCedula))
	{
		$retorno=1;
	}

	return $retorno;

}

public function eliminarEquipo_($equipo_id)
{
	$retorno=0;
	$equipo=Equipo::find($equipo_id);
	
	////////////obtener componentes del equipo ///////////////////////////////////////
		$componentes=DB::table('componentes')->where('equipo_id',$equipo->id)->get();
	///////////eliminar las piezas del componente ///////////////////////////////////
		foreach ($componentes as $componente ) 
		{
			//////////eliminar piezas del componente //////////////////////////////
			DB::table('piezas')->where('componente_id',$componente->id)->delete();
			/////////eliminar componente //////////////////////////////////////////

			$cmp=Componente::find($componente->id);
			$cmp->delete();
		}
	/////////eliminar las aplicaciones que posee el equipo/////////////////////////
		DB::table('aplicaciones')->where('equipo_id',$equipo->id)->delete();
	///////////////////////////////////////////////////////////////////////////////

	$update=$equipo->delete();
	//////////////////////////////////////////////////////////////////////////////


	if($update)
	{
		$retorno=1;
	}

	return $retorno;

}

////////////////Metodos individuales /////////////////////////////////

    public function eliminarAplicacion()
    {
    	
    	$retorno=0;
    	$aplicacion=Request::get('registry');
    	$registro=Aplicacion::find($aplicacion);
    	$delete=$registro->delete();
    	if($delete)
    	{
    		$retorno=1;
    	}

    	return Response::json($retorno);


    }


    public function eliminarPieza()
    {

    	$retorno=0;
    	$pieza=Request::get('registry');
    	$registro=Pieza::find($pieza);
    	$delete=$registro->delete();
    	if($delete)
    	{
    		$retorno=1;
    	}

    	return Response::json($retorno);

    }

    public function eliminarComponente()
    {
    	$retorno=0;
    	$componente=Request::get('registry');
    	$registro=Componente::find($componente);

    	////////////////////eliminar piezas asociadas /////////////////////////////////////////////
    		$piezas=DB::table('piezas')->where('componente_id',$registro->id)->delete();
    	/////////////////////////////////////////////////////////////////////////////////

    	$update=$registro->delete();
    	if($update)
    	{
    		$retorno=1;
    	}

    	return Response::json($retorno);
    }


    public function eliminarEquipo()
    {
    	
    	$equipo=Request::get('registry');
    	$retorno=$this->eliminarEquipo_($equipo);
    	return Response::json($retorno);

    }



    public function eliminarRespSuc()
    {
    	$persona=Request::get('registry');
    	$retorno=$this->eliminarPersona($persona);

    	return Response::json($retorno);
    }


   

    public function eliminarSucursal()
    {
    	$sucursal=Request::get('registry');
    	$retorno=$this->eliminarSucursal_($sucursal);

    	return Response::json($retorno);
    }




}
