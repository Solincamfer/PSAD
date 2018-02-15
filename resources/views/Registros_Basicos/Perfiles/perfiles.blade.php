@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Perfil
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                <div class="contenido">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-2 ttlp">
                                <h1>Perfil</h1>
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
                                <div class="search-cont" id="scnt">
                                    <form action="" method="">
                                        <div class="input-group sci">
                                            <input type="search" class="form-control filtro" placeholder="Buscar perfil..."><span class="fa fa-search"></span>
                                        </div>
                                    </form> 
                                    <a class="bttn-search">
                                        <span class="fa fa-search"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" id="areaResultados" > 
                        {{ csrf_field() }}
                        @foreach($consulta as $perfiles)
                            <div class="contMd" style="">
                                <div class="icl">
                                    @foreach($acciones as $accion)
                                        @if($accion->id!=85)
                                              @if($accion->id==84)
                                                    <span class="iclsp">
                                                        <a class="tltp ModificarPerfil" id="ModificaPer{{$perfiles->id}}" data-reg="{{$perfiles->id}}"data-ttl="{{$accion->descripcion}}" data-toggle="modal" > 
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
                                               <input type="checkbox" class="checkPerfil" name="status" id="{{'inchbx'. $perfiles->id}}" value="{{$perfiles->status}}" data-reg="{{$perfiles->id}}" checked><label for="{{'inchbx'. $perfiles->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                           </div>
                                           @elseif($perfiles->status==0)
                                               <div class="chbx">
                                                   <input type="checkbox" class="checkPerfil" name="status" id="{{'inchbx'. $perfiles->id}}" value="{{$perfiles->status}}" data-reg="{{$perfiles->id}}"><label for="{{'inchbx'. $perfiles->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}" ></label>
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
                                    <form method="post" id="NewPerfil">
                                      {{ csrf_field() }}
                                        <div class="container-fluid contpfl">
                                           <div class="row">
                                               <div class="rPfl">
                                                  <div class="col-md-8 col-md-offset-2">
                                                      <div class="form-group row">
                                                          <label for="duPfl">Nombre del Perfil</label>
                                                          <input type="text" class="form-control" name="DescripcionAdd"><i class="fa fa-id-badge icpfl"></i>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-8 col-md-offset-2">
                                                      <div class="form-group row">
                                                          <label for="stPfl">Estatus del Perfil</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                          <select name="StatusAdd" class="form-control">
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
                                    <form  class="DepCarPer" id="forActPerf">
                                      {{ csrf_field() }}
                                        <div class="container-fluid contpfl">
                                           <div class="row">
                                               <div class="rPfl">
                                                  <div class="col-md-8 col-md-offset-2">
                                                      <div class="form-group row">
                                                          <label for="duPfl_">Nombre del Perfil</label>
                                                          <input type="text" class="form-control descripcion" name="Descripcion" id="perText"><i class="fa fa-id-badge icpfl"></i>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-8 col-md-offset-2">
                                                      <div class="form-group row">
                                                          <label for="stPfl_">Estatus del Perfil</label><span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                          <select name="Status" id="perStatus" class="form-control status">
                                                              <option value="-">-</option>
                                                              <option value="1">ACTIVO</option>
                                                              <option value="0">INACTIVO</option>
                                                          </select><i class="fa fa-check icpfl"></i>
                                                      </div>
                                                  </div> 

                                                  <input type="hidden" class="form-control descripcion" name="Registro" id="perfilRegistry" value="">
                                               </div>
                                               
                                           </div>
                                        </div>
                                      
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="bttnMd" id="actualizarPerfil" > Guardar <i class="fa fa-floppy-o"></i></button>
                                </div>
                                 
                               </form>
                            </div>
                        </div>
                    </div>

                </div>   
    @endsection
    @section('js')
      <script type="text/javascript" src="{{ asset('js/vista_perfil.js') }}"></script>
    @endsection