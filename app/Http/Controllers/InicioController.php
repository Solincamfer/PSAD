<?php
namespace App\Http\Controllers;

use App\Usuario;
use App\Empleado;
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
    	$usuario=Request::get('user');
    	$password=Request::get('pwd');
    	
    	$_usuario=Usuario::where('n_usuario',$usuario)->where('clave',$password)->first();
    	$persona=Empleado::where('usuario_id',$_usuario->id)->first();
        
    	
        if (empty($_usuario)==false)
    		{
    			$respuesta=[true,$persona->nombre,$persona->apellido]; 
                return $respuesta;
    		}
    	
    }



    public function redireccion()
    {
        return view('redireccion');
    }


    public function iniciar()
    {
        return view('redireccion');

    }
   
}
