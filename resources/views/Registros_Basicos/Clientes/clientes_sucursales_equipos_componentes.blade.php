@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Componente - Equipos
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                    <div class="contenido">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 ttlp">
                                    <h1>Equipos - Componentes</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
                            @if($agregar)
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-2" align="left">
                                            <button id="btnBk" type="button" class="btnBk" href="#"><i class="fa fa-chevron-left"></i> VOLVER</button>
                                        </div>
                                        <div class="col-md-offset-8">
                                            <button id="btnAdd" type="button" class="btnAd" data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-plus"></i> AGREGAR</button> 
                                        </div>
                                    </div>
                                </div>
                           @endif
                                <div class="contMd" style="">
                                    <div class="icl">
                                        @foreach($acciones as $accion)
                                            @if($accion->descripcion!="Status")
                                                @if($accion->data_toogle=="modal")
                                                    <span class="iclsp">
                                                        <a href="#myModal2" class="tltp" data-ttl="{{$accion->descripcion}}" data-toggle="modal" data-target="#myModal2"> 
                                                            <i class="{{$accion->clase_css}}"></i>
                                                        </a>
                                                    </span>
                                                @elseif($accion->data_toogle!="modal")
                                                    <span class="iclsp">
                                                        <a href="{{$accion->url}}" class="tltp" data-ttl="{{$accion->descripcion}}">
                                                            <i class="{{$accion->clase_css}}"></i>
                                                        </a>
                                                    </span>
                                                @endif
                                            @elseif($accion->descripcion=="Status")
                                                @if($accion->status_ac==1)
                                                    <div class="chbx">
                                                        <input type="checkbox" class="btnAcc" name="status" id="inchbx1" value="{{$accion->status_ac}}" checked><label for="inchbx1" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                                    </div>
                                                @elseif($accion->staus_ac==0)
                                                    <div class="chbx">
                                                        <input type="checkbox" class="btnAcc" name="status" id="inchbx2" value="{{$accion->status_ac}}"><label for="inchbx2" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                                    </div>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                    <p class="ttlMd"><strong>REGISTRO</strong></p>
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
                                    <form action="" class="Validacion">
                                    <div class="modal-body">
                                        
                                            {{ csrf_field() }}
                                            <div class="container-fluid" id="contcomp">
                                            <div class="col-md-6">
                                                <div class="form-group row" id="rComp1">
                                                    
                                                        <label for="nomComp">Nombre del Componente</label>
                                                        <input type="text" class="form-control userEmail" name="nomComp" id="nomComp"><i class="fa fa-cogs"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                <div class="form-group row" id="rComp3">
                                                    
                                                        <label for="serCm">Serial del Componente</label>
                                                        <input type="text" class="form-control userEmail" name="serCm" id="serCm"><i class="fa fa-barcode"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row" id="rComp1">                                                    
                                                        <label for="selTc">Tipo de Componente</label>
                                                        <select name="selTc" class="form-control userEmail" id="selTc">
                                                            <option value="">-</option>
                                                             <option value="1">caracas</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                <div class="form-group row" id="rComp2">
                                                    
                                                        <label for="selMc">Marca del Componente</label>
                                                        <select name="selMc" class="form-control userEmail" id="selMc">
                                                            <option value="">-</option>
                                                             <option value="1">caracas</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                <div class="form-group row" id="rComp2">
                                                    
                                                        <label for="selMcm">Modelo del Componente</label>
                                                        <select name="selMcm" class="form-control userEmail" id="selMcm">
                                                            <option value="">-</option>
                                                             <option value="1">caracas</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                <div class="form-group row" id="rComp3">
                                                    
                                                        <label for="selStCm">Estatus del Componente</label>
                                                        <select name="selStCm" class="form-control userEmail" id="selStCm">
                                                            <option value="">-</option>
                                                            <option value="1">Activo</option>
                                                            <option value="2">Inactivo</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                <div class="form-group row" id="rComp4">
                                                    
                                                        <label for="selPsc">Pieza y Software</label>
                                                        <select name="selPsc" class="form-control userEmail" id="selPsc">
                                                            <option value="">-</option>
                                                            <option value="1">caracas</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="bttnMd" id="btnSv">Guardar <i class="fa fa-floppy-o"></i></button>
                                        <button type="button" class="bttnMd" data-dismiss="modal" id="btnCs">Cerrar <i class="fa fa-times"></i></button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>   
    @endsection