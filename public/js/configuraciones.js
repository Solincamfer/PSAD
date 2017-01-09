//////////////////////////////////////////////// variables globales /////////////////////////////////////////////

var vista_submodulos=false;//true cuando la vista de submodulos esta activa
var vista_acciones=false;//true cuando la vista de acciones esta activa

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////



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
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////






$(".consultarSubmodulo").click(function(){
				
				

				
				
		$(".consultarSubmodulo").css("color","grey");
		$(this).css("color","yellow");
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
			    
			    	$('#targeta2 ul').append('<li class="limpiarul1" style="display:none;"><div class="container-fluid cont"><div class="row"><div class="col-md-6"><div class="tl1"><span>'+item.descripcion+'</span></div></div><div class="col-md-1 col-md-push-2"><div class="iclst"><i class="fa fa-eye consultarAcciones" id="n'+item.submoduloId+'"></i></div><input type="hidden" id="Accionn'+item.submoduloId+'" value="'+item.submoduloId+'"></div><div class="col-md-2 col-md-push-3"><div class="chbx1x" id="checklist'+item.submoduloId+'"></div></div></div></div></li>');
			   
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
			    $(this).css("color","yellow");

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
						$('#targeta3 ul').append('<li class="limpiarul2" style="display:none;"><div class="container-fluid cont"><div class="row"><div class="col-md-6"><div class="tl1"><span>'+item.descripcion+'</span></div></div><div class="col-md-1 col-md-push-2"><div class="iclst"></div><input type="hidden" id="Accio2nn'+item.accionId+'" value="'+item.accionId+'"></div><div class="col-md-2 col-md-push-3"><div class="chbx1x" id="checklistA'+item.accionId+'">   </div></div></div></div></li>');
			    		 
			    		 if(item.Status==1)//agregar check de status cuando el submodulo esta asignado para el perfil
			  				 {
			  		 			$('#checklistA'+item.accionId).append(' <input type="checkbox" value="'+item.Status+'" class="configurarAcc" id="cckA'+item.registro+'" name="cckA'+item.padre+'" checked><label for="cckA'+item.registro+'"></label> ');
			   
			  				 }
			  			 else if(item.Status==0)//agregar check de status cuando el submodulo no esta signado para el perfil
			   				{
			   		  			$('#checklistA'+item.accionId).append(' <input type="checkbox" value="'+item.Status+'"  class="configurarAcc"  id="cckA'+item.registro+'" name="cckA'+item.padre+'" ><label for="cckA'+item.registro+'"></label> ');

			  				 }



			    		$( ".limpiarul2" ).each(function() {
				    $( this ).slideUp(0).delay(0).fadeIn(0);
				 });
			    	})  
				




				$('.configurarAcc').change(function()//configurar submodulos
			{
				var valores=[1,0];
			
				
				var registro=obtener_valor('A',$(this).attr('id'));
		    	////////////////////////////////////////////////////////////////////////
		    	var submoduloPadre=obtener_valor('A',$(this).attr('name'));
		    	////////////////////////////////////////////////////////////////////////
		    	var status=$(this).prop('checked');
		   		var url= '/menu/registros/perfiles/configurar/accion';//rutas[tabla];
				var datos=registro;//datos para el controlador (registro a modificar y tabla a modificar)*/
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
							if (acciones_activas==0 && status==false) {status_check=false;comparacion=true;alert('se desactivo la ultima accion')}//si se desactiva la ultima
							else if(acciones_activas==1 && status==true){status_check=true;comparacion=false;alert('se activo la primera accion')}//si se activa la primera
							
							var checks_sub=checks_acciones("targeta2",vista_submodulos);//obtiene los submodulos
							var submoduloId=false;
							var moduloPadre=false;
							var modulo=false;
							  $.each(checks_sub, function(i)
							  {
							  	submoduloId=$(this).attr('data-submoduloId');//id del submodulo
							  	if (submoduloPadre==submoduloId) //si se localiza el submodulo padre de la accion
							  		{	
							  			moduloPadre=obtener_valor('S',$(this).attr('name'));//id del modulo padre
							  			modulo=document.getElementsByName('cck'+moduloPadre);

							  			if ((status_check==false && $(this).prop('checked')==true)&&(acciones_activas==0))
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
							  		 			alert($(modulo).attr('id'));
							  		 			actualizar_status(obtener_valor('M',$(modulo).attr('id')),'/menu/registros/perfiles/configurar/modulo_');
							  		 		}

							  			}
							  			else if(status_check==true && $(this).prop('checked')==false)
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
							  		 			alert($(modulo).attr('id'));
							  		 			actualizar_status(obtener_valor('M',$(modulo).attr('id')),'/menu/registros/perfiles/configurar/modulo_');
							  		 		}

							  				//alert('debe activarse el submodulo: '+$(this).attr('data-submoduloId'));
							  				
							  			}
							  		}

							  })
					
						

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
						
						alert(configurar);
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
				alert(configurar);
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