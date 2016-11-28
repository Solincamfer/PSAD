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
                                                    <a href="#myModal2" class="tltp" data-ttl="{{$accion->descripcion}}" id="m{{$responsable->id}}" data-toggle="modal" data-target="#myModal2"> 
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
                                            @if($responsable->statusR==1)
                                            <div class="chbx">
                                                <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $responsable->id}}" value="{{$accion->status_ac}}" checked><label for="{{'inchbx'. $responsable->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                            </div>
                                            @elseif($responsable->statusR==0)
                                            <div class="chbx">
                                                <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $responsable->id}}" value="{{$accion->status_ac}}"><label for="{{'inchbx'. $responsable->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                            </div>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                                <input type="hidden" name="idresp{{$responsable->id}}" value="{{$responsable->id}}" id="idrespm{{$responsable->id}}">
                                @if($responsable->encargado==1)
                                    <span class="ttlMd"><input type="radio" name="c_rsp" id="c_rsp" value="{{$responsable->encargado}}" checked> 
                                    <label for="c_rsp"><strong>{{$responsable->p_nombre." ".$responsable->p_apellido}}</strong></label></span>
                                @else
                                     <span class="ttlMd"><input type="radio" name="c_rsp" id="c_rsp" value="{{$responsable->encargado}}" > 
                                    <label for="c_rsp"><strong>{{$responsable->p_nombre." ".$responsable->p_apellido}}</strong></label></span>
                                @endif
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
                                    
                                        <form method="post" class="form-horizontal Validacion" action="/menu/registros/clientes/responsable/insertar/{{$extra}}">
                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <ul class="nav nav-tabs" role="tablist" >
                                                <li role="presentation" class="active"><a href="#dbr1" id="amr0" aria-controls="dbr1" role="tab" data-toggle="tab">Datos básicos</a></li>
                                                <li role="presentation"><a href="#ctor" id="amr1" aria-controls="ctor" role="tab" data-toggle="tab" >Contactos</a></li>
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
                                                                        <input type="text" name="nomRpb1" class="form-control usernombres" id="RpSva1"><i class="fa fa-user" id="icr1"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5" id="rRpb3">
                                                                    <div class="form-group">
                                                                        <label for="apellRpb1">Apellidos</label>
                                                                        <input type="text" name="apellRpb1" class="form-control usernombres" id="RpSva2"><i class="fa fa-user-plus" id="icr3"></i>
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
                                                                            <select name="selciRpb" class="form-control userEmail" id="RpSva3">
                                                                                <option value="">-</option>
                                                                                @foreach($datosC1 as $TipoCedula)
                                                                                    <option value="{{$TipoCedula->id}}">{{$TipoCedula->descripcion}}</option>
                                                                                @endforeach
                                                                            </select><i class="fa fa-clipboard" id="icr7"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row"> 
                                                                            <input type="text" class="form-control typeCiNumber" name="txtci" id="RpSva4"><i class="fa fa-address-card-o" id="icr8"></i>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-10 col-md-offset-1" id="rRpb8">
                                                                    <div class="form-group row">    
                                                                        <label for="cgoRpb">Cargo</label>
                                                                        <input type="text" name="cgoRpb" class="form-control userEmail" id="RpSva5"><i class="fa fa-id-badge" id="icr10"></i>
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
                                                                            <select name="seltlfRpb" class="form-control userEmail" id="RpSvaa1">
                                                                                <option value="">-</option>
                                                                                 @foreach($datosC2 as $CodigoMovil)
                                                                                    <option value="{{$CodigoMovil->id}}">{{$CodigoMovil->descripcion}}</option>
                                                                                @endforeach
                                                                            </select><i class="fa fa-hashtag" id="icr11"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group">     
                                                                            <input type="text" class="form-control typeTlfNumber" name="numTelclRpb" id="RpSvaa2"><i class="fa fa-mobile" id="icr12"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8 col-md-offset-2" id="rRpb10">         <div class="col-md-12">
                                                                        <label for="rifRpb">Telefono fijo</label>
                                                                        <span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <select name="seltlfmRpb" class="form-control userEmail" id="RpSvaa3">
                                                                                <option value="">-</option>
                                                                                  @foreach($datosC3 as $CodigoLocal)
                                                                                    <option value="{{$CodigoLocal->id}}">{{$CodigoLocal->descripcion}}</option>
                                                                                @endforeach
                                                                            </select><i class="fa fa-hashtag" id="icr13"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group">           
                                                                            <input type="text" class="form-control typeTlfNumber" name="numTelmvlRpb" id="RpSvaa4"><i class="fa fa-phone" id="icr14"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-md-8 col-md-offset-2" id="rRpb11">
                                                                    <label for="mail">Correo Electrónico</label>
                                                                    <input type="text" name="mail2" id="RpSvaa5" class="form-control typeEmail">

                                                                    <i class="fa fa-envelope" id="icr15"></i>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" id="btnGuardarResponsable1">Guardar <i class="fa fa-floppy-o"></i></button>
                                                <button type="reset" class="btn btn-danger">limpiar <i class="fa fa-floppy-o"></i></button>
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

                                    <form method="post" class="form-horizontal Validacion" action="/menu/registros/clientes/responsables/actualizar/{{$extra}}">
                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <ul class="nav nav-tabs" role="tablist" >
                                                <li role="presentation" class="active"><a href="#modres1" id="amrm0" aria-controls="dbr1" role="tab" data-toggle="tab">Datos básicos</a></li>
                                                <li role="presentation"><a href="#modres2" id="amrm1" aria-controls="ctor" role="tab" data-toggle="tab" >Contactos</a></li>
                                            </ul>
                                            <div class="container-fluid">
                                                <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane active" id="modres1">
                                                        <div class="container-fluid" id="contrpbdbrm1">
                                                            <center><u><p>DATOS BASICOS</p></u></center>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-5  col-md-offset-1" id="rRpbm1">
                                                                    <div class="form-group">
                                                                        <label for="nomRpb1">Nombres</label>
                                                                        <input type="text" name="nomRpb1" class="form-control usernombres" id="RpMda1"><i class="fa fa-user" id="micr1"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5" id="rRpbm3">
                                                                    <div class="form-group">
                                                                        <label for="apellRpb1">Apellidos</label>
                                                                        <input type="text" name="apellRpb1" class="form-control usernombres" id="RpMda2"><i class="fa fa-user-plus" id="micr3"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">   
                                                                <div id="rRpbm6">
                                                                    <div class="col-md-10 col-md-offset-1" id="spm2">
                                                                        <label for="rifRpb">Documento de identidad</label><span class="RpMda3 ic"><i class="fa fa-chevron-down"></i></span>
                                                                    </div>
                                                                    <div class="col-md-4 col-md-offset-1">
                                                                        <div class="form-group row">
                                                                            <select name="selciRpb" class="form-control userEmail" id="RpMda3">
                                                                                <option value="">-</option>
                                                                                @foreach($datosC1 as $TipoCedula)
                                                                                    <option value="{{$TipoCedula->id}}">{{$TipoCedula->descripcion}}</option>
                                                                                @endforeach
                                                                            </select><i class="fa fa-clipboard" id="micr7"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row"> 
                                                                            <input type="text" id="RpMda4" class="form-control typeCiNumber" name="RpMda4"><i class="fa fa-address-card-o" id="micr8"></i>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-10 col-md-offset-1" id="rRpbm8">
                                                                    <div class="form-group row">    
                                                                        <label for="cgoRpb">Cargo</label>
                                                                        <input type="text" name="cgoRpb" class="form-control userEmail" id="RpMda5"><i class="fa fa-id-badge" id="micr10"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div role="tabpanel" class="tab-pane" id="modres2">
                                                        <div class="container-fluid" id="contrpbdbrm3">
                                                            <center><u><p>CONTACTOS</p></u></center>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-8 col-md-offset-2" id="rRpbm9">         <div class="col-md-12">
                                                                        <label for="rifRpb">Telefono movil</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <select name="seltlfRpb" class="form-control userEmail" id="RpMdaa1">
                                                                                <option value="">-</option>
                                                                               @foreach($datosC2 as $CodigoMovil)
                                                                                    <option value="{{$CodigoMovil->id}}">{{$CodigoMovil->descripcion}}</option>
                                                                                @endforeach
                                                                            </select><i class="fa fa-hashtag" id="micr11"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group">     
                                                                            <input type="text" class="form-control typeTlfNumber" name="numTelclRpb" id="RpMdaa2"><i class="fa fa-mobile" id="micr12"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8 col-md-offset-2" id="rRpbm10">         <div class="col-md-12">
                                                                        <label for="rifRpb">Telefono fijo</label>
                                                                        <span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <select name="seltlfmRpb" class="form-control userEmail" id="RpMdaa3">
                                                                                <option value="">-</option>
                                                                                   @foreach($datosC3 as $CodigoLocal)
                                                                                    <option value="{{$CodigoLocal->id}}">{{$CodigoLocal->descripcion}}</option>
                                                                                @endforeach
                                                                            </select><i class="fa fa-hashtag" id="micr13"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group">           
                                                                            <input type="text" class="form-control typeTlfNumber" name="numTelmvlRpb" id="RpMdaa4"><i class="fa fa-phone" id="micr14"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-md-8 col-md-offset-2" id="rRpbm11">
                                                                    <label for="mail">Correo Electrónico</label>
                                                                    <input type="text" name="mail2" id="RpMdaa5" class="form-control typeEmail">
                                                                    <i class="fa fa-envelope" id="micr15"></i>
                                                                </div>
                                                                <input type="text" name="Registroid" id="Registroid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" id="btnModificarResponsable1">Modificar <i class="fa fa-floppy-o"></i></button>
                                            </div>
                                        </form>
                                </div>
                            </div>
                        </div> 
                    </div>   
    @endsection