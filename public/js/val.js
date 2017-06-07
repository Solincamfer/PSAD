$(document).ready(function(){

/////////////////////////// MANTENER ACTIVO EL LINK DEL SIDEBAR //////////////////////////////////////////////
    ruta=window.location.pathname;
    uso = ruta.substring(16);
    cortar = uso.split("/", 1);

    $(".c").each(function (index) 
        { 
        if(cortar == $(this).attr('data-activo')){
             $(this).addClass("activo");
             $(this).parent().css("display","block")

        }
    });

    $('#login').click(function() {
    $('#AccesoTrue').toggleClass( "visible" );
    });
    $('#log2').click(function(event){
        $('#log')[0].reset();               
    });
    
    $('#ico').on('click',function(){
      $('.contenido').toggleClass('ocultar'); 
    });
    
    $('.subMenu').on('click', function(){
        $(this).children('.chld').slideToggle();
    });

    $('.contenido').on('click',function() {
         $('.subMenu').children('.chld').slideUp();
    });
    
    $('.sidebar').on('click',function() {
        $('.subMenu').children('.chld').slideUp();
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

        if (!e.data.multiple){
            $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
        }
        
        $('.submenu').on('click', function(k){
            var i=0;
            if (i=0){
                $(this).closest('li').find('.c').addClass('activo');
                i++;
            }else{
                --i;
                $(this).closest('li').find('.c').removeClass('activo');
            }
        });
    }
    var accordion = new Accordion($('.accordion'), true);

///////////////////////// MENSAJE DE CIERRE DE SESION ///////////////////////////////////////////////////////

    $('.cs').click(function(){
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
        
    //Funcion que rota la Tarjeta mantenimiento
    $('.side').on('click', function(){
        $('.cardrt').toggleClass('actcd');  
    });
    
    //Funcion para abrir y cerrar el campo busqueda
    var srch = 0;
    $('.bttn-search').on('click', function(){
        if(srch == 0){
            $('#scnt').addClass('abrir01');
            $('#scnt').removeClass('search-cont');
            srch = 1;
        }else{
            $('#scnt').addClass('search-cont');
            $('#scnt').removeClass('abrir01');
            srch = 0;
        }
    });
});

