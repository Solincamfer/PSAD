@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Componente
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                    <div class="contenido">
                        <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
                            <button id="btnAdd" type="button" class="btnAd col-md-offset-10" data-toggle="modal" data-target="#myModal" href="#myModal">AGREGAR <i class="fa fa-plus-circle"></i></button>
                            @for($i=0; $i < 5; $i++)
                                <div class="contMd" style="">
                                    @for($j=0; $j < 5; $j++)
                                        <button class="btnAcc" type="submit">Modificar</button>
                                    @endfor
                                    <p class="ttlMd"><strong>REGISTRO</strong></p>
                                </div>
                            @endfor
                        </div>
                        <!--Registro-->


                        <!--Modal-->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Agregar Componente</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="">
                                            {{ csrf_field() }}
                                            <div class="container-fluid" id="contcomp">
                                                <div class="form-group row" id="rComp1">
                                                    <div class="col-md-6">
                                                        <label for="selTc">Tipo de Componente</label>
                                                        <select name="selTc" class="form-control" id="selTc">
                                                            <option value="0">-</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="nomComp">Nombre del Componente</label>
                                                        <input type="text" class="form-control" name="nomComp" id="nomComp"><i class="fa fa-cogs"></i>
                                                    </div>
                                                </div>
                                                <div class="form-group row" id="rComp2">
                                                    <div class="col-md-6">
                                                        <label for="selMc">Marca del Componente</label>
                                                        <select name="selMc" class="form-control" id="selMc">
                                                            <option value="0">-</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="selMcm">Modelo del Componente</label>
                                                        <select name="selMcm" class="form-control" id="selMcm">
                                                            <option value="0">-</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row" id="rComp3">
                                                    <div class="col-md-6">
                                                        <label for="serCm">Serial del Componente</label>
                                                        <input type="text" class="form-control" name="serCm" id="serCm"><i class="fa fa-barcode"></i>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="selStCm">Estatus del Componente</label>
                                                        <select name="selStCm" class="form-control" id="selStCm">
                                                            <option value="0">-</option>
                                                            <option value="1">Activo</option>
                                                            <option value="2">Inactivo</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row" id="rComp4">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <label for="selPsc">Pieza y Software</label>
                                                        <select name="selPsc" class="form-control" id="selPsc">
                                                            <option value="0">-</option>
                                                        </select>
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
                    </div>   
    @endsection