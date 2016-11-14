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






//Route::match(['post','get'],'/login/redireccion','InicioController@redireccion');







Route::get('/login','InicioController@index'); //controlador
Route::post( '/login/verificar','InicioController@verificar');
Route::match(['post','get'],'/menu',['middleware'=>'v_menu','uses'=>'InicioController@iniciarMenu']);//Carga el menu personalizado por perfil //permite el ingreso solo de porseer sesion activa//actual redireccion


//MODULO: REGISTROS BASICOS, rutas de los submodulos ingresadas al clickear en la sidebar o por url //cargaria las acciones disponibles para el perfil logueado






Route::group(['prefix'=>'/menu/registros','middleware'=>['validar_sm','v_menu']],function()
				{

				//Route::match(['post','get'],'/modulos,                                     'RegistrosBasicos@modulos');
				Route::match(['post','get'],'/departamentos',                      		 'RegistrosBasicos@departamentos');
				Route::match(['post','get'],'/servicios',                  				 'RegistrosBasicos@servicios');
				Route::match(['post','get'],'/tiposequipos',               				 'RegistrosBasicos@tipos');
				Route::match(['post','get'],'/perfiles',                   				 'RegistrosBasicos@perfiles');
				Route::match(['post','get'],'/empleados',                  				 'RegistrosBasicos@empleados');
				Route::match(['post','get'],'/clientes',                   				 'RegistrosBasicos@clientes');
				Route::match(['post','get'],'/departamentos/cargos/{departamento_id}',       'RegistrosBasicos@cargos');

				}
			);