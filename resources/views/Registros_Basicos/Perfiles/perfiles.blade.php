@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Perfil
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                <div class="contenido">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2 ttlp">
                                <h1>Perfil</h1>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3"> 
                        <button id="btnAdd" type="button" class="btnAdc col-md-offset-11" data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-plus"></i> AGREGAR</button>
                        @for($i=0; $i < 5; $i++)
                            <div class="contMd" style="">
                                <div class="icl">
                                    @for($j=0; $j < 5; $j++)
                                        <button class="btnAcc" type="submit">Modificar</button>
                                    @endfor
                                </div>
                                <p class="ttlMd"><strong>REGISTRO</strong></p>
                            </div>
                        @endfor
                    </div>
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Agregar Perfil</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="">
                                        <div class="container-fluid" id="contpfl">
                                            <div class="form-group row" id="rPfl1">
                                                <div class="col-md-8 col-md-offset-2">
                                                    <label for="duPfl">Nombre del Perfil</label>
                                                    <input type="text" class="form-control" name="duPfl" id="duPfl"><i class="fa fa-id-badge"></i>
                                                </div>
                                            </div>
                                            <div class="form-group row" id="rPfl2">
                                                <div class="col-md-8 col-md-offset-2">
                                                    <label for="stPfl">Estatus del Perfil</label>
                                                    <select name="stPfl" id="stPfl" class="form-control">
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