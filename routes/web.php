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






Route::group(['prefix'=>'/menu/registros','middleware'=>['v_menu']],function()
				{

			
				Route::match(['post','get'],'/departamentos',														['middleware'=>'validar_sm:2','uses'=>'RegistrosBasicos@departamentos']);
				Route::match(['post','get'],'/planeservicios',														['middleware'=>'validar_sm:3','uses'=> 'RegistrosBasicos@planes_servicios']);
				Route::match(['post','get'],'/tiposequipos',														['middleware'=>'validar_sm:4','uses'=>'RegistrosBasicos@tipos']);
				Route::match(['post','get'],'/perfiles',															['middleware'=>'validar_sm:5','uses'=>'RegistrosBasicos@perfiles']);
				Route::match(['post','get'],'/empleados',															['middleware'=>'validar_sm:6','uses'=>'RegistrosBasicos@empleados']);
				Route::match(['post','get'],'/clientes',															['middleware'=>'validar_sm:7','uses'=>'RegistrosBasicos@clientes']);
				
				Route::match(['post','get'],'/departamentos/cargos/{departamento_id}',								['middleware'=>'validar_ac:3','uses'=>'RegistrosBasicos@departamentos_cargos']);
				
				Route::match(['post','get'],'/clientes/insertar',                   								['uses'=>'RegistrosBasicos@clientes_insertar']);
				
				Route::match(['post','get'],'/clientes/responsable/{cliente_id}',           						['middleware'=>'validar_ac:10','uses'=>'RegistrosBasicos@clientes_responsables']);
				
				//Route::match(['post','get'],'/clientes/responsable/agregar',               							['middleware'=>'validar_ac','uses'=>'RegistrosBasicos@clientes_responsables_agregar']);

				/**/Route::match(['post','get'],'/clientes/categoria/{cliente_id}',         						['middleware'=>'validar_ac:11','uses'=>'RegistrosBasicos@clientes_categoria']);
				///**/Route::match(['post','get'],'/clientes/categoria/modificar',            						['middleware'=>'validar_ac','uses'=>'RegistrosBasicos@clientes_categoria_modificar']);
				/**/Route::match(['post','get'],'/clientes/categoria/responsable/{categoria_id}',  					['middleware'=>'validar_ac:17','uses'=>'RegistrosBasicos@clientes_categoria_responsable']);
				
				 Route::match(['post','get'],'/clientes/categorias/sucursales',                   					['middleware'=>'validar_ac:19','uses'=>'RegistrosBasicos@clientes_sucursales']);//cliente-categoria-sucursales
				// Route::match(['post','get'],'/clientes/sucursales/modificar',                   					['middleware'=>'validar_ac','uses'=>'RegistrosBasicos@clientes_sucursales_modificar']);
				// Route::match(['post','get'],'/clientes/sucursales/agregar',                   						['middleware'=>'validar_ac','uses'=>'RegistrosBasicos@clientes_sucursales_agregar']);
				 Route::match(['post','get'],'/clientes/categoria/sucursal/responsable',            				['middleware'=>'validar_ac:26','uses'=>'RegistrosBasicos@clientes_sucursales_responsable']);
				 Route::match(['post','get'],'/clientes/categoria/sucursal/plan',                  					['middleware'=>'validar_ac:27','uses'=>'RegistrosBasicos@clientes_sucursales_plan']);
				 Route::match(['post','get'],'/clientes/categoria/sucursal/equipos',                				['middleware'=>'validar_ac:28','uses'=>'RegistrosBasicos@clientes_sucursales_equipos']);
				 Route::match(['post','get'],'/clientes/categoria/sucursal/usuarios',              					['middleware'=>'validar_ac:29','uses'=>'RegistrosBasicos@clientes_sucursales_usuarios']);

				 Route::match(['post','get'],'/empleados/usuarios',															['middleware'=>'validar_sm:6','uses'=>'RegistrosBasicos@empleados_usuarios']);

				///**/Route::match(['post','get'],'/clientes/sucursales/responsable/agregar',         				['middleware'=>'validar_ac','uses'=>'RegistrosBasicos@clientes_sucursales_responsable_agregar']);
				///**/Route::match(['post','get'],'/clientes/sucursales/responsable/modificar',       				['middleware'=>'validar_ac','uses'=>'RegistrosBasicos@clientes_sucursales_responsable_modificar']);
				///**/Route::match(['post','get'],'/clientes/sucursales/plan/agregar',                				['middleware'=>'validar_ac','uses'=>'RegistrosBasicos@clientes_sucursales_plan_agregar']);
				///**/Route::match(['post','get'],'/clientes/sucursales/plan/modificar',              				['middleware'=>'validar_ac','uses'=>'RegistrosBasicos@clientes_sucursales_plan_modificar']);
				
				///**/Route::match(['post','get'],'/clientes/categoria/sucursal/plan/servicios',     					['middleware'=>'validar_ac','uses'=>'RegistrosBasicos@clientes_sucursales_plan_servicios']);
				
				///**/Route::match(['post','get'],'/clientes/sucursales/plan/servicios/modificar',    				['middleware'=>'validar_ac','uses'=>'RegistrosBasicos@clientes_sucursales_plan_serv_modificar']);
				///**/Route::match(['post','get'],'/clientes/sucursales/plan/servicio/agregar',       				['middleware'=>'validar_ac','uses'=>'RegistrosBasicos@clientes_sucursales_plan_serv_agregar']);
				///**/Route::match(['post','get'],'/clientes/sucursales/equipos/agregar',             				['middleware'=>'validar_ac','uses'=>'RegistrosBasicos@clientes_sucursales_equipos_agregar']);
				///**/Route::match(['post','get'],'/clientes/sucursales/equipos/modificar',           				['middleware'=>'validar_ac','uses'=>'RegistrosBasicos@clientes_sucursales_equipos_modificar']);
				/**/Route::match(['post','get'],'/clientes/categoria/sucursal/equipos/componentes', 				['middleware'=>'validar_ac:44','uses'=>'RegistrosBasicos@clientes_sucursales_equipos_componentes']);
				/**/Route::match(['post','get'],'/clientes/categoria/sucursal/equipos/componentes/piezas',			['middleware'=>'validar_ac:48','uses'=> 'RegistrosBasicos@clientes_sucursales_equipos_piezas']);
				/**/Route::match(['post','get'],'/clientes/categoria/sucursal/equipos/componentes/aplicaciones',    ['middleware'=>'validar_ac:49','uses'=> 'RegistrosBasicos@clientes_sucursales_equipos_aplicaciones']);

				///**/Route::match(['post','get'],'/clientes/sucursales/usuario/agregar',                   		 	['middleware'=>'validar_ac','uses'=> 'RegistrosBasicos@clientes_sucursales_usuarios_agregar']);
				///**/Route::match(['post','get'],'/clientes/sucursales/usuario/modificar',                   		['middleware'=>'validar_ac','uses'=> 'RegistrosBasicos@clientes_sucursales_usuarios_modificar']);
				/**/Route::match(['post','get'],'/clientes/categoria/sucursal/usuarios/perfil',                   	['middleware'=>'validar_ac:59','uses'=>  'RegistrosBasicos@clientes_sucursales_usuarios_perfil']);

				//////selects direccion

				Route::match(['post','get'],'/clientes/registrar',                   		 					['uses'=> 'RegistrosBasicos@clientes_registrar']);//select 
			
				Route::match(['post','get'],'/planeservicios/servicios',										['uses'=> 'RegistrosBasicos@planes_servicios_servicios']);

				Route::match(['post','get'],'/clientes/modificar',             									['uses'=>'RegistrosBasicos@clientes_modificar']);
				
				Route::match(['post','get'],'/clientes/responsable/insertar/{cliente_id}',						['uses'=>'RegistrosBasicos@clientes_insertar_responsable']);
				
				Route::match(['post','get'],'/clientes/modificar/responsable',						['uses'=>'RegistrosBasicos@clientes_modificar_responsables']);

				//Route::match(['post','get'],'/prueba/{id_cliente}',						   ['uses'=>'RegistrosBasicos@clientes_modificar']);

				Route::match(['post','get'],'/clientes/categoria/agregar/{cliente_id}',						   ['uses'=>'RegistrosBasicos@clientes_categoria_agregar']);
				Route::match(['post','get'],'/clientes/responsables/actualizar/{cliente_id}',				 ['uses'=>'RegistrosBasicos@clientes_actualizar_responsable']);
				Route::match(['post','get'],'/perfiles/modificar',				 ['uses'=>'RegistrosBasicos@perfiles_modificar]);


				}
			);


				