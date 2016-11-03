$(function(){
//    $('#close').click(function(event){
//      $('#log')[0].reset();  
//    });
//});


//$('#login').click(function() {
//  $('#AccesoTrue').toggleClass( "visible" );
//});
    
//swal("Lo Siento", "Credenciales Invalidas, Por favor revise nuevamente", "error");  
    $('#cerrar').click(function(){
        var url = "/login"; 
        swal({
            title: "Cerrar Sesión",
            text: "¿Desea salir del sistema?",
            type: "warning",
            showCancelButton: true,
            cancelButtonColor: "#ec1c24",
            cancelButtonText: "No",
            confirmButtonColor: "#6cc644",
            confirmButtonText: "Si",
            closeOnConfirm: false
        },
             function(){
                $(location).attr('href',url);
        });  
    });

});

