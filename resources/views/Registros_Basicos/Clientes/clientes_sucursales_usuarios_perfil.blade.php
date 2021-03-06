@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Perfil
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
                        <!--Registro -->


                        <!--Modal -->
                        @if($agregar)
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Agregar Perfil</h4>
                                    </div><form action="" class="Validacion">
                                    <div class="modal-body">
                                        
                                            {{ csrf_field() }}
                                            <div class="container-fluid" id="contpfl">
                                            <div class="col-md-8 col-md-offset-2">
                                                <div class="form-group row" id="rPfl1">
                                                    
                                                        <label for="duPfl">Descripcion del Usuario</label>
                                                        <input type="text" class="form-control userEmail" name="duPfl" id="duPfl"><i class="fa fa-id-badge"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-md-offset-2">
                                                <div class="form-group row" id="rPfl2">
                                                    
                                                        <label for="stPfl">Estatus del Perfil</label>
                                                        <select name="stPfl" id="stPfl" class="form-control userEmail">
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
                                    </div></form>
                                </div>
                            </div>
                        </div>
                       @endif 
                    </div>   
    @endsection