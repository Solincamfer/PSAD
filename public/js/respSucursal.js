$(document).ready(function() 
{
///////////////////////////////Metodos comunes/////////////////////////////////////////
 			function loadModal(datos,caso)
		{
			
			
			var campos={
							primerNombre:['RpMda1','RpMdn1','inputm1'],
							primerApellido:['RpMda2','RpMdn2','inputm3'],
							tipoCedula:['RpMda3','RpMdn3','selciRpbm'],
							numeroCedula:['RpMda4','RpMdn4','cedRespSuc'],
							cargo:['RpMda5','RpMdn5','RpMdns5'],
							codigoMovil:['RpMdaa1','RpMdnn1','RpMdnn1s'],
							numeroMovil:['RpMdaa2','RpMdnn2','RpMdnns2'],
							codigoLocal:['RpMdaa3','RpMdnn3','seltlsfmRpb'],
							numeroLocal:['RpMdaa4','RpMdnn4','RpMdnns4'],
							correo:['RpMdaa5','RpMdnn5','RpMdsnn5']
						};
			/////////////////indicar al boton guardar del modal modificar el registro que se desea modificar //////////////////////////////
			$('#'+campos.primerNombre[caso]).val(datos.persona.primerNombre);
			$('#'+campos.primerApellido[caso]).val(datos.persona.primerApellido);
			$('#'+campos.tipoCedula[caso]).val(datos.cedula.tipo_id);
			$('#'+campos.numeroCedula[caso]).val(datos.cedula.numero);
			$('#'+campos.cargo[caso]).val(datos.persona.cargo);
			$('#'+campos.codigoMovil[caso]).val(datos.telefonoM.codigo_id);
			$('#'+campos.numeroMovil[caso]).val(datos.telefonoM.numero);
			$('#'+campos.codigoLocal[caso]).val(datos.telefonoL.codigo_id);
			$('#'+campos.numeroLocal[caso]).val(datos.telefonoL.numero);
			$('#'+campos.correo[caso]).val(datos.correo.correo);
			$('#myModal2').modal('show');

			return 0;
		}


 			///////////////////////// Modificar Responsable: Cargar modal//////////////////////////////////////////

 			$('.modificarResponsable').click(function()
 				{
 					$('#respSucForMod').data('bootstrapValidator').resetForm();
 					var registry=$(this).attr('data-reg');
 					var caso=$(this).data('caso');

 					var formularios=['_responsableMatriz_Mod','categoriResp__','respSucForMod'];
 					var registros=['idRegistroMod_','Responsableid','idRegistroModSuc'];
 					

 					$('#'+registros[caso]).val(registry);
 					var form=$('#'+formularios[caso]).serialize();

 					var route="/menu/registros/clientes/modificar/responsable";
 					
 				
 					$.post(route,form)
					.done(function(answer)
						{
							loadModal(answer,caso);
						})
					.fail(function()
					{
						swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
					});

 				});


 			///////////////////////// Modificar Responsable: Guardar cambios Matriz, categoria////////////////////////////////
 			$('#respSucForMod').bootstrapValidator({
				excluded: [':disabled'],
			   fields: {
			     nomRpb1: {
			       validators: {
			        notEmpty: {
			           message: 'Debe indicar el nombre del responsable'
			        },
					regexp: {
			                regexp: /^[a-z\s]+$/i,
			                message: 'El nombre debe contener solo caracteres alfabéticos'
	                }
			       }
			     },
			     apellRpb1: {
			       validators: {
			        notEmpty: {
			           message: 'Debe indicar el apellido del responsable'
			        },
					regexp: {
			                regexp: /^[a-z\s]+$/i,
			                message: 'El apellido debe contener solo caracteres alfabéticos'
	                }
			       }
			     },
			     selciRpb: {
			       validators: {
			         notEmpty: {
			           message: 'Seleccione el tipo de documento'
			         }
			       }
			     },
			     txtci: {
			       validators: {
			         notEmpty: {
			           message: 'Debe indicar el número de cédula del responsable'
			         },
			        regexp: {
		                regexp: /^[0-9]+$/,
		                message: 'La cédula de identidad debe contener solo numeros'                            
	                },
			       }
			     },
			     cgoRpb: {
			       validators: {
			         notEmpty: {
			           message: 'Debe indicar el cargo de la persona responsable'
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
			     numTelmvlRpb: {
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
			        seltlfRpb: {
			       validators: {
			         notEmpty: {
			           message: 'Debe indicar un código de telefono movil'
			         }
			       }
			     }

			     ,
			     numTelclRpb:{
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
			     mail2: {
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
				// var caso=$(this).attr('data-caso');////caso 0 resp Cliente//caso 1 resp Categoria
				// var formularios=['_responsableMatriz_Mod','categoriResp__','respSucForMod'];
				// var redirecciones=['_clienteMatriz_','categoriaId_','sucursal_id_resp'];
				// var rutas=['/menu/registros/clientes/responsable/','/menu/registros/clientes/categoria/responsable/','/menu/registros/clientes/categoria/sucursal/responsable/'];
				var route='/menu/registros/clientes/responsables/actualizar';
				var formulario=$('#respSucForMod').serialize();
				var redireccion=$('#sucursal_id_resp').val();
 					
 					

		    		$.post(route,formulario)
				  		.done(function(answer)
				  			{
				  				
								
								if(answer.codigo==1)
								{
										swal({
												title:'Actualizacion Exitosa',//Contenido del modal
												text: '<p style="font-size: 1.0em;">'+'EL responsable se modifico correctamente!!'+'</p>',
												type: "success",
												showConfirmButton:true,//Eliminar boton de confirmacion
												html: true
										},
					  				 	function(isConfirm)
					  				 	{
					  				 		if(isConfirm)
					  				 		{
					  				 			window.location.href='/menu/registros/clientes/categoria/sucursal/responsable/'+redireccion;
					  				 		}	

					  				 	});
					  				 
								}

								else if(answer.codigo==2)
								{

									swal({
												title:'Cedula duplicada!!!',//Contenido del modal
												text: '<p style="font-size: 0.9em;">'+'Se encuentra asociada al responsable: '+ answer.extra+'.<br><br><br>La cedula debe ser unica para un responsable.</p>',
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
							{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
						});
			});


		////////////////agregar nuevo responsable /////////////////////////////////////////
	$('#respSucForAgr').bootstrapValidator({
				excluded: [':disabled'],
			   fields: {
			     nomRpb1: {
			       validators: {
			        notEmpty: {
			           message: 'Debe indicar el nombre del responsable'
			        },
					regexp: {
			                regexp: /^[a-z\s]+$/i,
			                message: 'El nombre debe contener solo caracteres alfabéticos'
	                }
			       }
			     },
			     apellRpb1: {
			       validators: {
			        notEmpty: {
			           message: 'Debe indicar el apellido del responsable'
			        },
					regexp: {
			                regexp: /^[a-z\s]+$/i,
			                message: 'El apellido debe contener solo caracteres alfabéticos'
	                }
			       }
			     },
			     selciRpb: {
			       validators: {
			         notEmpty: {
			           message: 'Seleccione el tipo de documento'
			         }
			       }
			     },
			     txtci: {
			       validators: {
			         notEmpty: {
			           message: 'Debe indicar el número de cédula del responsable'
			         },
			        regexp: {
		                regexp: /^[0-9]+$/,
		                message: 'La cédula de identidad debe contener solo numeros'                            
	                },
			       }
			     },
			     cgoRpb: {
			       validators: {
			         notEmpty: {
			           message: 'Debe indicar el cargo de la persona responsable'
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
			     numTelmvlRpb: {
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
			        seltlfRpb: {
			       validators: {
			         notEmpty: {
			           message: 'Debe indicar un código de telefono movil'
			         }
			       }
			     }

			     ,
			     numTelclRpb:{
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
			     mail2: {
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
					var form=$('#respSucForAgr').serialize();
 					var sucursal=$('#sucursal_id_resp').val();
 					var route="/menu/registros/clientes/responsable/agregar";
		 					
		 			$.post(route,form)
					.done(function(answer)
						{
							
							console.log(answer);
							
							if(answer.codigo==1)
							{
									swal({
											title:'Isercion exitosa',//Contenido del modal
											text: '<p style="font-size: 1.0em;">'+'El responsable se registro correctamente!!'+'</p>',
											type: "success",
											showConfirmButton:true,//Eliminar boton de confirmacion
											html: true
									},
				  				 	function(isConfirm)
				  				 	{
				  				 		if(isConfirm)
				  				 		{
				  				 			window.location.href="/menu/registros/clientes/categoria/sucursal/responsable/"+sucursal;
				  				 		}	

				  				 	});
				  				 
							}

							else if(answer.codigo==2)
							{

								swal({
											title:'Cedula duplicada!!!',//Contenido del modal
											text: '<p style="font-size: 0.9em;">'+'Se encuentra asociada al responsable: '+ answer.extra+'.<br><br><br>La cedula debe ser unica para un responsable.</p>',
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

		///////////////////////////////////////////check de status ///////////////////////////////////////////////////////////////////////

		$('.checkResponsableSuc').change(function()
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
			var route='/menu/registros/clientes/responsable/status/sucursal';

			swal({
					title: "Cambio de status",
					text: "¿Desea "+acciones[valor]+" El responsable seleccionado ?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor:colores[valor],
					confirmButtonText: acciones[valor]+' Responsable',
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
								swal("Modificacion exitosa !!", "El responsable ha sido "+mensajes[valor]+" correctamente", "success");
								$('#'+actual.attr('id')).val(valores[valor]);

							}
						})
						.fail(function()
							{ swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
					}
					else
					{
						 
						 swal("Cambio de status cancelado !!", "No se modifico el status del responsable", "error");
						 actual.prop('checked',estados[valor]);
						 $('#'+actual.attr('id')).val(valor);
						 
					}
			});

		});

		////////////////////////////////////////////Radio Button ////////////////////////////////////////////////////////////////////////////////
		$('.radioRespSuc').click(function()
				{
					
					var anterior=$('#_checkSeleccionadoSuc_').val()
					var nuevo=$(this).attr('data-reg');
					var route='/menu/registros/clientes/responsable/asignar/sucursal';
					var sucursal=$('#sucursal_id_resp').val();
					if(!anterior){anterior=0;}
					

					swal({
							title: "Asignacion de responsable",
							text: '<p style="font-size: 0.9em;">'+'Desea asignar a la persona seleccionada como responsable de la sucursal:  <br>  '+''+'?</p>',
							type: "warning",
							showCancelButton: true,
							confirmButtonColor: "#207D07",
							confirmButtonText: "Asignar responsable",
							cancelButtonText: "No Asignar responsable",
							closeOnConfirm: false,
							closeOnCancel: false,
							html: true
						  },
				  				 	function(isConfirm)
				  				 	{
				  				 		if(isConfirm)
				  				 		{
				  				 			$.getJSON(route,{nuevo:nuevo,anterior:anterior,sucursal:sucursal})
				  				 			.done(function(answer)
				  				 			{
				  				 				
				  				 				if(answer.retorno==1)
				  				 				{
				  				 					$('#_checkSeleccionadoSuc_').val(nuevo);//agrega el valor del nuevo registro
				  				 					$('#'+'s_resp'+nuevo).prop("checked",true);//chekea el nuevo registro
				  				 					swal("Responsable asignado", "La sucursal tiene un nuevo responsable asignado", "success");
				  				 				}
				  				 				else
				  				 				{
				  				 					swal("Error de asignacion", "El responsable no se asigno correctamente!!!", "error");
				  				 				}
				  				 				
				  				 			})
				  				 			.fail(function()
												{ swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
				  				 			
				  				 		}
				  				 		else
				  				 		{
				  				 			$('#_checkSeleccionadoSuc_').val(anterior);//agrega el valor del nuevo registro
				  				 			$('#'+'s_resp'+anterior).prop("checked",true);//chekea el nuevo registro
				  				 			$('#'+'s_resp'+nuevo).prop("checked",false);
				  				 			swal("Asignacion cancelada", "No se asigno el responsable seleccionado a la sucursal", "warning");
				  				 		}	

				  				 	});




				});





});