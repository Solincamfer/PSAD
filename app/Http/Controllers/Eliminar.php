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
use App\Tipo;
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

public function registrarBitacora($registry,$accion,$detalles,$ventana,$submodulo=0,$operacion=0)
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
    $bitacora->submodulo=$submodulo;
    $bitacora->operacion=$operacion;

     return $bitacora->save();

}

public function eliminarCliente_($cliente_id)
{
    $retorno=0;
    $cliente=Cliente::find($cliente_id);
    $rif=Rif::find($cliente->rif_id);
    $direccionFiscal=Direccion::find($cliente->direccionFiscal_id);
    $direccionComercial=Direccion::find($cliente->direccionComercial_id);
    $correo=Correo::find($cliente->correo_id);

    $categorias=DB::table('categorias')->where('cliente_id',$cliente->id)->get();
    $personas=DB::table('personas')->where('cliente_id',$cliente->id)->get();
    $telefonos=DB::table('cliente_telefono')->where('cliente_id',$cliente->id)->get();

    /////////////////eliminar personas///////////////////////////////////////////
    if(count($personas)>0)
    {
        foreach ($personas as $persona) 
        {
            $this->eliminarPersona($persona->id);
        }
    }

    //////////////eliminar categorias /////////////////////////////////////////////


    if(count($categorias)>0)
    {
        foreach ($categorias as $categoria) 
        {
            $this->eliminarCategoria_($categoria->id);
        }
    }

    //////////////////////////////eliminar telefonos////////////////////////////////
    if(count($telefonos)>0)
    {
        foreach ($telefonos as $telefono) 
        {
          
             DB::table('telefonos')->where('id',$telefono->telefono_id)->delete();
             DB::table('cliente_telefono')->where('id',$telefono->id)->delete();
        }
    }

    ///////////////////////////eliminar cliente ////////////////////////////////////
    $delete=$cliente->delete();
    //////////////////////////eliminar resto de datos del cliente//////////////////

    $rif->delete();
    $direccionFiscal->delete();
    $direccionComercial->delete();
    $correo->delete();

    if($delete)
    {
        $retorno=1;
    }


    return $retorno;

}

 public function eliminarCategoria_($categoria_id)
    {
        $retorno=0;
        $categoria=Categoria::find($categoria_id);
        $sucursales=DB::table('sucursales')->where('categoria_id',$categoria->id)->get();
        //////////////////eliminar sucursales///////////////////////////////////////////
        if (count($sucursales)>0) 
        {
            
                foreach ($sucursales as $sucursal) 
                {
                    $this->eliminarSucursal_($sucursal->id);
                }
        }
        ////////////////////////////////////////////////////////////////////////////////

        /////////////////limpiar asociaciones con personas//////////////////////////////
        DB::table('categoria_persona')->where('categoria_id',$categoria->id)->delete();
        /////////////////Eliminar categoria////////////////////////////////////////////
        $delete=$categoria->delete();

        if($delete){$retorno=1;}

        return $retorno;

    }

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
    	if (count($equipos)>0) 
        {
           
        	foreach ($equipos as $equipo) 
        	{
        		$this->eliminarEquipo_($equipo->id);
        	}
        }

    	// //////////////////////////////////////////////////////////////////////////////

    	////////////////////eliminar los datos de telefono////////////////////////////
    	$telefonos=DB::table('sucursal_telefono')->where('sucursal_id',$sucursal->id)->get();
        if (count($telefonos)>0) 
        {
           	foreach ($telefonos as $telefono) 
        	{
        		DB::table('telefonos')->where('id',$telefono->telefono_id)->delete();
        		DB::table('sucursal_telefono')->where('id',$telefono->id)->delete();
        	}
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
    if(count($telefonos)>0) 
    {
        
    	foreach ($telefonos as $telefono) 
    	{
    		DB::table('telefonos')->where('id',$telefono->telefono_id)->delete();
    		DB::table('persona_telefono')->where('id',$telefono->id)->delete();
    	}
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
    if(count($componentes))	
    {	
        foreach ($componentes as $componente ) 
    		{
    			//////////eliminar piezas del componente //////////////////////////////
    			DB::table('piezas')->where('componente_id',$componente->id)->delete();
    			/////////eliminar componente //////////////////////////////////////////

    			$cmp=Componente::find($componente->id);
    			$cmp->delete();
    		}
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


    public function eliminarRespCat()
    {
        $persona=Request::get('registry');
        $retorno=$this->eliminarPersona($persona);

        return Response::json($retorno);
    }

    public function eliminarRespClie()
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


   

    public function eliminarCategoria()
    {
    	$categoria=Request::get('registry');
    	$retorno=$this->eliminarCategoria_($categoria);

    	return Response::json($retorno);
    }

    public function eliminarCliente()
    {
        $cliente=Request::get('registry');
        $retorno=$this->eliminarCliente_($cliente);

        return Response::json($retorno);
    }


    public function eliminarPerfil()
    {
            $duplicado=(object)array('codigo'=>0,'extra'=>0);
            $perfil=Request::get('registry');
            $consulta=DB::table('usuarios')->where('perfil_id',$perfil)->first();
            if($consulta!=null)
            {
                $duplicado->codigo=2;
                $duplicado->extra='Se encuetra asociado al menos al usuario: '.$consulta->n_usuario;
            }
            else
            {
                $perfil=Perfil::find($perfil);
                $perfil_=$perfil;
                /////Elimina las tablas intermedias///////////////////////////////////////////
                $consultarAcciones=DB::table('accion_perfil')->where('perfil_id',$perfil->id)->delete();
                $consultaSubmodulos=DB::table('perfil_submodulo')->where('perfil_id',$perfil->id)->delete();
                $consultaModulos=DB::table('modulo_perfil')->where('perfil_id',$perfil->id)->delete();
                //////////Eliminar el perfil///////////////
                $delete=$perfil->delete();
                if($delete)
                {
                    $duplicado->codigo=1;
                    $this->registrarBitacora('Id del registro eliminado: '.$perfil_->id,'Eliminar Perfil','{"Elimino el perfil":'.'"'.$perfil_->descripcion.'"'.'}','Perfiles - Perfil',5,4);
                }
            }

            return Response::json($duplicado);
    }

    public function eliminarPlan()
    {
            $duplicado=(object)array('codigo'=>0,'extra'=>0);
            $plan=Request::get('registry');
            $consulta=DB::table('plan_sucursal')->where('plan_id',$plan)->first();
            if($consulta!=null)
            {
                $sucursal=DB::table('sucursales')->where('id',$consulta->sucursal_id)->first();
                $duplicado->codigo=2;
                $duplicado->extra='Se encuetra asociado al menos a la sucursal: '.$sucursal->nombreComercial;
            }
            else
            {
                $plan=Plan::find($plan);
                ///Elimina las tablas intermedias///////////////////////////////////////////
                $consultarAsoc=DB::table('plan_sucursal')->where('plan_id',$plan->id)->delete();
              
                //////////Eliminar el perfil///////////////
                $delete=$plan->delete();
                if($delete)
                {
                    $duplicado->codigo=1;
                }
            }

            return Response::json($duplicado);
    }

    public function eliminarEmpleado()
    {
        $retorno=0;
        $registry=Request::get('registry');
        $empleado=Empleado::find($registry);

        //////obtiene los datos de cedula, rif,correo y direccion
        $cedula=Cedula::find($empleado->cedula_id);
        $rif=Rif::find($empleado->rif_id);
        $correo=Correo::find($empleado->correo_id);
        $direccion=Direccion::find($empleado->direccion_id);

        /////obtiene los datos del usuario y los borra ////////////////////////////////////
        $empUsuario=DB::table('empleado_usuario')->where('empleado_id',$registry)->first();
        if($empUsuario!=null)
        {
                $usuario=Usuario::find($empUsuario->usuario_id);
                $usuario->delete();
                DB::table('empleado_usuario')->where('id',$empUsuario->id)->delete();
        }

        /////obtiene los datos del telefono y los elimina /////////////////////////////////
        $datosTelf=DB::table('empleado_telefono')->where('empleado_id',$registry)->get();
        foreach ($datosTelf as $telefono) 
        {
            DB::table('telefonos')->where('id',$telefono->telefono_id)->delete();
            DB::table('empleado_telefono')->where('id',$telefono->id)->delete();
        }

        //////Eliminar empleado
        $empleado_=$empleado; 
        $delete=$empleado->delete();
        ////Eliminar datos de cedula, rif, correo y direccion/////////////
        $cedula->delete();
        $rif->delete();
        $correo->delete();
        $direccion->delete();

        if($delete)
        {
            $retorno=1;
             $this->registrarBitacora('Id del registro eliminado: '.$empleado_->id,'Eliminar Empleado','{"Elimino al empleado":'.'"'.$empleado_->primerNombre.' '.$empleado_->primerApellido.'"}','Empleados - Empleado',6,4);
        }

        return Response::json(['codigo'=>$retorno]);
    }



}
