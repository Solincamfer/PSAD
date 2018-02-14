$(document).ready(function() {
	
		/////////////////////Metodos comunes ////////////////////
		function limpiarLista(caso,listas)
		{
			var longitud=4;

			for (var i = caso; i <longitud; i++)
			 {
				
			 	$('.'+listas[i]).remove();
			 }
			 return 0;
		}


		function cargarSelect(datos,idLista)
		{
			var longitud=datos.length;
		 

			for (var i = 0; i < longitud; i++) 
			{
				
				$('#'+idLista).append('<option class="'+idLista+'" value="'+ datos[i].id+'">'+datos[i].descripcion+'</option>')
			}

			return 0;
		}


		function cargarListaDependiente(lista_id,caso,registry,defecto)
		{
			var route='/menu/registros/empleados/direccion';
			var _token=$( "input[name^='_token']" ).val();

			$.post(route,{_token:_token,registry:registry,caso:caso})

							.done(function(answer)
							{
								
								cargarSelect(answer,lista_id)
								$('#'+lista_id).val(defecto);

								
							})

							.fail(function()
								{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});

			return 0;
		}

		function loadModal(datos)
		{
			
		$('#in11').val(datos.cliente.razonSocial);
		$('#in12').val(datos.cliente.nombreComercial);
		$('#in13').val(datos.rif.tipo_id);
		$('#in14').val(datos.rif.numero);
		$('#in15').val(datos.cliente.tipoContribuyente_id);
		$('#inn1').val(datos.direccionFiscal.pais_id);
		$('#innn11').val(datos.direccionComercial.pais_id);
		$('#inn5').val(datos.direccionFiscal.descripcion);
		$('#innn15').val(datos.direccionComercial.descripcion);
		$('#innnn15').val(datos.correo.correo);
		$('#innnn11').val(datos.telefonoLocal.tipo_id);
		$('#innnn13').val(datos.telefonoMovil.tipo_id);
		$('#innnn12').val(datos.telefonoLocal.numero);
		$('#innnn14').val(datos.telefonoMovil.numero);

		//////////////////////////////Cargar los selects: direccion fiscal /////////////////////////////////
		cargarListaDependiente('inn2',0,datos.direccionFiscal.pais_id,datos.direccionFiscal.region_id);//region
		cargarListaDependiente('inn3',1,datos.direccionFiscal.region_id,datos.direccionFiscal.estado_id);//estado
		cargarListaDependiente('inn4',2,datos.direccionFiscal.estado_id,datos.direccionFiscal.municipio_id);//municipio

		//////////////////////////////Cargar los selects: direccion comercial /////////////////////////////////
		cargarListaDependiente('innn12',0,datos.direccionComercial.pais_id,datos.direccionComercial.region_id);//region
		cargarListaDependiente('innn13',1,datos.direccionComercial.region_id,datos.direccionComercial.estado_id);//estado
		cargarListaDependiente('innn14',2,datos.direccionComercial.estado_id,datos.direccionComercial.municipio_id);//municipio


			

		$('#myModal2').modal('show');
		}
		///////////////////////////////////////////////////////////////////////////////////////////


		////////////////////Control de los select de direccion ///////////////////
		$('.dirCliente').change(function()
			{

				var caso=$(this).attr('data-caso');
				var grupo=$(this).attr('data-grupo');
				var registry=$(this).val();
				var route='/menu/registros/empleados/direccion';
				var _token=$( "input[name^='_token']" ).val();
				var listas=[
							['ipp1','ipp2','ipp3','ipp4'],//direccion fiscal agregar. grupo 0
							['ippp1','ippp2','ippp3','ippp4'],//direccion comercial agregar. grupo 1
							['inn1','inn2','inn3','inn4'],//direccion fiscal modificar. grupo 2
							['innn11','innn12','innn13','innn14']//direccion comercial modificar. grupo 3
							];
				if(caso<4)
				{

							$.post(route,{_token:_token,registry:registry,caso:caso})

							.done(function(answer)
							{
								
							
								limpiarLista(parseInt(caso)+1,listas[grupo]);
								cargarSelect(answer,listas[grupo][parseInt(caso)+1])

								
							})

							.fail(function()
								{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});


				}

			});



		////////////////////Boton Modificar para traer los datos del cliente al modal ///////////////////////////
		$('.ModificarCliente').click(function() 
		{
			var registry=$(this).attr('data-reg');
		 	var _token=$( "input[name^='_token']" ).val();
		  	var route='/menu/registros/clientes/modificar';
		  	$('#_idCliente_').val(registry);

		  	  $.post(route,{_token:_token,registry:registry})
			  .done(function(answer)
			  {
			  		
			  	loadModal(answer);
			  })

			  .fail(function()
				{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});

			
		});
		/////////////////////Boton Guardar cliente modificado///////////////////////////////////////////////////
		$('#btnModificarCliente').click(function()
		{
			var form=$('#Formclientemd').serialize();
       		var route='/menu/registros/clientes/actualizar';

       		$.post(route,form)
			.done(function(answer)
				{
					
					console.log(answer);
					if(answer.codigo==2)
					{
						swal({
									title:'RIF duplicado!!!',//Contenido del modal
									text: '<p style="font-size: 0.9em;">El RIF ingresado se encuentra asociado al cliente: '+answer.extra+'</p>',
									type: "warning",
									showConfirmButton:true,//Eliminar boton de confirmacion
									html: true
							});
					}
					else
					{
						swal({
									title:'Actualizacion exitosa',//Contenido del modal
									text: '<p style="font-size: 1.0em;">'+'Los datos del cliente se guardaron correctamente!!!'+'</p>',
									type: "success",
									showConfirmButton:true,//Eliminar boton de confirmacion
									html: true
								},
		  				 	function(isConfirm)
		  				 	{
		  				 		if(isConfirm)
		  				 		{
		  				 			window.location.href="/menu/registros/clientes";
		  				 		}	

		  				 	});
					}

				})
			.fail(function()
				{
					swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
				});
		});

		////////////////////Boton guardar nuevo cliente ////////////////////////////////////////////////////////
		$('#btnGuardarCliente').click(function() 
		{
			var form=$('#Formclientesv').serialize();
			var route='/menu/registros/clientes/insertar';
			$.post(route,form)
			.done(function(answer)
				{
					
					console.log(answer);
					
					if(answer.codigo==1)
					{
							swal({
									title:'Insercion exitosa',//Contenido del modal
									text: '<p style="font-size: 1.0em;">'+'El cliente se registro correctamente!!'+'</p>',
									type: "success",
									showConfirmButton:true,//Eliminar boton de confirmacion
									html: true
							},
		  				 	function(isConfirm)
		  				 	{
		  				 		if(isConfirm)
		  				 		{
		  				 			window.location.href="/menu/registros/clientes";
		  				 		}	

		  				 	});
		  				 
					}

					else if(answer.codigo==2)
					{

						swal({
									title:'Rif duplicado!!!',//Contenido del modal
									text: '<p style="font-size: 0.9em;">'+'Se encuentra asociado al cliente  : '+ answer.extra+'.<br><br><br>El RIF debe ser unico.</p>',
									type: "warning",
									showConfirmButton:true,//Eliminar boton de confirmacion
									html: true
							});
					}
				
		
				})
			.fail(function()
				{
					swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
				});

		});


		////////////////////////////////Funcion para los Checks //////////////////////////////////////////
		$('.checkClientes').change(function()
			{

					var estados=[false,true];
					var valores=[1,0];
		            var colores=["#207D07","#EE1919"];
		            var acciones=['Habilitar','Deshabilitar'];
		            var mensajes=['Habilitado','Deshabilitado'];
					////////////////////////////////////////////////////////////////////////////////////

					var _token=$( "input[name^='_token']" ).val();
					var actual=$(this);
					var registry=actual.attr('data-reg');
					var valor=actual.val();
					var route='/menu/registros/clientes/status';

					swal({
						title: "Cambio de status",
						text: "¿Desea "+acciones[valor]+" El cliente seleccionado ?",
						type: "warning",
						showCancelButton: true,
						confirmButtonColor:colores[valor],
						confirmButtonText: acciones[valor]+' cliente',
						cancelButtonText: "Cancelar",
						closeOnConfirm: false,
						closeOnCancel: false
					 },
					 function(isConfirm)
					 {

					 		if(isConfirm)
					 		{

								$.post(route, {_token:_token,registry:registry})
								.done(function(answer)
								{
									if(answer.update)
									{
										swal("Modificacion exitosa !!", "El cliente ha sido "+mensajes[valor]+" correctamente", "success");
										$('#'+actual.attr('id')).val(valores[valor]);

									}
								})
								.fail(function()
									{ swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
							}
							else
							{
								 
								 swal("Cambio de status cancelado !!", "No se modifico el status del cliente", "error");
								 actual.prop('checked',estados[valor]);
								 $('#'+actual.attr('id')).val(valor);
								 
							}
					});







			});



});	