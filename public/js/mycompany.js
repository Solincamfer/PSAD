$(document).ready(function(){

  $('#comboDireccion').on("change",function(){
    var id=$(this).val();
    var activo=$('.active').data('valor');
    var data=[id,activo];
    if (id!='0') {
      url="/menu/registros/estructura/mostrarEstructuraDireccion";
      $.get(url,{data:data},function(respuesta){
        $('.contRegister').empty();
        $('.contRegister').append(respuesta);
      });
    }
    else {
      url="/menu/registros/estructura/mostrarEstructuraTodos";
      $.get(url,{data:data},function(respuesta){
        $('.contRegister').empty();
        $('.contRegister').append(respuesta);
      });
    }
  });

  $('#nav-dep').on("click",function(){
    
    var data =$('#comboDireccion').val();
    url="/menu/registros/estructura/buscarDepartamentos";
    $.get(url,{data:data},function(respuesta){
      $('.contDep').empty();
      $('.contDep').append(respuesta);
    });
  });
  

  $('#nav-area').on("click",function(){
    var selected = new Array();
    $('#contDep .filtro input:checkbox:checked').each(function(index){
      selected[index]= $(this).val();
    });
    var direccion=$('#comboDireccion').val();
    var data =[direccion,selected];
    url="/menu/registros/estructura/buscarAreas";
    $.get(url,{data:data},function(respuesta){
      $('.contArea').empty();
      $('.contArea').append(respuesta);
    });
  });


  $('#nav-cargo').on("click",function(){
    var departamentos = new Array();
    var areas = new Array();
    $('#contDep .filtro input:checkbox:checked').each(function(index){
      departamentos[index]= $(this).val();
    });
    $('#areas:checked').each(function(index) {
      areas[index]=$(this).val();
    });
    if (areas.length==0) {
      areas = 0;
    }
    var direccion =$('#comboDireccion').val();
    var data=[direccion,departamentos,areas];
    url="/menu/registros/estructura/buscarCargos";
    $.get(url,{data:data},function(respuesta){
      $('.contCarg').empty();
      $('.contCarg').append(respuesta);
    });
  });

  $('#nuevaDireccion').bootstrapValidator({
   feedbackIcons: {
     valid: 'glyphicon glyphicon-ok',
     invalid: 'glyphicon glyphicon-remove',
     validating: 'glyphicon glyphicon-refresh'
   },
   fields: {
     direccion: {
       validators: {
         notEmpty: {
           message: 'Debe indicar el nombre de la direccion'
         }
       }
     },
     comboDireccion: {
       validators: {
         notEmpty: {
           message: 'Seleccione el estatus que tendra la nueva direccion'
         }
       }
     }
   }
  });

  $('#nuevaDireccion').bootstrapValidator().on('submit', function (e) {
    if (e.isDefaultPrevented()) {
    } 
    else {
      e.preventDefault();
      var form= $('#nuevaDireccion').serialize();
      var url="/menu/registros/estructura/ingresarDireccion";
      $.post(url,form,function(respuesta){
        if(respuesta[0]==1){
          swal({
            title:'Guardado Exitoso',//Contenido del modal
            text: 'La dirección fue Guardada Exitosamente',
            type: "success",
            timer:1500,
            showConfirmButton:false,//Eliminar boton de confirmacion
          });
          $('#comboDireccion').append('<option value="'+respuesta[1].id+'">'+respuesta[1].descripcion+'</option>');
          $('#nomDireccion').val('');
          $('#stDireccion').val('');
          $('#nuevaDireccion').data('bootstrapValidator').resetForm();
          $('#button-save').on("click",function(){
            $('#nuevaDireccion').bootstrapValidator('validateField', 'direccion');
            $('#nuevaDireccion').bootstrapValidator('validateField', 'comboDireccion');
          });

        }
        else if(respuesta[0]==0){
          swal({
            title:'Casi Terminamos!!',//Contenido del modal
            text: 'La dirección ya esta registrada',
            type: "error",
            timer:1500,
            showConfirmButton:false,//Eliminar boton de confirmacion
          });
          $('#nuevaDireccion').data('bootstrapValidator').resetForm();
          $('#button-save').on("click",function(){
            $('#nuevaDireccion').bootstrapValidator('validateField', 'direccion');
            $('#nuevaDireccion').bootstrapValidator('validateField', 'comboDireccion');
          });
        }
        
      });
    }
  })
  $('#link-direcciones').on('click', function(event) {
    var form=0;
    var url="/menu/registros/estructura/buscarDirecciones";
    $.post(url,form,function(respuesta){
      $('.contRegisterDireccion').empty();
      $('.contRegisterDireccion').append(respuesta);
    });   
  });



});
