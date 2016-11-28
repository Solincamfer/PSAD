

/////Desavilitar accion="" para formularios submit
$( "#log" ).submit(function( event ){
	event.preventDefault();
	});
$( "#Formcliente" ).submit(function( event ){
	event.preventDefault();
	});
$( "#Formclientemd" ).submit(function( event ){
	event.preventDefault();
	});
////////////////////
////Validacion + permisologia + AJAX del boton submit de la vista LOGIN////
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
					//SWALLLL mensjes de alerta y sucesos
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
/////////////////////////
///////COMBOS DEPENDIENTES vista cliente
//Direccion comercial
$("#inn1").change(function(){
	$("#inn1 option:selected").each(function () {
			$( ".limpiarnn0" ).remove();	
			$('#inn2 option:selected').val(0);  
	        $('#inn2 option:selected').html(""); 
			$( ".limpiarnn1" ).remove();	
			$('#inn3 option:selected').val(0);  
	        $('#inn3 option:selected').html(""); 
	        $( ".limpiarnn2" ).remove();	
			$('#inn4 option:selected').val(0);  
	        $('#inn4 option:selected').html(""); 
	        var name=$('#inn1').attr("name");
            elegido=$(this).val();
            var vector=[name,elegido];
            $.get("/menu/registros/clientes/registrar", { vector: vector }, function(data){
            	$.each(data, function(i, item) {
            		///////////AGREGAR OPCION SEGUN CANTIDAD DE VALORES HABILITADOS/////////////	
            		$('#inn2').append('<option class="limpiarnn0" value="'+item.id+'">'+item.descripcion+'</option>');
				})        
            });            
        });
});
$("#inn2").change(function(){
	$("#inn2 option:selected").each(function () {
			$( ".limpiarnn1" ).remove();	
			$('#inn3 option:selected').val(0);  
	        $('#inn3 option:selected').html(""); 
	        $( ".limpiarnn2" ).remove();	
			$('#inn4 option:selected').val(0);  
	        $('#inn4 option:selected').html(""); 
    		var name=$('#inn2').attr("name");
            elegido=$(this).val();
            var vector=[name,elegido];
            $.get("/menu/registros/clientes/registrar", { vector: vector }, function(data){
            	$.each(data, function(i, item) {
            		///////////AGREGAR OPCION SEGUN CANTIDAD DE VALORES HABILITADOS/////////////	
            		$('#inn3').append('<option class="limpiarnn1" value="'+item.id+'">'+item.descripcion+'</option>');
				})        
            });            
        });		
});
$("#inn3").change(function(){
	$("#inn3 option:selected").each(function () {
			$( ".limpiarnn2" ).remove();	
			$('#inn4 option:selected').val(0);  
	        $('#inn4 option:selected').html(""); 			
    		var name=$('#inn3').attr("name");
            elegido=$(this).val();
            var vector=[name,elegido];
            $.get("/menu/registros/clientes/registrar", { vector: vector }, function(data){
            	$.each(data, function(i, item) {
            		///////////AGREGAR OPCION SEGUN CANTIDAD DE VALORES HABILITADOS/////////////	
            		$('#inn4').append('<option class="limpiarnnn2" value="'+item.id+'">'+item.descripcion+'</option>');
				})        
            });            
        });
	$( ".limpiarnn2" ).remove();			
});
$("#innn11").change(function(){
	$("#innn11 option:selected").each(function () {
			$( ".limpiarnnn0" ).remove();	
			$('#innn12 option:selected').val(0);  
	        $('#innn12 option:selected').html(""); 
			$( ".limpiarnnn1" ).remove();	
			$('#innn13 option:selected').val(0);  
	        $('#innn13 option:selected').html(""); 
	        $( ".limpiarnnn2" ).remove();	
			$('#innn14 option:selected').val(0);  
	        $('#innn14 option:selected').html(""); 			
    		var name=$('#innn11').attr("name");
            elegido=$(this).val();
            var vector=[name,elegido];
            $.get("/menu/registros/clientes/registrar", { vector: vector }, function(data){
            	$.each(data, function(i, item) {
            		///////////AGREGAR OPCION SEGUN CANTIDAD DE VALORES HABILITADOS/////////////	
            		$('#innn12').append('<option class="limpiarnnn0" value="'+item.id+'">'+item.descripcion+'</option>');
				})        
            });            
        });
	$( ".limpiarnnn" ).remove();			
		});
$("#innn12").change(function(){
	$("#innn12 option:selected").each(function () {	
			$( ".limpiarnnn1" ).remove();	
			$('#innn13 option:selected').val(0);  
	        $('#innn13 option:selected').html(""); 
	        $( ".limpiarnnn2" ).remove();	
			$('#innn14 option:selected').val(0);  
	        $('#innn14 option:selected').html(""); 			
    		var name=$('#innn12').attr("name");
            elegido=$(this).val();
            var vector=[name,elegido];
            $.get("/menu/registros/clientes/registrar", { vector: vector }, function(data){
            	$.each(data, function(i, item) {
            		///////////AGREGAR OPCION SEGUN CANTIDAD DE VALORES HABILITADOS/////////////	
            		$('#innn13').append('<option class="limpiarnnn1" value="'+item.id+'">'+item.descripcion+'</option>');
				})        
            });            
        });
	$( ".limpiarnnn1" ).remove();			
});
$("#innn13").change(function(){
	$("#innn13 option:selected").each(function () {	
	        $( ".limpiarnnn2" ).remove();	
			$('#innn14 option:selected').val(0);  
	        $('#innn14 option:selected').html(""); 			
    		var name=$('#innn13').attr("name");
            elegido=$(this).val();
            var vector=[name,elegido];
            $.get("/menu/registros/clientes/registrar", { vector: vector }, function(data){
            	$.each(data, function(i, item) {
            		///////////AGREGAR OPCION SEGUN CANTIDAD DE VALORES HABILITADOS/////////////	
            		$('#innn14').append('<option class="limpiarnnn2" value="'+item.id+'">'+item.descripcion+'</option>');
				})        
            });            
        });
	$( ".limpiarnnn2" ).remove();			
});
$("#ipp1").change(function(){
	$("#ipp1 option:selected").each(function () {			
    		var name=$('#ipp1').attr("name");
            elegido=$(this).val();
            var vector=[name,elegido];
            $.get("/menu/registros/clientes/registrar", { vector: vector }, function(data){
            	$.each(data, function(i, item) {
            		///////////AGREGAR OPCION SEGUN CANTIDAD DE VALORES HABILITADOS/////////////	
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
            		///////////AGREGAR OPCION SEGUN CANTIDAD DE VALORES HABILITADOS/////////////	
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
            		///////////AGREGAR OPCION SEGUN CANTIDAD DE VALORES HABILITADOS/////////////	
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
            		///////////AGREGAR OPCION SEGUN CANTIDAD DE VALORES HABILITADOS/////////////	
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
            		///////////AGREGAR OPCION SEGUN CANTIDAD DE VALORES HABILITADOS/////////////	
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
            		///////////AGREGAR OPCION SEGUN CANTIDAD DE VALORES HABILITADOS/////////////	
            		$('#ippp4').append('<option class="limpiarppp2" value="'+item.id+'">'+item.descripcion+'</option>');
				})        
            });            
        });
	$( ".limpiarppp2" ).remove();			
});
/////////////////////////////////
///////////LLENADO DEL MODAL MODIFICAR REGISTRO MEDIANTE SU BOTON SUBMIT/////////////	
	$(".tltp").click(function(){
		///////////BUSCADO BOTON CLICKEADO/////////////	
			ID = $(this).attr("id");			
			idCliente=$('#idCliente'+ID).val();	
		///////////BUSCANDO CAMPO HIDDEN DEL CLIENTE SELECCIONADO Y ALMACENANDOLO EN UNA VARIABLE/////////////		
			$('#Clienteid').val(idCliente);			
		///////////PASANDO VARIABLE ID CLIENTE AL CONTROLADOR Y ESPERANDO DATA COMO RESPUESTA/////////////	
	        $.get("/menu/registros/clientes/modificar", {idCliente: idCliente}, function(data){
	    ///////////ASIGNANDO LOS VALORES DEL ARRAY A LOS IMPUT CORRESPONDIENTES DEL MODAL MODIFICAR/////////////	
	        		$('#in11').val(data[0]);
	        		$('#in12').val(data[1]);
	        		$('#in13').val(data[3]);
	        		$('#in14').val(data[2]);
	        		$('#in15').val(data[9]);	        		
	        		$('#inn5').val(data[20]);
	        		$('#innn15').val(data[30]);
	        		$('#innnn11').val(data[6]);
	        		$('#innnn12').val(data[7]);
	        		$('#innnn13').val(data[4]);
	        		$('#innnn14').val(data[5]);
	        		$('#innnn15').val(data[8]);

	    ///////////ASIGNACION AUTOMATICA DE LOS VALORES A LOS COMBO DEPENDIENTES PAISES DEL MODAL MODIFICAR/////////////
	        		$("#inn1 option[value="+ data[11] +"]").attr("selected",true);
	        		$("#innn11 option[value="+ data[21] +"]").attr("selected",true);



	    ///////////VERIFCAR SI LA VARIABLE PAIS EXISTE EN EL VECTOR/////////////
	        		if ($(data[11]).empty) {
	        			///////////RECORRER OPTION DEL COMBO DEPENDIENTE Y REGRESAR VALORES SEGU SELECCIONADO/////////////
		        			$("#inn1 option:selected").each(function () {			
				    		var name=$('#inn1').attr("name");
				            elegido=$(this).val();
				            var vector=[name,elegido];
				        ///////////PASANDO VARIABLE Y CARGANDO LISTADO CORRESPONDIENTE A LA SELECCION PREVIA Y ESPERANDO DATA COMO RESPUESTA/////////////	
				            $.get("/menu/registros/clientes/registrar", { vector: vector }, function(data){
				            	$.each(data, function(i, item) {
				            		$('#inn2').append('<option class="limpiarnn0" value="'+item.id+'">'+item.descripcion+'</option>');
								})        
				            });  
				        });	
		        		///////////LIMPIAR COMBOS DEPENDIENTES DE ESTE/////////////
	        			$('#inn2 option:selected').val(data[13]);  
	        			$('#inn2 option:selected').html(data[14]); 
	        			$("#inn2 option:selected").each(function () {			
				    		var name=$('#inn2').attr("name");
				            elegido=$(this).val();
				            var vector=[name,elegido];
				         ///////////PASANDO VARIABLE Y CARGANDO LISTADO CORRESPONDIENTE A LA SELECCION PREVIA Y ESPERANDO DATA COMO RESPUESTA/////////////	
				            $.get("/menu/registros/clientes/registrar", { vector: vector }, function(data){
				            	$.each(data, function(i, item) {
				            		$('#inn3').append('<option class="limpiarnn1" value="'+item.id+'">'+item.descripcion+'</option>');
								})        
				            });  
				        });	
				        ///////////LIMPIAR COMBOS DEPENDIENTES DE ESTE/////////////
				        $('#inn3 option:selected').val(data[15]);  
	        			$('#inn3 option:selected').html(data[16]); 
	        			$("#inn3 option:selected").each(function () {			
				    		var name=$('#inn3').attr("name");
				            elegido=$(this).val();
				            var vector=[name,elegido];
				         ///////////PASANDO VARIABLE Y CARGANDO LISTADO CORRESPONDIENTE A LA SELECCION PREVIA Y ESPERANDO DATA COMO RESPUESTA/////////////	
				            $.get("/menu/registros/clientes/registrar", { vector: vector }, function(data){
				            	$.each(data, function(i, item) {
				            		$('#inn4').append('<option class="limpiarnn2" value="'+item.id+'">'+item.descripcion+'</option>');
								})        
				            });   
				        });	
				        ///////////LIMPIAR COMBOS DEPENDIENTES DE ESTE/////////////
				        $('#inn4 option:selected').val(data[15]);  
	        			$('#inn4 option:selected').html(data[16]); 
	        		}
	        		if ($(data[21]).empty) {
		        			$("#innn11 option:selected").each(function () {			
				    		var name=$('#innn11').attr("name");
				            elegido=$(this).val();
				            var vector=[name,elegido];
				         ///////////PASANDO VARIABLE Y CARGANDO LISTADO CORRESPONDIENTE A LA SELECCION PREVIA Y ESPERANDO DATA COMO RESPUESTA/////////////	
				           $.get("/menu/registros/clientes/registrar", { vector: vector }, function(data){
				            	$.each(data, function(i, item) {
				            		$('#innn12').append('<option class="limpiarnn0" value="'+item.id+'">'+item.descripcion+'</option>');
								})        
				            });  
				        });	
	        			$('#innn12 option:selected').val(data[23]);  
	        			$('#innn12 option:selected').html(data[24]); 
	        			$("#innn12 option:selected").each(function () {			
				    		var name=$('#innn12').attr("name");
				            elegido=$(this).val();
				            var vector=[name,elegido];
				         ///////////PASANDO VARIABLE Y CARGANDO LISTADO CORRESPONDIENTE A LA SELECCION PREVIA Y ESPERANDO DATA COMO RESPUESTA/////////////	
				           $.get("/menu/registros/clientes/registrar", { vector: vector }, function(data){
				            	$.each(data, function(i, item) {
				            		$('#innn13').append('<option class="limpiarnn1" value="'+item.id+'">'+item.descripcion+'</option>');
								})        
				            });  
				        });	
				        $('#innn13 option:selected').val(data[25]);  
	        			$('#innn13 option:selected').html(data[26]);
	        			$("#innn13 option:selected").each(function () {			
				    		var name=$('#innn13').attr("name");
				            elegido=$(this).val();
				            var vector=[name,elegido];
				         ///////////PASANDO VARIABLE Y CARGANDO LISTADO CORRESPONDIENTE A LA SELECCION PREVIA Y ESPERANDO DATA COMO RESPUESTA/////////////	
				          $.get("/menu/registros/clientes/registrar", { vector: vector }, function(data){
				            	$.each(data, function(i, item) {
				            		$('#innn14').append('<option class="limpiarnn2" value="'+item.id+'">'+item.descripcion+'</option>');
								})        
				            });  
				        });	
				        $('#innn14 option:selected').val(data[27]);  
	        			$('#innn14 option:selected').html(data[28]); 
	        		}         
	        });			
		});
	$(".btnAcc").click(function(){
		swal({
		  title: "Are you sure?",
		  text: "You will not be able to recover this imaginary file!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Yes, delete it!",
		  closeOnConfirm: false
		},
		function(){
		  swal("Deleted!", "Your imaginary file has been deleted.", "success");
		});
    	if ($(this).val()==1) {
    		alert($(this).val());
    	}else{
    		alert($(this).val());
    	}
});








