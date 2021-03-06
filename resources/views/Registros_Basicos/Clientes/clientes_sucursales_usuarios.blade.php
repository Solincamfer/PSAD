@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Usuario
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                    <div class="contenido">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4 ttlp">
                                    <h1>Usuario - En construcción <i class="fa fa-"></i></h1>
                                </div>
                            </div>
                            <!--<div class="row sep-div">
                                <div class="col-md-2">
                                    <a href="/menu/registros/clientes/categorias/sucursales/{{$datosC1}}">
                                        <div class="bttn-volver">
                                            <button id="btnBk" type="button" href="#" class="bttn-vol"><span class="fa fa-chevron-left"></span><span class="txt-bttn">VOLVER</span></button>
                                        </div>
                                    </a>
                                </div>
                            </div>-->
                        </div>
                        <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3"> 
                           @if($agregar)
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-2" align="left">
                                        <a href="/menu/registros/clientes/categorias/sucursales"><button id="btnBk" type="button" class="btnBk" href="#"><i class="fa fa-chevron-left"></i> VOLVER</button></a>
                                    </div>
                                    <!--<div class="col-md-2 col-md-offset-3">
                                        <button id="btnAdd" type="button" class="btnAd" data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-plus"></i> AGREGAR</button> 
                                    </div>-->
                                </div>
                            </div>
                           @endif
                                <!--<div class="contMd" style="">
                                     @foreach($acciones as $accion)
                                          @if($accion->descripcion!="Status")
                                            <span style="display: inline-block; float: right;"><a href="{{$accion->url}}"><i class="{{$accion->clase_css}}"></i></a></span>
                                          @elseif($accion->descripcion=="Status")
                                                 @if($accion->status_ac==1)
                                                     <input type="checkbox" class="btnAcc" name="status" value="{{$accion->status_ac}}" checked>
                                            
                                                 @elseif($accion->staus_ac==0)
                                                     <input type="checkbox" class="btnAcc" name="status" value="{{$accion->status_ac}}" >
                                                 @endif


                                          @endif
                                    @endforeach
                                    <p class="ttlMd"><strong>REGISTRO</strong></p>
                                </div>-->
                          <div class="const" style="margin-top: 4em;">
                              
                          </div>
                        </div>
                        <!--    Registro -->


                        <!-- Modal -->
                        @if($agregar)
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Agregar Usuario</h4>
                                    </div> 
                                    <form action="" class="Validacion">
                                    <div class="modal-body">
                                       
                                            {{ csrf_field() }}
                                            <div class="container-fluid" id="contus">
                                            <div class="col-md-8 col-md-offset-2">
                                                <div class="form-group row" id="rUs1">
                                                    
                                                        <label for="nomUs">Nombre de Usuario</label>
                                                        <input type="text" class="form-control userEmail" name="nomUs" id="nomUs"><i class="fa fa-user-circle"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-md-offset-2">
                                                <div class="form-group row" id="rUs2">
                                                    
                                                        <label for="pwUs1">Contraseña</label>
                                                        <input type="text" class="form-control userEmail" name="pwUs1" id="pwUs1"><i class="fa fa-lock"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-md-offset-2">
                                                <div class="form-group row" id="rUs3">
                                                    
                                                        <label for="pwUs2">Confirmar Contraseña</label>
                                                        <input type="text" class="form-control userEmail" name="pwUs2" id="pwUs2"><i class="fa fa-key"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-md-offset-2">
                                                <div class="form-group row" id="rUs4">
                                                    
                                                        <label for="stUs">Estatus de Usuario</label>
                                                        <select name="stUs" id="stUs" class="form-control userEmail">
                                                            <option value="">-</option>
                                                            <option value="1">Activo</option>
                                                            <option value="2">Inactivo</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="bttnMd" id="btnSv">Guardar <i class="fa fa-floppy-o"></i></button>
                                        <button type="button" class="bttnMd" data-dismiss="modal" id="btnCs">Cerrar <i class="fa fa-times"></i></button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                    </div>   
    @endsection