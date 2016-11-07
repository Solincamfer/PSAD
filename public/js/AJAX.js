$( "#log" ).submit(function( event ) {
	event.preventDefault();
	var form=$('#log');
	var url= form.attr('action');
	var data= form.serialize();
	var nombreusuario='Angel Toyo';
	var posting = $.post( url, data,function(resultado){
		if (resultado[0] == true) {
			swal({
				title:'Bienvenido',//Contenido del modal
				text: "<p style='font-size:30px';>"+nombreusuario+"</p>" ,
				type: "success",
				timer:3000,//Tiempo de retardo en ejecucion del modal
				showConfirmButton:false,//Eliminar boton de confirmacion
				html:true
			});
			//Retardo en ejecucion de ruta.
			setTimeout(function(){location.href = "/login/redireccion";},3200); // 3000ms = 3s			
		}else{
			swal({
				title:'Credenciales invalidas.',//Contenido del modal
				type: "error",
				timer:1500,//Tiempo de retardo en ejecucion del modal
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