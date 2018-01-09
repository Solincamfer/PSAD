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

  $('body').on('click','.add-reg', function() {
    var ventana=['#myModalDE','#myModalAR','#myModalCA'];
    var idpadre=$(this).data('reg');
    var modal=$(this).data('modal');
    var padre=$(ventana[modal]+' input[name=padre]').val(idpadre);
    $(ventana[modal]).modal('show');
  });
  

  $('#newDep').bootstrapValidator({
   feedbackIcons: {
     valid: 'glyphicon glyphicon-ok',
     invalid: 'glyphicon glyphicon-remove',
     validating: 'glyphicon glyphicon-refresh'
   },
   fields: {
     departamento: {
       validators: {
         notEmpty: {
           message: 'Debe indicar el nombre del departamento'
         }
       }
     },
     estatusDpto: {
       validators: {
         notEmpty: {
           message: 'Seleccione el estatus que tendra el nuevo departamento'
         }
       }
     }
   }
  });

  $('body').bootstrapValidator().on('submit','#newDep', function (e) {
    if (e.isDefaultPrevented()) {
    } 
    else {
      e.preventDefault();
      var form= new FormData(document.getElementById('newDep'));
      var url="/menu/registros/estructura/ingresarDepartamento";
      $.ajax({
        url: url,
        type: "post",
        dataType: "html",
        data: form,
        cache: false,
        contentType: false,
        processData: false
      })
      .done(function(respuesta){
        if(respuesta==1){
          swal({
            title:'Guardado Exitoso',//Contenido del modal
            text: 'El departamento fue Guardado Exitosamente',
            type: "success",
            timer:1500,
            showConfirmButton:false,//Eliminar boton de confirmacion
          });
          $("#comboDireccion option[value='0']").attr("selected", "selected");
          $('#nombreDpto').val('');
          $('#statusDpto').val('');
          $('#newDep').data('bootstrapValidator').resetForm();
          $('#btnSvDep').on("click",function(){
            $('#newDep').bootstrapValidator('validateField', 'departamento');
            $('#newDep').bootstrapValidator('validateField', 'estatusDpto');
          });

        }
        else if(respuesta==0){
          swal({
            title:'Casi Terminamos!!',//Contenido del modal
            text: 'El departamento ya esta registrado para la direccion seleccionada',
            type: "error",
            timer:1500,
            showConfirmButton:false,//Eliminar boton de confirmacion
          });
          $('#nombreDpto').val('');
          $('#statusDpto').val('');
          $('#newDep').data('bootstrapValidator').resetForm();
          $('#btnSvDep').on("click",function(){
            $('#newDep').bootstrapValidator('validateField', 'departamento');
            $('#newDep').bootstrapValidator('validateField', 'estatusDpto');
          });
        }
      });   
    }
  });

  $('#newArea').bootstrapValidator({
   feedbackIcons: {
     valid: 'glyphicon glyphicon-ok',
     invalid: 'glyphicon glyphicon-remove',
     validating: 'glyphicon glyphicon-refresh'
   },
   fields: {
     area: {
       validators: {
         notEmpty: {
           message: 'Debe indicar el nombre del área'
         }
       }
     },
     comboArea: {
       validators: {
         notEmpty: {
           message: 'Seleccione el estatus que tendra la nueva área'
         }
       }
     }
   }
  });

  $('body').bootstrapValidator().on('submit','#newArea', function (e) {
    if (e.isDefaultPrevented()) {
    } 
    else {
      e.preventDefault();
      var form= new FormData(document.getElementById('newArea'));
      var url="/menu/registros/estructura/ingresarArea";
      $.ajax({
        url: url,
        type: "post",
        dataType: "html",
        data: form,
        cache: false,
        contentType: false,
        processData: false
      })
      .done(function(respuesta){
        if(respuesta==1){
          swal({
            title:'Guardado Exitoso',//Contenido del modal
            text: 'El área fue guardada exitosamente',
            type: "success",
            timer:1500,
            showConfirmButton:false,//Eliminar boton de confirmacion
          });
          $('#nombreArea').val('');
          $('#statusArea').val('');
          $('#newArea').data('bootstrapValidator').resetForm();
          $('#btnSvArea').on("click",function(){
            $('#newArea').bootstrapValidator('validateField', 'area');
            $('#newArea').bootstrapValidator('validateField', 'comboArea');
          });

        }
        else if(respuesta==0){
          swal({
            title:'Casi Terminamos!!',//Contenido del modal
            text: 'El área ya esta registrada para el departamento seleccionada',
            type: "error",
            timer:1500,
            showConfirmButton:false,//Eliminar boton de confirmacion
          });
          $('#nombreArea').val('');
          $('#statusArea').val('');
          $('#newArea').data('bootstrapValidator').resetForm();
          $('#btnSvDep').on("click",function(){
            $('#newArea').bootstrapValidator('validateField', 'area');
            $('#newArea').bootstrapValidator('validateField', 'comboArea');
          });
        }
      });   
    }
  });


  $('#newCargo').bootstrapValidator({
   feedbackIcons: {
     valid: 'glyphicon glyphicon-ok',
     invalid: 'glyphicon glyphicon-remove',
     validating: 'glyphicon glyphicon-refresh'
   },
   fields: {
     cargo: {
       validators: {
         notEmpty: {
           message: 'Debe indicar el nombre del cargo'
         }
       }
     },
     comboCargo: {
       validators: {
         notEmpty: {
           message: 'Seleccione el estatus que tendra el nuevo cargo'
         }
       }
     }
   }
  });

  $('body').bootstrapValidator().on('submit','#newCargo', function (e) {
    if (e.isDefaultPrevented()) {
    } 
    else {
      e.preventDefault();
      var form= new FormData(document.getElementById('newCargo'));
      var url="/menu/registros/estructura/ingresarCargo";
      $.ajax({
        url: url,
        type: "post",
        dataType: "html",
        data: form,
        cache: false,
        contentType: false,
        processData: false
      })
      .done(function(respuesta){
        if(respuesta==1){
          swal({
            title:'Guardado Exitoso',//Contenido del modal
            text: 'El cargo fue guardado exitosamente',
            type: "success",
            timer:1500,
            showConfirmButton:false,//Eliminar boton de confirmacion
          });
          $('#nombreCargo').val('');
          $('#statusCargo').val('');
          $('#newCargo').data('bootstrapValidator').resetForm();
          $('#btnSvCargo').on("click",function(){
            $('#newCargo').bootstrapValidator('validateField', 'cargo');
            $('#newCargo').bootstrapValidator('validateField', 'comboCargo');
          });

        }
        else if(respuesta==0){
          swal({
            title:'Casi Terminamos!!',//Contenido del modal
            text: 'El cargo ya esta registrado para el area seleccionada',
            type: "error",
            timer:1500,
            showConfirmButton:false,//Eliminar boton de confirmacion
          });
          $('#nombreCargo').val('');
          $('#statusCargo').val('');
          $('#newCargo').data('bootstrapValidator').resetForm();
          $('#btnSvDep').on("click",function(){
            $('#newCargo').bootstrapValidator('validateField', 'cargo');
            $('#newCargo').bootstrapValidator('validateField', 'comboCargo');
          });
        }
      });   
    }
  });

//-------------------------- VENTANAS MODIFICAR REGISTROS (direcciones, departamentos, areas y cargos) -------------------------
  
  $('body').on('click', '.modificar', function(event) {
    var ventana=['#myModalDM','#myModalDEM','#myModalARM','#myModalCAM'];
    var modal=$(this).data('modal');
    var padre=$(this).data('padre');
    var registro=$(this).data('reg');
    var data= new FormData;
    $(ventana[modal]+' input[name=padre]').val(padre);
    $(ventana[modal]+' input[name=registro]').val(registro);
    data.append('registro',registro);
    data.append('modal',modal);
    var url= "/menu/registros/estructura/mostrarDatos";
    $.ajax({
      url: url,
      type: 'post',
      dataType: 'html',
      data: data,
      cache: false,
      contentType: false,
      processData: false
    })
    .done(function(respuesta) {
      var response = JSON.parse(respuesta);
        $(ventana[modal]+' input[name=campoD]').val(response.descripcion);
        $(ventana[modal]+' select[name=campoE]').val(response.status);
        $(ventana[modal]).modal('show');
    })
    .fail(function() {
      swal({
            title:'Error Inesperado!!',//Contenido del modal
            text: 'Pongase en contacto con el administrador',
            type: "error",
          });
    })
    .always(function() {
      console.log("complete");
    });
  });
   var ventana=['#myModalDM','#myModalDEM','#myModalARM','#myModalCAM'];

  $('#updateDireccion').bootstrapValidator({
   feedbackIcons: {
     valid: 'glyphicon glyphicon-ok',
     invalid: 'glyphicon glyphicon-remove',
     validating: 'glyphicon glyphicon-refresh'
   },
   fields: {
     campoD: {
       validators: {
         notEmpty: {
           message: 'Debe indicar el nombre de la dirección'
         }
       }
     },
     campoE: {
       validators: {
         notEmpty: {
           message: 'Seleccione el estatus que tendra la nueva dirección'
         }
       }
     }
   }
  });
   $('#myModalDEM').bootstrapValidator({
   feedbackIcons: {
     valid: 'glyphicon glyphicon-ok',
     invalid: 'glyphicon glyphicon-remove',
     validating: 'glyphicon glyphicon-refresh'
   },
   fields: {
     campoD: {
       validators: {
         notEmpty: {
           message: 'Debe indicar el nombre del departamento'
         }
       }
     },
     campoE: {
       validators: {
         notEmpty: {
           message: 'Seleccione el estatus que tendra el nuevo departamento'
         }
       }
     }
   }
  });
  $('#myModalARM').bootstrapValidator({
   feedbackIcons: {
     valid: 'glyphicon glyphicon-ok',
     invalid: 'glyphicon glyphicon-remove',
     validating: 'glyphicon glyphicon-refresh'
   },
   fields: {
     campoD: {
       validators: {
         notEmpty: {
           message: 'Debe indicar el nombre del Area'
         }
       }
     },
     campoE: {
       validators: {
         notEmpty: {
           message: 'Seleccione el estatus que tendra la nueva area'
         }
       }
     }
   }
  });
   $('#myModalCAM').bootstrapValidator({
   feedbackIcons: {
     valid: 'glyphicon glyphicon-ok',
     invalid: 'glyphicon glyphicon-remove',
     validating: 'glyphicon glyphicon-refresh'
   },
   fields: {
     campoD: {
       validators: {
         notEmpty: {
           message: 'Debe indicar el nombre de la dirección'
         }
       }
     },
     campoE: {
       validators: {
         notEmpty: {
           message: 'Seleccione el estatus que tendra la nueva dirección'
         }
       }
     }
   }
  });

  $('body').bootstrapValidator().on('submit','#updateDireccion', function (e) {
    if(e.isDefaultPrevented()) {
    } 
    else {
     e.preventDefault();
      var form= new FormData(document.getElementById('updateDireccion'));
      var url="/menu/registros/estructura/actualizarRegistros";
      $.ajax({
        url: url,
        type: "post",
        dataType: "html",
        data: form,
        cache: false,
        contentType: false,
        processData: false
      })
      .done(function(respuesta){
        $('.contRegisterDireccion').empty();
        $('.contRegisterDireccion').append(respuesta); 
       /* if(respuesta==1){
          swal({
            title:'Guardado Exitoso',//Contenido del modal
            text: 'La dirección fue actualizada exitosamente',
            type: "success",
            timer:1500,
            showConfirmButton:false,//Eliminar boton de confirmacion
          });
          $('#direccionDesc').val('');
          $('#direccionEst').val('');
          $('#updateDireccion').data('bootstrapValidator').resetForm();
          $('#buttonUpdateDir').on("click",function(){
            $('#updateDireccion').bootstrapValidator('validateField', 'area');
            $('#updateDireccion').bootstrapValidator('validateField', 'comboArea');
          });

        }
        else if(respuesta==0){
          swal({
            title:'Casi Terminamos!!',//Contenido del modal
            text: 'El nombre para esta dirección ya se encuentra registrado',
            type: "error",
            timer:1500,
            showConfirmButton:false,//Eliminar boton de confirmacion
          });
         $('#direccionDesc').val('');
          $('#direccionEst').val('');
          $('#updateDireccion').data('bootstrapValidator').resetForm();
          $('#buttonUpdateDir').on("click",function(){
            $('#updateDireccion').bootstrapValidator('validateField', 'area');
            $('#updateDireccion').bootstrapValidator('validateField', 'comboArea');
          });
        }*/
      });   
    }
  });
});
