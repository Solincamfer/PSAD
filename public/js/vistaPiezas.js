$(document).ready(function() 
{	
  
	
	function loadModal(datos)
	{
		/////////////////cargar opciones de las listas ///////////////////
		$('.selectMP2').remove();
		cargarSelect(datos.marcas,'selectMP2');

		$('.selectMOP2').remove();
		cargarSelect(datos.modelos,'selectMOP2');

		
		/////////////////////////////////////////////////////////////////

		$('#selectNP2').val(datos.descripcion);

		$('#serialPIZ2').val(datos.serial);

		$('#selectMP2').val(datos.marca);


		$('#selectMOP2').val(datos.modelo);

		$('#selectSTP2').val(datos.status);

		$('#myModal2').modal('show');


		return 0;
	}


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

		

		///////////////////////////////select dependientes //////////////////////////////////////////////

		    $('.selectPiezas').change(function()
		    {
		    	var route='/menu/registros/clientes/select/piezas';
		    	var _token=$( "input[name^='_token']" ).val();
				var listas=[['selectNP1','selectMP1','selectMOP1'],['selectNP2','selectMP2','selectMOP2']];
				var caso=$(this).data('caso');
				var grupo=$(this).data('grupo');
				var registry=$(this).val();
				var auxiliar=0;

				if (caso==1) {auxiliar=$('#'+listas[grupo][0]).val();}

					if(caso<2)
					{
						limpiarLista(parseInt(caso)+1,listas[grupo]);

						if(registry!='')
						{

							$.post(route,{_token:_token,registry:registry,caso:caso,auxiliar:auxiliar})
								  .done(function(answer)
								  {
								  	
								  	
								  	cargarSelect(answer,listas[grupo][parseInt(caso)+1]);

								  })

								  .fail(function()
									{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
						}
					}
		    });	



		    //////////////////////////////////////////////////////Guardar nueva pieza /////////////////////////////////////////////
		    $('#btnSvPieza__').click(function()
		    	{

		    		var form=$('#pieZaAgr').serialize();
		    		var route='/menu/registros/clientes/insertar/pieza';
		    		var componente=$('#RegComponente__').val();

		    			$.post(route,form)
					.done(function(answer)
						{

							
								if(answer.codigo==1)
								{
										swal({
												title:'Guardado exitoso',//Contenido del modal
												text: '<p style="font-size: 1.0em;">'+'El la pieza se agrego correctamente!!'+'</p>',
												type: "success",
												showConfirmButton:true,//Eliminar boton de confirmacion
												html: true
										},
					  				 	function(isConfirm)
					  				 	{
					  				 		if(isConfirm)
					  				 		{
					  				 			window.location.href="/menu/registros/clientes/categoria/sucursal/equipos/componentes/piezas/"+componente;
					  				 		}	

					  				 	});
					  				 
								}

								else if(answer.codigo==2)
								{

									swal({
												title:'Nombre duplicado!!!',//Contenido del modal
												text: '<p style="font-size: 0.9em;">'+ answer.extra+'</p>',
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





		    /////////////////////////////////////Modificar pieza //////////////////////////////////////////////


		    $('.modificarPieza').click(function()
		    	{
		    		
		    		
		    		var _token=$( "input[name^='_token']" ).val();
		    		var registry=$(this).data('reg');
		    		$('#RegPieza__').val(registry);
					var componente=$('#RegComponente__').val();
					var route='/menu/registros/clientes/modificar/pieza';
					$.post(route,{_token:_token,registry:registry})
							.done(function(answer)
								{

									
									
									
									console.log(answer);
									loadModal(answer);
										
								})
							.fail(function()
								{
									swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
								});
					    	});




		    ////////////////////////////////Actualizar pieza /////////////////////////////////////////////////////

$('#btnSvmPieza__').click(function() 
	{
		var form=$('#pieZaMod').serialize();
		var route='/menu/registros/clientes/actualizar/pieza';
	 	var componente=$('#RegComponente__').val();

				$.post(route,form)
				.done(function(answer)
					{
						console.log(answer);

						
						if(answer.codigo==1)
						{
								swal({
										title:'Modificacion exitosa',//Contenido del modal
										text: '<p style="font-size: 1.0em;">'+'la pieza  se modifico correctamente!!'+'</p>',
										type: "success",
										showConfirmButton:true,//Eliminar boton de confirmacion
										html: true
								},
			  				 	function(isConfirm)
			  				 	{
			  				 		if(isConfirm)
			  				 		{
			  				 			window.location.href="/menu/registros/clientes/categoria/sucursal/equipos/componentes/piezas/"+componente;
			  				 		}	

			  				 	});
			  				 
						}

						else if(answer.codigo==2)
						{

							swal({
										title:'Nombre de equipo duplicado!!!',//Contenido del modal
										text: '<p style="font-size: 0.9em;">'+ answer.extra+'</p>',
										type: "warning",
										showConfirmButton:true,//Eliminar boton de confirmacion
										html: true
								});
						}
						else if(answer.codigo==0)
						{
							$('#myModal2').modal('hide');
						}
					})
				.fail(function()
					{
						swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
					});
	});

 ////////////////////////////////check de status ////////////////////////////////////////////////////////////
 $('.checkPiezas').change(function() 
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
					var route='/menu/registros/clientes/piezas/status';

					swal({
						title: "Cambio de status",
						text: "¿Desea "+acciones[valor]+" La pieza seleccionada ?",
						type: "warning",
						showCancelButton: true,
						confirmButtonColor:colores[valor],
						confirmButtonText: acciones[valor]+' pieza',
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
										swal("Modificacion exitosa !!", "La pieza ha sido "+mensajes[valor]+" correctamente", "success");
										$('#'+actual.attr('id')).val(valores[valor]);

									}
								})
								.fail(function()
									{ swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
							}
							else
							{
								 
								 swal("Cambio de status cancelado !!", "No se modifico el status de la pieza", "error");
								 actual.prop('checked',estados[valor]);
								 $('#'+actual.attr('id')).val(valor);
								 
							}
					});

	});




});