extends('admin.basesys')
@section('contenido')
@section('title')
Registro Aplicación
@endsection
@include('layout/header')
@include('layout/sidebar')
<div class="contenido">
    <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
        <button id="btnAdd" type="button" class="btnAd col-md-offset-10" data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-plus"></i> AGREGAR</button>
        @for($i=0; $i < 5; $i++)
                          <div class="contMd" style="">
        @for($j=0; $j < 5; $j++)
                          <button class="btnAcc" type="submit">Modificar</button>
    @endfor
    <p class="ttlMd"><strong>REGISTRO</strong></p>
</div>
@endfor
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
                        <div class="form-group row" id="rAs1">
                            <div class="col-md-6">
                                <label for="selTa">Tipo de Aplicación</label>
                                <select name="selTa" class="form-control" id="selTa">
                                    <option value="0">-</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="nomAp">Nombre de la Aplicación</label>
                                <input type="text" class="form-control" name="nomAp" id="nomAp"><i class="fa fa-windows"></i>
                            </div>
                        </div>
                        <div class="form-group row" id="rAs2">
                            <div class="col-md-6">
                                <label for="selMa">Marca de la Aplicación</label>
                                <select name="selMa" class="form-control" id="selMa">
                                    <option value="0">-</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="selMap">Versión de la Aplicación</label>
                                <select name="selMap" class="form-control" id="selMap">
                                    <option value="0">-</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="rAs3">
                            <div class="col-md-6">
                                <label for="LicAp">Licencia de la Aplicación</label>
                                <input type="text" class="form-control" name="LicAp" id="LicAp"><i class="fa fa-barcode"></i>
                            </div>
                            <div class="col-md-6">
                                <label for="selStAp">Estatus de Aplicación</label>
                                <select name="selStAp" class="form-control" id="selStAp">
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