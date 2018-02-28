@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Pieza - Componentes
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                    <div class="contenido">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4 ttlp">
                                    <h1>{{$extra->descripcion.'  '}} - Pieza</h1>
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
                                                <input type="search" class="form-control filtro" placeholder="Buscar pieza..."><span class="fa fa-search"></span>
                                            </div>
                                        </form> 
                                        <a class="bttn-search">
                                            <span class="fa fa-search"></span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-2 despl-bttn">
                                    <a href="/menu/registros/clientes/categoria/sucursal/equipos/componentes/{{$extra->equipo_id}}">
                                        <div class="bttn-volver">
                                            <button id="btnBk" type="button" href="#" class="bttn-vol"><span class="fa fa-chevron-left"></span><span class="txt-bttn">VOLVER</span></button>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
                            
                            @foreach($consulta as $pieza)
                            <div class="contMd" style="">
                                <div class="icl">
                                    @foreach($acciones as $accion)
                                        @if($accion->id!=55)
                                            @if($accion->id==54)
                                                <span class="iclsp">
                                                    <a  class="modificarPieza" data-reg="{{$pieza->id}}" data-ttl="{{$accion->descripcion}}" data-toggle="modal" > 
                                                        <i class="{{$accion->clase_css}} _ModificarPieza_" data-pieza="{{$pieza->id}}"></i>
                                                    </a>
                                                </span>
                                            @elseif($accion->id!=54)
                                                <span class="iclsp">
                                                    <a href="{{$accion->url}}" class="tltp" data-ttl="{{$accion->descripcion}}">
                                                        <i class="{{$accion->clase_css}}"></i>
                                                    </a>
                                                </span>
                                            @endif
                                        @elseif($accion->id==55)
                                            @if($pieza->status==1)
                                                <div class="chbx">
                                                    <input type="checkbox" class="checkPiezas" data-reg="{{$pieza->id}}"  name="status" id="{{'checkPi'. $pieza->id}}" value="{{$pieza->status}}" checked><label for="{{'checkPi'. $pieza->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                                </div>
                                            @elseif($pieza->status==0)
                                                <div class="chbx">
                                                    <input type="checkbox" class="checkPiezas"   data-reg="{{$pieza->id}}"  name="status" id="{{'checkPi'. $pieza->id}}" value="{{$pieza->status}}"><label for="{{'checkPi'. $pieza->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                                <p class="ttlMd"><strong>{{$pieza->descripcion}}</strong></p>
                            </div>
                            @endforeach
                              <div class="paginador">
                                    {{ $consulta->links() }}
                              </div>
							
                        </div>
                        <!-- 	Registro -->


                        <!-- Modal Agregar-->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Agregar Pieza</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form id="pieZaAgr">
                                            {{ csrf_field() }}
                                            <div class="container-fluid" id="contpz">
                                                <div id="rPz2">
                                                    <div class="col-md-8 col-md-offset-2">
                                                       <div class="form-group row">
                                                           <label for="selectNP1">Nombre de la Pieza</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="selectNP" class="form-control userEmail selectPiezas" id="selectNP1" data-caso="0" data-grupo="0">
                                                                <option value="">-</option>
                                                               @foreach($datosC1 as $pieza)
                                                                    <option value="{{$pieza->id}}">{{$pieza->descripcion}}</option>
                                                               @endforeach
                                                            </select>
                                                       </div>
                                                    </div>
                                                </div>
                                                <div id="rPz1">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="serialPIZ1">Serial de la Pieza</label>
                                                            <input type="text" class="form-control" name="serialPIZ" id="serialPIZ1"><i class="fa fa-barcode" id="icpz2"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="rPz2">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="selectMP1">Marca de la Pieza</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="selectMP" class="form-control selectPiezas" id="selectMP1" data-caso="1" data-grupo="0">
                                                                <option value="">-</option>
                                                            </select><i class="fa fa-apple" id="icpz4"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="rPz3">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="selectMOP1">Modelo de la Pieza</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="selectMOP" class="form-control selectPiezas" id="selectMOP1" data-caso="2" data-grupo="0">
                                                                <option value="">-</option>
                                                            </select><i class="fa fa-microchip" id="icpz5"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 col-md-offset-2">
                                                       <div class="form-group row">
                                                           <label for="selectSTP1">Estatus de Pieza</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                           <select name="selectSTP" class="form-control" id="selectSTP1">
                                                               <option value="">-</option>
                                                               <option value="1">Activo</option>
                                                               <option value="0">Inactivo</option>
                                                           </select><i class="fa fa-check" id="icpz6"></i>
                                                       </div>
                                                    </div>
                                                    <input type="hidden" name="RegComponente__" id="RegComponente__" value={{$extra->id}}>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="bttnMd" id="btnSvPieza__">Guardar <i class="fa fa-floppy-o"></i></button>
                                      </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Modal Modificar-->
                        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel2">Modificar Pieza</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form id="pieZaMod">
                                            {{ csrf_field() }}
                                            <div class="container-fluid" id="contpzm">
                                                <div id="rPzm2">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="selectNP2">Nombre de la Pieza</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="selectNP" class="form-control userEmail selectPiezas" id="selectNP2" data-caso="0" data-grupo="1">
                                                                <option value="">-</option>
                                                               @foreach($datosC1 as $pieza)
                                                                    <option value="{{$pieza->id}}">{{$pieza->descripcion}}</option>
                                                               @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="rPzm1">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                             <label for="serialPIZ2">Serial de la Pieza</label>
                                                            <input type="text" class="form-control" name="serialPIZ" id="serialPIZ2"><i class="fa fa-barcode" id="micpz2"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="rPzm2">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                             <label for="selectMP2">Marca de la Pieza</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="selectMP" class="form-control selectPiezas" id="selectMP2" data-caso="1" data-grupo="1">
                                                                <option value="">-</option>
                                                            </select><i class="fa fa-apple" id="micpz4"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="rPzm3">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="selectMOP2">Modelo de la Pieza</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="selectMOP" class="form-control selectPiezas" id="selectMOP2" data-caso="2" data-grupo="1">
                                                                <option value="">-</option>
                                                            </select><i class="fa fa-microchip" id="micpz5"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="selectSTP2">Estatus de Pieza</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                           <select name="selectSTP" class="form-control" id="selectSTP2">
                                                               <option value="">-</option>
                                                               <option value="1">Activo</option>
                                                               <option value="0">Inactivo</option>
                                                           </select><i class="fa fa-check" id="micpz6"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="RegPieza__" id="RegPieza__" value="">
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="bttnMd" id="btnSvmPieza__">Guardar <i class="fa fa-floppy-o"></i></button>
                                     </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    @endsection
    @section('js')
        <script src="{{asset('js/vistaPiezas.js')}}"></script>
    @endsection