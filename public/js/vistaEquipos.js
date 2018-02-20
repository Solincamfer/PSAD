$(document).ready(function() 
{
	

	


	function loadModal(datos)
	{

		
		/////////////////cargar opciones de las listas ///////////////////
		$('.tpEqm').remove();
		cargarSelect(datos.tipoequipo,'tpEqm');

		$('.mkEqm').remove();
		cargarSelect(datos.marcas,'mkEqm');

		$('.modEqm').remove();
		cargarSelect(datos.modelos,'modEqm');
		/////////////////////////////////////////////////////////////////

		///////////////cargar resto de campos del modal /////////////////

		$('#nomEqm').val(datos.equipo.descripcion);
		$('#tpEqm').val(datos.equipo.tipoequipo);
		$('#mkEqm').val(datos.equipo.marca);
		$('#modEqm').val(datos.equipo.modelo);
		$('#duPflm').val(datos.equipo.serial);
		$('#stPflm').val(datos.equipo.status);

		$('#myModal2').modal('show');

		return 0;
	}



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




 ///////////////////////Seleccionar select equipos ////////////////////////////////////

	$('.checkEquipos').change(function()	
	{
		var listas=[['_tpEq','mkEq','modEq'],['tpEqm','mkEqm','modEqm']];
		var caso=$(this).data('caso');
		var grupo=$(this).data('grupo');
		var registry=$(this).val();
		var _token=$( "input[name^='_token']" ).val();
		var route='/menu/registros/clientes/selectequipos/sucursal';

		if(caso<2)
		{
			limpiarLista(parseInt(caso)+1,listas[grupo]);

			if(registry!="")
			{

				$.post(route,{_token:_token,registry:registry,caso:caso})
				  .done(function(answer)
				  {
				  	
				  	cargarSelect(answer,listas[grupo][parseInt(caso)+1]);

				  })

				  .fail(function()
					{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
			}
		}
		


	});
	/////////////////////////////////Agregar nuevo equipo //////////////////////////////////////

	$('#btnSvEquipoAgr').click(function() 
	{
		var form=$('#equipoSucAgr').serialize();
		var route='/menu/registros/clientes/insertar/equipo';
		var sucursal=$('#_sucursal_id_').val();
		$.post(route,form)
				.done(function(answer)
					{

						console.log(answer);
							if(answer.codigo==1)
							{
									swal({
											title:'Isercion exitosa',//Contenido del modal
											text: '<p style="font-size: 1.0em;">'+'El equipo se agrego correctamente!!'+'</p>',
											type: "success",
											showConfirmButton:true,//Eliminar boton de confirmacion
											html: true
									},
				  				 	function(isConfirm)
				  				 	{
				  				 		if(isConfirm)
				  				 		{
				  				 			window.location.href="/menu/registros/clientes/categoria/sucursal/equipos/"+sucursal;
				  				 		}	

				  				 	});
				  				 
							}

							else if(answer.codigo==2)
							{

								swal({
											title:'Nombre duplicado!!!',//Contenido del modal
											text: '<p style="font-size: 0.9em;">'+ answer.extra+'</p>',
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

 ///////////////////////////////////////////////Boton modificar cargar modal ////////////////////////////////////

 $('.modificarEquipo_').click(function() 
 {
 	var registry=$(this).data('reg');
 	$('#_sucursalRegistro').val(registry);
 	var route='/menu/registros/clientes/modificar_equipo';
 	var sucursal=$('#_sucursal_id_').val();
 	var form=$('#equipoSucMod').serialize();
 		$.post(route,form)
				.done(function(answer)
					{

						console.log(answer);
						loadModal(answer);
							
					})
				.fail(function()
					{
						swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
					});





 });
 ////////////////////////////////////////Boton modificar : Actualizar registros ///////////////////////////////////////
 $('#_btnModificarEquipo_').click(function()
	 {
	 	

	 });





});