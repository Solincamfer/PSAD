$(document).ready(function() 
{
	

function loadModal(datos)
{


	$('#catText').val(datos.nombre);
	$('#catStatus').val(datos.status);

	$('#myModal2').modal('show');
	return 0;
}

////////////////////////////////////////////////////Eliminar Categorias //////////////////////////////////////////////
$('._eliminarCat_').click(function() 
{
	var registry=$(this).data('reg');
			var route='/menu/registros/clientes/eliminar/categorias';
			var _token=$("input[name^='_token']").val();
			var cliente=$('#cliente_id__').val();
		
				swal({
							title: "Eliminar Categoria",
							text: "Al eliminar la categoria seleccionada, eliminara toda la informacion asociada a ella, incluyendo sucursales junto a sus equipos completos,planes,responsables y todo lo relacionado . ¿Desea eliminar la categoria?",
							type: "warning",
							showCancelButton: true,
							confirmButtonColor:'#EE1919',
							confirmButtonText:'Eliminar Categoria',
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
									
									if(answer==1)
									{
										console.log(answer);
										swal({
												title:'Eliminacion Exitosa',//Contenido del modal
												text: '<p style="font-size: 1.0em;">'+''+'</p>',
												type: "success",
												showConfirmButton:true,//Eliminar boton de confirmacion
												html: true
											},
								  		function(isConfirm)
								  			{
								  				if(isConfirm)
								  				 {
								  				 	window.location.href='/menu/registros/clientes/categoria/'+cliente;
								  				 }	

								  			});
										

									}
									else
										{
											 swal("No se elimino la categoria!!!", "", "error");
										}
								})
								.fail(function()
									{ swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
							}
							else
							{
								 
								 swal("Eliminacion Cancelada !!", "", "error");
								
								 
							}
					});
});

/////////////////////////////////////////////////// Modificar Cargar boton modificar ////////////////////////////////

	$('.ModificarCategoria').click(function() 
		{
		 
		  $('#categoriaActualizar').data('bootstrapValidator').resetForm();
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


//////////////////////////////////////Actualizar registro ///////////////////////////////////////////////////////////
$('#categoriaActualizar').bootstrapValidator({
   excluded: [':disabled'],
   fields: {
     nomCat: {
       validators: {
         notEmpty: {
           message: 'Debe indicar el nombre de la nueva categoria'
         }
       }
     },
     stCat: {
       validators: {
         notEmpty: {
           message: 'Debe seleccionar un estatus para la nueva categoria'
         }
       }
     }
   }
}).on('success.form.bv',function(e){
	e.preventDefault();

 
	var form=$('#categoriaActualizar').serialize();
    var route='/menu/registros/clientes/actualiar/categoria';
    var cliente_id=$('#cliente_id__').val();

       		$.post(route,form)
			.done(function(answer)
				{		
					
					if(answer.codigo==1)
					{
							swal({
									title:'Modificación Exitosa',//Contenido del modal
									text: '<p style="font-size: 1.0em;">'+'La categoria se actualizo correctamente!!'+'</p>',
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

/////////////////////////////////////////////////// Agregar Categoria nueva /////////////////////////////////////////////////////
	$('#agregarCategoria__').bootstrapValidator({
		   fields: {
		     nomCat: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar el nombre de la nueva categoria'
		         }
		       }
		     },
		     stCat: {
		       validators: {
		         notEmpty: {
		           message: 'Debe seleccionar un estatus para la nueva categoria'
		         }
		       }
		     }
		   }
        }).on('success.form.bv',function(e){
      		e.preventDefault();
			var form=$('#agregarCategoria__').serialize();
			var route='/menu/registros/clientes/agregar/categoria';
			var cliente_id=$('#cliente_id__').val();
			$.post(route,form)
			.done(function(answer)
					{
								
									
									
									if(answer.codigo==1)
									{
											swal({
													title:'Guardado exitoso',//Contenido del modal
													text: '<p style="font-size: 1.0em;">'+'La categoría se creo correctamente!!'+'</p>',
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