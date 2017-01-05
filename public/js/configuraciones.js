
var vista_submodulos=false;//true cuando la vista de submodulos esta activa
var vista_acciones=false;//true cuando la vista de acciones esta activa


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
			
				////////////// obtener registro a modificar ////////////////////
				var id=$(this).attr('id');//id del boton modificar seleccionado
				var longitud=id.length;//longitud del  id de modificar
				var indice=id.indexOf('S');//indice del ultimo caracter
				var registro=id.slice(indice+1,longitud);//numero del registro a modificar 
		    	////////////////////////////////////////////////////////////////////////
		    	var valor=$(this).val();//valor inicial del check
		    	$('#'+id).val(valores[valor]);//cambio de valor para el check, asignacion del nuevo valor
		    	////////////////////obtener valor del modulo padre///////////////////////////////////

		   		var modulo_id=$(this).attr('name');
		    	var longitud=id.length;
				var indice=id.indexOf('S');
				modulo_id=modulo_id.slice(indice+1,longitud);//id del mpodulo padre que posee el submodulo seleccionado 
				var name=$(this).attr('id');

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
							if (vista_submodulos==true) 
								{
									var modulos_=document.getElementById("targeta1");//obtener el listado de submodulos creados
									var input=modulos_.getElementsByTagName("input");//obtener elementos de la etiqueta input
									

									
									$.each(input, function(i) 
									{
										if($(this).attr('type')=="checkbox")
										{

											
											var moduloPadre_id=$(this).attr('name');
									    	var longitud=moduloPadre_id.length;
									    	var indice=moduloPadre_id.indexOf('k');
											moduloPadre_id=moduloPadre_id.slice(indice+1,longitud);//id del modulo padre
											
											if (modulo_id==moduloPadre_id) //si se activa el submodulo 
												{
													if (($('#'+name).prop('checked')==true)&&($(this).prop('checked')==false)) 
													{

														/*alert($(this).prop('checked'));//status del modulo padre
														alert($('#'+name).prop('checked'));//status del submodulo seleccionado//stattus */
														//alert('modulo padre desactivado');
														$(this).prop('checked',true);
														$(this).val(valores[$(this).val()]);//cambio de valor para el check


														///////////////////////////actualizar el modulo en la base de datos ////////////

														
														var id_registro= $(this).attr('id');
														var longitud=id_registro.length;
									    				var indice=id_registro.indexOf('M');
														id_registro=id_registro.slice(indice+1,longitud);//id del modulo padre
											
														var url="/menu/registros/perfiles/configurar/modulo_";
												
														$.get(url, {datos:id_registro}, function(configurar)
														{
																
															if(configurar==0)//si no recibe valores del controlador
															{
																
																swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
															}

														})
													}
												}

										}


									})
								}

						}
						


					});









			});
	      

        	


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