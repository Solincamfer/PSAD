$(document).ready(function() 
{
	

		///////////////////////////////////////////// Metodos comunes /////////////////////////////////////////////////
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
			
			var campoTel={codigo:['numerol_1cm','numerol_2cm','numerom_cm'],numero:['numerol_1tm','numerol_2tm','numerom_tm']};
			

			
			$('#nomEmp1m').val(datos[0].primerNombre);
			$('#nomEmp2m').val(datos[0].segundoNombre);
			$('#apellEmp1m').val(datos[0].primerApellido);
			$('#apellEmp2m').val(datos[0].segundoApellido);
			$('#fnEmpmm').val(datos[0].fechaNacimiento);



			$('#selRifEmpm').val(datos[1].tipo_id);
			$('#numRifEmpm').val(datos[1].numero);
			
			$('#selCiEmpm').val(datos[2].tipo_id);
			$('#numCiEmpm').val(datos[2].numero);

			//Cargar select de estructuras 
			cargarSelect(datos[4].departamentos,'departamentoEmpm');
			cargarSelect(datos[4].areas,'areaEmp_m');
			cargarSelect(datos[4].cargos,'cgoEmpm');

			$('#direccionEmprm'+' option[value="'+datos[3].director_id+'"]').attr('selected',true);
			$('#departamentoEmpm'+' option[value="'+datos[3].departamento_id+'"]').attr('selected',true);
			$('#areaEmp_m'+' option[value="'+datos[3].area_id+'"]').attr('selected',true);
			$('#cgoEmpm'+' option[value="'+datos[3].cargo_id+'"]').attr('selected',true);


			//Cargar select de direccion 
			cargarSelect(datos[6].regiones,'rgdhem');
			cargarSelect(datos[6].estados,'edodhem');
			cargarSelect(datos[6].municipios,'mundhem');

			$('#pdhem'+' option[value="'+datos[5].pais_id+'"]').attr('selected',true);
			$('#rgdhem'+' option[value="'+datos[5].region_id+'"]').attr('selected',true);
			$('#edodhem'+' option[value="'+datos[5].estado_id+'"]').attr('selected',true);
			$('#mundhem'+' option[value="'+datos[5].municipio_id+'"]').attr('selected',true);

			$('#codigoPostalm').val(datos[5].codigoPostal);
			$('#descpdhem').val(datos[5].direccion);


			////////////////contacto
			$('#'+campoTel.codigo[datos[8][0].tipo]).val(datos[8][0].codigo);//codigo telefono local 1
			$('#'+campoTel.numero[datos[8][0].tipo]).val(datos[8][0].numero);//numero del telefono local 1

			$('#'+campoTel.codigo[datos[8][1].tipo]).val(datos[8][1].codigo);//codigo telefono local 2 
			$('#'+campoTel.numero[datos[8][1].tipo]).val(datos[8][1].numero);//numero del telefono local 2

			$('#'+campoTel.codigo[datos[8][2].tipo]).val(datos[9].codigo);//codigo telefono local 2 
			$('#'+campoTel.numero[datos[8][2].tipo]).val(datos[8][2].numero);//numero del telefono movil

			$('#correo_m').val(datos[7].correo);

			//////////////usuario 

			$('#nomUs_m').val(datos[10].usuario);
			$('#psw_m').val(datos[10].clave);
			$('#statusEm_m').val(datos[10].status);


			

			$('#myModal2').modal('show');
		}
		/////////////////////////////////////////////No aplica telefono movil //////////////////////////////////////////////
		$('.tlMovil').change(function() 
		{
			var valor= $(this).val();
			var caso=$(this).data('caso');
			var casos=['numerom_t','numerom_tm'];
			if(valor)
			{
				if(valor==16)
				{
					$('#'+casos[caso]).val('0000000');
				}
				else
				{
					$('#'+casos[caso]).val('');
				}
				
			}
			else
			{
				$('#'+casos[caso]).val('');
			}
			
		});
		////////////////////////////////////////////Eliminar empleado//////////////////////////////////////////////////////
		////////////////////////////////////// Eliminar perfil/////////////////////////////////////////////////
	$('._eliminarEmp_').click(function()
{
			var registry=$(this).data('reg');
			var route='/menu/registros/clientes/eliminar/empleados';
			var _token=$( "input[name^='_token']" ).val();
			

				swal({
							title: "Eliminar Empleado",
							text: "Al eliminar el empleado seleccionado, se eliminaran sus datos asociados. ¿Desea eliminar el empleado?",
							type: "warning",
							showCancelButton: true,
							confirmButtonColor:'#EE1919',
							confirmButtonText:'Eliminar Empleado',
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
									
									if(answer.codigo==1)
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
								  				 	window.location.href='/menu/registros/empleados/';
								  				 }	

								  			});
										

									}
									
									
									else
										{
											 swal("No se elimino el empleado!!!", "", "error");
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


		
		/////////////////////////////////////////////Funciones para los select de estructura //////////////////////////////


		$('.estructura_agr').change(function()
			{


				
					var idRegistro=$(this).val();
					var caso=$(this).attr('data-caso');
					var vista=$(this).attr('data-vista');
					var route='/menu/registros/empleados/estructura';
					var _token=$( "input[name^='_token']" ).val();
					var listas=[['direccionEmpr','departamentoEmp','areaEmp_agr','cgoEmp'],['direccionEmprm','departamentoEmpm','areaEmp_m','cgoEmpm']];
					if(caso<4)//cuando se cambian los selects que no son cargo 
					{

							
							$.post(route,{_token:_token,idRegistro: idRegistro,caso:caso })

							.done(function(answer)
							{
								limpiarLista(caso,listas[vista]);
								cargarSelect(answer,listas[vista][caso])

								
							})

							.fail(function()
								{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});

					}
			

				
			});


		//////////////////////////////////////////////Funciones para los select de direccion //////////////////////////////
		$('.direccion_emp').change(function()
		{
			var caso= $(this).attr('data-caso');
			var registry=$(this).val();
			var route='/menu/registros/empleados/direccion';
			var _token=$( "input[name^='_token']" ).val();
			var listas=['pdhem','rgdhem','edodhem','mundhem'];
			
			if(caso<4)
			{

							$.post(route,{_token:_token,registry:registry,caso:caso})

							.done(function(answer)
							{
								
							
								limpiarLista(parseInt(caso)+1,listas);
								cargarSelect(answer,listas[parseInt(caso)+1])

								
							})

							.fail(function()
								{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});


			}

		})
		/////////////////////////////////////////////Funcion boton modificar///////////////////////////////////////////////
		$('.ModificarEmpleado').click(function() 
		{
		  var registry=$(this).attr('data-reg');
		  var _token=$( "input[name^='_token']" ).val();
		  var route='/menu/registros/empleados/modificar';
		  $('#_idEmpleado_').val(registry);
		  

		  $.post(route,{_token:_token,registry:registry})
		  .done(function(answer)
		  {
		  	
		  	
		  	loadModal(answer);
		  })

		  .fail(function()
			{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});

		});






		//////////////////////////////////////////Funcion boton Guardar nuevo empleado ///////////////////////////////////////

		$('#NewEmp').bootstrapValidator({
			excluded: [':disabled'],
		   	fields: {
				nomEmp1: {
			       	validators: {
				        notEmpty: {
				           message: 'Indique el nombre del empleado'
				        },
				        regexp: {
			                regexp: /^[a-z\s]+$/i,
			                message: 'El nombre debe contener solo caracteres alfabéticos'
		                }
			       	}
				},
			    nomEmp2: {
			       	validators: {
			       		 notEmpty: {
				           message: 'Indique el nombre del empleado'
				        },
			       		regexp:{
				       		regexp: /^[a-z\s]+$/i,
			                message: 'El nombre debe contener solo caracteres alfabéticos'
			        	}
			       }
			    },
			    apellEmp1: {
			       validators: {
			         	notEmpty: {
			           		message: 'Indique el apellido del empleado'
			        	},
			        	regexp: {
			                regexp: /^[a-z\s]+$/i,
			                message: 'El apellido debe contener solo caracteres alfabéticos'
	                	}
			       	}
			    },
			     apellEmp2: {
			       validators: {
			       	notEmpty: {
			           		message: 'Indique el apellido del empleado'
			        	},
			        regexp: {
		                regexp: /^[a-z\s]+$/i,
		                message: 'El apellido debe contener solo caracteres alfabéticos'
	                }
			       }
			     },
			    TrifEmp: {
			       	validators: {
			         	notEmpty: {
			           		message: 'Debe indicar el tipo de rif'
			         	}
			       	}
			    },
				rifEmp: {
			       	validators: {
			         	notEmpty: {
			           		message: 'Debe indicar el número de rif'
			         	},
				        regexp: {
			                regexp: /^[0-9]+$/,
			                message: 'El rif debe contener solo numeros'                            
		                }
			       	}
				},
				TciEmp: {
			       	validators: {
		         		notEmpty: {
				        	message: 'Debe indicar el tipo de documento'
				        }
			       	}
			   	},
			    ciEmp:{
			       	validators: {
						notEmpty: {
				           message: 'Debe indicar el tipo de documento'
				        },
				        regexp: {
			                regexp: /^[0-9]+$/,
			                message: 'La cédula de identidad debe contener solo números'                            
		                }
			       	}
			   	},
			   	fnEmp:{
			       	validators: {
						notEmpty: {
				           message: 'Debe indicar la fecha de nacimiento'
				        }
			       	}
			   	},
			   	direccionEmpr:{
			       	validators: {
						notEmpty: {
				           message: 'Debe indicar la dirección a la cual pertenece el empleado'
				        }
			       	}
			   	},
			   	departamentoEmp:{
			       	validators: {
						notEmpty: {
				           message: 'Debe indicar el departamento al cual pertenece el empleado'
				        }
			       	}
			   	},
			   	areaEmp_agr:{
			       	validators: {
						notEmpty: {
				           message: 'Debe indicar el área a la cual pertenece el empleado'
				        }
			       	}
			   	},
			   	cgoEmp:{
			       	validators: {
						notEmpty: {
				           message: 'Debe indicar el cargo del empleado'
				        }
			       	}
			   	},
			   	pdhe:{
			       	validators: {
						notEmpty: {
				           message: 'Seleccione el país'
				        }
			       	}
			   	},
			   	rgdhe:{
			       	validators: {
						notEmpty: {
				           message: 'Seleccione la región'
				        }
			       	}
			   	},
			   	edodhe:{
			       	validators: {
						notEmpty: {
				           message: 'Seleccione el estado'
				        }
			       	}
			   	},
			   	mundhe:{
			       	validators: {
						notEmpty: {
				           message: 'Seleccione el municipio'
				        }
			       	}
			   	},
			   	codigoPostal:{
			       	validators: {
						notEmpty: {
				           message: 'Debe indicar el código postal'
				        },
				        regexp: {
			                regexp: /^[0-9]+$/,
			                message: 'El código postal debe contener solo números'                            
		                }
			       	}
			   	},
			   	descpdhe:{
			       	validators: {
						notEmpty: {
				           message: 'Debe indicar la dirección específica'
				        }
			       	}
			   	},
			   	numerol_1c:{
			       	validators: {
						notEmpty: {
				           message: 'Debe indicar el código de área'
				        }
			       	}
			   	},
			 	
			   	numerol_1t:{
			       	validators: {
						notEmpty: {
				           message: 'Debe indicar el número de telefono local'
				        },
				        regexp: {
			                regexp: /^[0-9]+$/,
			                message: 'El telefono local debe ser solo números'                            
		                }
			       	}
			   	},	
			   	numerol_2c:{
			       	validators: {
						notEmpty: {
				           message: 'Debe indicar el código de área'
				        }
			       	}
			   	},
			   
			   	numerol_2t:{
			       	validators: {notEmpty: {
				           message: 'Debe indicar el número de telefono de oficina'
				        },
				        regexp: {
			                regexp: /^[0-9]+$/,
			                message: 'El telefono de oficina debe tener solo numeros'                            
		                }
			       	}
			   	},
			   	numerom_c:{
			       	validators: {
						notEmpty: {
				           message: 'Seleccione el código de operadora'
				        }
				    }
			   	},
			   	numerom_t:{
			       	validators: {
			       		notEmpty: {
				           message: 'Debe indicar el número de telefono movil'
				        },
				        regexp: {
			                regexp: /^[0-9]+$/,
			                message: 'El telefono movil debe tener solo numeros'                            
		                }
			       	}
			   	},
			   	correo_agr:{
			       	validators: {
			       		notEmpty: {
				           	message: 'Debe indicar el correo electrónico'
				        },
				        emailAddress: {
                        	message: 'El correo electronico debe tener el formato minombre@midominio.com'
                		}
			       	}
			   	}
			   	,nomUs_agr:{	validators: {
			       		notEmpty: {
				           	message: 'Debe indicar un nombre de usuario'
				        }
			       	}},
			      psw_agr:{
			      	validators: {
			       		notEmpty: {
				           	message: 'Debe ingresar una contraseña para el usuario creado'
				        }
			       	}},
			       	statusEm_agr:{validators: {
			       		notEmpty: {
				           	message: 'Debe indicar un status para el usuario'
				        }
			       	}}

		   	}
	  	}).on('success.form.bv',function(e,data){
	  		e.preventDefault();
	  		var $form = $(e.target);               
            var bv    = $form.data('bootstrapValidator');
			var form=$('#NewEmp').serialize();
			var route='/menu/registros/empleados/agregar';
			$.post(route,form)
			.done(function(answer){
										if(answer.codigo==1){
						swal({
								title:'Guardado Exitoso',//Contenido del modal
								text: '<p style="font-size: 1.0em;">'+'El empleado se registro correctamente!!'+'</p>',
								type: "success",
								showConfirmButton:true,//Eliminar boton de confirmacion
								html: true
						},
	  				 	function(isConfirm)
	  				 	{
	  				 		if(isConfirm)
	  				 		{
	  				 			window.location.href="/menu/registros/empleados";
	  				 		}	

	  				 	});
		  				 
					}

					else if(answer.codigo==2){
						swal({
							title:'Cedula o Rif duplicados!!!',//Contenido del modal
							text: '<p style="font-size: 0.9em;">'+'Se encuentran asociados a  : '+ answer.extra+'.<br><br><br>Los datos de: Cedula y Rif para un empleado, deben ser unicos.</p>',
							type: "warning",
							showConfirmButton:true,//Eliminar boton de confirmacion
							html: true
						});
					}
					else if(answer.codigo==4)
					{
						swal({
							title:'Usuario duplicado!!!',//Contenido del modal
							text: '<p style="font-size: 0.9em;">'+ answer.extra+'.<br><br><br>Ingrese un numero de usuario diferente.</p>',
							type: "warning",
							showConfirmButton:true,//Eliminar boton de confirmacion
							html: true
						});
					}
			})
			.fail(function(){
				swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
			});
		});




 
		/////////////////////////////////////////////Funcion Boton Guardar modificar /////////////////////////////////////////////////////////// 
		$('#updateEmp').bootstrapValidator({
			excluded: [':disabled'],
		   	fields: {
				nomEmp1m: {
			       	validators: {
				        notEmpty: {
				           message: 'Indique el nombre del empleado'
				        },
				        regexp: {
			                regexp: /^[a-z\s]+$/i,
			                message: 'El nombre debe contener solo caracteres alfabéticos'
		                }
			       	}
				},
			    nomEmp2m: {
			       	validators: {
			       		 notEmpty: {
				           message: 'Indique el nombre del empleado'
				        },
			       		regexp:{
				       		regexp: /^[a-z\s]+$/i,
			                message: 'El nombre debe contener solo caracteres alfabéticos'
			        	}
			       }
			    },
			    apellEmp1m: {
			       validators: {
			         	notEmpty: {
			           		message: 'Indique el apellido del empleado'
			        	},
			        	regexp: {
			                regexp: /^[a-z\s]+$/i,
			                message: 'El apellido debe contener solo caracteres alfabéticos'
	                	}
			       	}
			    },
			     apellEmp2m: {
			       validators: {
			       	notEmpty: {
			           		message: 'Indique el apellido del empleado'
			        	},
			        regexp: {
		                regexp: /^[a-z\s]+$/i,
		                message: 'El apellido debe contener solo caracteres alfabéticos'
	                }
			       }
			     },
			    TrifEmpm: {
			       	validators: {
			         	notEmpty: {
			           		message: 'Debe indicar el tipo de rif'
			         	}
			       	}
			    },
				rifEmpm: {
			       	validators: {
			         	notEmpty: {
			           		message: 'Debe indicar el número de rif'
			         	},
				        regexp: {
			                regexp: /^[0-9]+$/,
			                message: 'El rif debe contener solo numeros'                            
		                }
			       	}
				},
				TciEmpm: {
			       	validators: {
		         		notEmpty: {
				        	message: 'Debe indicar el tipo de documento'
				        }
			       	}
			   	},
			    ciEmpm:{
			       	validators: {
						notEmpty: {
				           message: 'Debe indicar el numero de documento'
				        },
				        regexp: {
			                regexp: /^[0-9]+$/,
			                message: 'La cédula de identidad debe contener solo números'                            
		                }
			       	}
			   	},
			   	fnEmpmm:{
			       	validators: {
						notEmpty: {
				           message: 'Debe indicar la fecha de nacimiento'
				        }
			       	}
			   	},
			   	direccionEmprm:{
			       	validators: {
						notEmpty: {
				           message: 'Debe indicar la dirección a la cual pertenece el empleado'
				        }
			       	}
			   	},
			   	departamentoEmpm:{
			       	validators: {
						notEmpty: {
				           message: 'Debe indicar el departamento al cual pertenece el empleado'
				        }
			       	}
			   	},
			   	areaEmp_m:{
			       	validators: {
						notEmpty: {
				           message: 'Debe indicar el área a la cual pertenece el empleado'
				        }
			       	}
			   	},
			   	cgoEmpm:{
			       	validators: {
						notEmpty: {
				           message: 'Debe indicar el cargo del empleado'
				        }
			       	}
			   	},
			   	pdhem:{
			       	validators: {
						notEmpty: {
				           message: 'Seleccione el país'
				        }
			       	}
			   	},
			   	rgdhem:{
			       	validators: {
						notEmpty: {
				           message: 'Seleccione la región'
				        }
			       	}
			   	},
			   	edodhem:{
			       	validators: {
						notEmpty: {
				           message: 'Seleccione el estado'
				        }
			       	}
			   	},
			   	mundhem:{
			       	validators: {
						notEmpty: {
				           message: 'Seleccione el municipio'
				        }
			       	}
			   	},
			   	codigoPostalm:{
			       	validators: {
						notEmpty: {
				           message: 'Debe indicar el código postal'
				        },
				        regexp: {
			                regexp: /^[0-9]+$/,
			                message: 'El código postal debe contener solo números'                            
		                }
			       	}
			   	},
			   	descpdhem:{
			       	validators: {
						notEmpty: {
				           message: 'Debe indicar la dirección específica'
				        }
			       	}
			   	},
			   	numerol_1cm:{
			       	validators: {
						notEmpty: {
				           message: 'Debe indicar el código de área'
				        }
			       	}
			   	},
			   		numerol_1tm:{
			   			validators: {
						notEmpty: {
				           message: 'Debe indicar el numero de telefono local'
				        },
				         regexp: {
			                regexp: /^[0-9]+$/,
			                message: 'El numero de telefeno debe contener solo numeros'                            
		                }
			       	}
			   		}
			   	,

			  
			   	numerol_2cm:{
			       	validators: {
						notEmpty: {
				           message: 'Debe indicar el código de área '
				        }
			       	}
			   	},
			   	numerol_2tm:{
			       validators: {
						notEmpty: {
				           message: 'Debe indicar el numero de telefono de oficina'
				        },
				         regexp: {
			                regexp: /^[0-9]+$/,
			                message: 'El numero de telefeno debe contener solo numeros'                            
		                }
			       	}
			   	},
			  	numerom_cm:{
			       	validators: {
						notEmpty: {
				           message: 'Seleccione el código de operadora'
				        }
				    }
			   	},
			   	numerom_tm:{
			       	validators: {
			       		notEmpty: {
				           message: 'Debe indicar el número de telefono'
				        },
				        regexp: {
			                regexp: /^[0-9]+$/,
			                message: 'El telefono movil debe tener solo numeros'                            
		                }
			       	}
			   	},
			   	correo_m:{
			       	validators: {
			       		notEmpty: {
				           	message: 'Debe indicar el correo electrónico'
				        },
				        emailAddress: {
                        	message: 'El correo electronico debe tener el formato minombre@midominio.com'
                		}
			       	}
			   	}
			   	,nomUs_m:{	validators: {
			       		notEmpty: {
				           	message: 'Debe indicar un nombre de usuario'
				        }
			       	}},
			      psw_m:{
			      	validators: {
			       		notEmpty: {
				           	message: 'Debe ingresar una contraseña para el usuario creado'
				        }
			       	}},
			       	statusEm_m:{validators: {
			       		notEmpty: {
				           	message: 'Debe indicar un status para el usuario'
				        }
			       	}}

		   	}
	  	}).on('success.form.bv',function(e,data){

      		e.preventDefault();
	  		var $form = $(e.target);               
            var bv    = $form.data('bootstrapValidator');
			var form=$('#updateEmp').serialize();
       		
       		var route='/menu/registros/empleados/actualizar';

       		$.post(route,form)
			.done(function(answer)
				{
					console.log(answer);
					
					if(answer.mensaje!='' && answer.codigo==0)//si el mensaje no es vacio
					{
						swal({
									title:'Datos duplicados!!!',//Contenido del modal
									text: '<p style="font-size: 0.9em;">'+answer.mensaje+'</p>',
									type: "warning",
									showConfirmButton:true,//Eliminar boton de confirmacion
									html: true
							});
					}
					else if(answer.mensaje=='' && answer.codigo==1)
					{
						swal({
									title:'Actualizacion exitosa',//Contenido del modal
									text: '<p style="font-size: 1.0em;">'+'Los datos de empleado se guardaron correctamente!!!'+'</p>',
									type: "success",
									showConfirmButton:true,//Eliminar boton de confirmacion
									html: true
								},
		  				 	function(isConfirm)
		  				 	{
		  				 		if(isConfirm)
		  				 		{
		  				 			window.location.href="/menu/registros/empleados";
		  				 		}	

		  				 	});
					}
					else if(answer.mensaje=='' && answer.codigo==0)
					{
						$('#myModal2').modal('hide');
					}

				})
			.fail(function()
				{
					swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
				});
       });




		/////////////////////////////////////////////Funcion para los Check ///////////////////////////////////////////////////

		$('.checkEmpleado').change(function()
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
			var route='/menu/registros/empleados/status';

			swal({
				title: "Cambio de status",
				text: "¿Desea "+acciones[valor]+" El empleado seleccionado ?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor:colores[valor],
				confirmButtonText: acciones[valor]+' Empleado',
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
								swal("Modificacion exitosa !!", "El empleado ha sido "+mensajes[valor]+" correctamente", "success");
								$('#'+actual.attr('id')).val(valores[valor]);

							}
						})
						.fail(function()
							{ swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
					}
					else
					{
						 
						 swal("Cambio de status cancelado !!", "No se modifico el status del empleado", "error");
						 actual.prop('checked',estados[valor]);
						 $('#'+actual.attr('id')).val(valor);
						 
					}
			});

		});












});