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
                                <h1>Permisos</h1>
                            </div>
                        </div>
                    </div>
                  
                    
                    <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3"> 
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2" align="left">
                                    <a href="/menu/registros/empleados"><button id="btnBk" type="button" class="btnBk" href="#"><i class="fa fa-chevron-left"></i> VOLVER</button></a>
                                </div>
                                <div class="col-md-2 col-md-offset-3 pnlUs">
                                     <span class="pnlttl"><i class="fa fa-user-circle"></i> Usuario</span>
                                </div>
                            </div>
                        </div>
                        @foreach($consulta as $perfiles)
                            <div class="contMd" style="" id="registro{{$perfiles->id}}">
                                <div class="icl">
                                   
                                </div>
                                 <input type="text" name="usuario{{$perfiles->id}}" value="{{$datosC3}}" id="usuario{{$perfiles->id}}">

                                 @if($datosC1==$perfiles->id)
                                    <span class="ttlMd"><input type="radio" name="c_rsp" id="{{$perfiles->id}}" value="{{$perfiles->id}}" checked="checked"> 
                                    <label for="c_rsp"><strong>{{$perfiles->descripcion}}</strong></label></span>
                                @else
                                     <span class="ttlMd"><input type="radio" name="c_rsp" id="{{$perfiles->id}}" value="{{$perfiles->id}}" checked="false" > 
                                    <label for="c_rsp"><strong>{{$perfiles->descripcion}}</strong></label></span>
                                @endif

                            </div>
                        @endforeach
                    </div>
                    
                </div>   
    @endsection