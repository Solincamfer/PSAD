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


	
	public function clientes_registrar()
	{
		
		$seleccion=Request::get('vector');

		if ($seleccion[0]=="paisdf") //se seleccionan paises

		{
			$valor=(int)$seleccion[1];
			$regiones=DB::table('regiones')->select('id','descripcion')->where('pais_id',$valor)->first();
	
			
			return $regiones->descripcion;
		}




	}

	public function clientes_insertar()
	{
		
		//capturar datos del formulario

		$razonS=Request::get('rs');//razon social
		$nombreC=Request::get('nc');//nombre comercial
		
		$tipoR=(int) Request::get('rif');//tipo rif
		$numeroR= Request::get('df');//numero rif
		
		$tipoC=(int)Request::get('tipCon');//tipo de contribuyente
		
		
		
		$direccionF=Request::get('descDirdf');//direccion fiscal
		$paisF=(int)Request::get('paisdf');//pais fiscal
		$regionF=(int)Request::get('regiondf');//region fiscal
		$estadoF=(int)Request::get('edodf');//estado fiscal
		$municipioF=(int)Request::get('mundf');//municipiofiscal
		
		$direccionC=(int)Request::get('descDirdc');//direccion comercial
		$paisC=(int)Request::get('paisdc');//pais comercial
		$regionC=(int)Request::get('regiondc');//region comercial
		$estadoC=(int)Request::get('edodc');//estado comercial
		$municipioC=(int)Request::get('mundc');//municipio comercial

		
		$codigoL=Request::get('tlflcl');//codigo local
		$codigoM=Request::get('tlfmvl');//codigo movil

		$telefonoM=Request::get('tmvl');//nro movil
		$telefonoL=Request::get('tcl');//nro local
		

		$correo=Request::get('mail');//correo electronico

		

		////inserciones
		

		$idR= DB::table('rifs')->insertGetId//insertar rif 
			(
				['numero'=>$numeroR,'tipo_id'=>$tipoR]
			);

		
		$idC=DB::table('contactos')->insertGetId//insercion de contacto
			(

			   ['tipo_id'=>$codigoM,'tipo__id'=>$codigoL,'telefono_m'=>$telefonoM,'telefono_f'=>$telefonoL,'correo'=>$correo]
			);


		
		$iddF=(integer) DB::table('direcciones')->insertGetId//insercion de direcciones direccion fiscal
			(

				['descripcion'=>$direccionF,'municipio_id'=>$municipioF,'pais_id'=>$paisF,'region_id'=>$regionF,'estado_id'=>$estadoF]
			);

		$iddC=(integer)DB::table('direcciones')->insertGetId//insercion de direcciones direccion comercial
			(

				['descripcion'=>$direccionC,'municipio_id'=>$municipioC,'pais_id'=>$paisC,'region_id'=>$regionC,'estado_id'=>$estadoC]
			);

		 DB::table('clientes')->insert
		 	(

		 		['razon_s'=>$razonS,'nombre_c'=>$nombreC,'rif_id'=>$idR,'tipo_id'=>$tipoC,'direccion_id'=>$iddF,'direccion__id'=>$iddC,'contacto_id'=>$idC]
		 	);


		
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
