//////////////////////////////////////////////// variables globales /////////////////////////////////////////////

var vista_submodulos=false;//true cuando la vista de submodulos esta activa
var vista_acciones=false;//true cuando la vista de acciones esta activa

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////funciones para clientes///////////////////////////////////////////////////////////////





///////////////////////////// funciones para datos cmplementarios ////////////////////////////////////////////




function limpiarTarjetas (tarjetas) //retira los resultados de las tarjetas que se le indiquen
{
	var tarjetas=tarjetas;
	var id=false;
	$.each(tarjetas, function(i)
	{
		id=$(this).attr('id');
		$('#'+id+' li').remove();
		$('#'+id+' p').remove();
		//$('#'+id+' input').remove();

	})
}



function limpiarInputs (tarjetas) //retira los inputs de busqueda
{
	var tarjetas=tarjetas;
	var id=false;
	$.each(tarjetas, function(i)
	{
		id=$(this).attr('id');
		$('#'+id+' input').remove();
	

	})
}


function eliminarComponentes() 
{
	$('.EliminarComponente').click(function()
	{

		//alert('Tabla intermedia componente-equipo: '+$(this).attr('data-registro')+'  tabla componentes: '+$(this).attr('data-registro_'));
		var url='/menu/registros/datos/eliminar_componente';
		var datos=[$(this).attr('data-registro'),$(this).attr('data-registro_')];//id del registro en la tabla intermedia (ecomponente_tequipo) //id del registro en la tabla (epiezas)
				
			$.get(url, {datos:datos}, function(data)
				{

					if (data) 
					{

						alert(data);
						if(data>0)
						{

							limpiarTarjetas([$('#tarjetaPiezas_')]);
							limpiarInputs([$('#inputPiezas')]);
							$( '#tpEP' ).trigger( 'keyup' );

							swal({

								title:'Eliminacion completa!!!.',//Contenido del modal
								text: '<p style="font-size: 1.5em;">'+'El  componente eliminado junto con todas sus piezas asociadas'+'</p>',
								timer:2500,//Tiempo de retardo en ejecucion del modal
								type: "success",
								showConfirmButton:false,//Eliminar boton de confirmacion
								html:true
														
							});

						}
						else if(data==0)
						{

							swal({

								title:'ERROR AL ELIMINAR EL COMPONENTE!!',//Contenido del modal
								text: '<p style="font-size: 1.5em;">'+'Comuniquese con el administrador'+'</p>',
								timer:2500,//Tiempo de retardo en ejecucion del modal
								type: "error",
								showConfirmButton:false,//Eliminar boton de confirmacion
								html:true
														
							});
						}

					}
					else
					{
						swal({

								title:'ERROR INESPERADO!!!.',//Contenido del modal
								text: '<p style="font-size: 1.5em;">'+'Comuniquese con el administrador'+'</p>',
								timer:2500,//Tiempo de retardo en ejecucion del modal
								type: "error",
								showConfirmButton:false,//Eliminar boton de confirmacion
								html:true
														
							});

					}


				})

	});

	
}


function eliminarpiezas() 
{

	

	$('.EliminarPieza').click(function()
	{

		var url='/menu/registros/datos/eliminar_pieza';
		var datos=[$(this).attr('data-registro'),$(this).attr('data-registro_')];//id del registro en la tabla intermedia //id del registro en la tabla (epiezas)
				

				$.get(url, {datos:datos}, function(data)
				{
					if(data)
					{

						if (data!=0) 
						{

							swal({

								title:'Eliminacion completa!!!.',//Contenido del modal
								text: '<p style="font-size: 1.5em;">'+'La pieza fue eliminada con exito'+'</p>',
								timer:2500,//Tiempo de retardo en ejecucion del modal
								type: "success",
								showConfirmButton:false,//Eliminar boton de confirmacion
								html:true
														
							});
							$( '#Tepieza' ).trigger( 'keyup' );

						}
						else
						{
							swal({

								title:'ERROR INESPERADO!!!.',//Contenido del modal
								text: '<p style="font-size: 1.5em;">'+'Comuniquese con el administrador'+'</p>',
								timer:2500,//Tiempo de retardo en ejecucion del modal
								type: "error",
								showConfirmButton:false,//Eliminar boton de confirmacion
								html:true
														
							});

						}


					}
					else
					{

						swal({

								title:'ERROR INESPERADO!!!.',//Contenido del modal
								text: '<p style="font-size: 1.5em;">'+'Comuniquese con el administrador'+'</p>',
								timer:2500,//Tiempo de retardo en ejecucion del modal
								type: "error",
								showConfirmButton:false,//Eliminar boton de confirmacion
								html:true
														
							});


					}

				})



		//alert('Tabla intermedia:  '+$(this).attr('data-registro')+'  Tabla original: '+$(this).attr('data-registro_'));
	});
	
}


function insertar_piezas () 
{
	$('#Tepieza').keypress(function(tecla) //return($asociar,$existe);
	{
			
			if (tecla.which==13 && $(this).val().length>0) //si no esta vacio
										{
											
											var datos=[$(this).val(),$(this).attr('data-dependencia')];
											$.get("/menu/registros/datos/consulta_insertar_pieza", {datos:datos}, function(data)
												{

											
													if (data[1]==0 || data[1]==1) 
													{
														alert(data);
														if (data[1]==0) //si la pieza se agrego 
														{
															swal({

																	title:'Guardado exitoso!!!.',
																	text: '<p style="font-size: 1.5em;">'+'La pieza fue agregada con exito'+'</p>',
																	timer:2500,//Tiempo de retardo en ejecucion del modal
																	type: "success",
																	showConfirmButton:false,//Eliminar boton de confirmacion
																	html:true
																});
															eliminarpiezas(); 
														}
														else if(data[1]==1 && data[0]==0)
														{
															swal({

																	title:'La pieza existe !!!.',//Contenido del modal
																	text: '<p style="font-size: 1.5em;">'+'Ya se encuentra registrada'+'</p>',
																	timer:2500,//Tiempo de retardo en ejecucion del modal
																	type: "error",
																	showConfirmButton:false,//Eliminar boton de confirmacion
																	html:true
																});
															eliminarpiezas(); 

														}

														
													} 
												else
												{
													swal({

															title:'ERROR INESPERADO!!!.',//Contenido del modal
															text: '<p style="font-size: 1.5em;">'+'Comuniquese con el administrador'+'</p>',
															timer:2500,//Tiempo de retardo en ejecucion del modal
															type: "error",
															showConfirmButton:false,//Eliminar boton de confirmacion
															html:true
														
														});

												}

													
												})


										}

		
	});
}

function busqueda_dinamica() 
{
	
	$('.BUSE').keyup(function()//buscador en tiempo real
{

		//alert('Dependencia: '+ $(this).attr('data-dependencia')+' indice tabla: '+$(this).attr('data-inputbus'));
		var idTarjetas=['tarjetaEquipos_','tarjetaComponentes_','tarjetaPiezas_'];
		var botonOjoid=['Tequipo','Componente'];//guarda los id para el boton prewiew
		var botonOjoClase=['consultarComponentes','consultarPiezas'];//guarda las clases
		var botonEliminarId=['EliminarEq','EliminarCom','EliminarPie'];//id del boton eliminar
		var botonEliminarClase=['EliminarEquipo','EliminarComponente','EliminarPieza'];//clase para el boton eliminar
		var tarjetaPreviewId=['_tarjetaEquipos_','_tarjetaComponentes_','_tarjetaPiezas_'];//tarjetas para el boton preview (ojo)
		var tarjetaEliminarId=['EliminarEquipo_','EliminarComponente_','EliminarPieza_'];
	
		
		var expresion=$(this).val();//captura los elementos de la caja de texto
		var indice_tabla=$(this).attr('data-inputbus');//tabla que se esta consultando
		var dependencia=$(this).attr('data-dependencia');
		var registro=false;//usado como id de la tabla intermedia para borrar
		var registro_=false;//usado como id de la tabla principal para borar
		

		var url="/menu/registros/datos/consulta_dinamica";
		
		if (indice_tabla==0)//resultado de busqueda de componentes para un equipo
		{

			limpiarTarjetas ([$('#tarjetaComponentes_'),$('#tarjetaPiezas_')]) ;
			limpiarInputs([$('#inputComponente'),$('#inputPiezas')]);
			
		

		}
		else if (indice_tabla==1)
		{
			limpiarTarjetas ([$('#tarjetaPiezas_')]) ;
			limpiarInputs([$('#inputPiezas')]);
		

		}

		var datos=[expresion,indice_tabla,dependencia];

		$.get(url, {datos:datos}, function(data)
			{
				
				
				if (data) 
				{

					if (data.length>0) //si regresa registros desde la base de datos
					{
						
						$('#'+idTarjetas[indice_tabla]+' p').remove();//remover parrafos
						$('#'+idTarjetas[indice_tabla]+' li').remove();//remover registros 
					

						$.each(data, function(i, item)
							 {
					    
					    		
					    		if (indice_tabla==0) //si se esta trabajando con la vista de equipos
					    		{
					    			registro=item.id;//registro: representa el id de la tabla intermedia
					    		}
					    	else if (indice_tabla==1 || indice_tabla==2) //si se esta trabajando con la vista de componentes
					    		{
					    			registro=item.registro;
					    		}


					    		$('#'+idTarjetas[indice_tabla] +' ul').append('<li class="lista__"><div class="container-fluid  "><div class="row nuevo"><div class="col-md-6"><div class="tl1"><span>'+item.descripcion+'</span></div></div><div class="col-md-1 col-md-push-3"><div class="iclst" id="'+tarjetaPreviewId[indice_tabla]+item.id+'">      </div></div><div class="col-md-2 col-md-push-3"  border><div class="iclst id="'+tarjetaEliminarId[indice_tabla]+item.id+'"><i class="fa fa-trash-o '+botonEliminarClase[indice_tabla]+' gestionar" id="'+botonEliminarId[indice_tabla]+item.id+'"  data-registro="'+registro+'" data-registro_="'+item.id+'"></i></div>   </div></div></div></li>');

					    		if (indice_tabla!=2) //agrega el boton preview para las vistas de: equipos y componentes
					    		{

					    			$('#'+tarjetaPreviewId[indice_tabla]+item.id).append('<i class="fa fa-eye '+botonOjoClase[indice_tabla]+' gestionar" id="'+botonOjoid[indice_tabla]+item.id+'" data-dependencia="'+item.id+'"></i>');
					    		}
		                                            
							})
						consultar_componentes();//muestra los componentes asociados a un tipo de equipo 
						consultar_pieza();//crea en memoria la funcion para consultar piezas
						eliminarpiezas(); 
						//eliminarComponentes();
					}
				else
					{
								$('#'+idTarjetas[indice_tabla]+' p').remove();//remover parrafos
								$('#'+idTarjetas[indice_tabla]+' li').remove();//remover registros 
								$('#'+idTarjetas[indice_tabla]).append('<div class="container mensaje_"><p> 0 Resultados para: '+expresion+' </p><p>Presione Enter para guardar</p></div>');


					}

				}
			})
});



}


function buscador_componentes()//insertar componentes
{

		$('#tpEP').keypress(function(tecla)//insertar componente
									{

										if (tecla.which==13 && $(this).val().length>0) //si no esta vacio
										{
											var datos=[$(this).val(),$(this).attr('data-dependencia')];
											$.get("/menu/registros/datos/consulta_comp_", {datos:datos}, function(data)
												{

											
													if (data[1]==0 || data[1]==1) 
													{
														if (data[1]==0) 
														{
															swal({

																	title:'El componente fue creado con exito!!!.',
																	text: '<p style="font-size: 1.5em;">'+'Solo debe insertar piezas para el'+'</p>',
																	timer:2500,//Tiempo de retardo en ejecucion del modal
																	type: "success",
																	showConfirmButton:false,//Eliminar boton de confirmacion
																	html:true
																});
														}
														else if(data[1]==1 && data[2]==0)
														{
															swal({

																	title:'El componente se encuentra creado !!!.',//Contenido del modal
																	text: '<p style="font-size: 1.5em;">'+'Solo debe insertar piezas para el'+'</p>',
																	timer:2500,//Tiempo de retardo en ejecucion del modal
																	type: "error",
																	showConfirmButton:false,//Eliminar boton de confirmacion
																	html:true
																});

														}

														$('#tarjetaComponentes_ li').remove();
														$.each(data[0], function(i, item)
												 			{
										    
											    					//$('#tarjetaComponentes_').append(' <p>"'+item.componenteId+'"</p>');
											    					$('#tarjetaComponentes_ ul').append('<li class="lista__"><div class="container-fluid  "><div class="row nuevo"><div class="col-md-6"><div class="tl1"><span>'+item.descripcion+'</span></div></div><div class="col-md-1 col-md-push-3"><div class="iclst"><i class="fa fa-eye consultarPiezas gestionar" id="pieZ'+item.componenteId+'" data-ecomponente="'+item.componenteId+'"></i></div><input type="hidden" id=" " value=" "></div><div class="col-md-2 col-md-push-3"  border><div class="iclst id="checklistE'+item.componenteId+'"><i class="fa fa-trash-o consultarPiezas_ gestionar" id=""></i></div>   </div></div></div></li>');


										    	
							                                            
															})

														consultar_pieza();
													} 
												else
												{
													swal({

															title:'ERROR INESPERADO!!!.',//Contenido del modal
															text: '<p style="font-size: 1.5em;">'+'Comuniquese con el administrador'+'</p>',
															timer:2500,//Tiempo de retardo en ejecucion del modal
															type: "error",
															showConfirmButton:false,//Eliminar boton de confirmacion
															html:true
														
														});

												}

													
												})


										}

									
									});

}



function consultar_componentes(argument) //consulta los componetes asociados a un tipo de equipo
{

		$('.consultarComponentes').click(function()//consultar componentes del equipo seleccionado
				{
					$('.consultarComponentes').css("color","grey");
					$(this).css("color","white");
					var datos=$(this).attr('data-dependencia');
					
					$.get("/menu/registros/datos/consulta_comp", {datos:datos}, function(data)
					{
						

						if(data)
						{
								

								if (data[1]==0) 
								{
									$('#inputComponente input').remove();
                                    $('#inputComponente').append('<input type="search" placeholder="Buscar" class="BUSE" id="tpEP" data-inputbus="1" data-dependencia="'+data[2]+'" ><span class="fa fa-search"></span>');
									$('#tarjetaComponentes_ p').remove();
									$('#tarjetaComponentes_ li').remove();

									swal({

											title:'El equipo no posee componentes!!!.',//Contenido del modal
											text: '<p style="font-size: 1.5em;">'+'Debe insertar componentes para el'+'</p>',
											timer:2500,//Tiempo de retardo en ejecucion del modal
											type: "error",
											showConfirmButton:false,//Eliminar boton de confirmacion
											html:true
									})

									consultar_pieza();
									buscador_componentes();//buscador de componentes
									busqueda_dinamica();
								}
								else if (data[1]==1) 
								{
									
									$('#inputComponente input').remove();
                                    $('#inputComponente').append('<input type="search" placeholder="Buscar" class="BUSE" id="tpEP" data-inputbus="1" data-dependencia="'+data[2]+'" ><span class="fa fa-search"></span>');
									$('#tarjetaComponentes_ p').remove();
									$('#tarjetaComponentes_ li').remove();
									$.each(data[0], function(i, item)
							 			{
					    
					    					//$('#tarjetaComponentes_').append(' <p>"'+item.componenteId+'"</p>');
					    					$('#tarjetaComponentes_ ul').append('<li class="lista__"><div class="container-fluid  "><div class="row nuevo"><div class="col-md-6"><div class="tl1"><span>'+item.descripcion+'</span></div></div><div class="col-md-1 col-md-push-3"><div class="iclst" id="_tarjetaComponentes_"><i class="fa fa-eye consultarPiezas gestionar" id="Componente'+item.id+'" data-dependencia="'+item.id+'"></i></div></div><div class="col-md-2 col-md-push-3"  border><div class="iclst id="EliminarComponente_'+item.id+'"><i class="fa fa-trash-o EliminarComponente gestionar" id="EliminarCom'+item.id+'" data-registro="'+item.registro+'" data-registro_="'+item.id+'"></i></div>   </div></div></div></li>');


					    	
		                                            
										})
									consultar_pieza();
									buscador_componentes();//buscador de componentes
									busqueda_dinamica();
									eliminarComponentes();
									


								}
							}
						else
						{
							swal({

								title:'ERROR INESPERADO!!!.',//Contenido del modal
								text: '<p style="font-size: 1.5em;">'+'Comuniquese con el administrador'+'</p>',
								timer:2500,//Tiempo de retardo en ejecucion del modal
								type: "error",
								showConfirmButton:false,//Eliminar boton de confirmacion
								html:true
							});

						}
						
					})
						
						



				});

	
}

function consultar_pieza () 
{
	
	$('.consultarPiezas').click(function()
			{
				$('.consultarPiezas').css("color","grey");
				$(this).css("color","white");
					var idComponente=$(this).attr('data-dependencia');//id del componente
					$.get("/menu/registros/datos/consulta_comp_pieza", {datos:idComponente}, function(data)
					{
							
						if (data[1]==0 ||data[1]==1) //si regresa valores el controlador
						{

								if (data[1]==0) 
								{

									//alert('no posee piezas '+data[1]);

								}	
								else if(data[1]==1)
								{

									//alert('posee piezas asociadas '+data[1]);
								}


									//alert(data[0])
									$('#inputPiezas input').remove();
                                    $('#inputPiezas').append('<input type="search" placeholder="Buscar" class="BUSE" id="Tepieza" data-inputbus="2" data-dependencia="'+data[2]+'" ><span class="fa fa-search"></span>');

									$('#tarjetaPiezas_ li').remove();
									$.each(data[0], function(i, item)
							 			{
					    
					    					//$('#tarjetaComponentes_').append(' <p>"'+item.componenteId+'"</p>');
					    					$('#tarjetaPiezas_ ul').append('<li class="lista__"><div class="container-fluid  "><div class="row nuevo"><div class="col-md-6"><div class="tl1"><span>'+item.descripcion+'</span></div></div><div class="col-md-1 col-md-push-2"><div class="iclst" id="_tarjetaPiezas_">    </div></div><div class="col-md-2 col-md-push-3"  border><div class="iclst id="EliminarPieza_'+item.id+'"><i class="fa fa-trash-o EliminarPieza gestionar" id="EliminarPieza'+item.id+'" data-registro="'+item.registro+'" data-registro_="'+item.id+'"></i></div>   </div></div></div></li>');


					    	
		                                            
										})

							busqueda_dinamica();
							insertar_piezas ();
							eliminarpiezas() 
						}

					})





		//alert($(this).attr('data-ecomponente'));


			})



}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////funciones definidas para luego ser utilizadas /////////////////////////////

function obtener_valor(indice,cadena)//indice: caracter/letra para cortar, cadena: valor del name o del id
{
		
	var indice=indice;
	var cadena=cadena;
	var longitud=cadena.length;//longitud de la cadena
	var indice=cadena.indexOf(indice);//indice del caracter que indica el inicio de los numeros
	var valor=cadena.slice(indice+1,longitud);//valor obtenido

	return valor;
}//funcion que se encarga de extraer el valor numerico contenido en una cadena


function actualizar_status (datos,ruta) //actualiza el status de un modulo en la base de datos
{
	
	var datos=datos;
	var url=ruta;
	$.get(url, {datos:datos}, function(configurar)//va al contrololador para modificar status del modulo
	{
		if(configurar==0)//si no recibe valores del controlador
			{
																											
				swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
			}

	})
}

function cheks_activos(input__) //cuenta los checks que se encuentrar activos
{
	var contadorChekAct=0;
	$.each(input__,function(i)//recorre los inputs para buscar los checks
					
					{
						if ($(this).attr('type')=='checkbox')
						{
							if($(this).prop('checked')==true)
							{
								contadorChekAct+=1;//cuenta los check activos
							}
						}
					})

return contadorChekAct;
}


function extraer_elementos(padre)
{
	var padre=padre;
	var modulos_=document.getElementById(padre);//obtener el listado de los modulos creados
	var input=modulos_.getElementsByTagName("input");//obtener elementos que poseen la etiqueta input dentro de la tajeta de modulos
	var checks=[];

	$.each(input, function(i)
	{
		if ($(this).attr('type')=='checkbox') 
		{
			checks.push($(this));
		}
	})

 return checks;
}

function checks_acciones (padre,condicion) 
{
	var padre=padre;
	var condicion=condicion;
	var checks=[];
	if(condicion==true)
	{
		checks=extraer_elementos(padre);
	}

	return checks;
}


function actualizar_checks_acciones (checks,submoduloId,estado, vista)
 {
		var submoduloId=submoduloId;
		var estado=estado;
		var vista=vista;
		$.each(checks, function(i)
			{
				var padre_acc=obtener_valor('A',$(this).attr('name'));
				if (padre_acc==submoduloId && vista==true)
					{

						if(estado==0)//desactivar
							{
								if ($(this).prop("checked")==true)
									{
										$(this).prop("checked",false);
										$(this).val(0);
																	
									}
							}
						else if(estado==1)//activar
							{
							if ($(this).prop("checked")==false)
								{
									$(this).prop("checked",true);
									$(this).val(1);
																
								}
							}
					}

			})
											

}

function BuscarPadre(idDependencia,condicion,cambio) 
{
	var idDependencia=idDependencia;
	var condicion=condicion;
	var buscar=true;
	var padres=[]

	var elemento=$("input[data-accion="+idDependencia+"]");
	var valores=[1,0];

	do
	{
		if($(elemento).prop('checked')!=condicion)//verifica si la dependencia debe cambiar su propiedad checked
		{

			if (condicion==true) //identifica si debe activarse
			{
				if(cambio==1)
				{
					$(elemento).prop('checked',true);
					$(elemento).val(valores[$(elemento).val()]);id=
					actualizar_status (obtener_valor('A',$(elemento).attr('id')),'/menu/registros/perfiles/configurar/accion');
					//alert('Entro True Buscar padre');
				}
				padres.push($(elemento));

			}
			else if(condicion==false)//identifica si debe desactivarse
			{
				
				if(cambio==1)
				{
					$(elemento).prop('checked',false);
					$(elemento).val(valores[$(elemento).val()]);
					actualizar_status (obtener_valor('A',$(elemento).attr('id')),'/menu/registros/perfiles/configurar/accion');
					//alert('Entro False Buscar padre');
				}
				padres.push($(elemento));
			}



		}
			var dependencia=$(elemento).attr('data-dependencia');
			//alert('dependencia: '+dependencia+'  idAccion: '+$(elemento).attr('data-accion'));

		if ($(elemento).attr('data-accion')==dependencia) 
		{
			buscar=false;

		}
		else if ($(elemento).attr('data-accion')!=dependencia) 
		{

			idDependencia=$(elemento).attr('data-dependencia');
			elemento=$("input[data-accion="+idDependencia+"]");

		}

	}
	while(buscar==true);

 return padres;
}


function BuscarHijos(acciones,padres,condicion) 
{
	 var valores=[1,0];
	 var acciones=acciones;
	 var idAccion=idAccion;
	 var condicion=condicion;
	 var padre=false;
	 var hijos=[];

	 
$.each(padres, function(i) 
{
	  padre=$(this).attr('data-accion');
	 

	  $.each(acciones, function(i) 
	  {
	  	if(($(this).attr('data-dependencia')==padre) && ($(this).attr('data-accion')!=padre))
	  	{
	  		if($(this).prop('checked')!=condicion)
	  		{
	  			$(this).prop('checked',condicion);
	  			$(this).val(valores[$(this).val()]);
	  			actualizar_status (obtener_valor('A',$(this).attr('id')),'/menu/registros/perfiles/configurar/accion');
	  			hijos.push($(this));
	  		}
	  		
	  	}


	  })


})
	return hijos;		    


}


function acciones_padre(padre,acciones) 
	{
							
		var padre=padre;
		var acciones=acciones;
		var activos=0;
		$.each(acciones, function(i)
		{
			if ($(this).attr('data-dependencia')==padre) 
				{
					if(($(this).attr('data-accion')!=padre)&&($(this).prop('checked')==true))
					{
						activos+=1;
					}
				}

		})	
		return activos;
	}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////






$(".consultarSubmodulo").click(function(){
				
				
                   
				
				
		$(".consultarSubmodulo").css("color","grey");
		$(this).css("color","white");
		///////////BUSCADO BOTON CLICKEADO/////////////	
			ID = $(this).attr("id");///////ID DEL BOTTON MODIFICAR/////////	

			idPerfil=$('#idPerfil').val();///////TRAER VALOR DEL ID DEL BOTTON MODIFICAR/////////		

			idModulo=$('#Perfilid'+ID).val();///////TRAER VALOR DEL ID DEL BOTTON MODIFICAR/////////

			valores=[idPerfil,idModulo];
			//alert(valores);
			//$('#Categoriaid').val(idCategoria);///////ID DEL BOTTON MODIFICAR IGUALADA AL VALOR DEL CAMPO CORRESPONDIENTE AL ID SELECCIONADO/////////	
		///////////PASANDO VARIABLE Y CARGANDO LISTADO CORRESPONDIENTE A LA SELECCION PREVIA Y ESPERANDO DATA COMO RESPUESTA/////////////			        	
			$.get("/menu/registros/perfiles/submodulos", {valores:valores}, function(data){

				if (data.length>0) //verifica que hayn submodulos para el modulo seleccionado
				{
					vista_submodulos=true;//la vista para de los sbmodulos asociada a n modulo se encuentra activa
					vista_acciones=false;//las vista de acciones se encuentra inactiva
				}
				else  //en caso de no encontrar submodulos para el modulo seleccionado
				{
					vista_submodulos=false;//la vista para de los sbmodulos asociada a n modulo se encuentra inactiva
					vista_acciones=false;//las vista de acciones se encuentra inactiva

				}

				$( ".limpiarul1" ).remove();
				$( ".limpiarul2" ).remove();

	    ///////////ASIGNANDO LOS VALORES DEL ARRAY A LOS IMPUT CORRESPONDIENTES DEL MODAL MODIFICAR/////////////	
			    $.each(data, function(i, item) {
			    
			    	$('#targeta2 ul').append('<li class="limpiarul1" style="display:none;"><div class="container-fluid cont"><div class="row"><div class="col-md-6"><div class="tl1"><span>'+item.descripcion+'</span></div></div><div class="col-md-1 col-md-push-2"><div class="iclst"><i class="fa fa-eye consultarAcciones" id="n'+item.submoduloId+'"></i></div><input type="hidden" id="Accionn'+item.submoduloId+'" value="'+item.submoduloId+'"></div><div class="col-md-2 col-md-push-3"><div class="chbx1x" id="checklist'+item.submoduloId+'"> </div></div></div></div></li>');
			   
			   if(item.Status==1)//agregar check de status cuando el submodulo esta asignado para el perfil
			   {
			  		 $('#checklist'+item.submoduloId).append(' <input type="checkbox" value="'+item.Status+'" class="configurarSub" data-submoduloId="'+item.submoduloId+'" id="cckS'+item.registro+'" name="cckS'+item.padre+'" checked><label for="cckS'+item.registro+'"></label> ');
			   
			   }
			   else if(item.Status==0)//agregar check de status cuando el submodulo no esta signado para el perfil
			   {
			   		  $('#checklist'+item.submoduloId).append(' <input type="checkbox" value="'+item.Status+'"  class="configurarSub"  data-submoduloId="'+item.submoduloId+'" id="cckS'+item.registro+'" name="cckS'+item.padre+'" ><label for="cckS'+item.registro+'"></label> ');

			   }

			   $( ".limpiarul1" ).each(function() {
				    $( this ).slideUp(0).delay(0).fadeIn(0);
				 });
			    })  

			    

			    $(".consultarAcciones").click(function(){
			    $(".consultarAcciones").css("color","grey");
			    $(this).css("color","white");

			    ID = $(this).attr("id");
			    idSubmodulo=$('#Accion'+ID).val();				
				valoresAcc=[idPerfil,idSubmodulo];
				$.get("/menu/registros/perfiles/acciones", {valoresAcc:valoresAcc}, function(data1){
					
					if (data.length>0) //verifica que hayn submodulos para el modulo seleccionado
					{
						vista_submodulos=true;//la vista para de los sbmodulos asociada a n modulo se encuentra activa
						vista_acciones=true;//las vista de acciones asociada al submodulo de turno se encuentra activa
					}
					else  //en caso de no encontrar submodulos para el modulo seleccionado
					{
						vista_submodulos=true;//la vista para los sbmodulos asociada al modulo de  se encuentra inactiva
						vista_acciones=false;//las vista de acciones se encuentra inactiva

					}
					$( ".limpiarul2" ).remove();
					$.each(data1, function(i, item) 
					{
						$('#targeta3 ul').append('<li class="limpiarul2" style="display:none;" id="AC'+item.accionId+'"    ><div class="container-fluid cont"><div class="row"><div class="col-md-6"><div class="tl1"><span>'+item.descripcion+'</span></div></div><div class="col-md-1 col-md-push-2"><div class="iclst"></div><input type="hidden" id="Accio2nn'+item.accionId+'" value="'+item.accionId+'"></div><div class="col-md-2 col-md-push-3"><div class="chbx1x" id="checklistA'+item.accionId+'">   </div></div></div></div></li>');
			    		 
			    		 if(item.Status==1)//agregar check de status cuando el submodulo esta asignado para el perfil
			  				 {
			  		 			$('#checklistA'+item.accionId).append(' <input type="checkbox" data-dependencia="'+item.dependencia+'" data-accion="'+item.accionId+'"  value="'+item.Status+'" class="configurarAcc" id="cckA'+item.registro+'" name="cckA'+item.padre+'" checked><label for="cckA'+item.registro+'"></label> ');
			   
			  				 }
			  			 else if(item.Status==0)//agregar check de status cuando el submodulo no esta signado para el perfil
			   				{
			   		  			$('#checklistA'+item.accionId).append(' <input type="checkbox" data-dependencia="'+item.dependencia+'"   data-accion="'+item.accionId+'"  value="'+item.Status+'"  class="configurarAcc"  id="cckA'+item.registro+'" name="cckA'+item.padre+'" ><label for="cckA'+item.registro+'"></label> ');
 
			  				 }
			  			
			  			if(item.ventana==1)
			  			{

			  				$('#'+'AC'+item.accionId).css({"backgroundColor":"#645F5F","color":"#FFFFFF"});
			  			}
			  			/*else if(item.ventana==0)
			  			{
			  				$('.limpiarul2').css({"backgroundColor":"#222","color":"#E5E5E7"});
			  			}*/



			    		$( ".limpiarul2" ).each(function() {
				    $( this ).slideUp(0).delay(0).fadeIn(0);
				 });
			    	})  
				




				$('.configurarAcc').change(function()//configurar submodulos
			{
				var valores=[1,0];
			
				var activar_submodulo=false;
				var registro=obtener_valor('A',$(this).attr('id'));
		    	////////////////////////////////////////////////////////////////////////
		    	var submoduloPadre=obtener_valor('A',$(this).attr('name'));
		    	////////////////////////////////////////////////////////////////////////
		    	var status=$(this).prop('checked');
		   		var url= '/menu/registros/perfiles/configurar/accion';//rutas[tabla];
				var datos=registro;//datos para el controlador (registro a modificar y tabla a modificar)*/
				var idAccion=$(this).attr('data-accion');//id de la accion actual
				var accion=$(this);
				var accionDependiente=$(this).attr('data-dependencia');//id de la accion que depende 
				$.get(url, {datos:datos}, function(configurar)
					{
						
						if(configurar==0)
						{
							
							swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
						}
						else
						{
							
							var checks_acc=checks_acciones("targeta3",vista_acciones); //checks de acciones
							var acciones_activas=cheks_activos(checks_acc);//cantidad de acciones hablitadas
							var status_check=" ";
							var comparacion=" ";
														//status refleja el estado del check de la accion false esta deshabilitada // true esta habilitada
							if (acciones_activas==0 && status==false) {status_check=false;comparacion=true;/*alert('se desactivo la ultima accion')*/}//si se desactiva la ultima
							else if(acciones_activas==1 && status==true){status_check=true;comparacion=false;/*alert('se activo la primera accion')*/}//si se activa la primera
							
							var checks_sub=checks_acciones("targeta2",vista_submodulos);//obtiene los submodulos
							var submoduloId=false;
							var moduloPadre=false;
							var modulo=false;
							var padre=false;
							var hijos=false;
							





						/////////////////////////////////////////////////////////Dependencia de acciones ////////////////////////////////////////////////////////////////////////////////////
						if(accionDependiente!=idAccion && status==true)//status refleja el status de laccion checkeada//si se habilita una accion que depende de otra y es la primera accion en habilitarse(puede ser padre o hijo)
						{
							/////////////////////////////////////trato de los posible padres ///////////////////////////	

							BuscarPadre($(accion).attr('data-dependencia'),true,1);//correcto


							/////////////////////////////////////trato de los posibles hijos ///////////////////////////

								hijos=BuscarHijos(checks_acc,[accion],true);//correcto

								while(hijos.length>0)//busca hijos de los hijos//correcto
								{
									padres=hijos;//correcto
									//alert('los hijos tienen hijos');
									hijos=BuscarHijos(checks_acc,padres,true);
								}

							///////////////////////////////////////////////////////////////////////////////////////////////

						}
						else if(accionDependiente!=idAccion && status==false)//status refleja el status de laccion checkeada//si se deshabilita una accion que depende de otra y es la penultima accion en deshabilitarse 
						{
							///////////////////////////////////////trato de los posibles padre ///////////////////////////////////////////////////////////////	
							padre=$("input[data-accion="+$(accion).attr('data-dependencia')+"]");//padre directo
							var busqueda=true;
							do//
							{
								if (acciones_padre($(padre).attr('data-accion'),checks_acc)==0)//si no hay acciones activas para el padre relacionado con la accion de turno
								{
									$(padre).prop('checked',false);
									$(padre).val(valores[$(padre).val()]);
									actualizar_status (obtener_valor('A',$(padre).attr('id')),'/menu/registros/perfiles/configurar/accion');
									if($(padre).attr('data-accion')!=$(padre).attr('data-dependencia'))
									{
										padre=$("input[data-accion="+$(padre).attr('data-dependencia')+"]");
										
									}
									else
									{
										busqueda=false;
									}
								}
								else if(acciones_padre($(padre).attr('data-accion'),checks_acc)>0)
								{
									busqueda=false;
								}
							}
							while(busqueda);


							///////////////////////////////////////trato de los posibles hijos /////////////////////////////////////
							
								hijos=BuscarHijos(checks_acc,[accion],false);//correcto
								
								while(hijos.length>0)//busca hijos de los hijos//correcto
								{
									padres=hijos;//correcto
									//alert('los hijos tienen hijos');//correcto
									hijos=BuscarHijos(checks_acc,padres,false);//correcto

								}

							
							//////////////////////////////////////////////////////////////////////////////////////////////////////////

						}
						
						else if(accionDependiente==idAccion && status==false)//busca si se deshabilita una accion padre (solo puede ser padre o no, nunca hijo)
						{
							
								hijos=BuscarHijos(checks_acc,[accion],false);//deshabilitar acciones 
								//alert('hijos: '+hijos+' condicion : 1B');
								while(hijos.length>0)
								{
									hijos=BuscarHijos(checks_acc, hijos,false);
								}
							
								//acciones_padre(padre,acciones) 
	

						}
						else if(accionDependiente==idAccion && status==true)//busca si se habilita una accion padre (solo puede ser padre o no nunca hijo)
						{
							//si se habilita y hay una o mas acciones dependientes inactivas
							
								//BuscarHijos(checks_acc,[accion],true);//habilitar
								hijos=BuscarHijos(checks_acc,[accion],true);//deshabilitar acciones 
								//alert('hijos: '+hijos+' condicion 2B');
								while(hijos.length>0)
								{
									hijos=BuscarHijos(checks_acc,hijos,true);
								}
							


						}
						///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


							//////////////////////////////////////////verificar status del submodulo padre y el modulo padre //////////////////////////////////////////

							 checks_acc=checks_acciones("targeta3",vista_acciones);
							 acciones_activas=cheks_activos(checks_acc);
							  $.each(checks_sub, function(i)
							  {
							  	//alert('buscando submodulo');
							  	submoduloId=$(this).attr('data-submoduloId');//id del submodulo
							  	if (submoduloPadre==submoduloId) //si se localiza el submodulo padre de la accion
							  		{	
							  			//alert("encontro el submodulo, el numero de acciones activas  es :  "+acciones_activas);
							  			moduloPadre=obtener_valor('S',$(this).attr('name'));//id del modulo padre
							  			modulo=document.getElementsByName('cck'+moduloPadre);

							  			if (($(this).prop('checked')==true)&&(acciones_activas==0))
							  			{
							  				$(this).prop('checked',false);
							  				$(this).val(valores[$(this).val()]);
							  				//alert('debe desactivarse el submodulo: '+$(this).attr('data-submoduloId'));
							  				actualizar_status (obtener_valor('S',$(this).attr('id')),'/menu/registros/perfiles/configurar/submodulo_');
							  				
							  				checks_sub=checks_acciones("targeta2",vista_submodulos);
							  				var submodulos_activos=cheks_activos(checks_sub);//cantidad de submodulos activos
							  		 		if(submodulos_activos==0 && $(modulo).prop('checked')==true)
							  		 		{
							  		 			$(modulo).prop('checked',false);
							  		 			$(modulo).val(valores[$(modulo).val()]);
							  		 			//alert($(modulo).attr('id'));
							  		 			actualizar_status(obtener_valor('M',$(modulo).attr('id')),'/menu/registros/perfiles/configurar/modulo_');
							  		 		}

							  			}
							  			else if( $(this).prop('checked')==false && acciones_activas>=1)
							  			{
							  				$(this).prop('checked',true);
							  				$(this).val(valores[$(this).val()]);
							  				actualizar_status (obtener_valor('S',$(this).attr('id')),'/menu/registros/perfiles/configurar/submodulo_');
							  				
							  				checks_sub=checks_acciones("targeta2",vista_submodulos);
							  				var submodulos_activos=cheks_activos(checks_sub);//cantidad de submodulos activos
							  		 		if(submodulos_activos==1 && $(modulo).prop('checked')==false)
							  		 		{
							  		 			$(modulo).prop('checked',true);
							  		 			$(modulo).val(valores[$(modulo).val()]);
							  		 			//alert($(modulo).attr('id'));
							  		 			actualizar_status(obtener_valor('M',$(modulo).attr('id')),'/menu/registros/perfiles/configurar/modulo_');
							  		 		}

							  				//alert('debe activarse el submodulo: '+$(this).attr('data-submoduloId'));
							  				
							  			}
							  		}

							  })//each 

						}
						


					});




			});




				});
				});      
     
	       


        	$('.configurarSub').change(function()//configurar submodulos
			{
				
				var valores=[1,0];
			
				var contadorChekAct=0;//cuenta los chek de submodulos que estan activos

				
				////////////////////////obtener checks de submodulos y contar los checks que estan activos ////////////////////////////////

				var submodulos_=document.getElementById("targeta2");//elementos de la tarjeta de submodulos
				var input__=submodulos_.getElementsByTagName("input");//obtiene los input inmersos en la tarjeta de submodulos
				contadorChekAct=cheks_activos(input__); 
				
				////////////////////////////////////////////////////////////////////////////////////


			
				////////////// obtener registro a modificar en la tabla perfil_submodulo////////////////////

				var id=$(this).attr('id');//id del del check de submodulos seleccionados
				var registro=obtener_valor('S',id);//S es el caracter cortante en el campo id de los check de submodulos//id del registro en la tabla perfil_submodulo
				
		    	////////////////////////////////////////////////////////////////////////

		    	var valor=$(this).val();//valor inicial del check
		    	$('#'+id).val(valores[valor]);//cambio de valor para el check, asignacion del nuevo valor

		    	
		    	////////////////////obtener id del  modulo padre///////////////////////////////////

				var modulo_id=$(this).attr('name');//el atributo name del check tiene concatenado el id del modulo padre
				var modulo_id=obtener_valor('S',modulo_id);//extraccion del id del modulo padre el cual posee el submodulo como clave foranea
				
				var name=$(this).attr('id');//obteniendo id del check actual de submodulos

		    	////////////////////////////////////////////////////////////////////////////////////////

		   		var url= '/menu/registros/perfiles/configurar/submodulo';//rutas[tabla];
				var datos=registro;//datos para el controlador (registro a modificar y tabla a modificar)*/
				var submoduloId=$(this).attr('data-submoduloId');
				$.get(url, {datos:datos}, function(configurar)
					{
						
						//alert(configurar);
						if(configurar==0)//si no recibe valores del controlador
						{
							
							swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
						}
						else
						{
							if (vista_submodulos==true) //si la vista de submodulos se encuentra activa en la pantalla
								{

									var checks=extraer_elementos("targeta1");//obtiene los checks que se encuentran en la tarjeta de modulos
									
									$.each(checks, function(i) //contiene los checks usados en la targeta de modulos (recorre los modulos para comparar con la clave foranea del submodulo seleccionado)
									{
			
											var moduloPadre_id=$(this).attr('name');//cadena que posee conccatenada el valor del id del modulo
									    	moduloPadre_id=obtener_valor('k',moduloPadre_id);//obtener el id del modulo seleccionado
											
											
											
											if (modulo_id==moduloPadre_id) //si el submodulo tiene como clave foranea el id del modulo de turno
												{
													if (($('#'+name).prop('checked')==true)&&($(this).prop('checked')==false)) //si el submodulo es checkeado y el modulo padre se encuenttra inactivo
													{

														$(this).prop('checked',true);//se checkea el modulo padre
														$(this).val(valores[$(this).val()]);//cambio de valor para el check, se le coloca 1 "activo"

														
														///////////////////////////actualizar el modulo en la base de datos ////////////
														
														var id_registro=obtener_valor('M',$(this).attr('id'));//id del registro que ocupa en la tabla modulo_perfil el cual se usa solo para actualizar en la base de datos el valor de status perteneciente al check de modulos
														actualizar_status(id_registro,"/menu/registros/perfiles/configurar/modulo_");

													}
													else if ((($('#'+name).prop('checked')==false)&&($(this).prop('checked')==true))&&(contadorChekAct==0)) //si se desactiva el ultimo submodulo perteneciente a un modulo y esta se encuentra activo
													{

														$(this).prop('checked',false);//se checkea el modulo padre
														$(this).val(valores[$(this).val()]);

														///////////////////////////actualizar el modulo en la base de datos ////////////
														
														var id_registro=obtener_valor('M',$(this).attr('id'));//id del registro que ocupa en la tabla modulo_perfil el cual se usa solo para actualizar en la base de datos el valor de status perteneciente al check de modulos
														actualizar_status(id_registro,"/menu/registros/perfiles/configurar/modulo_");
														

													}



												}

										//}

									})//fin del each)
								
								if (vista_acciones==true) 
								{
									var checks_acc=checks_acciones ("targeta3",vista_acciones);
									var submoduloPadre=false;
									$.each(checks_acc, function(i)
									{
										submoduloPadre=obtener_valor('A',$(this).attr('name'));
										if(submoduloPadre==submoduloId)
										{
											if (($('#'+name).prop('checked')==true)&&($(this).prop('checked')==false)) //si el submodulo es checkeado y el modulo padre se encuenttra inactivo
													{

														$(this).prop('checked',true);//se checkea el modulo padre
														$(this).val(valores[$(this).val()]);//cambio de valor para el check, se le coloca 1 "activo"

														
														///////////////////////////actualizar el modulo en la base de datos ////////////
														
														var id_registro=obtener_valor('A',$(this).attr('id'));//id del registro que ocupa en la tabla modulo_perfil el cual se usa solo para actualizar en la base de datos el valor de status perteneciente al check de modulos
														//actualizar_status(id_registro,"/menu/registros/perfiles/configurar/accion");

													}
													else if (($('#'+name).prop('checked')==false)&&($(this).prop('checked')==true)) //si se desactiva el ultimo submodulo perteneciente a un modulo y esta se encuentra activo
													{

														$(this).prop('checked',false);//se checkea el modulo padre
														$(this).val(valores[$(this).val()]);

														///////////////////////////actualizar el modulo en la base de datos ////////////
														
														var id_registro=obtener_valor('A',$(this).attr('id'));//id del registro que ocupa en la tabla modulo_perfil el cual se usa solo para actualizar en la base de datos el valor de status perteneciente al check de modulos
														//actualizar_status(id_registro,"/menu/registros/perfiles/configurar/accion");
														

													}



										}



									})

								}

								}//fin de validacion para saber si la vista de submodulos esta activa

						}//fin del else que se inicia si se regresan valores del metodo get
						


					});//fin del metodo get









			});//fin de la funcion de cnfigurar submodulos
	      

        	


	       });


	


		
			
});



$('.configurarPer').change(function()//configuracion en los modulos
	{
		
		var valores=[1,0];

		////////////// obtener registro a modificar ////////////////////
		var registro=obtener_valor('M',$(this).attr('id'));//obtener el registro a modificar en la tabla modulo_perfil
    	////////////////////////////////////////////////////////////////////////

    	////////////////////////////obtener id del modulo///////////////////////
		var modulo_id=obtener_valor('k',$(this).attr('name'));//obtener el id del modulo seleccionado(se encuentra concatenado en su atributo name)

        //////////////////////////////////////////////////////////////////////////
		var name=$(this).attr('id');//obtiene el id del check de modulos clickeado para ser usado mas adelante
		var valor=$(this).val();//valor inicial del check
    	$(this).val(valores[valor]);//cambio de valor para el check

   		var url= '/menu/registros/perfiles/configurar/modulo';
		var datos=registro;
		$.get(url, {datos:datos}, function(configurar)
			{
				//alert(configurar);
				if(configurar==0)
				{
					
					swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
				}
				else
				{
					if (vista_submodulos==true) //si la vista de submodulos esta visible
						{

							var checks=extraer_elementos("targeta2");//extrae los checks que se encuentran en la tarjeta de submodulos
							var checks_ac=false;
							
							$.each(checks, function(i) //each que recorre los check de submodulos 
							{

										
										var moduloPadre_id=obtener_valor('S',$(this).attr('name'));//obtener el id del modulo padre que poseen los check de submodulos concatenados en su name
										var submoduloId=$(this).attr('data-submoduloId');//id del submodulo consultado	
										
										if (($('#'+name).prop('checked')==false)&&(moduloPadre_id==modulo_id))//si el check de modulos se deshabilita , la variable valor reflija el valor inicial del check de modulos

										{
											
											if ($(this).prop("checked")==true)//desactiva los submodulos activos relacionados con el modulo seleccionado
												{
													$(this).prop("checked",false);//se desativa
													$(this).val(0);
													
												}

												checks_ac=checks_acciones ("targeta3",vista_acciones); //obtiene los checks de la vista de acciones
												actualizar_checks_acciones (checks_ac,submoduloId,0,vista_acciones);//actualiza el estado de los checks de acciones

																					}
										else if(($('#'+name).prop('checked')==true)&&(moduloPadre_id==modulo_id))//si el check de modulos se habilita
										{

											if ($(this).prop("checked")==false)//activa los check de los submodulos desactivados que estan relacionados con el modulo seleccionado
												{

													$(this).prop("checked",true);//se activa
													$(this).val(1);
												}


												checks_ac=checks_acciones ("targeta3",vista_acciones); //obtiene los checks de la vista de acciones
												actualizar_checks_acciones (checks_ac,submoduloId,1,vista_acciones);//actualiza el estado de los checks de acciones

											
										}
										
									
			    			}) 
				
							

						}
						

				}
				


			});


	});








$('#tpE').keypress(function(tecla)//insertar tipo de equipo
{
	if(tecla.which==13 && $(this).val().length>0)//al presionar enter
	{
		

	
		var datos=$(this).val();//descripcion del tipo de equipo
		$.get("/menu/registros/datos/consulta", {datos:datos}, function(data)
		{
			if(data)//si retorana datos desde el controlador 
			{

					if(data[0]==0 && data[2]==0)//el equipo fue agregado
					{
						swal({

								title:'El equipo fue creado con exito!!!.',//Contenido del modal
								text: '<p style="font-size: 1.5em;">'+'Solo debe insertar componentes para el'+'</p>',
								timer:2500,//Tiempo de retardo en ejecucion del modal
								type: "success",
								showConfirmButton:false,//Eliminar boton de confirmacion
								html:true
						});
					}
					else if(data[0]==1 && data[2]==0)
					{
						swal({

								title:'El equipo se encuentra creado!!!.',//Contenido del modal
								text: '<p style="font-size: 1.5em;">'+'Solo debe insertar componentes para el'+'</p>',
								timer:2500,//Tiempo de retardo en ejecucion del modal
								type: "error",
								showConfirmButton:false,//Eliminar boton de confirmacion
								html:true
						});
					}
				
					consultar_componentes();
			}
		else
		{
					swal({

								title:'ERROR INESPERADO!!!.',//Contenido del modal
								text: '<p style="font-size: 1.5em;">'+'Comuniquese con el administrador'+'</p>',
								timer:2500,//Tiempo de retardo en ejecucion del modal
								type: "error",
								showConfirmButton:false,//Eliminar boton de confirmacion
								html:true
						});
		}

		

		
			
		})	
	}
});
	




busqueda_dinamica();//realiza la busqueda dinamica
consultar_componentes();//muestra los componentes asociados a un equipo


	

