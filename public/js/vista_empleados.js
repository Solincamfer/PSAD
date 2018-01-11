$(document).ready(function() 
{
	

		///////////////////////////////////////////// Metodos comunes /////////////////////////////////////////////////





		/////////////////////////////////////////////Funcion boton modificar///////////////////////////////////////////////
		$('.ModificarEmpleado').click(function() 
		{
		  var registry=$(this).attr('data-reg');
		  var _token=$( "input[name^='_token']" ).val();
		  var route='/menu/registros/empleados/modificar';

		  $.post(route,{_token:_token,registry:registry})
		  .done(function(answer)
		  {
		  	//loadModal(answer.descripcion,answer.status,answer.id);
		  })

		  .fail(function()
			{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});

		});






		//////////////////////////////////////////Funcion boton guardar boton modificar ///////////////////////////////////////



		$('#saveEmpl').click(function()
		{
			var form=$('#NewEmp').serialize();
			var route='/menu/registros/empleados/agregar';

			$.post(route,form)
			.done(function(answer)
				{
					
					
					console.log(answer);
					// if(answer.duplicate>0 && answer.insert==false)
					// {
					// 	swal("El perfil existe en el sistema !!", "No debe crear perfiles duplicados", "warning");
					// }
					// else if(answer.duplicate==0 && answer.insert==true)
					// {
					// 	swal({
					// 				title:'Isercion exitosa',//Contenido del modal
					// 				text: '<p style="font-size: 1.0em;">'+'El perfil se agrego correctamente'+'</p>',
					// 				type: "success",
					// 				showConfirmButton:true,//Eliminar boton de confirmacion
					// 				html: true
					// 		},
		  	// 			 	function(isConfirm)
		  	// 			 	{
		  	// 			 		if(isConfirm)
		  	// 			 		{
		  	// 			 			window.location.href="/menu/registros/empleados";
		  	// 			 		}	

		  	// 			 	});
					// }
				})
			.fail(function()
				{
					swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
				});

		});




 
		/////////////////////////////////////////////Funcion Agregar/////////////////////////////////////////////////////////// 












});