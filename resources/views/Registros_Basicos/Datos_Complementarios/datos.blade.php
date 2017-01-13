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
                            <div class="col-md-10 col-md-offset-2 spc">
                                <div class="row espFil">

<!-- //////  TARJETA DE HORARIOS  //////-->
                                    <a id="s1" type="button" class="btn tltpcd m_Servicio " data-ttl="Horarios" data-toggle="modal" data-target="#myModal1" href="#myModal1">
                                        <div class="col-md-2 hh">
                                            <div class="col-md-8 col-md-offset-2">
                                                <img src="{{asset('img/passage-of-time.png')}}" alt="" class="im">
                                            </div>
                                        </div>
                                    </a>
                                </div>  
                            </div>        
                        </div>           
    
                    </div>
    @endsection