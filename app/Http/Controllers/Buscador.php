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
use App\Region;
use App\Estado;
use App\Municipio;

use Response;
use App\Departamento;

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



	public function prueba_metodo()
	{

		
// 		//DB::table('modulo_perfil')->insert(['perfil_id'=>24,'modulo_id'=>5]);
// 		DB::table('perfil_submodulo')->insert(['perfil_id'=>24,'submodulo_id'=>15]);

// 	///////////agregar modulo y submodulo de Bitacoras 
// 		//  $empleado=Empleado::where('id',23)->first();

// 		// $verificarCedula=DB::table('cedulas')->where(['numero'=>'19438374','rol'=>'EMPLEADO','tipo_id'=>14])->where('id','<>',35)->first();
// 		// dd(($empleado));


//  //       //////////////////////////////////////////////// Rutina para eliminar a un empleado y a todos sus interdependencias /////////////////////////
// 	// 	$empleados=Empleado::all();

// 	// 	foreach ($empleados as $empleado) 
// 	// 	{
			
// 	// 		$empUsuario=DB::table('empleado_usuario')->where('empleado_id',$empleado->id)->first();
// 	// 		DB::table('empleado_usuario')->where('empleado_id',$empleado->id)->delete();//eliminar registro empleado usuario
// 	// 		DB::table('usuarios')->where('id',$empUsuario->usuario_id)->delete();//eliminar el usuario del empleado

// 	// 		$empTelefono=DB::table('empleado_telefono')->where('empleado_id',$empleado->id)->get();//captura id del empleado y sus telefonos asociados

// 	// 		foreach ($empTelefono as $empT) 
// 	// 		{
// 	// 			DB::table('empleado_telefono')->where('empleado_id',$empT->empleado_id)->delete();// eliminar el registro de la 
// 	// 			DB::table('telefonos')->where('id',$empT->telefono_id)->delete();//eliminar el telefono
// 	// 		}

// 	// 		$empDelete=DB::table('empleados')->where('id',$empT->empleado_id)->delete();//eliminar el empleado


// 	// 		DB::table('cedulas')->where('id',$empleado->cedula_id)->delete();
// 	// 		DB::table('rifs')->where('id',$empleado->rif_id)->delete();
// 	// 		DB::table('correos')->where('id',$empleado->correo_id)->delete();
// 	// 		DB::table('direcciones')->where('id',$empleado->direccion_id)->delete();

// 	// // ///////////////////////////// fin de la rutina para eliminar empleados ///////////////////////////////////////////////////////////////












// 	// 	 }

		
		

	
// =======
// 	       $departamentos=new Departamento;
// 			$departamentos->descripcion="vincen";
// 			$departamentos->status=1;
// 			$departamentos->director_id=0;
// 			$departamentos->save();
// >>>>>>> origin/master
// 	}






}
