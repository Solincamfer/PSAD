$(function(){

//$('#login').click(function() {
//  $('#AccesoTrue').toggleClass( "visible" );
//});
    $('#log2').click(function(event){
        $('#log')[0].reset();               
    });
    
    $('#ico').on('click',function(){
      $('.contenido').toggleClass('ocultar'); 
    });
    //Funcionalidad del menu en el sidebar
    var Accordion = function(el, multiple) {
        this.el = el || {};
        this.multiple = multiple || false;

        // Variables privadas
        var links = this.el.find('.link');
        // Evento
        links.on('click', {
            el: this.el,
            multiple: this.multiple
        }, this.dropdown)
    }

    Accordion.prototype.dropdown = function(e) {
        var $el = e.data.el;
        $this = $(this),
            $next = $this.next();

        $next.slideToggle();
        $this.parent().toggleClass('open');

        if (!e.data.multiple) {
            $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
        };
    }
    var accordion = new Accordion($('#accordion'), false);
    
    
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

