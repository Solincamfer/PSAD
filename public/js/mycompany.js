$(document).ready(function(){

  $('#comboDireccion').on("change",function(){
    var id=$(this).val();
    var activo=$('.active').data('valor');
    var  selected= new Array();
    var areas= new Array();
    $('#contDep .filtro input:checkbox:checked').each(function(index){
      selected[index]= $(this).val();
    });
    $('#contArea .filtro input:checkbox:checked').each(function(index) {
      areas[index]=$(this).val();
    });
    var data=[id,activo,selected,areas];
    if (id!='0') {
      url="/menu/registros/estructura/mostrarEstructuraDireccion";
      $.get(url,{data:data},function(respuesta){
        if (activo=='dep') {
          $('.contDep').empty();
          $('.contDep').append(respuesta);
        }
        else if(activo=='area'){
          $('.contArea').empty();
          $('.contArea').append(respuesta);
        }
        else{
          $('.contCarg').empty();
          $('.contCarg').append(respuesta);
        }
        
      });
    }
    else {
      url="/menu/registros/estructura/mostrarEstructuraTodos";
      $.get(url,{data:data},function(respuesta){
        if (activo=='dep') {
          $('.contDep').empty();
          $('.contDep').append(respuesta);
        }
        else if(activo=='area'){
          $('.contArea').empty();
          $('.contArea').append(respuesta);
        }
        else{
          $('.contCarg').empty();
          $('.contCarg').append(respuesta);
        }
      });
    }
  });

  $('body').on("click","#nav-dep",function(){
    var selected = new Array();
    $('#contDep .filtro input:checkbox:checked').each(function(index){
      selected[index]= $(this).val();
    });
    var idpadre =$('#comboDireccion').val();
    var data=[idpadre,selected];
    url="/menu/registros/estructura/buscarDepartamentos";
    $.get(url,{data:data},function(respuesta){
      $('.contDep').empty();
      $('.contDep').append(respuesta);
    });
  });
  

  $('body').on("click","#nav-area",function(){
    var selected = new Array();
    var areas = new Array();
    $('#contDep .filtro input:checkbox:checked').each(function(index){
      selected[index]= $(this).val();
    });
    $('#contArea .filtro input:checkbox:checked').each(function(index) {
      areas[index]=$(this).val();
    });
    var direccion=$('#comboDireccion').val();
    var data =[direccion,selected,areas];
    url="/menu/registros/estructura/buscarAreas";
    $.get(url,{data:data},function(respuesta){
      console.log(areas);
      $('.contArea').empty();
      $('.contArea').append(respuesta);
    });
  });


  $('body').on("click","#nav-cargo",function(){
    var departamentos = new Array();
    var areas = new Array();
    $('#contDep .filtro input:checkbox:checked').each(function(index){
      departamentos[index]= $(this).val();
    });
    $('#contArea .filtro input:checkbox:checked').each(function(index) {
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
  }).on('success.form.bv',function(e,data){
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
  });
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
  }).on('success.form.bv',function(e,data){
      e.preventDefault();
      var departamentoSelect = new Array();
      var direccionSelect= $('#comboDireccion').val();
      var descripcion=$('#nombreDpto').val();
      var status=$('#statusDpto').val();
      var padre=$('#padredir').val();
      $('#contDep .filtro input:checkbox:checked').each(function(index){
        departamentoSelect[index]= $(this).val();
      });
      if (departamentoSelect.length==0) {
        departamentoSelect=0; 
      }
      var form=[departamentoSelect,direccionSelect,descripcion,status,padre];
      var url="/menu/registros/estructura/ingresarDepartamento";
      $.post(url, {data:form}, function(respuesta) {
        if(respuesta!=0){
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
          $('.contDep').empty();
          $('.contDep').append(respuesta);

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
  });

  $('#newArea').bootstrapValidator({
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
  }).on('success.form.bv',function(e,data){
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
  });


  $('#newCargo').bootstrapValidator({
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
  }).on('success.form.bv',function(e,data){
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
      dataType: 'json',
      data: data,
      cache: false,
      contentType: false,
      processData: false
    })
    .done(function(respuesta) {
        $(ventana[modal]+' input[name=campoD]').val(respuesta.descripcion);
        $(ventana[modal]+' select[name=campoE]').val(respuesta.status);
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

  $('#updateDireccion').bootstrapValidator({
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
  }).on('success.form.bv',function(e,data){
      e.preventDefault();
      var form= new FormData(document.getElementById('updateDireccion'));
      var url="/menu/registros/estructura/actualizarDireccion";
 
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
        console.log(respuesta);
        if(respuesta==0){
            swal({
            title:'Casi Terminamos!!',//Contenido del modal
            text: 'Ya existe una dirección con ese nombre',
            type: "error",
            //timer:1500,
            showConfirmButton:true,//Eliminar boton de confirmacion
            });
          $('#updateDireccion').data('bootstrapValidator').resetForm();
          $('#buttonUpdateDir').on("click",function(){
            $('#updateDireccion').bootstrapValidator('validateField', 'campoD');
            $('#updateDireccion').bootstrapValidator('validateField', 'campoE');
          });

        }
        else{
          swal({
            title:'Actualización Exitosa',//Contenido del modal
            text: 'La dirección fue actualizada exitosamente',
            type: "success",
            timer:1500,
            showConfirmButton:false,//Eliminar boton de confirmacion
          });
          $('.contDep').empty();
          $('.contDep').append(respuesta);
          $('#updateDireccion').data('bootstrapValidator').resetForm();
          $('#buttonUpdateDir').on("click",function(){
            $('#updateDireccion').bootstrapValidator('validateField', 'campoD');
            $('#updateDireccion').bootstrapValidator('validateField', 'campoE');
          });

          setTimeout(function(){location.reload()},2200);
        }
      });   
  });

  $('#updateDepartamento').bootstrapValidator({
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
  }).on('success.form.bv',function(e,data){
      e.preventDefault();
      var form= new FormData(document.getElementById('updateDepartamento'));
      var url="/menu/registros/estructura/actualizarDepartamento";
      var direccionSelect=$('#comboDireccion').val();
      var departamentoSelect=new Array;
      $('#contDep .filtro input:checkbox:checked').each(function(index){
        departamentoSelect[index]= $(this).val();
      });
      if (departamentoSelect.length!=0) {
        $('#contDep .filtro input:checkbox:checked').each(function(index){
          form.append("departamentoSelect["+index+"]",departamentoSelect[index]);
        });
      }
      else{
        form.append("departamentoSelect",[0]);
      }


      form.append('direccionSelect',direccionSelect);
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
        //console.log(respuesta);
        if(respuesta==0){
            swal({
            title:'Casi Terminamos!!',//Contenido del modal
            text: 'Ya existe un departamento con ese nombre dentro de la direccion seleccionada',
            type: "error",
            //timer:1500,
            showConfirmButton:true,//Eliminar boton de confirmacion
            });
          $('#updateDepartamento').data('bootstrapValidator').resetForm();
          $('#buttonUpdateDep').on("click",function(){
            $('#updateDepartamento').bootstrapValidator('validateField', 'campoD');
            $('#updateDepartamento').bootstrapValidator('validateField', 'campoE');
          });
        }
        else{
          swal({
            title:'Actualización Exitosa',//Contenido del modal
            text: 'El departamento fue actualizado exitosamente',
            type: "success",
            timer:1500,
            showConfirmButton:false,//Eliminar boton de confirmacion
          });
          $('.contDep').empty();
          $('.contDep').append(respuesta);
          $('#updateDepartamento').data('bootstrapValidator').resetForm();
          $('#buttonUpdateDep').on("click",function(){
            $('#updateDepartamento').bootstrapValidator('validateField', 'campoD');
            $('#updateDepartamento').bootstrapValidator('validateField', 'campoE');
          });
        }
      });   
  });

  $('#updateArea').bootstrapValidator({
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
           message: 'Seleccione el estatus que tendra la nueva Area'
         }
       }
     }
   }
  }).on('success.form.bv',function(e,data){
      e.preventDefault();
      var form= new FormData(document.getElementById('updateArea'));
      var url="/menu/registros/estructura/actualizarArea";
      var direccionSelect=$('#comboDireccion').val();
      var departamentoSelect=new Array;
      var areaSelect=new Array;
      $('#contDep .filtro input:checkbox:checked').each(function(index){
        departamentoSelect[index]= $(this).val();
      });
      $('#contArea .filtro input:checkbox:checked').each(function(index){
        areaSelect[index]= $(this).val();
      });
      if (areaSelect.length!=0) {
        $('#contArea .filtro input:checkbox:checked').each(function(index){
          form.append("areaSelect["+index+"]",areaSelect[index]);
        });
      }
      else{
        form.append("areaSelect",[0]);
      }
      if (departamentoSelect.length!=0) {
        $('#contArea .filtro input:checkbox:checked').each(function(index){
          form.append("departamentoSelect["+index+"]",departamentoSelect[index]);
        });
      }
      else{
        form.append("departamentoSelect",[0]);
      }

      form.append('direccionSelect',direccionSelect);
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
        //console.log(respuesta);
        if(respuesta==0){
            swal({
            title:'Casi Terminamos!!',//Contenido del modal
            text: 'Ya existe un area con ese nombre dentro del departamento seleccionado',
            type: "error",
            //timer:1500,
            showConfirmButton:true,//Eliminar boton de confirmacion
            });
          $('#updateArea').data('bootstrapValidator').resetForm();
          $('#buttonUpdateAre').on("click",function(){
            $('#updateArea').bootstrapValidator('validateField', 'campoD');
            $('#updateArea').bootstrapValidator('validateField', 'campoE');
          });
        }
        else{
          swal({
            title:'Actualización Exitosa',//Contenido del modal
            text: 'El area fue actualizada exitosamente',
            type: "success",
            timer:1500,
            showConfirmButton:false,//Eliminar boton de confirmacion
          });
          $('.contArea').empty();
          $('.contArea').append(respuesta);
          $('#updateArea').data('bootstrapValidator').resetForm();
          $('#buttonUpdateAre').on("click",function(){
            $('#updateArea').bootstrapValidator('validateField', 'campoD');
            $('#updateArea').bootstrapValidator('validateField', 'campoE');
          });
        }
      });   
  });

  $('#updateCargo').bootstrapValidator({
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
           message: 'Seleccione el estatus que tendra la nueva Area'
         }
       }
     }
   }
  }).on('success.form.bv',function(e,data){
      e.preventDefault();
      var form= new FormData(document.getElementById('updateCargo'));
      var url="/menu/registros/estructura/actualizarCargo";
      var direccionSelect=$('#comboDireccion').val();
      var departamentoSelect=new Array;
      var areaSelect=new Array;
      $('#contDep .filtro input:checkbox:checked').each(function(index){
        departamentoSelect[index]= $(this).val();
      });
      $('#contArea .filtro input:checkbox:checked').each(function(index){
        areaSelect[index]= $(this).val();
      });
      if (areaSelect.length!=0) {
        $('#contArea .filtro input:checkbox:checked').each(function(index){
          form.append("areaSelect["+index+"]",areaSelect[index]);
        });
      }
      else{
        form.append("areaSelect",[0]);
      }
      if (departamentoSelect.length!=0) {
        $('#contArea .filtro input:checkbox:checked').each(function(index){
          form.append("departamentoSelect["+index+"]",departamentoSelect[index]);
        });
      }
      else{
        form.append("departamentoSelect",[0]);
      }
      form.append('direccionSelect',direccionSelect);
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
        //console.log(respuesta);
        if(respuesta==0){
            swal({
            title:'Casi Terminamos!!',//Contenido del modal
            text: 'Ya existe un cargo con ese nombre dentro del area seleccionada',
            type: "error",
            //timer:1500,
            showConfirmButton:true,//Eliminar boton de confirmacion
            });
          $('#updateCargo').data('bootstrapValidator').resetForm();
          $('#buttonUpdateCarg').on("click",function(){
            $('#updateCargo').bootstrapValidator('validateField', 'campoD');
            $('#updateCargo').bootstrapValidator('validateField', 'campoE');
          });
        }
        else{
          swal({
            title:'Actualización Exitosa',//Contenido del modal
            text: 'El cargo fue actualizado exitosamente',
            type: "success",
            timer:1500,
            showConfirmButton:false,//Eliminar boton de confirmacion
          });
          $('.contCarg').empty();
          $('.contCarg').append(respuesta);
          $('#updateCargo').data('bootstrapValidator').resetForm();
          $('#buttonUpdateCarg').on("click",function(){
            $('#updateCargo').bootstrapValidator('validateField', 'campoD');
            $('#updateCargo').bootstrapValidator('validateField', 'campoE');
          });
        }
      });   
  });

//////////////////////////////////////Funcion Check Status ///////////////////////////////////////////////////////

    $('body').on('change','.btnAcc', function () {
      
      ///////////////////////////////Datos para el alert /////////////////////////////////
      var estados=[false,true];
      var valores=[1,0];
      var colores=["#207D07","#EE1919"];
      var acciones=['Habilitar','Deshabilitar'];
      var mensajes=['Habilitado','Deshabilitado'];
      var adjetivo=['La dirección','El departamento','El area','El cargo'];
      ////////////////////////////////////////////////////////////////////////////////////
      var actual=$(this);
      var registry=actual.attr('data-registro');
      var tabla=actual.attr('data-table');
      var valor=actual.val();
      var route='/menu/registros/estructura/status';
      console.log(registry);
      console.log(tabla);

     swal({
        title: "Cambio de status",
        text: "¿Desea "+acciones[valor]+" "+adjetivo[tabla]+" ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor:colores[valor],
        confirmButtonText: acciones[valor]+' '+adjetivo[tabla],
        cancelButtonText: "Cancelar",
        closeOnConfirm: false,
        closeOnCancel: false
       },
       function(isConfirm){
          if(isConfirm)
          {

            $.get(route,{registry:registry,tabla:tabla})
            .done(function(answer)
            {
              if(answer==1)
              {
                swal("Modificacion exitosa !!", adjetivo[tabla]+" ha sido "+mensajes[valor]+" correctamente", "success");
                $('#'+actual.attr('id')).val(valores[valor]);

              }
            })
            .fail(function(){ 
              swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
            });
          }
          else
          {
             swal("Cambio de status cancelado !!", "No se modifico el status de "+adjetivo[tabla], "error");
             actual.prop('checked',estados[valor]);
             $('#'+actual.attr('id')).val(valor);            
          }
      });
    });
});
