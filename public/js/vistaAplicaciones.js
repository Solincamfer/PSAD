$(document).ready(function() 
{
	$('#__btnSvAplicacion___').click(function() 
	{
		var form=$('#regisAplicAgr').serialize();
		var route='/menu/registros/clientes/insertar/aplicaciones';
		var equipo=$('#__equipo__id__').val();
		alert(form);

		$.post(route,form)

			.done(function(answer)
				{
					console.log(answer);
				})
			.fail(function()
						{
							swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
						});
	});

});