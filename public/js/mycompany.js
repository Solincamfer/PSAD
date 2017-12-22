$(document).ready(function(){
  $('#comboDireccion').on("change",function(){
    var data=$(this).val();
    url="/menu/registros/estructura/buscarDepartamentos";
    $.get(url,{data:data},function(respuesta){
        $('.contRegister').empty();
        $('.contRegister').append(respuesta);
    });
  });
});
