$(document).ready(function() {
    $('#btnSv').click(function(){
var switchtab=0;
var anterior=0;
for (var i = 1; i <= 20; i++) {
        var input= $('#input'+i).val();
        if (input!="") {
            switchtab=switchtab+1;
        }else{
        }        
    }
if (switchtab>=5 && switchtab<10) { 
    $( "#btnSv" ).attr( "type","button");    
    var backtab=2;
    $("#a2").click();
}else if (switchtab>=10 && switchtab<15) {
    $( "#btnSv" ).attr( "type","button"); 
    var backtab=3;
    $("#a3").click();    
}else if (switchtab>=15 && switchtab<20) {
    var backtab=4;
    $( "#btnSv" ).attr( "type","button"); 
    $( "#btnSv" ).html('Guardar<i class="fa fa-floppy-o"></i>');
    $("#a4").click();   
}else if (switchtab==20) { 
$( "#btnSv" ).attr( "type","submit");  
    var backtab=5; 
}
$('#btnAn').click(function(){        
    
    backtab=backtab-1;
    $( "#btnSv" ).html('Siguiente<i class="fa fa-hand-o-right"></i>');
        $("#a"+backtab).click();
    });

});

    $('#btnResp').click(function(){
var switchtab=0;
var anterior=0;
for (var i = 1; i <= 15; i++) {
        var input= $('#input'+i).val();
        if (input!="") {
            switchtab=switchtab+1;
        }else{
        }        
    }
if (switchtab>=4 && switchtab<10) { 
    $( "#btnResp" ).attr( "type","button");    
    var backtab=2;
    $("#a2").click();
}else if (switchtab>=10 && switchtab<15) {
    $( "#btnResp" ).attr( "type","button"); 
    $( "#btnResp" ).html('Guardar<i class="fa fa-floppy-o"></i>');
    var backtab=3;
    $("#a3").click();    
}else if (switchtab==15) { 
$( "#btnResp" ).attr( "type","submit");  
    var backtab=4; 
}
$('#btnAn').click(function(){        
    
    backtab=backtab-1;
    $( "#btnResp" ).html('Siguiente<i class="fa fa-hand-o-right"></i>');
        $("#a"+backtab).click();
    });

});


$('.Validacion').bootstrapValidator({
        feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
    fields: {
        emails: {
            // All email fields have .userEmail class
            selector: '.userEmail',
            err: '#messageContainer',
            validators: {
                notEmpty: {
                            message: 'Campo vacio.'
                        }
            }
        },
        texts: {
            // All email fields have .userEmail class
            selector: '.typeEmail',
            err: '#messageContainer',
            validators: {
                notEmpty: {
                            message: 'Campo vacio.'
                        },
                emailAddress: {
                    message: 'Solo email'
                            }
            }
        },
        Rifnumbers: {
            // All email fields have .userEmail class
            selector: '.typeRifNumber',
            err: '#messageContainer',
            validators: {
                notEmpty: {
                            message: 'Campo vacio.'
                        },
                regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'Solo numeros'
                        },
                stringLength: {
                            min: 10,
                            max: 10,
                            message: '10 numeros.'
                        }
            }
        },
        Tlfnumbers: {
            // All email fields have .userEmail class
            selector: '.typeTlfNumber',
            err: '#messageContainer',
            validators: {
                notEmpty: {
                            message: 'Campo vacio.'
                        },
                regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'Solo numeros'
                        },
                stringLength: {
                            min: 7,
                            max: 7,
                            message: '7 numeros.'
                        }
            }
        },
        DocumentNumbers: {
            // All email fields have .userEmail class
            selector: '.typeCiNumber',
            err: '#messageContainer',
            validators: {
                notEmpty: {
                            message: 'Campo vacio.'
                        },
                regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'Solo numeros'
                        },
                stringLength: {
                            min: 8,
                            max: 9,
                            message: 'Entre 8 o 9 numeros.'
                        }
            }
        }
    }

});
});