$(document).ready(function() 
{


		function capturarCarDepPer(modalId,prefijo,)
		{

			var descripcion= $('#'+prefijo+'Text').val();
			var status= $('#'+prefijo+'Status').val();


			return ({descripcion:descripcion,status:status})	;
		}



		 $('.GuardarModificar').click(function(event) //que debe enviar al controlador : descripcion, status, registro , tabla
		 {
		   
			   var data={
			   				'modalId':'#myModal2',//id del modal modificar
			   				'table':$('#myModal2').attr('data-tab'),//tabla en la cual se realizara la actualizacion del registro
			   				'registry':$('#myModal2').attr('data-reg'),//registro que se desea actualizar
			   				'token':$( "input[name^='_token']" ).val(),//obtiene el token que se enviara por el metodo post
			   				'route':'/menu/registros/actualizar'//es la ruta asociada al controlador laravel : registrosBasicos@actualizar_registrosCD
			   			};



			   var prefijos=['de','ca'];
			   var datosFormulario=null;


			   if(data.table==0||data.table==1||data.table==2||data.table==3)
			   {
			   	
			   	 datosFormulario=capturarCarDepPer(data.modalId,prefijos[data.table],data.token,data.table,data.registry);
			   }

			   ////peticion post 

			   $.post(data.route,{_token:data.token,registry:data.registry,table:data.table,datosFormulario})

			    .done(function(answer)
			    {
			    	alert(answer);
			    })

			    .fail(function()
			    	{	swal("Error Inesperado !!", "Comuniquese con el administrador", "error");});




		  //  var formulario=$('#formulario_1').serialize();
		   
		  // // var _token=$('#csfr-token').attr('content');
		  // // var data=formulario.serialize();
		  // var _token=$( "input[name^='_token']" ).val();//obtiene el valor del token generado para el formulario atraves de la sentencia {{csfr_field()}}
		  // var route='/prueba/json';
		  
		  //  //alert(formulario);
		  
		  //  var data={_token:_token,table:table,registry:registry};
		 

		  //  $.post(route,data,'json')

		  //  .done(function(resultado)
				// {
				
				// 	alert(' Tabla: '+resultado.table+' Registro: '+resultado.registry);
				// })

		  //  .fail(function()
				// {
				// 	swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
				// });





		 });








});