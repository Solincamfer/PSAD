<?php

namespace App\Http\Controllers;

use App\usuario;
use Request;


class InicioController extends Controller
{
    public function index()
    {
    	return view('login');
    }//



    public function verificar()
    {
    	$usuario=Request::get('user');
    	$password=Request::get('pwd');
    	
    	$_usuario=usuario::where('usuario_',$usuario)->where('clave',$password)->first();
    	
        
    	if (empty($_usuario)==false)
    		{
    			return view('redireccion');
    		}
    	else
    		{

    		 	return view('login');	
    		}
    }
   
}