@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Planes
        @endsection
          @include('layout/header')
                @include('layout/sidebar')
            <div class="contenido">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-2 ttlp">
                            <h1>Planes</h1>
                        </div>
                    </div>
                    <div class="row sep-div">
                        <div class="col-md-2 despl-bttn">
                            @if($agregar)
                            <div class="bttn-agregar">
                                <button id="btnAdd" type="button" class="bttn-agr" data-toggle="modal" data-target="#myModal" href="#myModal"><span class="fa fa-plus"></span><span class="txt-bttn">AGREGAR</span></button>
                            </div>
                            @endif 
                        </div>
                        <div  class="col-md-4 despl-bttn">
                            {{-- <div class="search-cont" id="scnt">
                                <form action="" method="">
                                    <div class="input-group sci">
                                        <input type="search" class="form-control filtro" placeholder="Buscar plan..."><span class="fa fa-search"></span>
                                    </div>
                                </form> 
                                <a class="bttn-search">
                                    <span class="fa fa-search"></span>
                                </a>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" id="areaResultados" > 
                 
                   @foreach($consulta as $planes)
                        <div class="contMd">
                            <div class="icl">
                                @foreach($acciones as $accion)
                                    @if($accion->id!=66)
                                        @if($accion->id==65)
                                            <span class="iclsp">
                                                <a  class="tltp ModificarPlan" data-reg="{{$planes->id}}"" data-ttl="{{$accion->descripcion}}"  data-toggle="modal" > 
                                                    <i class="{{$accion->clase_css}}"></i>
                                                </a>
                                            </span>
                                        @elseif($accion->id==67)
                                            <span class="iclsp">
                                                <a href="{{$accion->url.$planes->id}}" class="tltp consultarPlan" data-ttl="{{$accion->descripcion}}">
                                                    <i class="{{$accion->clase_css}}"></i>
                                                </a>
                                            </span>
                                         @elseif($accion->id==122)
                                                <span class="iclsp">
                                                      <a class="_eliminarPlan_" id="elimPlan{{$planes->id}}" data-reg="{{$planes->id}}" data-ttl="{{$accion->descripcion}}">
                                                         <i class="{{$accion->clase_css}}"></i>
                                                    </a>
                                              </span>
                                        @endif
                                    @elseif($accion->id==66)
                                        @if($planes->status==1)
                                            <div class="chbx">
                                                <input type="checkbox" class="checkPlan" name="status" id="{{'inchbx'. $planes->id}}" value="{{$planes->status}}" data-reg="{{$planes->id}}" checked><label for="{{'inchbx'. $planes->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                            </div>
                                        @elseif($planes->status==0)
                                            <div class="chbx">
                                                <input type="checkbox" class="checkPlan" name="status" id="{{'inchbx'. $planes->id}}" value="{{$planes->status}}" data-reg="{{$planes->id}}"><label for="{{'inchbx'. $planes->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
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
                                                   <input type="number" min="0" max="100" name="porDes" id="porDes"><i class="fa fa-percent" id="icpn2"></i>
                                               </div>
                                            </div>
                                            <div class="col-md-8 col-md-offset-2">
                                                <div class="form-group row">
                                                    <label for="stPn">Estatus del Plan</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                    <select name="stPn" id="stPn">
                                                        <option value="">-</option>
                                                        <option value="1">Activo</option>
                                                        <option value="0">Inactivo</option>
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
                            <form id="mPlan">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                        
                                        <input type="hidden" id="id_registro" value="">
                                        <div class="container-fluid" id="contpn">
                                            <div class="rPnm">
                                                <div class="col-md-8 col-md-offset-2">
                                                    <div class="form-group row">
                                                        <label for="nomPnm">Nombre del plan</label>
                                                        <input type="text" name="nomPlan" id="nomPlan"><i class="fa fa-cubes" id="micpn1"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-md-offset-2">
                                                    <div class="form-group row">
                                                        <label for="porDesm">Porcentaje de descuento</label>
                                                        <input type="number" name="porDesc" id="porDesc"><i class="fa fa-percent" id="micpn2"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-md-offset-2">
                                                    <div class="form-group row">
                                                        <label for="stPnm">Estatus del Plan</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                        <select name="statusPlan" id="statusPlan">
                                                            <option value="">-</option>
                                                            <option value="1">Activo</option>
                                                            <option value="0">Inactivo</option>
                                                        </select><i class="fa fa-check" id="micpn4"></i>
                                                    </div>
                                                </div>
                                                 <input type="hidden" class="form-control descripcion" name="registroPlan" id="planRegistry" value="">
                                            </div>
                                        </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="bttnMd" id="actualizarPlan">Guardar <i class="fa fa-floppy-o"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    @endsection
    @section('js')
        <script src="{{asset('js/vista_planes.js')}}"></script>
    @endsection