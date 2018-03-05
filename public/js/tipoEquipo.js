$(document).ready(function()
{
	////////////////////////////////////// Metodos comunes //////////////////////////////////////////////////////

	function loadModal(descripcion,id,padre)
	{

		/////////////////indicar al boton guardar del modal modificar el registro que se desea modificar //////////////////////////////
		$('#registro').val(id);
		/////////////////LLenar y desplegar modal///////////////////////////
		$('#descripcion').val(descripcion);
		$('#padre').val(padre);
		$('#myModal4').modal('show');

		return 0;
	}



	//////////////////////////////////////Funcion boton: modificar llena el modal con los datos del registro que se desea modificar/////////////////////////////////////////////////////
	$('.Modificar').click(function()
	{
		$('#modificarTipoEquipo').data('bootstrapValidator').resetForm();
    var tabla=$('#areaResultados').data('tabla');
	  var registry=$(this).attr('data-reg');
	  var _token=$( "input[name^='_token']" ).val();
	  var route='/menu/registros/datos/modificar';
    var padre;
	  $.post(route,{_token:_token,registry:registry,tabla:tabla})
	  .done(function(answer)
	  {
      //console.log(answer.id);
	  	loadModal(answer.descripcion,answer.id,padre="");
	  })

	  .fail(function()
		{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});

	});

  //////////////////////////////////////// Eliminar Registro ///////////////////////////////////////////////////////////////
  $('.Eliminar').click(function()
	{
	  var registry=$(this).attr('data-reg');
	  var _token=$( "input[name^='_token']" ).val();
	  var route='/menu/registros/datos/eliminar/tipoEquipo';
    swal({
      title: "Eliminar tipo de Equipo",
      text: "Al borrar un tipo de equipo, borrara los componentes y piezas asociados ¿Desea eliminar el tipo de equipo seleccionado?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor:'#EE1919',
      confirmButtonText: 'Si, borrar tipo de equipo',
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
            //console.log(answer);
            if(answer==1){
              swal({
                title:'Borrado exitoso',//Contenido del modal
                text: '<p style="font-size: 1.0em;">'+'El tipo de equipo fue borrado correctamente'+'</p>',
                type: "success",
                showConfirmButton:true,//Eliminar boton de confirmacion
                html: true
              },
              function(isConfirm)
              {
                if(isConfirm)
                {
                  window.location.href="/menu/registros/datos";
                }
              });
            }
						else if(answer==0){
							swal({
                title:'No se puede realizar la acción',//Contenido del modal
                text: '<p style="font-size: 1.0em;">'+'El tipo de equipo seleccionado esta asociado con al menos un equipo, para continuar debe cambiar esta asociación'+'</p>',
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
		$('.marcas').remove();
		$('.modelos').remove();
		var registry=$(this).attr('data-reg');
		$('#registry').val(registry);
		var _token=$( "input[name^='_token']" ).val();
		var route='/menu/registros/datos/mostrarmarcas';
		$.post(route,{_token:_token,registry:registry})
		.done(function(answer)
		{
			//console.log(answer);
			$.each(answer,function(key, registro) {
			$("#marca").append('<option class="marcas" value='+registro.id+'>'+registro.descripcion+'</option>');
			});
			$('#myModal1').modal('show');
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
		var _token=$( "input[name^='_token']" ).val();
		var route='/menu/registros/datos/mostrarmodelos';
		$.post(route,{_token:_token,registro:registro,valor:valor})
		.done(function(answer)
		{
			//console.log(answer);
			$.each(answer,function(key, registro) {
			$("#modelo").append('<option class="modelos" value='+registro.id+'>'+registro.descripcion+'</option>');
			});
		})

		.fail(function()
		{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
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
		$('#myModal3').modal('show');
	});


	//////////////////////////////////////   Funcion borrar marcas del tipo de equipo    /////////////////////////////////////////////////////

	$('#minusMarca').on("click",function()
	{
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
		      text: "Al borrar una marca para este tipo de equipo, borrara los modelos asociados ¿Desea Continuar?",
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
					var route='/menu/registros/datos/borrarMarcaTipoEquipo';
								$.ajax({
				          url: route,
				          type: "post",
				          dataType: "json",
				          data: {_token:_token,registro:registro,valor:valor}
				        })
		          	.done(function(answer){
						console.log(answer);
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
			                text: '<p style="font-size: 1.0em;">'+'Existe al menos un equipo con esta marca asignada, cambie esta asociacion para poder borrarla'+'</p>',
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
	//////////////////////////////////////   Funcion borrar modelos del tipo de equipo    /////////////////////////////////////////////////////

	$('#minusModelo').on("click",function()
	{
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
		      text: "¿Seguro que quiere borrar el modelo seleccionado para este tipo de equipo?",
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
					var route='/menu/registros/datos/borrarModeloTipoEquipo';
					$.post(route,{_token:_token,registro:registro,modelo:modelo,marca:marca})
		          	.done(function(answer){
									console.log(answer);
			            if(answer==1) {
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
				                 $.each(answer,function(key, registro) {
													 $("#modelo").append('<option class="modelos" value='+registro.id+'>'+registro.descripcion+'</option>');
												 });
				                }
											});
			            }
									else if (answer==0) {
										swal({
			                title:'No se puede realizar la acción',//Contenido del modal
			                text: '<p style="font-size: 1.0em;">'+'El modelo seleccionado para este tipo de equipo esta asociado con al menos un equipo, para continuar debe cambiar esta asociación'+'</p>',
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
	//////////////////////////////////////////////////Funcion Agregar Tipo de equipo //////////////////////////////////
   $('#newTipoEquipo').bootstrapValidator({
		 	excluded: [':disabled'],
			 fields: {
		     descripcionTipoEquipo: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar el nombre del tipo de equipo'
		         }
		       }
		     }
		   }
        }).on('success.form.bv',function(e,data){
	  		e.preventDefault();
				var formulario=$('#newTipoEquipo').serialize();
				var route='/menu/registros/agregar/tipoequipo';
				$.post(route,formulario)
		  		.done(function(answer){
						if(answer==1){
							 swal({
									title:'Guardado exitoso',//Contenido del modal
									text: '<p style="font-size: 1.0em;">'+'El tipo de equipo se guardo correctamente'+'</p>',
									type: "success",
									showConfirmButton:true,//Eliminar boton de confirmacion
									html: true
								},
		  				 	function(isConfirm){
		  				 		if(isConfirm){
		  				 			window.location.href="/menu/registros/datos";
		  				 		}
		  				 	});
						}
						else{
							$('#newTipoEquipo').data('bootstrapValidator').resetForm();
							swal({
								title:'No se puede realizar la acción',//Contenido del modal
								text: '<p style="font-size: 1.0em;">'+'El tipo de equipo ya existe'+'</p>',
								type: "error",
								//showConfirmButton:true,//Eliminar boton de confirmacion
								html: true
							});
						}
		 			})
		  		.fail(function()
					{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
    });


	//////////////////////////////////////Funcion modificar tipo de equipo///////////////////////////////////////////////////

	$('#modificarTipoEquipo').bootstrapValidator({
		excluded: [':disabled'],
		 fields: {
			 descripcion: {
				 validators: {
					 notEmpty: {
						 message: 'Debe indicar el nombre del tipo de equipo'
					 }
				 }
			 }
		 }
			 }).on('success.form.bv',function(e,data){
			e.preventDefault();
			var formulario=$('#modificarTipoEquipo').serialize();
			var route='/menu/registros/modificar/tipoequipo';
			$.post(route,formulario)
				.done(function(answer){
					if(answer==1){
						 swal({
								title:'Actualización Exitosa',//Contenido del modal
								text: '<p style="font-size: 1.0em;">'+'El tipo de equipo se modifico correctamente'+'</p>',
								type: "success",
								showConfirmButton:true,//Eliminar boton de confirmacion
								html: true
							},
							function(isConfirm){
								if(isConfirm){
									window.location.href="/menu/registros/datos";
								}
							});
					}
					else{
						$('#modificarTipoEquipo').data('bootstrapValidator').resetForm();
						swal({
							title:'No se puede realizar la acción',//Contenido del modal
							text: '<p style="font-size: 1.0em;">'+'El tipo de equipo ya existe'+'</p>',
							type: "error",
							//showConfirmButton:true,//Eliminar boton de confirmacion
							html: true
						});
					}
				})
				.fail(function()
				{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
	 });

	 //////////////////////////////////////////////////Funcion Agregar Marca Tipo de equipo //////////////////////////////////

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
 				var route='/menu/registros/agregar/marca/tipoequipo';
 				$.post(route,formulario)
 		  		.done(function(answer){
 		  				console.log(answer)
 						if(answer==1){
 							 swal({
 									title:'Guardado exitoso',//Contenido del modal
 									text: '<p style="font-size: 1.0em;">'+'La marca se guardo correctamente'+'</p>',
 									type: "success",
 									showConfirmButton:true,//Eliminar boton de confirmacion
 									html: true
 								},
 		  				 	function(isConfirm){
 		  				 		if(isConfirm){
 		  				 				$('#descripcionMarca').val('');
										$('#newMarca').data('bootstrapValidator').resetForm();
 		  				 		}
 		  				 	});
 						}
 						else{
 							$('#newMarca').data('bootstrapValidator').resetForm();
 							swal({
 								title:'No se puede realizar la acción',//Contenido del modal
 								text: '<p style="font-size: 1.0em;">'+'La marca ya existe para este tipo de equipo'+'</p>',
 								type: "error",
 								//showConfirmButton:true,//Eliminar boton de confirmacion
 								html: true
 							});
 						}
 		 			})
 		  		.fail(function()
 					{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
     });
});
