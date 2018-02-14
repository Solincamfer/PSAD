$(document).ready(function()
{
	



   ////////////////////////////////////////////Guardar nuevo responsable /////////////////////////////////
		$('#btnGuardarResponsable2').click(function()
 				{
 				
 					var form=$('#RespCatFor').serialize();
 					var cliente_id=$('#_clienteMatriz_Resp').val();
 					var route="/menu/registros/clientes/responsable/agregar";
		 					
		 			$.post(route,form)
					.done(function(answer)
						{
							
							console.log(answer);
							
							if(answer.codigo==1)
							{
									swal({
											title:'Isercion exitosa',//Contenido del modal
											text: '<p style="font-size: 1.0em;">'+'El responsable se registro correctamente!!'+'</p>',
											type: "success",
											showConfirmButton:true,//Eliminar boton de confirmacion
											html: true
									},
				  				 	function(isConfirm)
				  				 	{
				  				 		if(isConfirm)
				  				 		{
				  				 			window.location.href="/menu/registros/clientes/responsable/"+cliente_id;
				  				 		}	

				  				 	});
				  				 
							}

							else if(answer.codigo==2)
							{

								swal({
											title:'Cedula duplicada!!!',//Contenido del modal
											text: '<p style="font-size: 0.9em;">'+'Se encuentra asociada al responsable: '+ answer.extra+'.<br><br><br>La cedula debe ser unica para un responsable.</p>',
											type: "warning",
											showConfirmButton:true,//Eliminar boton de confirmacion
											html: true
									});
							}
						
		
				})
					.fail(function()
					{
						swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
					});
 				});


		/////////////////////////////////////////////////Check de status /////////////////////////////////////////////////


		$('.checkRespCat').change(function()
		{
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
			var route='/menu/registros/clientes/responsable/status/categoria';

			swal({
					title: "Cambio de status",
					text: "¿Desea "+acciones[valor]+" El responsable seleccionado ?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor:colores[valor],
					confirmButtonText: acciones[valor]+' Responsable',
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
							console.log(answer);
							if(answer.update)
							{
								swal("Modificacion exitosa !!", "El responsable ha sido "+mensajes[valor]+" correctamente", "success");
								$('#'+actual.attr('id')).val(valores[valor]);

							}
						})
						.fail(function()
							{ swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
					}
					else
					{
						 
						 swal("Cambio de status cancelado !!", "No se modifico el status del responsable", "error");
						 actual.prop('checked',estados[valor]);
						 $('#'+actual.attr('id')).val(valor);
						 
					}
			});

		});


	//////////////////////////////////////////////////////////radio button /////////////////////////////////////////////////////

			$('.radioRespCat').click(function()
				{
					
					var anterior=$('#checkSeleccionadoCat_').val()
					var nuevo=$(this).attr('data-reg');
					var route='/menu/registros/clientes/responsable/asignar/categoria';
					var categoria=$('#categoriaId_').val();
					if(!anterior){anterior=0;}
					

					swal({
							title: "Asignacion de responsable",
							text: '<p style="font-size: 0.9em;">'+'Desea asignar a la persona seleccionada como responsable de la categoria:  <br>  '+''+'?</p>',
							type: "warning",
							showCancelButton: true,
							confirmButtonColor: "#207D07",
							confirmButtonText: "Asignar responsable",
							cancelButtonText: "No Asignar responsable",
							closeOnConfirm: false,
							closeOnCancel: false,
							html: true
						  },
				  				 	function(isConfirm)
				  				 	{
				  				 		if(isConfirm)
				  				 		{
				  				 			$.getJSON(route,{nuevo:nuevo,anterior:anterior,categoria:categoria})
				  				 			.done(function(answer)
				  				 			{
				  				 				
				  				 				if(answer.retorno==1)
				  				 				{
				  				 					$('#checkSeleccionadoCat_').val(nuevo);//agrega el valor del nuevo registro
				  				 					$('#'+'cat_rsp'+nuevo).prop("checked",true);//chekea el nuevo registro
				  				 					swal("Responsable asignado", "La categoria tiene un nuevo responsable asignado", "success");
				  				 				}
				  				 				else
				  				 				{
				  				 					swal("Error de asignacion", "El responsable no se asigno correctamente!!!", "error");
				  				 				}
				  				 				
				  				 			})
				  				 			.fail(function()
												{ swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
				  				 			
				  				 		}
				  				 		else
				  				 		{
				  				 			$('#checkSeleccionadoCat_').val(anterior);//agrega el valor del nuevo registro
				  				 			$('#'+'cat_rsp'+anterior).prop("checked",true);//chekea el nuevo registro
				  				 			swal("Asignacion cancelada", "No se asigno el responsable seleccionado a la categoria", "error");
				  				 		}	

				  				 	});




				});
});