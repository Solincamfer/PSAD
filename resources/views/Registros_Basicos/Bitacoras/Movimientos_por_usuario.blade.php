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

                        

         
     @endsection