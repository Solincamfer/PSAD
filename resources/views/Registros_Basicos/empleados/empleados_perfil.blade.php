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
                                <h1>{{$datosC2}} </h1>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="container">
                        <div class="row">
                            <div class="col-md-2 ttlp">
                                <h1>Perfil</h1>
                            </div>
                        </div>
                    </div> -->
                    
                    <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3"> 
                 <!--    @if($agregar)
                        <button id="btnAdd" type="button" class="btnAdc col-md-offset-11" data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-plus"></i> AGREGAR</button>
                    @endif   --> 
                        @foreach($consulta as $perfiles)
                            <div class="contMd" style="">
                                <div class="icl">
                                   
                                </div>
                           

                                 @if($datosC1==$perfiles->id)
                                    <span class="ttlMd"><input type="radio" name="c_rsp" id="c_rsp" value="1" checked> 
                                    <label for="c_rsp"><strong>{{$perfiles->descripcion}}</strong></label></span>
                                @else
                                     <span class="ttlMd"><input type="radio" name="c_rsp" id="c_rsp" value="0" > 
                                    <label for="c_rsp"><strong>{{$perfiles->descripcion}}</strong></label></span>
                                @endif

                            </div>
                        @endforeach
                    </div>
                    
                </div>   
    @endsection