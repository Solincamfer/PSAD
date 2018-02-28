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
use Response;

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

				$persona_id=1;
				$tipo=0;

				$telefono=DB::table('persona_telefono')
					->join('telefonos','telefonos.id','=','persona_telefono.telefono_id')
					->where(['telefonos.tipo'=>$tipo,'persona_telefono.persona_id'=>$persona_id])
					->select('telefonos.id AS id ')->first();;
				return Response::json($telefono);

				

			}

}
