@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Cliente - Responsable
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                    <div class="contenido">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 ttlp">
                                    <h1>Cliente - Responsable</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
                        @if($agregar)
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-2" align="left">
                                        <a href="#"><button id="btnBk" type="button" class="btnBk"><i class="fa fa-chevron-left"></i> VOLVER</button></a>
                                    </div>
                                    <div class="col-md-2 col-md-offset-3">
                                        <button id="btnAdd" type="button" class="btnAd" data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-plus"></i> AGREGAR</button> 
                                    </div>
                                </div>
                            </div>
                        @endif 
                        @foreach($consulta as $responsable)
                            <div class="contMd" style="">
                                <div class="icl">
                                    @foreach($acciones as $accion)
                                        @if($accion->id!=15)
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
                                        @elseif($accion->id==15)
                                            @if($accion->status_ac==1)
                                            <div class="chbx">
                                                <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $responsable->id}}" value="{{$accion->status_ac}}" checked><label for="{{'inchbx'. $responsable->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                            </div>
                                            @elseif($accion->status_ac==0)
                                            <div class="chbx">
                                                <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $responsable->id}}" value="{{$accion->status_ac}}"><label for="{{'inchbx'. $responsable->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                            </div>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                                <span class="ttlMd"><input type="radio" name="c_rsp" id="c_rsp" value=""> <label for="c_rsp"><strong>{{$responsable->p_nombre." ".$responsable->p_apellido}}</strong></label></span>
                            </div>
                        @endforeach
                        </div>
                        <!-- 	Registro -->


                        <!-- Modal -->
                        @if($agregar)
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Agregar Responsable - Cliente</h4>
                                    </div>
                                    
                                        <form method="post" class="form-horizontal Validacion" action="">
                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <ul class="nav nav-tabs" role="tablist" >
                                                <li role="presentation" class="active"><a href="#dbr1" id="a1" aria-controls="dbr1" role="tab" data-toggle="tab">Datos básicos</a></li>
                                                <li role="presentation"><a href="#ctor" id="a3" aria-controls="ctor" role="tab" data-toggle="tab" >Contactos</a></li>
                                            </ul>
                                            <div class="container-fluid">
                                                <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane active" id="dbr1">
                                                        <div class="container-fluid" id="contrpbdbr1">
                                                            <center><u><p>DATOS BASICOS</p></u></center>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-5  col-md-offset-1" id="rRpb1">
                                                                    <div class="form-group">
                                                                        <label for="nomRpb1">Nombres</label>
                                                                        <input type="text" name="nomRpb1" class="form-control userEmail" id="input1"><i class="fa fa-user" id="icr1"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5" id="rRpb3">
                                                                    <div class="form-group">
                                                                        <label for="apellRpb1">Apellidos</label>
                                                                        <input type="text" name="apellRpb1" class="form-control userEmail" id="input3"><i class="fa fa-user" id="icr3"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">   
                                                                <div id="rRpb6">
                                                                    <div class="col-md-10 col-md-offset-1" id="sp2">
                                                                        <label for="rifRpb">Documento de identidad</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                    </div>
                                                                    <div class="col-md-4 col-md-offset-1">
                                                                        <div class="form-group row">
                                                                            <select name="selciRpb" class="form-control userEmail" id="selciRpb">
                                                                                <option value="">-</option>
                                                                                <option value="1">G</option>
                                                                            </select><i class="fa fa-clipboard" id="icr7"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row"> 
                                                                            <input type="text" class="form-control userEmail" name="txtci"><i class="fa fa-address-card-o" id="icr8"></i>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-10 col-md-offset-1" id="rRpb8">
                                                                    <div class="form-group row">    
                                                                        <label for="cgoRpb">Cargo</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                        <select name="cgoRpb" class="form-control userEmail" id="cgoRpb">
                                                                            <option value="">-</option>
                                                                            <option value="1">caracas</option>
                                                                        </select><i class="fa fa-id-badge" id="icr10"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div role="tabpanel" class="tab-pane" id="ctor">
                                                        <div class="container-fluid" id="contrpbdbr3">
                                                            <center><u><p>CONTACTOS</p></u></center>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-8 col-md-offset-2" id="rRpb9">         <div class="col-md-12">
                                                                        <label for="rifRpb">Telefono movil</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <select name="seltlfRpb" class="form-control userEmail" id="selRifRpb">
                                                                                <option value="">-</option>
                                                                                <option value="1">0414</option>
                                                                            </select><i class="fa fa-hashtag" id="icr11"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group">     
                                                                            <input type="text" class="form-control userEmail" name="numTelclRpb"><i class="fa fa-mobile" id="icr12"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8 col-md-offset-2" id="rRpb10">         <div class="col-md-12">
                                                                        <label for="rifRpb">Telefono fijo</label>
                                                                        <span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <select name="seltlfmRpb" class="form-control userEmail" id="seltlfmRpb">
                                                                                <option value="">-</option>
                                                                                <option value="1">0212</option>
                                                                            </select><i class="fa fa-hashtag" id="icr13"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group">           
                                                                            <input type="text" class="form-control userEmail" name="numTelmvlRpb"><i class="fa fa-phone" id="icr14"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-md-8 col-md-offset-2" id="rRpb11">
                                                                    <label for="mail">Correo Electrónico</label>
                                                                    <input type="text" name="mail2" id="" class="form-control userEmail">
                                                                    <i class="fa fa-envelope" id="icr15"></i>
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
                                                <li role="presentation" class="active"><a href="#dbrm1" aria-controls="dbr1" role="tab" data-toggle="tab">Datos básicos</a></li>
                                                <li role="presentation"><a href="#ctorm" aria-controls="ctor" role="tab" data-toggle="tab">Contactos</a></li>
                                            </ul>
                                            <div class="container-fluid">
                                                <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane active" id="dbrm1">
                                                        <div class="container-fluid" id="contrpbdbrm1">
                                                            <center><u><p>DATOS BASICOS</p></u></center>
                                                            <br>
                                                            <div class="row">                                            
                                                                <div class="col-md-5  col-md-offset-1" id="rRpbm1">
                                                                    <div class="form-group">
                                                                        <label for="nomRpb1">Nombres</label>
                                                                        <input type="text" name="nomRpb1" class="form-control userEmail" id="inputm1"><i class="fa fa-user" id="micr1"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5" id="rRpbm3">
                                                                    <div class="form-group">
                                                                        <label for="apellRpb1">Apellidos</label>
                                                                        <input type="text" name="apellRpb1" class="form-control userEmail" id="inputm3"><i class="fa fa-user" id="micr3"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">   
                                                                <div id="rRpbm6">
                                                                    <div class="col-md-10 col-md-offset-1" id="spm2">
                                                                        <label for="rifRpb">Documento de identidad</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                    </div>
                                                                    <div class="col-md-4 col-md-offset-1">
                                                                        <div class="form-group row">
                                                                            <select name="selciRpb" class="form-control userEmail" id="selciRpbm">
                                                                                <option value="">-</option>
                                                                                <option value="1">G</option>
                                                                            </select><i class="fa fa-clipboard" id="micr7"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row"> 
                                                                            <input type="text" class="form-control userEmail" name="txtci"><i class="fa fa-address-card-o" id="micr8"></i>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-10 col-md-offset-1" id="rRpbm8">
                                                                    <div class="form-group row">    
                                                                        <label for="cgoRpb">Cargo</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                        <select name="cgoRpb" class="form-control userEmail" id="input10">
                                                                            <option value="">-</option>
                                                                            <option value="1">caracas</option>
                                                                        </select><i class="fa fa-id-badge" id="micr10"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div role="tabpanel" class="tab-pane" id="ctorm">
                                                        <div class="container-fluid" id="contrpbdbrm3">
                                                            <center><u><p>CONTACTOS</p></u></center>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-8 col-md-offset-2" id="rRpbm9">         <div class="col-md-12">
                                                                        <label for="rifRpb">Telefono movil</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <select name="selRifRpb" class="form-control userEmail" id="seltlfmmRpb">
                                                                                <option value="">-</option>
                                                                                <option value="1">0414</option>
                                                                            </select><i class="fa fa-hashtag" id="micr11"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group">     
                                                                            <input type="text" class="form-control userEmail" name="numTelclRpb"><i class="fa fa-mobile" id="micr12"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8 col-md-offset-2" id="rRpbm10">         <div class="col-md-12">
                                                                        <label for="rifRpb">Telefono fijo</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            
                                                                            <select name="selRifRpb" class="form-control userEmail" id="seltlflmRpb">
                                                                                <option value="">-</option>
                                                                                <option value="1">0212</option>
                                                                            </select><i class="fa fa-hashtag" id="micr13"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group">           
                                                                            <input type="text" class="form-control userEmail" name="numTelmvlRpb"><i class="fa fa-phone" id="micr14"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-md-8 col-md-offset-2" id="rRpbm11">
                                                                    <label for="mail">Correo Electrónico</label>
                                                                    <input type="text" name="mail2" id="" class="form-control userEmail">
                                                                    <i class="fa fa-envelope" id="micr15"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="bttnMd" id="btnSvm">Guardar <i class="fa fa-floppy-o"></i></button>
                                            <button type="button" class="bttnMd" data-dismiss="modal" id="btnCsm">Cerrar <i class="fa fa-times"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> 
                    </div>   
    @endsection