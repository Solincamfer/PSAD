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



	public function datos_vista($datos_session,$datos_acciones,$consulta)//asocia en un vector los datos que deben pasarse a una vista
	{
		$valores_vista=array(
								'modulos'=>$datos_session['modulos'],//side bar
								'submodulos'=>$datos_session['submodulos'],//side bar
								'nombre'=>$datos_session['nombre'],//header
								'apellido'=>$datos_session['apellido'],//header
								'acciones'=>$datos_acciones['acciones'],//acciones
								'agregar'=>$datos_acciones['agregar'],//boton de agregar
								'consulta'=>$consulta//registros provenientes de la base de datos


								);

		return $valores_vista;	
	}


/////////////////////controladores de las rutas //////////////////////////////////////////////

	

	public function departamentos_cargos($departamento_id)//Inicializacion del submodulo: /departamentos/cargos
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(5,6),7);
		return view('Registros Basicos\Departamentos\cargos',$this->datos_vista($datos,$acciones,DB::table('cargos')->where('departamento_id',$departamento_id)->get()));
					
	}


	public function departamentos()//Inicializacion del submodulo: /departamentos
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(1,2,3),4);
		
		return view('Registros Basicos\Departamentos\departamentos',$this->datos_vista($datos,$acciones,DB::table('departamentos')->get()));
					
	}


	public function clientes()//inicializacion del submodulo: clientes
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(9,10,11,12),8);
	
		return view('Registros Basicos\Clientes\clientes',$this->datos_vista($datos,$acciones,array())); 
	}




	public function clientes_responsables()//
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(14,15),13);
		return view ('Registros Basicos\Clientes\clientes_responsables',$this->datos_vista($datos,$acciones,array())); 
					
	}




	public function clientes_sucursales()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(25,26,27,28,29,30),24);
		return view ('Registros Basicos\Clientes\clientes_sucursales',$this->datos_vista($datos,$acciones,array()));
						
	}

	public function clientes_categoria()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(16,17,18,19),20);
		return view ('Registros Basicos\Clientes\clientes_categoria',$this->datos_vista($datos,$acciones,array()));
						
	}

	public function clientes_categoria_responsable()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(22,23),21);
		return view ('Registros Basicos\Clientes\clientes_categoria_responsable',$this->datos_vista($datos,$acciones,array()));
						
	}

	

	





/////////////////////////////////////////////////////////15-11-2016///////////////////////////////////////////////
////////////////////////////////////////////////////Modulo Clientes///////////////////////////////////////////////


	public function servicios()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view('Registros Basicos\Planes y Servicios\planes', 
					[
					 'modulos'=>$datos['modulos'],
					 'submodulos'=>$datos['submodulos'],
					 'nombre'=>$datos['nombre'],
					 'apellido'=>$datos['apellido'],
					 ]
					 );
	}
	



	public function clientes_modificar()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('Registros Basicos\Clientes\clientes_modificar',
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
		return view ('Registros Basicos\Clientes\clientes_responsables_modificar',
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
		return view ('Registros Basicos\Clientes\clientes_responsables_agregar',
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
		return view ('Registros Basicos\Clientes\clientes_sucursales_modificar',
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
		return view ('Registros Basicos\Clientes\clientes_sucursales_agregar',
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
		return view ('Registros Basicos\Clientes\clientes_sucursales_responsable',
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
		return view ('Registros Basicos\Clientes\clientes_sucursales_plan',
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
		return view ('Registros Basicos\Clientes\clientes_sucursales_equipos',
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
		return view ('Registros Basicos\Clientes\clientes_sucursales_usuarios',
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

	


	public function clientes_categoria_modificar()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('Registros Basicos\Clientes\clientes_categoria_modificar',
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
		return view ('Registros Basicos\Clientes\clientes_sucursales_responsable_agregar',
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
		return view ('Registros Basicos\Clientes\clientes_sucursales_responsable_modificar',
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
		return view ('Registros Basicos\Clientes\clientes_sucursales_plan_agregar',
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
		return view ('Registros Basicos\Clientes\clientes_sucursales_plan_modificar',
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
		return view ('Registros Basicos\Clientes\clientes_sucursales_plan_servicios',
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
		return view ('Registros Basicos\Clientes\clientes_sucursales_plan_serv_modificar',
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
		return view ('Registros Basicos\Clientes\clientes_sucursales_pla_serv_agregar',
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
		return view ('Registros Basicos\Clientes\clientes_sucursales_equipos_agregar',
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
		return view ('Registros Basicos\Clientes\clientes_sucursales_equipos_modificar',
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
		return view ('Registros Basicos\Clientes\clientes_sucursales_equipos_componentes',
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
		return view ('Registros Basicos\Clientes\clientes_sucursales_usuarios_agregar',
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
		return view ('Registros Basicos\Clientes\clientes_sucursales_usuarios_modificar',
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
		return view ('Registros Basicos\Clientes\clientes_sucursales_usuarios_perfil',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}






}
