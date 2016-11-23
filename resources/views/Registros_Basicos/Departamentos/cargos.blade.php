@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Cargos -Departamentos
        @endsection
        @include('layout/header')
                @include('layout/sidebar')
            <div class="contenido">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 ttlp">
                            <h1>Departamentos - Cargos</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style="">
                    @if($agregar) 
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2" align="left">
                                    <a href="/menu/registros/departamentos"><button id="btnBk" type="button" class="btnBk" href="#"><i class="fa fa-chevron-left"></i> VOLVER</button></a>
                                </div>
                                <div class="col-md-2 col-md-offset-3">
                                    <button id="btnAdd" type="button" class="btnAd" data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-plus"></i> AGREGAR</button> 
                                </div>
                            </div>
                        </div>
                    @endif
                    @foreach($consulta as $cargo)
                        <div class="contMd" style="">
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
                                                <a href="{{$accion->url}}" class="tltp" data-ttl="{{$accion->descripcion}}">
                                                    <i class="{{$accion->clase_css}}"></i>
                                                </a>
                                            </span>
                                        @endif
                                    @elseif($accion->descripcion=="Status")
                                        @if($cargo->status_c==1)
                                            <div class="chbx">
                                                <input type="checkbox" class="btnAcc" name="status" id="inchbx1" value="{{$accion->status_ac}}" checked><label for="inchbx1" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                            </div>
                                        @elseif($cargo->status_c==0)
                                            <div class="chbx">
                                                <input type="checkbox" class="btnAcc" name="status" id="inchbx2" value="{{$accion->status_ac}}"><label for="inchbx2" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>
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
                                    {{ csrf_field() }}
                                    <div class="container-fluid" id="contcgo">
                                        
                                        <div id="cgo">
                                           <div class="col-md-8 col-md-offset-2">
                                               <div class="form-group row">
                                                   <label for="nomCgo">Nombre del cargo</label>
                                                   <input type="text" class="form-control" name="textCgo" id="nomCgo" /><i class="fa fa-id-badge" id="iccg1"></i>                     
                                               </div>
                                           </div>
                                           <div class="col-md-8 col-md-offset-2">
                                               <div class="form-group row">
                                                   <label for="stCgo">Estatus del Cargo</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                   <select id="stCgo" class="form-control" name="comboCgo">
                                                       <option value="">-</option>
                                                       <option value="1">Activo</option>
                                                       <option value="2">Inactivo</option>
                                                   </select><i class="fa fa-check" id="iccg2"></i>
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
            </div>
    @endsection    