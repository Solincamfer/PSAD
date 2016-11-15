<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;


class RegistrosBasicos extends Controller 
{
    
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




	public function departamentos_cargos($departamento_id)//Inicializacion del submodulo: /departamentos/cargos
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(5,6),7);

		$cargos=DB::table('cargos')->where('departamento_id',$departamento_id)->get();

		return view('cargos',
					['modulos'=>$datos['modulos'],
					 'submodulos'=>$datos['submodulos'],
					 'nombre'=>$datos['nombre'],
					 'apellido'=>$datos['apellido'],
					 'cargos'=>$cargos,
					 'acciones'=>$acciones['acciones'],
					 'agregar'=>$acciones['agregar']
					 ]
					 );
	}



	public function departamentos()//Inicializacion del submodulo: /departamentos
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(1,2,3),4);
		$departamentos=DB::table('departamentos')->get();

		return view('departamentos',
					[
					 'modulos'=>$datos['modulos'],
					 'submodulos'=>$datos['submodulos'],
					 'acciones'=>$acciones['acciones'],
					 'nombre'=>$datos['nombre'],
					 'apellido'=>$datos['apellido'],
					 'departamentos'=>$departamentos,
					 'agregar'=>$acciones['agregar']
					 ]
					 );
	}



	public function servicios()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view('planes', 
					[
					 'modulos'=>$datos['modulos'],
					 'submodulos'=>$datos['submodulos'],
					 'nombre'=>$datos['nombre'],
					 'apellido'=>$datos['apellido'],
					 ]
					 );
	}
	


	public function clientes()
	{
		$datos=$this->cargar_header_sidebar_acciones();
			return view('clientes', 
					[
					 'modulos'=>$datos['modulos'],
					 'submodulos'=>$datos['submodulos'],
					 'nombre'=>$datos['nombre'],
					 'apellido'=>$datos['apellido'],
					 ]
					 );
	}






/////////////////////////////////////////////////////////15-11-2016///////////////////////////////////////////////
////////////////////////////////////////////////////Modulo Clientes///////////////////////////////////////////////


	public function clientes_modificar()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('clientes_modificar',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}


	public function clientes_responsables()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('clientes_responsables',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}


	public function clientes_responsables_modificar()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('clientes_responsables_modificar',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}

	public function clientes_responsables_agregar()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('clientes_responsables_agregar',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}


	public function clientes_sucursales()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('clientes_sucursales',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}


	public function clientes_sucursales_modificar()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('clientes_sucursales_modificar',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}

	public function clientes_sucursales_agregar()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('clientes_sucursales_agregar',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}

public function clientes_sucursales_responsable()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('clientes_sucursales_responsable',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}

public function clientes_sucursales_plan()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('clientes_sucursales_plan',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}

public function clientes_sucursales_equipos()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('clientes_sucursales_equipos',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}

public function clientes_sucursales_usuarios()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('clientes_sucursales_usuarios',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}

/////////////////////////////////////////////////////////15-11-2016 2da ronda///////////////////////////////////////////////
////////////////////////////////////////////////////Modulo Clientes///////////////////////////////////////////////

	public function clientes_categoria()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('clientes_categoria',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}


	public function clientes_categoria_modificar()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('clientes_categoria_modificar',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}

public function clientes_categoria_responsable()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('clientes_categoria_responsable',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}

public function clientes_sucursales_responsable_agregar()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('clientes_sucursales_responsable_agregar',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}

public function clientes_sucursales_responsable_modificar()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('clientes_sucursales_responsable_modificar',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}



public function clientes_sucursales_plan_agregar()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('clientes_sucursales_plan_agregar',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}

public function clientes_sucursales_plan_modificar()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('clientes_sucursales_plan_modificar',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}

public function clientes_sucursales_plan_servicios()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('clientes_sucursales_plan_servicios',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}

public function clientes_sucursales_plan_serv_modificar()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('clientes_sucursales_plan_serv_modificar',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}
public function clientes_sucursales_plan_serv_agregar()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('clientes_sucursales_pla_serv_agregar',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}

public function clientes_sucursales_equipos_agregar()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('clientes_sucursales_equipos_agregar',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}

public function clientes_sucursales_equipos_modificar()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('clientes_sucursales_equipos_modificar',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}

public function clientes_sucursales_equipos_componentes()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('clientes_sucursales_equipos_componentes',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}

public function clientes_sucursales_usuarios_agregar()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('clientes_sucursales_usuarios_agregar',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}


public function clientes_sucursales_usuarios_modificar()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('clientes_sucursales_usuarios_modificar',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}


public function clientes_sucursales_usuarios_perfil()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('clientes_sucursales_usuarios_perfil',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}






}
