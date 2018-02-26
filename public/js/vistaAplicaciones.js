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
 $


 $('#myModal2').modal('show');

 return 0;
}

//////////////////////////Guardar nueva aplicacion //////////////////////////////////////////////////////
	
	$('#regisAplicAgr').bootstrapValidator({
		   excluded: [':disabled'],
		   fields: {
		     nomAp: {
		       validators: {
		        notEmpty: {
		           message: 'Indique el nombre de la aplicación'
		        }
		       }
		     },
		     LicAp: {
		       validators: {
		        notEmpty: {
		           message: 'Indique la licencia de la aplicación'
		        }
		       }
		     },
		     VersAp: {
		       validators: {
		         notEmpty: {
		           message: 'Indique la versión de la aplicación'
		         }
		       }
		     },
		     selStAp: {
		       validators: {
		         notEmpty: {
		           message: 'Seleccione el estatus de la aplicación'
		         }
		       }
		     }
		    }
  		}).on('success.form.bv',function(e,data){
			e.preventDefault();
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
													title:'Guardado Exitoso',//Contenido del modal
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
		$('#regisAplicMod').data('bootstrapValidator').resetForm();
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

	$('#regisAplicMod').bootstrapValidator({
		   excluded: [':disabled'],
		   fields: {
		     nomAp: {
		       validators: {
		        notEmpty: {
		           message: 'Indique el nombre de la aplicación'
		        }
		       }
		     },
		     LicAp: {
		       validators: {
		        notEmpty: {
		           message: 'Indique la licencia de la aplicación'
		        }
		       }
		     },
		     VersAp: {
		       validators: {
		         notEmpty: {
		           message: 'Indique la versión de la aplicación'
		         }
		       }
		     },
		     selStAp: {
		       validators: {
		         notEmpty: {
		           message: 'Seleccione el estatus de la aplicación'
		         }
		       }
		     }
		    }
  		}).on('success.form.bv',function(e,data){
			e.preventDefault();
			var form=$('#regisAplicMod').serialize();
			var route='/menu/registros/clientes/actualizar/aplicaciones';
			var equipo=$('#__equipo__id__').val();

			$.post(route,form)
				.done(function(answer)
				{
						console.log(answer);
						if(answer.codigo==1)
								{
										swal({
												title:'Actualización Exitosa',//Contenido del modal
												text: '<p style="font-size: 1.0em;">'+'EL aplicacion se modifico correctamente!!'+'</p>',
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
												title:'Aplicacion duplicada!!!',//Contenido del modal
												text: '<p style="font-size: 0.9em;"> '+ answer.extra+' </p>',
												type: "warning",
												showConfirmButton:true,//Eliminar boton de confirmacion
												html: true
										});
								}
								else if(answer.codigo==0)//si no se produce ningun cambio en el modal lo cierra al oprimir el boton guardar
								{
									$('#myModal2').modal('hide');
								}
				})
				.fail(function()
				{
					swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
				});





		});






	/////////////////////////////////////////////Check de status /////////////////////////////////////////////////////////

	$('.checkAplicacion').change(function()
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
			var route='/menu/registros/clientes/status/aplicaciones';

			swal({
					title: "Cambio de status",
					text: "¿Desea "+acciones[valor]+" La aplicacion seleccionada ?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor:colores[valor],
					confirmButtonText: acciones[valor]+' Aplicacion',
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
							console.log(answer);
							if(answer.update)
							{
								swal("Modificacion exitosa !!", "la aplicacion ha sido "+mensajes[valor]+" correctamente", "success");
								$('#'+actual.attr('id')).val(valores[valor]);

							}
						})
						.fail(function()
							{ swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
					}
					else
					{
						 
						 swal("Cambio de status cancelado !!", "No se modifico el status de la aplicacion", "error");
						 actual.prop('checked',estados[valor]);
						 $('#'+actual.attr('id')).val(valor);
						 
					}
			});
		});







});