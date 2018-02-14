
///////////////////////////////////////////////////////////////////////////////
/////              //////          //////    ////     ///////          ///////
/////////     //////////          //////             ///////          ///////
////////     //////////          //////////////     ///////          ///////
///////////////////////////////////////////////////////////////////////////
/////////////       CODIGO JAVASCRIT (AJAX) ANGEL TOYO        ////////////
/////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////

$( document ).ready(function() {

/////Deshabilitar accion="" para formularios submit
$( "#log" ).submit(function( event ){
	event.preventDefault();
});
$( "#Formcliente" ).submit(function( event ){
	event.preventDefault();
});
$( "#NewDep" ).submit(function( event ){
	event.preventDefault();
});
$( "#NewCarg" ).submit(function( event ){
	event.preventDefault();
});
$( "#NewPerfil" ).submit(function( event ){
	event.preventDefault();
});
$( "#NewPlan" ).submit(function( event ){
	event.preventDefault();
});
$( ".NewServicio" ).submit(function( event ){
	event.preventDefault();
});
$( "#mPlan" ).submit(function( event ){
	event.preventDefault();
});
$(".DepCarPer").submit(function( event ){
	event.preventDefault();
});
$("#NewEmp").submit(function(event){
	event.preventDefault();
});
$('#updateEmp').submit(function(event){
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


	// $(".modificarResponsable").click(function(){

	// 	///////////BUSCADO BOTON CLICKEADO/////////////	
	// 		ID = $(this).attr("id");///////ID DEL BOTTON MODIFICAR/////////
	// 		idResponsable=$('#idresp'+ID).val();///////TRAER VALOR DEL ID DEL BOTTON MODIFICAR/////////
	// 		$('#Registroid').val(idResponsable);///////ID DEL BOTTON MODIFICAR IGUALADA AL VALOR DEL CAMPO CORRESPONDIENTE AL ID SELECCIONADO/////////	
	// 	///////////PASANDO VARIABLE Y CARGANDO LISTADO CORRESPONDIENTE A LA SELECCION PREVIA Y ESPERANDO DATA COMO RESPUESTA/////////////			        	
	// 		$.get("/menu/registros/clientes/modificar/responsable", {idResponsable: idResponsable}, function(data){
	//     ///////////ASIGNANDO LOS VALORES DEL ARRAY A LOS IMPUT CORRESPONDIENTES DEL MODAL MODIFICAR/////////////		        	
 //        		$('#RpMda1').val(data[0]);
 //        		$('#RpMda2').val(data[1]);
 //        		$('#RpMda3').val(data[4]);
 //        		$('#RpMda4').val(data[3]);
 //        		$('#RpMda5').val(data[2]);	        		
 //        		$('#RpMdaa1').val(data[6]);
 //        		$('#RpMdaa2').val(data[7]);
 //        		$('#RpMdaa3').val(data[8]);
 //        		$('#RpMdaa4').val(data[9]);
 //        		$('#RpMdaa5').val(data[11]);

 //        		///////Data para probar los campos rescibidos por el AJAX////->->->//alert(data);
	//        });

	// });



	// $(".modificarResponsable_clinete").click(function(){

	// 	///////////BUSCADO BOTON CLICKEADO/////////////	
	// 		ID = $(this).attr("id");///////ID DEL BOTTON MODIFICAR/////////
	// 		idResponsable=$('#idresp_c'+ID).val();///////TRAER VALOR DEL ID DEL BOTTON MODIFICAR/////////	
	// 		$('#Responsableid').val(idResponsable);///////ID DEL BOTTON MODIFICAR IGUALADA AL VALOR DEL CAMPO CORRESPONDIENTE AL ID SELECCIONADO/////////	
	// 	///////////PASANDO VARIABLE Y CARGANDO LISTADO CORRESPONDIENTE A LA SELECCION PREVIA Y ESPERANDO DATA COMO RESPUESTA/////////////			        	
	// 		$.get("/menu/registros/clientes/modificar/responsable", {idResponsable: idResponsable}, function(data){
	//     ///////////ASIGNANDO LOS VALORES DEL ARRAY A LOS IMPUT CORRESPONDIENTES DEL MODAL MODIFICAR/////////////		        	
 //        		$('#RpMdn1').val(data[0]);
 //        		$('#RpMdn2').val(data[1]);
 //        		$('#RpMdn3').val(data[4]);
 //        		$('#RpMdn4').val(data[3]);
 //        		$('#RpMdn5').val(data[2]);	        		
 //        		$('#RpMdnn1').val(data[6]);
 //        		$('#RpMdnn2').val(data[7]);
 //        		$('#RpMdnn3').val(data[8]);
 //        		$('#RpMdnn4').val(data[9]);
 //        		$('#RpMdnn5').val(data[11]);

 //        		//alert(data);///////Data para probar los campos resividos por el AJAX////->->->/
	//        });

	// });



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


$(".btnResp").change(function(){alert('hola');});





////////////////////    ACTUALIZAR REGISTROS Y VALIDACION DE REGISTROS IGUALES PARA PERFILES, DPTOS Y CARGOS //////////////////


$('#mDepCarPer').click(function(){
	var desc = $('.descripcion').val();
	var status = $('.status').val();
	var registro_tabla = $('input[name=MIndex]').val();
	var dep_id= $('#DCargo').val();
	var datos = [desc,status,registro_tabla,dep_id]
	var url= "/menu/registros/departamentos/actualizar/DC";
	if (desc != '' && status != ''){
		var posting = $.get(url,{datos:datos},function(resultado){
			//alert(resultado)
			if (resultado[0] == 1) {
				//SWALLLL mensajes de alerta y sucesos
				swal({
					title:'Guardado Exitoso',//Contenido del modal
					text: 'El '+resultado[2]+' fue Guardado Exitosamente',
					type: "success",
					timer:1000,
					showConfirmButton:false,//Eliminar boton de confirmacion
				});
				//Retardo en ejecucion de ruta.
				setTimeout(function(){location.href =resultado[1];},1200); // 3000ms = 3s
			}	
			else if(resultado==0) {
				swal({

					title:'Registro Existente!!!.',//Contenido del modal
					text: 'Este Registro ya existe en nuestra base de datos',
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


///////////////////////// Validacion de registros iguales para Departamentos /////////

$('#btnSv').click(function(){
	var form=$('#NewDep');
	var url= '/menu/registros/departamentos/registrar';
	var data= form.serialize();
	var dep = $('#nomDpto').val();
	var estatus = $('#stDpto').val();
	if (dep != '' && estatus != ''){
		var posting = $.get(url, data,function(resultado){
			if (resultado == 1) {
				//SWALLLL mensajes de alerta y sucesos
				swal({
					title:'Guardado Exitoso',//Contenido del modal
					text: 'El Departamento fue Guardado Exitosamente',
					type: "success",
					timer:1000,
					showConfirmButton:false,//Eliminar boton de confirmacion
				});
				//Retardo en ejecucion de ruta.
				setTimeout(function(){location.href = "/menu/registros/departamentos";},1200); // 3000ms = 3s
			}	
			else {
				swal({

					title:'Registro Existente!!!.',//Contenido del modal
					text: 'Este departamento ya existe',
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

///////////////////////// Validacion de registros iguales para Cargos /////////
$('#saveCargo').click(function(){
	var form=$('#NewCarg');
	var iddep= $('#depID').val();
	var url= '/menu/registros/departamentos/cargos/registrar/'+iddep;
	var data= form.serialize();
	var Carg = $('#nomCgo_').val();
	var estatus = $('#stCgo_').val();
	if (Carg != '' && estatus != ''){
		var posting = $.get(url, data,function(resultado){
			if (resultado == 1) {
				//SWALLLL mensajes de alerta y sucesos
				swal({
					title:'Guardado Exitoso',//Contenido del modal
					text: 'El Cargo fue Guardado Exitosamente',
					type: "success",
					timer:1000,
					showConfirmButton:false,//Eliminar boton de confirmacion
				});
				//Retardo en ejecucion de ruta.
				setTimeout(function(){location.href = "/menu/registros/departamentos/cargos/"+iddep;},1200); // 3000ms = 3s
			}	
			else {
				swal({

					title:'Registro Existente!!!.',//Contenido del modal
					text: 'Este Cargo ya existe',
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
/////////////////////   CARGA DE DATOS EN EL MODAL DE MODIFICAR PLANES    //////////////////////////


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

/////////////////////////////// VALIDAR E INSERTAR REGISTROS PARA EMPLEADOS /////////////////////////////

// $("#saveEmpl").click(function(){
// 	url= "/menu/registros/empleados/agregar"
// 	var form = $("#NewEmp");
// 	nombre=$('#nomEmp1').val();
// 	datos = form.serialize();
// 	var posting = $.post(url,datos,function(resultado){
// 		if (resultado == 1) {
// 			//SWALLLL mensajes de alerta y sucesos
// 			swal({
// 				title:'Guardado Exitoso',//Contenido del modal
// 				text: 'El Empleado fue guardado Exitosamente',
// 				type: "success",
// 				timer:1600,
// 				showConfirmButton:false,//Eliminar boton de confirmacion
// 			});
// 			//Retardo en ejecucion de ruta.
// 			setTimeout(function(){location.href = "/menu/registros/empleados/";},1800); // 3000ms = 3s
// 		}	
// 		else {
// 			swal({

// 				title:'Registro Existente!!!.',//Contenido del modal
// 				text: 'La Cédula, el Rif, o el Usuario ya estan asociados a un empleado, Revise estos datos',
// 				type: "error",
// 				timer:3000,
// 				showConfirmButton:false,//Eliminar boton de confirmacion
// 			});
// 		}					
// 	});
// 	posting.fail(function() {
// 		swal({
// 			title:'Error inesperado!!',//Contenido del modal
// 			text: 'Pongase en contacto con el administrador',
// 			type: "error",
// 			showConfirmButton:true,//Eliminar boton de confirmacion
// 		});
// 	});
// });

// /////////////////////////////// CARGAR DATOS EN MODAL DE MODIFICAR EMPLEADO /////////////////////////////

// $(".modificarEmpleado").click(function(){
// 	var parametro=$(this).attr('data-registro');
// 	datos=[1,parametro]
// 	$.get("/menu/registros/empleados/modificar",{datos:datos},function(respuesta){
// 		$('#nomEmpm1').val(respuesta[0]);
// 		$('#nomEmpm2').val(respuesta[1]);
// 		$('#apellEmpm1').val(respuesta[2]);
// 		$('#apellEmpm2').val(respuesta[3]);
// 		$('#selRifEmpm').val(respuesta[4]);
// 		$('#numRifEmpm').val(respuesta[5]);
// 		$('#selCiEmpm').val(respuesta[6]);
// 		$('#numCiEmpm').val(respuesta[7]);
// 		$('#fnEmpm').val(respuesta[8]);
// 		$('#dptoEmpm').val(respuesta[9]);

// 		$('.opciones').remove();
// 		$( ".region" ).remove();
// 		$( ".estado" ).remove(); 
// 		$( ".municipio" ).remove(); 
		
// //////////////////////// CARGANDO CAMPO DE CARGOS ///////////////////////////////////////////////////////
// 		$("#dptoEmpm option:selected").each(function () {			
//             elegido=$(this).val();
//             var opcion=[1,elegido];
// 			$.get("/menu/registros/empleados/cargar",{opcion:opcion}, function(data){
// 		    	$.each(data, function(i, item) {
// 		    		$('#cgoEmpm').append('<option class="opciones" value="'+item.id+'">'+item.descripcion+'</option>');
// 		    		$('#cgoEmpm').val(respuesta[10]); 
// 				}); 
// 			}); 
// 	    });
// 	    $("#dptoEmpm").change(function(){
// 	    	$('.opciones').remove();
// 	        elegido=$(this).val();
// 	        var vector=elegido;
// 	        id=1;
// 	        datos=[id,elegido]
// 	        $.get("/menu/registros/empleados/consulta",{ datos:datos }, function(data){
// 	        	$.each(data, function(i, item) {
// 	        		$('#cgoEmpm').append('<option class="opciones" value="'+item.id+'">'+item.descripcion+'</option>');
// 				})        
//         	}); 			
// 		});
// 		$('#pdhem').val(respuesta[11]); 
		
// ////////////////////////// CARGANDO CAMPO DE REGIONES /////////////////////////////////////////////////////
		
// 		$("#pdhem option:selected").each(function () {			
//             elegido=$(this).val();
//             var opcion=[2,elegido];
// 			$.get("/menu/registros/empleados/cargar",{opcion:opcion}, function(data){
// 		    	$.each(data, function(i, item) {
// 		    		$('#rgdhem').append('<option class="region" value="'+item.id+'">'+item.descripcion+'</option>');
// 		    		$('#rgdhem').val(respuesta[12]); 
// 				}); 
// 			}); 
// 	    });
// 	    $("#pdhem").change(function(){	
// 	    	$( ".region" ).remove();
// 		    $( ".estado" ).remove();       
// 		    $( ".municipio" ).remove();     
// 		    elegido=$(this).val();
// 		    id=2;
// 		    var datos=[id,elegido];
// 		    $.get("/menu/registros/empleados/consulta",{ datos:datos }, function(data){
// 		    	$.each(data, function(i, item) {
// 		    		$('#rgdhem').append('<option class="region" value="'+item.id+'">'+item.descripcion+'</option>');
// 				});        
// 			});  
// 		});
	     
// //////////////////////////////// CARGANDO CAMPO DE ESTADOS ///////////////////////////////////////////////
// 		$("#rgdhem option:selected").each(function () {			
//             elegido=$(this).val();
//             //alert(elegido)
//             opcion=[3,elegido];
// 			$.get("/menu/registros/empleados/cargar",{opcion:opcion}, function(data){
// 		    	$.each(data, function(i, item) {
// 		    		$('#edodhem').append('<option class="estado" value="'+item.id+'">'+item.descripcion+'</option>');
// 		    		$('#edodhem').val(respuesta[13]); 
// 				});
// 			}); 
// 	    });
// 	    $("#rgdhem").change(function(){	
// 		    $( ".estado" ).remove();       
// 		    $( ".municipio" ).remove();     
// 		    elegido=$(this).val();
// 		    id=3;
// 		    var datos=[id,elegido];
// 		    $.get("/menu/registros/empleados/consulta",{ datos:datos }, function(data){
// 		    	$.each(data, function(i, item) {
// 		    		$('#edodhem').append('<option class="estado" value="'+item.id+'">'+item.descripcion+'</option>');
// 				});        
// 			});  
// 		});
	     
// 	});
// });

////////////////// CARGANDO MODAL DE SERVICIOS OFERTADOS POR EL PLAN (SUBMODULO-CLIENTES) /////
$(".consultarPlan").click(function(){
	var plan=$(this).attr('data-id');
	//alert(plan);
	$('.lista').remove();
	 $.get("/menu/registros/clientes/consultaplan",{plan:plan}, function(respuesta){
	 	$(".servicios").append('<ul class="lista"><li>Hora de Inicio: '+respuesta[0]+'</li><li>Hora de Finalización: '+respuesta[1]+'</li><li>Días de Servicio: '+respuesta[2]+' - '+respuesta[3]+'</li><li>Tipo de Soporte Presencial: '+respuesta[4]+'</li><li>Soportes Presenciales/mes: '+respuesta[5]+'</li><li>Tipo de Soporte Remoto: '+respuesta[6]+'</li><li>Soportes Remotos/mes: '+respuesta[7]+'</li><li>Tipo de Soporte Telefónico: '+respuesta[8]+'</li><li>Soportes Telefónicos/mes: '+respuesta[9]+'</li><li>Tiempo Máximo de Atención: '+respuesta[10]+' horas</li><li class="precio"> BsF. '+respuesta[11]+'</li></ul>');
	 $('.titulo').html('Plan: '+respuesta[12]);
	 });
});

});