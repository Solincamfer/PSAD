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

                        );//datos que se almacenaran en la variable session

                
                Session::push('sesion',$datos);//inicio  de session con los datos del usuario logueado

                $respuesta=[true,$persona->nombre,$persona->apellido]; //Datos para el mensaje de inicio 
                return $respuesta;
            }
    	
    }



    public function redireccion()
    {
        
        $datos=Session::get('sesion');//obtener datos de la sesion activa
        $perfil=Perfil::find($datos[0]['perfil']);//obtener perfil del usuario con session activa

        $modulos=$perfil->modulos;//obtener modulos asociados al perfil logueado
        $submodulos=$perfil->submodulos;//obtener submodulos asociados al perfil logueado

        
        return view(
                    'redireccion',
                        [
                            "modulos"=>$modulos,
                            "submodulos"=>$submodulos,
                            "nombre"=>$datos[0]["nombre"],
                            "apellido"=>$datos[0]["apellido"]
                        ]
                    );

    }


    public function iniciar()
    {
        return view('redireccion');

    }
   
}
