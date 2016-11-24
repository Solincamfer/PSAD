@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Departamento
        @endsection
        @include('layout/header')
                @include('layout/sidebar')
            <div class="contenido">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 ttlp">
                            <h1>Departamento</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3">
                @if($agregar)
                    <button id="btnAdd" type="button" class="btnAdc col-md-offset-11" data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-plus"></i> AGREGAR</button>
                @endif   
                    @foreach($consulta as $departamento)
                        <div class="contMd">
                            <div class="icl">
                                @foreach($acciones as $accion)
                                    @if($accion->descripcion!="Status" )
                                        @if($accion->data_toogle=="modal")
                                            <span class="iclsp">
                                                <a href="#myModal2" class="tltp" data-ttl="{{$accion->descripcion}}" data-toggle="modal" data-target="#myModal2"> 
                                                    <i class="{{$accion->clase_css}}"></i>
                                                </a>
                                            </span>
                                        @elseif($accion->data_toogle!="modal")
                                            <span class="iclsp">
                                                <a href="{{$accion->url.$departamento->id}}" class="tltp" data-ttl="{{$accion->descripcion}}">
                                                    <i class="{{$accion->clase_css}}"></i>
                                                </a>
                                            </span>
                                        @endif
                                    @elseif($accion->descripcion=="Status" )
                                        @if($departamento->status_d==1)
                                            <div class="chbx">
                                                <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $departamento->id}}" value="{{$accion->status_ac}}" checked><label for="{{'inchbx'. $departamento->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                            </div>
                                        @elseif($departamento->status_d==0)
                                            <div class="chbx">
                                                <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $departamento->id}}" value="{{$accion->status_ac}}"><label for="{{'inchbx'. $departamento->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                            <p class="ttlMd"><strong>{{$departamento->nombre_d}}</strong></p>
                        </div>
                    @endforeach
                </div>
                <!-- Modal -->
                @if($agregar)
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><strong>Agregar Departamento</strong></h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" class="form-horizontal Validacion" action="">
                                    {{ csrf_field() }}
                                    <div class="container-fluid" id="contdpto">
                                        <div class="row">
                                            <div id="dpto">
                                               <div class="col-md-8 col-md-offset-2">
                                                   <div class="form-group row">
                                                       <label for="nomDpto">Nombre del Departamento</label>
                                                       <input type="text" name="textDpto" class="form-control" id="nomDpto"/><i class="fa fa-briefcase" id="icdp1"></i>
                                                   </div>
                                               </div>
                                               <div class="col-md-8 col-md-offset-2">
                                                   <div class="form-group row">
                                                       <label for="stDpto">Estatus del Departamento</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                       <select name="comboDpto" class="form-control" id="stDpto">
                                                           <option value="">-</option>
                                                           <option value="1">Activo</option>
                                                           <option value="2">Inactivo</option>
                                                       </select><i class="fa fa-check" id="icdp2"></i>
                                                   </div>
                                               </div> 
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="bttnMd" id="btnSv">Guardar <i class="fa fa-floppy-o"></i></button>
                                        <button type="button" class="bttnMd" data-dismiss="modal" id="btnCs">Cerrar <i class="fa fa-times"></i></button>
                                    </div>
                                </form>
                            </div>                           
                        </div>
                    </div>
                </div> 
               @endif 
            </div>
    @endsection
