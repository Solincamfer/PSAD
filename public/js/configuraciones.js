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


function actualizar_status (datos) //actualiza el status de un modulo en la base de datos
{
	
	var datos=datos;
	var url="/menu/registros/perfiles/configurar/modulo_";
	$.get(url, {datos:datos}, function(configurar)//va al contrololador para modificar status del modulo
	{
		if(configurar==0)//si no recibe valores del controlador
			{
																											
				swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
			}

	})
}

function cheks_activos(input__) //cuenta los checks de submodulos que se encuentran activos
{
	var contadorChekAct=0;
	$.each(input__,function(i)//recorre los inputs de la tarjeta de submodulos para buscar los checks
					
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
			  		 $('#checklist'+item.submoduloId).append(' <input type="checkbox" value="'+item.Status+'" class="configurarSub" id="cckS'+item.registro+'" name="cckS'+item.padre+'" checked><label for="cckS'+item.registro+'"></label> ');
			   
			   }
			   else if(item.Status==0)//agregar check de status cuando el submodulo no esta signado para el perfil
			   {
			   		  $('#checklist'+item.submoduloId).append(' <input type="checkbox" value="'+item.Status+'"  class="configurarSub"  id="cckS'+item.registro+'" name="cckS'+item.padre+'" ><label for="cckS'+item.registro+'"></label> ');

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
					$( ".limpiarul2" ).remove();
					$.each(data1, function(i, item) {
						$('#targeta3 ul').append('<li class="limpiarul2" style="display:none;"><div class="container-fluid cont"><div class="row"><div class="col-md-6"><div class="tl1"><span>'+item.descripcion+'</span></div></div><div class="col-md-1 col-md-push-2"><div class="iclst"></div><input type="hidden" id="Accio2nn'+item.accionId+'" value="'+item.accionId+'"></div><div class="col-md-2 col-md-push-3"><div class="chbx1x" id="checklistA'+item.accionId+'">   </div></div></div></div></li>');
			    		 
			    		 if(item.Status==1)//agregar check de status cuando el submodulo esta asignado para el perfil
			  				 {
			  		 			$('#checklistA'+item.accionId).append(' <input type="checkbox" value="'+item.Status+'" class="configurarAcc" id="cckA'+item.registro+'" name="cckA'+item.registro+'" checked><label for="cckA'+item.registro+'"></label> ');
			   
			  				 }
			  			 else if(item.Status==0)//agregar check de status cuando el submodulo no esta signado para el perfil
			   				{
			   		  			$('#checklistA'+item.accionId).append(' <input type="checkbox" value="'+item.Status+'"  class="configurarAcc"  id="cckA'+item.registro+'" name="cckA'+item.registro+'" ><label for="cckA'+item.registro+'"></label> ');

			  				 }



			    		$( ".limpiarul2" ).each(function() {
				    $( this ).slideUp(0).delay(0).fadeIn(0);
				 });
			    	})  
				




				$('.configurarAcc').change(function()//configurar submodulos
			{
				
			
				////////////// obtener registro a modificar ////////////////////
				var id=$(this).attr('id');//id del boton modificar seleccionado
				var longitud=id.length;//longitud del  id de modificar
				var indice=id.indexOf('A');//indice del ultimo caracter
				var registro=id.slice(indice+1,longitud);//numero del registro a modificar 
		    	////////////////////////////////////////////////////////////////////////
		    	

		   		var url= '/menu/registros/perfiles/configurar/accion';//rutas[tabla];
				var datos=registro;//datos para el controlador (registro a modificar y tabla a modificar)*/
				$.get(url, {datos:datos}, function(configurar)
					{
						
						if(configurar==0)
						{
							
							swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
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
				$.get(url, {datos:datos}, function(configurar)
					{
						
						if(configurar==0)//si no recibe valores del controlador
						{
							
							swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
						}
						else
						{
							if (vista_submodulos==true) //si la vista de submodulos se encuentra activa en la pantalla
								{
									var modulos_=document.getElementById("targeta1");//obtener el listado de los modulos creados
									var input=modulos_.getElementsByTagName("input");//obtener elementos que poseen la etiqueta input dentro de la tajeta de modulos
									var checks=[];

									
									$.each(input,function(i)//obtiene los  input  check de la tarjeta para modulos
									{

										if($(this).attr('type')=='checkbox')
										{
											checks.push($(this));//va llenando en arreglo de los cheks para los modulos
										}
									})

									
									
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
														actualizar_status(id_registro);

													}
													else if ((($('#'+name).prop('checked')==false)&&($(this).prop('checked')==true))&&(contadorChekAct==0)) //si se desactiva el ultimo submodulo perteneciente a un modulo y esta se encuentra activo
													{

														$(this).prop('checked',false);//se checkea el modulo padre
														$(this).val(valores[$(this).val()]);

														///////////////////////////actualizar el modulo en la base de datos ////////////
														
														var id_registro=obtener_valor('M',$(this).attr('id'));//id del registro que ocupa en la tabla modulo_perfil el cual se usa solo para actualizar en la base de datos el valor de status perteneciente al check de modulos
														actualizar_status(id_registro);
														

													}



												}

										//}

									})//fin del each)


								}//fin de validacion para saber si la vista de submodulos esta activa

						}//fin del else que se inicia si se regresan valores del metodo get
						


					});//fin del metodo get









			});//fin de la funcion de cnfigurar submodulos
	      

        	


	       });


	


		
			
});



$('.configurarPer').change(function()
	{
		
		var valores=[1,0];
		var estados=[true,false];

		////////////// obtener registro a modificar ////////////////////
		var id=$(this).attr('id');//id del boton modificar seleccionado
		var longitud=id.length;//longitud del  id de modificar
		var indice=id.indexOf('M');//indice del ultimo caracter
		var registro=id.slice(indice+1,longitud);//numero del registro a modificar 
    	////////////////////////////////////////////////////////////////////////

    	////////////////////////////obtener id del modulo///////////////////////

    	var modulo_id=$(this).attr('name');
    	var longitud=modulo_id.length;
    	var indice=modulo_id.indexOf('k')
		
		modulo_id=modulo_id.slice(indice+1,longitud);//id del modulo padre


        //////////////////////////////////////////////////////////////////////////


    	var valor=$(this).val();//valor inicial del check
    	$(this).val(valores[valor]);//cambio de valor para el check

   		var url= '/menu/registros/perfiles/configurar/modulo';//rutas[tabla];
		var datos=registro;//datos para el controlador (registro a modificar y tabla a modificar)*/
		$.get(url, {datos:datos}, function(configurar)
			{
				
				if(configurar==0)
				{
					
					swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
				}
				else
				{
					if (vista_submodulos==true) //si la vista de submodulos esta visible
						{

							
							var submodulos_=document.getElementById("targeta2");//obtener el listado de submodulos creados
							var input=submodulos_.getElementsByTagName("input");//obtener elementos de la etiqueta input
							

							
							$.each(input, function(i) 
							{
								
								
									

								if (($(this).attr("type")=="checkbox" )) //si esta activo se procede a desactivar
									{
											var moduloPadre_id=$(this).attr('name');
									    	var longitud=moduloPadre_id.length;
									    	var indice=moduloPadre_id.indexOf('S');
											
											moduloPadre_id=moduloPadre_id.slice(indice+1,longitud);//id del modulo padre
										
											
										if ((valor==1)&&(moduloPadre_id==modulo_id))

										{
											/*var nombre=document.getElementsByName("cck"+moduloPadre_id);
											alert($(nombre).attr('id'));//id del check padre*/
										
											if ($(this).prop("checked")==true)//si esta activo el check de submodulos
												{
													$(this).prop("checked",false);//se desativa
													$(this).val(0);
													//var name=$(this).attr("id");
													//$('#'+name).trigger('change');//dispara el evento change para los checks
												}
											
										}
										else if((valor==0)&&(moduloPadre_id==modulo_id))
										{

											/*var nombre=document.getElementsByName("cck"+moduloPadre_id);
											alert($(nombre).attr('id'));//id del check padre*/

											if ($(this).prop("checked")==false)
												{

													$(this).prop("checked",true);//se activa
													$(this).val(1);
												}
										}
										
									}
								
			    			}) 
				
							

						}
						

				}
				


			});


	});