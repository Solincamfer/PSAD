$(document).ready(function() 
{
	////////////////////////////////////// Metodos comunes //////////////////////////////////////////////////////

	function loadModal(descripcion,status,id)
	{
		
		/////////////////indicar al boton guardar del modal modificar el registro que se desea modificar //////////////////////////////
		$('#perfilRegistry').val(id);

		/////////////////LLenar y desplegar modal///////////////////////////
		$('#perText').val(descripcion);
		$('#perStatus').val(status);
		$('#myModal2').modal('show');

		return 0;
	}

	////////////////////////////////////// Eliminar perfil/////////////////////////////////////////////////
	$('._eliminarPer_').click(function()
{
			var registry=$(this).data('reg');
			var route='/menu/registros/clientes/eliminar/perfiles';
			var _token=$( "input[name^='_token']" ).val();
			var sucursal=$('#_sucursal_id_').val();

				swal({
							title: "Eliminar Perfil",
							text: "Al eliminar el perfil seleccionado, se eliminaran sus permisos asociados. ¿Desea eliminar el perfil?",
							type: "warning",
							showCancelButton: true,
							confirmButtonColor:'#EE1919',
							confirmButtonText:'Eliminar Perfil',
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
								  				 	window.location.href='/menu/registros/perfiles/';
								  				 }	

								  			});
										

									}
									else if(answer.codigo==2)
									{
										swal({
												title:'Imposible eliminar el perfil',//Contenido del modal
												text: '<p style="font-size: 1.0em;">'+answer.extra+'</p>',
												type: "warning",
												showConfirmButton:true,//Eliminar boton de confirmacion
												html: true
											});
									}
									else
										{
											 swal("No se elimino el perfil!!!", "", "error");
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

	//////////////////////////////////////Funcion boton: modificar llena el modal con los datos del registro que se desea modificar/////////////////////////////////////////////////////
	$('.ModificarPerfil').click(function() 
	{
	  var registry=$(this).attr('data-reg');
	  var _token=$( "input[name^='_token']" ).val();
	  var route='/menu/registros/perfiles/modificar';

	  $.post(route,{_token:_token,registry:registry})
	  .done(function(answer)
	  {
	  	loadModal(answer.descripcion,answer.status,answer.id);
	  })

	  .fail(function()
		{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});

	});


	//////////////////////////////////////////////////Funcion boton : guardar/modificar //////////////////////////////////
   $('#forActPerf').bootstrapValidator({
		   fields: {
		     Descripcion: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar el nombre del nuevo perfil'
		         }
		       }
		     },
		     Status: {
		       validators: {
		         notEmpty: {
		           message: 'Debe seleccionar un estatus para el nuevo perfil'
		         }
		       }
		     }
		   }
        }).on('success.form.bv',function(e,data){
	  		e.preventDefault();
			var $form = $(e.target);               
            var bv    = $form.data('bootstrapValidator');
			var formulario=$('#forActPerf').serialize();
			var route='/menu/registros/perfiles/actualizar';
			$.post(route,formulario)
		  		.done(function(answer)
		  			{
		  				 
		  				 if(answer.duplicate==2 && answer.update==false)
		  				 {
		  				 	swal("El perfil existe en el sistema !!", "No puede crear perfiles con el mismo nombre", "warning");
		  				 	
		  				 }
		  				 else if(answer.duplicate==0 && answer.update==false)
		  				 {
		  				 	$('#myModal2').modal('hide');
		  				 }
		  				 else if (answer.duplicate==1 && answer.update==true)
		  				 {
		  				 	
		  				 	swal({
									title:'Actualizacion exitosa',//Contenido del modal
									text: '<p style="font-size: 1.0em;">'+'El perfil se modifico correctamente'+'</p>',
									type: "success",
									showConfirmButton:true,//Eliminar boton de confirmacion
									html: true
								},
		  				 	function(isConfirm)
		  				 	{
		  				 		if(isConfirm)
		  				 		{
		  				 			window.location.href="/menu/registros/perfiles";
		  				 		}	

		  				 	});

		  				 }

		 			})

		  		.fail(function()
					{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
    });


	//////////////////////////////////////Funcion boton:  Agregar perfil ///////////////////////////////////////////////////

		$('#NewPerfil').bootstrapValidator({
		   fields: {
		     DescripcionAdd: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar el nombre del nuevo perfil'
		         }
		       }
		     },
		     StatusAdd: {
		       validators: {
		         notEmpty: {
		           message: 'Debe seleccionar un estatus para el nuevo perfil'
		         }
		       }
		     }
		   }
        }).on('success.form.bv',function(e){
      		e.preventDefault();
      		var form=$('#NewPerfil').serialize();
				var route='/menu/registros/perfiles/registrar';

				$.post(route,form)
				.done(function(answer)
					{
						
						if(answer.duplicate>0 && answer.insert==false)
						{
							swal("El perfil existe en el sistema !!", "No puede crear perfiles con el mismo nombre", "warning");
						}
						else if(answer.duplicate==0 && answer.insert==true)
						{
							swal({
										title:'Guardado Exitoso',//Contenido del modal
										text: '<p style="font-size: 1.0em;">'+'El perfil se agrego correctamente'+'</p>',
										type: "success",
										showConfirmButton:true,//Eliminar boton de confirmacion
										html: true
								},
			  				 	function(isConfirm)
			  				 	{
			  				 		if(isConfirm)
			  				 		{
			  				 			window.location.href="/menu/registros/perfiles";
			  				 		}	

			  				 	});
						}
					})
				.fail(function()
					{
						swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
					});
      	});




		////////////////////////////////////Funcion Check Status /////////////////////////////////////////////////////

		$('.checkPerfil').change(function()
		{
			///////////////////////////////Datos para el alert /////////////////////////////////
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
			var route='/menu/registros/perfiles/status';

			swal({
				title: "Cambio de status",
				text: "¿Desea "+acciones[valor]+" El perfil seleccionado ?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor:colores[valor],
				confirmButtonText: acciones[valor]+' Perfil',
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
								swal("Modificacion exitosa !!", "El perfil ha sido "+mensajes[valor]+" correctamente", "success");
								$('#'+actual.attr('id')).val(valores[valor]);

							}
						})
						.fail(function()
							{ swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
					}
					else
					{
						 
						 swal("Cambio de status cancelado !!", "No se modifico el status del perfil", "error");
						 actual.prop('checked',estados[valor]);
						 $('#'+actual.attr('id')).val(valor);
						 
					}
			});


		});

});