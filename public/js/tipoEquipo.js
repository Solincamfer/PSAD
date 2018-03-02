$(document).ready(function()
{
	////////////////////////////////////// Metodos comunes //////////////////////////////////////////////////////

	function loadModal(descripcion,id,padre)
	{

		/////////////////indicar al boton guardar del modal modificar el registro que se desea modificar //////////////////////////////
		$('#registry').val(id);
		/////////////////LLenar y desplegar modal///////////////////////////
		$('#descripcion').val(descripcion);
		$('#padre').val(padre);
		$('#myModal4').modal('show');

		return 0;
	}



	//////////////////////////////////////Funcion boton: modificar llena el modal con los datos del registro que se desea modificar/////////////////////////////////////////////////////
	$('.Modificar').click(function()
	{
    var tabla=$('#areaResultados').data('tabla');
	  var registry=$(this).attr('data-reg');
	  var _token=$( "input[name^='_token']" ).val();
	  var route='/menu/registros/datos/modificar';
    var padre;
	  $.post(route,{_token:_token,registry:registry,tabla:tabla})
	  .done(function(answer)
	  {
      //console.log(answer.descripcion);
	  	loadModal(answer.descripcion,answer.id,padre="");
	  })

	  .fail(function()
		{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});

	});

  //////////////////////////////////////// Eliminar Registro ///////////////////////////////////////////////////////////////
  $('.Eliminar').click(function()
	{
	  var registry=$(this).attr('data-reg');
	  var _token=$( "input[name^='_token']" ).val();
	  var route='/menu/registros/datos/eliminar/tipoEquipo';
    swal({
      title: "Eliminar tipo de Equipo",
      text: "Al borrar un tipo de equipo, borrara los componentes y piezas asociados ¿Desea eliminar el tipo de equipo seleccionado?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor:'#EE1919',
      confirmButtonText: 'Si, borrar tipo de equipo',
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
            //console.log(answer);
            if(answer==1)
            {
              swal({
                title:'Borrado exitoso',//Contenido del modal
                text: '<p style="font-size: 1.0em;">'+'El tipo de equipo fue borrado correctamente'+'</p>',
                type: "success",
                showConfirmButton:true,//Eliminar boton de confirmacion
                html: true
              },
              function(isConfirm)
              {
                if(isConfirm)
                {
                  window.location.href="/menu/registros/datos";
                }

              });

            }
          })
          .fail(function()
            { swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
        }
        else
        {

           swal("Eliminación cancelada !!", "No se borro el tipo de equipo selecconado", "error");
        }
    });

	});

 //////////////////////////////////////Funcion asociar marcas al tipo de equipo/////////////////////////////////////////////////////
	
	$('.Marca').click(function()
	{
		$('.marcas').remove();
		$('.modelos').remove();
		var registry=$(this).attr('data-reg');
		$('#registry').val(registry);
		var _token=$( "input[name^='_token']" ).val();
		var route='/menu/registros/datos/mostrarmarcas';
		$.post(route,{_token:_token,registry:registry})
		.done(function(answer)
		{
			//console.log(answer);
			$.each(answer,function(key, registro) {
			$("#marca").append('<option class="marcas" value='+registro.id+'>'+registro.descripcion+'</option>');
			});        
			$('#myModal1').modal('show');
		})

		.fail(function()
		{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
	});


//////////////////////////////////////Funcion asociar modelos al tipo de equipo/////////////////////////////////////////////////////
	
	$('#marca').on("change",function()
	{
		$('.modelos').remove();
		var registro=$('#registry').val();
		var valor = $("#marca option:selected").val();
		var _token=$( "input[name^='_token']" ).val();
		var route='/menu/registros/datos/mostrarmodelos';
		$.post(route,{_token:_token,registro:registro,valor:valor})
		.done(function(answer)
		{
			console.log(answer);
			$.each(answer,function(key, registro) {
			$("#modelos").append('<option class="modelos" value='+registro.id+'>'+registro.descripcion+'</option>');
			});        
		})

		.fail(function()
		{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
	});
////////////////////////////////////// Funcion mostrar modal agregar marca y modal para modelo /////////////////////////////////////////////////////
	
	$('#plusMarca').on("click",function()
	{
		$('#myModal2').modal('show');
	});

	$('#plusModelo').on("click",function()
	{
		$('#myModal3').modal('show');
	});


	//////////////////////////////////////   Funcion borrar marcas del tipo de equipo    /////////////////////////////////////////////////////
	
	$('#minusMarca').on("click",function()
	{
		var valor = $("#marca option:selected").val();
		var registro=$('#registry').val();
		if(valor==''){
			swal({
                title:'Campo Vacio',//Contenido del modal
                text: '<p style="font-size: 1.0em;">'+'Debe seleccionar una marca para borrar'+'</p>',
                type: "warning",
                //showConfirmButton:true,//Eliminar boton de confirmacion
                html: true
			});
		}
		else{
			swal({
		      title: "Eliminar Marca",
		      text: "Al borrar una marca para este tipo de equipo, borrara los modelos asociados ¿Desea Continuar?",
		      type: "warning",
		      showCancelButton: true,
		      confirmButtonColor:'#EE1919',
		      confirmButtonText: 'Si, borrar la marca',
		      cancelButtonText: "Cancelar",
		      closeOnConfirm: false,
		      closeOnCancel: false
		     },
		     function(isConfirm){
		        if(isConfirm){

					var _token=$( "input[name^='_token']" ).val();
					var route='/menu/registros/datos/borrarMarcaTipoEquipo';
					$.post(route,{_token:_token,registro:registro,valor:valor})
		          	.done(function(answer){
			            //console.log(answer);
			            if(answer) {

			            	//console.log(answer); 
			              	swal({
				                title:'Borrado exitoso',//Contenido del modal
				                text: '<p style="font-size: 1.0em;">'+'La marca y sus modelos fueron borrados correctamente'+'</p>',
				                type: "success",
				                showConfirmButton:true,//Eliminar boton de confirmacion
				                html: true
				            },						
							function(isConfirm){
				                if(isConfirm)
				                {
				                	$('.marcas').remove();
				                	$('.modelos').remove();
				                 $.each(answer,function(key, registro) {
									$("#marca").append('<option class="marcas" value='+registro.id+'>'+registro.descripcion+'</option>');
								});
				                }
							});
			            }
					})
		          	.fail(function(){ 
		          		swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
		          	});
		        }
		        else
		        {

		           swal("Eliminación cancelada !!", "No se borro el tipo de equipo selecconado", "error");
		        }
	    	});
		}
	});
	//////////////////////////////////////////////////Funcion boton : guardar/modificar //////////////////////////////////
   $('#forActPerf').bootstrapValidator({
		   fields: {
		     Descripcion: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar el nombre del nuevo perfil'
		         }
		       }
		     },
		     Status: {
		       validators: {
		         notEmpty: {
		           message: 'Debe seleccionar un estatus para el nuevo perfil'
		         }
		       }
		     }
		   }
        }).on('success.form.bv',function(e,data){
	  		e.preventDefault();
			var $form = $(e.target);
            var bv    = $form.data('bootstrapValidator');
			var formulario=$('#forActPerf').serialize();
			var route='/menu/registros/perfiles/actualizar';
			$.post(route,formulario)
		  		.done(function(answer)
		  			{

		  				 if(answer.duplicate>0 && answer.update==false)
		  				 {
		  				 	swal("El perfil existe en el sistema !!", "No puede crear perfiles con el mismo nombre", "warning");
		  				 	//$('#forActPerf').data('bootstrapValidator').resetForm();
		  				 }
		  				 else if(answer.duplicate==0 && answer.update==false)
		  				 {
		  				 	swal("Actualizacion Fallida !!", "Comuniquese con el administrador", "error");
		  				 }
		  				 else if (answer.duplicate==0 && answer.update==true)
		  				 {

		  				 	swal({
									title:'Actualizacion exitosa',//Contenido del modal
									text: '<p style="font-size: 1.0em;">'+'El perfil se modifico correctamente'+'</p>',
									type: "success",
									showConfirmButton:true,//Eliminar boton de confirmacion
									html: true
								},
		  				 	function(isConfirm)
		  				 	{
		  				 		if(isConfirm)
		  				 		{
		  				 			window.location.href="/menu/registros/perfiles";
		  				 		}

		  				 	});

		  				 }

		 			})

		  		.fail(function()
					{swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
    });


	//////////////////////////////////////Funcion boton:  Agregar perfil ///////////////////////////////////////////////////

		$('#NewPerfil').bootstrapValidator({
		   fields: {
		     DescripcionAdd: {
		       validators: {
		         notEmpty: {
		           message: 'Debe indicar el nombre del nuevo perfil'
		         }
		       }
		     },
		     StatusAdd: {
		       validators: {
		         notEmpty: {
		           message: 'Debe seleccionar un estatus para el nuevo perfil'
		         }
		       }
		     }
		   }
        }).on('success.form.bv',function(e){
      		e.preventDefault();
      		var form=$('#NewPerfil').serialize();
				var route='/menu/registros/perfiles/registrar';

				$.post(route,form)
				.done(function(answer)
					{

						if(answer.duplicate>0 && answer.insert==false)
						{
							swal("El perfil existe en el sistema !!", "No puede crear perfiles con el mismo nombre", "warning");
						}
						else if(answer.duplicate==0 && answer.insert==true)
						{
							swal({
										title:'Isercion exitosa',//Contenido del modal
										text: '<p style="font-size: 1.0em;">'+'El perfil se agrego correctamente'+'</p>',
										type: "success",
										showConfirmButton:true,//Eliminar boton de confirmacion
										html: true
								},
			  				 	function(isConfirm)
			  				 	{
			  				 		if(isConfirm)
			  				 		{
			  				 			window.location.href="/menu/registros/perfiles";
			  				 		}

			  				 	});
						}
					})
				.fail(function()
					{
						swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
					});
      	});




		////////////////////////////////////Funcion Check Status /////////////////////////////////////////////////////

		$('.checkPerfil').change(function()
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
			var route='/menu/registros/perfiles/status';

			swal({
				title: "Cambio de status",
				text: "¿Desea "+acciones[valor]+" El perfil seleccionado ?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor:colores[valor],
				confirmButtonText: acciones[valor]+' Perfil',
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
								swal("Modificacion exitosa !!", "El perfil ha sido "+mensajes[valor]+" correctamente", "success");
								$('#'+actual.attr('id')).val(valores[valor]);

							}
						})
						.fail(function()
							{ swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});
					}
					else
					{

						 swal("Cambio de status cancelado !!", "No se modifico el status del perfil", "error");
						 actual.prop('checked',estados[valor]);
						 $('#'+actual.attr('id')).val(valor);

					}
			});


		});

});
