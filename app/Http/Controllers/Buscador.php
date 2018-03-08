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

            
			////////////////////////////////// Eliminar Equipos 
            public function eliminarEquipos($sucursal_id)
            {
            	$sucursal=Sucursal::find($sucursal_id);
            	$equipos=$sucursal->equipos;
            	foreach ($equipos as $equipo) 
            	{
            		///////////////////Borrar aplicaciones
            		$aplicaciones=$equipo->aplicaciones;
            		foreach($aplicaciones as $aplicacion)
            		{
            			$delete=Aplicacion::find($aplicacion->id);
            			$delete->delete();
            		}

            		////////////////Borrar Piezas

            		$componentes=$equipo->componentes;
            		foreach($componentes as $componente)
            		{
            			$piezas=$componente->piezas;
            		    foreach ($piezas as $pieza) 
            			{
            				$delete=Pieza::find($pieza->id);
            				$delete->delete();
            			}

            			///////////Borrar componente
            			$delete=Componente::find($componente->id);
            			$delete->delete();
            		}


            		///////////////Borrar equipos
            		$delete=Equipo::find($equipo->id);
            		$delete->delete();

            		
            
           		 }
           		 return 0;
           	}


           	//////////////////////////eliminar sucursales 
           	public function eliminarSucursales($categoria_id)
           	{
           		$categoria=Categoria::find($categoria_id);
           		$sucursales=$categoria->sucursales;

           		foreach($sucursales as $sucursal)
           		{
           			////////////////////////Eliminar valores de las tablas intermedias
           			/////////personas sucursal
           				DB::table('persona_sucursal')->where(['persona_sucursal.persona_id'=>$sucursal->id])->delete();

           			/////////planes sucursal
           				DB::table('plan_sucursal')->where(['plan_sucursal.sucursal_id'=>$sucursal->id])->delete();

           			///////////sucursal telefonos
           				DB::table('telefonos')
           					->join('sucursal_telefono','sucursal_telefono.telefono_id','=','telefonos.id')
           					->where(['sucursal_telefono.sucursal_id'=>$sucursal_id])
           					->delete();

           				DB::table('sucursal_telefono')->where(['sucursal_id'=>$sucursal->id])->delete();
           			


           		

           			////////////////////////Eliminar valores de las FK ////////////////////////////////////////////////
           				///////////////////Obtener valores de los campos a eliminar /////////////////////////////
           			$deleteRif=Rif::find($sucursal->rif_id);
           			$deleteDirF=Direccion::find($sucursal->direccionFiscal_id);
           			$deleteDirC=Direccion::find($sucursal->direccionComercial_id);
           			$deleteCorreo=Correo::find($sucursal->correo_id);

           			//////////////////////////eliminar sucursal////////////////////////////////////////////////////////
           			$delete=Sucursal::find($sucursal->id);
           			$delete->delete();
           			///////////////////////////////////////////////////////////////////////////////////////////////////

           			   ///////////////////realizar eliminaciones ///////////////////////////////////////////////

           			$deleteRif->delete();
           			$deleteCorreo->delete();
           			$deleteDirC->delete();
           			$deleteDirF->delete();


           		}

           		return 0;

           	}


           
           	////////////////////////////eliminar categorias 
           	public function eliminarCategorias($cliente_id)
           	{
           		$cliente=Cliente::find($cliente_id);
           		$categorias=$cliente->categorias;

           		foreach ($categorias as $categoria) 
           		{
           			DB::table('categoria_persona')->where(['categoria_persona.categoria_id'=>$categoria->id])->delete();//elimina la relacion de responsable de la categoria
           			$categoria->delete();//elimina la categoria de turno


           		}

           		return 0;
           	}


           	/////////////////////////eliminar cliente matriz

           	public function eliminarClienteMatriz($cliente_id)
           	{
           		$cliente=Cliente::find($cliente_id);

           		/////////////////eliminar valor de las tablas intermedias //////////////////////////
           		//eliminar telefonos
           		DB::table('telefonos')
           			->join('cliente_telefono','cliente_telefono.telefono_id','=','telefonos.id')
           			->where(['cliente_telefono.cliente_id'=>$cliente_id])
           			->delete();

           		DB::table('cliente_telefono')->where(['cliente_id'=>$cliente_id])->delete();

           		$personas=DB::table('personas')->where(['cliente_id'=>$cliente_id])->get();
           		foreach($personas as $persona)
           		{
           			/////////////////////tablas intermedias ////////////////////////////
           			//////persona telefono
           			DB::table('telefonos')
           				->join('persona_telefono','persona_telefono.telefono_id','=','telefonos.id')
           				->where(['persona_telefono.persona_id'=>$persona->id])
           				->delete();
           			DB::table('persona_telefono')->where(['persona_id'=>$persona->id])->delete();

           		    ///////////obtener datos de la persona ////////////////
           			$cedula=Cedula::find($persona->cedula_id);
           			$correo=Correo::find($persona->correo_id);

           			/////////borrar persona ///////////////////////////
           			$persona=Persona::find($persona->id);
           			$persona->delete();

           			/////////borrar datos de la persona////////////////////
           			$cedula->delete();
           			$correo->delete();
           		}


           		/////////////obtener valores a borrar del cliente matriz 
           		$clienteRif=Rif::find($cliente->rif_id);
           		$clienteDireccionFiscal=Direccion::find($cliente->direccionFiscal_id);
           		$clienteDireccionComercial=Direccion::find($cliente->direccionComercial_id);
           		$clienteCorreo=Correo::find($cliente->correo_id);
           		////////////////borrar cliente
           		$cliente->delete();

           		///////////////borrar datos del cliente //////////////////////////////////

           		$clienteRif->delete();
           		$clienteDireccionFiscal->delete();
           		$clienteDireccionComercial->delete();
           		$clienteCorreo->delete();


           		return 0;

           	}




			public function prueba_metodo()
			{

				  // $consultaModelos=DB::table('modelos')
      //       ->join('modelo_tipoequipo','modelo_tipoequipo.modelo_id','=','modelos.id')
      //       ->join('marca_modelo','marca_modelo.modelo_id','=','modelos.id')
      //       ->join('marca_tipoequipo','marca_tipoequipo.marca_id','=','marca_modelo.marca_id')
      //       ->where(['modelo_tipoequipo.tipoequipo_id'=>6,'marca_modelo.marca_id'=>1])
      //       ->select('modelo_tipoequipo.id AS modeloTipoEquipo_id','modelo_tipoequipo.modelo_id AS modeloTipoEquipo_modelo_id')
            
      //       ->get();
      //       dd($consultaModelos);


          ///////////////////////////////Cargar acciones //////////////////////////////////////////
        // $descripcion='Responsable Matriz';
        // $orden=18;
        // $submoduloPadre=7;
        // $accionPadre=10;
        // $perfil_id=24;

        // $accion=new Accion();
        //   $accion->status_ac=1;
        //   $accion->descripcion='Eliminar'.' '.$descripcion;
        //   $accion->desci='';
        //   $accion->url='';
        //   $accion->identificador='';
        //   $accion->clase_cont='';
        //   $accion->clase_css='fa fa-trash-o EliminarR';
        //   $accion->clase_elem='';
        //   $accion->ventana=0;
        //   $accion->orden=$orden;
        //   $accion->vista=0;
        //   $accion->submodulo_id=$submoduloPadre;
        //   $accion->tabla=0;
        //   $accion->accion_id=$accionPadre;
        // $accion->save();


        // $perfil=Perfil::find($perfil_id);
        // $perfil->acciones()->attach($accion->id);

        /////////////////////////////eliminar acciones asociadas a los perfiles que no son root////////////

        // $consulta=DB::table('accion_perfil')->where('perfil_id','<>',24)->delete();


        ///////////////////////////eliminar aosociacion de perfiles y modulos que no sean root//////////////
        //$consulta=DB::table('modulo_perfil')->where('perfil_id','<>',24)->delete();

        ///////////eliminar asociacion de perfiles y submodulos que no sean root //////////////////////////

        //$consulta=DB::table('perfil_submodulo')->where('perfil_id','<>',24)->delete();

        ///////////////eliminar perfiles ////////////////////////////

       // $consulta=DB::table('perfiles')->where('id','<>',24)->delete();

      $consulta=DB::table('acciones')->where('id','>',109)->where('id','<',121)->update(['status_ac'=>1]);

        /////////////////////////consulta modificar equipos/////////////////////////////////

        // $tipoEquipo=DB::table('tipoequipos')->where('descripcion','DESKTOP')->first();
        // $marca=DB::table('marcas')->where('descripcion','HP')->first();

        //  $modelos=DB::table('modelos')
        //    ->join('modelo_tipoequipo','modelo_tipoequipo.modelo_id','=','modelos.id')
        //    ->join('marca_modelo','marca_modelo.modelo_id','=','modelos.id')
        //    ->where(['marca_modelo.marca_id'=>$marca->id,'modelo_tipoequipo.tipoequipo_id'=>$tipoEquipo->id])
        //    ->select('modelos.id AS id','modelos.descripcion AS descripcion')
        //    ->get();

        // return Response::json($modelos);


        ////////////////////Inserciones Tipoequipo, componentes y piezas///////////////////////////

        $modelos=[
                    'PCHP-00','PCDELL-00',
                    'PCVIT-00','PCLG-00',
                    'LAPBENQ-00','LAPDELL-00',
                    'CASEHP-00','CASEVIT-00',
                    'MONTLG-00','MONTDELL-00',
                    'TECLBENQ-00','TECLHP-00',
                    'MOUSEBENQ-00','MOUSEHP-00',
                    'UPSVIT-00','UPSLG-00',
                    'CORNLG-00','CORNBENQ-00',
                    'TMVIT-00','TMBENQ-00',
                    'TVLG-00','TVDELL-00',
                    'MRHP-00','MRLG-00',
                    'DRHP-00','DRVIT-00'
                  ];

        $marcas=['HP','DELL','BENQ','VIT','LG'];


        $tipoequipos=['DESKTOP','LAPTOP'];

        $tipocomponentes=array(['CASE',1],['MONITOR',1],['TECLADO',1],['MOUSE',1],['UPS',1],['CORNETAS',1],['MOUSE',2],['UPS',2],['CORNETAS',2]);

        $tipopiezas=[['TARJETA MADRE',1],['TARJETA DE VIDEO',1],['MEMORIA RAM',1],['DISCO DURO',1]];


        ////////////////////////Relaciones (correr luego de crear todos los registros anteriores)//////////////////////////////

        $marca_tipoequipo=[[1,1],[2,1],[4,1],[5,1],[3,2],[2,2]];//campo 0 marca, campo 1 tipoequipo
        $modelo_tipoequipo=[[1,1],[2,1],[3,1],[4,1],[5,2],[6,2]];//campo 0 modelo, campo 1 tipoequipo


        $marca_ncomponente=[[1,1],[4,1],[5,2],[2,2],[3,3],[1,3],[3,4],[1,4],[4,5],[5,5],[5,6],[3,6]];//campo 0 marca_id, campo 1 ncomponente_id
        $modelo_ncomponente=[[7,1],[8,1],[9,2],[10,2],[11,3],[12,3],[13,4],[14,4],[15,5],[16,5],[17,6],[18,6]];//campo 0 modelo_id, campo 1 ncomponente_id


        $marca_npieza=[[4,1],[3,1],[5,2],[2,2],[1,3],[5,3],[1,4],[4,4]];//campo 0 marca_id, campo 1 npieza_id
        $modelo_npieza=[[19,1],[20,1],[21,2],[22,2],[23,3],[24,3],[25,4],[26,4]];//campo 0 modelo_id, campo 1 npieza_id

       

        $marca_modelo=[[1,1],[2,2],[4,3],[5,4],[3,5],[2,6],[1,7],[4,8],[5,9],[2,10],[3,11],[1,12],[3,13],[1,14],[4,15],[5,16],[5,17],[3,18],[4,19],[3,20],[5,21],[2,22],[1,23],[5,24],[1,25],[4,26]];//campo 0 marca campo 1 modelo

       
       
          //////////////marca piezas y modelo piezas////////
        // foreach ($marca_npieza as $MarP) 
        // {
        //   DB::table('marca_npieza')->insert(['marca_id'=>$MarP[0],'npieza_id'=>$MarP[1]]);
        // }

        // foreach ($modelo_npieza as $MarMod)
        // {
        //   DB::table('modelo_npieza')->insert(['modelo_id'=>$MarMod[0],'npieza_id'=>$MarMod[1]]);
        // }

        // /////////////marca componente y modeo componente///////////////
        // foreach ($marca_ncomponente as $MarNc) 
        // {
        //   DB::table('marca_ncomponente')->insert(['marca_id'=>$MarNc[0],'ncomponente_id'=>$MarNc[1]]);
        // }

        // foreach ($modelo_ncomponente as $ModNc) 
        // {
        //   DB::table('modelo_ncomponente')->insert(['modelo_id'=>$ModNc[0],'ncomponente_id'=>$ModNc[1]]);
        // }


        ////////////marca_modelo/////////////////////
        // foreach ($marca_modelo as $marM ) 
        // {
        //   DB::table('marca_modelo')->insert(['marca_id'=>$marM[0],'modelo_id'=>$marM[1]]);
        // }

        /////////////////////marca tipoequipo/////////////////////////////////////
        // foreach ($marca_tipoequipo as $marE) 
        // {
        //   DB::table('marca_tipoequipo')->insert(['marca_id'=>$marE[0],'tipoequipo_id'=>$marE[1]]);
        // }

        ///////////modelo_tipoequipo//////////////////////////////////////////////
        // foreach ($modelo_tipoequipo as $modT) 
        // {
        //   DB::table('modelo_tipoequipo')->insert(['modelo_id'=>$modT[0],'tipoequipo_id'=>$modT[1]]);
        // }


        ////////

        /////////////////////////////////Cargar modelos///////////////
        // foreach ($modelos as $descripcion) 
        // {
        //   $modelo=new Modelo();
        //     $modelo->descripcion=$descripcion;
        //   $modelo->save();
        // }

        ///////////Cargar marcas//////////////////////////////
        // foreach ($marcas as $descripcion) 
        // {
        //   $marca=new Marca();
        //     $marca->descripcion=$descripcion;
        //   $marca->save();
        // }

        ////////Cargar tipo Equipo /////////////////////
        // foreach ($tipoequipos as $descripcion) 
        // {
        //    $tipoequipo=new Tipoequipo();
        //       $tipoequipo->descripcion=$descripcion;
        //    $tipoequipo->save();
        // }

        ///////////////cargar ncomponentes /////////////////////

        // foreach ($tipocomponentes as $ncomponente) 
        // {
        //   $componente=new Ncomponente();
        //     $componente->descripcion=$ncomponente[0];
        //     $componente->tipoequipo_id=$ncomponente[1];
        //   $componente->save();
        // }


        ////////////cargar piezas //////////////////////////////

        // foreach ($tipopiezas as $npieza) 
        // {
        //   $pieza=new Npieza();
        //       $pieza->descripcion=$npieza[0];
        //       $pieza->ncomponente_id=$npieza[1];
        //   $pieza->save();
        // }
        
        return $consulta;

			}

}
