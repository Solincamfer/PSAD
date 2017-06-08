@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Registro Perfil
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                 <div class="contenido">
                   
                     <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-2 ttlp">
                                <h1>Permisos</h1>
                            </div>
                        </div>
                        <div class="row sep-div">
                            <div  class="col-md-2 despl-bttn">
                                <div class="pnlUs">
                                    <span class="pnlttl"><i class="fa fa-user-circle"></i> {{$extra}}</span>
                                </div>
                            </div>
                            <div class="col-md-2 despl-bttn">
                                 <a href="/menu/registros/empleados">
                                     <div class="bttn-volver">
                                         <button id="btnBk" type="button" href="#" class="bttn-vol"><span class="fa fa-chevron-left"></span><span class="txt-bttn">VOLVER</span></button>
                                     </div>
                                 </a>
                             </div>
                        </div>
                    </div>
                  
                    
                    <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3"> 
                        
                        <input type="hidden" name="usuario" value="{{$datosC2}}" id="valor_usuario">
                        @foreach($consulta as $perfiles)
                            <div class="contMd" style="" id="{{$perfiles->id}}">
                                <div class="icl">
                              
                                 </div>
                                 

                                     @if($datosC1==$perfiles->id)
                                      
                                        <span class="ttlMd"> <input type="radio" name="c_rsp" id="radio{{$perfiles->id}}" value="{{$perfiles->id}}" checked> 
                                        <label for="c_rsp"><strong>{{$perfiles->descripcion}}</strong></label></span>
                                        <input type="hidden" name="perfil" value="{{$perfiles->id}}" id="valor_radio">
                                    @else
                                        <span class="ttlMd"><input type="radio" name="c_rsp" id="radio{{$perfiles->id}}" value="{{$perfiles->id}}"  > 
                                        <label for="c_rsp"><strong>{{$perfiles->descripcion}}</strong></label></span>
                                    @endif
                                   
                            </div>
                        @endforeach
                    </div>
                    
                </div>   
    @endsection