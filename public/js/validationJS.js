$(document).ready(function() {
    $('#btnSv').click(function(){
var switchtab=0;
for (var i = 1; i <= 15; i++) {
        var input= $('#input'+i).val();
        if (input!="") {
            switchtab=switchtab+1;
        }else{
            switchtab=switchtab+0;
        }        
    }
if (switchtab==5) {
   $("#a2").click();
}else if (switchtab==10) {
    $("#a3").click();
}else if (switchtab==15) {
    $("#a4").click();
}
});
$('#btnCs').click(function(){
    if (switchtab<15) {
        $("#a1").click();
        switchtab=0;
    }
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