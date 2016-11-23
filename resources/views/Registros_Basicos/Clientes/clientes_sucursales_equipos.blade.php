@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Equipo
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                    <div class="contenido">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 ttlp">
                                    <h1>Sucursales - Equipos</h1>
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
                                            @if($accion->id!=43)
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
                                            @elseif($accion->id==43)
                                                @if($accion->status_ac==1)
                                                    <div class="chbx">
                                                        <input type="checkbox" class="btnAcc" name="status" id="inchbx1" value="{{$accion->status_ac}}" checked><label for="inchbx1" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                                    </div>
                                                @elseif($accion->status_ac==0)
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

                        <!--Modal -->
                        @if($agregar)
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Agregar Equipo</h4>
                                    </div>
                                    <form action="" class="Validacion">
                                    <div class="modal-body">
                                            {{ csrf_field() }}
                                            <div class="container-fluid" id="conteq">
                                                <div id="rEq1">
                                                   <div class="col-md-8 col-md-offset-2">
                                                       <div class="form-group row" >
                                                           <label for="nomEq">Nombre de equipo</label>
                                                           <input type="text" class="form-control userEmail" name="nomEq" id="nomEq"><i class="fa fa-id-badge" id="ice1"></i>
                                                       </div>
                                                   </div>
                                                   <div class="col-md-8 col-md-offset-2">
                                                       <div class="form-group row">
                                                           <label for="tpEq">Tipo de equipo</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                           <select name="tpEq" id="tpEq" class="form-control userEmail">
                                                               <option value="">-</option>
                                                               <option value="1">Activo</option>
                                                               <option value="2">Inactivo</option>
                                                           </select><i class="fa fa-desktop" id="ice2"></i>
                                                       </div>
                                                   </div>
                                               </div>
                                                <div id="rEq2">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="mkEq">Marca de equipo</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="mkEq" id="mkEq" class="form-control userEmail">
                                                                <option value="">-</option>
                                                                <option value="1">Activo</option>
                                                                <option value="2">Inactivo</option>
                                                            </select><i class="fa fa-apple" id="ice3"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="modEq">Modelo de equipo</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="modEq" id="modEq" class="form-control userEmail">
                                                                <option value="">-</option>
                                                                <option value="1">Activo</option>
                                                                <option value="2">Inactivo</option>
                                                            </select><i class="fa fa-laptop" id="ice4"></i>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div id="rEq3">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="duPfl">Serial de equipo</label>
                                                            <input type="text" class="form-control userEmail" name="duPfl" id="duPfl"><i class="fa fa-barcode" id="ice5"></i>
                                                        </div>
                                                    </div>  
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="stPfl">Estatus de euipo</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="stPfl" id="stPfl" class="form-control userEmail">
                                                                <option value="">-</option>
                                                                <option value="1">Activo</option>
                                                                <option value="2">Inactivo</option>
                                                            </select><i class="fa fa-check" id="ice6"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="modal-footer">
                                        <button type="button" class="bttnMd" id="btnSv">Guardar <i class="fa fa-floppy-o"></i></button>
                                        <button type="button" class="bttnMd" data-dismiss="modal" id="btnCs">Cerrar <i class="fa fa-times"></i></button>
                                    </div></form>
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
                                        <h4 class="modal-title" id="myModalLabel2">Agregar Equipo</h4>
                                    </div>
                                    <form action="" class="Validacion">
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            <div class="container-fluid" id="conteqm">
                                                <div id="rEqm1">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row" >
                                                            <label for="nomEq">Nombre de equipo</label>
                                                            <input type="text" class="form-control userEmail" name="nomEq" id="nomEqm"><i class="fa fa-id-badge" id="mice1"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="tpEq">Tipo de equipo</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="tpEq" id="tpEqm" class="form-control userEmail">
                                                                <option value="">-</option>
                                                                <option value="1">Activo</option>
                                                                <option value="2">Inactivo</option>
                                                            </select><i class="fa fa-desktop" id="mice2"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="rEqm2">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="mkEq">Marca de equipo</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="mkEq" id="mkEqm" class="form-control userEmail">
                                                                <option value="">-</option>
                                                                <option value="1">Activo</option>
                                                                <option value="2">Inactivo</option>
                                                            </select><i class="fa fa-apple" id="mice3"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="modEq">Modelo de equipo</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="modEq" id="modEqm" class="form-control userEmail">
                                                                <option value="">-</option>
                                                                <option value="1">Activo</option>
                                                                <option value="2">Inactivo</option>
                                                            </select><i class="fa fa-laptop" id="mice4"></i>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div id="rEqm3">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="duPfl">Serial de equipo</label>
                                                            <input type="text" class="form-control userEmail" name="duPfl" id="duPflm"><i class="fa fa-barcode" id="mice5"></i>
                                                        </div>
                                                    </div>  
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="stPfl">Estatus de euipo</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="stPfl" id="stPflm" class="form-control userEmail">
                                                                <option value="">-</option>
                                                                <option value="1">Activo</option>
                                                                <option value="2">Inactivo</option>
                                                            </select><i class="fa fa-check" id="mice6"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="bttnMd" id="btnSvm">Guardar <i class="fa fa-floppy-o"></i></button>
                                            <button type="button" class="bttnMd" data-dismiss="modal" id="btnCsm">Cerrar <i class="fa fa-times"></i></button>
                                        </div></form>
                                </div>
                            </div>
                        </div>
                    </div>   
    @endsection