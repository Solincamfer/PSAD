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
Route::post('/prueba/json','InicioController@pruebaJson');
Route::match(['post','get'],'/menu',['middleware'=>'v_menu','uses'=>'InicioController@iniciarMenu']);//Carga el menu personalizado por perfil //permite el ingreso solo de porseer sesion activa//actual redireccion
Route::get('/menu/cambio/registros','RegistrosBasicos@cambio_registros'); //check de status
Route::get('/menu/modificar/registros','RegistrosBasicos@modificar_registrosCD'); //modificar registros
Route::get('/buscarRegistros','Buscador@buscarRegistros'); //modificar registros
Route::get('/menu/registros/bitacoras/movimientosUsuario','RegistrosBasicos@movimientosUsuario'); //modificar registros
Route::post('/menu/registros/bitacoras/usuarios','RegistrosBasicos@mostrarUsuarios'); //modificar registros

Route::post('/menu/registros/bitacoras/registros','RegistrosBasicos@movUsuariosReg'); 
//MODULO: REGISTROS BASICOS, rutas de los submodulos ingresadas al clickear en la sidebar o por url //cargaria las acciones disponibles para el perfil logueado






Route::group(['prefix'=>'/menu/registros','middleware'=>['v_menu']],function(){

	Route::match(['post','get'],'/departamentos',														['uses'=>'EstructuraController@departamentos']);
	Route::match(['post','get'],'/planeservicios',														['uses'=> 'RegistrosBasicos@planes_servicios']);
	Route::match(['post','get'],'/tiposequipos',														['uses'=>'RegistrosBasicos@tipos']);
	Route::match(['post','get'],'/perfiles',															['uses'=>'RegistrosBasicos@perfiles']);
	Route::match(['post','get'],'/empleados',															['uses'=>'RegistrosBasicos@empleados']);
	Route::match(['post','get'],'/clientes',															['uses'=>'RegistrosBasicos@clientes']);


	Route::match(['post','get'],'/clientes/insertar',                   								['uses'=>'RegistrosBasicos@clientes_insertar']);

	Route::match(['post','get'],'/clientes/status',                   								['uses'=>'RegistrosBasicos@clientesStatus']);
	Route::match(['post','get'],'/clientes/responsable/agregar',                   					    ['uses'=>'RegistrosBasicos@clientes_insertar_responsable']);
	

	Route::match(['post','get'],'/clientes/responsable/{cliente_id}',           						['uses'=>'RegistrosBasicos@clientes_responsables']);

    // Route::match(['post','get'],'/clientes/responsable/agregar',               							['middleware'=>'validar_ac','uses'=>'RegistrosBasicos@clientes_insertar_responsable']);

	/**/Route::match(['post','get'],'/clientes/categoria/{cliente_id}',         						['uses'=>'RegistrosBasicos@clientes_categoria']);
	
	/**/Route::match(['post','get'],'/clientes/categoria/responsable/{categoria_id}',  					['uses'=>'RegistrosBasicos@clientes_categoria_responsable']);

	Route::match(['post','get'],'/clientes/responsable/asignar/categoria',  					        ['uses'=>'RegistrosBasicos@categoriasAsignarResponsable']);

	Route::match(['post','get'],'/clientes/responsable/status/categoria',  					        ['uses'=>'RegistrosBasicos@respCatStatus']);


	 Route::match(['post','get'],'/clientes/categorias/sucursales/{categoria_id}',                   					['uses'=>'RegistrosBasicos@clientes_sucursales']);//cliente-categoria-sucursales

	 Route::match(['post','get'],'/clientes/categoria/sucursal/responsable/{sucursal_id}',            	['uses'=>'RegistrosBasicos@clientes_sucursales_responsable']);
	 Route::match(['post','get'],'/clientes/categoria/sucursal/plan/{sucursal_id}',                  	['uses'=>'RegistrosBasicos@clientes_sucursales_plan']);
	 Route::match(['post','get'],'/clientes/categoria/sucursal/equipos/{sucursal_id}',                	['uses'=>'RegistrosBasicos@clientes_sucursales_equipos']);
	 Route::match(['post','get'],'/clientes/categoria/sucursal/usuarios/{sucursal_id}',              	['uses'=>'RegistrosBasicos@clientes_sucursales_usuarios']);

	 Route::match(['post','get'],'/empleados/perfil/{empleado_id}',										['uses'=>'RegistrosBasicos@empleados_perfiles']);

	/**/Route::match(['post','get'],'/clientes/categoria/sucursal/equipos/componentes/{equipo_id}', 	       ['uses'=>'RegistrosBasicos@clientes_sucursales_equipos_componentes']);
	/**/Route::match(['post','get'],'/clientes/categoria/sucursal/equipos/componentes/piezas/{componente_id}', ['uses'=> 'RegistrosBasicos@clientes_sucursales_equipos_piezas']);
	/**/Route::match(['post','get'],'/clientes/categoria/sucursal/equipos/aplicaciones/{equipo_id}',           ['uses'=> 'RegistrosBasicos@clientes_sucursales_equipos_aplicaciones']);
Route::match(['post','get'],'/clientes/categoria/sucursal/usuarios/perfil',                   		['uses'=>  'RegistrosBasicos@clientes_sucursales_usuarios_perfil']);

	//////selects direccion

	Route::match(['post','get'],'/clientes/registrar',                   		 							['uses'=> 'RegistrosBasicos@clientes_registrar']);//select

	Route::match(['post','get'],'/planeservicios/servicios/{plan_id}',										['uses'=> 'RegistrosBasicos@planes_servicios_servicios']);

	Route::match(['post','get'],'/clientes/modificar',             											['uses'=>'RegistrosBasicos@clientes_modificar']);

	

	Route::match(['post','get'],'/clientes/modificar/responsable',											['uses'=>'RegistrosBasicos@clientes_modificar_responsables']);

	Route::match(['post','get'],'/prueba',						  										    ['uses'=>'Buscador@prueba_metodo']);
	
	Route::match(['post','get'],'/clientes/agregar/categoria',				 							['uses'=>'RegistrosBasicos@clientes_categoria_agregar']);
	
	Route::match(['post','get'],'/clientes/status/categoria',				 							['uses'=>'RegistrosBasicos@clientes_categoria_status']);
	




	Route::match(['post','get'],'/clientes/responsables/actualizar',				 			            ['uses'=>'RegistrosBasicos@clientes_actualizar_responsable']);
	Route::match(['post','get'],'/perfiles/permisos/{perfil_id}',				 							['uses'=>'RegistrosBasicos@perfiles_permisos']);


	Route::match(['post','get'],'/clientes/responsables/status',				 							['uses'=>'RegistrosBasicos@responsables_status']);

	Route::match(['post','get'],'/clientes/responsables/asignar',				 							['uses'=>'RegistrosBasicos@responsablesMatriz_asignar']);

	Route::match(['post','get'],'/clientes/actualiar/categoria',		                 				   	['uses'=>'RegistrosBasicos@clientes_categorias_actualizar']);

	Route::match(['post','get'],'/clientes/modificar/categoria',						  					['uses'=>'RegistrosBasicos@clientes_categorias_modificar']);
	Route::match(['post','get'],'/clientes/actualizar/categoria',						   					['uses'=>'RegistrosBasicos@clientes_actualizar']);
	Route::match(['post','get'],'/clientes/categoria/insertar/responsable/{categoria_id}',					['uses'=>'RegistrosBasicos@clientes_insertar_responsable_categoria']);
	Route::match(['post','get'],'/clientes/categoria/modificar/responsable',								['uses'=>'RegistrosBasicos@clientes_modificar_responsables']);
	Route::match(['post','get'],'/clientes/categoria/actualizar/responsable/{categoria_id}',			    ['uses'=>'RegistrosBasicos@categorias_actualizar_responsables']);
	Route::match(['post','get'],'/clientes/actualizar',														['uses'=>'RegistrosBasicos@clientes_actualizar']);
	Route::match(['post','get'],'/perfiles/submodulos',														['uses'=>'RegistrosBasicos@mostrar_submodulos']);
	Route::match(['post','get'],'/perfiles/acciones',														['uses'=>'RegistrosBasicos@mostrar_acciones']);
	Route::match(['post','get'],'/empleados/asignar/perfil',												['uses'=>'RegistrosBasicos@empleados_asignar_perfil']);
	Route::match(['post','get'],'/departamentos/registrar',                                                 ['uses'=>'RegistrosBasicos@departamentos_ingresar'] );
	Route::match(['post','get'],'/actualizar',                                                              ['uses'=>'RegistrosBasicos@actualizar_registrosCD']);
	Route::match(['post','get'],'/departamentos/cargos/registrar/{departamento_id}',                      	['uses'=>'RegistrosBasicos@cargos_ingresar']);
	Route::match(['post','get'],'/perfiles/registrar',                                                      ['uses'=>'RegistrosBasicos@perfiles_insertar']);
	Route::match(['post','get'],'/perfiles/status',                                                         ['uses'=>'RegistrosBasicos@perfilesModificarStatus']);
	Route::match(['post','get'],'/perfiles/modificar',                                                  	['uses'=>'RegistrosBasicos@perfilesModificar']);
	Route::match(['post','get'],'/perfiles/actualizar',                                                  	['uses'=>'RegistrosBasicos@perfilesActualizar']);

	Route::match(['post','get'],'/perfiles/configurar/modulo',                                              ['uses'=>'RegistrosBasicos@perfiles_configurar_moduloDependencias']);
	Route::match(['post','get'],'/perfiles/configurar/modulo_',                                             ['uses'=>'RegistrosBasicos@perfiles_configurar_modulo']);
	Route::match(['post','get'],'/perfiles/configurar/submodulo',                                           ['uses'=>'RegistrosBasicos@perfiles_configurar_submoduloDependencias']);
	Route::match(['post','get'],'/perfiles/configurar/submodulo_',                                          ['uses'=>'RegistrosBasicos@perfiles_configurar_submodulo']);
	Route::match(['post','get'],'/perfiles/configurar/accion',                                          	['uses'=>'RegistrosBasicos@perfiles_configurar_accion']);


/*////////////////////////////////Planes y servicios//////////////////////////////////////////*/
	Route::match(['post','get'],'/planes/registrar',                                                     	 ['uses'=>'RegistrosBasicos@planesIngresar']);

	Route::match(['post','get'],'/planes/actualizar',                                               		 ['uses'=>'RegistrosBasicos@planesActualizar']);
	Route::match(['post','get'],'/planes/modificar',                                               			 ['uses'=>'RegistrosBasicos@planesModificar']);
	Route::match(['post','get'],'/planes/status',                                               			 ['uses'=>'RegistrosBasicos@planesModificarStatus']);

	Route::match(['post','get'],'/planes/consultarservicios',                                               ['uses'=>'RegistrosBasicos@valores_servicios']);
	Route::match(['post','get'],'/planes/servicios/insertar',                                               ['uses'=>'RegistrosBasicos@insertar_servicios']);

////////////////////////// DATOS COMPLEMENTARIOS  //////////////////////////////////////////////////////////////////////////////////////////////////////////
	Route::match(['post','get'],'/datos',                                              						['uses'=>'RegistrosBasicos@datos_complementarios']);
	Route::match(['post','get'],'/datos/tipoequipo',                                              			['uses'=>'RegistrosBasicos@tipo_equipos']);
	Route::match(['post','get'],'/datos/consulta',                                              			['uses'=>'RegistrosBasicos@datos_tipo_equipos']);
	Route::match(['post','get'],'/datos/consulta_comp',                                              		['uses'=>'RegistrosBasicos@datos_tequipo_componente']);
	Route::match(['post','get'],'/datos/consulta_comp_',                                              		['uses'=>'RegistrosBasicos@insertar_componente_']);
	Route::match(['post','get'],'/datos/consulta_comp_pieza',                                              	['uses'=>'RegistrosBasicos@datos_componentes_piezas']);
	Route::match(['post','get'],'/datos/consulta_dinamica',                                              	['uses'=>'RegistrosBasicos@datos_consulta_dinamica']);
	Route::match(['post','get'],'/datos/consulta_insertar_pieza',                                           ['uses'=>'RegistrosBasicos@insertar_piezas']);
	Route::match(['post','get'],'/datos/eliminar_pieza',		                                            ['uses'=>'RegistrosBasicos@eliminar_piezas']);
	Route::match(['post','get'],'/datos/marcaequipo',                                              			['uses'=>'RegistrosBasicos@marca_equipos']);
	Route::match(['post','get'],'/datos/marcacomponente',                                              		['uses'=>'RegistrosBasicos@marca_componentes']);
	Route::match(['post','get'],'/datos/marcapieza',                                              			['uses'=>'RegistrosBasicos@marca_piezas']);
/////////////////////////Agregadas el jueves 19/01/2017////////////////////////////////////////////////////////////////////////////////////////

	Route::match(['post','get'],'/datos/eliminar_componente',                                              	['uses'=>'RegistrosBasicos@eliminar_componentes']);
///////////////////////Agregadas el viernes 20/01/2017//////////////////////////////////////////////////////////////////////////////
	Route::match(['post','get'],'/clientes/modificar_pieza',		                                        ['uses'=>'RegistrosBasicos@btn_modificar_pieza']);
	Route::match(['post','get'],'/clientes/modificar_componente',		                                    ['uses'=>'RegistrosBasicos@btn_modificar_componente']);
	Route::match(['post','get'],'/clientes/modificar_aplicacion',		                                    ['uses'=>'RegistrosBasicos@btn_modificar_aplicacion']);
	Route::match(['post','get'],'/clientes/modificar_equipo',		                                        ['uses'=>'RegistrosBasicos@btn_modificar_equipo']);
	Route::match(['post','get'],'/clientes/consultar_select',		                                        ['uses'=>'RegistrosBasicos@select_equipos']);



//////////////////////////////	EMPLEADOS ////////////////////////////////////////////////////////
	Route::match(['post','get'],'/empleados/consulta',                                              			['uses'=>'RegistrosBasicos@cargar_modal_agregar']);
	Route::match(['post','get'],'/empleados/agregar',                                              			    ['uses'=>'RegistrosBasicos@insertar_empleado']);
	Route::match(['post','get'],'/empleados/modificar',                                              			['uses'=>'RegistrosBasicos@empleadosModificar']);
	Route::match(['post','get'],'/empleados/cargar',                                              			    ['uses'=>'RegistrosBasicos@cargar_combos']);
	Route::match(['post','get'],'/empleados/actualizar',                                              			['uses'=>'RegistrosBasicos@empleadosActualizar']);
	Route::match(['post','get'],'/empleados/estructura',                                              			['uses'=>'RegistrosBasicos@selectStructura']);
	Route::match(['post','get'],'/empleados/status',                                              			    ['uses'=>'RegistrosBasicos@empleadosStatus']);
	Route::match(['post','get'],'/empleados/direccion',                                              			['uses'=>'RegistrosBasicos@selectDireccionEmp']);

//////////////////////////// CLIENTES /////////////////////////////////////////////////////////////

	Route::match(['post','get'],'/clientes/consultaplan',						   	                        ['uses'=>'RegistrosBasicos@consultar_plan']);

/////////////////////////// ESTRUCTURA ///////////////////////////////////////////////////////////
Route::match(['post','get'],'/estructura/mostrarEstructuraDireccion',						   	['uses'=>'EstructuraController@mostrarEstructuraDireccion']);
Route::match(['post','get'],'/estructura/mostrarEstructuraTodos',['uses'=>'EstructuraController@mostrarEstructuraTodos']);
Route::match(['post','get'],'/estructura/buscarAreas',['uses'=>'EstructuraController@buscarAreas']);
Route::match(['post','get'],'/estructura/buscarDepartamentos',['uses'=>'EstructuraController@buscarDepartamentos']);
Route::match(['post','get'],'/estructura/buscarDirecciones',['uses'=>'EstructuraController@buscarDirecciones']);
Route::match(['post','get'],'/estructura/buscarCargos',['uses'=>'EstructuraController@buscarCargos']);
Route::match(['post','get'],'/estructura/ingresarDireccion',['uses'=>'EstructuraController@ingresarDireccion']);
Route::match(['post','get'],'/estructura/ingresarDepartamento',['uses'=>'EstructuraController@ingresarDepartamento']);
Route::match(['post','get'],'/estructura/ingresarArea',['uses'=>'EstructuraController@ingresarArea']);
Route::match(['post','get'],'/estructura/ingresarCargo',['uses'=>'EstructuraController@ingresarCargo']);
Route::match(['post','get'],'/estructura/mostrarDatos',['uses'=>'EstructuraController@mostrarDatos']);
Route::match(['post','get'],'/estructura/actualizarDireccion',['uses'=>'EstructuraController@actualizarDireccion']);
Route::match(['post','get'],'/estructura/actualizarDepartamento',['uses'=>'EstructuraController@actualizarDepartamento']);
Route::match(['post','get'],'/estructura/actualizarArea',['uses'=>'EstructuraController@actualizarArea']);
Route::match(['post','get'],'/estructura/actualizarCargo',['uses'=>'EstructuraController@actualizarCargo']);
Route::match(['post','get'],'/estructura/status',['uses'=>'EstructuraController@modificarStatus']);
});
