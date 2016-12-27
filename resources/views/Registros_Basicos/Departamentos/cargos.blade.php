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
                        <div class="col-md-3 ttlp">
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
                                                <a href="#myModal2" class="tltp ModificaR" id="ModificaCar{{$cargo->id}}" data-ttl="{{$accion->descripcion}}" data-toggle="modal" data-target="#myModal2"> 
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
                                        @if($cargo->status==1)
                                            <div class="chbx">
                                                <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $cargo->id}}" value="{{$cargo->status}}" checked><label for="{{'inchbx'. $cargo->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                            </div>
                                        @elseif($cargo->status==0)
                                            <div class="chbx">
                                                <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $cargo->id}}" value="{{$cargo->status}}"><label for="{{'inchbx'. $cargo->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                            <p class="ttlMd"><strong>{{$cargo->descripcion}}</strong></p>
                           
                        </div>
                    @endforeach
                      <input type="hidden"   name="TND"  value="{{$extra}}">
                </div>
                
                <!-- Modal -->
                @if($agregar)
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><strong>Agregar Cargo</strong></h4>
                            </div>
                            <div class="modal-body">

                                <form method="post" class="form-horizontal Validacion" action="/menu/registros/departamentos/cargos/registrar/{{$datosC1}}" >
                                    {{ csrf_field() }}
                                    <div class="container-fluid" id="contcgo">
                                        
                                        <div id="cgo">
                                           <div class="col-md-8 col-md-offset-2">
                                               <div class="form-group row">
                                                   <label for="nomCgo_">Nombre del cargo</label>
                                                   <input type="text" class="form-control" name="textCgo" id="nomCgo_" /><i class="fa fa-id-badge" id="iccg1"></i>                     
                                               </div>
                                           </div>
                                           <div class="col-md-8 col-md-offset-2">
                                               <div class="form-group row">
                                                   <label for="stCgo_">Estatus del Cargo</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                   <select id="stCgo_" class="form-control" name="comboCgo">
                                                       <option value="">-</option>
                                                       <option value="1">ACTIVO</option>
                                                       <option value="0">INACTIVO</option>
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
                @endif
                
                <!-- Modal Modificar-->
                <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" >
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel2"><strong>Modificar Cargo</strong></h4>
                            </div>
                            <div class="modal-body">

                                <form method="post" class="form-horizontal Validacion" action="/menu/registros/departamentos/actualizar/DC">
                                    {{ csrf_field() }}
                                    <div class="container-fluid" id="contcgo">

                                        <div id="cgom">
                                            <div class="col-md-8 col-md-offset-2">
                                                <div class="form-group row">
                                                    <label for="nomCgom_">Nombre del cargo</label>
                                                    <input type="text" class="form-control" name="Descripcion" id="nomCgom_" /><i class="fa fa-id-badge" id="miccg1"></i>                     
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-md-offset-2">
                                                <div class="form-group row">
                                                    <label for="stCgom_">Estatus del Cargo</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                    <select id="stCgom_" class="form-control" name="Status">
                                                        <option value="">-</option>
                                                        <option value="1">ACTIVO</option>
                                                        <option value="0">INACTIVO</option>
                                                    </select><i class="fa fa-check" id="miccg2"></i>
                                                </div>
                                            </div>

                                        </div>
                                         <input type="hidden" value="" id="MIndexC" name="MIndex">
                                         <input type="hidden" value="{{$datosC1}}" id="DCargo" name="DCargo">


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