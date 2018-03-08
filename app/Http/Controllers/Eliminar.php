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



}
