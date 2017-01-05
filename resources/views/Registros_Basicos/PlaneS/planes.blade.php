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
                        <div class="col-md-2 ttlp">
                            <h1>Planes</h1>
                        </div>
                        <div  class="col-md-3  col-md-offset-2 buscador">
                            <form action="" method="">
                                <div class="input-group">
                                    <input type="search" class="form-control filtro" placeholder="Buscar Planes...">
                                </div>
                           </form> 
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
                   @foreach($consulta as $planes)
                        <div class="contMd">
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
                                        @if($planes->status==1)
                                            <div class="chbx">
                                                <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $planes->id}}" value="{{$planes->status}}" checked><label for="{{'inchbx'. $planes->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                            </div>
                                        @elseif($planes->status==0)
                                            <div class="chbx">
                                                <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $planes->id}}" value="{{$planes->status}}"><label for="{{'inchbx'. $planes->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                            <p class="ttlMd"><strong>{{$planes->nombreP}}</strong></p>
                        </div>
                    @endforeach
                    <div class="paginador">
                        {{ $consulta->links() }}
                    </div>
                    <input type="hidden"   name="TND"  value="{{$extra}}">
                </div>


                <!-- MODAL AGREGAR -->

                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Agregar Plan</h4>
                            </div>
                            <form method="post" id="NewPlan" action="" class="form-horizontal DepCarPer">
                                <div class="modal-body">
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
                                                   <input type="text" name="porDes" id="porDes"><i class="fa fa-percent" id="icpn2"></i>
                                               </div>
                                            </div>
                                            <div class="col-md-8 col-md-offset-2">
                                                <div class="form-group row">
                                                    <label for="stPn">Estatus del Plan</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                    <select name="stPn" id="stPn">
                                                        <option value="">-</option>
                                                        <option value="1">Activo</option>
                                                        <option value="2">Inactivo</option>
                                                    </select><i class="fa fa-check" id="icpn4"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>        
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="bttnMd" id="savePlan">Guardar <i class="fa fa-floppy-o"></i>
                                    </button>  
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Modal Modificar-->
                <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel2">Modificar Plan</h4>
                            </div>
                            <div class="modal-body">
                                <form action="">
                                    {{ csrf_field() }}
                                    <div class="container-fluid" id="contpn">
                                        <div class="rPnm">
                                            <div class="col-md-8 col-md-offset-2">
                                                <div class="form-group row">
                                                    <label for="nomPnm">Nombre del plan</label>
                                                    <input type="text" name="nomPnm" id="nomPnm"><i class="fa fa-cubes" id="micpn1"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-md-offset-2">
                                                <div class="form-group row">
                                                    <label for="porDesm">Porcentaje de descuento</label>
                                                    <input type="number" name="porDesm" id="porDesm"><i class="fa fa-percent" id="micpn2"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-md-offset-2">
                                                <div class="form-group row">
                                                    <label for="stPnm">Estatus del Plan</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                    <select name="stPnm" id="stPnm">
                                                        <option value="">-</option>
                                                        <option value="1">Activo</option>
                                                        <option value="2">Inactivo</option>
                                                    </select><i class="fa fa-check" id="micpn4"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="bttnMd" id="btnSvm">Guardar <i class="fa fa-floppy-o"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endsection