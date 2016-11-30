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
                                    <a href="/menu/registros/clientes/categoria/"><button id="btnBk" type="button" class="btnBk" href="#"><i class="fa fa-chevron-left"></i> VOLVER</button></a>
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
                                       @if($accion->descripcion!="Status")
                                           @if($accion->data_toogle=="modal")
                                           <span class="iclsp">
                                               <a href="#myModal2" class="tltp modificarResponsable_clinete" data-ttl="{{$accion->descripcion}}" data-toggle="modal" data-target="#myModal2" id="m{{$responsable->id}}">
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
                                               <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $responsable->id}}" value="{{$accion->status_ac}}" checked><label for="{{'inchbx'. $responsable->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                           </div>
                                           @elseif($accion->staus_ac==0)
                                               <div class="chbx">
                                                   <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $responsable->id}}" value="{{$accion->status_ac}}"><label for="{{'inchbx'. $responsable->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                               </div>
                                           @endif
                                       @endif
                                   @endforeach
                               </div>
                                    <input type="hidden" name="idresp_c{{$responsable->id}}" value="{{$responsable->id}}" id="idresp_cm{{$responsable->id}}">
                               @if($responsable->id==$extra)
                                    <span class="ttlMd"><input type="radio" name="cat_rsp" id="cat_rsp" value="{{$responsable->id}}" checked> <label for="cat_rsp"><strong>{{$responsable->p_nombre." ".$responsable->p_apellido}}</strong></label></span>
                               @else
                                    <span class="ttlMd"><input type="radio" name="cat_rsp" id="cat_rsp" value="{{$responsable->id}}" > <label for="cat_rsp"><strong>{{$responsable->p_nombre." ".$responsable->p_apellido}}</strong></label></span>
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
                                    <h4 class="modal-title" id="myModalLabel">Agregar Categoría - Responsable</h4>
                                </div>
                                
                                <form method="post" class="form-horizontal Validacion" action="/menu/registros/clientes/categoria/insertar/responsable/{{$datosC1}}">
                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <ul class="nav nav-tabs" role="tablist" >
                                                <li role="presentation" class="active"><a href="#p0" id="resp0" aria-controls="dbr1" role="tab" data-toggle="tab">Datos básicos</a></li>
                                                <li role="presentation"><a href="#p1" id="resp1" aria-controls="ctor" role="tab" data-toggle="tab" >Contactos</a></li>
                                            </ul>
                                            <div class="container-fluid">
                                                <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane active" id="p0">
                                                        <div class="container-fluid" id="contrpbdbr1">
                                                            <center><u><p>DATOS BASICOS</p></u></center>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-5  col-md-offset-1" id="rRpb1">
                                                                    <div class="form-group">
                                                                        <label for="nomRpb1">Nombres</label>
                                                                        <input type="text" name="nomRpb1" class="form-control userEmail" id="RpSvn1"><i class="fa fa-user" id="icr1"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5" id="rRpb3">
                                                                    <div class="form-group">
                                                                        <label for="apellRpb1">Apellidos</label>
                                                                        <input type="text" name="apellRpb1" class="form-control userEmail" id="RpSvn2"><i class="fa fa-user-plus" id="icr3"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">   
                                                                <div id="rRpb6">
                                                                    <div class="col-md-10 col-md-offset-1" id="sp2">
                                                                        <label for="rifRpb">Documento de identidad</label><span class="RpMda3 ic"><i class="fa fa-chevron-down"></i></span>
                                                                    </div>
                                                                    <div class="col-md-4 col-md-offset-1">
                                                                        <div class="form-group row">
                                                                            <select name="selciRpb" class="form-control userEmail" id="RpSvn3">
                                                                                <option value="">-</option>
                                                                                <option value="1">G</option>
                                                                            </select><i class="fa fa-clipboard" id="icr7"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row"> 
                                                                            <input type="text" class="form-control typeCiNumber" name="txtci" id="RpSvn4"><i class="fa fa-address-card-o" id="icr8"></i>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-10 col-md-offset-1" id="rRpb8">
                                                                    <div class="form-group row">    
                                                                        <label for="cgoRpb">Cargo</label>
                                                                        <input type="text" name="cgoRpb" class="form-control userEmail" id="RpSvn5"><i class="fa fa-id-badge" id="icr10"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div role="tabpanel" class="tab-pane" id="p1">
                                                        <div class="container-fluid" id="contrpbdbr3">
                                                            <center><u><p>CONTACTOS</p></u></center>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-8 col-md-offset-2" id="rRpb9">         <div class="col-md-12">
                                                                        <label for="rifRpb">Telefono movil</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <select name="seltlfRpb" class="form-control userEmail" id="RpSvnn1">
                                                                                <option value="">-</option>
                                                                                <option value="1">0414</option>
                                                                            </select><i class="fa fa-hashtag" id="icr11"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group">     
                                                                            <input type="text" class="form-control typeTlfNumber" name="numTelclRpb" id="RpSvnn2"><i class="fa fa-mobile" id="icr12"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8 col-md-offset-2" id="rRpb10">         <div class="col-md-12">
                                                                        <label for="rifRpb">Telefono fijo</label>
                                                                        <span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <select name="seltlfmRpb" class="form-control userEmail" id="RpSvnn3">
                                                                                <option value="">-</option>
                                                                                <option value="1">0212</option>
                                                                            </select><i class="fa fa-hashtag" id="icr13"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group">           
                                                                            <input type="text" class="form-control typeTlfNumber" name="numTelmvlRpb" id="RpSvnn4"><i class="fa fa-phone" id="icr14"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-md-8 col-md-offset-2" id="rRpb11">
                                                                    <label for="mail">Correo Electrónico</label>
                                                                    <input type="text" name="mail2" id="RpSvnn5" class="form-control typeEmail">
                                                                    <i class="fa fa-envelope" id="icr15"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" id="btnGuardarResponsable2">Guardar <i class="fa fa-floppy-o"></i></button>
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

                                
                                <form method="post" class="form-horizontal Validacion" action="/menu/registros/clientes/categoria/actualizar/responsable/{{$datosC1}}">
                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <ul class="nav nav-tabs" role="tablist" >
                                                <li role="presentation" class="active"><a href="#pp0" id="respp0" aria-controls="dbr1" role="tab" data-toggle="tab">Datos básicos</a></li>
                                                <li role="presentation"><a href="#pp1" id="respp1" aria-controls="ctor" role="tab" data-toggle="tab" >Contactos</a></li>
                                            </ul>
                                            <div class="container-fluid">
                                                <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane active" id="pp0">
                                                        <div class="container-fluid" id="contrpbdbrm1">
                                                            <center><u><p>DATOS BASICOS</p></u></center>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-5  col-md-offset-1" id="rRpbm1">
                                                                    <div class="form-group">
                                                                        <label for="nomRpb1">Nombres</label>
                                                                        <input type="text" name="nomRpb1" class="form-control userEmail" id="RpMdn1"><i class="fa fa-user" id="micr1"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5" id="rRpbm3">
                                                                    <div class="form-group">
                                                                        <label for="apellRpb1">Apellidos</label>
                                                                        <input type="text" name="apellRpb1" class="form-control userEmail" id="RpMdn2"><i class="fa fa-user-plus" id="micr3"></i>
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
                                                                            <select name="selciRpb" class="form-control userEmail" id="RpMdn3">
                                                                                <option value="">-</option>
                                                                                @foreach($datosC2 as $tipoC)
                                                                                    <option value="{{$tipoC->id}}">{{$tipoC->descripcion}}</option>
                                                                                @endforeach
                                                                            </select><i class="fa fa-clipboard" id="micr7"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row"> 
                                                                            <input type="text" class="form-control typeCiNumber" name="RpMda4" id="RpMdn4"><i class="fa fa-address-card-o" id="micr8"></i>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-10 col-md-offset-1" id="rRpbm8">
                                                                    <div class="form-group row">    
                                                                        <label for="cgoRpb">Cargo</label>
                                                                        <input type="text" name="cgoRpb" class="form-control userEmail" id="RpMdn5"><i class="fa fa-id-badge" id="micr10"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div role="tabpanel" class="tab-pane" id="pp1">
                                                        <div class="container-fluid" id="contrpbdbrm3">
                                                            <center><u><p>CONTACTOS</p></u></center>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-8 col-md-offset-2" id="rRpbm9">         <div class="col-md-12">
                                                                        <label for="rifRpb">Telefono movil</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <select name="seltlfRpb" class="form-control userEmail" id="RpMdnn1">
                                                                                <option value="">-</option>
                                                                                  @foreach($datosC3 as $tipoCL)
                                                                                    <option value="{{$tipoCL->id}}">{{$tipoCL->descripcion}}</option>
                                                                                @endforeach
                                                                            </select><i class="fa fa-hashtag" id="micr11"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group">     
                                                                            <input type="text" class="form-control typeTlfNumber" name="numTelclRpb" id="RpMdnn2"><i class="fa fa-mobile" id="micr12"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8 col-md-offset-2" id="rRpbm10">         <div class="col-md-12">
                                                                        <label for="rifRpb">Telefono fijo</label>
                                                                        <span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <select name="seltlfmRpb" class="form-control userEmail" id="RpMdnn3">
                                                                                <option value="">-</option>
                                                                                @foreach($datosC4 as $tipoTL)
                                                                                    <option value="{{$tipoTL->id}}">{{$tipoTL->descripcion}}</option>
                                                                                @endforeach
                                                                            </select><i class="fa fa-hashtag" id="micr13"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="form-group">           
                                                                            <input type="text" class="form-control typeTlfNumber" name="numTelmvlRpb" id="RpMdnn4"><i class="fa fa-phone" id="micr14"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-md-8 col-md-offset-2" id="rRpbm11">
                                                                    <label for="mail">Correo Electrónico</label>
                                                                    <input type="text" name="mail2" id="RpMdnn5" class="form-control typeEmail">
                                                                    <i class="fa fa-envelope" id="micr15"></i>
                                                                </div>
                                                                <input type="hidden" name="Registroid" id="Responsableid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" id="btnModificarResponsable2">Modificar <i class="fa fa-floppy-o"></i></button>
                                            </div>
                                        </form>
                            </div>
                        </div>
                    </div> 
                </div>   
    @endsection