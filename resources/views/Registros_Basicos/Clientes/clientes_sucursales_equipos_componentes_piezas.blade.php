@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Pieza - Componentes
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                    <div class="contenido">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 ttlp">
                                    <h1>Componentes - Pieza</h1>
                                </div>
                                <div  class="col-md-4 col-md-offset-3 search">
                                    <form action="" method="">
                                        <div class="input-group">
                                            <input type="search" class="form-control filtro" placeholder="Buscar Pieza..."><span class="fa fa-search"></span>
                                        </div>
                                    </form> 
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
                            
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-2" align="left">
                                        <a href="/menu/registros/clientes/categoria/sucursal/equipos/componentes/{{$extra}}"><button id="btnBk" type="button" class="btnBk" href="#"><i class="fa fa-chevron-left"></i> VOLVER</button></a>
                                    </div>
                                    @if($agregar)
                                        <div class="col-md-2 col-md-offset-3">
                                            <button id="btnAdd" type="button" class="btnAd" data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-plus"></i> AGREGAR</button> 
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @foreach($consulta as $pieza)
                            <div class="contMd" style="">
                                <div class="icl">
                                    @foreach($acciones as $accion)
                                        @if($accion->id!=55)
                                            @if($accion->id==54)
                                                <span class="iclsp">
                                                    <a href="#myModal2" class="tltp" data-ttl="{{$accion->descripcion}}" data-toggle="modal" data-target="#myModal2"> 
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
                                                    <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $pieza->id}}" value="{{$pieza->status}}" checked><label for="{{'inchbx'. $pieza->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                                </div>
                                            @elseif($pieza->status==0)
                                                <div class="chbx">
                                                    <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $pieza->id}}" value="{{$pieza->status}}"><label for="{{'inchbx'. $pieza->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
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
							<input type="hidden" name="TND" value="{{$datosC1}}">
                        </div>
                        <!-- 	Registro -->


                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Agregar Pieza</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="">
                                            {{ csrf_field() }}
                                            <div class="container-fluid" id="contpz">
                                                <div id="rPz1">
                                                    <div class="col-md-8 col-md-offset-2">
                                                       <div class="form-group row">
                                                           <label for="nomPz">Nombre de la Pieza</label>
                                                           <input type="text" class="form-control" name="nomPz" id="nomPz"><i class="fa fa-cog" id="icpz1"></i>
                                                       </div>
                                                    </div>
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="serPz">Serial de la Pieza</label>
                                                            <input type="text" class="form-control" name="serPz" id="serPz"><i class="fa fa-barcode" id="icpz2"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="rPz2">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="selMp">Marca de la Pieza</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="selMp" class="form-control" id="selMp">
                                                                <option value="0">-</option>
                                                            </select><i class="fa fa-apple" id="icpz4"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="rPz3">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="selMpz">Modelo de la Pieza</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="selMpz" class="form-control" id="selMpz">
                                                                <option value="0">-</option>
                                                            </select><i class="fa fa-microchip" id="icpz5"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 col-md-offset-2">
                                                       <div class="form-group row">
                                                           <label for="selStPz">Estatus de Pieza</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                           <select name="selStPz" class="form-control" id="selStPz">
                                                               <option value="0">-</option>
                                                               <option value="1">Activo</option>
                                                               <option value="2">Inactivo</option>
                                                           </select><i class="fa fa-check" id="icpz6"></i>
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
                                        <h4 class="modal-title" id="myModalLabel2">Modificar Pieza</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="">
                                            {{ csrf_field() }}
                                            <div class="container-fluid" id="contpzm">
                                                <div id="rPzm1">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="nomPzm">Nombre de la Pieza</label>
                                                            <input type="text" class="form-control" name="nomPzm" id="nomPzm"><i class="fa fa-cog" id="micpz1"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="serPzm">Serial de la Pieza</label>
                                                            <input type="text" class="form-control" name="serPzm" id="serPzm"><i class="fa fa-barcode" id="micpz2"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="rPzm2">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="selMpm">Marca de la Pieza</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="selMpm" class="form-control" id="selMpm">
                                                                <option value="0">-</option>
                                                            </select><i class="fa fa-apple" id="micpz4"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="rPzm3">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="selMpzm">Modelo de la Pieza</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="selMpzm" class="form-control" id="selMpzm">
                                                                <option value="0">-</option>
                                                            </select><i class="fa fa-microchip" id="micpz5"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group row">
                                                            <label for="selStPzm">Estatus de Pieza</label><span class="ic"><i class="fa fa-chevron-down" ></i></span>
                                                            <select name="selStPzm" class="form-control" id="selStPzm">
                                                                <option value="">-</option>
                                                                <option value="1">Activo</option>
                                                                <option value="0">Inactivo</option>
                                                            </select><i class="fa fa-check" id="micpz6"></i>
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