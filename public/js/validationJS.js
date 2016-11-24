$(document).ready(function() {

 $('#btnModificarCliente').click(function(){
    var idInputForm=['in1','inn1','innn1','innnn1'];
    var idpanelsTabs='am1';
    Normal(this,idInputForm,idpanelsTabs);
 });

 $('#btnGuardarCliente').click(function(){      
    var idInputForm=['ip','ipp','ippp','ipppp'];
    var idpanelsTabs='am';
    Normal(this,idInputForm,idpanelsTabs);
 });

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
            if (color.toString()=='rgb(169, 68, 66)') {
                prueba=true;
            }
                if (prueba==true){

                }else{
                    if (Tabcompletado===4) { 
                    $(button).attr( "type","submit");            
                    }                       
                }
                  
    }else{
        alert('Tab '+(a+1)+' incompleto');
        
    }
    //alert(Tabcompletado);
    
  }
   if (Tabcompletado===4) {
    $(button).html('Guardar <i class="fa fa-floppy-o"></i>'); 
  }    
  
       
 }
function CantidadTabs(nombreId){  
    var acumulador=0;
    var cantidadId=$('a').length;
    var idExistentes=0;
    var inputLleno=0;

    for (var i =1; i <= cantidadId; i++) {
                var cantidadTabs =$('#'+nombreId+i).length;
                var valorInput=$('#'+nombreId+i).val();
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



$('#btnResp').click(function(){
var switchtab=0;
var anterior=0;
for (var i = 1; i <= 15; i++) {
        var input= $('#input'+i).val();
        if (input!="") {
            switchtab=switchtab+1;
            alert(switchtab);
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
        texts: {
            // All email fields have .userEmail class
            selector: '.userEmail',
            err: '#messageContainer',
            validators: {
                notEmpty: {
                            message: 'Campo vacio.'
                        }
            }
        },
        emails: {
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