@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Departamento
        @endsection
        @include('layout/header')
                @include('layout/sidebar')
            <div class="contenido">
                <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
                    <button id="btnAdd" type="button" class="btnAd col-md-offset-10" data-toggle="modal" data-target="#myModal" href="#myModal">AGREGAR <i class="fa fa-plus-circle"></i></button>
                    @foreach($departamentos as $departamento)
                        <div class="contMd" style="">
                            @foreach($acciones as $accion)
                                @if($accion->descripcion!="Status" )
                                     <a href="{{$accion->url.$departamento->id}}". class="btnAcc">{{$accion->descripcion}}</a>
                                @endif
                                @if($accion->descripcion=="Status" )
                                    @if($departamento->status_d==1)

                                        <input type="checkbox" class="btnAcc" name="status" value="{{$departamento->status_d}}" checked>
                                        
                                    @endif
                                    @if($departamento->status_d==0)
                                         <input type="checkbox" name="status"  class="btnAcc" value="{{$departamento->status_d}}" >

                                    @endif
                                     
                                @endif
                            @endforeach
                            <p class="ttlMd"><strong>{{$departamento->nombre_d}}</strong></p>
                        </div>
                    @endforeach
                </div>
                <!-- Modal -->
                
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><strong>Agregar Departamento</strong></h4>
                            </div>
                            <div class="modal-body">
                                <form action="">
                                    <div class="container-fluid" id="contdpto">
                                        <div class="row" id="rDpto">
                                            <div class="form-group col-md-8 col-md-offset-2">
                                                <label for="nomDpto">Nombre del Departamento</label>
                                                <input type="text" name="nomDpto" id="nomDpto"><i class="fa fa-briefcase"></i>
                                            </div>
                                            <div class="form-group col-md-8 col-md-offset-2">
                                                <label for="stDpto">Estatus del Departamento</label>
                                                <select name="stDpto" id="stDpto">
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
                
            </div>
    @endsection
