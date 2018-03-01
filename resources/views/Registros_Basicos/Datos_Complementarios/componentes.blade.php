@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Datos Complementarios
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                <div class="contenido">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4 ttlp">
                                <h1>Gestión de Tipo de Equipo</h1>
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
                        @foreach($consulta as $tipoEquipo)
                            <div class="contMd" style="">
                                <div class="icl">
                                    @foreach($acciones as $accion)
                                              @if($accion->id==102)
                                                    <span class="iclsp">
                                                        <a class="tltp ModificartEquipo" id="ModificaEquipo{{$tipoEquipo->id}}" data-reg="{{$tipoEquipo->id}}" data-ttl="{{$accion->descripcion}}" data-toggle="modal"> 
                                                          <i class="{{$accion->clase_css}}"></i>
                                                       </a>
                                                    </span>
                                              @elseif($accion->id==103)
                                                   <span class="iclsp">
                                                       <a href="{{$accion->url.$tipoEquipo->id}}" class="tltp modificarperfil" id="m{{$tipoEquipo->id}}" data-ttl="{{$accion->descripcion}}">
                                                           <i class="{{$accion->clase_css}}"></i>                                                   
                                                       </a>
                                                   </span>
                                              @elseif($accion->id==104)
                                                   <span class="iclsp">
                                                       <a href="{{$accion->url.$tipoEquipo->id}}" class="tltp modificarperfil" id="m{{$tipoEquipo->id}}" data-ttl="{{$accion->descripcion}}">
                                                           <i class="{{$accion->clase_css}}"></i>                                                   
                                                       </a>
                                                   </span>
                                              @elseif($accion->id==105)
                                                   <span class="iclsp">
                                                       <a href="{{$accion->url.$tipoEquipo->id}}" class="tltp modificarperfil" id="m{{$tipoEquipo->id}}" data-ttl="{{$accion->descripcion}}">
                                                           <i class="{{$accion->clase_css}}"></i>                                                   
                                                       </a>
                                                   </span>
                                              @endif
                                    @endforeach
                                </div>
                                <p class="ttlMd"><strong>{{$tipoEquipo->descripcion}}</strong></p>

                            </div>
                        @endforeach
                       
                    </div>

          <!--   Modal Agregar --> 

                    @if($agregar)
                    <div class="modal fade" id="myModal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Agregar Tipo de Equipo</h4>
                                </div>
                                <form method="post" class="form-horizontal" id="NewPerfil">
                                  <div class="modal-body">
                                      {{ csrf_field() }}
                                        <div class="container-fluid contpfl">
                                           <div class="row">
                                               <div class="rPfl">
                                                  <div class="col-md-8 col-md-offset-2">
                                                      <div class="form-group row">
                                                          <label for="DescripcionAdd">Nombre del Tipo de Equipo</label>
                                                          <input type="text" class="form-control" name="DescripcionAdd" id="DescripcionAdd"><i class="fa fa-id-badge icpfl"></i>
                                                      </div>
                                                  </div>
                                               </div>
                                           </div>
                                        </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="submit" class="bttnMd btn" id="savePerfil">Guardar <i class="fa fa-floppy-o"></i></button>
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
                                    <h4 class="modal-title" id="myModalLabel2">Modificar Tipo de Equipo</h4>
                                </div>
                                <div class="modal-body">
                                    <form  method="post" id="forActPerf">
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

                                                  <input type="hidden" class="form-control descripcion" name="Registro" id="tipoEquipoRegistry" value="">
                                               </div>
                                               
                                           </div>
                                        </div>
                                      
                                </div>
                                <div class="modal-footer">
                                  <div class="form-group">
                                    <button type="submit" class="bttnMd btn"> Guardar <i class="fa fa-floppy-o"></i></button>
                                  </div>
                                </div>
                                 
                               </form>
                            </div>
                        </div>
                    </div>

                </div>   
    @endsection
    @section('js')
      <script type="text/javascript" src="{{ asset('js/datos_complementarios.js') }}"></script>
    @endsection