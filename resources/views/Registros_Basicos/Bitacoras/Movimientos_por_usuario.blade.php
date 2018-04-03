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
                            <table style="width:70%;height:10%;margin-left: 1%;">
                              <form method="post" class="BitMovUs" id="MovUs">
                                {{ csrf_field() }}
                                
                                <tr style="width: 100%;height: 100%;">
                                  <td style="text-align: left;width:40%;height:30%;border:0px solid black ;">
                                    <label>Departameto</label>
                                      
                                      <select name="DepBitUs" id="DepBitUs" class="form-control" style="width:90%;height:60%">
                                              <option value="0">-</option>
                                              @foreach($consulta as $departamento)
                                                    <option value="{{$departamento->id}}">{{$departamento->descripcion}}</option>
                                              @endforeach

                                      </select>

                                  </td>
                                  <td style="text-align: left;width:40%;height:30%;border:0px solid black ;">
                                    
                                     <label>Usuario</label>
                                      <select name="UsBitUs" id="UsBitUs" class="form-control" style="width:90%;height:60%">
                                              <option value="0">-</option>
                                              
                                      </select>

                                  </td>
                                  <td  style="text-align: left;width:10%;height:30%;border:0px solid black ;">
                                         <br><button type="button" id="mostrarBitUs" class="btn btn-primary btn-sm" style="margin-left: 1%;margin-top: 2%;">Mostrar</button>
                                      </td>
                                </tr>
                            </table>
                            </form>
                        </div>
                    </div>
                     <div class="row sep-div" id="filtrosUsuario"> 
                    
                      <table style="border:0px solid #f7f4f4 ;width:75%;height: 30%;margin-left: 2%;" >
                             
                              <tr style="background-color: #333333;color:#FFFFFF;">
                                  <td style="text-align: left;border-right: 1px solid #d6d4d4;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Desde&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hasta</td>
                                  <td style="text-align: center;border-right: 1px solid #d6d4d4;">Submodulo</td>
                                  <td style="text-align: center;">Operacion</td>
                              </tr>
                              <tr style="background-color: #f7f4f4;border:1px solid #d6d4d4 ;">
                                <td style="border-right: 1px solid #d6d4d4;width: 30%;height: 70%;">
                                   <input type="date" name="" id="fechaDesde" style="width:38%;height: 70%;margin-left: 10%; ">
                                   <input type="date" name="" id="fechaHasta" style="width:38%;height: 70%;margin-left: 2%; ">
                                </td>
                                <td style="border-right: 1px solid #d6d4d4;width: 30%;height: 70%;text-align: center;">
                                      
                                      <select style="width: 90%;height: 85%;margin-left:  5%;margin-top: 1%;" name="" id="submodulo_id" class="form-control" >
                                              <option value="0">-</option>
                                               @foreach($datosC1 as $submodulo)
                                                    <option value="{{$submodulo->id}}">{{$submodulo->descripcion}}</option>
                                              @endforeach
                                              
                                      </select>
                                </td>
                                <td style=";width: 30%;height: 70%;text-align: center;">
                                     
                                      <select style="width: 90%;height: 85%;margin-left:  5%;margin-top: 1%;" name="" id="operacion_id" class="form-control" >
                                              <option value="0">-</option>
                                                @foreach($extra as $operacion)
                                                    <option value="{{$operacion->id}}">{{$operacion->descripcion}}</option>
                                              @endforeach
                                              
                                      </select>
                                </td>
                              </tr>
                              
                      </table>
                    </div>
                    
                    <div class="row sep-div" id="ResultadosMovUs"> 
                    

                    </div>
                    <div class="row sep-div" id="ResultadosMovUs"> 
                        <table style="border:0px solid black ;width:75%;height: 30%;margin-left: 2%;" >
                                <tr>
                                    <td style="border:0px solid black ;width: 10%;height: 40%;text-align: center;background-color: #333333;color:#FFFFFF;font-weight: bold;"><< Atras</td>
                                    <td style="border:0px solid black ;width: 27%;height: 40%;text-align: center;font-weight: bold;">Resultados: 1450</td>
                                    <td style="border:0px solid black ;width: 27%;height: 40%;text-align: center;font-weight: bold;">Pagina: 1 de: 50</td>
                                    <td style="border:0px solid black ;width: 10%;height: 40%;text-align: center;background-color: #333333;color:#FFFFFF;font-weight: bold;">Proxima >> </td>
                                </tr>
                        </table>
    
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