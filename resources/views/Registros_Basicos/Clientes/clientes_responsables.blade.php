@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Cliente - Responsable
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                    <div class="contenido">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4 ttlp">
                                    <h1>{{$datosC5->nombreComercial}} - Responsable</h1>
                                    <input type="hidden" id="nombreClienteMatriz" value="{{$datosC5->nombreComercial}}">
                                </div>
                            </div>
                            <div class="row sep-div">
                                <div class="col-md-2 despl-bttn">
                                    @if($agregar)
                                    <div class="bttn-agregar">
                                        <button id="btnAdd" type="button" class="bttn-agr" data-toggle="modal" data-target="#myModal" href="#myModal"><span class="fa fa-plus"></span><span class="txt-bttn">AGREGAR</span></button>
                                    </div>
                                    @endif 
                                </div>
                                <div class="col-md-2 despl-bttn">
                                    <a href="/menu/registros/clientes">
                                        <div class="bttn-volver">
                                            <button id="btnBk" type="button" href="#" class="bttn-vol"><span class="fa fa-chevron-left"></span><span class="txt-bttn">VOLVER</span></button>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
                        
                        @foreach($consulta as $responsable)
                            <div class="contMd " style="" ">
                                <div class="icl">
                                    @foreach($acciones as $accion)
                                        @if($accion->id!=15)
                                            @if($accion->id==14)
                                                <span class="iclsp">
                                                    <a  class="tltp modificarResponsable"  data-caso="0" data-ttl="{{$accion->descripcion}}" id="m{{$responsable->id}}" data-toggle="modal" data-reg="{{$responsable->id}}" > 
                                                        <i class="{{$accion->clase_css}}"></i>
                                                    </a>
                                                </span>
                                            @elseif($accion->id!=14)
                                                <span class="iclsp">
                                                    <a href="{{$accion->url}}" class="tltp" data-ttl="{{$accion->descripcion}}">
                                                        <i class="{{$accion->clase_css}}"></i>
                                                    </a>
                                                </span>
                                            @endif
                                        @elseif($accion->id==15)
                                            @if($responsable->status==1)
                                            <div class="chbx">
                                                <input type="checkbox" class="checkResponsable" data-reg="{{$responsable->id}}" name="status" id="{{'inchbx'. $responsable->id}}" value="{{$responsable->status}}" checked><label for="{{'inchbx'. $responsable->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                            </div>
                                            @elseif($responsable->status==0)
                                            <div class="chbx">
                                                <input type="checkbox" class="checkResponsable" data-reg="{{$responsable->id}}" name="status" id="{{'inchbx'. $responsable->id}}" value="{{$responsable->status}}"><label for="{{'inchbx'. $responsable->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                            </div>
                                            @endif
                                        @elseif($accion->id==120)
                                                <span class="iclsp">
                                                    <a class="eliminarRespCli_" id="RespCli{{$responsable->id}}" data-reg="{{$responsable->id}}" data-ttl="{{$accion->descripcion}}">
                                                       <i class="{{$accion->clase_css}}"></i>
                                                  </a>
                                            </span>
                                        @endif
                                    @endforeach
                                </div>
                                <input type="hidden" name="idresp{{$responsable->id}}" value="{{$responsable->id}}" id="idrespm{{$responsable->id}}">
                                @if($responsable->encargado==1)
                                    <span class="ttlMd"><input type="radio" name="c_rsp"  class="radioResp" data-reg="{{$responsable->id}}" id="c_rsp{{$responsable->id}}" value="{{$responsable->encargado}}" checked> 
                                    <label for="c_rsp"><strong>{{$responsable->primerNombre." ".$responsable->primerApellido}}</strong></label></span>
                                    <input type="hidden" name="checkSeleccionado_" id="checkSeleccionado_" value="{{$responsable->id}}">
                                @else
                                     <span class="ttlMd"><input type="radio" name="c_rsp" id="c_rsp{{$responsable->id}}"  class="radioResp" data-reg="{{$responsable->id}}" value="{{$responsable->encargado}}" > 
                                    <label for="c_rsp"><strong>{{$responsable->primerNombre." ".$responsable->primerApellido}}</strong></label></span>
                                     
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
                                        <h4 class="modal-title" id="myModalLabel">AGREGAR RESPONSABLE: {{$datosC5->nombreComercial}}</h4>
                                    </div>
                                    
                                        <form  class="form-horizontal Validacion" id="_responsableMatriz_">
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
                                            <input type="hidden" name="_clienteMatriz_" id="_clienteMatriz_" value="{{$datosC4}}">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" id="btnGuardarResponsableM">Guardar <i class="fa fa-floppy-o"></i></button>
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
                                        <h4 class="modal-title" id="myModalLabel2">{{$datosC5->nombreComercial}} - Cliente</h4>
                                    </div>

                                    <form method="post" class="form-horizontal Validacion" id="_responsableMatriz_Mod">
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
                                                                            <input type="text" id="RpMda4" class="form-control typeCiNumber" name="txtci"><i class="fa fa-address-card-o" id="micr8"></i>
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
                                                               
                                                                  <input type="hidden" name="_clienteMatriz_" id="_clienteMatrizMod_" value="{{$datosC4}}">
                                                            </div>
                                                             <input type="hidden" name="idRegistroMod_" id="idRegistroMod_" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                           
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary btnModificarResp_" id="btnModificarResponsable1" data-caso="0">Modificar <i class="fa fa-floppy-o"></i></button>
                                            </div>
                                        </form>
                                </div>
                            </div>
                        </div> 
                    </div>   
    @endsection
    @section('js')
        <script src="{{asset('js/vistaRespMatriz.js')}}"></script>
    @endsection