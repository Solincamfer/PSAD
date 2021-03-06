$(document).ready(function()
{
	////////////////////////////////////// Metodos comunes //////////////////////////////////////////////////////

	function loadModal(descripcion,id,padre)
	{

		/////////////////indicar al boton guardar del modal modificar el registro que se desea modificar //////////////////////////////
		$('#registro').val(id);
		/////////////////LLenar y desplegar modal///////////////////////////
		$('#descripcion').val(descripcion);
		$('#myModal4').modal('show');

		return 0;
	}



	//////////////////////////////////////Funcion boton: modificar llena el modal con los datos del registro que se desea modificar/////////////////////////////////////////////////////
	$('.Modificar').click(function()
	{
		$('#modificarPieza').data('bootstrapValidator').resetForm();
    	var tabla=$('#areaResultados').data('tabla');
	  	var registry=$(this).attr('data-reg');
	  	var _token=$( "input[name^='_token']" ).val();
	  	var route='/menu/registros/datos/modificar';
	  	$.post(route,{_token:_token,registry:registry,tabla:tabla})
	  .done(function(answer)
	  	{
      
	  	loadModal(answer.descripcion,answer.id);
	  	})

	  .fail(function()
		{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});

	});

  //////////////////////////////////////// Eliminar Registro ///////////////////////////////////////////////////////////////
  $('.Eliminar').click(function()
	{
	  var registry=$(this).attr('data-reg');
	  var _token=$( "input[name^='_token']" ).val();
	  var route='/menu/registros/datos/eliminar/pieza';
    swal({
      title: "Eliminar tipo de Pieza",
      text: "¿Desea eliminar la pieza seleccionada?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor:'#EE1919',
      confirmButtonText: 'Si, borrar pieza',
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
            
            if(answer[0]==1){
              swal({
                title:'Borrado exitoso',//Contenido del modal
                text: '<p style="font-size: 1.0em;">'+'La pieza fue borrada correctamente'+'</p>',
                type: "success",
                showConfirmButton:true,//Eliminar boton de confirmacion
                html: true
              },
              function(isConfirm)
              {
                if(isConfirm)
                {
                  window.location.href="/menu/registros/tipoequipo/componentes/piezas/"+answer[1].ncomponente_id;
                }
              });
            }
			else if(answer[0]==0){
							swal({
                title:'No se puede realizar la acción',//Contenido del modal
                text: '<p style="font-size: 1.0em;">'+'La pieza seleccionada esta asociada con al menos un equipo, para continuar debe cambiar esta asociación'+'</p>',
                type: "error",
                //showConfirmButton:true,//Eliminar boton de confirmacion
                html: true
              });
			}
			})
          .fail(function()
            { swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
        }
        else
        {

           swal("Eliminación cancelada !!", "No se borro el tipo de equipo selecconado", "error");
        }
    });

	});

 //////////////////////////////////////Funcion asociar marcas al tipo de equipo/////////////////////////////////////////////////////

	$('.Marca').click(function()
	{
		$('.marcaP').remove();
		$('.modelosP').remove();
		var registry=$(this).attr('data-reg');
		var piezaPadre=$('#_piezaMarca_').val(registry);
		$('#piezaPadre_').val(registry);
		$('#registry').val(registry);
		var padreTipo= $('#padreTipo').val();
		var _token=$( "input[name^='_token']" ).val();
		var route='/menu/registros/datos/mostrarmarcas/piezas';
		$.post(route,{_token:_token,registry:registry,padreTipo})
		.done(function(answer)
		{
			
			$.each(answer,function(key, registro) {
				$("#marcaP").append('<option class="marcaP" value='+registro.id+'>'+registro.descripcion+'</option>');
			});
			$('#myModal1').modal('show');
		})

		.fail(function()
		{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
	});


///////////////////////////////////////Funcion asociar los modelos a pieza y marca seleccionada//////////////////////

$('#marcaP').on('change',function()
	{
		$('.modelosP').remove();
		var registro=$('#registry').val();
		$('#piezaMod_').val(registro);//pieza

		var valor=$(this).val();
		$('#marcaMod_').val(valor);

		var _token=$( "input[name^='_token']" ).val();

		var route='/menu/registros/datos/mostrarmodelos/piezas';
		$.post(route,{_token:_token,registro:registro,valor:valor})
		.done(function(answer)
		{
			
			$.each(answer,function(key, registro) {
			$("#modelosP").append('<option class="modelosP" value='+registro.id+'>'+registro.descripcion+'</option>');
			});
		})

		.fail(function()
		{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
	});
//////////////////////////////////////Funcion asociar modelos al tipo de equipo/////////////////////////////////////////////////////

	$('#marca').on("change",function()
	{
		$('.modelos').remove();
		
		var registro=$('#registry').val();
		
		var valor = $("#marca option:selected").val();
		$('#marcaPadre').val(valor);
		var _token=$( "input[name^='_token']" ).val();
		var route='/menu/registros/datos/mostrarmodelos/componente';
		$.post(route,{_token:_token,registro:registro,valor:valor})
		.done(function(answer)
		{
			
			$.each(answer,function(key, registro) {
			$("#modelo").append('<option class="modelos" value='+registro.id+'>'+registro.descripcion+'</option>');
			});
		})

		.fail(function()
		{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
	});




//////////////////////////////////////funcion para mostrar agregar marca y modal para modelo /////////////////////////////////////
	$('#plusMarcaP').on("click",function()
	{
		$('#myModal2').modal('show');
	});

	$('#plusModeloP').on("click",function()
	{
		var marca=$('#marcaP').val();
		if(marca!=''){
			
			$('#myModal3').modal('show');
		}
		else{
			{swal("Campo Vacio!!", "Debe seleccionar una marca", "warning");};
		}

	});

///////////////////////////////////////Funcion para eliminar modelos de la pieza seleccionada/////////////////////////////////////////////
$('#minusModeloP').on("click",function()
	{
		var pieza=$('#registry').val();
		var marca=$("#marcaP option:selected").val();	
		var modelo=$('#modelosP option:selected').val();

		if(modelo=='' || marca==''){
			swal({
                title:'Campo Vacio',//Contenido del modal
                text: '<p style="font-size: 1.0em;">'+'Debe seleccionar el modelo para borrar'+'</p>',
                type: "warning",
                //showConfirmButton:true,//Eliminar boton de confirmacion
                html: true
			});
		 }
		else{
			swal({
		      title: "Eliminar Modelo",
		      text: "¿Seguro que quiere borrar el modelo seleccionado para la pieza seleccionada?",
		      type: "warning",
		      showCancelButton: true,
		      confirmButtonColor:'#EE1919',
		      confirmButtonText: 'Si, borrar el modelo',
		      cancelButtonText: "Cancelar",
		      closeOnConfirm: false,
		      closeOnCancel: false
		     },
		     function(isConfirm){
		        if(isConfirm){

					var _token=$( "input[name^='_token']" ).val();
					var route='/menu/registros/datos/borrarmodelopieza';
					$.post(route,{_token:_token,pieza:pieza,marca:marca,modelo:modelo})
		          	.done(function(answer){
						
			            if(answer[0]==1) {
			              	swal({
				                title:'Borrado exitoso',//Contenido del modal
				                text: '<p style="font-size: 1.0em;">'+'El modelo fue borrado correctamente'+'</p>',
				                type: "success",
				                showConfirmButton:true,//Eliminar boton de confirmacion
				                html: true
				            	},
											function(isConfirm){
				                if(isConfirm)
				                {
				                	$('.modelosP').remove();
				                 $.each(answer[1],function(key, registro) {
									 $("#modelosP").append('<option class="modelosP" value='+registro.id+'>'+registro.descripcion+'</option>');
								 });
				                }
											});
			            }
						else if (answer[0]==0) {
							swal({
			                title:'No se puede realizar la acción',//Contenido del modal
			                text: '<p style="font-size: 1.0em;">'+'El modelo seleccionado para la pieza, esta asociado con al menos un equipo, para continuar debe cambiar esta asociación'+'</p>',
			                type: "error",
			                //showConfirmButton:true,//Eliminar boton de confirmacion
			                html: true
							});
						}
					})
		          	.fail(function(){
		          		swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
		          	});
		        }
		        else
		        {

		           swal("Eliminación cancelada !!", "No se borro el modelo seleccionado", "error");
		        }
	    	});
		}
	});
///////////////////////////////////////Funcion para eliminar marcas de una pieza ///////////////////////////////////////////////////////////////////
$('#minusMarcaP').on("click",function()
	{
		var pieza=$('#registry').val();//obtiene la pieza asociada a la marca
		var marca =$("#marcaP option:selected").val();	
		
		if(marca==''){
			swal({
                title:'Campo Vacio',//Contenido del modal
                text: '<p style="font-size: 1.0em;">'+'Debe seleccionar una marca para borrar'+'</p>',
                type: "warning",
                //showConfirmButton:true,//Eliminar boton de confirmacion
                html: true
			});
		}
		else{
			swal({
		      title: "Eliminar Marca",
		      text: "Al borrar una marca para esta pieza, borrara los modelos asociados ¿Desea Continuar?",
		      type: "warning",
		      showCancelButton: true,
		      confirmButtonColor:'#EE1919',
		      confirmButtonText: 'Si, borrar la marca',
		      cancelButtonText: "Cancelar",
		      closeOnConfirm: false,
		      closeOnCancel: false
		     },
		     function(isConfirm){
		        if(isConfirm){
					var _token=$( "input[name^='_token']" ).val();
					var route='/menu/registros/datos/borrarmarcapieza';
					$.ajax({
				          url: route,
				          type: "post",
				          dataType: "json",//retorno JSON
				          data: {_token:_token,pieza:pieza,marca:marca}
			        })
		          	.done(function(answer)
		          	{
							
				            if(answer[0]==1) 
				            {

				              	swal({
						                title:'Borrado exitoso',//Contenido del modal
						                text: '<p style="font-size: 1.0em;">'+'La marca y sus modelos fueron borrados correctamente'+'</p>',
						                type: "success",
						                showConfirmButton:true,//Eliminar boton de confirmacion
						                html: true
					            	},
									function(isConfirm)
									{
						                if(isConfirm)
						                {
						                	$('.marcaP').remove();
						                	$('.modelosP').remove();
						                    $.each(answer[1],function(key, registro) 
						                    {
												$("#marcaP").append('<option class="marcaP" value='+registro.id+'>'+registro.descripcion+'</option>');
										    });
						                }
									});
				            }
							else if (answer[0]==0)
							 {
								swal({
									    title:'No se puede realizar la acción',//Contenido del modal
									    text: '<p style="font-size: 1.0em;">'+'Existe al menos un componente con esta marca asignada, cambie esta asociacion para poder borrarla'+'</p>',
									     type: "error",
				                //showConfirmButton:true,//Eliminar boton de confirmacion
				                		html: true
				             		 });
							}
					})
		          	.fail(function(){
		          		swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
		          	});
		        }
		        else
		        {
		           swal("Eliminación cancelada !!", "No se borro La marca seleccionada", "error");
		        }
	    	});
		}
	});
////////////////////////////////////// Funcion mostrar modal agregar marca y modal para modelo /////////////////////////////////////////////////////

	


	$('#plusMarca').on("click",function()
	{
		var tipo =$('#marcaModelo #registry').val();
		$('#padreMarca').val(tipo);
		$('#myModal2').modal('show');
	});

	$('#plusModelo').on("click",function()
	{
		var marca=$('#marca').val();
		if(marca!=''){
			var tipo =$('#marcaModelo #registry').val();
			var selectMarca= $("#marca option:selected").val();
			$('#padreModelo').val(tipo);
			$('#marcaPadre').val(selectMarca)
			$('#myModal3').modal('show');
		}
		else{
			{swal("Campo Vacio!!", "Debe seleccionar una marca", "warning");};
		}

	});


	//////////////////////////////////////   Funcion borrar marcas del tipo de componente    /////////////////////////////////////////////////////

	$('#minusMarca').on("click",function()
	{
		var padreTipo=$('#padreTipo').val();
		var valor = $("#marca option:selected").val();	
		var registro=$('#registry').val();
		if(valor==''){
			swal({
                title:'Campo Vacio',//Contenido del modal
                text: '<p style="font-size: 1.0em;">'+'Debe seleccionar una marca para borrar'+'</p>',
                type: "warning",
                //showConfirmButton:true,//Eliminar boton de confirmacion
                html: true
			});
		}
		else{
			swal({
		      title: "Eliminar Marca",
		      text: "Al borrar una marca para este tipo de componente, borrara los modelos asociados ¿Desea Continuar?",
		      type: "warning",
		      showCancelButton: true,
		      confirmButtonColor:'#EE1919',
		      confirmButtonText: 'Si, borrar la marca',
		      cancelButtonText: "Cancelar",
		      closeOnConfirm: false,
		      closeOnCancel: false
		     },
		     function(isConfirm){
		        if(isConfirm){
					var _token=$( "input[name^='_token']" ).val();
					var route='/menu/registros/datos/borrarmarcacomponente';
					$.ajax({
				          url: route,
				          type: "post",
				          dataType: "json",
				          data: {_token:_token,registro:registro,valor:valor,padreTipo:padreTipo}
			        })
		          	.done(function(answer){
						
			            if(answer[0]==1) {
			              	swal({
				                title:'Borrado exitoso',//Contenido del modal
				                text: '<p style="font-size: 1.0em;">'+'La marca y sus modelos fueron borrados correctamente'+'</p>',
				                type: "success",
				                showConfirmButton:true,//Eliminar boton de confirmacion
				                html: true
				            	},
											function(isConfirm){
				                if(isConfirm)
				                {
				                	$('.marcas').remove();
				                	$('.modelos').remove();
				                 $.each(answer[1],function(key, registro) {
													 $("#marca").append('<option class="marcas" value='+registro.id+'>'+registro.descripcion+'</option>');
												 });
				                }
											});
			            }
									else if (answer[0]==0) {
										swal({
			                title:'No se puede realizar la acción',//Contenido del modal
			                text: '<p style="font-size: 1.0em;">'+'Existe al menos un componente con esta marca asignada, cambie esta asociacion para poder borrarla'+'</p>',
			                type: "error",
			                //showConfirmButton:true,//Eliminar boton de confirmacion
			                html: true
			              });
									}
								})
		          	.fail(function(){
		          		swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
		          	});
		        }
		        else
		        {
		           swal("Eliminación cancelada !!", "No se borro La marca seleccionada", "error");
		        }
	    	});
		}
	});
	//////////////////////////////////////   Funcion borrar modelos del componente    /////////////////////////////////////////////////////

	$('#minusModelo').on("click",function()
	{
		var padreTipo=$('#padreTipo').val();
		var marca = $("#marca option:selected").val();
		var modelo = $("#modelo option:selected").val();
		var registro=$('#registry').val();
		if(modelo=='' || marca==''){
			swal({
                title:'Campo Vacio',//Contenido del modal
                text: '<p style="font-size: 1.0em;">'+'Debe seleccionar el modelo para borrar'+'</p>',
                type: "warning",
                //showConfirmButton:true,//Eliminar boton de confirmacion
                html: true
			});
		}
		else{
			swal({
		      title: "Eliminar Modelo",
		      text: "¿Seguro que quiere borrar el modelo seleccionado para este tipo de componente?",
		      type: "warning",
		      showCancelButton: true,
		      confirmButtonColor:'#EE1919',
		      confirmButtonText: 'Si, borrar el modelo',
		      cancelButtonText: "Cancelar",
		      closeOnConfirm: false,
		      closeOnCancel: false
		     },
		     function(isConfirm){
		        if(isConfirm){

					var _token=$( "input[name^='_token']" ).val();
					var route='/menu/registros/datos/borrarmodelocomponente';
					$.post(route,{_token:_token,registro:registro,modelo:modelo,marca:marca,padreTipo:padreTipo})
		          	.done(function(answer){
						
			            if(answer[0]==1) {
			              	swal({
				                title:'Borrado exitoso',//Contenido del modal
				                text: '<p style="font-size: 1.0em;">'+'El modelo fue borrado correctamente'+'</p>',
				                type: "success",
				                showConfirmButton:true,//Eliminar boton de confirmacion
				                html: true
				            	},
											function(isConfirm){
				                if(isConfirm)
				                {
				                	$('.modelos').remove();
				                 $.each(answer[1],function(key, registro) {
									 $("#modelo").append('<option class="modelos" value='+registro.id+'>'+registro.descripcion+'</option>');
								 });
				                }
											});
			            }
						else if (answer[0]==0) {
							swal({
			                title:'No se puede realizar la acción',//Contenido del modal
			                text: '<p style="font-size: 1.0em;">'+'El modelo seleccionado para este componente esta asociado con al menos un equipo, para continuar debe cambiar esta asociación'+'</p>',
			                type: "error",
			                //showConfirmButton:true,//Eliminar boton de confirmacion
			                html: true
							});
						}
					})
		          	.fail(function(){
		          		swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
		          	});
		        }
		        else
		        {

		           swal("Eliminación cancelada !!", "No se borro el modelo seleccionado", "error");
		        }
	    	});
		}
	});
	//////////////////////////////////////////////////Funcion Agregar Componente //////////////////////////////////

	 $('#newPieza').bootstrapValidator({
		 	excluded: [':disabled'],
			 fields: {
		     descripcionPieza: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar el nombre de la Pieza'
		         }
		       }
		     }
		   }
        }).on('success.form.bv',function(e){
	  		e.preventDefault();
				var formulario=$('#newPieza').serialize();
				var route='/menu/registros/agregar/pieza';
				$.post(route,formulario)
		  		.done(function(answer){
						
						if(answer[0]==1){
							 swal({
									title:'Guardado exitoso',//Contenido del modal
									text: '<p style="font-size: 1.0em;">'+'La pieza se guardo correctamente'+'</p>',
									type: "success",
									showConfirmButton:true,//Eliminar boton de confirmacion
									html: true
								},
		  				 	function(isConfirm){
		  				 		if(isConfirm){
		  				 			window.location.href="/menu/registros/tipoequipo/componentes/piezas/"+answer[1].id;
		  				 		}
		  				 	});
						}
						else{
							$('#newPieza').data('bootstrapValidator').resetForm();
							swal({
								title:'No se puede realizar la acción',//Contenido del modal
								text: '<p style="font-size: 1.0em;">'+'La pieza ya existe para el Componente '+answer[1].descripcion+'</p>',
								type: "warning",
								//showConfirmButton:true,//Eliminar boton de confirmacion
								html: true
							});
						}
		 			})
		  		.fail(function()
					{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
    });


	////////////////////////////////////// Funcion modificar tipo Componente ///////////////////////////////////////////////////

	$('#modificarPieza').bootstrapValidator({
		excluded: [':disabled'],
		 fields: {
			 descripcion: {
				 validators: {
					 notEmpty: {
						 message: 'Debe indicar el nombre de la  Pieza'
					 }
				 }
			 }
		 }
			 }).on('success.form.bv',function(e,data){
			e.preventDefault();
			var formulario=$('#modificarPieza').serialize();
			var route='/menu/registros/modificar/pieza';
			$.post(route,formulario)
				.done(function(answer){
					
				if(answer[0]==1){
						 swal({
								title:'Actualización Exitosa',//Contenido del modal
								text: '<p style="font-size: 1.0em;">'+'La pieza se modifico correctamente'+'</p>',
								type: "success",
								showConfirmButton:true,//Eliminar boton de confirmacion
								html: true
							},
							function(isConfirm){
								if(isConfirm){
									window.location.href="/menu/registros/tipoequipo/componentes/piezas/"+answer[1].id;
								}
							});
					}
					else if(answer[0]==2){
						$('#modificarPieza').data('bootstrapValidator').resetForm();
						swal({
							title:'No se puede realizar la acción',//Contenido del modal
							text: '<p style="font-size: 1.0em;">'+'La pieza ya existe para el tipo de componente '+answer[1].descripcion+'</p>',
							type: "warning",
							//showConfirmButton:true,//Eliminar boton de confirmacion
							html: true
						});
					}
					else{
						$('#modificarPieza').data('bootstrapValidator').resetForm();
						swal({
							title:'No se puede realizar la acción',//Contenido del modal
							text: '<p style="font-size: 1.0em;">'+'La pieza seleccionada esta asociada con al menos un equipo, para continuar debe cambiar esta asociación'+'</p>',
							type: "warning",
							//showConfirmButton:true,//Eliminar boton de confirmacion
							html: true
						});
					}
				})
				.fail(function()
				{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
	 });

	 
	////////////////////////////////////////////////////Funcion Agregar Modelo Pieza////////////////////////
	 $('#newModeloP').bootstrapValidator({
 		 	excluded: [':disabled'],
 			 fields: {
 		     descripcionModeloP: {
 		       validators: {
 		         notEmpty: {
 		           message: 'Debe indicar el nombre del modelo'
 		         }
 		       }
 		     }
 		   }
         }).on('success.form.bv',function(e,data){
 	  		e.preventDefault();
 				var formulario=$('#newModeloP').serialize();
 				var route='/menu/registros/agregar/modelo/piezas';
 				$.post(route,formulario)
 		  		.done(function(answer){
 						if(answer[0]==1){
 							 swal({
 									title:'Guardado exitoso',//Contenido del modal
 									text: '<p style="font-size: 1.0em;">'+'El modelo se guardo correctamente'+'</p>',
 									type: "success",
 									showConfirmButton:true,//Eliminar boton de confirmacion
 									html: true
 								},
 		  				 	function(isConfirm){
 		  				 		if(isConfirm){
 		  				 				$('.modelosP').remove();
				                 		$.each(answer[1],function(key, registro) {
											 $("#modelosP").append('<option class="modelosP" value='+registro.id+'>'+registro.descripcion+'</option>');
										 });
 		  				 				$('#descripcionModeloP').val('');
										$('#newModeloP').data('bootstrapValidator').resetForm();
 		  				 		}
 		  				 	});
 						}
 						else{
 							$('#newModeloP').data('bootstrapValidator').resetForm();
 							swal({
 								title:'No se puede realizar la acción',//Contenido del modal
 								text: '<p style="font-size: 1.0em;">'+'El modelo ya existe para este tipo de componente'+'</p>',
 								type: "warning",
 								//showConfirmButton:true,//Eliminar boton de confirmacion
 								html: true
 							});
 						}
 		 			})
 		  		.fail(function()
 					{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
     });


	
	///////////////////////////////////////////////////Funcion Agregar Marca Pieza//////////////////////////////////
	  $('#newMarcaP').bootstrapValidator({
 		 	excluded: [':disabled'],
 			 fields: {
 		     descripcionMarcaP: {
 		       validators: {
 		         notEmpty: {
 		           message: 'Debe indicar el nombre de la marca'
 		         }
 		       }
 		     }
 		   }
         }).on('success.form.bv',function(e,data){
 	  		e.preventDefault();
 	  			$('#_piezaMarca_').val($('#registry').val());
 				var formulario=$('#newMarcaP').serialize();
 				var route='/menu/registros/agregar/marca/pieza';
 				$.post(route,formulario)
 		  		.done(function(answer){
 		  				
 						if(answer[0]==1){
 							 swal({
 									title:'Guardado exitoso',//Contenido del modal
 									text: '<p style="font-size: 1.0em;">'+'La marca se guardo correctamente'+'</p>',
 									type: "success",
 									showConfirmButton:true,//Eliminar boton de confirmacion
 									html: true
 								},
 		  				 	function(isConfirm){
 		  				 		if(isConfirm){
 		  				 				$('.marcaP').remove();
				                 		$.each(answer[1],function(key, registro) {
											 $("#marcaP").append('<option class="marcaP" value='+registro.id+'>'+registro.descripcion+'</option>');
										 });
 		  				 				$('#descripcionMarcaP').val('');
										$('#newMarcaP').data('bootstrapValidator').resetForm();
 		  				 		}
 		  				 	});
 						}
 						else{
 							$('#newMarcaP').data('bootstrapValidator').resetForm();
 							swal({
 								title:'No se puede realizar la acción',//Contenido del modal
 								text: '<p style="font-size: 1.0em;">'+'La marca ya existe para la pieza seleccionada'+'</p>',
 								type: "warning",
 								//showConfirmButton:true,//Eliminar boton de confirmacion
 								html: true
 							});
 						}
 		 			})
 		  		.fail(function()
 					{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
     });
	 //////////////////////////////////////////////////Funcion Agregar Marca Componente //////////////////////////////////

	  $('#newMarca').bootstrapValidator({
 		 	excluded: [':disabled'],
 			 fields: {
 		     descripcionMarca: {
 		       validators: {
 		         notEmpty: {
 		           message: 'Debe indicar el nombre de la marca'
 		         }
 		       }
 		     }
 		   }
         }).on('success.form.bv',function(e,data){
 	  		e.preventDefault();
 				var formulario=$('#newMarca').serialize();
 				var route='/menu/registros/agregar/marca/componente';
 				$.post(route,formulario)
 		  		.done(function(answer){
 		  				
 						if(answer[0]==1){
 							 swal({
 									title:'Guardado exitoso',//Contenido del modal
 									text: '<p style="font-size: 1.0em;">'+'La marca se guardo correctamente'+'</p>',
 									type: "success",
 									showConfirmButton:true,//Eliminar boton de confirmacion
 									html: true
 								},
 		  				 	function(isConfirm){
 		  				 		if(isConfirm){
 		  				 				$('.marcas').remove();
				                 		$.each(answer[1],function(key, registro) {
											 $("#marca").append('<option class="marcas" value='+registro.id+'>'+registro.descripcion+'</option>');
										 });
 		  				 				$('#descripcionMarca').val('');
										$('#newMarca').data('bootstrapValidator').resetForm();
 		  				 		}
 		  				 	});
 						}
 						else{
 							$('#newMarca').data('bootstrapValidator').resetForm();
 							swal({
 								title:'No se puede realizar la acción',//Contenido del modal
 								text: '<p style="font-size: 1.0em;">'+'La marca ya existe para este tipo de componente'+'</p>',
 								type: "warning",
 								//showConfirmButton:true,//Eliminar boton de confirmacion
 								html: true
 							});
 						}
 		 			})
 		  		.fail(function()
 					{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
     });

   //////////////////////////////////////////////////Funcion Agregar Modelo Tipo de equipo //////////////////////////////////

	  $('#newModelo').bootstrapValidator({
 		 	excluded: [':disabled'],
 			 fields: {
 		     descripcionModelo: {
 		       validators: {
 		         notEmpty: {
 		           message: 'Debe indicar el nombre del modelo'
 		         }
 		       }
 		     }
 		   }
         }).on('success.form.bv',function(e,data){
 	  		e.preventDefault();
 				var formulario=$('#newModelo').serialize();
 				var route='/menu/registros/agregar/modelo/componente';
 				$.post(route,formulario)
 		  		.done(function(answer){
 		  				
 						if(answer[0]==1){
 							 swal({
 									title:'Guardado exitoso',//Contenido del modal
 									text: '<p style="font-size: 1.0em;">'+'El modelo se guardo correctamente'+'</p>',
 									type: "success",
 									showConfirmButton:true,//Eliminar boton de confirmacion
 									html: true
 								},
 		  				 	function(isConfirm){
 		  				 		if(isConfirm){
 		  				 				$('.modelos').remove();
				                 		$.each(answer[1],function(key, registro) {
											 $("#modelo").append('<option class="modelos" value='+registro.id+'>'+registro.descripcion+'</option>');
										 });
 		  				 				$('#descripcionModelo').val('');
										$('#newModelo').data('bootstrapValidator').resetForm();
 		  				 		}
 		  				 	});
 						}
 						else{
 							$('#newModelo').data('bootstrapValidator').resetForm();
 							swal({
 								title:'No se puede realizar la acción',//Contenido del modal
 								text: '<p style="font-size: 1.0em;">'+'El modelo ya existe para este tipo de componente'+'</p>',
 								type: "warning",
 								//showConfirmButton:true,//Eliminar boton de confirmacion
 								html: true
 							});
 						}
 		 			})
 		  		.fail(function()
 					{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
     });
});
