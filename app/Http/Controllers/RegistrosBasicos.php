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



	public function datos_vista($datos_session,$datos_acciones,$consulta,$extra=" ",$datosC1=" ",$datosC2=" ",$datosC3=" ")//asocia en un vector los datos que deben pasarse a una vista
	{
		$valores_vista=array(
								'modulos'=>$datos_session['modulos'],//side bar
								'submodulos'=>$datos_session['submodulos'],//side bar
								'nombre'=>$datos_session['nombre'],//header
								'apellido'=>$datos_session['apellido'],//header
								'acciones'=>$datos_acciones['acciones'],//acciones
								'agregar'=>$datos_acciones['agregar'],//boton de agregar
								'consulta'=>$consulta,//registros provenientes de la base de datos
								'extra'=>$extra,
								'datosC1'=>$datosC1,
								'datosC2'=>$datosC2,
								'datosC3'=>$datosC3


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


	
	public function clientes_modificar()
	{
		$id=Request::get('idCliente');

		$consulta=DB::table('clientes')->join('rifs','clientes.rif_id','=','rifs.id')
					  ->join('contactos','clientes.contacto_id','=','contactos.id')
					  ->join('direcciones','clientes.direccion_id','=','direcciones.id')
					  ->select('clientes.razon_s AS razonS','clientes.nombre_c AS nombreC','rifs.numero As numeroR','rifs.tipo_id AS tipoR',
					  		   'contactos.codigo_id AS codigoC','contactos.telefono_m AS telefonoC','contactos.codigo__id AS codigoL',
					  		   'contactos.telefono_f AS telefonoF','contactos.correo','direcciones.pais_id AS paisC','direcciones.region_id AS regionC',
					  		   'direcciones.estado_id AS estadoC','direcciones.municipio_id AS municipioC','direcciones.descripcion As descrdirC')
					  ->where('clientes.id',(int)$id);

		return $consulta;

	}

	public function clientes_registrar()//manejo de los select para direcciones del cliente matriz 
	{	
		
		$seleccion=Request::get('vector');


		if ($seleccion[0]=="paisdf" or $seleccion[0]=="paisdc") //se seleccionan paises

		{
			$valor=(int)$seleccion[1];
			$opciones=DB::table('regiones')->select('id','descripcion')->where('pais_id',$valor)->get();
			return $opciones;


		}
		elseif ($seleccion[0]=="regiondf" or $seleccion[0]=="regiondc")//se selecciona la region
		{
			$valor=(int)$seleccion[1];
			$opciones=DB::table('estados')->select('id','descripcion')->where('region_id',$valor)->get();
			return $opciones;
	
		}
		elseif ($seleccion[0]=="edodf" or $seleccion[0]=="edodc") //se selecciona el estado

		 {
			$valor=(int)$seleccion[1];
			$opciones=DB::table('municipios')->select('id','descripcion')->where('estado_id',$valor)->get();
			return $opciones;
		}



	}


	public function clientes_insertar_responsable($cliente_id)//agregar personas afiliadas a una empresa matriz
	{
		
		$nombres=Request::get('nomRpb1');//nombres del responsable 
		
		$apellidos=Request::get('apellRpb1');//apellidos del responsable
		
		$tipoCedula=(int)Request::get('selciRpb');//tipo cedula 
		
		$cedula=Request::get('txtci');//numero de cedula
		
		$cargo=Request::get('cgoRpb');//cargo
		
		$codigoMovil=(int)Request::get('seltlfRpb');//tipo codigo
		
		$numeroMovil=Request::get('numTelclRpb');//numero telefono numTelclRpb
		
		$codigoLocal=(int)Request::get('seltlfmRpb');//ctipo codigo seltlfmRpb
		
		$numeroLocal=Request::get('numTelmvlRpb');//numero fijo
	
		$correo=Request::get('mail2');//correo 


		$idC=DB::table('cedulas')->insertGetId//cedula del cliente
		(['numero'=>$cedula,'tipo_id'=>$tipoCedula]);

		$idCo=DB::table('contactos')->insertGetId//contacto del responsable
		(['tipo_id'=>$codigoMovil,'tipo__id'=>$codigoLocal,'telefono_m'=>$numeroMovil,'telefono_f'=>$numeroLocal,'correo'=>$correo]);

		DB::table('personas')->insert//insertar datos del responsable
		(['p_nombre'=>$nombres,'p_apellido'=>$apellidos,'cargo'=>$cargo,'cedula_id'=>$idC,'contacto_id'=>$idCo,'cliente_id'=>(int)$cliente_id]);

	
		return redirect('/menu/registros/clientes/responsable/'.(string)$cliente_id);//redirecciona a la venta que lista los responsables de un cliente matriz especifico: indicado por: $cliente_id
	}




	public function clientes_insertar()//debe estar habilitado el boton aceptar
	{
		
		//capturar datos del formulario

		$razonS=Request::get('rsnew');//razon social
		$nombreC=Request::get('ncnew');//nombre comercial
		
		$tipoR=(int) Request::get('tiporif');//tipo rif
		$numeroR= Request::get('numerorif');//numero rif
		
		$tipoC=(int)Request::get('tipConnew');//tipo de contribuyente
		
		
		
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

		
		$codigoL=Request::get('tlflsv');//codigo local
		$codigoM=Request::get('tlfmvlsv');//codigo movil

		$telefonoM=Request::get('tmvlsv');//nro movil
		$telefonoL=Request::get('tclsv');//nro local
		

		$correo=Request::get('mailsv');//correo electronico

		

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


		return redirect('/menu/registros/clientes');
	}


	public function clientes_responsables($cliente_id)//agregar resposnsables de una matriz
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(14,15),13);
		
		return view ('Registros_Basicos\Clientes\clientes_responsables',$this->datos_vista($datos,$acciones,
					  DB::table('personas')->where('cliente_id',$cliente_id)->get(),$cliente_id,
					  DB::table('tipos')->where('numero_c',5)->get(),//tipos de cedula para los select
					  DB::table('tipos')->where('numero_c',2)->get(),//tipos de codigos de telefonos para los select
					  DB::table('tipos')->where('numero_c',3)->get()));//tipos de codigos locales para los select 
					
	}




	public function clientes_sucursales()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(25,26,27,28,29,30),24);
		return view ('Registros_Basicos\Clientes\clientes_sucursales',$this->datos_vista($datos,$acciones,array()));
						
	}

	public function clientes_categoria($cliente_id)
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(16,17,18,19),20);
		return view ('Registros_Basicos\Clientes\clientes_categoria',$this->datos_vista($datos,$acciones,DB::table('categorias')->where('cliente_id',$cliente_id)->get()));
						
	}

	public function clientes_categoria_responsable($categoria_id)
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(22,23),21);
		return view ('Registros_Basicos\Clientes\clientes_categoria_responsable',$this->datos_vista($datos,$acciones,DB::table('personas')->join('categoria_persona','personas.id','=','categoria_persona.persona_id')->where('categoria_persona.categoria_id',$categoria_id)->get()));
						
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


	public function planes_servicios()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(65,66,67),64);
		return view ('Registros_Basicos\PlaneS\planes',$this->datos_vista($datos,$acciones,array()));

		
	}
	



	public function planes_servicios_servicios()
	{
		$datos=$this->cargar_header_sidebar_acciones();
		$acciones=$this->cargar_acciones_submodulo_perfil($datos['acciones'],array(73,74),72);
		return view ('Registros_Basicos\PlaneS\servicios',$this->datos_vista($datos,$acciones,array()));

		
	}
	





	



/////////////////////////////////////////////////////////15-11-2016 2da ronda///////////////////////////////////////////////
////////////////////////////////////////////////////Modulo Clientes///////////////////////////////////////////////

	








}
