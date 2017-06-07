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
                            <div  class="col-md-4 col-md-offset-5 search">
                                <form action="" method="">
                                    <div class="input-group">
                                        <input type="search" class="form-control filtro" placeholder="Buscar perfil..."><span class="fa fa-search"></span>
                                    </div>
                                </form> 
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
                                              @if($accion->id==84)
                                                    <span class="iclsp">
                                                        <a href="#myModal2" class="tltp ModificaR" id="ModificaPer{{$perfiles->id}}" data-ttl="{{$accion->descripcion}}" data-toggle="modal" data-target="#myModal2"> 
                                                             <i class="{{$accion->clase_css}}"></i>
                                                       </a>
                                                    </span>
                                              @elseif($accion->id!=84)
                                                   <span class="iclsp">
                                                       <a href="{{$accion->url.$perfiles->id}}" class="tltp modificarperfil" id="m{{$perfiles->id}}" data-ttl="{{$accion->descripcion}}">
                                                           <i class="{{$accion->clase_css}}"></i>                                                   
                                                       </a>
                                                   </span>
                                              @endif

                                        @elseif($accion->id==85)
                                             @if($perfiles->status==1)
                                           <div class="chbx">
                                               <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $perfiles->id}}" value="{{$perfiles->status}}" checked><label for="{{'inchbx'. $perfiles->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                           </div>
                                           @elseif($perfiles->status==0)
                                               <div class="chbx">
                                                   <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $perfiles->id}}" value="{{$perfiles->status}}"><label for="{{'inchbx'. $perfiles->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                               </div>
                                           @endif
                                        @endif
                                    @endforeach
                                </div>
                                <p class="ttlMd"><strong>{{$perfiles->descripcion}}</strong></p>

                            </div>
                        @endforeach
                        <div class="paginador">
                          {{ $consulta->links() }}
                        </div>
                        <input type="hidden"   name="TND"  value="{{$extra}}">
                    </div>

          <!--   Modal Agregar --> 

                    @if($agregar)
                    <div class="modal fade" id="myModal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Agregar Perfil</h4>
                                </div>
                                <div class="modal-body">
                                    <form method="post" class="DepCarPer" id="NewPerfil">
                                      {{ csrf_field() }}
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
                                                              <option value="">-</option>
                                                              <option value="1">ACTIVO</option>
                                                              <option value="0">INACTIVO</option>
                                                          </select><i class="fa fa-check icpfl"></i>
                                                      </div>
                                                  </div> 
                                               </div>
                                           </div>
                                        </div>
                                   
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="bttnMd" id="savePerfil">Guardar <i class="fa fa-floppy-o"></i></button>
                                </div>
                               </form>
                            </div>
                        </div>
                    </div>
                  @endif

                <!--   modal modificar -->
                  <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel2">Modificar Perfil</h4>
                                </div>
                                <div class="modal-body">
                                    <form  class="DepCarPer">
                                      {{ csrf_field() }}
                                        <div class="container-fluid contpfl">
                                           <div class="row">
                                               <div class="rPfl">
                                                  <div class="col-md-8 col-md-offset-2">
                                                      <div class="form-group row">
                                                          <label for="duPfl_">Nombre del Perfil</label>
                                                          <input type="text" class="form-control descripcion" name="Descripcion" id="duPfl_"><i class="fa fa-id-badge icpfl"></i>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-8 col-md-offset-2">
                                                      <div class="form-group row">
                                                          <label for="stPfl_">Estatus del Perfil</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                          <select name="Status" id="stPfl_" class="form-control status">
                                                              <option value="-">-</option>
                                                              <option value="1">ACTIVO</option>
                                                              <option value="0">INACTIVO</option>
                                                          </select><i class="fa fa-check icpfl"></i>
                                                      </div>
                                                  </div> 
                                               </div>
                                               <input type="hidden" value="" id="MIndexP" name="MIndex">
                                           </div>
                                        </div>
                                      
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="bttnMd" id="mDepCarPer"> Guardar <i class="fa fa-floppy-o"></i></button>
                                </div>
                                 
                               </form>
                            </div>
                        </div>
                    </div>

                </div>   
    @endsection