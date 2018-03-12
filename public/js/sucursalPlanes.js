$(document).ready(function() 
{
	$('.radioPlan').click(function() 
	{
		var route='/menu/registros/clientes/asignar/plan/sucursal';
		var anterior=$('#planSeleccionado_').val()
		var nuevo=$(this).attr('data-reg');
		var sucursal=$(this).attr('data-sucursal');
		

		if(!anterior){anterior=0;}
					

					swal({
							title: "Asignacion de plan",
							text: '<p style="font-size: 0.9em;">'+'Desea asignar el plan seleccionado  ?</p>',
							type: "warning",
							showCancelButton: true,
							confirmButtonColor: "#207D07",
							confirmButtonText: "Asignar plan",
							cancelButtonText: "No Asignar plan",
							closeOnConfirm: false,
							closeOnCancel: false,
							html: true
						  },
				  				 	function(isConfirm)
				  				 	{
				  				 		if(isConfirm)
				  				 		{
				  				 			$.getJSON(route,{nuevo:nuevo,anterior:anterior,sucursal:sucursal})
				  				 			.done(function(answer)
				  				 			{
				  				 				

				  				 				if(answer.retorno==1)
				  				 				{
				  				 					$('#planSeleccionado_').val(nuevo);//agrega el valor del nuevo registro
				  				 					$('#'+'planS'+nuevo).prop("checked",true);//chekea el nuevo registro
				  				 					swal("Plan asignado", "Se asiigno correctamente el plan a la sucursal", "success");
				  				 				}
				  				 				else
				  				 				{
				  				 					swal("Error de asignacion", "El plan no se asigno correctamente!!!", "error");
				  				 				}
				  				 				
				  				 			})
				  				 			.fail(function()
												{ swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
				  				 			
				  				 		}
				  				 		else
				  				 		{
				  				 			$('#planSeleccionado_').val(anterior);//agrega el valor del nuevo registro
				  				 			$('#'+'planS'+anterior).prop("checked",true);//chekea el nuevo registro
				  				 			swal("Plan asignado", "Ha concedido al usuario actual los permisos asociados al perfil seleccionado", "error");
				  				 		}	

				  				 	});
	});




	//////////////////////// servicios para un plan ///////////////////////

	$('.planesInfo').click(function() 
	{
		var plan_id=$(this).data('reg');
		var route='/menu/registros/clientes/planinfo/sucursal';
		$.getJSON(route,{plan_id:plan_id})
		.done(function(answer)
			{
				$('#tituloServ').html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DETALLE DE SERVICIOS PARA EL PLAN : &nbsp;&nbsp;'+answer.plan);
				//////////////Servicio horarios//////////////////////
				$('#hrInicio').html(answer.horarios.horaI);
				$('#hrFinal').html(answer.horarios.horaF);
				$('#diaIn').html(answer.horarios.diaI);
				$('#diaFn').html(answer.horarios.diaF);
				$('#precHr').html(answer.horarios.precio+ ' Bs. ');

				///////////Servicio tiempo de respuesta /////////////
				$('#hrsRes').html(answer.respuestas.maximo+' Hrs. ');
				$('#precResp').html(answer.respuestas.precio+' Bs. ');

				////////// SOporte presencial ///////////////////////
				if (answer.presenciales.valor==0) 
					{$('#cndPres').html(answer.presenciales.etiqueta);}
				else
					{$('#cndPres').html(answer.presenciales.valor);}
				
				$('#precPres').html(answer.presenciales.precio+' Bs. ');

				////////// SOporte remoto ///////////////////////
				if (answer.remotos.valor==0) 
					{$('#cndRem').html(answer.remotos.etiqueta);}
				else
					{$('#cndRem').html(answer.remotos.valor);}
				
				$('#precRem').html(answer.remotos.precio+' Bs. ');

				// ////////// SOporte telefonico ///////////////////////
				if (answer.telefonicos.valor==0) 
					{$('#cndTel').html(answer.telefonicos.etiqueta);}
				else
					{$('#cndTel').html(answer.telefonicos.valor);}
				
				$('#precTel').html(answer.telefonicos.precio+' Bs. ');

				$('#myModal').modal('show');



			})
		.fail(function()
			{ swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});

				  				 				


	});

});