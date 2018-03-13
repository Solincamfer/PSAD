$(document).ready(function() 
{
	
	

	function loadModal(datos)
	{
		/////////////////cargar opciones de las listas ///////////////////
		$('.selectMC2').remove();
		cargarSelect(datos.marcas,'selectMC2');

		$('.selectMOC2').remove();
		cargarSelect(datos.modelos,'selectMOC2');

		//////////////cargar id del nombre del componente seleccionado///
		$('#tipoComponente__').val(datos.descripcion);
		/////////////////////////////////////////////////////////////////

		$('#selectNC2').val(datos.descripcion);

		$('#serialCM2').val(datos.serial);

		$('#selectMC2').val(datos.marca);


		$('#selectMOC2').val(datos.modelo);

		$('#selectSC2').val(datos.status);

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

	/////////////////////////////Eliminar componente //////////////////////////
	$('._eliminarComp_').click(function() 
	{
			var registry=$(this).data('reg');
			var route='/menu/registros/clientes/eliminar/componentes';
			var _token=$( "input[name^='_token']" ).val();
			var equipo=$('#equipoPadre_').val();

				swal({
							title: "Eliminar Componente",
							text: "Recuerde que al eliminar el componente, se eliminaran todas sus piezas asociadas, ¿ Desea eliminar el componente ? ",
							type: "warning",
							showCancelButton: true,
							confirmButtonColor:'#EE1919',
							confirmButtonText:'Eliminar Componente',
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
								  				 	window.location.href='/menu/registros/clientes/categoria/sucursal/equipos/componentes/'+equipo;
								  				 }	

								  			});
										

									}
									else
										{
											 swal("No se elimino el componente!!!", "", "error");
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


	function actualizarTipoComponente(caso,registry,route,_token,auxiliar,grupo,listas)
{
	var aux=parseInt(caso);
	aux=aux+1;
	
	if(caso<2)
		{


			if(registry!="")
			{

				$.post(route,{_token:_token,registry:registry,caso:caso,auxiliar:auxiliar})
				  .done(function(answer)
				  {
				  	
				  	
				  	cargarSelect(answer,listas[grupo][aux]);

				  })

				  .fail(function()
					{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
			}
		}
	return 0;
}
	/////////////////////////////Select dependientes //////////////////////////
	$('.selectComponentes').change(function()
		{
			var route='/menu/registros/clientes/selectequipos/componentes';
			var _token=$( "input[name^='_token']" ).val();
			var listas=[['selectNC1','selectMC1','selectMOC1'],['selectNC2','selectMC2','selectMOC2']];
			var caso=$(this).data('caso');
			var grupo=$(this).data('grupo');
			var registry=$(this).val();
			var auxiliar=0;

			
		if (caso==1) 
			{auxiliar=$('#'+listas[grupo][0]).val();}
		
		if(listas[grupo][caso]=='selectNC2')//si se desea moodificar el tipo de equipo
		{
			swal({
							title: "Modificar nombre del componente",
							text: "Al modificar el nombre del componente del equipo seleccionado, perdera las piezas asociadas al mismo . ¿Desea cambiar el nombre del componente?",
							type: "warning",
							showCancelButton: true,
							confirmButtonColor:'#207D07',
							confirmButtonText:'Modificar nombre componente',
							cancelButtonText: "Cancelar",
							closeOnConfirm: false,
							closeOnCancel: false
				},

				function(isConfirm)
					 {

					 	if(isConfirm)
					 		{
					 			limpiarLista(parseInt(caso)+1,listas[grupo]);
								actualizarTipoComponente(caso,registry,route,_token,auxiliar,grupo,listas);	
								swal("Nombre de componente actualizado!!", "", "success");
							}
						else
							{
								  
								swal("Actualizacion Cancelada!!", "", "warning");
								valor.val($('#tipoComponente__').val());
							}
					});

		}
		else
		{
			limpiarLista(parseInt(caso)+1,listas[grupo]);
			actualizarTipoComponente(caso,registry,route,_token,auxiliar,grupo,listas);	
		}
		


		});

	////////////////////////// Agregar nuevo componente ///////////////////////////////////////////////////////

	$('#compAgr_').bootstrapValidator({
		   fields: {
		     selectNC: {
		       validators: {
		        notEmpty: {
		           message: 'Seleccione el componente'
		        }
		       }
		     },
		     serialCM: {
		       validators: {
		        notEmpty: {
		           message: 'Indique el serial del componente'
		        }
		       }
		     },
		     selectMC: {
		       validators: {
		         notEmpty: {
		           message: 'Seleccione la marca del componente'
		         }
		       }
		     },
		     selectMOC: {
		       validators: {
		         notEmpty: {
		           message: 'Seleccione el modelo del componente'
		         }
		       }
		     },
		     selectSC: {
		       validators: {
		         notEmpty: {
		           message: 'Seleccione el estatus del equipo'
		         }
		       }
		     }
		    }
  		}).on('success.form.bv',function(e,data){
			e.preventDefault();
			var form=$('#compAgr_').serialize();
			var route='/menu/registros/clientes/insertar/componente';
			var equipo=$('#equipoPadre_').val();
			$.post(route,form)
						.done(function(answer)
							{

								
									if(answer.codigo==1)
									{
											swal({
													title:'Guardado exitoso',//Contenido del modal
													text: '<p style="font-size: 1.0em;">'+'El componente se agrego correctamente!!'+'</p>',
													type: "success",
													showConfirmButton:true,//Eliminar boton de confirmacion
													html: true
											},
						  				 	function(isConfirm)
						  				 	{
						  				 		if(isConfirm)
						  				 		{
						  				 			window.location.href="/menu/registros/clientes/categoria/sucursal/equipos/componentes/"+equipo;
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
									else if(answer.codigo==3)
									{
										swal({
													title:'Serial duplicado!!!',//Contenido del modal
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


	//////////////////////////////////////////Modificar Componente //////////////////////////////////

	$('.modificarComponente').click(function() 
	{
		$('#compMod_').data('bootstrapValidator').resetForm();
		var registry=$(this).data('reg');
		$('#registroComp_').val(registry);
		var equipo=$('#equipoPadre_').val();
		var route='/menu/registros/clientes/modificar/componente';
		var form=$('#compMod_').serialize();
		$.post(route,form)
				.done(function(answer)
					{
						loadModal(answer);
							
					})
				.fail(function()
					{
						swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
					});

	});

	/////////////////////////Guardar Modificacion ////////////////////////////////////////////////////////

	$('#compMod_').bootstrapValidator({
		   excluded: [':disabled'],
		   fields: {
		     selectNC: {
		       validators: {
		        notEmpty: {
		           message: 'Seleccione el componente'
		        }
		       }
		     },
		     serialCM: {
		       validators: {
		        notEmpty: {
		           message: 'Indique el serial del componente'
		        }
		       }
		     },
		     selectMC: {
		       validators: {
		         notEmpty: {
		           message: 'Seleccione la marca del componente'
		         }
		       }
		     },
		     selectMOC: {
		       validators: {
		         notEmpty: {
		           message: 'Seleccione el modelo del componente'
		         }
		       }
		     },
		     selectSC: {
		       validators: {
		         notEmpty: {
		           message: 'Seleccione el estatus del equipo'
		         }
		       }
		     }
		    }
  		}).on('success.form.bv',function(e,data){
			e.preventDefault();
			var form=$('#compMod_').serialize();
			var route='/menu/registros/clientes/actualizar/componente';
		 	var equipo=$('#equipoPadre_').val();

				$.post(route,form)
				.done(function(answer)
					{

						
						if(answer.codigo==1)
						{
								swal({
										title:'Modificacion exitosa',//Contenido del modal
										text: '<p style="font-size: 1.0em;">'+'El componente se modifico correctamente!!'+'</p>',
										type: "success",
										showConfirmButton:true,//Eliminar boton de confirmacion
										html: true
								},
			  				 	function(isConfirm)
			  				 	{
			  				 		if(isConfirm)
			  				 		{
			  				 			window.location.href="/menu/registros/clientes/categoria/sucursal/equipos/componentes/"+equipo;
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
						else if(answer.codigo==3)
						{
							swal({
									title:'Serial duplicado!!!',//Contenido del modal
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



	////////////////////////////////////////////////////Check status////////////////////////////////

	$('.checkComponente').change(function() 
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
					var route='/menu/registros/clientes/componentes/status';

					swal({
						title: "Cambio de status",
						text: "¿Desea "+acciones[valor]+" El componente seleccionado ?",
						type: "warning",
						showCancelButton: true,
						confirmButtonColor:colores[valor],
						confirmButtonText: acciones[valor]+' componente',
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
										swal("Modificacion exitosa !!", "El componente ha sido "+mensajes[valor]+" correctamente", "success");
										$('#'+actual.attr('id')).val(valores[valor]);

									}
								})
								.fail(function()
									{ swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
							}
							else
							{
								 
								 swal("Cambio de status cancelado !!", "No se modifico el status del componente", "error");
								 actual.prop('checked',estados[valor]);
								 $('#'+actual.attr('id')).val(valor);
								 
							}
					});

	});




});