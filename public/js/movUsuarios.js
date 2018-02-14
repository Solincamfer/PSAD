$(document).ready(function() 
{
	//////////////////////////////////////////Metodos comunes//////////////////////////////////////////
  		function limpiarLista(caso,listas)
		{
			var longitud=4;

			for (var i = caso; i <longitud; i++)
			 {
				
			 	$('.'+listas[i]).remove();
			 }
			 return 0;
		}


		function cargarSelect(datos,idLista)
		{
			var longitud=datos.length;
		 

			for (var i = 0; i < longitud; i++) 
			{
				
				$('#'+idLista).append('<option class="'+idLista+'" value="'+ datos[i].id+'">'+datos[i].descripcion+' - '+datos[i].primerNombre+' '+datos[i].primerApellido+'</option>');
			}

			return 0;
		}



   /////////////////////////////////////Cambio en el select de departamentos///////////////////////////////////////////////////
	$('#DepBitUs').change(function() 
	{
		var registry=$(this).val();
		var route='/menu/registros/bitacoras/usuarios';
	    var _token=$( "input[name^='_token']" ).val();
	    $.post(route,{_token:_token,registry:registry})

							.done(function(answer)
							{
								
								$('#tablaResultadosUs').remove();
								$('.UsBitUs').remove();
								cargarSelect(answer,'UsBitUs');

								
							})

							.fail(function()
								{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});

	});

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/////////////////////////////// Funcion del boton mostrar ///////////////////////////////////////////////////////////////////
	$('#mostrarBitUs').click(function()
		{
			var dep=$('#DepBitUs').val();
			var usr=$('#UsBitUs').val();
			var route='/menu/registros/bitacoras/registros';
			var _token=$( "input[name^='_token']" ).val();

			if(dep==0 && usr==0)
			{
				swal("Datos incompletos !!", "Debe seleccionar un departamento y un usuario para continuar", "error");
			}
			else
			{
				  $.post(route,{_token:_token,registry:usr})

							.done(function(answer)
							{
								

								// if(answer.bitacora.length==0)
								// {
								// 	swal("No existen datos !!", "No hay registro de actividades para el usuario seleccionado", "warning");
								// }
								$('#tablaResultadosUs').remove();
								$('#ResultadosMovUs').append(answer);
								

								
							})

							.fail(function()
								{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
			}
		});


	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $('#ResultadosMovUs').on("click",".movUsuario",(function() 
  {
  		$('#ModalBitacora').modal('show');
  }));

	
});