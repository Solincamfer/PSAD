<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrosBasicos extends Controller
{
    

	public function iniciar ()
	{
		return view('clientes');
	}


	public function iniciar_ ()
	{
		return view('departamentos');
	}

 public function cargos()
 {
 	return view('cargos');

 }
}
