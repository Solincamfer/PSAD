$(document).ready(function() 
{
	

/////////////////////////////////////////////////////////////////////////////////////////////////////////
function loadModal(datos)
{

 $('#nomApm').val(datos.descripcion);
 $('#LicApm').val(datos.licencia);
 $('#LicApMod').val(datos.version);
 $('#selStApm').val(datos.status);

 $('#regAplicacion_').val(datos.id);


 $('#myModal2').modal('show');

 return 0;
}

//////////////////////////Guardar nueva aplicacion //////////////////////////////////////////////////////
	$('#__btnSvAplicacion___').click(function() 
	{
		var form=$('#regisAplicAgr').serialize();
		var route='/menu/registros/clientes/insertar/aplicaciones';
		var equipo=$('#__equipo__id__').val();
		alert(form);

		$.post(route,form)

			.done(function(answer)
				{
					if(answer.codigo==1)
								{
										swal({
												title:'Insercion Exitosa',//Contenido del modal
												text: '<p style="font-size: 1.0em;">'+'La aplicacion se agrego correctamente!!'+'</p>',
												type: "success",
												showConfirmButton:true,//Eliminar boton de confirmacion
												html: true
										},
					  				 	function(isConfirm)
					  				 	{
					  				 		if(isConfirm)
					  				 		{
					  				 			window.location.href='/menu/registros/clientes/categoria/sucursal/equipos/aplicaciones/'+equipo;
					  				 		}	

					  				 	});
					  				 
								}

								else if(answer.codigo==2)
								{

									swal({
												title:'Aplicacion duplicada!!!',
												text: '<p style="font-size: 0.9em;">'+ answer.extra+'</p>',
												type: "warning",
												showConfirmButton:true,
												html: true
										});
								}
				})
			.fail(function()
						{
							swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
						});
	});


	/////////////////////////////////////////////Modificar aplicacion ////////////////////////////////////////////////////
	$('.modificarAplicacion').click(function() 
	{
		var route='/menu/registros/clientes/modificar/aplicaciones';
		var registry=$(this).data('reg');
		var equipo=$('#__equipo__id__').val();
		var _token=$( "input[name^='_token']" ).val();

		$.post(route,{_token:_token,registry:registry})

			.done(function(answer)
			{
				loadModal(answer);
			})

			.fail(function()
			{
				swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
			});




	});

	//////////////////////////Guardar datos de la modificacion ////////////////////////////////////////////////////////////

	$('#btnSvmAplicacion__').click(function()
		{
			var form=$('#regisAplicMod').serialize();
			var route='/menu/registros/clientes/actualizar/aplicaciones';
			var equipo=$('#__equipo__id__').val();

			$.post(route,form)
				.done(function(answer)
				{
					console.log(answer);
				})
				.fail(function()
				{
					swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
				});





		});






	/////////////////////////////////////////////Check de status /////////////////////////////////////////////////////////

});