$(document).ready(function() 
{
	

 /////////////////////////////////////////////////////Metodos Comunes /////////////////////////////////////////////////////////////////

	function loadModal(descripcion,porc,status,id)
		{
			//////////////////////////Llenar el hidden que posee el id del registro /////////////////////////////
			$('#planRegistry').val(id);
			
			/////////////////LLenar y desplegar modal///////////////////////////
			$('#nomPlan').val(descripcion);
			$('#porDesc').val(porc);
			$('#statusPlan').val(status);
			$('#myModal2').modal('show');

			return 0;
		}








 //////////////////////////////////////////////////funcion boton modificar, Modificar plan///////////////////////////////////////////////////////////////////////
 $('.ModificarPlan').click(function()
 	{
 		

 		var registry=$(this).attr('data-reg');
		var _token=$( "input[name^='_token']" ).val();
		var route='/menu/registros/planes/modificar';
		
 		$.post(route,{_token:_token,registry:registry}) 
 		.done(function(answer)
 		{ loadModal(answer.nombreP,answer.descuento,answer.status,answer.id)})
 		.fail(function()
 		{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");})

 		
 		

 	});

/////////////////////////////////////////////////////funcion boton guardar, del modal modificar plan //////////////////////////////////////


$('#actualizarPlan').click(function() 
{
	var formulario=$('#mPlan').serialize();
    var route='/menu/registros/planes/actualizar';


    		$.post(route,formulario)
		  		.done(function(answer)
		  			{
		  				 
		  				
		  				
		  				 if(answer.duplicate>0 && answer.update==false)
		  				 {
		  				 	swal("El plan existe en el sistema !!", "No debe crear planes duplicados", "warning");
		  				 	
		  				 }
		  				 else if(answer.duplicate==0 && answer.update==false)
		  				 {
		  				 	swal("Actualizacion no exitosa !!", "Comuniquese con el administrador", "error");
		  				 }
		  				 else if (answer.duplicate==0 && answer.update==true)
		  				 {
		  				 	
		  				 	swal({
									title:'Actualizacion exitosa',//Contenido del modal
									text: '<p style="font-size: 1.0em;">'+'El plan se modifico correctamente'+'</p>',
									type: "success",
									showConfirmButton:true,//Eliminar boton de confirmacion
									html: true
								},
		  				 	function(isConfirm)
		  				 	{
		  				 		if(isConfirm)
		  				 		{
		  				 			window.location.href="/menu/registros/planeservicios";
		  				 		}	

		  				 	});

		  				 }
		  			

		 			})

		  		.fail(function()
					{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});




});

 /////////////////////////////////////////////////Agregar plan ///////////////////////////////////////////////////////////////////////////

 $('#savePlan').click(function() 
 {
 	        var form=$('#NewPlan').serialize();
			var route='/menu/registros/planes/registrar';

			$.post(route,form)
			.done(function(answer)
				{
					
					if(answer.duplicate>0 && answer.insert==false)
					{
						swal("El plan existe en el sistema !!", "No debe crear planes duplicados", "warning");
					}
					else if(answer.duplicate==0 && answer.insert==true)
					{
						swal({
									title:'Isercion exitosa',//Contenido del modal
									text: '<p style="font-size: 1.0em;">'+'El plan se agrego correctamente'+'</p>',
									type: "success",
									showConfirmButton:true,//Eliminar boton de confirmacion
									html: true
							},
		  				 	function(isConfirm)
		  				 	{
		  				 		if(isConfirm)
		  				 		{
		  				 			window.location.href="/menu/registros/planeservicios";
		  				 		}	

		  				 	});
					}
				})
			.fail(function()
				{
					swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
				});
 });


 /////////////////////////////////////////////////Check de status //////////////////////////////////////////////////////////////////////////


		$('.checkPlan').change(function()
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
			var route='/menu/registros/planes/status';

			swal({
				title: "Cambio de status",
				text: "¿Desea "+acciones[valor]+" El plan seleccionado ?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor:colores[valor],
				confirmButtonText: acciones[valor]+' Plan',
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
								swal("Modificacion exitosa !!", "El plan ha sido "+mensajes[valor]+" correctamente", "success");
								$('#'+actual.attr('id')).val(valores[valor]);

							}
						})
						.fail(function()
							{ swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
					}
					else
					{
						 
						 swal("Cambio de status cancelado !!", "No se modifico el status del plan", "error");
						 actual.prop('checked',estados[valor]);
						 $('#'+actual.attr('id')).val(valor);
						 
					}
			});


		});






});