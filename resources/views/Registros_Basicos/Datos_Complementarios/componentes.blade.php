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
                                <h1>{{$extra->descripcion}} > Componentes</h1>
                            </div>
                        </div>
                        <div class="row sep-div">
                            <div class="col-md-2 col-md-offset-7">
                                <a href="/menu/registros/datos/">
                                    <div class="bttn-volver">
                                        <button id="btnBk" type="button" href="#" class="bttn-vol"><span class="fa fa-chevron-left"></span><span class="txt-bttn">VOLVER</span></button>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 despl-bttn">
                                @if($agregar)
                                <div class="bttn-agregar">
                                    <button id="btnAdd" type="button" class="bttn-agr" data-toggle="modal" data-target="#myModal" href="#myModal"><span class="fa fa-plus"></span><span class="txt-bttn">AGREGAR</span></button>
                                    <input type="hidden" id="padreTipo" value='{{$extra->id}}'>
                                </div>
                                @endif
                            </div>
                           <!-- <div  class="col-md-4 despl-bttn">
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
                            </div>-->
                        </div>
                    </div>

                    <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" id="areaResultados" data-tabla="1">
                        {{ csrf_field() }}
                        @foreach($consulta as $tipoEquipo)
                            <div class="contMd" style="">
                                <div class="icl">
                                    @foreach($acciones as $accion)
                                              @if($accion->id==102)
                                                    <span class="iclsp">
                                                        <a class="tltp Modificar" id="ModificaEquipo{{$tipoEquipo->id}}" data-reg="{{$tipoEquipo->id}}" data-ttl="{{$accion->descripcion}}" data-toggle="modal">
                                                          <i class="{{$accion->clase_css}}"></i>
                                                       </a>
                                                    </span>
                                              @elseif($accion->id==103)
                                                   <span class="iclsp">
                                                       <a class="tltp Eliminar" id="e{{$tipoEquipo->id}}" data-reg="{{$tipoEquipo->id}}" data-ttl="{{$accion->descripcion}}">
                                                           <i class="{{$accion->clase_css}}"></i>
                                                       </a>
                                                   </span>
                                              @elseif($accion->id==104)
                                                   <span class="iclsp">
                                                       <a class="tltp Marca" id="m{{$tipoEquipo->id}}"  data-reg="{{$tipoEquipo->id}}" data-ttl="{{$accion->descripcion}}">
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

                <!--   Modal mostrar Marca y Modelo -->
                    <div class="modal fade" id="myModal1"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Marcas y Modelos de Componentes</h4>
                                </div>
                                <form method="post" class="form-horizontal" id="marcaModelo">
                                  <div class="modal-body">
                                      {{ csrf_field() }}
                                      <input type="hidden" class="form-control descripcion" name="registro" id="registry" value="">
                                        <div class="container-fluid contpfl">
                                           <div class="row">
                                               <div class="rPfl">
                                                  <div class="col-md-8 col-md-offset-2">
                                                      <div class="form-group">
                                                          <div class="col-md-8">
                                                            <label for="marca">Marcas del Componente</label>
                                                            <select  id="marca" class="form-control">
                                                              <option value="">-- Marcas --</option>
                                                            </select><i class=" icpfl"></i>
                                                          </div>
                                                          <div class="col-md-4">
                                                            <i class="fa fa-plus button-radio plus" id="plusMarca"></i>
                                                            <i class="fa fa-minus button-radio minus" id="minusMarca"> </i>
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-8 col-md-offset-2">
                                                      <div class="form-group row">
                                                        <div class="col-md-8">
                                                          <label for="modelo">Modelos</label>
                                                          <select  id="modelo" class="form-control">
                                                            <option value="">-- Modelos --</option>
                                                          </select><i class=" icpfl"></i>
                                                        </div>
                                                        <div class="col-md-4">
                                                          <i class="fa fa-plus button-radio plus" id="plusModelo"></i>
                                                          <i class="fa fa-minus button-radio minus" id="minusModelo"></i>
                                                        </div>
                                                      </div>
                                                  </div>
                                               </div>
                                           </div>
                                        </div>
                                  </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <!--   Modal Agregar Marca -->

                    <div class="modal fade" id="myModal2"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" >Agregar Nueva marca</h4>
                                </div>
                                  <div class="modal-body">
                                <form id="newMarca" >
                                      {{ csrf_field() }}
                                        <div class="container-fluid contpfl">
                                           <div class="row">
                                               <div class="rPfl">
                                                  <div class="col-md-8 col-md-offset-2">
                                                      <div class="form-group row">
                                                          <label for="descripcionMarca">Nombre de la Marca</label>
                                                          <input type="text" class="form-control" name="descripcionMarca" id="descripcionMarca"><i class="fa fa-id-badge icpfl"></i>
                                                      </div>
                                                  </div>
                                               </div>
                                           </div>
                                        </div>
                                  </div>
                                  <input type="hidden" class="form-control descripcion" name="padre" id="padreMarca" value="">
                                  <input type="hidden" name="padreTipoMarca" id="padreTipoMarca" val='{{$extra->id}}'>
                                  <div class="modal-footer">
                                      <button type="submit" class="bttnMd btn" id="prueba" >Guardar <i class="fa fa-floppy-o"></i></button>
                                  </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <!--   Modal Agregar Modelo -->
                    <div class="modal fade" id="myModal3"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Agregar Modelo</h4>
                                </div>
                                <form method="post" class="form-horizontal" id="newModelo">
                                  <div class="modal-body">
                                      {{ csrf_field() }}
                                        <div class="container-fluid contpfl">
                                           <div class="row">
                                               <div class="rPfl">
                                                  <div class="col-md-8 col-md-offset-2">
                                                      <div class="form-group row">
                                                          <label for="descripcionModelo">Nombre del Modelo</label>
                                                          <input type="text" class="form-control" name="descripcionModelo" id="descripcionModelo"><i class="fa fa-id-badge icpfl"></i>
                                                      </div>
                                                  </div>
                                               </div>
                                           </div>
                                        </div>
                                  </div>
                                  <input type="hidden" name="padreTipoModelo" id="padreTipoModelo" val='{{$extra->id}}'>
                                  <input type="hidden" class="form-control descripcion" name="componentePadre" id="padreModelo" value="">
                                  <input type="hidden" class="form-control descripcion" name="marcaPadre" id="marcaPadre" value="">
                                  <div class="modal-footer">
                                      <button type="submit" class="bttnMd btn">Guardar <i class="fa fa-floppy-o"></i></button>
                                  </div>
                                </form>
                            </div>
                        </div>
                    </div>

          <!--   Modal Agregar -->

                    @if($agregar)
                    <div class="modal fade" id="myModal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" >Agregar Componente</h4>
                                </div>
                                <form method="post" class="form-horizontal" id="newComponente">
                                  <div class="modal-body">
                                      {{ csrf_field() }}
                                        <div class="container-fluid contpfl">
                                           <div class="row">
                                               <div class="rPfl">
                                                  <div class="col-md-8 col-md-offset-2">
                                                      <div class="form-group row">
                                                          <label for="descripcionComponente">Nombre del Componente</label>
                                                          <input type="text" class="form-control" name="descripcionComponente" id="descripcionComponente" ><i class="fa fa-id-badge icpfl"></i>
                                                      </div>
                                                  </div>
                                               </div>
                                           </div>
                                        </div>
                                  </div>
                                  <input type="hidden" id="padreTipoComponente" name="padreTipoComponente" value='{{$extra->id}}'>
                                  <div class="modal-footer">
                                      <button type="submit" class="bttnMd btn">Guardar <i class="fa fa-floppy-o"></i></button>
                                  </div>
                                </form>
                            </div>
                        </div>
                    </div>
                  @endif

                <!--   modal modificar Componente -->
                  <div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Modificar Componente</h4>
                                </div>
                                <div class="modal-body">
                                    <form  method="post" id="modificarComponente">
                                      {{ csrf_field() }}
                                        <div class="container-fluid contpfl">
                                           <div class="row">
                                               <div class="rPfl">
                                                 <div class="col-md-8 col-md-offset-2">
                                                     <div class="form-group row">
                                                         <label for="Descripcion">Nombre del Componente</label>
                                                         <input type="text" class="form-control" name="descripcion" id="descripcion" value=""><i class="fa fa-id-badge icpfl"></i>
                                                     </div>
                                                 </div>
                                                  <input type="hidden" class="form-control descripcion" name="registro" id="registro" value="">
                                                  <input type="hidden" id="padreTipoComponenteM" name="padreTipoComponenteM" value='{{$extra->id}}'>
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
      <script type="text/javascript" src="{{ asset('js/componentes.js') }}"></script>
    @endsection
