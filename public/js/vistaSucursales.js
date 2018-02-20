$(document).ready(function() 
{

	/////////////////////// metodos comunes ////////////////////////////////////////////////////////////////////////
	
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



		function loadModal(datos)
		{
			
		$('#razonSs').val(datos.sucursal.razonSocial);
		$('#nombreCs').val(datos.sucursal.nombreComercial);
		$('#inputm3').val(datos.rif.tipo_id);
		$('#inputm4').val(datos.rif.numero);
		$('#inputm5').val(datos.sucursal.tipoContribuyente_id);
		$('#inputm6').val(datos.direccionFiscal.pais_id);
		$('#inputm11').val(datos.direccionComercial.pais_id);
		$('#inputm10').val(datos.direccionFiscal.descripcion);
		$('#inputm15').val(datos.direccionComercial.descripcion);
		$('#inputm20').val(datos.correo.correo);
		// $('#inputm16').val(datos.telefonoLocal.tipo_id);
		// $('#inputm18').val(datos.telefonoMovil.tipo_id);
		// $('#inputm17').val(datos.telefonoLocal.telefono);
		// $('#inputm19').val(datos.telefonoMovil.telefono);

		//////////////////////////////Cargar los selects: direccion fiscal /////////////////////////////////
		// cargarListaDependiente('inn2',0,datos.direccionFiscal.pais_id,datos.direccionFiscal.region_id);//region
		// cargarListaDependiente('inn3',1,datos.direccionFiscal.region_id,datos.direccionFiscal.estado_id);//estado
		// cargarListaDependiente('inn4',2,datos.direccionFiscal.estado_id,datos.direccionFiscal.municipio_id);//municipio

		// //////////////////////////////Cargar los selects: direccion comercial /////////////////////////////////
		// cargarListaDependiente('innn12',0,datos.direccionComercial.pais_id,datos.direccionComercial.region_id);//region
		// cargarListaDependiente('innn13',1,datos.direccionComercial.region_id,datos.direccionComercial.estado_id);//estado
		// cargarListaDependiente('innn14',2,datos.direccionComercial.estado_id,datos.direccionComercial.municipio_id);//municipio


			

		$('#myModal2').modal('show');
		}

	///////////////////////select de direccion /////////////////////////////////////////////////////////////////////


	$('.dirSucursal').change(function() 
	{
			////////////////////////////////grupo representa una pestaña completa (direccion fiscal o direccion comercial), casos: 0 pais, 1 region, 2 estado, 3 municipio 
				var caso=$(this).attr('data-caso');
				var grupo=$(this).attr('data-grupo');
				var registry=$(this).val();
				var route='/menu/registros/empleados/direccion';
				var _token=$( "input[name^='_token']" ).val();
				var listas=[
							['input6','input7','input8','input9'],//direccion fiscal agregar. grupo 0
							['input11','input12','input13','input14']//direccion comercial agregar. grupo 1
						
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

	//////////////////////Guardar nueva sucursal ////////////////////////////////////////////////////////////////////
			$('#btnGuardarSucursal').click(function() 
			{
				var form=$('#sucursalCliente__').serialize();
				var route='/menu/registros/clientes/agregar/sucursal';
				var categoria=$('#categoria__id').val();
								$.post(route,form)
									.done(function(answer)
										{
											
											console.log(answer);
											
											if(answer.codigo==1)
											{
													swal({
															title:'Insercion exitosa',//Contenido del modal
															text: '<p style="font-size: 1.0em;">'+'La sucursal se registro correctamente!!'+'</p>',
															type: "success",
															showConfirmButton:true,//Eliminar boton de confirmacion
															html: true
													},
								  				 	function(isConfirm)
								  				 	{
								  				 		if(isConfirm)
								  				 		{
								  				 			window.location.href="/menu/registros/clientes/categorias/sucursales/"+categoria;
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

			///////////////////////////////////////////////Modificar Cargar Modal //////////////////////////////
			$('.modificarSucursal').click(function() 
			{
				

					var registry=$(this).attr('data-reg');
			        var _token=$( "input[name^='_token']" ).val();
				  	var route='/menu/registros/clientes/modificar/sucursal';
				  	$('#registroSucursal_').val(registry);

				  	  $.post(route,{_token:_token,registry:registry})
					  .done(function(answer)
					  {
					  		
					  	
					  	 loadModal(answer);
					  })

					  .fail(function()
						{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});

			
			});


			////////////////////////////////////////////////////////////////////////////////////////////////////




});