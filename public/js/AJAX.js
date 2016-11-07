$('#log1').click(function(){
	var user = $('#user').val();
	var pwd = $('#pwd').val();
	if (user != '' && pwd != ''){
		//Funcionalidad para la validacion de Boostrapt Validator en la que bloquea el boton del login
		$( "#log" ).submit(function( event ) {
			event.preventDefault();
			var form=$('#log');
			var url= form.attr('action');
			var data= form.serialize();
			var posting = $.post( url, data,function(resultado){
				if (resultado[0] == true) {
					swal({
						title:'Bienvenido',//Contenido del modal
						text: resultado[1]+' '+resultado[2],
						timer:2000,//Tiempo de retardo en ejecucion del modal
						type: "success",
						showConfirmButton:false,//Eliminar boton de confirmacion
						html: true
					});
					//Retardo en ejecucion de ruta.
					setTimeout(function(){location.href = "/login/redireccion";},2200); // 3000ms = 3s			
				}					
			});
			posting.fail(function() {
				swal({
						title:'Credenciales invalidos.',//Contenido del modal
						timer:1500,//Tiempo de retardo en ejecucion del modal
						type: "error",
						showConfirmButton:false//Eliminar boton de confirmacion
					});
			})
			posting.always(function() {
				//Validar preload
				//alert( "complete" );
			});
		});
	}
});