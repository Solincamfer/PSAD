@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Equipo
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
                        <!--Registro -->

                        <!--Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Agregar Equipo</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="">
                                            {{ csrf_field() }}
                                            <div class="container-fluid" id="conteq">
                                                <div class="form-group row" id="rEq1">
                                                    <div class="col-md-6">
                                                        <label for="selTe">Tipo de Equipo</label>
                                                        <select name="selTe" class="form-control" id="selTe">
                                                            <option value="0">-</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="nomEq">Nombre del Equipo</label>
                                                        <input type="text" class="form-control" name="nomEq" id="nomEq"><i class="fa fa-desktop"></i>
                                                    </div>
                                                </div>
                                                <div class="form-group row" id="rEq2">
                                                    <div class="col-md-6">
                                                        <label for="selMe">Marca del Equipo</label>
                                                        <select name="selMe" class="form-control" id="selMe">
                                                            <option value="0">-</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="selMeq">Modelo del Equipo</label>
                                                        <select name="selMeq" class="form-control" id="selMeq">
                                                            <option value="0">-</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row" id="rEq3">
                                                    <div class="col-md-6">
                                                        <label for="serEq">Serial del Equipo</label>
                                                        <input type="text" class="form-control" name="serEq" id="serEq"><i class="fa fa-barcode"></i>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="selStEq">Estatus del Equipo</label>
                                                        <select name="selStEq" class="form-control" id="selStEq">
                                                            <option value="0">-</option>
                                                            <option value="1">Activo</option>
                                                            <option value="2">Inactivo</option>
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