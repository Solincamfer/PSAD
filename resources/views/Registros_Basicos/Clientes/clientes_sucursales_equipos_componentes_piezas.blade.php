@extends('admin.basesys')
@section('contenido')
@section('title')
Registro Pieza
@endsection
@include('layout/header')
@include('layout/sidebar')
<div class="contenido">
    <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
        <button id="btnAdd" type="button" class="btnAd col-md-offset-10" data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-plus"></i>AGREGAR</button>
        @for($i=0; $i < 5; $i++)
                          <div class="contMd" style="">
        @for($j=0; $j < 5; $j++)
                          <button class="btnAcc" type="submit">Modificar</button>
    @endfor
    <p class="ttlMd"><strong>REGISTRO</strong></p>
</div>
@endfor
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
                        <div class="form-group row" id="rPz1">
                            <div class="col-md-6">
                                <label for="selTp">Tipo de Pieza</label>
                                <select name="selTp" class="form-control" id="selTp">
                                    <option value="0">-</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="nomPz">Nombre de la Pieza</label>
                                <input type="text" class="form-control" name="nomPz" id="nomPz"><i class="fa fa-cog"></i>
                            </div>
                        </div>
                        <div class="form-group row" id="rPz2">
                            <div class="col-md-6">
                                <label for="selMp">Marca de la Pieza</label>
                                <select name="selMp" class="form-control" id="selMp">
                                    <option value="0">-</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="selMpz">Modelo de la Pieza</label>
                                <select name="selMpz" class="form-control" id="selMpz">
                                    <option value="0">-</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="rPz3">
                            <div class="col-md-6">
                                <label for="serPz">Serial de la Pieza</label>
                                <input type="text" class="form-control" name="serPz" id="serPz"><i class="fa fa-barcode"></i>
                            </div>
                            <div class="col-md-6">
                                <label for="selStPz">Estatus de Pieza</label>
                                <select name="selStPz" class="form-control" id="selStPz">
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