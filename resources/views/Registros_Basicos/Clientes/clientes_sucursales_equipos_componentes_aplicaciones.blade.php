@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Aplicación - Componentes
        @endsection
        @include('layout/header')
            @include('layout/sidebar')
                <div class="contenido">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 ttlp">
                                <h1>Equipos - Aplicaciones</h1>
                            </div>
                            <div  class="col-md-4 col-md-offset-3 search">
                                <form action="" method="">
                                    <div class="input-group">
                                        <input type="search" class="form-control filtro" placeholder="Buscar aplicación..."><span class="fa fa-search"></span>
                                    </div>
                                </form> 
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
                       
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2" align="left">
                                    <a href="/menu/registros/clientes/categoria/sucursal/equipos/{{$extra}}"><button id="btnBk" type="button" class="btnBk" href="#"><i class="fa fa-chevron-left"></i> VOLVER</button></a>
                                </div>
                                 @if($agregar)
                                    <div class="col-md-2 col-md-offset-3">
                                        <button id="btnAdd" type="button" class="btnAd" data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-plus"></i> AGREGAR</button> 
                                    </div>
                                 @endif
                            </div>
                        </div>
                       @foreach($consulta as $aplicacion)
                        <div class="contMd" style="">
                            <div class="icl">
                                @foreach($acciones as $accion)
                                    @if($accion->id!=52)
                                        @if($accion->id==51)
                                            <span class="iclsp">
                                                <a href="#myModal2" class="tltp" data-ttl="{{$accion->descripcion}}" data-toggle="modal" data-target="#myModal2"> 
                                                    <i class="{{$accion->clase_css}} _ModificarAplicacion_" data-aplicacion="{{$aplicacion->id}}"></i>
                                                </a>
                                            </span>
                                        @elseif($accion->id!=51)
                                            <span class="iclsp">
                                                <a href="{{$accion->url}}" class="tltp" data-ttl="{{$accion->descripcion}}">
                                                    <i class="{{$accion->clase_css}}"></i>
                                                </a>
                                            </span>
                                        @endif
                                    @elseif($accion->id==52)
                                        @if($aplicacion->status==1)
                                            <div class="chbx">
                                                <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $aplicacion->id}}" value="{{$aplicacion->status}}" checked><label for="{{'inchbx'. $aplicacion->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                            </div>
                                        @elseif($aplicacion->status==0)
                                            <div class="chbx">
                                                <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $aplicacion->id}}" value="{{$aplicacion->status}}"><label for="{{'inchbx'. $aplicacion->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
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
						<input type="hidden" name="TND" value="{{$datosC1}}">
                    </div>
                    <!--    Registro -->


                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Agregar Aplicación</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="">
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
                                            </div>
                                            <div id="rAs3">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="selMap">Versión de la Aplicación</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                        <select name="selMap" class="form-control" id="selMap">
                                                            <option value="0">-</option>
                                                        </select><i class="fa fa-code-fork" id="icas5"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                   <div class="form-group row">
                                                       <label for="selStAp">Estatus de Aplicación</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                       <select name="selStAp" class="form-control" id="selStAp">
                                                           <option value="0">-</option>
                                                           <option value="1">Activo</option>
                                                           <option value="2">Inactivo</option>
                                                       </select><i class="fa fa-check" id="icas6"></i>
                                                   </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="bttnMd" id="btnSv">Guardar <i class="fa fa-floppy-o"></i></button>
                                    <button type="button" class="bttnMd" data-dismiss="modal" id="btnCs">Cerrar <i class="fa fa-times"></i></button>
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
                                    <form action="">
                                        {{ csrf_field() }}
                                        <div class="container-fluid" id="contasm">
                                            <div id="rAsm1">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="nomApm">Nombre de la Aplicación</label>
                                                        <input type="text" class="form-control" name="nomApm" id="nomApm"><i class="fa fa-windows" id="micas1"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="LicApm">Licencia de la Aplicación</label>
                                                        <input type="text" class="form-control" name="LicApm" id="LicApm"><i class="fa fa-barcode" id="micas2"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="rAsm3">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="selMapm">Versión de la Aplicación</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                        <select name="selMapm" class="form-control" id="selMapm">
                                                            <option value="0">-</option>
                                                        </select><i class="fa fa-code-fork" id="micas5"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="selStApm">Estatus de Aplicación</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                        <select name="selStApm" class="form-control" id="selStApm">
                                                            <option value=" ">-</option>
                                                            <option value="1">Activo</option>
                                                            <option value="0">Inactivo</option>
                                                        </select><i class="fa fa-check" id="micas6"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="bttnMd" id="btnSvm">Guardar <i class="fa fa-floppy-o"></i></button>
                                    <button type="button" class="bttnMd" data-dismiss="modal" id="btnCsm">Cerrar <i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
    @endsection