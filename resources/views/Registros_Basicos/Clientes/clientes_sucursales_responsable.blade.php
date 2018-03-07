@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Sucursales - Responsable
        @endsection
        @include('layout/header')
            @include('layout/sidebar')
                <div class="contenido">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4 ttlp">
                                <h1>{{$extra->nombreComercial}} - Responsable</h1>
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
                                <a href="/menu/registros/clientes/categorias/sucursales/{{$datosC1->id}}">
                                    <div class="bttn-volver">
                                        <button id="btnBk" type="button" href="#" class="bttn-vol"><span class="fa fa-chevron-left"></span><span class="txt-bttn">VOLVER</span></button>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
                        @foreach($consulta as $responsable)
                            <div class="contMd" style="">
                                <div class="icl">
                                    @foreach($acciones as $accion)
                                        @if($accion->id!=33)
                                            @if($accion->id==32)
                                                <span class="iclsp">
                                                    <a  class="tltp modificarResponsable"  data-reg="{{$responsable->id}}" data-caso="2" data-ttl="{{$accion->descripcion}}" data-toggle="modal" > 
                                                        <i class="{{$accion->clase_css}}"></i>
                                                    </a>
                                                </span>
                                            @elseif($accion->id!=32)
                                                <span class="iclsp">
                                                    <a href="{{$accion->url}}" class="tltp" data-ttl="{{$accion->descripcion}}">
                                                        <i class="{{$accion->clase_css}}"></i>
                                                    </a>
                                                </span>
                                            @endif
                                        @elseif($accion->id==33)
                                            @if($responsable->status==1)
                                                <div class="chbx">
                                                    <input type="checkbox" class="checkResponsableSuc" data-reg="{{$responsable->id}}" name="status" id="{{'checkSuc'. $responsable->id}}" value="{{$responsable->status}}" checked><label for="{{'checkSuc'. $responsable->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                                </div>
                                            @elseif($responsable->status==0)
                                                <div class="chbx">
                                                    <input type="checkbox" class="checkResponsableSuc" data-reg="{{$responsable->id}}" name="status" id="{{'checkSuc'. $responsable->id}}" value="{{$responsable->status}}"><label for="{{'checkSuc'.$responsable->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                                </div>
                                             @elseif($accion->id==116)
                                                <span class="iclsp">
                                                    <a class="eliminarRespSuc_" id="Respsuc_{{$responsable->id}}" data-reg="{{$responsable->id}}" data-ttl="{{$accion->descripcion}}">
                                                       <i class="{{$accion->clase_css}}"></i>
                                                  </a>
                                            </span>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                                @if($datosC6==$responsable->id)
                                        <span class="ttlMd"><input type="radio" name="c_rsp"  class="radioRespSuc" data-reg="{{$responsable->id}}" id="s_resp{{$responsable->id}}" value="1" checked> 
                                        <label for="s_resp{{$responsable->id}}"><strong>{{$responsable->primerNombre." ".$responsable->primerApellido}}</strong></label></span>
                                        <input type="hidden" name="_checkSeleccionadoSuc_" id="_checkSeleccionadoSuc_" value="{{$responsable->id}}">
                                @else
                                        
                                        <span class="ttlMd"><input type="radio" name="c_rsp"  class="radioRespSuc" data-reg="{{$responsable->id}}" id="s_resp{{$responsable->id}}" value="0" > 
                                        <label for="s_resp{{$responsable->id}}"><strong>{{$responsable->primerNombre." ".$responsable->primerApellido}}</strong></label></span>
                                @endif
                            </div>
                        @endforeach
                       
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

                                <form  class="form-horizontal Validacion" id="respSucForAgr">
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
                                                                             @foreach($datosC3 as $TipoCedula)
                                                                                    <option value="{{$TipoCedula->id}}">{{$TipoCedula->descripcion}}</option>
                                                                             @endforeach
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
                                                                            @foreach($datosC4 as $CodigoMovil)
                                                                                    <option value="{{$CodigoMovil->id}}">{{$CodigoMovil->descripcion}}</option>
                                                                            @endforeach
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
                                                                            @foreach($datosC5 as $CodigoLocal)
                                                                                    <option value="{{$CodigoLocal->id}}">{{$CodigoLocal->descripcion}}</option>
                                                                             @endforeach
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
                                        <input type="hidden" name="_clienteMatriz_" id="_clienteMatriz_RespSuc" value="{{$datosC2}}">
                                        <input type="hidden" name="sucursal_id_resp" id="sucursal_id_resp" value="{{$extra->id}}">
                                    </div>
                                    <div class="modal-footer">
                                       <button type="submit" class="btn btn-primary" id="btnRespSucursal">Guardar<i class="fa fa-floppy-o"></i></button> 
                                        
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

                                <form  class="form-horizontal Validacion" id="respSucForMod">
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
                                                                            @foreach($datosC3 as $TipoCedula)
                                                                                    <option value="{{$TipoCedula->id}}">{{$TipoCedula->descripcion}}</option>
                                                                             @endforeach
                                                                        </select><i class="fa fa-clipboard" id="micrc7"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group"> 
                                                                        <input type="text" class="form-control userEmail" name="txtci" id="cedRespSuc"><i class="fa fa-address-card-o" id="micrc8"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-10 col-md-offset-1" id="rRpbcm8">
                                                                    <div class="form-group row">    
                                                                        <label for="cgoRpb">Cargo</label>
                                                                        <input type="text" name="cgoRpb" class="form-control userEmail" id="RpMdns5"><i class="fa fa-id-badge" id="micrc10"></i>
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
                                                                        <select name="seltlfRpb" class="form-control userEmail" id="RpMdnn1s">
                                                                            <option value="">-</option>
                                                                              @foreach($datosC4 as $CodigoMovil)
                                                                                    <option value="{{$CodigoMovil->id}}">{{$CodigoMovil->descripcion}}</option>
                                                                            @endforeach
                                                                        </select><i class="fa fa-hashtag" id="micrc11"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <div class="form-group">     
                                                                        <input type="text" class="form-control userEmail" name="numTelclRpb" id="RpMdnns2"><i class="fa fa-mobile" id="micrc12"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8 col-md-offset-2" id="rRpbcm10">         
                                                                <div class="col-md-12">
                                                                    <label for="rifRpb">Telefono fijo</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                        <select name="seltlfmRpb" class="form-control userEmail" id="seltlsfmRpb">
                                                                            <option value="">-</option>
                                                                             @foreach($datosC5 as $CodigoLocal)
                                                                                    <option value="{{$CodigoLocal->id}}">{{$CodigoLocal->descripcion}}</option>
                                                                             @endforeach
                                                                        </select><i class="fa fa-hashtag" id="micrc13"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <div class="form-group">           
                                                                        <input type="text" class="form-control userEmail" name="numTelmvlRpb" id="RpMdnns4"><i class="fa fa-phone" id="micrc14"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-md-8 col-md-offset-2" id="rRpbcm11">
                                                                <label for="mail">Correo Electrónico</label>
                                                                <input type="text" name="mail2" id="RpMdsnn5" class="form-control userEmail">
                                                                <i class="fa fa-envelope" id="micrc15"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <input type="hidden" name="idRegistroMod_" id="idRegistroModSuc" value="">
                                         
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary btnModificarResp_" id="btnModificarResponsable3" data-caso="2" >Modificar <i class="fa fa-floppy-o"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>   
    @endsection
    @section('js')
        <script src="{{asset('js/respSucursal.js')}}"></script>
    @endsection