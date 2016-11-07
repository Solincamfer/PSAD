$( "#log" ).submit(function( event ) {
	event.preventDefault();
	var form=$('#log');
	var url= form.attr('action');
	var data= form.serialize();
	var posting = $.post( url, data,function(resultado){
		if (resultado == true) {
			swal({
				title:'Bienvenido',//Contenido del modal
				timer:2000,//Tiempo de retardo en ejecucion del modal
				showConfirmButton:false//Eliminar boton de confirmacion
			});
			//Retardo en ejecucion de ruta.
			setTimeout(function(){location.href = "/login/redireccion";},2200); // 3000ms = 3s			
		}else{
			swal({
				title:'Credenciales invalidos.',//Contenido del modal
				timer:1000,//Tiempo de retardo en ejecucion del modal
				showConfirmButton:false//Eliminar boton de confirmacion
			});
		}					
	});
	  posting.fail(function() {
	  	//Ruta al controlador principal no encontrada.
	    alert( resultado );
	  })
	  posting.always(function() {
	  	//Validar preload
	    //alert( "complete" );
	  });
});