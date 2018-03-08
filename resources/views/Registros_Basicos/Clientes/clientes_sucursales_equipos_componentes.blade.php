@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Componente - Equipos
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                    <div class="contenido">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4 ttlp">
                                    <h1>{{$datosC1->descripcion.'  '}} - Componentes</h1>
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
                                                <input type="search" class="form-control filtro" placeholder="Buscar componente..."><span class="fa fa-search"></span>
                                            </div>
                                        </form> 
                                        <a class="bttn-search">
                                            <span class="fa fa-search"></span>
                                        </a>
                                    </div> --}}
                                </div>
                                <div class="col-md-2 despl-bttn">
                                    <a href="/menu/registros/clientes/categoria/sucursal/equipos/{{$extra->id}}">
                                        <div class="bttn-volver">
                                            <button id="btnBk" type="button" href="#" class="bttn-vol"><span class="fa fa-chevron-left"></span><span class="txt-bttn">VOLVER</span></button>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
                           
                            @foreach($consulta as $componente)
                                <div class="contMd" style="">
                                    <div class="icl">
                                        @foreach($acciones as $accion)
                                            @if($accion->id!=47)
                                                @if($accion->id==46)
                                                    <span class="iclsp">
                                                        <a class="modificarComponente" data-reg="{{$componente->id}}" data-ttl="{{$accion->descripcion}}" data-toggle="modal" > 
                                                            <i class="{{$accion->clase_css}} _ModificarComponente_" data-componente="{{$componente->id}}"></i>
                                                        </a>
                                                    </span>
                                                @elseif($accion->id==48)
                                                    <span class="iclsp">
                                                        <a href="{{$accion->url.$componente->id}}" class="tltp" data-ttl="{{$accion->descripcion}}">
                                                            <i class="{{$accion->clase_css}}"></i>
                                                        </a>
                                                    </span>
                                                @elseif($accion->id==112)
                                                     <span class="iclsp">
                                                            <a class="_eliminarComp_" id="elComp{{$componente->id}}" data-reg="{{$componente->id}}" data-ttl="{{$accion->descripcion}}">
                                                               <i class="{{$accion->clase_css}}"></i>
                                                          </a>
                                                        </span>
                                                @endif
                                            @elseif($accion->id==47)
                                                @if($componente->status==1)
                                                    <div class="chbx">
                                                        <input type="checkbox" class="checkComponente"  data-reg="{{$componente->id}}" name="status" id="{{'checkComp'. $componente->id}}" value="{{$componente->status}}" checked><label for="{{'checkComp'. $componente->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                                    </div>
                                                @elseif($componente->status==0)
                                                    <div class="chbx">
                                                        <input type="checkbox" class="checkComponente" data-reg="{{$componente->id}}" name="status" id="{{'checkComp'. $componente->id}}" value="{{$componente->status}}"><label for="{{'checkComp'. $componente->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                                    </div>
                                                @endif
                                            
                                 
                                            @endif
                                        @endforeach
                                    </div>
                                    <p class="ttlMd"><strong>{{$componente->descripcion}}</strong></p>
                                </div>
                            @endforeach
                            <div class="paginador">
                                {{ $consulta->links() }}
                            </div>
							
                        </div>
                        <!--Registro-->


                        <!--Modal-->
                        @if($agregar)
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Agregar Componente</h4>
                                    </div>
                                    <form id="compAgr_" class="Validacion">
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            <div class="container-fluid" id="contcomp">
                                                <div id="rComp5">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="selectNC1">Nombre del Componente</label>
                                                            <span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                            <select name="selectNC" class="form-control userEmail selectComponentes" id="selectNC1" data-caso="0" data-grupo="0">
                                                                <option value="">-</option>
                                                               @foreach($datosC2 as $componente)
                                                                    <option value="{{$componente->id}}">{{$componente->descripcion}}</option>
                                                               @endforeach
                                                            </select><i class="fa fa-cog" id="iccp5"></i>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="rComp1">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="serialCM1">Serial del Componente</label>
                                                            <input type="text" class="form-control userEmail" name="serialCM" id="serialCM1"><i class="fa fa-barcode" id="iccp2"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="rComp2">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="selectMC1">Marca del Componente</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="selectMC" class="form-control userEmail selectComponentes" id="selectMC1" data-caso="1" data-grupo="0">
                                                                <option value="">-</option>
                                                            </select><i class="fa fa-apple" id="iccp4"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="rComp3">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="selectMOC1">Modelo del Componente</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="selectMOC" class="form-control userEmail selectComponentes" id="selectMOC1" data-caso="2" data-grupo="0">
                                                                <option value="">-</option>
                                                            </select><i class="fa fa-hdd-o" id="iccp5"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="selectSC1">Estatus del Componente</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="selectSC" class="form-control userEmail" id="selectSC1">
                                                                <option value="">-</option>
                                                                <option value="1">Activo</option>
                                                                <option value="0">Inactivo</option>
                                                            </select><i class="fa fa-check" id="iccp6"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="bttnMd" id="btnSvComponente_">Guardar <i class="fa fa-floppy-o"></i></button>
                                            
                                        </div>
                                        <input type="hidden" name="equipoPadre_" id='equipoPadre_' value="{{$datosC1->id}}">
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                        <!--Modal Modificar-->
                        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel2">Modificar Componente</h4>
                                    </div>
                                    <form id="compMod_" class="Validacion">
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            <div class="container-fluid" id="contcompm">
                                                <div id="rCompm5">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                           <label for="selectNC2">Nombre del Componente</label>
                                                           <span class="ic"><i class="fa fa-chevron-down"></i></span>
                                                            <select name="selectNC" class="form-control userEmail selectComponentes" id="selectNC2" data-caso="0" data-grupo="1">
                                                                <option value="">-</option>
                                                               @foreach($datosC2 as $componente)
                                                                    <option value="{{$componente->id}}">{{$componente->descripcion}}</option>
                                                               @endforeach
                                                            </select><i class="fa fa-cog" id="miccp5"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="rCompm1">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="serialCM2">Serial del Componente</label>
                                                            <input type="text" class="form-control userEmail" name="serialCM" id="serialCM2"><i class="fa fa-barcode" id="miccp2"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="rCompm2">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="selectMC2">Marca del Componente</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="selectMC" class="form-control userEmail selectComponentes" id="selectMC2" data-caso="1" data-grupo="1">
                                                                <option value="">-</option>
                                                            </select><i class="fa fa-apple" id="miccp4"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="rCompm3">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="selectMOC2">Modelo del Componente</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="selectMOC" class="form-control userEmail selectComponentes" id="selectMOC2" data-caso="2" data-grupo="1">
                                                                <option value="">-</option>
                                                            </select><i class="fa fa-hdd-o" id="miccp5"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="selectSC2">Estatus del Componente</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="selectSC" class="form-control userEmail" id="selectSC2">
                                                                <option value="">-</option>
                                                                <option value="1">Activo</option>
                                                                <option value="0">Inactivo</option>
                                                            </select><i class="fa fa-check" id="miccp6"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="registroComp_" id="registroComp_" value="">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="bttnMd" id="btnModificarComp_">Guardar <i class="fa fa-floppy-o"></i></button>  
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>   
    @endsection
    @section('js')
        <script src="{{asset('js/vistaComponentes.js')}}"></script>
    @endsection