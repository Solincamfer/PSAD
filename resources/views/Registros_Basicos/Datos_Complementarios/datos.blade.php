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
                            <div class="col-md-5 col-md-offset-2 spc">
                                <div class="row espFil separador">
                                    @foreach($acciones as $accion)
                                        <a id="" type="button" class="btn tltpcd" data-ttl="{{$accion->descripcion}}" href="{{$accion->url}}">
                                            <div class="{{$accion->clase_css}}">
                                                <div class="col-md-8 col-md-offset-2">
                                                    <img src="{{asset($accion->data_toogle)}}" alt="" class="im">
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>  
                            </div>        
                        </div>           
                    </div>
    @endsection