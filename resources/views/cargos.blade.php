@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Cargos
        @endsection
        @include('layout/header')
                @include('layout/sidebar')
            <div class="contenido">
                <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
                    <button id="btnAdd" type="button" class="btnAd col-md-offset-10" data-toggle="modal" data-target="#myModal" href="#myModal">AGREGAR <i class="fa fa-plus-circle"></i></button>
                    @foreach($cargos as $cargo)
                        <div class="contMd" style="">
                            @foreach($acciones as $accion)
                                 @if($accion->descripcion!="Status" )
                                     <a href="#" class="btnAcc">{{$accion->descripcion}}</a>
                                @endif
                                @if($accion->descripcion=="Status")
                                    @if($cargo->status_c==1)

                                        <input type="checkbox" class="btnAcc" name="status" value="{{$cargo->status_c}}" checked>
                                        
                                    @endif
                                    @if($cargo->status_c==0)
                                         <input type="checkbox" name="status"  class="btnAcc" value="{{$cargo->status_c}}" >

                                    @endif
                                @endif
                            @endforeach
                            <p class="ttlMd"><strong>{{$cargo->nombre_c}}</strong></p>
                        </div>
                    @endforeach
                </div>
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><strong>Agregar Cargo</strong></h4>
                            </div>
                            <div class="modal-body">

                                <form method="post" class="form-horizontal Validacion" action="ajaxSubmit.php">
                                    <div class="container-fluid" id="contcgo">
                                        
                                        <div class="col-md-6 col-md-offset-3">
                                            <div class="form-group">
                                                <label for="nomCgo">Nombre del cargo</label>
                                                <input type="text" class="form-control" name="textCgo" id="nomCgo" /><i class="fa fa-id-badge"></i>                     
                                                </div>
                                                <div class="form-group">
                                                <label for="stCgo">Estatus del Cargo</label>
                                                <select id="stCgo" class="form-control" name="comboCgo">
                                                    <option value="">-</option>
                                                    <option value="1">Activo</option>
                                                    <option value="2">Inactivo</option>
                                                </select>
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
                </div>
            </div>
    @endsection    