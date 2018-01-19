$(document).ready(function() 
{
	

		///////////////////////////////////////////// Metodos comunes /////////////////////////////////////////////////
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
				$('#'+idLista).append('<option class="'+idLista+'" value="'+ datos[i].id+'">'+datos[i].descripcion+'</option>')
			}

			return 0;
		}

		function loadModal(datos)
		{
			$('#nomEmp1m').val(datos[0].primerNombre);
			$('#nomEmp2m').val(datos[0].segundoNombre);
			$('#apellEmp1m').val(datos[0].primerApellido);
			$('#apellEmp2m').val(datos[0].segundoApellido);
			$('#myModal2').modal('show');
		}


		/////////////////////////////////////////////Funciones para los select de estructura //////////////////////////////


		$('.estructura_agr').change(function()
			{


				
					var idRegistro=$(this).val();
					var caso=$(this).attr('data-caso');
					var vista=$(this).attr('data-vista');
					var route='/menu/registros/empleados/estructura';
					var _token=$( "input[name^='_token']" ).val();
					var listas=[['direccionEmpr','departamentoEmp','areaEmp_agr','cgoEmp'],['direccionEmprm','departamentoEmpm','areaEmp_m','cgoEmpm']];
					if(caso<4)//cuando se cambian los selects que no son cargo 
					{

							
							$.post(route,{_token:_token,idRegistro: idRegistro,caso:caso })

							.done(function(answer)
							{
								limpiarLista(caso,listas[vista]);
								cargarSelect(answer,listas[vista][caso])

								
							})

							.fail(function()
								{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});

					}
			

				
			});





		/////////////////////////////////////////////Funcion boton modificar///////////////////////////////////////////////
		$('.ModificarEmpleado').click(function() 
		{
		  var registry=$(this).attr('data-reg');
		  var _token=$( "input[name^='_token']" ).val();
		  var route='/menu/registros/empleados/modificar';
		  

		  $.post(route,{_token:_token,registry:registry})
		  .done(function(answer)
		  {
		  	
		  	console.log(answer);
		  	loadModal(answer);
		  })

		  .fail(function()
			{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});

		});






		//////////////////////////////////////////Funcion boton Guardar nuevo empleado ///////////////////////////////////////

		$('#nomUs_agr').click(function()
			{
				var cedula=$('#numCiEmp').val();

				if(cedula.length==0)
				{
					swal("EL numero de Cedula es requerido !!", "Ingrese un numero de cedula para el empleado", "warning");
				}
				else
				{
				
					$(this).val(cedula);
			    
			    }
				
			})



		$('#saveEmpl').click(function()
		{
			var form=$('#NewEmp').serialize();
			var route='/menu/registros/empleados/agregar';

			$.post(route,form)
			.done(function(answer)
				{
					
					
					console.log(answer);

					if(answer.codigo==1)
					{
							swal({
									title:'Isercion exitosa',//Contenido del modal
									text: '<p style="font-size: 1.0em;">'+'El empleado se registro correctamente!!'+'</p>',
									type: "success",
									showConfirmButton:true,//Eliminar boton de confirmacion
									html: true
							},
		  				 	function(isConfirm)
		  				 	{
		  				 		if(isConfirm)
		  				 		{
		  				 			window.location.href="/menu/registros/empleados";
		  				 		}	

		  				 	});
		  				 
					}

					else if(answer.codigo==2)
					{

						swal({
									title:'Cedula y Rif duplicados!!!',//Contenido del modal
									text: '<p style="font-size: 0.9em;">'+'Se encuentran asociados a  : '+ answer.extra+'.<br><br><br>Los datos de: Cedula y Rif para un empleado, deben ser unicos.</p>',
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




 
		/////////////////////////////////////////////Funcion Agregar/////////////////////////////////////////////////////////// 






		/////////////////////////////////////////////Funcion para los Check ///////////////////////////////////////////////////

		$('.checkEmpleado').change(function()
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
			var route='/menu/registros/empleados/status';

			swal({
				title: "Cambio de status",
				text: "¿Desea "+acciones[valor]+" El empleado seleccionado ?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor:colores[valor],
				confirmButtonText: acciones[valor]+' Empleado',
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
								swal("Modificacion exitosa !!", "El empleado ha sido "+mensajes[valor]+" correctamente", "success");
								$('#'+actual.attr('id')).val(valores[valor]);

							}
						})
						.fail(function()
							{ swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
					}
					else
					{
						 
						 swal("Cambio de status cancelado !!", "No se modifico el status del empleado", "error");
						 actual.prop('checked',estados[valor]);
						 $('#'+actual.attr('id')).val(valor);
						 
					}
			});

		});












});