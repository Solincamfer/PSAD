<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login','InicioController@index'); //controlador




Route::get('/login/redireccion','InicioController@redireccion');


Route::match( ['post','get'], '/login/verificar',

		[
			
			
			'uses'=>'InicioController@verificar'

		]
	);





Route::group
	(
		['prefix'=>'menu' ],function()
			{

		
				Route::match(['post','get'],'/modulos','InicioController@iniciar');
				Route::match(['post','get'],'/modulos/submodulos/clientes','RegistrosBasicos@iniciar');
				Route::match(['post','get'],'/modulos/submodulos/departamentos','RegistrosBasicos@iniciar_');

			}

	);



