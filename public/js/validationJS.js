$(document).ready(function() {
    $('#btnSv').click(function(){
var switchtab=0;
var anterior=0;
for (var i = 1; i <= 20; i++) {
        var input= $('#input'+i).val();
        if (input!="") {
            switchtab=switchtab+1;
        }else{
            $( "#btnSv" ).attr( "type","submit"); 
        }        
    }
if (switchtab>=5 && switchtab<10) { 
    $( "#btnSv" ).attr( "type","button");    
    alert(anterior);
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

    $('.Validacion')
        .bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                 txtci: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        },
                        stringLength: {
                            min: 10,
                            max: 40,
                            message: 'La email debe contar como minimo de 10 carateres.'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9\.-_@]+$/,
                            message: 'El caracter especial que utiliza no es valido.'
                        }
                    }
                },
                mail2: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        },
                        stringLength: {
                            min: 10,
                            max: 40,
                            message: 'La email debe contar como minimo de 10 carateres.'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9\.-_@]+$/,
                            message: 'El caracter especial que utiliza no es valido.'
                        }
                    }
                },
                selciRpb: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        }
                    }
                },
                mail2: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        },
                        stringLength: {
                            min: 10,
                            max: 40,
                            message: 'La email debe contar como minimo de 10 carateres.'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9\.-_@]+$/,
                            message: 'El caracter especial que utiliza no es valido.'
                        }
                    }
                },
                mailRpb: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'El nombre del cargo debe ser mayor de 4 letras y menor de 15 letras.'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9\.]+$/,
                            message: 'El nombre del cargo no puede poseer caracteres especiales.'
                        }
                    }
                },
                numTelclRpb: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'El nombre del cargo debe ser mayor de 4 letras y menor de 15 letras.'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9\.]+$/,
                            message: 'El nombre del cargo no puede poseer caracteres especiales.'
                        }
                    }
                },
                numTelmvlRpb: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'El nombre del cargo debe ser mayor de 4 letras y menor de 15 letras.'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9\.]+$/,
                            message: 'El nombre del cargo no puede poseer caracteres especiales.'
                        }
                    }
                },
                selTelclRpb: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        }
                    }
                },
                selTelmvlRpb: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        }
                    }
                },
                cgoRpb: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        }
                    }
                },
                 fnRpb: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        }
                    }
                },
                numCiRpb: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'El nombre del cargo debe ser mayor de 4 letras y menor de 15 letras.'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9\.]+$/,
                            message: 'El nombre del cargo no puede poseer caracteres especiales.'
                        }
                    }
                },
                 selCiRpb: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        }
                    }
                },
                numRifRpb: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'El nombre del cargo debe ser mayor de 4 letras y menor de 15 letras.'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9\.]+$/,
                            message: 'El nombre del cargo no puede poseer caracteres especiales.'
                        }
                    }
                },
                selRifRpb: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        }
                    }
                },
                apellRpb2: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'El nombre del cargo debe ser mayor de 4 letras y menor de 15 letras.'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9\.]+$/,
                            message: 'El nombre del cargo no puede poseer caracteres especiales.'
                        }
                    }
                },
                apellRpb1: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'El nombre del cargo debe ser mayor de 4 letras y menor de 15 letras.'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9\.]+$/,
                            message: 'El nombre del cargo no puede poseer caracteres especiales.'
                        }
                    }
                },
                nomRpb2: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'El nombre del cargo debe ser mayor de 4 letras y menor de 15 letras.'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9\.]+$/,
                            message: 'El nombre del cargo no puede poseer caracteres especiales.'
                        }
                    }
                },
                nomRpb1: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'El nombre del cargo debe ser mayor de 4 letras y menor de 15 letras.'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9\.]+$/,
                            message: 'El nombre del cargo no puede poseer caracteres especiales.'
                        }
                    }
                },
                textCgo: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'El nombre del cargo debe ser mayor de 4 letras y menor de 15 letras.'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9\.]+$/,
                            message: 'El nombre del cargo no puede poseer caracteres especiales.'
                        }
                    }
                },
                rs: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'La razon social debe ser mayor de 4 letras y menor de 15 letras.'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9\.-]+$/,
                            message: 'La razon social no puede poseer caracteres especiales.'
                        }
                    }
                },
                nc: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'El nombre comercial debe ser mayor de 4 letras y menor de 15 letras.'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9\.-]+$/,
                            message: 'El nombre comercial no puede poseer caracteres especiales.'
                        }
                    }
                },
                rif: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Vacio.'
                        }
                    }
                },
                df: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        },
                        stringLength: {
                            min: 9,
                            max: 9,
                            message: 'Ingrese 9 digitos.'
                        },
                        regexp: {
                            regexp: /^[0-9-]+$/,
                            message: 'Solo numeros.'
                        }
                    }
                },
                tipCon: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        }
                    }
                },
                textDpto: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'El nombre del departamento debe ser mayor de 4 letras y menor de 15 letras.'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9\.]+$/,
                            message: 'El nombre del departamento no puede poseer caracteres especiales.'
                        }
                    }
                },
                 paisdf: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        }
                    }
                },
                regiondf: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        }
                    }
                },
                edodf: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        }
                    }
                },
                mundf: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        }
                    }
                },
                descDirdf: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        },
                        stringLength: {
                            min: 10,
                            max: 100,
                            message: 'La direccion debe contar con 10 a 100 carateres.'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9\.#-]+$/,
                            message: 'el tipo de carater que utiliza no es valido.'
                        }
                    }
                },
                paisdc: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        }
                    }
                },
                regiondc: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        }
                    }
                },
                edodc: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        }
                    }
                },
                mundc: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        }
                    }
                },
                descDirdc: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        },
                        stringLength: {
                            min: 10,
                            max: 100,
                            message: 'La direccion debe contar con 10 a 100 carateres.'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9\.#-]+$/,
                            message: 'el tipo de carater que utiliza no es valido.'
                        }
                    }
                },
                tlflcl: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        }
                    }
                },
                tcl: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        },
                        stringLength: {
                            min: 7,
                            max: 7,
                            message: 'El numero solo cuenta con 7 digitos..'
                        },
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'Solo numeros.'
                        }
                    }
                },
                tlfmvl: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        }
                    }
                },
                tmvl: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        },
                        stringLength: {
                            min: 7,
                            max: 7,
                            message: 'El numero solo cuenta con 7 digitos..'
                        },
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'Solo numeros.'
                        }
                    }
                },
                mail: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        },
                        stringLength: {
                            min: 10,
                            max: 40,
                            message: 'La email debe contar como minimo de 10 carateres.'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9\.-_@]+$/,
                            message: 'El caracter especial que utiliza no es valido.'
                        }
                    }
                },
                comboCgo: {
                    validators: {
                         notEmpty: {
                            message: 'Campo vacio.'
                        }
                    }
                },
                comboDpto: {
                    validators: {
                       notEmpty: {
                            message: 'Campo vacio.'
                        }
                    }
                }
                 }
        })


});