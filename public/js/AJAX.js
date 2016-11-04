    
    $( "#log" ).submit(function( event ) {
	event.preventDefault();
	var form=$('#log');
	var url= form.attr('action');
	var data= form.serialize();

	var posting = $.post( url, data,function(resultado){
		if (resultado == true) {
			swal('Bienvenido');
			location.href = "/login/redireccion";
		}else{
			swal('Fallo');
		}					
	});
	  posting.fail(function() {
	    alert( "desconectado" );
	  })
	  posting.always(function() {
	  	//Validar preload
	    //alert( "complete" );
	  });
});