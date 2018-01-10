<?php
namespace App\Http\Controllers;

use App\Usuario;
use App\Empleado;
use App\Perfil;
use Session;
use Response;
use Request;
use DB;


class InicioController extends Controller
{


   public function pruebaJson()
   {
     $table=Request::get('table');
     $registry=Request::get('registry');


     return Response::json(['table'=>$table,'registry'=>$registry]);
   }


   public function index()
    {
        Session::forget('sesion');//limpia los datos de la sesion anterior
        Session::forget('modulos');
        Session::forget('submodulos');
        Session::forget('acciones');

        return view('login');
    }//retorna el formulario de login




    public function verificar()//verifica que las credenciales del usuario sean correctas
    {
        $usuario=Request::get('user');//nombre de usuario ingresado en el formulario
        $password=Request::get('pwd');//contraseña ingresada por el usuario en el formulario
        $_usuario=Usuario::where('n_usuario',$usuario)->where('clave',$password)->first(); //consulta a la base de datos con los datos capturados  en el formulario


        if (empty($_usuario)==false)//si la consulta a la base de datos devuelve registros
            {
                $persona=Empleado::where('usuario_id',$_usuario->id)->first();//consulta de los datos personales  del usuario
                $datos= array
                        (
                           'usuario'=>$_usuario->n_usuario,
                           'perfil'=>$_usuario->perfil_id,
                           'nombre'=>$persona->nombre,
                           'apellido'=>$persona->apellido

                        );//datos que se almacenaran en la variable session "sesion"


 
                $perfil=Perfil::find($datos['perfil']);
                if ($perfil->status) //si el perfil esta habilitado  ///agregar la verificacion de status del usuario
                    {
                         //$modulos=$perfil->modulos;//obtener modulos asociados al perfil logueado

                        ////////////////////consulta para los modulos///////////////////////////////////////////////////////////////////////
                         $modulos=DB::table('modulos')->join('modulo_perfil','modulo_perfil.modulo_id','=','modulos.id')->select(
                                            'modulos.id AS moduloId','modulos.descripcion AS descripcion','modulos.status_m AS moduloStatus',
                                            'modulo_perfil.status AS status')->where(['modulo_perfil.perfil_id'=>$perfil->id,'modulo_perfil.status'=>1,'modulos.status_m'=>1])->get();

                         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


                         ////////////////////////////////consulta para los submodulos///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                         $submodulos=DB::table('submodulos')->join('perfil_submodulo','perfil_submodulo.submodulo_id','=','submodulos.id')->select(
                                                                   'submodulos.id AS submoduloId','submodulos.descripcion AS descripcion','submodulos.status_sm AS submoduloStatus','submodulos.modulo_id AS padre','submodulos.ruta AS ruta',
                                                                       'submodulos.url AS url',
                                                                   'perfil_submodulo.status AS status')->where(['perfil_submodulo.perfil_id'=>$perfil->id,'submodulos.status_sm'=>1,'perfil_submodulo.status'=>1,'submodulos.padre'=>1])->orderBy('orden','asc')->get();


                         //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


                         ///////////////////////////////  consulta para las acciones///////////////////////////////////////////////////////////////////////////////////////////////////

                         $acciones=DB::table('acciones')->join('accion_perfil','accion_perfil.accion_id','=','acciones.id')->select(
                                                               'acciones.id AS id','acciones.status_ac AS status_ac','acciones.descripcion AS descripcion','acciones.url AS url','acciones.clase_css AS clase_css','acciones.submodulo_id as submodulo_id','accion_perfil.status AS status','acciones.desci as desci','acciones.clase_elem as clase_elem','acciones.identificador as identificador','acciones.clase_cont as clase_cont','acciones.vista as vista')->where(['acciones.status_ac'=>1,'accion_perfil.status'=>1,'accion_perfil.perfil_id'=>$perfil->id])->get();

                         /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


                         //$submodulos=$perfil->submodulos;//obtener submodulos asociados al perfil logueado
                         //$acciones=$perfil->acciones;

                         Session::push('sesion',$datos);//almacenar datos en la variable session:'sesion' del usuario logueado
                         Session::push('modulos',$modulos);//almacenar datos en la variable session:'modulos' de los modulos asociados al perfil logueado
                         Session::push('submodulos',$submodulos);//almacenar datos en la variable session: 'submodulos' de los submodulos asociados al perfil logueado
                         Session::push('acciones',$acciones);

                    }


                $respuesta=[true,$persona->nombre,$persona->apellido,$perfil->status]; //Datos para el mensaje de inicio

                return $respuesta;
            }

    }



    public function iniciarMenu()//carga el menu inicial
    {

        $modulos=Session::get('modulos');//obteine modulos para el perfil logueado desde la variable session
        $submodulos=Session::get('submodulos');//obtiene submodulos para el perfil logueado desde la variable session
        $datos=Session::get('sesion');//obtiene datos del usuario

        return view(
                            'Menu.menu',
                            [
                              "modulos"=>$modulos[0],
                              "submodulos"=>$submodulos[0],
                              "nombre"=>$datos[0]["nombre"],
                              "apellido"=>$datos[0]["apellido"]
                            ]
                    );

    }




}
