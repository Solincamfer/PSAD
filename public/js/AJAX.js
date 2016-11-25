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
            		$('#inn2').append('<option class="limpiarnn" value="'+item.id+'">'+item.descripcion+'</option>');
				})        
            });            
        });
	$( ".limpiarnn" ).remove();
			
		});

$("#inn2").change(function(){
	$("#inn2 option:selected").each(function () {			
    		var name=$('#inn2').attr("name");
            elegido=$(this).val();
            var vector=[name,elegido];
            $.get("/menu/registros/clientes/registrar", { vector: vector }, function(data){
            	$.each(data, function(i, item) {
            		$('#inn3').append('<option class="limpiarnn1" value="'+item.id+'">'+item.descripcion+'</option>');
				})        
            });            
        });
	$( ".limpiarnn1" ).remove();
			
		});

$("#inn3").change(function(){
	$("#inn3 option:selected").each(function () {			
    		var name=$('#inn3').attr("name");
            elegido=$(this).val();
            var vector=[name,elegido];
            $.get("/menu/registros/clientes/registrar", { vector: vector }, function(data){
            	$.each(data, function(i, item) {
            		$('#inn4').append('<option class="limpiarnn2" value="'+item.id+'">'+item.descripcion+'</option>');
				})        
            });            
        });
	$( ".limpiarnn2" ).remove();
			
		});


$("#ipp1").change(function(){
	$("#ipp1 option:selected").each(function () {			
    		var name=$('#ipp1').attr("name");
            elegido=$(this).val();
            var vector=[name,elegido];
            $.get("/menu/registros/clientes/registrar", { vector: vector }, function(data){
            	$.each(data, function(i, item) {
            		$('#ipp2').append('<option class="limpiarpp" value="'+item.id+'">'+item.descripcion+'</option>');
				})        
            });            
        });
	$( ".limpiarpp" ).remove();
			
		});

$("#ipp2").change(function(){
	$("#ipp2 option:selected").each(function () {			
    		var name=$('#ipp2').attr("name");
            elegido=$(this).val();
            var vector=[name,elegido];
            $.get("/menu/registros/clientes/registrar", { vector: vector }, function(data){
            	$.each(data, function(i, item) {
            		$('#ipp3').append('<option class="limpiarpp1" value="'+item.id+'">'+item.descripcion+'</option>');
				})        
            });            
        });
	$( ".limpiarpp1" ).remove();
			
		});

$("#ipp3").change(function(){
	$("#ipp3 option:selected").each(function () {			
    		var name=$('#ipp3').attr("name");
            elegido=$(this).val();
            var vector=[name,elegido];
            $.get("/menu/registros/clientes/registrar", { vector: vector }, function(data){
            	$.each(data, function(i, item) {
            		$('#ipp4').append('<option class="limpiarpp2" value="'+item.id+'">'+item.descripcion+'</option>');
				})        
            });            
        });
	$( ".limpiarpp2" ).remove();
			
		});




$("#ippp1").change(function(){
	$("#ippp1 option:selected").each(function () {			
    		var name=$('#ippp1').attr("name");
            elegido=$(this).val();
            var vector=[name,elegido];
            $.get("/menu/registros/clientes/registrar", { vector: vector }, function(data){
            	$.each(data, function(i, item) {
            		$('#ippp2').append('<option class="limpiarppp" value="'+item.id+'">'+item.descripcion+'</option>');
				})        
            });            
        });
	$( ".limpiarppp" ).remove();
			
		});

$("#ippp2").change(function(){
	$("#ippp2 option:selected").each(function () {			
    		var name=$('#ippp2').attr("name");
            elegido=$(this).val();
            var vector=[name,elegido];
            $.get("/menu/registros/clientes/registrar", { vector: vector }, function(data){
            	$.each(data, function(i, item) {
            		$('#ippp3').append('<option class="limpiarppp1" value="'+item.id+'">'+item.descripcion+'</option>');
				})        
            });            
        });
	$( ".limpiarppp1" ).remove();
			
		});

$("#ippp3").change(function(){
	$("#ippp3 option:selected").each(function () {			
    		var name=$('#ippp3').attr("name");
            elegido=$(this).val();
            var vector=[name,elegido];
            $.get("/menu/registros/clientes/registrar", { vector: vector }, function(data){
            	$.each(data, function(i, item) {
            		$('#ippp4').append('<option class="limpiarppp2" value="'+item.id+'">'+item.descripcion+'</option>');
				})        
            });            
        });
	$( ".limpiarppp2" ).remove();
			
		});



$("#innn11").change(function(){

	$("#innn11 option:selected").each(function () {			
    		var name=$('#innn11').attr("name");
            elegido=$(this).val();
            var vector=[name,elegido];
            $.get("/menu/registros/clientes/registrar", { vector: vector }, function(data){
            	$.each(data, function(i, item) {
            		$('#innn12').append('<option class="limpiarnnn" value="'+item.id+'">'+item.descripcion+'</option>');
				})        
            });            
        });
	$( ".limpiarnnn" ).remove();
			
		});

$("#innn12").change(function(){
	$("#innn12 option:selected").each(function () {			
    		var name=$('#innn12').attr("name");
            elegido=$(this).val();
            var vector=[name,elegido];
            $.get("/menu/registros/clientes/registrar", { vector: vector }, function(data){
            	$.each(data, function(i, item) {
            		$('#innn13').append('<option class="limpiarnnn1" value="'+item.id+'">'+item.descripcion+'</option>');
				})        
            });            
        });
	$( ".limpiarnnn1" ).remove();
			
		});

$("#innn13").change(function(){
	$("#innn13 option:selected").each(function () {			
    		var name=$('#innn13').attr("name");
            elegido=$(this).val();
            var vector=[name,elegido];
            $.get("/menu/registros/clientes/registrar", { vector: vector }, function(data){
            	$.each(data, function(i, item) {
            		$('#innn14').append('<option class="limpiarnnn2" value="'+item.id+'">'+item.descripcion+'</option>');
				})        
            });            
        });
	$( ".limpiarnnn2" ).remove();
			
		});

$("#moficarbtn1").click(function(){

            idCliente=$('#idCliente1').val();
            $.get("/menu/registros/clientes/modificar", { idCliente: idCliente }, function(data){
            	
            	
            		$('#in11').val(data.razon_s);
            		
            		
				      
            });
			
		});








