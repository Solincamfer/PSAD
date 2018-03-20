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

////////////////////////////////////////////////////Eliminar plan///////////////////////////////////////////
	$('._eliminarPlan_').click(function() 
	{
			var registry=$(this).data('reg');
			var route='/menu/registros/clientes/eliminar/planes';
			var _token=$( "input[name^='_token']" ).val();
			

				swal({
							title: "Eliminar Plan",
							text: "¿ Desea eliminar el plan seleccionado ? ",
							type: "warning",
							showCancelButton: true,
							confirmButtonColor:'#EE1919',
							confirmButtonText:'Eliminar Plan',
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
								  				 	window.location.href='/menu/registros/planeservicios/';
								  				 }	

								  			});
										

									}
									else if(answer.codigo==2)
									{
										swal({
												title:'Imposible eliminar el plan',//Contenido del modal
												text: '<p style="font-size: 1.0em;">'+answer.extra+'</p>',
												type: "warning",
												showConfirmButton:true,//Eliminar boton de confirmacion
												html: true
											});
									}
									else
										{
											 swal("No se elimino el plan!!!", "", "error");
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

$('#mPlan').bootstrapValidator({
   fields: {
    nomPlan: {
       validators: {
         notEmpty: {
           message: 'Debe indicar el nombre del nuevo plan'
         }
       }
     },
     porDesc: {
       	validators: {
         	notEmpty: {
           		message: 'Debe indicar el porcentaje de descuento'
         	},
        	regexp: {
                regexp: /^[0-9]+$/,
                message: 'El porcentaje debe contener solo numeros'                            
            },
       	}
     },
     statusPlan: {
	   validators: {
	     notEmpty: {
	       message: 'Seleccione el estatus del plan'
	     }
	   }
	 }
   }
}).on('success.form.bv',function(e,data){
	e.preventDefault();
	var formulario=$('#mPlan').serialize();
    var route='/menu/registros/planes/actualizar';


    		$.post(route,formulario)
		  		.done(function(answer)
		  			{
		  				 
		  				
		  				
		  				 if(answer.duplicate>0 && answer.update==false)
		  				 {
		  				 	swal("El plan existe en el sistema !!", "No puede crear planes con el mismo nombre", "warning");
		  				 	
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

$('#NewPlan').bootstrapValidator({
   fields: {
    nomPn: {
       validators: {
         notEmpty: {
           message: 'Debe indicar el nombre del nuevo plan'
         }
       }
     },
     porDes: {
       	validators: {
         	notEmpty: {
           		message: 'Debe indicar el porcentaje de descuento'
         	},
        	regexp: {
                regexp: /^[0-9]+$/,
                message: 'El porcentaje debe contener solo numeros'                            
            },
       	}
     },
     stPn: {
	   validators: {
	     notEmpty: {
	       message: 'Seleccione el estatus del plan'
	     }
	   }
	 }
   }
}).on('success.form.bv',function(e,data){
	e.preventDefault();
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
							title:'Guardado exitoso',//Contenido del modal
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