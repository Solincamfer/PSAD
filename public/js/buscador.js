$( document ).ready( function () 
{
 
  $('.filtro').keyup(function()
  	{
  		var elemento=$(this);
  		var texto=elemento.val();
  		var tabla=elemento.attr('data-tabla');
  		var submodulo=elemento.attr('data-submodulo');
  		var vista=elemento.attr('data-vista');
  		var datos=[tabla,texto,submodulo,vista];
  		var url='/buscarRegistros';


  		$('#areaResultados div').remove();//limpia los registros 
  		$('#paginador ul').remove();//limpia los lins de paginacion


  		$.get(url,{datos:datos})
  		
  		.done(function(retorno)//si el metodo get es ejecutado correctamente
  			{
  				 for (var i = 0; i < retorno[0].length; i++)//recorre los registros 
  				 {
  				 	alert(retorno[0][i].descripcion);
  				 	$('#areaResultados').append('<div class="contMd" id="cont1'+i+'"> <div class="icl" id="cont2'+i+'"> </div> </div> ');	
  				 	for (var f = 0; f < retorno[1].length; f++) //recorre las acciones
  				 	{
  				 		if(retorno[1][f].desci!='status'&& retorno[1][f].desci!='radio')
  				 		{

  				 			alert(retorno[1][f].descripcion);
  				 			if (retorno[1][f].desci=='modificar') 
  				 			{
  				 				
  				 				$('#cont2'+i).append( '<span class="'+retorno[1][f].clase_cont+'">  <a href="'+retorno[1][f].url+'" class="'+retorno[1][f].clase_elem+' " id="'+retorno[1][f].identificador+retorno[0][i].id+'" data-ttl="'+retorno[1][f].descripcion+' "  data-toggle="modal" data-target="'+retorno[1][f].url+'" ><i class="'+retorno[1][f].clase_css+'"></i></a></span> ');
  				 			}
  				 			else if (retorno[1][f].desci!='modificar')
  				 			{
  				 				$('#cont2'+i).append( '<span class="'+retorno[1][f].clase_cont+'">  <a href="'+retorno[1][f].url+'" class="'+retorno[1][f].clase_elem+' " id="'+retorno[1][f].identificador+retorno[0][i].id+'" data-ttl="'+retorno[1][f].descripcion+' " >   <i class="'+retorno[1][f].clase_css+'"></i></a></span> ');
  				 			}
  				 		}

  				 	}
  				 	
  				 }
  				})
  		
  			

  		
  		.fail(function()//si falla la comunicacion
  			{			

  							swal({

								title:'ERROR INESPERADO!!!.',//Contenido del modal
								text: '<p style="font-size: 1.5em;">'+'Comuniquese con el administrador'+'</p>',
								timer:2500,//Tiempo de retardo en ejecucion del modal
								type: "error",
								showConfirmButton:false,//Eliminar boton de confirmacion
								html:true
														
							});

  			});



  		

  	});
 
 
 
 
});