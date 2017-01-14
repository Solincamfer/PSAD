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
                        <div class="col-md-4 ttlp">
                            <h1>{{$datosC2}} - Cargos</h1>
                        </div>
                        <div  class="col-md-2  col-md-offset-1 buscador">
                            <form action="" method="">
                                <div class="input-group">
                                    <input type="search" class="form-control filtro" placeholder="Buscar Cargo...">
                                </div>
                           </form> 
                        </div>
                    </div>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3">
                
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2" align="left">
                                    <a href="/menu/registros/departamentos"><button id="btnBk" type="button" class="btnBk" href="#"><i class="fa fa-chevron-left"></i> VOLVER</button></a>
                                </div>
                            @if($agregar)
                                <div class="col-md-2 col-md-offset-3">
                                    <button id="btnAdd" type="button" class="btnAd" data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-plus"></i> AGREGAR</button> 
                                </div>
                            @endif
                            </div>
                        </div>

                    @foreach($consulta as $cargo)
                        <div class="contMd" style="">
                            <div class="icl">
                                @foreach($acciones as $accion)
                                    @if($accion->id!=5 )
                                        @if($accion->id==6)
                                            <span class="iclsp">
                                                <a href="#myModal2" class="tltp ModificaR" id="ModificaCar{{$cargo->id}}" data-ttl="{{$accion->descripcion}}" data-toggle="modal" data-target="#myModal2"> 
                                                    <i class="{{$accion->clase_css}}"></i>
                                                </a>
                                            </span>
                                        @elseif($accion->id!=6)

                                            <span class="iclsp">
                                                <a href="{{$accion->url}}" class="EliminarR" data-ttl="{{$accion->descripcion}}" id="EliminarCar{{$cargo->id}}" data-ttl="{{$accion->descripcion}}" >
                                                    <i class="{{$accion->clase_css}}"></i>
                                                </a>
                                            </span>
                                        @endif
                                    @elseif($accion->id==5)
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
                    <div class="paginador">
                        {{ $consulta->links() }}
                    </div>
                      <input type="hidden"   name="TND"  value="{{$extra}}">
                </div>
                
                <!-- Modal Agregar -->

                @if($agregar)
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><strong>Agregar Cargo</strong></h4>
                            </div>
                            <div class="modal-body">

                                <form method="post" class="form-horizontal DepCarPer" id="NewCarg" >
                                    <input type="hidden"   name="depID" id="depID" value="{{$datosC1}}">
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
                                                   <select id="stCgo_" class="form-control Empty" name="comboCgo">
                                                        <option value="">-</option>
                                                        <option value="1">ACTIVO</option>
                                                        <option value="0">INACTIVO</option>
                                                   </select><i class="fa fa-check" id="iccg2"></i>
                                               </div>
                                           </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" id="saveCargo" class="bttnMd" >Guardar <i class="fa fa-floppy-o"></i></button>
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
                                <form class="form-horizontal DepCarPer" >
                                    {{ csrf_field() }}
                                    <div class="container-fluid" id="contcgo">

                                        <div id="cgom">
                                            <div class="col-md-8 col-md-offset-2">
                                                <div class="form-group row">
                                                    <label for="nomCgom_">Nombre del cargo</label>
                                                    <input type="text" class="form-control descripcion" name="Descripcion" id="nomCgom_" /><i class="fa fa-id-badge " id="miccg1"></i>                     
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-md-offset-2">
                                                <div class="form-group row">
                                                    <label for="stCgom_">Estatus del Cargo</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                    <select id="stCgom_" class="form-control status" name="Status">
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
                                        <button type="submit" class="bttnMd" id="mDepCarPer">Guardar <i class="fa fa-floppy-o"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endsection    