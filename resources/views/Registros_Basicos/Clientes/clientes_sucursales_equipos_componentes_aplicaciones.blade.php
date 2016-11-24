@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Aplicación - Componentes
        @endsection
        @include('layout/header')
            @include('layout/sidebar')
                <div class="contenido">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 ttlp">
                                <h1>Componentes - Pieza</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
                        @if($agregar)
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2" align="left">
                                    <a href="/menu/registros/clientes/categoria/sucursal/equipos/componentes"><button id="btnBk" type="button" class="btnBk" href="#"><i class="fa fa-chevron-left"></i> VOLVER</button></a>
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
                            <p class="ttlMd"><strong>REGISTRO</strong></p>
                        </div>
                    </div>
                    <!--    Registro -->


                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Agregar Aplicación</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="">
                                        {{ csrf_field() }}
                                        <div class="container-fluid" id="contas">
                                            <div id="rAs1">
                                                <div class="col-md-6">
                                                   <div class="form-group row">
                                                       <label for="nomAp">Nombre de la Aplicación</label>
                                                       <input type="text" class="form-control" name="nomAp" id="nomAp"><i class="fa fa-windows" id="icas1"></i>
                                                   </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="LicAp">Licencia de la Aplicación</label>
                                                        <input type="text" class="form-control" name="LicAp" id="LicAp"><i class="fa fa-barcode" id="icas2"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="rAs2">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="selTa">Tipo de Aplicación</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                        <select name="selTa" class="form-control" id="selTa">
                                                            <option value="0">-</option>
                                                        </select><i class="fa fa-tasks" id="icas3"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="selMa">Marca de la Aplicación</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                        <select name="selMa" class="form-control" id="selMa">
                                                            <option value="0">-</option>
                                                        </select><i class="fa fa-apple" id="icas4"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="rAs3">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="selMap">Versión de la Aplicación</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                        <select name="selMap" class="form-control" id="selMap">
                                                            <option value="0">-</option>
                                                        </select><i class="fa fa-code-fork" id="icas5"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                   <div class="form-group row">
                                                       <label for="selStAp">Estatus de Aplicación</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                       <select name="selStAp" class="form-control" id="selStAp">
                                                           <option value="0">-</option>
                                                           <option value="1">Activo</option>
                                                           <option value="2">Inactivo</option>
                                                       </select><i class="fa fa-check" id="icas6"></i>
                                                   </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="bttnMd" id="btnSv">Guardar <i class="fa fa-floppy-o"></i></button>
                                    <button type="button" class="bttnMd" data-dismiss="modal" id="btnCs">Cerrar <i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modal Modificar-->
                    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel2">Agregar Aplicación</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="">
                                        {{ csrf_field() }}
                                        <div class="container-fluid" id="contasm">
                                            <div id="rAsm1">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="nomApm">Nombre de la Aplicación</label>
                                                        <input type="text" class="form-control" name="nomApm" id="nomApm"><i class="fa fa-windows" id="micas1"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="LicApm">Licencia de la Aplicación</label>
                                                        <input type="text" class="form-control" name="LicApm" id="LicApm"><i class="fa fa-barcode" id="micas2"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="rAsm2">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="selTam">Tipo de Aplicación</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                        <select name="selTam" class="form-control" id="selTam">
                                                            <option value="0">-</option>
                                                        </select><i class="fa fa-tasks" id="micas3"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="selMam">Marca de la Aplicación</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                        <select name="selMam" class="form-control" id="selMam">
                                                            <option value="0">-</option>
                                                        </select><i class="fa fa-apple" id="micas4"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="rAsm3">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="selMapm">Versión de la Aplicación</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                        <select name="selMapm" class="form-control" id="selMapm">
                                                            <option value="0">-</option>
                                                        </select><i class="fa fa-code-fork" id="micas5"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="selStApm">Estatus de Aplicación</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                        <select name="selStApm" class="form-control" id="selStApm">
                                                            <option value="0">-</option>
                                                            <option value="1">Activo</option>
                                                            <option value="2">Inactivo</option>
                                                        </select><i class="fa fa-check" id="micas6"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="bttnMd" id="btnSvm">Guardar <i class="fa fa-floppy-o"></i></button>
                                    <button type="button" class="bttnMd" data-dismiss="modal" id="btnCsm">Cerrar <i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
    @endsection