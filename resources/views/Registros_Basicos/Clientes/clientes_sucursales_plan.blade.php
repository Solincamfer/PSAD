@extends('admin.basesys')
   @section('contenido')
       @section('title')
           Seleccionar Plan
       @endsection
           @include('layout/header')
               @include('layout/sidebar')
                   <div class="contenido">
                       <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style="margin-top: 2em;"> 
                       
                               <div class="contMd">
                                   @foreach($acciones as $accion)
                                     @if($accion->descripcion!="Status")
                                        <span style="display: inline-block; float: right;"><a href="{{$accion->url}}"><i class="{{$accion->clase_css}}"></i></a></span>
                                
                                    @elseif($accion->descripcion=="Status")

                                        @if($accion->status_ac==1)
                                             <input type="checkbox" class="btnAcc" name="status" value="{{$accion->status_ac}}" checked>
                                        
                                        @elseif($accion->staus_ac==0)
                                             <input type="checkbox" class="btnAcc" name="status" value="{{$accion->status_ac}}" >
                                        @endif
                                     
                                @endif
                                @endforeach
                                   <span class="ttlMd"><input type="radio" name="planes" id="" value=""> <label for="planes"><strong>REGISTRO</strong></label></span>
                               </div>
                       
                       </div>
                   </div>   
   @endsection