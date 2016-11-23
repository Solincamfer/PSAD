@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Servicio
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                    <div class="contenido">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 ttlp">
                                    <h1>Sucursales - Plan</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style=""> 
                            @if($agregar)
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-2" align="left">
                                            <a href="/menu/registros/clientes/categoria/sucursal/plan"><button id="btnBk" type="button" class="btnBk" href="#"><i class="fa fa-chevron-left"></i> VOLVER</button></a>
                                        </div>
                                    </div>
                                </div>
                            @endif 
                            <div class="contMd" style="">
                                <p class="ttlMd"><strong>REGISTRO</strong></p>
                            </div>
                         
                        </div>
                        <!--    Registro -->


                        <!-- Modal -->
                        @if($agregar)
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Agregar Servicio</h4>
                                    </div>
                                    <form action="" class="Validacion">
                                    <div class="modal-body">
                                        
                                            {{ csrf_field() }}
                                            <div class="container-fluid" id="contsrvc">
                                            <div class="col-md-8 col-md-offset-2">
                                                <div class="form-group row" id="rSrvc1">
                                                    
                                                        <label for="nomSrvc">Nombre del Servicio</label>
                                                        <input type="text" class="form-control userEmail" name="nomSrvc" id="nomSrvc"><i class="fa fa-cube"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-md-offset-2">
                                                <div class="form-group row" id="rSrvc2">
                                                    
                                                        <label for="prcSrvc">Precio del Servicio</label>
                                                        <input type="text" class="form-control userEmail" name="prcSrvc" id="prcSrvc"><i class="fa fa-money"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-md-offset-2">
                                                <div class="form-group row" id="rSrvc3">
                                                    
                                                        <label for="stSrvc">Estatus del Perfil</label>
                                                        <select name="stSrvc" id="stSrvc" class="form-control userEmail">
                                                            <option value="">-</option>
                                                            <option value="1">Activo</option>
                                                            <option value="2">Inactivo</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="bttnMd" id="btnSv">Guardar <i class="fa fa-floppy-o"></i></button>
                                        <button type="button" class="bttnMd" data-dismiss="modal" id="btnCs">Cerrar <i class="fa fa-times"></i></button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>   
    @endsection