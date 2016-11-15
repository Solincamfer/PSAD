$(document).ready(function() {
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
                tipCon: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9\.-]+$/,
                            message: 'La razon social no puede poseer caracteres especiales.'
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
                regiondf: {
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
                edodf: {
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
                mundf: {
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
                descDirdf: {
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
                paisdc: {
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
                regiondc: {
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
                edodc: {
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
                mundc: {
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
                descDirdc: {
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
                tlflcl: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9\.]+$/,
                            message: 'El nombre del departamento no puede poseer caracteres especiales.'
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
                tlfmvl: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'Campo vacio.'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9\.]+$/,
                            message: 'El nombre del departamento no puede poseer caracteres especiales.'
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
                mail: {
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
                            regexp: /^[a-zA-Z0-9\.-_@]+$/,
                            message: 'El nombre del departamento no puede poseer caracteres especiales.'
                        }
                    }
                },
                comboCgo: {
                    validators: {
                        notEmpty: {
                            message: 'El estatus de cargo no puede ser vacio.'
                        }
                    }
                },
                comboDpto: {
                    validators: {
                        notEmpty: {
                            message: 'El estatus del departamento no puede ser vacio.'
                        }
                    }
                }
            }
        })
});