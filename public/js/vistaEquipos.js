$(document).ready(function() 
{
	

	


	function loadModal(datos)
	{
		
		
		/////////////////cargar opciones de las listas ///////////////////
		$('.tpEqm').remove();
		cargarSelect(datos.tipoequipo,'tpEqm');

		$('.mkEqm').remove();
		cargarSelect(datos.marcas,'mkEqm');

		$('.modEqm').remove();
		cargarSelect(datos.modelos,'modEqm');
		/////////////////////////////////////////////////////////////////

		///////////////cargar resto de campos del modal /////////////////

		$('#nomEqm').val(datos.equipo.descripcion);
		$('#tpEqm').val(datos.equipo.tipoequipo);
		$('#mkEqm').val(datos.equipo.marca);
		$('#modEqm').val(datos.equipo.modelo);
		$('#duPflm').val(datos.equipo.serial);
		$('#stPflm').val(datos.equipo.status);

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




/////////////////////////Eliminar equipos /////////////////////////////////////////////
$('._eliminarEquip_').click(function()
{
			var registry=$(this).data('reg');
			var route='/menu/registros/clientes/eliminar/equipos';
			var _token=$( "input[name^='_token']" ).val();
			var sucursal=$('#_sucursal_id_').val();

				swal({
							title: "Eliminar Equipo",
							text: "Al eliminar el equipo seleccionado, eliminara las aplicaciones, componentes y piezas asocidas a el. ¿Desea eliminar el equipo?",
							type: "warning",
							showCancelButton: true,
							confirmButtonColor:'#EE1919',
							confirmButtonText:'Eliminar Equipo',
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
								  				 	window.location.href='/menu/registros/clientes/categoria/sucursal/equipos/'+sucursal;
								  				 }	

								  			});
										

									}
									else
										{
											 swal("No se elimino el equipo!!!", "", "error");
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




/////////////////////////Check de status //////////////////////////////////////////////


$('.checkEquipos').change(function()
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
					var route='/menu/registros/clientes/equipos/status';

					swal({
						title: "Cambio de status",
						text: "¿Desea "+acciones[valor]+" El equipo seleccionado ?",
						type: "warning",
						showCancelButton: true,
						confirmButtonColor:colores[valor],
						confirmButtonText: acciones[valor]+' equipo',
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
										swal("Modificacion exitosa !!", "El equipo ha sido "+mensajes[valor]+" correctamente", "success");
										$('#'+actual.attr('id')).val(valores[valor]);

									}
								})
								.fail(function()
									{ swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
							}
							else
							{
								 
								 swal("Cambio de status cancelado !!", "No se modifico el status del equipo", "error");
								 actual.prop('checked',estados[valor]);
								 $('#'+actual.attr('id')).val(valor);
								 
							}
					});







			});


 ///////////////////////Seleccionar select equipos ////////////////////////////////////

	$('.selectEquipos').change(function()	
	{
		var listas=[['_tpEq','mkEq','modEq'],['tpEqm','mkEqm','modEqm']];
		var caso=$(this).data('caso');
		var grupo=$(this).data('grupo');
		var registry=$(this).val();
		var _token=$( "input[name^='_token']" ).val();
		var route='/menu/registros/clientes/selectequipos/sucursal';
		var auxiliar=0;

		if (caso==1) 
			{auxiliar=$('#'+listas[grupo][0]).val();}
			

		if(caso<2)
		{
			limpiarLista(parseInt(caso)+1,listas[grupo]);

			if(registry!="")
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
	/////////////////////////////////Agregar nuevo equipo //////////////////////////////////////

	$('#equipoSucAgr').bootstrapValidator({
		excluded: [':disabled'],
		   fields: {
		     nomEq: {
		       validators: {
		        notEmpty: {
		           message: 'Debe indicar el nombre del equipo'
		        }
		       }
		     },
		     _tpEq: {
		       validators: {
		        notEmpty: {
		           message: 'Seleccione el tipo de equipo'
		        }
		       }
		     },
		     mkEq: {
		       validators: {
		         notEmpty: {
		           message: 'Seleccione la marca del equipo'
		         }
		       }
		     },
		     modEq: {
		       validators: {
		         notEmpty: {
		           message: 'Seleccione el modelo del equipo'
		         }
		       }
		     },
		     duPfl: {
		       validators: {
		         notEmpty: {
		           message: 'Indique el serial del equipo'
		         }
		       }
		     },
		     seltlfmRpb: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar un código de area local'
		         }
		       }
		     },
		     stPfl: {
		       validators: {
		         notEmpty: {
		           message: 'Seleccione el estatus del equipo'
		         }
		     }
		    }
		   }
  		}).on('success.form.bv',function(e,data){
			e.preventDefault();
			var form=$('#equipoSucAgr').serialize();
			var route='/menu/registros/clientes/insertar/equipo';
			var sucursal=$('#_sucursal_id_').val();
			$.post(route,form)
					.done(function(answer)
						{

							
								if(answer.codigo==1)
								{
										swal({
												title:'Guardado exitoso',//Contenido del modal
												text: '<p style="font-size: 1.0em;">'+'El equipo se agrego correctamente!!'+'</p>',
												type: "success",
												showConfirmButton:true,//Eliminar boton de confirmacion
												html: true
										},
					  				 	function(isConfirm)
					  				 	{
					  				 		if(isConfirm)
					  				 		{
					  				 			window.location.href="/menu/registros/clientes/categoria/sucursal/equipos/"+sucursal;
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

 ///////////////////////////////////////////////Boton modificar cargar modal ////////////////////////////////////

 $('.modificarEquipo_').click(function() 
 {
	$('#equipoSucMod').data('bootstrapValidator').resetForm();

 	var registry=$(this).data('reg');
 	$('#_sucursalRegistro').val(registry);
 	var route='/menu/registros/clientes/modificar_equipo';
 	var sucursal=$('#_sucursal_id_').val();
 	var form=$('#equipoSucMod').serialize();
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
 ////////////////////////////////////////Boton modificar : Actualizar registros ///////////////////////////////////////
$('#equipoSucMod').bootstrapValidator({
		excluded: [':disabled'],
		   fields: {
		     nomEq: {
		       validators: {
		        notEmpty: {
		           message: 'Debe indicar el nombre del equipo'
		        }
		       }
		     },
		     _tpEq: {
		       validators: {
		        notEmpty: {
		           message: 'Seleccione el tipo de equipo'
		        }
		       }
		     },
		     mkEq: {
		       validators: {
		         notEmpty: {
		           message: 'Seleccione la marca del equipo'
		         }
		       }
		     },
		     modEq: {
		       validators: {
		         notEmpty: {
		           message: 'Seleccione el modelo del equipo'
		         }
		       }
		     },
		     duPfl: {
		       validators: {
		         notEmpty: {
		           message: 'Indique el serial del equipo'
		         }
		       }
		     },
		     seltlfmRpb: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar un código de area local'
		         }
		       }
		     },
		     stPfl: {
		       validators: {
		         notEmpty: {
		           message: 'Seleccione el estatus del equipo'
		         }
		     }
		    }
		   }
  		}).on('success.form.bv',function(e,data){
			e.preventDefault();
	 		
	 		var form=$('#equipoSucMod').serialize();
	 		var route='/menu/registros/clientes/actualizar/equipo';
	 		var sucursal=$('#sucursal__id').val();


				$.post(route,form)
				.done(function(answer)
					{


						
						if(answer.codigo==1)
						{
								swal({
										title:'Modificacion exitosa',//Contenido del modal
										text: '<p style="font-size: 1.0em;">'+'El equipo se modifico correctamente!!'+'</p>',
										type: "success",
										showConfirmButton:true,//Eliminar boton de confirmacion
										html: true
								},
			  				 	function(isConfirm)
			  				 	{
			  				 		if(isConfirm)
			  				 		{
			  				 			window.location.href="/menu/registros/clientes/categoria/sucursal/equipos/"+sucursal;
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
	 		/// codigo ajax y respuesta.....

	 	});





});