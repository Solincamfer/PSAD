$(function(){
    var $switch1 = 0;
//    $('#close').click(function(event){
//      $('#log')[0].reset();  
//    });
//});


//$('#login').click(function() {
//  $('#AccesoTrue').toggleClass( "visible" );
//});
    $('#log2').click(function(event){
        $('#log')[0].reset();               
    });
    
    $('#ico').on('click',function(){
      $('.contenido').toggleClass('ocultar'); 
    });
    
    $('.subMenu').on('click',function(){
        $(this).children('ul').slideToggle();
        if($switch1 == 0){
            $switch1 = 1;
            $(this).addClass('rt1');
            $(this).removeClass('rt2');
        }else{
            $switch1 = 0;
            $(this).addClass('rt2');
            $(this).removeClass('rt1');
        }
    });
    
    $('ul').on('click', function(p){
        p.stopPropagation();  
    });
    
    $('#lnk').click(function(){
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

