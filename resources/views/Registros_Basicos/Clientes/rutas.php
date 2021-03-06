//Route::match(['post','get'],'/modulos,                                     'RegistrosBasicos@modulos');
				Route::match(['post','get'],'/departamentos',                      		 'RegistrosBasicos@departamentos');
				Route::match(['post','get'],'/servicios',                  				 'RegistrosBasicos@servicios');
				Route::match(['post','get'],'/tiposequipos',               				 'RegistrosBasicos@tipos');
				Route::match(['post','get'],'/perfiles',                   				 'RegistrosBasicos@perfiles');
				Route::match(['post','get'],'/empleados',                  				 'RegistrosBasicos@empleados');
				Route::match(['post','get'],'/clientes',                   				 'RegistrosBasicos@clientes');
				Route::match(['post','get'],'/departamentos/cargos/{departamento_id}',   'RegistrosBasicos@departamentos_cargos');
				
				Route::match(['post','get'],'/clientes/insertar',                   				 'RegistrosBasicos@clientes_insertar');
				Route::match(['post','get'],'/clientes/responsable/{cliente_id}',                   				 'RegistrosBasicos@clientes_responsables');
				Route::match(['post','get'],'/clientes/responsable/modificar',                   	 'RegistrosBasicos@clientes_responsables_modificar');
				Route::match(['post','get'],'/clientes/responsable/agregar',                   		 'RegistrosBasicos@clientes_responsables_agregar');

				/**/Route::match(['post','get'],'/clientes/categoria/{cliente_id}',                   			  'RegistrosBasicos@clientes_categoria');
				/**/Route::match(['post','get'],'/clientes/categoria/modificar',                   	  'RegistrosBasicos@clientes_categoria_modificar');
				/**/Route::match(['post','get'],'/clientes/categoria/responsable/{categoria_id}',                   			  'RegistrosBasicos@clientes_categoria_responsable');
				
				 Route::match(['post','get'],'/clientes/categorias/sucursales',                   				 'RegistrosBasicos@clientes_sucursales');//cliente-categoria-sucursales
				 Route::match(['post','get'],'/clientes/sucursales/modificar',                   	 'RegistrosBasicos@clientes_sucursales_modificar');
				 Route::match(['post','get'],'/clientes/sucursales/agregar',                   		 'RegistrosBasicos@clientes_sucursales_agregar');
				 Route::match(['post','get'],'/clientes/categoria/sucursal/responsable',                   	 'RegistrosBasicos@clientes_sucursales_responsable');
				 Route::match(['post','get'],'/clientes/categoria/sucursal/plan',                   			 'RegistrosBasicos@clientes_sucursales_plan');
				 Route::match(['post','get'],'/clientes/categoria/sucursal/equipos',                   		 'RegistrosBasicos@clientes_sucursales_equipos');
				 Route::match(['post','get'],'/clientes/categoria/sucursal/usuarios',                   		 'RegistrosBasicos@clientes_sucursales_usuarios');

				/**/Route::match(['post','get'],'/clientes/sucursales/responsable/agregar',              'RegistrosBasicos@clientes_sucursales_responsable_agregar');
				/**/Route::match(['post','get'],'/clientes/sucursales/responsable/modificar',              'RegistrosBasicos@clientes_sucursales_responsable_modificar');
				/**/Route::match(['post','get'],'/clientes/sucursales/plan/agregar',                   			 'RegistrosBasicos@clientes_sucursales_plan_agregar');
				/**/Route::match(['post','get'],'/clientes/sucursales/plan/modificar',                   			 'RegistrosBasicos@clientes_sucursales_plan_modificar');
				
				/**/Route::match(['post','get'],'/clientes/categoria/sucursal/plan/servicios',                   			 'RegistrosBasicos@clientes_sucursales_plan_servicios');
				
				/**/Route::match(['post','get'],'/clientes/sucursales/plan/servicios/modificar',                   			 'RegistrosBasicos@clientes_sucursales_plan_serv_modificar');
				/**/Route::match(['post','get'],'/clientes/sucursales/plan/servicio/agregar',                   			 'RegistrosBasicos@clientes_sucursales_plan_serv_agregar');
				/**/Route::match(['post','get'],'/clientes/sucursales/equipos/agregar',                   		 'RegistrosBasicos@clientes_sucursales_equipos_agregar');
				/**/Route::match(['post','get'],'/clientes/sucursales/equipos/modificar',                   		 'RegistrosBasicos@clientes_sucursales_equipos_modificar');
				/**/Route::match(['post','get'],'/clientes/categoria/sucursal/equipos/componentes',                   		 'RegistrosBasicos@clientes_sucursales_equipos_componentes');
				/**/Route::match(['post','get'],'/clientes/categoria/sucursal/equipos/componentes/piezas',                   		 'RegistrosBasicos@clientes_sucursales_equipos_piezas');
				/**/Route::match(['post','get'],'/clientes/categoria/sucursal/equipos/componentes/aplicaciones',                   		 'RegistrosBasicos@clientes_sucursales_equipos_aplicaciones');
				/**/Route::match(['post','get'],'/clientes/sucursales/usuario/agregar',                   		 'RegistrosBasicos@clientes_sucursales_usuarios_agregar');
				/**/Route::match(['post','get'],'/clientes/sucursales/usuario/modificar',                   		 'RegistrosBasicos@clientes_sucursales_usuarios_modificar');
				/**/Route::match(['post','get'],'/clientes/categoria/sucursal/usuarios/perfil',                   		 'RegistrosBasicos@clientes_sucursales_usuarios_perfil');

				//////selects direccion

					Route::match(['post','get'],'/clientes/registrar',                   		 'RegistrosBasicos@clientes_registrar');//select 

				
