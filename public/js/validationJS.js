
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


});
