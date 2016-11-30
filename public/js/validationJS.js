
///////////////////////////////////////////////////////////////////////////////
/////              //////          //////    ////     ///////          ///////
/////////     //////////          //////             ///////          ///////
////////     //////////          //////////////     ///////          ///////
///////////////////////////////////////////////////////////////////////////
/////////////       CODIGO JAVASCRIT (JQUERY) ANGEL TOYO        //////////
/////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////

$(document).ready(function(){ 
////////////////BOTONES VALIDADOS PARA GUARDAR TODOS LOS CAMPOS LLENOS///////////////////////////
/////idInputForm//REPRESENTACION DE TODOS LOS INPUTS DEL FORMULARIO, DIVIDIDOS POR TABS EL NUMERO ADICIONA UN NUMERO DEL 1 AL N SEGUN EXISTENCIA///////////////////////////    
////////idpanelsTabs////////NOMBRE DE LOS TABS TOMADO COMO INDICE ..... EL CODIGO ADICIONA UN NUMERO CRECIENTE DEL 0 AL N SEGUN EXISTENCIA///////////////////////////  
/////////Normal///////LLAMADA A LA FUNCION VALIDADORA DE CAMPOS///////////////////////////  

 $('#btnGuardarCliente').click(function(){  
    var idInputForm=['ip','ipp','ippp','ipppp'];
    var idpanelsTabs='am';
    Normal(this,idInputForm,idpanelsTabs);
 });
 $('#btnModificarCliente').click(function(){
    var idInputForm=['in1','inn','innn1','innnn1'];
    var idpanelsTabs='amm';
    Normal(this,idInputForm,idpanelsTabs);
 });

 $('#btnGuardarResponsable1').click(function(){      
    var idInputForm=['RpSva','RpSvaa'];
    var idpanelsTabs='amr';
    Normal(this,idInputForm,idpanelsTabs);
 });

 $('#btnModificarResponsable1').click(function(){      
    var idInputForm=['RpMda','RpMdaa'];
    var idpanelsTabs='amrm';
    Normal(this,idInputForm,idpanelsTabs);
 });

$('#btnGuardarCategoria').click(function(){
    if (CantidadTabs('Cat')) {        
        $('#btnGuardarCategoria').attr( "type","submit");    
    }
 });
$('#btnModificarCategoria').click(function(){
    if (CantidadTabs('CatM')) {        
        $('#btnModificarCategoria').attr( "type","submit");    
    }
 });

$('#btnGuardarResponsable2').click(function(){      
    var idInputForm=['RpSvn','RpSvnn'];
    var idpanelsTabs='resp';
    Normal(this,idInputForm,idpanelsTabs);
 });

 $('#btnModificarResponsable2').click(function(){      
    var idInputForm=['RpMdn','RpMdnn'];
    var idpanelsTabs='respp';
    Normal(this,idInputForm,idpanelsTabs);
 });
///////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////

function Normal(button,idInputForm,idpanelsTabs){
    var Tabcompletado=0;
    var almacenado=0;
    var prueba=false;
    for (var a =0; a<idInputForm.length; a++) {        
    if (CantidadTabs(idInputForm[a])) {
        //alert('Formulario completo');        
        Tabcompletado=Tabcompletado+1;       
        var next=a+1;        
        $("#"+idpanelsTabs+next).click();  
        color=$('#'+idpanelsTabs+a).css('color');
            //alert(color.toString());
            if (color.toString()=='rgb(169, 68, 66)'){
                prueba=true;
            }
                if (prueba==true){
                }else{
                    if (Tabcompletado===idInputForm.length) { 
                    $(button).attr( "type","submit");            
                    }                       
                }                  
    }else{
        //alert('Tab '+(a+1)+' incompleto');        
    }
    //alert(Tabcompletado);    
  }
   if (Tabcompletado===idInputForm.length) {
    $(button).html('Guardar <i class="fa fa-floppy-o"></i>'); 
  }
 }


function CantidadTabs(nombreId){  
    var acumulador=0;    
    var cantidadId=$('a').length;///////////////////CANTIDAD DE ETIQUETAS A EN LA VISTA////////////////////////
    var idExistentes=0;
    var inputLleno=0;

    for (var i =1; i <= cantidadId; i++) {///////////////////RECORRO CANTIDAD DE ETIQUETAS A EN LA VISTA////////////////////////
                var cantidadTabs =$('#'+nombreId+i).length;///////////////////CONCATENAR VALOR TRAIDO POR EL ARREGLO /////CantidadTabs///////////////////
                var valorInput=$('#'+nombreId+i).val();///////////////////CAPTURAR CADA TEXT TRAIDO POR EL ARREGLO /////CantidadTabs///////////////////
                acumulador=acumulador+cantidadTabs;                 
                if( typeof valorInput !== 'undefined' ) {
                    idExistentes=idExistentes+1;                     
                    if( valorInput !== '' ) {
                    inputLleno=inputLleno+1;                    
                        } 
                }   
              }
            var inputsVacios=idExistentes - inputLleno;
              //alert('Campos existentes:'+idExistentes);
              //alert('Campos llenos:'+inputLleno); 
              //alert('Campos vacios:'+inputsVacios); 
            if (inputsVacios===0) {
                 //alert('Formulario completo');
                 return true; 
            }else{
                //alert('Formulario incompleto');
                return false; 
            }
    }

Validar();
function Validar(){
//////////////VALIDACIONES DE INPUT, SELECT, TEXTAREAS, POR CLASES ASIGNADAS//////////////////////////
$('.Validacion').bootstrapValidator({
        feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
    fields: {
        texts: {
            // EL SELECTOR ES EL NOMBRE DE LA CLASE CON QUE LLAMARAS ESTA VALIDACION EN HTML///
            selector: '.userEmail',
            err: '#messageContainer',
            validators: {
                notEmpty: {
                        ///////VALIDA CAMPO VACIO///////////
                            message: 'Campo vacio.'
                        }
            }
        },
        nombres: {
            // EL SELECTOR ES EL NOMBRE DE LA CLASE CON QUE LLAMARAS ESTA VALIDACION EN HTML///
            selector: '.usernombres',
            err: '#messageContainer',
            validators: {
                notEmpty: {///////VALIDA CAMPO VACIO///////////
                            message: 'Campo vacio.'
                        },
            
            regexp: {///////VALIDA CAMPO SOLO LETRAS///////////
                            regexp: /^[a-z A-Z]+$/,
                            message: 'Solo letras'                            
                        }
                    }
        },
        emails: {
            // EL SELECTOR ES EL NOMBRE DE LA CLASE CON QUE LLAMARAS ESTA VALIDACION EN HTML///
            selector: '.typeEmail',
            err: '#messageContainer',
            validators: {
                notEmpty: {///////VALIDA CAMPO VACIO///////////
                            message: 'Campo vacio.'
                        },
                emailAddress: {///////VALIDA CAMPO TIPO EMAIL@///////////
                    message: 'Solo email'
                            }
            }
        },
        Rifnumbers: {
            // EL SELECTOR ES EL NOMBRE DE LA CLASE CON QUE LLAMARAS ESTA VALIDACION EN HTML///
            selector: '.typeRifNumber',
            err: '#messageContainer',
            validators: {
                notEmpty: {///////VALIDA CAMPO VACIO///////////
                            message: 'Campo vacio.'
                        },
                regexp: {///////VALIDA CAMPO SOLO NUMEROS///////////
                            regexp: /^[0-9]+$/,
                            message: 'Solo numeros'                            
                        },
                stringLength: {///////VALIDA CAMPO CANTIDAD DE CARACTERES///////////
                            min: 10,
                            max: 10,
                            message: '10 numeros.'
                        }
            }
        },
        Tlfnumbers: {
            // EL SELECTOR ES EL NOMBRE DE LA CLASE CON QUE LLAMARAS ESTA VALIDACION EN HTML///
            selector: '.typeTlfNumber',
            err: '#messageContainer',
            validators: {
                notEmpty: {///////VALIDA CAMPO VACIO///////////
                            message: 'Campo vacio.'
                        },
                regexp: {///////VALIDA CAMPO SOLO NUMEROS///////////
                            regexp: /^[0-9]+$/,
                            message: 'Solo numeros'
                        },
                stringLength: {///////VALIDA CAMPO CANTIDAD DE CARACTERES///////////
                            min: 7,
                            max: 7,
                            message: '7 numeros.'
                        }
            }
        },
        DocumentNumbers: {
            // EL SELECTOR ES EL NOMBRE DE LA CLASE CON QUE LLAMARAS ESTA VALIDACION EN HTML///
            selector: '.typeCiNumber',
            err: '#messageContainer',
            validators: {
                notEmpty: {///////VALIDA CAMPO VACIO///////////
                            message: 'Campo vacio.'
                        },
                regexp: {///////VALIDA CAMPO SOLO NUMEROS///////////
                            regexp: /^[0-9]+$/,
                            message: 'Solo numeros'                            
                        },
                stringLength: {///////VALIDA CAMPO CANTIDAD DE CARACTERES///////////
                            min: 8,
                            max: 9,
                            message: 'Entre 8 o 9 numeros.'
                        }
            }
        }
    }

});
};
});