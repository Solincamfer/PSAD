@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Planes
        @endsection
          @include('layout/header')
                @include('layout/sidebar')
            <div class="contenido">
                <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
                   @if($agregar)
                    <button id="btnAdd" type="button" class="btnAd col-md-offset-10" data-toggle="modal" data-target="#myModal" href="#myModal">AGREGAR <i class="fa fa-plus-circle"></i></button>
                   @endif

                  clientes
                        <div class="contMd" style="">
                           
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
                                                <a href="" class="tltp" data-ttl="{{$accion->descripcion}}">
                                                    <i class="{{$accion->clase_css}}"></i>
                                                </a>
                                            </span>
                                            @endif
                                        @elseif($accion->descripcion=="Status")
                                            @if($accion->status_ac==1)
                                                <div class="chbx">
                                                    <input type="checkbox" class="btnAcc" name="inchbx1" id="" value="{{$accion->status_ac}}" checked><label for="" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                                </div>
                                            @elseif($accion->staus_ac==0)
                                                <div class="chbx">
                                                    <input type="checkbox" class="btnAcc" name="status" id="" value="{{$accion->status_ac}}"><label for="" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                        <p class="ttlMd"><strong>REGISTRO</strong></p>
                        </div>
                  
                </div>
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Agregar Plan</h4>
                            </div>
                            <div class="modal-body">
                                <form action="">
                                    {{ csrf_field() }}
                                    <div class="container-fluid" id="contpn">
                                        <div class="row" id="rPn">
                                            <div class="form-group col-md-8 col-md-offset-2">
                                                <label for="nomPn">Nombre del plan</label>
                                                <input type="text" name="nomPn" id="nomPn"><i class="fa fa-cubes"></i>
                                            </div>
                                            <div class="form-group col-md-8 col-md-offset-2">
                                                <label for="porDes">Porcentaje de descuento</label>
                                                <input type="number" name="porDes" id="porDes"><i class="fa fa-percent"></i>
                                            </div>
                                            <div class="form-group col-md-8 col-md-offset-2">
                                                <label for="ultMant">Ultimo mantenimiento</label>
                                                <input type="date" name="ultMant" id="ultMant"><i class="fa fa-wrench"></i>
                                            </div>
                                            <div class="form-group col-md-8 col-md-offset-2">
                                                <label for="stPn">Estatus del Plan</label>
                                                <select name="stPn" id="stPn">
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