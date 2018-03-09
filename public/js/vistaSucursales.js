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
		$('#inputm16').val(datos.telefonoLocal.tipo_id);
		$('#inputm18').val(datos.telefonoMovil.tipo_id);
		$('#inputm17').val(datos.telefonoLocal.numero);
		$('#inputm19').val(datos.telefonoMovil.numero);

		/////////////////////////////Cargar los selects: direccion fiscal //////////////////////////////////
		$('.'+'inputm7').remove();
		cargarSelect(datos.dependenciasF.regiones,'inputm7');
		$('#inputm7').val(datos.direccionFiscal.region_id);

		$('.'+'inputm8').remove();
		cargarSelect(datos.dependenciasF.estados,'inputm8');
		$('#inputm8').val(datos.direccionFiscal.estado_id);

		$('.'+'inputm9').remove();
		cargarSelect(datos.dependenciasF.municipios,'inputm9');
		$('#inputm9').val(datos.direccionFiscal.municipio_id);

		/////////////////////////////Cargar los selects: direccion comercial //////////////////////////////////

		$('.'+'inputm12').remove();
		cargarSelect(datos.dependenciasC.regiones,'inputm12');
		$('#inputm12').val(datos.direccionComercial.region_id);

		$('.'+'inputm13').remove();
		cargarSelect(datos.dependenciasC.estados,'inputm13');
		$('#inputm13').val(datos.direccionComercial.estado_id);

		$('.'+'inputm14').remove();
		cargarSelect(datos.dependenciasC.municipios,'inputm14');
		$('#inputm14').val(datos.direccionComercial.municipio_id);

			

		$('#myModal2').modal('show');
		}

	////////////////////////Eliminar sucursal //////////////////////////////////////////////////////////////////////
	$('._eliminarSuc_').click(function()
		{
			var registry=$(this).data('reg');
			var route='/menu/registros/clientes/eliminar/sucursales';
			var _token=$("input[name^='_token']").val();
			var cliente=$('#cliente__id').val();
		
				swal({
							title: "Eliminar Sucursal",
							text: "Al eliminar la sucursal seleccionada, eliminara toda la informacion asociada a ella, incluyendo equipos completos,planes,responsables y todo lo relacionado . ¿Desea eliminar la sucursal?",
							type: "warning",
							showCancelButton: true,
							confirmButtonColor:'#EE1919',
							confirmButtonText:'Eliminar Sucursal',
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
								  				 	window.location.href='/menu/registros/clientes/categorias/sucursales/'+cliente;
								  				 }	

								  			});
										

									}
									else
										{
											 swal("No se elimino la sucursal!!!", "", "error");
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
							['input11','input12','input13','input14'],//direccion comercial agregar. grupo 1
							['inputm6','inputm7','inputm8','inputm9'],
							['inputm11','inputm12','inputm13','inputm14']
						
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
		$('#sucursalCliente__').bootstrapValidator({
			excluded: [':disabled'],
		   	fields: {
		     rs: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar la razon social de la sucursal'
		         }
		       }
		     },
		     nc: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar el nombre comercial de la sucursal'
		         }
		       }
		     },
		     rif: {
		       validators: {
		         notEmpty: {
		           message: 'Seleccione el tipo de rif'
		         }
		       }
		     },
		     df: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar el número de rif'
		         },
		        regexp: {
	                regexp: /^[0-9]+$/,
	                message: 'El rif debe contener solo numeros'                            
                },
		       }
		     },
		     tipCon: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar el tipo de contribuyente'
		         }
		       }
		     },
		     paisdc: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar el país'
		         }
		       }
		     },
		     regiondc: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar la región'
		         }
		       }
		     },
		     edodc: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar el estado'
		         }
		       }
		     },
 		     mundc: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar el municipio'
		         }
		       }
		     },
		     descDirdc: {
		       validators: {
		         notEmpty: {
		           message: 'Especifique la direccion Fiscal de la sucursal'
		         }
		       }
		     },
		     paisdf: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar el país'
		         }
		       }
		     },
		     regiondf: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar la region'
		         }
		       }
		     },
		     edodf: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar el estado'
		         }
		       } 
		     },
		     mundf: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar el municipio'
		         }
		       }
		     },
		     descDirdf: {
		       validators: {
		         notEmpty: {
		           message: 'Especifique la direccion Comercial de la sucursal'
		         }
		       }
		     },
		     tlflcl: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar un código de area local'
		         }
		       }
		     },
		     tcl: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar un número de telefono local'
		         },
		         regexp: {
	                regexp: /^[0-9]+$/,
	                message: 'Solo debe contener caracteres númericos'                            
                },
		       }
		     },
		   tlfmvl: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar un código de telefono movil'
		         }
		       }
		     }	
		     ,
		     tmvl:{
		     	validators:{
		     		regexp: {
		                regexp: /^[0-9]+$/,
		                message: 'Solo debe contener caracteres númericos'                            
                },
                 notEmpty: {
		           message: 'Debe indicar un número de telefono movil'
		         }
		     	}
		     },
		     mail: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar un correo electrónico'
		        },
		         emailAddress: {
                        message: 'El correo electronico debe tener el formato minombre@midominio.com'
                }
		       }
		     }
		   }
	  	}).on('success.form.bv',function(e,data){
	  		e.preventDefault();
				var form=$('#sucursalCliente__').serialize();
				var route='/menu/registros/clientes/agregar/sucursal';
				var categoria=$('#categoria__id').val();
								$.post(route,form)
									.done(function(answer)
										{
											
											
											
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
				
					$('#Formclientem').data('bootstrapValidator').resetForm();
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


			$('#Formclientem').bootstrapValidator({
			excluded: [':disabled'],
		   fields: {
		     rs: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar la razon social de la empresa'
		         }
		       }
		     },
		     nc: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar el nombre comercial de la empresa'
		         }
		       }
		     },
		     rif: {
		       validators: {
		         notEmpty: {
		           message: 'Seleccione el tipo de rif'
		         }
		       }
		     },
		     df: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar el número de rif'
		         },
		        regexp: {
	                regexp: /^[0-9]+$/,
	                message: 'El rif debe contener solo numeros'                            
                },
		       }
		     },
		     tipCon: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar el tipo de contribuyente'
		         }
		       }
		     },
		     paisdc: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar el país'
		         }
		       }
		     },
		     regiondc: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar la región'
		         }
		       }
		     },
		     edodc: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar el estado'
		         }
		       }
		     },
 		     mundc: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar el municipio'
		         }
		       }
		     },
		     descDirdc: {
		       validators: {
		         notEmpty: {
		           message: 'Especifique la direccion Fiscal de la empresa'
		         }
		       }
		     },
		     paisdf: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar el país'
		         }
		       }
		     },
		     regiondf: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar la region'
		         }
		       }
		     },
		     edodf: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar el estado'
		         }
		       } 
		     },
		     mundf: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar el municipio'
		         }
		       }
		     },
		     descDirdf: {
		       validators: {
		         notEmpty: {
		           message: 'Especifique la direccion Comercial de la empresa'
		         }
		       }
		     },
		     tlflcl: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar un código de area local'
		         }
		       }
		     },
		     tcl: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar un número de telefono local'
		         },
		         regexp: {
	                regexp: /^[0-9]+$/,
	                message: 'Solo debe contener caracteres númericos'                            
                },
		       }
		     },
		     	tlfmvl: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar un código de telefono movil'
		         }
		       }
		     }	
		     ,
		     tmvl:{
		     	validators:{
		     		regexp: {
		                regexp: /^[0-9]+$/,
		                message: 'Solo debe contener caracteres númericos'                            
                },
                 notEmpty: {
		           message: 'Debe indicar un número de telefono movil'
		         }
		     	}
		     },
		     mail: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar un correo electrónico'
		        },
		         emailAddress: {
                        message: 'El correo electronico debe tener el formato minombre@midominio.com'
                }
		       }
		     }
		   }
	  	}).on('success.form.bv',function(e,data){
	  		e.preventDefault();
					
					
 					$('#Formclientem').data('bootstrapValidator').resetForm();
 					var form=$('#Formclientem').serialize();
       				var route='/menu/registros/clientes/actualizar/sucursal';
       				var categoria=$('#categoria__id').val();

       				$.post(route,form)
						.done(function(answer)
							{
								
								
								if(answer.codigo==1)
													{
															swal({
																	title:'Actualizacion exitosa',//Contenido del modal
																	text: '<p style="font-size: 1.0em;">'+'La sucursal se actualizo correctamente!!'+'</p>',
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

	  	//////////////////////////////////////STATUS DE UNA SUCURSAL ////////////////////////////////////////////////////

			$('.checkSucursales').change(function()
		{
			

			/////////////////////////////Datos para el alert /////////////////////////////////
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
			var route='/menu/registros/clientes/status/sucursal';

			swal({
				title: "Cambio de status",
				text: "¿Desea "+acciones[valor]+" La sucursal seleccionada ?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor:colores[valor],
				confirmButtonText: acciones[valor]+' Sucursal',
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
								swal("Modificacion exitosa !!", "La Sucursal ha sido "+mensajes[valor]+" correctamente", "success");
								$('#'+actual.attr('id')).val(valores[valor]);

							}
						})
						.fail(function()
							{ swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
					}
					else
					{
						 
						 swal("Cambio de status cancelado !!", "No se modifico el status de la Sucursal", "error");
						 actual.prop('checked',estados[valor]);
						 $('#'+actual.attr('id')).val(valor);
						 
					}
			});


		});




});