$(document).ready(function() {
	
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




		function loadModal(datos)
		{
			
		$('#myModalLabel2').text('MODIFICAR: '+datos.cliente.nombreComercial);
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

		/////////////////////////////Cargar los selects: direccion fiscal //////////////////////////////////
		$('.'+'inn2').remove();
		cargarSelect(datos.dependenciasF.regiones,'inn2');
		$('#inn2').val(datos.direccionFiscal.region_id);

		$('.'+'inn3').remove();
		cargarSelect(datos.dependenciasF.estados,'inn3');
		$('#inn3').val(datos.direccionFiscal.estado_id);

		$('.'+'inn4').remove();
		cargarSelect(datos.dependenciasF.municipios,'inn4');
		$('#inn4').val(datos.direccionFiscal.municipio_id);

		/////////////////////////////Cargar los selects: direccion comercial //////////////////////////////////

		$('.'+'innn12').remove();
		cargarSelect(datos.dependenciasC.regiones,'innn12');
		$('#innn12').val(datos.direccionComercial.region_id);

		$('.'+'innn13').remove();
		cargarSelect(datos.dependenciasC.estados,'innn13');
		$('#innn13').val(datos.direccionComercial.estado_id);

		$('.'+'innn14').remove();
		cargarSelect(datos.dependenciasC.municipios,'innn14');
		$('#innn14').val(datos.direccionComercial.municipio_id);


			

		$('#myModal2').modal('show');

		}
		////////////////////////////////eliminar cliente matriz//////////////////
		$('._eliminarClie_').click(function() 
			{
			var registry=$(this).data('reg');
			var route='/menu/registros/clientes/eliminar/clientes';
			var _token=$( "input[name^='_token']" ).val();
			
		

				swal({
							title: "Eliminar Cliente",
							text: "Al eliminar un cliente, dejara de estar disponible toda la informacion relacionada con el, incluyendo: categorias, sucursales, equipos y toda la informacion asociada al cliente. ¿ Desea eliminar al cliente seleccionado?",
							type: "warning",
							showCancelButton: true,
							confirmButtonColor:'#EE1919',
							confirmButtonText:'Eliminar Cliente',
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
								  				 	window.location.href='/menu/registros/clientes/';
								  				 }	

								  			});
										

									}
									else
										{
											 swal("No se elimino el cliente!!!", "", "error");
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
			
			$('#Formclientemd').data('bootstrapValidator').resetForm();
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
		$('#Formclientemd').bootstrapValidator({
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
		     tlflcl: {///Codigo del telefono local
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar un código de area local'
		         }
		       }
		     },
		     tcl: {//telefono local 
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar un número de telefono local'
		         },
		         regexp: {
	                regexp: /^[0-9]+$/,
	                message: 'Solo debe contener caracteres númericos'                            
                }
		       }
		   	}
		     ,
		       tlfmvl: {///Codigo del telefono movil
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar un código de telefono movil'
		         }
		       }
		   },



		     tmvl:{//numero telefono movil
		     	validators:{
		     		regexp: {
		                regexp: /^[0-9]+$/,
		                message: 'Solo debe contener caracteres númericos'                            
                },
                  notEmpty: {
		           message: 'Debe indicar un numero de telefono movil'
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
			var form=$('#Formclientemd').serialize();
       		var route='/menu/registros/clientes/actualizar';

       		$.post(route,form)
			.done(function(answer)
				{
					
					
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
					else if(answer.codigo==1)
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

		////////////////////Boton guardar nuevo cliente ////////////////////////////////////////////////////////

		$('#Formclientesv').bootstrapValidator({
			excluded: [':disabled'],
		   fields: {
		     rsnew: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar la razon social de la empresa'
		         }
		       }
		     },
		     ncnew: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar el nombre comercial de la empresa'
		         }
		       }
		     },
		     tiporif: {
		       validators: {
		         notEmpty: {
		           message: 'Seleccione el tipo de rif'
		         }
		       }
		     },
		     numerorif: {
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
		     tipConnew: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar el tipo de contribuyente'
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
		           message: 'Debe indicar la región'
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
		           message: 'Especifique la direccion Fiscal de la empresa'
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
		           message: 'Debe indicar la region'
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
		           message: 'Especifique la direccion Comercial de la empresa'
		         }
		       }
		     },
		     tlflsv: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar un código de area local'
		         }
		       }
		     },
		     tclsv: {
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
		     tmvlsv:{
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
		     	tlfmvlsv: {///Codigo del telefono movil
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar un código de telefono movil'
		         }
		       }
		   }
		     ,
		     mailsv: {
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
				var form=$('#Formclientesv').serialize();
				console.log(form);
				var route='/menu/registros/clientes/insertar';
				$.post(route,form)
				.done(function(answer)
					{
						
						
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



});	