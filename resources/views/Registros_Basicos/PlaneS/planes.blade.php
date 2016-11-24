@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Planes
        @endsection
          @include('layout/header')
                @include('layout/sidebar')
            <div class="contenido">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 ttlp">
                            <h1>Planes</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
                   @if($agregar)
                   <div class="container">
                       <div class="row">
                           <div class="col-md-offset-6">
                               <button id="btnAdd" type="button" class="btnAdc" data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-plus"></i> AGREGAR</button> 
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
                                                <input type="checkbox" class="btnAcc" name="inchbx1" id="inchbx1" value="{{$accion->status_ac}}" checked><label for="inchbx1" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                            </div>
                                        @elseif($accion->staus_ac==0)
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
                                        <div class="rPn">
                                           <div class="col-md-8 col-md-offset-2">
                                              <div class="form-group row">
                                                  <label for="nomPn">Nombre del plan</label>
                                                  <input type="text" name="nomPn" id="nomPn"><i class="fa fa-cubes" id="icpn1"></i>
                                              </div>
                                           </div>
                                            <div class="col-md-8 col-md-offset-2">
                                               <div class="form-group row">
                                                   <label for="porDes">Porcentaje de descuento</label>
                                                   <input type="number" name="porDes" id="porDes"><i class="fa fa-percent" id="icpn2"></i>
                                               </div>
                                            </div>
                                            <div class="col-md-8 col-md-offset-2">
                                                <div class="form-group row">
                                                    <label for="ultMant">Ultimo mantenimiento</label>
                                                    <input type="date" name="ultMant" id="ultMant"><i class="fa fa-wrench" id="icpn3"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-md-offset-2">
                                                <div class="form-group row">
                                                    <label for="stPn">Estatus del Plan</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                    <select name="stPn" id="stPn">
                                                        <option value="0">-</option>
                                                        <option value="1">Activo</option>
                                                        <option value="2">Inactivo</option>
                                                    </select><i class="fa fa-check" id="icpn4"></i>
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
            </div>
    @endsection