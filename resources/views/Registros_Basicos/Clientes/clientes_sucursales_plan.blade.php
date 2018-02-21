@extends('admin.basesys')
   @section('contenido')
       @section('title')
           Seleccionar Plan -Sucursales
       @endsection
           @include('layout/header')
               @include('layout/sidebar')
                  <div class="contenido">
                     <div class="container-fluid">
                         <div class="row">
                             <div class="col-md-4 ttlp">
                                 <h1>{{$datosC1->nombre.' / '.$extra->nombreComercial}} - Plan</h1>
                             </div>
                         </div>
                         <div class="row sep-div">
                             <div class="col-md-2 despl-bttn">
                                 <a href="/menu/registros/clientes/categorias/sucursales/{{$datosC1->id}}">
                                     <div class="bttn-volver">
                                         <button id="btnBk" type="button" href="#" class="bttn-vol"><span class="fa fa-chevron-left"></span><span class="txt-bttn">VOLVER</span></button>
                                     </div>
                                 </a>
                             </div>
                         </div>
                     </div>
                     <div class="col-xs-5 col-sm-5 col-md-6 col-md-offset-3"> 
                        
                        @foreach($consulta as $plan)
                             <div class="contMd">
                                 <div class="icl">
                                     @foreach($acciones as $accion)
                                         @if($accion->descripcion!="Status")
                                             <span class="iclsp">
                                                 <a  class="planesInfo" data-ttl="{{$accion->descripcion}}" data-toggle="modal"  data-id="planI{{$plan->id}}" data-reg="{{$plan->id}}" >
                                                     <i class="{{$accion->clase_css}}"></i>
                                                 </a>
                                             </span>
                                         @endif
                                     @endforeach
                                 </div>
                                 @if($datosC2==$plan->id)
                                      <span class="ttlMd1"><input type="radio" name="planSucursal"  class="radioPlan" data-reg="{{$plan->id}}" id="planS{{$plan->id}}" data-sucursal="{{$extra->id}}" value="1" checked> <label for="planSucursal"><strong>{{$plan->nombreP}}</strong></label></span>
                                      <input type="hidden" name="planSeleccionado_" id="planSeleccionado_" value="{{$plan->id}}" >
                                  @else
                                      <span class="ttlMd1"><input type="radio" name="planSucursal"  class="radioPlan"  data-reg="{{$plan->id}}" id="planS{{$plan->id}}" data-sucursal="{{$extra->id}}" value="0"> <label for="planSucursal"><strong>{{$plan->nombreP}}</strong></label></span>
                                  @endif
                             </div>
                     @endforeach
                      </div>

<!-- //////// MODAL INFORMACION DE LOS SERVICIOS QUE TIENE EL PLAN //////////////////////// -->
                       
                      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel"><strong class="titulo" id="tituloServ" style="font-weight: bold;"></strong></h4>
                                </div>
                                <div class="modal-body">

                                    <div class="container-fluid" id="contdpto">
                                      <div class="col-md-8 col-md-offset-2 servicios">
                                          <table style="width:100%;height:50%">
                                                <tr>
                                                    <td colspan="4" style="text-align: center;background-color:#feeaba;font-weight: bold;">Horarios</td>
                                                </tr>
                                                <tr style="background-color:#fcfaf7">
                                                    <td style="font-weight: bold;">Hora Inicio: </td><td id="hrInicio"></td><td style="font-weight: bold;">Hora Final: </td><td id="hrFinal"></td>
                                                </tr>
                                                <tr style="background-color: #e8e5e1">
                                                    <td style="font-weight: bold;">Dia Inicio: </td><td id="diaIn"></td><td style="font-weight: bold;">Dia Final: </td><td id="diaFn" ></td>
                                                </tr>
                                                <tr style="background-color:#fcfaf7;text-align: left;">
                                                    <td colspan="1" style="font-weight: bold;">Precio: </td><td colspan="3" id="precHr"> </td>
                                                </tr>
                                          </table>
                                          <br>
                                          <table style="width:100%;height:50%">
                                                <tr style="background-color: #f7958c;text-align: center;">
                                                    <td colspan="2" style="font-weight: bold;">Tiempo de respuesta</td>
                                                </tr>
                                                <tr style="background-color: #fcfaf7">
                                                    <td style="width:15%;height:50%;font-weight: bold;">Horas:</td><td style="width:85%;height:50%" id="hrsRes"></td>
                                                </tr>
                                                <tr style="background-color:#e8e5e1">
                                                    <td style="width:15%;height:50%;font-weight: bold;">Precio:</td><td style="width:85%;height:50%" id="precResp"></td>
                                                </tr>
                                                
                                          </table>
                                           <br>
                                           <table style="width:100%;height:50%">
                                                <tr style="background-color: #f74f73;text-align: center;font-weight: bold;">
                                                    <td colspan="2" style="font-weight: bold;">Soporte Presencial</td>
                                                </tr>
                                                <tr style="background-color: #fcfaf7">
                                                    <td style="width:40%;height:50%;font-weight: bold;">Cntd. de soportes:</td><td style="width:60%;height:50%" id='cndPres'></td> 
                                                </tr>
                                                <tr style="background-color:#e8e5e1">
                                                    <td style="width:40%;height:50%;font-weight: bold;">Precio:</td><td style="width:70%;height:60%" id="precPres"></td> 
                                                </tr>
                                                
                                          </table>
                                          <br>
                                           <table style="width:100%;height:50%">
                                                <tr style="background-color: #a2db46;text-align: center;">
                                                    <td colspan="2" style="font-weight: bold;">Soporte Remoto</td>
                                                </tr>
                                                <tr style="background-color: #fcfaf7">
                                                    <td style="width:40%;height:50%;font-weight: bold;">Cntd. de soportes:</td><td style="width:60%;height:50%" id="cndRem"></td> 
                                                </tr>
                                                <tr style="background-color:#e8e5e1">
                                                    <td style="width:40%;height:50%;font-weight: bold;">Precio:</td><td style="width:70%;height:60%" id="precRem"></td> 
                                                </tr>
                                                
                                          </table>
                                           <br>
                                           <table style="width:100%;height:50%">
                                                <tr style="background-color: #00b3c3;text-align: center;">
                                                    <td colspan="2" style="font-weight: bold;">Soporte Telefonico</td>
                                                </tr>
                                               <tr style="background-color: #fcfaf7">
                                                    <td style="width:40%;height:50%;font-weight: bold;">Cntd. de soportes:</td><td style="width:60%;height:50%" id="cndTel"></td> 
                                                </tr>
                                                <tr style="background-color:#e8e5e1">
                                                    <td style="width:40%;height:50%;font-weight: bold;">Precio:</td><td style="width:70%;height:60%" id="precTel"></td> 
                                                </tr>
                                                
                                          </table>
                                          <br>
                                          <table style="width:100%;height:50%;background-color: #91b5e0;text-align: center;">
                                              <tr><td>Mantenimiento anual, standarizacion y toma de inventario, esta icluido en el plan.</td></tr>
                                          </table>
                                      </div>
                                    </div> 
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="bttnMd bttminimizar" data-dismiss="modal" id="btnCs">Cerrar <i class="fa fa-times"></i></button>
                                </div>
                            </div>                           
                        </div>
                      </div>
                  </div>  
   @endsection
   @section('js')
    <script src="{{asset('js/sucursalPlanes.js')}}"></script>
   @endsection