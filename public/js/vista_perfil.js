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
   $('#actualizarPerfil').click(function()
    	{
    		
    		var formulario=$('#forActPerf').serialize();
    		var route='/menu/registros/perfiles/actualizar';



    		$.post(route,formulario)
		  		.done(function(answer)
		  			{
		  				 
		  				
		  				 if(answer.duplicate>0 && answer.update==false)
		  				 {
		  				 	swal("El perfil existe en el sistema !!", "No puede crear perfiles con el mismo nombre", "warning");
		  				 	
		  				 }
		  				 else if(answer.duplicate==0 && answer.update==false)
		  				 {
		  				 	swal("Actualizacion no exitosa !!", "Comuniquese con el administrador", "error");
		  				 }
		  				 else if (answer.duplicate==0 && answer.update==true)
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
		   	feedbackIcons: {
		     	valid: 'glyphicon glyphicon-ok',
		     	invalid: 'glyphicon glyphicon-remove',
		     	validating: 'glyphicon glyphicon-refresh'
		   },
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
	  	});
		$('body').bootstrapValidator().on('submit','#NewPerfil', function (e) {
			if (e.isDefaultPrevented()) {
				alert('hola');
			}
			else{
				console.log('hola');
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
										title:'Isercion exitosa',//Contenido del modal
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
			}
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