@extends('admin.basesys')
    @section('contenido')
        @section('title')
            Movimientos Por Usuario
        @endsection
            @include('layout/header')
                @include('layout/sidebar')
                <div class="contenido">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-2 ttlp">
                                <h1>Mov. Usuarios</h1>
                            </div>
                        </div>
                        <div class="row sep-div">
                            <table style="width:70%;height:10%">
                              <form method="post" class="BitMovUs" id="MovUs">
                                {{ csrf_field() }}
                                <tr>
                                  <td style="text-align: left;width:40%;height:100%">
                                    
                                      <label for="stPfl">Departamento</label>
                                      <select name="DepBitUs" id="DepBitUs" class="form-control" style="width:90%;height:100%">
                                              <option value="0">-</option>
                                              @foreach($consulta as $departamento)
                                                    <option value="{{$departamento->id}}">{{$departamento->descripcion}}</option>
                                              @endforeach

                                      </select>

                                  </td>
                                  <td style="text-align: left;width:40%;height:100%">
                                    
                                      <label for="stPfl">Usuario</label>
                                      <select name="UsBitUs" id="UsBitUs" class="form-control" style="width:90%;height:100%">
                                              <option value="0">-</option>
                                              
                                      </select>

                                  </td>
                                  <td  style="text-align: left;width:10%;height:100%">
                                         <br><button type="button" id="mostrarBitUs" class="btn btn-primary btn-sm">Mostrar</button>
                                      </td>
                                </tr>
                            </table>
                            </form>
                        </div>
                    </div>
                    
                    <div class="row sep-div" id="ResultadosMovUs"> 
                    

                    </div>
                     <div class="modal" tabindex="-1" role="dialog" id="ModalBitacora">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id=""><strong class="titulo" id="detallesAc" style="font-weight: bold;"></strong></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                              <table style="width:100%;height:2%" id="detalles_">
                                                     <tr style="background-color:#333333;color:#ffffff;">
                                                        <td  colspan="2" style="font-weight: bold;width:30%;height:2%;text-align: center;">Datos de identificacion</td>

                                                        
                                                    </tr>
                                                   
                                                    <tr style="background-color:#f7f4f4">
                                                        <td style="font-weight: bold;width:30%;height:2%;text-align: left;">Empleado - Usuario: </td>

                                                        <td style="width:50%;height:2%;text-align: left;" id="username"> </td>
                                                    </tr>
                                                    <tr style="background-color:#ffffff">
                                                        <td style="font-weight: bold;width:30%;height:2%;text-align: left;">Fecha de la accion: </td>
                                                        
                                                        <td style="width:50%;height:2%;text-align: left;" id="fecha"> 18-03-2018  3:45 PM</td>
                                                    </tr>
                                                     <tr style="background-color:#f7f4f4">
                                                        <td style="font-weight: bold;width:30%;height:2%;text-align: left;">Registro afectado: </td>

                                                        <td style="width:50%;height:2%;text-align: left;" id="registro"> JOSE TAYUPO - JOCTAYUPO</td>
                                                    </tr>
                                                    <tr style="background-color:#ffffff">
                                                        <td style="font-weight: bold;width:30%;height:2%;text-align: left;">Ventana: </td>
                                                        
                                                        <td style="width:50%;height:2%;text-align: left;" id="ventana"> </td>
                                                    </tr>
                                                     <tr style="background-color:#333333;color:#ffffff;">
                                                        <td  colspan="2" style="font-weight: bold;width:30%;height:2%;text-align: center;">Detalles de la accion</td>

                                                        
                                                    </tr>
                                                   
                                              </table>
                                          </div>
                                          <div class="modal-footer">
                                            
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                          </div>
                                        </div>
                                      </div>
                          </div>
     @endsection
     @section('js')
        <script src="{{asset('js/movUsuarios.js')}}"></script>
     @endsection