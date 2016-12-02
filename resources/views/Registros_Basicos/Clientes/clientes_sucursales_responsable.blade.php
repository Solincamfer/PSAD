@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Sucursales - Responsable
        @endsection
        @include('layout/header')
            @include('layout/sidebar')
                <div class="contenido">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 ttlp">
                                <h1>Sucursales - Responsable</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
                    @if($agregar)
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2" align="left">
                                    <a href="/menu/registros/clientes/categorias/sucursales"><button id="btnBk" type="button" class="btnBk" href="#"><i class="fa fa-chevron-left"></i> VOLVER</button></a>
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
                                                    <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $accion->id}}" value="{{$accion->status_ac}}" checked><label for="{{'inchbx'. $accion->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                                </div>
                                            @elseif($accion->staus_ac==0)
                                                <div class="chbx">
                                                    <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $accion->id}}" value="{{$accion->status_ac}}"><label for="{{'inchbx'. $accion->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                                <span class="ttlMd"><input type="radio" name="suc_rsp" id="suc_rsp" value=""> <label for="suc_rsp"><strong>Registro</strong></label></span>
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
                                    <h4 class="modal-title" id="myModalLabel">Agregar Responsable - Sucursales</h4>
                                </div>

                                <form method="post" class="form-horizontal Validacion" action="">
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        <ul class="nav nav-tabs" role="tablist" >
                                            <li role="presentation" class="active"><a href="#dbrc1" id="a1" aria-controls="dbrc1" role="tab" data-toggle="tab">Datos básicos</a></li>
                                            <li role="presentation"><a href="#ctorc" id="a3" aria-controls="ctor3" role="tab" data-toggle="tab" >Contactos</a></li>
                                        </ul>
                                        <div class="container-fluid">
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active" id="dbrc1">
                                                    <div class="container-fluid" id="contrpbdbrc1">
                                                        <div class="row">
                                                            <div class="col-md-5 col-md-offset-1" id="rRpbc1">
                                                                <div class="form-group">
                                                                    <label for="nomRpb1">Nombres</label>
                                                                    <input type="text" name="nomRpb1" class="form-control userEmail" id="input1"><i class="fa fa-user" id="icrc1"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5" id="rRpbc3">
                                                                <div class="form-group">
                                                                    <label for="apellRpb1">Apellidos</label>
                                                                    <input type="text" name="apellRpb1" class="form-control userEmail" id="input3"><i class="fa fa-user-plus" id="icrc3"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">   
                                                            <div id="rRpbc6">
                                                                <div class="col-md-10 col-md-offset-1" id="sp1">
                                                                    <label for="rifRpb">Documento de identidad</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                </div>
                                                                <div class="col-md-4 col-md-offset-1">
                                                                    <div class="form-group row">
                                                                        <select name="selciRpb" class="form-control userEmail" id="selciRpb">
                                                                            <option value="">-</option>
                                                                            <option value="1">G</option>
                                                                        </select><i class="fa fa-clipboard" id="icrc7"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row"> 
                                                                        <input type="text" class="form-control userEmail" name="txtci"><i class="fa fa-address-card-o" id="icrc8"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-10 col-md-offset-1" id="rRpbc8">
                                                                <div class="form-group row">
                                                                    <label for="cgoRpb">Cargo</label>
                                                                    <input type="text" name="cgoRpb" class="form-control userEmail" id="input10"><i class="fa fa-id-badge" id="icrc10"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="ctorc">
                                                    <div class="container-fluid" id="contrpbdbrc3">
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
                                    <h4 class="modal-title" id="myModalLabel2">Modificar Responsable - Sucursales</h4>
                                </div>

                                <form method="post" class="form-horizontal Validacion" action="">
                                    <div class="modal-body">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#dbrcm1" aria-controls="dbrcm1" role="tab" data-toggle="tab">Datos básicos</a></li>
                                            <li role="presentation"><a href="#ctorcm" aria-controls="ctorcm" role="tab" data-toggle="tab">Contactos</a></li>
                                        </ul>
                                        <div class="container-fluid">
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active" id="dbrcm1">
                                                    <div class="container-fluid" id="contrpbdbrcm1">
                                                        <div class="row">                                            
                                                            <div class="col-md-5  col-md-offset-1" id="rRpbcm1">
                                                                <div class="form-group">
                                                                    <label for="nomRpb1">Nombres</label>
                                                                    <input type="text" name="nomRpb1" class="form-control userEmail" id="inputm1"><i class="fa fa-user" id="micrc1"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5" id="rRpbcm3">
                                                                <div class="form-group">
                                                                    <label for="apellRpb1">Apellidos</label>
                                                                    <input type="text" name="apellRpb1" class="form-control userEmail" id="inputm3"><i class="fa fa-user-plus" id="micrc3"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">   
                                                            <div id="rRpbcm6">
                                                                <div class="col-md-10 col-md-offset-1" id="spcm2">
                                                                    <label for="rifRpb">Documento de identidad</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                </div>
                                                                <div class="col-md-4 col-md-offset-1">
                                                                    <div class="form-group">
                                                                        <select name="selciRpb" class="form-control userEmail" id="selciRpbm">
                                                                            <option value="">-</option>
                                                                            <option value="1">G</option>
                                                                        </select><i class="fa fa-clipboard" id="micrc7"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group"> 
                                                                        <input type="text" class="form-control userEmail" name="txtci"><i class="fa fa-address-card-o" id="micrc8"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-10 col-md-offset-1" id="rRpbcm8">
                                                                    <div class="form-group row">    
                                                                        <label for="cgoRpb">Cargo</label>
                                                                        <input type="text" name="cgoRpb" class="form-control userEmail" id="RpMdn5"><i class="fa fa-id-badge" id="micrc10"></i>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div role="tabpanel" class="tab-pane" id="ctorcm">
                                                    <div class="container-fluid" id="contrpbdbrcm3">
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