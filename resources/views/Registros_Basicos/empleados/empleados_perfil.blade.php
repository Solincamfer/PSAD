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
                                     <span class="pnlttl"><i class="fa fa-user-circle"></i> {{$extra}}</span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="usuario" value="{{$datosC2}}" id="valor_usuario">
                        @foreach($consulta as $perfiles)
                            <div class="contMd" style="" id="{{$perfiles->id}}">
                                <div class="icl">
                                  @foreach($acciones as $accion) 
                                 </div>
                                 

                                     @if($datosC1==$perfiles->id)
                                        @if($accion->id==79)
                                            <span class="ttlMd"> <input type="radio" name="c_rsp" id="radio{{$perfiles->id}}" value="{{$perfiles->id}}" checked> 
                                        @endif
                                        <label for="c_rsp"><strong>{{$perfiles->descripcion}}</strong></label></span>
                                        <input type="hidden" name="perfil" value="{{$perfiles->id}}" id="valor_radio">
                                    @else
                                         @if($accion->id==79)
                                             <span class="ttlMd"><input type="radio" name="c_rsp" id="radio{{$perfiles->id}}" value="{{$perfiles->id}}"  > 
                                        @endif
                                        <label for="c_rsp"><strong>{{$perfiles->descripcion}}</strong></label></span>
                                    @endif
                                    @endforeach
                            </div>
                        @endforeach
                    </div>
                    
                </div>   
    @endsection