@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Usuario
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                    <div class="contenido">
                        <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
                           @if($agregar)
                            <button id="btnAdd" type="button" class="btnAd col-md-offset-10" data-toggle="modal" data-target="#myModal" href="#myModal">AGREGAR <i class="fa fa-plus-circle"></i></button>
                           @endif
                                <div class="contMd" style="">
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
                                    <div class="modal-body">
                                        <form action="">
                                            {{ csrf_field() }}
                                            <div class="container-fluid" id="contus">
                                                <div class="form-group row" id="rUs1">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <label for="nomUs">Nombre de Usuario</label>
                                                        <input type="text" class="form-control" name="nomUs" id="nomUs"><i class="fa fa-user-circle"></i>
                                                    </div>
                                                </div>
                                                <div class="form-group row" id="rUs2">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <label for="pwUs1">Contraseña</label>
                                                        <input type="text" class="form-control" name="pwUs1" id="pwUs1"><i class="fa fa-lock"></i>
                                                    </div>
                                                </div>
                                                <div class="form-group row" id="rUs3">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <label for="pwUs2">Confirmar Contraseña</label>
                                                        <input type="text" class="form-control" name="pwUs2" id="pwUs2"><i class="fa fa-key"></i>
                                                    </div>
                                                </div>
                                                <div class="form-group row" id="rUs4">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <label for="stUs">Estatus de Usuario</label>
                                                        <select name="stUs" id="stUs" class="form-control">
                                                            <option value="0">-</option>
                                                            <option value="1">Activo</option>
                                                            <option value="2">Inactivo</option>
                                                        </select>
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
                    @endif
                    </div>   
    @endsection