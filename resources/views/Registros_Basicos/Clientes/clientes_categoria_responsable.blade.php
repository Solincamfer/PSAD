@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Categoría - Responsable
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                <div class="contenido">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 ttlp">
                                <h1>Categoría - Responsable</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
                    @if($agregar)
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2" align="left">
                                    <a href="/menu/registros/clientes/categoria"><button id="btnBk" type="button" class="btnBk" href="#"><i class="fa fa-chevron-left"></i> VOLVER</button></a>
                                </div>
                                <div class="col-md-2 col-md-offset-3">
                                    <button id="btnAdd" type="button" class="btnAd" data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-plus"></i> AGREGAR</button> 
                                </div>
                            </div>
                        </div>
                    @endif
                            <div class="contMd" style="">
                               <div class="icl">
                                   @foreach($acciones as $accion)
                                       @if($accion->descripcion!="Status")
                                           @if($accion->data_toogle=="modal")
                                           <span class="iclsp">
                                               <a href="#myModal2" class="tltp" data-ttl="{{$accion->descripcion}}" data-toggle="modal" data-target="#myModal2">
                                                   <i class="{{$accion->clase_css}}"></i>
                                               </a>
                                           </span>
                                           @elseif($accion->data_toogle!="modal")
                                           <span class="iclsp">
                                               <a href="{{$accion->url}}" class="tltp" data-ttl="{{$accion->descripcion}}">
                                                   <i class="{{$accion->clase_css}}"></i>
                                               </a>
                                           </span>
                                           @endif
                                       @elseif($accion->descripcion=="Status")
                                           @if($accion->status_ac==1)
                                           <div class="chbx">
                                               <input type="checkbox" class="btnAcc" name="status" id="inchbx1" value="{{$accion->status_ac}}" checked><label for="inchbx1" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                           </div>
                                           @elseif($accion->staus_ac==0)
                                               <div class="chbx">
                                                   <input type="checkbox" class="btnAcc" name="status" id="inchbx2" value="{{$accion->status_ac}}"><label for="inchbx2" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                               </div>
                                           @endif
                                       @endif
                                   @endforeach
                               </div>
                                <p class="ttlMd"><strong>REGISTRO</strong></p>
                            </div>
                      
                    </div>
                    <!--Registro -->


                    <!-- Modal -->
                    @if($agregar)
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Agregar Categoría - Responsable</h4>
                                </div>
                                
                                <form method="post" class="form-horizontal Validacion" action="">
                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <ul class="nav nav-tabs not-active" role="tablist" >
                                                <li role="presentation" class="active"><a href="#dbrc1" id="a1" aria-controls="dbrc1" role="tab" data-toggle="tab">Datos básicos Primarios</a></li>
                                                <li role="presentation"><a href="#dbrc2" id="a2" aria-controls="dbrc2" role="tab" data-toggle="tab">Datos básicos Secundarios</a></li>
                                                <li role="presentation"><a href="#ctorc" id="a3" aria-controls="ctor3" role="tab" data-toggle="tab" >Contactos</a></li>
                                            </ul>
                                            <div class="container-fluid">
                                                <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane active" id="dbrc1">
                                                       <div class="container-fluid" id="contrpbdbrc1">
                                                           <center><u><p>DATOS BASICOS PRIMARIOS</p></u></center>
                                                           <br>
                                                           <div class="row">
                                                               <div class="col-md-5  col-md-offset-1" id="rRpbc1">
                                                                   <div class="form-group">
                                                                       <label for="nomRpb1">1er Nombre</label>
                                                                       <input type="text" name="nomRpb1" class="form-control userEmail" id="input1"><i class="fa fa-user" id="icrc1"></i>
                                                                   </div>
                                                               </div>
                                                               <div class="col-md-5  col-md-offset-1" id="rRpbc2">
                                                                   <div class="form-group">    
                                                                       <label for="nomRpb2">2do Nombre</label>
                                                                       <input type="text" name="nomRpb2" class="form-control userEmail" id="input2"><i class="fa fa-user-plus" id="icrc2"></i>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                           <div class="row">   
                                                               <div class="col-md-5  col-md-offset-1" id="rRpbc3">
                                                                   <div class="form-group">
                                                                       <label for="apellRpb1">1er Apellido</label>
                                                                       <input type="text" name="apellRpb1" class="form-control userEmail" id="input3"><i class="fa fa-user" id="icrc3"></i>
                                                                   </div>
                                                               </div>
                                                               <div class="col-md-5 col-md-offset-1" id="rRpbc4">
                                                                   <div class="form-group">     
                                                                       <label for="apellRpb2">2do Apellido</label>
                                                                       <input type="text" name="apellRpb2" class="form-control userEmail" id="input4"><i class="fa fa-user-plus" id="icrc4"></i>
                                                                   </div> 
                                                               </div>
                                                           </div>
                                                       </div>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane" id="dbrc2">
                                                        <div class="container-fluid" id="contrpbdbrc2">
                                                            <center><u><p>DATOS BASICOS SECUNDARIOS</p></u></center>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-8 col-md-offset-2" id="rRpbc5">
                                                                    <div class="col-md-12" id="spc1">
                                                                        <label for="rifRpb">Rif</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <select name="selRifRpb" class="form-control userEmail" id="selRifRpb">
                                                                                <option value="">-</option>
                                                                                <option value="1">G</option>
                                                                            </select><i class="fa fa-clipboard" id="icrc5"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control userEmail" name="numRifRpb"><i class="fa fa-address-card" id="icrc6"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8 col-md-offset-2" id="rRpbc6">
                                                                    <div class="col-md-12" id="spc2">
                                                                        <label for="rifRpb">Documento de identidad</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <select name="selciRpb" class="form-control userEmail" id="selciRpb">
                                                                                <option value="">-</option>
                                                                                <option value="1">G</option>
                                                                            </select><i class="fa fa-clipboard" id="icrc7"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group"> 
                                                                            <input type="text" class="form-control userEmail" name="txtci"><i class="fa fa-address-card-o" id="icrc8"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>           
                                                            </div>
                                                            <div class="col-md-8 col-md-offset-2" id="rRpbc7">
                                                                <div class="form-group row">
                                                                        <label for="fnRpb">Fecha de nacimiento</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                        <input type="date" name="fnRpb" class="form-control userEmail" id="input9"><i class="fa fa-calendar" id="icrc9"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8 col-md-offset-2" id="rRpbc8">
                                                                <div class="form-group row">
                                                                    <label for="cgoRpb">Cargo</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                    <select name="cgoRpb" class="form-control userEmail" id="input10">
                                                                        <option value="">-</option>
                                                                        <option value="1">caracas</option>
                                                                    </select><i class="fa fa-id-badge" id="icrc10"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane" id="ctorc">
                                                        <div class="container-fluid" id="contrpbdbrc3">
                                                            <center><u><p>CONTACTOS</p></u></center>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-8 col-md-offset-2" id="rRpbc9">           
                                                                    <div class="col-md-12">
                                                                        <label for="rifRpb">Telefono movil</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <select name="seltlfRpb" class="form-control userEmail" id="seltlfRpb">
                                                                                <option value="">-</option>
                                                                                <option value="1">0414</option>
                                                                            </select><i class="fa fa-hashtag" id="icrc11"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group">     
                                                                            <input type="text" class="form-control userEmail" name="numTelclRpb"><i class="fa fa-mobile" id="icrc12"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8 col-md-offset-2" id="rRpbc10">         
                                                                    <div class="col-md-12">
                                                                        <label for="rifRpb">Telefono fijo</label>
                                                                        <span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <select name="seltlfmRpb" class="form-control userEmail" id="seltlfmRpb">
                                                                                <option value="">-</option>
                                                                                <option value="1">0212</option>
                                                                            </select><i class="fa fa-hashtag" id="icrc13"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group">           
                                                                            <input type="text" class="form-control userEmail" name="numTelmvlRpb"><i class="fa fa-phone" id="icrc14"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-md-8 col-md-offset-2" id="rRpbc11">
                                                                    <label for="mail">Correo Electrónico</label>
                                                                    <input type="text" name="mail2" id="" class="form-control userEmail">
                                                                    <i class="fa fa-envelope" id="icrc15"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="bttnMd" id="btnAn">Anterior <i class="fa fa-times"></i></button>
                                                <button type="button" class="bttnMd" id="btnResp">Siguiente <i class="fa fa-hand-o-right"></i></button>
                                            </div>
                                        </form>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <!--Modal Modificar-->
                    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel2">Modificar Responsable - Cliente</h4>
                                </div>

                                <form method="post" class="form-horizontal Validacion" action="">
                                    <div class="modal-body">
                                        <ul class="nav nav-tabs not-active" role="tablist">
                                            <li role="presentation" class="active"><a href="#dbrcm1" aria-controls="dbrcm1" role="tab" data-toggle="tab">Datos básicos Primarios</a></li>
                                            <li role="presentation"><a href="#dbrcm2" aria-controls="dbrcm2" role="tab" data-toggle="tab">Datos básicos Secundarios</a></li>
                                            <li role="presentation"><a href="#ctorcm" aria-controls="ctorcm" role="tab" data-toggle="tab">Contactos</a></li>
                                        </ul>
                                        <div class="container-fluid">
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active" id="dbrcm1">
                                                    <div class="container-fluid" id="contrpbdbrcm1">
                                                        <center><u><p>DATOS BASICOS PRIMARIOS</p></u></center>
                                                        <br>
                                                        <div class="row">                                            
                                                            <div class="col-md-5  col-md-offset-1" id="rRpbcm1">
                                                                <div class="form-group">
                                                                    <label for="nomRpb1">1er Nombre</label>
                                                                    <input type="text" name="nomRpb1" class="form-control userEmail" id="inputm1"><i class="fa fa-user" id="micrc1"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5  col-md-offset-1" id="rRpbcm2">
                                                                <div class="form-group">    
                                                                    <label for="nomRpb2">2do Nombre</label>
                                                                    <input type="text" name="nomRpb2" class="form-control userEmail" id="inputm2"><i class="fa fa-user-plus" id="micrc2"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">   
                                                            <div class="col-md-5  col-md-offset-1" id="rRpbcm3">
                                                                <div class="form-group">
                                                                    <label for="apellRpb1">1er Apellido</label>
                                                                    <input type="text" name="apellRpb1" class="form-control userEmail" id="inputm3"><i class="fa fa-user" id="micrc3"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5 col-md-offset-1" id="rRpbcm4">
                                                                <div class="form-group">  
                                                                    <label for="apellRpb2">2do Apellido</label>
                                                                    <input type="text" name="apellRpb2" class="form-control userEmail" id="inputm4"><i class="fa fa-user-plus" id="micrc4"></i>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="dbrcm2">
                                                    <div class="container-fluid" id="contrpbdbrcm2">
                                                        <center><u><p>DATOS BASICOS SECUNDARIOS</p></u></center>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-8 col-md-offset-2" id="rRpbcm5">
                                                                <div class="col-md-12" id="spcm1">
                                                                    <label for="rifRpb">Rif</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                        <select name="selRifRpb" class="form-control userEmail" id="selRifRpbm">
                                                                            <option value="">-</option>
                                                                            <option value="1">G</option>
                                                                        </select><i class="fa fa-clipboard" id="micrc5"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control userEmail" name="numRifRpb"><i class="fa fa-address-card" id="micrc6"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8 col-md-offset-2" id="rRpbcm6">
                                                                <div class="col-md-12" id="spcm2">
                                                                    <label for="rifRpb">Documento de identidad</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                        <select name="selciRpb" class="form-control userEmail" id="selciRpbm">
                                                                            <option value="">-</option>
                                                                            <option value="1">G</option>
                                                                        </select><i class="fa fa-clipboard" id="micrc7"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <div class="form-group"> 
                                                                        <input type="text" class="form-control userEmail" name="txtci"><i class="fa fa-address-card-o" id="micrc8"></i>
                                                                    </div>
                                                                </div>
                                                            </div>                                                               
                                                        </div>
                                                        <div class="col-md-8 col-md-offset-2" id="rRpbcm7">
                                                            <div class="form-group row">       
                                                                <label for="fnRpb">Fecha de nacimiento</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                <input type="date" name="fnRpb" class="form-control userEmail" id="fnRpb"><i class="fa fa-calendar" id="micrc9"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8 col-md-offset-2" id="rRpbcm8">
                                                            <div class="form-group row">    
                                                                <label for="cgoRpb">Cargo</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                <select name="cgoRpb" class="form-control userEmail" id="inputm10">
                                                                    <option value="">-</option>
                                                                    <option value="1">caracas</option>
                                                                </select><i class="fa fa-id-badge" id="micrc10"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="ctorcm">
                                                    <div class="container-fluid" id="contrpbdbrcm3">
                                                        <center><u><p>CONTACTOS</p></u></center>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-8 col-md-offset-2" id="rRpbcm9">         
                                                                <div class="col-md-12">
                                                                    <label for="rifRpb">Telefono movil</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                        <select name="selRifRpb" class="form-control userEmail" id="seltlfmmRpb">
                                                                            <option value="">-</option>
                                                                            <option value="1">0414</option>
                                                                        </select><i class="fa fa-hashtag" id="micrc11"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <div class="form-group">     
                                                                        <input type="text" class="form-control userEmail" name="numTelclRpb"><i class="fa fa-mobile" id="micrc12"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8 col-md-offset-2" id="rRpbcm10">         
                                                                <div class="col-md-12">
                                                                    <label for="rifRpb">Telefono fijo</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                        <select name="selRifRpb" class="form-control userEmail" id="seltlflmRpb">
                                                                            <option value="">-</option>
                                                                            <option value="1">0212</option>
                                                                        </select><i class="fa fa-hashtag" id="micrc13"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <div class="form-group">           
                                                                        <input type="text" class="form-control userEmail" name="numTelmvlRpb"><i class="fa fa-phone" id="micrc14"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-md-8 col-md-offset-2" id="rRpbcm11">
                                                                <label for="mail">Correo Electrónico</label>
                                                                <input type="text" name="mail2" id="" class="form-control userEmail">
                                                                <i class="fa fa-envelope" id="micrc15"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="bttnMd" id="btnSv">Guardar <i class="fa fa-floppy-o"></i></button>
                                        <button type="button" class="bttnMd" data-dismiss="modal" id="btnCs">Cerrar <i class="fa fa-times"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> 
                </div>   
    @endsection