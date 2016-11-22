<?php

namespace App\Http\Controllers;


use Session;
use DB;
use Request;


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
		return view('Registros_Basicos\Departamentos\cargos',$this->datos_vista($datos,$acciones,DB::table('cargos')->where('departamento_id',$departamento_id)->get()));
					
	}


	public function departamentos()//Inicializacion del submodulo: /departamentos
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(1,2,3),4);
		
		return view('Registros_Basicos\Departamentos\departamentos',$this->datos_vista($datos,$acciones,DB::table('departamentos')->get()));
					
	}


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


	public function clientes_insertar()
	{
		
		//capturar datos del formulario

		$razonS=(string)Request::get('rs');//razon social
		$nombreC=(string)Request::get('nc');//nombre comercial
		$tipoR=(integer)Request::get('rif');//tipo rif
		$numeroR=(string)Request::get('df');//numero rif
		$tipoC=(integer)Request::get('tipCon');//tipo de contribuyente
		
		
		
		$direccionF=(string)Request::get('descDirdf');//direccion fiscal
		$paisF=(integer)Request::get('paisdf');//pais fiscal
		$regionF=(integer)Request::get('regiondf');//region fiscal
		$estadoF=(integer)Request::get('edodf');//estado fiscal
		$municipioF=(integer)Request::get('mundf');//municipiofiscal
		
		$direccionC=(integer)Request::get('descDirdc');//direccion comercial
		$paisdC=(integer)Request::get('paisdc');//pais comercial
		$regionC=(integer)Request::get('regiondc');//region comercial
		$edodC=(integer)Request::get('edodc');//estado comercial
		$municipioC=(integer)Request::get('mundc');//municipio comercial

		
		$codigoL=(string)Request::get('tlflcl');//codigo local
		$codigoM=(string)Request::get('tlfmvl');//codigo movil

		$telefonoM=(string)Request::get('tmvl');//nro movil
		$telefonoL=(string)Request::get('tcl');//nro local
		

		$correo=(string)Request::get('mail');//correo electronico

		////inserciones

		$id_r=(integer) DB::table('rifs')->insertGetId//insercion de rif
			([
				['numero'=>$numeroR,'tipo_id'=>$tipoR]
			]);

		$id_c=(integer) DB::table('contactos')->insertGetId//insercion de contacto
			([

				['tipo_id'=>$codigoM,'tipo__id'=>$codigoL,'telefono_m'=>$telefonoM,'telefono_f'=>$telefonoL]
			]);

		$id_df=(integer) DB::table('direcciones')->insertGetId//insercion de direcciones direccion fiscal
			([

				['descripcion'=>$direccionF,'municipio_id'=>$municipioF,'pais_id'=>$paisF,'redion_id'=>$regionF,'estado_id'=>$estadoF]
			]);

		$id_dc= (integer)DB::table('direcciones')->insertGetId//insercion de direcciones direccion comercial
			([

				['descripcion'=>$direccionC,'municipio_id'=>$municipioC,'pais_id'=>$paisC,'redion_id'=>$regionC,'estado_id'=>$estadoC]
			]);

		 DB::table('clientes')->insert
		 	([

		 		['razon_s'=>$razonS,'nombre_c'=>$nombreC,'rif_id'=>$id_r,'tipo_id'=>$tipoC,'direccion_id'=>$id_df,'direccion__id'=>$id_dc,'contacto_id'=>$id_c]
		 	]);


		
	}


	public function clientes_responsables()//
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(14,15),13);
		return view ('Registros_Basicos\Clientes\clientes_responsables',$this->datos_vista($datos,$acciones,array())); 
					
	}




	public function clientes_sucursales()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(25,26,27,28,29,30),24);
		return view ('Registros_Basicos\Clientes\clientes_sucursales',$this->datos_vista($datos,$acciones,array()));
						
	}

	public function clientes_categoria()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(16,17,18,19),20);
		return view ('Registros_Basicos\Clientes\clientes_categoria',$this->datos_vista($datos,$acciones,array()));
						
	}

	public function clientes_categoria_responsable()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(22,23),21);
		return view ('Registros_Basicos\Clientes\clientes_categoria_responsable',$this->datos_vista($datos,$acciones,array()));
						
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

/////////////////////////////////////////////////////////15-11-2016///////////////////////////////////////////////
////////////////////////////////////////////////////Modulo Clientes///////////////////////////////////////////////


	public function servicios()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view('Registros_Basicos\Planes_y_Servicios\planes', 
					[
					 'modulos'=>$datos['modulos'],
					 'submodulos'=>$datos['submodulos'],
					 'nombre'=>$datos['nombre'],
					 'apellido'=>$datos['apellido'],
					 ]
					 );
	}
	








	



/////////////////////////////////////////////////////////15-11-2016 2da ronda///////////////////////////////////////////////
////////////////////////////////////////////////////Modulo Clientes///////////////////////////////////////////////

	





public function clientes_sucursales_plan_modificar()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		return view ('Registros_Basicos\Clientes\clientes_sucursales_plan_modificar',
						[

						 'modulos'=>$datos['modulos'],
						 'submodulos'=>$datos['submodulos'],
						 'nombre'=>$datos['nombre'],
						 'apellido'=>$datos['apellido']
						]


						);
	}








}
