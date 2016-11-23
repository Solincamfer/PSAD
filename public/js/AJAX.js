$( "#log" ).submit(function( event ) {
	event.preventDefault();
	});
$( "#Formcliente" ).submit(function( event ) {
	event.preventDefault();
	});
$('#log1').click(function(){
	var user = $('#user').val();
	var pwd = $('#pwd').val();
	if (user != '' && pwd != ''){
		//Funcionalidad para la validacion de Boostrapt Validator en la que bloquea el boton del login
			var form=$('#log');
			var url= 'login/verificar';
			var data= form.serialize();
			var posting = $.post( url, data,function(resultado){
				if (resultado[0] == true) {
					swal({
						title:'Bienvenido',//Contenido del modal
						text: '<p style="font-size: 2em;">'+resultado[1]+' '+resultado[2]+'</p>',
						timer:2000,//Tiempo de retardo en ejecucion del modal
						type: "success",
						showConfirmButton:false,//Eliminar boton de confirmacion
						html: true
					});
					//Retardo en ejecucion de ruta.
					setTimeout(function(){location.href = "/menu";},2200); // 3000ms = 3s			
				}else{
					swal({
						title:'Credenciales invalidos.',//Contenido del modal
						timer:1500,//Tiempo de retardo en ejecucion del modal
						type: "error",
						showConfirmButton:false//Eliminar boton de confirmacion

					});
				}					
			});
			posting.fail(function() {
				swal({
						title:'Error inesperado!!',//Contenido del modal
						text: '<p style="font-size: 1.5em;">'+'Pongase en contacto con el administrador'+'</p>',
						timer:2000,//Tiempo de retardo en ejecucion del modal
						type: "error",
						showConfirmButton:false,//Eliminar boton de confirmacion
						html: true
					});
			})
			posting.always(function() {
				//Validar preload
				//alert( "complete" );
			});	
		
	}else{
		
	}
});

$("#inn1").change(function(){
	$("#inn1 option:selected").each(function () {			
    		var name=$('#inn1').attr("name");
            elegido=$(this).val();
            var vector=[name,elegido];
            $.get("/menu/registros/clientes/registrar", { vector: vector }, function(data){
            	$.each(data, function(i, item) {
            		$('#inn2').append('<option value="'+item.id+'">'+item.descripcion+'</option>');
				})        
            });            
        });
	
			
		});

$("#inn2").change(function(){
	$("#inn2 option:selected").each(function () {			
    		var name=$('#inn2').attr("name");
            elegido=$(this).val();
            var vector=[name,elegido];
            $.get("/menu/registros/clientes/registrar", { vector: vector }, function(data){
            	$.each(data, function(i, item) {
            		$('#inn3').append('<option value="'+item.id+'">'+item.descripcion+'</option>');
				})        
            });            
        });
	
			
		});

$("#inn3").change(function(){
	$("#inn3 option:selected").each(function () {			
    		var name=$('#inn3').attr("name");
            elegido=$(this).val();
            var vector=[name,elegido];
            $.get("/menu/registros/clientes/registrar", { vector: vector }, function(data){
            	$.each(data, function(i, item) {
            		$('#inn4').append('<option value="'+item.id+'">'+item.descripcion+'</option>');
				})        
            });            
        });
	
			
		});