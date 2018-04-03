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
			var des=$('#fechaDesde').val();
			var has=$('#fechaHasta').val();
			var sub=$('#submodulo_id').val();
			var ope=$('#operacion_id').val();
			var route='/menu/registros/bitacoras/registros';
			alert('Desde: '+des+', Hasta: '+has+', sub: '+sub+', ope: '+ope);
			var _token=$( "input[name^='_token']" ).val();

			if(dep==0 && usr==0)
			{
				swal("Datos incompletos !!", "Debe seleccionar un departamento y un usuario para continuar", "warning");
				$('#tablaResultadosUs').remove();
			}
			else if(dep!=0 && usr==0)
			{
				swal("Datos incompletos !!", "Debe seleccionar un usuario para continuar", "warning");
				$('#tablaResultadosUs').remove();
			}
			else
			{
				  $.post(route,{_token:_token,registry:usr,desde:des,hasta:has,submodulo:sub,operacion:ope})

							.done(function(answer)
							{
								var colores=['#ffffff','#f7f4f4'];
  								var color=0;

								var longitud=answer.length;
								if (longitud>0) 
								{
									$('#tablaResultadosUs').remove();
									$('#ResultadosMovUs').append('<div class="table-responsive" id="tablaResultadosUs"><table class="table table-condensed table-bordered" id="tablaRegistros_" style="width:75%;height:2%;margin-left: 2%;">  <tr style="background-color:#333333;color: #FEFCFC">  <td style="text-align:center;width:13%;height:10%">Usuario</td> <td style="text-align:center;width:13%;height:10%">Empleado</td> <td style="text-align: center;width:16%;height:10%">Fecha</td> <td style="text-align: center;width:16%;height:10%">Ventana</td>  <td style="text-align: center;width:16%;height:10%">Operacion</td></tr></table></div>');
									for (var i = 0; i < longitud; i++) 
									{
										$('#tablaRegistros_').append('<tr style="background-color:'+colores[color]+';color: #050505;text-align: center;"><td style="text-align:center;width:13%;height:10%">'+answer[i].username+'</td><td style="text-align:center;width:13%;height:10%">'+answer[i].usuario+'</td><td>'+answer[i].created_at+'</td><td>'+answer[i].ventana+'</td><td><button type="button" class="btn btn-link btn-primary movUsuario"  data-reg="'+answer[i].id+'" id=Bit"'+answer[i].id+'">'+answer[i].accion+'</button></td></tr>')
										if (color==0) {color=1;}else{color=0;}
									}
								}
								else
								{
									swal("No existen movimientos para el usuario seleccionado !!", "", "warning");
								}
								
								

								
							})

							.fail(function()
								{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
			}
		});


	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $('#ResultadosMovUs').on("click",".movUsuario",(function() 
  {
  		var route='/menu/registros/bitacoras/movimientosUsuarioRegistros';
  		var registry=$(this).data('reg');
  		var _token=$( "input[name^='_token']" ).val();
  		$.post(route, {_token:_token,registry:registry}) 
  		.done(function(answer)
  		{
  			var detalles=JSON.parse(answer.detalles);
  			var colores=['#ffffff','#f7f4f4'];
  			var color=0;
  			
  			$('#username').html(answer.usuario+' - '+answer.username);
  			$('#fecha').html(answer.created_at);
  			$('#registro').html(answer.registro);
  			$('#ventana').html(answer.ventana);
  			$('#detallesAc').html('Accion:&nbsp;&nbsp; '+answer.accion);
  			
  			$('.bitacora').remove();
  			$.each(detalles,function(campo,valor) 
  			{
  				$('#detalles_').append('<tr class="bitacora" style="background-color:'+colores[color]+'"><td style="font-weight: bold;width:20%;height:2%;text-align: left">'+campo+':</td><td style="width:80%;height:2%;text-align: left;">'+valor+' .</td></tr>');
  				if (color==0) {color=1;}else{color=0;}
  			});
  			
  		})

  		.fail(function(){swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});

  		
  		$('#ModalBitacora').modal('show');
  }));

	
});