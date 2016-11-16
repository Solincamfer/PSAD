@extends('admin.basesys')
   @section('contenido')
       @section('title')
           Seleccionar Plan
       @endsection
           @include('layout/header')
               @include('layout/sidebar')
                   <div class="contenido">
                       <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3" style="margin-top: 2em;"> 
                           @for($i=0; $i < 5; $i++)
                               <div class="contMd">
                                   @for($j=0; $j < 5; $j++)
                                       <button class="btnAcc" type="submit">Modificar</button>
                                   @endfor
                                   <span class="ttlMd"><input type="radio" name="planes" id="" value=""> <label for="planes"><strong>REGISTRO</strong></label></span>
                               </div>
                           @endfor
                       </div>
                   </div>   
   @endsection