<?php
namespace App\Http\Controllers;

use App\Usuario;
use App\Empleado;
use App\Perfil;
use Session;
use Request;


class InicioController extends Controller
{
    
   
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
                         $modulos=$perfil->modulos;//obtener modulos asociados al perfil logueado
                         $submodulos=$perfil->submodulos;//obtener submodulos asociados al perfil logueado
                         $acciones=$perfil->acciones;
                       
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
                            'Menu\menu',
                            [
                            "modulos"=>$modulos[0],
                            "submodulos"=>$submodulos[0],
                            "nombre"=>$datos[0]["nombre"],
                            "apellido"=>$datos[0]["apellido"]
                            ]
                    );

    }




}
