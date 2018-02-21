
///////////////////////////////////////////////////////////////////////////////
/////              //////          //////    ////     ///////          ///////
/////////     //////////          //////             ///////          ///////
////////     //////////          //////////////     ///////          ///////
///////////////////////////////////////////////////////////////////////////
/////////////       CODIGO JAVASCRIT (AJAX) ANGEL TOYO        ////////////
/////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////

$( document ).ready(function() {

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
				if (resultado[0] == true  ) {
					//SWALLLL mensjes de alerta y sucesos

							if(resultado[3]==1)
							{
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
							}	
						else if(resultado[3]==0)
						{
							swal({

								title:'Perfil Inhabilitado!!!.',//Contenido del modal
								text: '<p style="font-size: 1.5em;">'+'Pongase en contacto con el administrador'+'</p>',
								timer:2500,//Tiempo de retardo en ejecucion del modal
								type: "error",
								showConfirmButton:false,//Eliminar boton de confirmacion
								html:true
						});
						}		
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

$("#btnLimipiarResponsable1").click(function(){
	$('form-control-feedback').css('display','none');
	Validar();
});



$('.radioEmp').change(function()//asignar perfil a un usuario 
	{
		var anterior=$('#valor_radio');//campo hidden con valor inicial del radio
		var existe=anterior.length;
		if((existe)>0)//si existe el campo hidden que contiene el valor inicial del radio
			{
			  var valor_radio=String(anterior.val());//obtiene el valor inicial del radio button
		
			}

		var usuario=$('#valor_usuario').val();//usuario visualizado en pantalla
	
		var padre=$(this).parent('div').attr('id');//registro seleccionado
		var perfil=$('#radio'+padre).val();//valor del radio button seleccionado


	
		swal({
				title: "Asignacion de permisos",
				text: "Esta seguro que desea asignar al usuario actual, los permisos contenidos en el perfil seleccionado ?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#207D07",
				confirmButtonText: "Asignar permisos",
				cancelButtonText: "No Asignar permisos",
				closeOnConfirm: false,
				closeOnCancel: false
			 },

			 function(isConfirm)
			 {
			 	if(isConfirm)//pasar peticion
			 	{
			 		var url= '/menu/registros/empleados/asignar/perfil';//ruta del controlador 
					var datos=[usuario,perfil];//datos para el controlad
					$.get(url, {datos:datos}, function(actualizar)
					{
				
					   	if(actualizar>0)//si se realiza una actualizacion en la base de datos
						   	{
						   		
						   		swal("Perfil asignado", "Ha concedido al usuario actual los permisos asociados al perfil seleccionado", "success");
						   		$('#valor_radio').val(datos[1]);//actualizar valor del radio button
						   		
						   	}
					   	else//si no se realiza ninguna consulta
						   	{
						   		swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
						   	}
				 	}
				 	);
			    	

			 		 
			 	}
			 	else//si no se desea asignar el perfil
			 	{
			 		if(existe==0)//si no existe
			 		{
			 			$('.ttlMd').prop('checked',false);//reinicia todos los radio button
			 		}
			 		else
			 		{
			 			$('#radio'+valor_radio).prop('checked',true);//regresa el radio button a su estado inicial
			 			//alert($('#radio'+padre_).attr('value'));
			 		}
			 		
			 		swal("Cancelado", "No se asignaron nuevos permisos para este usuario", "error");	
			 	}

			 }
			);
});


////////////////////////////////////// Asociacion de Servicios a Plan /////////////////////////////////
var valorP;
var valorR; 
var valorT;
$(".m_Servicio").click(function(){
	ID = $(this).attr("id");
	idplan=$('#plan').val();	
	datos=[ID,idplan];	        	
	$.get("/menu/registros/planes/consultarservicios",{datos:datos}, function(data){
		if (ID == 's1') {
			$('#horaI').val(data[0]);
			$('#horaF').val(data[1]);
			$('#diaI').val(data[2]);
			$('#diaF').val(data[3]);
			$('#precio').val(data[4]);
		}
		else if(ID== 's2'){
			if (data[0] == 'contabilizado') {
				$('.campo').remove();
				$('#ic1').remove();
				$('#stpc').prop('checked', true)
				$('.icc2').append('<input class="campo" name="campo" type="number" id="p1" placeholder="Cantidad de soportes Presenciales" value="'+data[1]+'"><i id="ic1" class="fa fa-laptop"></i>');
				
			}
			else if(data[0] == 'ilimitado'){
				$('.campo').remove();
				$('#ic1').remove();
				$('#stpe').prop('checked', true)
				$('.icc2').append('<input class="campo" name="campo" type="hidden" id="p2" value="0">');
			}	
			else{
				$('.campo').remove();
				$('#ic1').remove();
				$('#stpc').prop('checked', true)
				$('.icc2').append('<input class="campo" type="number" id="p1" placeholder="Cantidad de soportes Presenciales" value=""><i id="ic1" class="fa fa-laptop"></i>');
			}			
			$('#precioP').val(data[2]);	
			valorP= data[1];

		}
		else if (ID == 's3'){
			if (data[0] == 'contabilizado') {
				$('.campo').remove();
				$('#ic1').remove();
				$('#strc').prop('checked', true)
				$('.icc5').append('<input class="campo" type="number" id="p1" placeholder="Cantidad de soportes Remotos" value="'+data[1]+'"><i id="ic1" class="fa fa-laptop"></i>');
			}
			else if(data[0] == 'ilimitado'){
				$('.campo').remove();
				$('#ic1').remove();
				$('#stri').prop('checked', true)
				$('.icc5').append('<input class="campo" type="hidden" id="p2" value="0">');
			}	
			else{
				$('.campo').remove();
				$('#ic1').remove();
				$('#strc').prop('checked', true)
				$('.icc5').append('<input class="campo" type="number" id="p1" placeholder="Cantidad de soportes Remotos" value=""><i id="ic1" class="fa fa-laptop"></i>');
			}			

			$('#precioR').val(data[2]);
			valorR= data[1];
		}
		else if (ID == 's4') {
			if (data[0] == 'contabilizado') {
				$('.campo').remove();
				$('#ic1').remove();
				$('#sttc').prop('checked', true)
				$('.icc4').append('<input class="campo" type="number" id="p1" placeholder="Cantidad de soportes Telefónicos" value="'+data[1]+'"><i id="ic1" class="fa fa-laptop"></i>');
			}
			else if(data[0] == 'ilimitado'){
				$('.campo').remove();
				$('#ic1').remove();
				$('#stti').prop('checked', true)
				$('.icc4').append('<input class="campo" type="hidden" id="p2" value="0">');
			}	
			else{
				$('.campo').remove();
				$('#ic1').remove();
				$('#sttc').prop('checked', true)
				$('.icc4').append('<input class="campo" type="number" id="p1" placeholder="Cantidad de soportes Telefónicos" value=""><i id="ic1" class="fa fa-laptop"></i>');
			}	

			$('#precioT').val(data[2]);
			valorT= data[1];
		}
		else if (data[0]== 's5') {
			$('#tr').val(data[1]);
			$('#precioTR').val(data[2]);
		}
    });
});


///////////////////////////////////// CAMBIOS DE VALORES DE CHECK PARA LOS SERVICIOS   /////////////////////////////////////////////////

$("input[name=radio1]").change(function () {
	if (valorP==0) {
		valorP = '';
	}
	if ($("input[name=radio1]:checked").val()=='contabilizado') {
		$('#p2').remove();
		$('.icc2').append('<input class="campo" name="campo" type="number" id="p1"  placeholder="Cantidad de Soportes Presenciales"  value="'+valorP+'"><i id="ic1" class="fa fa-laptop"></i>');
	}
	else if ($("input[name=radio1]:checked").val()=='ilimitado'){
		$('#p1').remove();
		$('#ic1').remove();
		$('.icc2').append('<input class="campo" name="campo" type="hidden" id="p2" value="0">');
	}
});

$("input[name=radio2]").change(function () {
	if (valorR==0) {
		valorR = '';
	}
	if ($("input[name=radio2]:checked").val()=='contabilizado') {
		$('#p2').remove();
		$('.icc5').append('<input class="campo" type="number" id="p1"  placeholder="Cantidad de Soportes Remotos"  value="'+valorR+'"><i id="ic1" class="fa fa-laptop"></i>');
	}
	else if ($("input[name=radio2]:checked").val()=='ilimitado'){
		$('#p1').remove();
		$('#ic1').remove();
		$('.icc5').append('<input class="campo" type="hidden" id="p2" value="0">');
	}
});

$("input[name=radio3]").change(function () {
	if (valorT==0) {
		valorT = '';
	}
	if ($("input[name=radio3]:checked").val()=='contabilizado') {
		$('#p2').remove();
		$('.icc4').append('<input class="campo" type="number" id="p1"  placeholder="Cantidad de Soportes Telefónicos"  value="'+valorT+'"><i id="ic1" class="fa fa-laptop"></i>');
	}
	else if ($("input[name=radio3]:checked").val()=='ilimitado'){
		$('#p1').remove();
		$('#ic1').remove();
		$('.icc4').append('<input class="campo" type="hidden" id="p2" value="0">');
	}
});

//////////////////////////////// INSERTAR VALORES EN BD PARA SERVICIO DE HORARIOS ///////////////////////////

$('#saveHorario').click(function(){
	idplan=$('#plan').val();	
	var url= '/menu/registros/planes/servicios/insertar';
	var inicio = $('#horaI').val();
	var final = $('#horaF').val();
	var diaI = $('#diaI').val();
	var diaF = $('#diaF').val();
	var precio= $('#precio').val();
	var formulario =[inicio,final,diaI,diaF,precio];
	var datos = [formulario,idplan,'s1'];
	
	if (inicio != '' && final != '' && diaI != '' && diaF != '' && precio != ''){
		var posting = $.get(url,{datos:datos},function(resultado){
			if (resultado == 1) {
				//SWALLLL mensajes de alerta y sucesos
				swal({
					title:'Guardado Exitoso',//Contenido del modal
					text: 'El Horario fue Guardado Exitosamente para este Plan',
					type: "success",
					timer:1600,
					showConfirmButton:false,//Eliminar boton de confirmacion
				});
				//Retardo en ejecucion de ruta.
				//setTimeout(function(){location.href = "/menu/registros/planeservicios";},1200); // 3000ms = 3s
			}	
			else {
				swal({

					title:'Servicio Corrupto!!!.',//Contenido del modal
					text: 'Este Servicio presenta errores, comuniquese con el administrador',
					type: "error",
					timer:2000,
					showConfirmButton:false,//Eliminar boton de confirmacion
				});
			}						
		});
		posting.fail(function() {
			swal({
				title:'Error inesperado!!',//Contenido del modal
				text: 'Pongase en contacto con el administrador',
				type: "error",
				showConfirmButton:true,//Eliminar boton de confirmacion
			});
		});
	}
});
//////////////////////////////// INSERTAR VALORES EN BD PARA SERVICIO DE SOPORTES PRESENCIALES ///////////////////////////

$('#savePresencial').click(function(){
	idplan=$('#plan').val();	
	var url= '/menu/registros/planes/servicios/insertar';
	var etiqueta = $("input[name=radio1]:checked").val();
	var valor = $('#NewPresencial .campo').val();
	var precio= $('#precioP').val();
	var formulario =[etiqueta,valor,precio];
	var datos = [formulario,idplan,'s2'];
	
	if (etiqueta != '' && valor != '' && precio != ''){
		var posting = $.get(url,{datos:datos},function(resultado){
			if (resultado == 1) {
				//SWALLLL mensajes de alerta y sucesos
				swal({
					title:'Guardado Exitoso',//Contenido del modal
					text: 'El Servicio de Soporte Presencial fue Guardado Exitosamente para este Plan',
					type: "success",
					timer:1600,
					showConfirmButton:false,//Eliminar boton de confirmacion
				});
				//Retardo en ejecucion de ruta.
				//setTimeout(function(){location.href = "/menu/registros/planeservicios";},1200); // 3000ms = 3s
			}	
			else {
				swal({

					title:'Servicio Corrupto!!!.',//Contenido del modal
					text: 'Este Servicio presenta errores, comuniquese con el administrador',
					type: "error",
					timer:2000,
					showConfirmButton:false,//Eliminar boton de confirmacion
				});
			}						
		});
		posting.fail(function() {
			swal({
				title:'Error inesperado!!',//Contenido del modal
				text: 'Pongase en contacto con el administrador',
				type: "error",
				showConfirmButton:true,//Eliminar boton de confirmacion
			});
		});
	}
});
//////////////////////////////// INSERTAR VALORES EN BD PARA SERVICIO DE SOPORTES REMOTOS ///////////////////////////
$('#saveRemoto').click(function(){
	idplan=$('#plan').val();	
	var url= '/menu/registros/planes/servicios/insertar';
	var etiqueta = $("input[name=radio2]:checked").val();
	var valor = $('#NewRemoto .campo').val();
	var precio= $('#precioR').val();
	var formulario =[etiqueta,valor,precio];
	var datos = [formulario,idplan,'s3'];
	
	if (etiqueta != '' && valor != '' && precio != ''){
		var posting = $.get(url,{datos:datos},function(resultado){
			if (resultado == 1) {
				//SWALLLL mensajes de alerta y sucesos
				swal({
					title:'Guardado Exitoso',//Contenido del modal
					text: 'El Servicio de Soporte Remoto fue Guardado Exitosamente para este Plan',
					type: "success",
					timer:1600,
					showConfirmButton:false,//Eliminar boton de confirmacion
				});
				//Retardo en ejecucion de ruta.
				//setTimeout(function(){location.href = "/menu/registros/planeservicios";},1200); // 3000ms = 3s
			}	
			else {
				swal({

					title:'Servicio Corrupto!!!.',//Contenido del modal
					text: 'Este Servicio presenta errores, comuniquese con el administrador',
					type: "error",
					timer:2000,
					showConfirmButton:false,//Eliminar boton de confirmacion
				});
			}						
		});
		posting.fail(function() {
			swal({
				title:'Error inesperado!!',//Contenido del modal
				text: 'Pongase en contacto con el administrador',
				type: "error",
				showConfirmButton:true,//Eliminar boton de confirmacion
			});
		});
	}
});
//////////////////////////////// INSERTAR VALORES EN BD PARA SERVICIO DE SOPORTES TELEFONICOS ///////////////////////////
$('#saveTelefonico').click(function(){
	idplan=$('#plan').val();	
	var url= '/menu/registros/planes/servicios/insertar';
	var etiqueta = $("input[name=radio3]:checked").val();
	var valor = $('#NewTelefonico .campo').val();
	var precio= $('#precioT').val();
	var formulario =[etiqueta,valor,precio];
	var datos = [formulario,idplan,'s4'];
	
	if (etiqueta != '' && valor != '' && precio != ''){
		var posting = $.get(url,{datos:datos},function(resultado){
			if (resultado == 1) {
				//SWALLLL mensajes de alerta y sucesos
				swal({
					title:'Guardado Exitoso',//Contenido del modal
					text: 'El Servicio de Soporte Telefónico fue Guardado Exitosamente para este Plan',
					type: "success",
					timer:1600,
					showConfirmButton:false,//Eliminar boton de confirmacion
				});
				//Retardo en ejecucion de ruta.
				//setTimeout(function(){location.href = "/menu/registros/planeservicios";},1200); // 3000ms = 3s
			}	
			else {
				swal({

					title:'Servicio Corrupto!!!.',//Contenido del modal
					text: 'Este Servicio presenta errores, comuniquese con el administrador',
					type: "error",
					timer:2000,
					showConfirmButton:false,//Eliminar boton de confirmacion
				});
			}						
		});
		posting.fail(function() {
			swal({
				title:'Error inesperado!!',//Contenido del modal
				text: 'Pongase en contacto con el administrador',
				type: "error",
				showConfirmButton:true,//Eliminar boton de confirmacion
			});
		});
	}
});
//////////////////////////////// INSERTAR VALORES EN BD PARA SERVICIO DE TIEMPO DE RESPUESTA /////////////////////////
$('#saveTR').click(function(){
	idplan=$('#plan').val();	
	var url= '/menu/registros/planes/servicios/insertar';
	var etiqueta = $("input[name=radio3]:checked").val();
	var maximo = $('#tr').val();
	var precio= $('#precioTR').val();
	var formulario =[maximo,precio];
	var datos = [formulario,idplan,'s5'];
	
	if (maximo != '' && precio != ''){
		var posting = $.get(url,{datos:datos},function(resultado){
			if (resultado == 1) {
				//SWALLLL mensajes de alerta y sucesos
				swal({
					title:'Guardado Exitoso',//Contenido del modal
					text: 'El Servicio de Tiempo de Respuesta fue Guardado Exitosamente para este Plan',
					type: "success",
					timer:2000,
					showConfirmButton:false,//Eliminar boton de confirmacion
				});
				//Retardo en ejecucion de ruta.
				//setTimeout(function(){location.href = "/menu/registros/planeservicios";},1200); // 3000ms = 3s
			}	
			else {
				swal({

					title:'Servicio Corrupto!!!.',//Contenido del modal
					text: 'Este Servicio presenta errores, comuniquese con el administrador',
					type: "error",
					timer:2000,
					showConfirmButton:false,//Eliminar boton de confirmacion
				});
			}						
		});
		posting.fail(function() {
			swal({
				title:'Error inesperado!!',//Contenido del modal
				text: 'Pongase en contacto con el administrador',
				type: "error",
				showConfirmButton:true,//Eliminar boton de confirmacion
			});
		});
	}
});



/////////////////////////////////////// COMBOS DEPENDIENTES DEL MODAL DE AGREGAR EMPLEADO /////////////////////////////////

$("#dptoEmp").change(function(){
        elegido=$(this).val();
        var vector=elegido;
        id=1;
        datos=[id,elegido]
        $.get("/menu/registros/empleados/consulta",{ datos:datos }, function(data){
        	$.each(data, function(i, item) {
        		///////////AGREGAR OPCION SEGUN SELECCION DE DEPARTAMENTO/////////////	
        		$('#cgoEmp').append('<option class="opcion" value="'+item.id+'">'+item.descripcion+'</option>');
			})        
        });          
	$( ".opcion" ).remove();			
});

$("#pdhe").change(function(){	
    elegido=$(this).val();
    id=2;
    var datos=[id,elegido];
    $.get("/menu/registros/empleados/consulta",{ datos:datos }, function(data){
    	$.each(data, function(i, item) {
    		///////////AGREGAR OPCION SEGUN CANTIDAD DE VALORES HABILITADOS/////////////	
    		$('#rgdhe').append('<option class="region" value="'+item.id+'">'+item.descripcion+'</option>');
		})        
    }); 
    $( ".region" ).remove();
    $( ".estado" ).remove();       
    $( ".municipio" ).remove();      
});

$("#rgdhe").change(function(){	
    elegido=$(this).val();
    id=3;
    var datos=[id,elegido];
    $.get("/menu/registros/empleados/consulta",{ datos:datos }, function(data){
    	$.each(data, function(i, item) {
    		///////////AGREGAR OPCION SEGUN CANTIDAD DE VALORES HABILITADOS/////////////	
    		$('#edodhe').append('<option class="estado" value="'+item.id+'">'+item.descripcion+'</option>');
		})        
    }); 
    $( ".estado" ).remove();  
    $( ".municipio" ).remove();           
});
$("#edodhe").change(function(){	
    elegido=$(this).val();
    id=4;
    var datos=[id,elegido];
    $.get("/menu/registros/empleados/consulta",{ datos:datos }, function(data){
    	$.each(data, function(i, item) {
    		
////////////////////AGREGAR OPCION SEGUN CANTIDAD DE VALORES HABILITADOS////////////////////////////

    		$('#mundhe').append('<option class="municipio" value="'+item.id+'">'+item.descripcion+'</option>');
		})        
    }); 
    $( ".municipio" ).remove();           
});



});