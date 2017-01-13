@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Datos Complementarios
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                    <div class="contenido">
                        <div class="container ">
                            <div class="row">
                                <div class="col-md-3 ttlp">
                                    <h1 id="encabezado">Datos Complementarios</h1>
                                </div>
                                <input type="hidden" value="" id="idPerfil">
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <a href="/menu/registros/datos/tipoequipo">Tipo de Equipos</a>
                            </div>
                        </div>

                        
                    </div>
    @endsection