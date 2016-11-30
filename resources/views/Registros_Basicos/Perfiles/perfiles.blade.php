@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Perfil
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                <div class="contenido">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2 ttlp">
                                <h1>Perfil</h1>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3"> 
                    @if($agregar)
                        <button id="btnAdd" type="button" class="btnAdc col-md-offset-11" data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-plus"></i> AGREGAR</button>
                    @endif   
                        @foreach($consulta as $perfiles)
                            <div class="contMd" style="">
                                <div class="icl">
                                    @foreach($acciones as $accion)
                                        @if($accion->id!=85)
                                           <span class="iclsp">
                                               <a href="{{$accion->url.$perfiles->id}}" class="tltp modificarperfil" id="m{{$perfiles->id}}" data-ttl="{{$accion->descripcion}}">
                                                   <i class="{{$accion->clase_css}}"></i>                                                   
                                               </a>
                                           </span>
                                        @elseif($accion->id==85)
                                             @if($perfiles->status_per==1)
                                           <div class="chbx">
                                               <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $perfiles->id}}" value="{{$accion->status_ac}}" checked><label for="{{'inchbx'. $perfiles->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                           </div>
                                           @elseif($perfiles->status_per==0)
                                               <div class="chbx">
                                                   <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $perfiles->id}}" value="{{$accion->status_ac}}"><label for="{{'inchbx'. $perfiles->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                               </div>
                                           @endif
                                        @endif
                                    @endforeach
                                </div>
                                <input type="text" class="" value="{{$perfiles->id}}" id="idperfilm{{$perfiles->id}}">
                                <p class="ttlMd"><strong>{{$perfiles->descripcion}}</strong></p>
                            </div>
                        @endforeach
                    </div>
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Agregar Perfil</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="">
                                        <div class="container-fluid contpfl">
                                           <div class="row">
                                               <div class="rPfl">
                                                  <div class="col-md-8 col-md-offset-2">
                                                      <div class="form-group row">
                                                          <label for="duPfl">Nombre del Perfil</label>
                                                          <input type="text" class="form-control" name="duPfl" id="duPfl"><i class="fa fa-id-badge icpfl"></i>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-8 col-md-offset-2">
                                                      <div class="form-group row">
                                                          <label for="stPfl">Estatus del Perfil</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                          <select name="stPfl" id="stPfl" class="form-control">
                                                              <option value="0">-</option>
                                                              <option value="1">Activo</option>
                                                              <option value="2">Inactivo</option>
                                                          </select><i class="fa fa-check icpfl"></i>
                                                      </div>
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