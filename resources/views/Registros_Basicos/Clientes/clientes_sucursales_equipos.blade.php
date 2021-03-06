@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Equipo
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                    <div class="contenido">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4 ttlp">
                                    <h1>{{$extra->nombreComercial.' - '}} Equipos</h1>
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
                                                <input type="search" class="form-control filtro" placeholder="Buscar equipo..."><span class="fa fa-search"></span>
                                            </div>
                                        </form> 
                                        <a class="bttn-search">
                                            <span class="fa fa-search"></span>
                                        </a>
                                    </div> --}}
                                </div>
                                <div class="col-md-2 despl-bttn">
                                    <a href="/menu/registros/clientes/categorias/sucursales/{{$datosC1->id}}">
                                        <div class="bttn-volver">
                                            <button id="btnBk" type="button" href="#" class="bttn-vol"><span class="fa fa-chevron-left"></span><span class="txt-bttn">VOLVER</span></button>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
                        
                         @foreach($consulta as $equipo)
                                <div class="contMd" style="">
                                    <div class="icl">
                                        @foreach($acciones as $accion)
                                            @if($accion->id!=43)
                                                @if($accion->id==42)
                                                    <span class="iclsp">
                                                        <a  class="modificarEquipo_" data-reg="{{$equipo->id}}" data-ttl="{{$accion->descripcion}}" data-toggle="modal" > 
                                                            <i class="{{$accion->clase_css}}" data-equipo="{{$equipo->id}}"></i>
                                                        </a>
                                                    </span>
                                                @elseif($accion->id==44 || $accion->id==49)
                                                    <span class="iclsp">
                                                        <a href="{{$accion->url.$equipo->id}}" class="tltp" data-ttl="{{$accion->descripcion}}">
                                                            <i class="{{$accion->clase_css}}"></i>
                                                        </a>
                                                    </span>
                                                @elseif($accion->id==114)
                                                    <span class="iclsp">
                                                        <a class="_eliminarEquip_" id="elimEquip{{$equipo->id}}" data-reg="{{$equipo->id}}" data-ttl="{{$accion->descripcion}}">
                                                           <i class="{{$accion->clase_css}}"></i>
                                                      </a>
                                                    </span>
                                                @endif
                                            @elseif($accion->id==43)
                                                @if($equipo->status==1)
                                                    <div class="chbx">
                                                        <input type="checkbox" class="checkEquipos" name="status" id="{{'equipoCheck'. $equipo->id}}" value="{{$equipo->status}}" data-reg="{{$equipo->id}}" checked><label for="{{'equipoCheck'. $equipo->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                                    </div>
                                                @elseif($equipo->status==0)
                                                    <div class="chbx">
                                                        <input type="checkbox" class="checkEquipos" name="status" id="{{'equipoCheck'. $equipo->id}}" value="{{$equipo->status}}"  data-reg="{{$equipo->id}}" ><label for="{{'equipoCheck'. $equipo->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                                    </div>
                                                @endif
                                            
                                            @endif
                                        @endforeach
                                    </div>
                                    <p class="ttlMd"><strong>{{$equipo->descripcion}}</strong></p>
                                </div>
                          @endforeach
                        <div class="paginador">
                             {{ $consulta->links() }}
                        </div>
						
                        </div>
                        <!--Registro -->

                        <!--Modal -->
                        @if($agregar)
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Agregar Equipo</h4>
                                    </div>
                                    <form  class="Validacion" id="equipoSucAgr">
                                    <div class="modal-body">
                                            {{ csrf_field() }}
                                            <div class="container-fluid" id="conteq">
                                                <div id="rEq1">
                                                   <div class="col-md-8 col-md-offset-2">
                                                       <div class="form-group row" >
                                                           <label for="nomEq">Nombre de equipo</label>
                                                           <input type="text" class="form-control userEmail" name="nomEq" id="nomEq"><i class="fa fa-id-badge" id="ice1"></i>
                                                       </div>
                                                   </div>
                                                   <div class="col-md-8 col-md-offset-2">
                                                       <div class="form-group row">
                                                           <label for="_tpEq">Tipo de equipo</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                           <select name="_tpEq" id="_tpEq" class="form-control userEmail selectEquipos" data-caso="0" data-grupo="0">
                                                               <option value="">-</option>
                                                               @foreach($datosC2 as $tipoEquipo)
                                                                    <option value="{{$tipoEquipo->id}}" >{{$tipoEquipo->descripcion}}</option>
                                                               @endforeach
                                                              
                                                           </select><i class="fa fa-desktop" id="ice2"></i>
                                                       </div>
                                                   </div>
                                               </div>
                                                <div id="rEq2">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="mkEq">Marca de equipo</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="mkEq" id="mkEq" class="form-control userEmail selectEquipos" data-caso="1" data-grupo="0">
                                                                <option value="">-</option>
                                                                
                                                            </select><i class="fa fa-apple" id="ice3"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="modEq">Modelo de equipo</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="modEq" id="modEq" class="form-control userEmail">
                                                                <option value="">-</option>
                                                               
                                                            </select><i class="fa fa-laptop" id="ice4"></i>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div id="rEq3">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="duPfl">Serial de equipo</label>
                                                            <input type="text" class="form-control userEmail" name="duPfl" id="duPfl"><i class="fa fa-barcode" id="ice5"></i>
                                                        </div>
                                                    </div>  
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="stPfl">Estatus de equipo</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="stPfl" id="stPfl" class="form-control userEmail">
                                                                <option value="">-</option>
                                                                <option value="1">Activo</option>
                                                                <option value="0">Inactivo</option>
                                                            </select><i class="fa fa-check" id="ice6"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="_sucursal_id_" id="_sucursal_id_" value="{{$extra->id}}">
                                        </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="bttnMd" id="btnSvEquipoAgr">Guardar <i class="fa fa-floppy-o"></i></button>
                                   
                                    </div></form>
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
                                        <h4 class="modal-title" id="myModalLabel2">Modificar Equipo</h4>
                                    </div>
                                    <form  class="Validacion" id="equipoSucMod" >
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            <div class="container-fluid" id="conteqm">
                                                <div id="rEqm1">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row" >
                                                            <label for="nomEq">Nombre de equipo</label>
                                                            <input type="text" class="form-control userEmail" name="nomEq" id="nomEqm"><i class="fa fa-id-badge" id="mice1"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="tpEq">Tipo de equipo</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="_tpEq" id="tpEqm" class="form-control userEmail selectEquipos" data-caso="0" data-grupo="1">
                                                                <option value="">-</option>
                                                            </select><i class="fa fa-desktop" id="mice2"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="rEqm2">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="mkEq">Marca de equipo</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="mkEq" id="mkEqm" class="form-control userEmail selectEquipos" data-caso="1" data-grupo="1">
                                                                 <option value="">-</option>
                                                            </select><i class="fa fa-apple" id="mice3"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="modEq">Modelo de equipo</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="modEq" id="modEqm" class="form-control userEmail " data-caso="2" data-grupo="1">
                                                                <option value="">-</option>
                                                            </select><i class="fa fa-laptop" id="mice4"></i>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div id="rEqm3">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="duPfl">Serial de equipo</label>
                                                            <input type="text" class="form-control userEmail" name="duPfl" id="duPflm"><i class="fa fa-barcode" id="mice5"></i>
                                                        </div>
                                                    </div>  
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="stPfl">Estatus de euipo</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="stPfl" id="stPflm" class="form-control userEmail">
                                                                <option value="">-</option>
                                                                <option value="1">Activo</option>
                                                                <option value="0">Inactivo</option>
                                                            </select><i class="fa fa-check" id="mice6"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="_sucursalRegistro" id="_sucursalRegistro" value="">
                                            <input type="hidden" name="tipoEquipo__" id="tipoEquipo__" value="">
                                            <input type="hidden" name="_sucursal_id_" id="sucursal__id" value="{{$extra->id}}">
                                        </div>
                                        <div class="modal-footer">
                                             <button type="submit" class="btn btn-primary" id="_btnModificarEquipo_">Modificar<i class="fa fa-floppy-o"></i></button> 
                                        </div></form>
                                </div>
                            </div>
                        </div>
                    </div>   
    @endsection
    @section('js')
        <script src="{{asset('js/vistaEquipos.js')}}"></script>
    @endsection 