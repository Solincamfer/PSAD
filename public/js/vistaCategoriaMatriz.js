$(document).ready(function() 
{
	

function loadModal(datos)
{


	$('#catText').val(datos.nombre);
	$('#catStatus').val(datos.status);

	$('#myModal2').modal('show');
	return 0;
}



/////////////////////////////////////////////////// Modificar Cargar boton modificar ////////////////////////////////

	$('.ModificarCategoria').click(function() 
		{
		 

		  var registry=$(this).attr('data-reg');
		  var _token=$( "input[name^='_token']" ).val();
		  var route='/menu/registros/clientes/modificar/categoria';
		  $('#_idCategoria_').val(registry);
		  

		  $.post(route,{_token:_token,registry:registry})
		  .done(function(answer)
		  {
		  	
		  	
		  	loadModal(answer);
		  })

		  .fail(function()
			{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});

		});


//////////////////////////////////////Actualiar registro ///////////////////////////////////////////////////////////
$('#btnModificarCategoria').click(function() 
{
	var form=$('#categoriaActualiar').serialize();
    var route='/menu/registros/clientes/actualiar/categoria';
    var cliente_id=$('#cliente_id__').val();

       		$.post(route,form)
			.done(function(answer)
				{
					
						
					if(answer.codigo==1)
					{
							swal({
									title:'Isercion exitosa',//Contenido del modal
									text: '<p style="font-size: 1.0em;">'+'La categoria se registro correctamente!!'+'</p>',
									type: "success",
									showConfirmButton:true,//Eliminar boton de confirmacion
									html: true
							},
		  				 	function(isConfirm)
		  				 	{
		  				 		if(isConfirm)
		  				 		{
		  				 			window.location.href="/menu/registros/clientes/categoria"+cliente_id;
		  				 		}	

		  				 	});
		  				 
					}

					else if(answer.codigo==2)
					{

						swal({
									title:'Categoria duplicada!!!',//Contenido del modal
									text: '<p style="font-size: 0.9em;">'+ answer.extra+'.<br><br><br>Ingrese un nombre de categoria diferente.</p>',
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

/////////////////////////////////////////////////// Agregar Categoria nueva /////////////////////////////////////////////////////
	$('#btnGuardarCategoria').click(function()
		{
		
			var form=$('#agregarCategoria__').serialize();
			var route='/menu/registros/clientes/agregar/categoria';
			var cliente_id=$('#cliente_id__').val();
			$.post(route,form)
			.done(function(answer)
					{
								
									
									
									if(answer.codigo==1)
									{
											swal({
													title:'Isercion exitosa',//Contenido del modal
													text: '<p style="font-size: 1.0em;">'+'La categoiria se creo correctamente!!'+'</p>',
													type: "success",
													showConfirmButton:true,//Eliminar boton de confirmacion
													html: true
											},
						  				 	function(isConfirm)
						  				 	{
						  				 		if(isConfirm)
						  				 		{
						  				 			window.location.href="/menu/registros/clientes/categoria/"+cliente_id;
						  				 		}	

						  				 	});
						  				 
									}

									else if(answer.codigo==2)
									{

										swal({
													title:'Categoria duplicada!!!',//Contenido del modal
													text: '<p style="font-size: 0.9em;">'+ answer.extra+'.<br><br><br>Ingrese un nombre de categoria diferente.</p>',
													type: "warning",
													showConfirmButton:true,//Eliminar boton de confirmacion
													html: true
											});
									}

								
					})

			.fail(function()
				{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
		});







		/////////////////////////////////////////////Funcion para los Check ///////////////////////////////////////////////////

		$('.checkCategoria').change(function()
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
			var route='/menu/registros/clientes/status/categoria';

			swal({
				title: "Cambio de status",
				text: "¿Desea "+acciones[valor]+" La categoria seleccionada ?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor:colores[valor],
				confirmButtonText: acciones[valor]+' Categoria',
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
								swal("Modificacion exitosa !!", "La categoria ha sido "+mensajes[valor]+" correctamente", "success");
								$('#'+actual.attr('id')).val(valores[valor]);

							}
						})
						.fail(function()
							{ swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
					}
					else
					{
						 
						 swal("Cambio de status cancelado !!", "No se modifico el status de la categoria", "error");
						 actual.prop('checked',estados[valor]);
						 $('#'+actual.attr('id')).val(valor);
						 
					}
			});

		});



	
});