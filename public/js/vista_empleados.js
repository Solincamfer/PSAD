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








 
		/////////////////////////////////////////////Funcion Agregar/////////////////////////////////////////////////////////// 












});