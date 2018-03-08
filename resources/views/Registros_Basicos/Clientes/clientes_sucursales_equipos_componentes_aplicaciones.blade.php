@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Aplicación - Componentes
        @endsection
        @include('layout/header')
            @include('layout/sidebar')
                <div class="contenido">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4 ttlp">
                                <h1>{{$extra->descripcion}} - Aplicaciones</h1>
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
                               {{--  <div class="search-cont" id="scnt">
                                    <form action="" method="">
                                        <div class="input-group sci">
                                            <input type="search" class="form-control filtro" placeholder="Buscar aplicación..."><span class="fa fa-search"></span>
                                        </div>
                                    </form> 
                                    <a class="bttn-search">
                                        <span class="fa fa-search"></span>
                                    </a>
                                </div> --}}
                            </div>
                            <div class="col-md-2 despl-bttn">
                                <a href="/menu/registros/clientes/categoria/sucursal/equipos/{{$datosC1->id}}">
                                    <div class="bttn-volver">
                                        <button id="btnBk" type="button" href="#" class="bttn-vol"><span class="fa fa-chevron-left"></span><span class="txt-bttn">VOLVER</span></button>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
                       
                       @foreach($consulta as $aplicacion)
                        <div class="contMd" style="">
                            <div class="icl">
                                @foreach($acciones as $accion)
                                    @if($accion->id!=52)
                                        @if($accion->id==51)
                                            <span class="iclsp">
                                                <a  class="modificarAplicacion"  data-reg="{{$aplicacion->id}}" data-ttl="{{$accion->descripcion}}" data-toggle="modal" d> 
                                                    <i class="{{$accion->clase_css}} " data-aplicacion="{{$aplicacion->id}}"></i>
                                                </a>
                                            </span>
                                        @elseif($accion->id!=110)
                                            <span class="iclsp">
                                                <a href="{{$accion->url}}" class="tltp" data-ttl="{{$accion->descripcion}}">
                                                    <i class="{{$accion->clase_css}}"></i>
                                                </a>
                                            </span>
                                        @elseif($accion->id==110)
                                         <span class="iclsp">
                                            <a class="_eliminarApp_" id="app{{$aplicacion->id}}" data-reg="{{$aplicacion->id}}" data-ttl="{{$accion->descripcion}}">
                                               <i class="{{$accion->clase_css}}"></i>
                                            </a>
                                        </span>
                                        @endif
                                    @elseif($accion->id==52)
                                        @if($aplicacion->status==1)
                                            <div class="chbx">
                                                <input type="checkbox" class="checkAplicacion" name="statusApp" data-reg="{{$aplicacion->id}}" id="{{'app'. $aplicacion->id}}" value="{{$aplicacion->status}}" checked><label for="{{'app'. $aplicacion->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                            </div>
                                        @elseif($aplicacion->status==0)
                                            <div class="chbx">
                                                <input type="checkbox" class="checkAplicacion" name="statusApp" data-reg="{{$aplicacion->id}}" id="{{'app'. $aplicacion->id}}" value="{{$aplicacion->status}}"><label for="{{'app'. $aplicacion->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                            </div>
                                        @endif
                                   
                                   @endif
                                @endforeach
                            </div>
                            <p class="ttlMd"><strong>{{$aplicacion->descripcion}}</strong></p>
                        </div>
                        @endforeach
                         <div class="paginador">
                             {{ $consulta->links() }}
                        </div>
					
                    </div>
                    <!--    Registro -->


                    <!-- Modal Agregar-->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Agregar Aplicación</h4>
                                </div>
                                <div class="modal-body">
                                    <form id="regisAplicAgr" class="Validacion">
                                        {{ csrf_field() }}
                                        <div class="container-fluid" id="contas">
                                            <div id="rAs1">
                                                <div class="col-md-6">
                                                   <div class="form-group row">
                                                       <label for="nomAp">Nombre de la Aplicación</label>
                                                       <input type="text" class="form-control" name="nomAp" id="nomAp"><i class="fa fa-windows" id="icas1"></i>
                                                   </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="LicAp">Licencia de la Aplicación</label>
                                                        <input type="text" class="form-control" name="LicAp" id="LicAp"><i class="fa fa-barcode" id="icas2"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="selMap">Versión de la Aplicación</label>
                                                        <input type="text" class="form-control" name="VersAp" id="VersAp" value=""><i class="fa fa-windows" id="icas1"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="rAs3">
                                                <div class="col-md-6">
                                                   <div class="form-group row">
                                                       <label for="selStAp">Estatus de Aplicación</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                       <select name="selStAp" class="form-control" id="selStAp">
                                                           <option value="">-</option>
                                                           <option value="1">Activo</option>
                                                           <option value="0">Inactivo</option>
                                                       </select><i class="fa fa-check" id="icas6"></i>
                                                   </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="__equipo__id__" id="__equipo__id__" value="{{$extra->id}}">
                                        </div>

                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="bttnMd" id="__btnSvAplicacion___">Guardar <i class="fa fa-floppy-o"></i></button>
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
                                    <h4 class="modal-title" id="myModalLabel2">Modificar Aplicación</h4>
                                </div>
                                <div class="modal-body">
                                    <form id="regisAplicMod" class="Validacion">
                                        {{ csrf_field() }}
                                        <div class="container-fluid" id="contasm">
                                            <div id="rAsm1">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="nomApm">Nombre de la Aplicación</label>
                                                        <input type="text" class="form-control" name="nomAp" id="nomApm"><i class="fa fa-windows" id="micas1"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="LicApm">Licencia de la Aplicación</label>
                                                        <input type="text" class="form-control" name="LicAp" id="LicApm"><i class="fa fa-barcode" id="micas2"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="selMapm">Versión de la Aplicación</label>
                                                         <input type="text" class="form-control" name="VersAp" id="LicApMod"><i class="fa fa-windows" id="micas1"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="rAsm3">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="selStApm">Estatus de Aplicación</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                        <select name="selStAp" class="form-control" id="selStApm">
                                                            <option value=" ">-</option>
                                                            <option value="1">Activo</option>
                                                            <option value="0">Inactivo</option>
                                                        </select><i class="fa fa-check" id="micas6"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="regAplicacion_" id="regAplicacion_" value="">
                                        </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="bttnMd" id="btnSvmAplicacion__">Guardar <i class="fa fa-floppy-o"></i></button>
                                   </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
    @endsection
    @section('js')
        <script src="{{asset('js/vistaAplicaciones.js')}}"></script>
    @endsection