<div class="table-responsive" id="tablaResultadosUs">
                       <table class="table table-condensed table-bordered  " style="width:75%;height:2%">
                              <tr style="background-color:#333333;color: #FEFCFC">
                                <td style="text-align:center;width:13%;height:10%">
                                          Usuario
                                </td>
                                <td style="text-align:center;width:13%;height:10%">
                                          Empleado
                                </td>
                                <td style="text-align: center;width:16%;height:10%">
                                          
                                           <select name="DepBitUs" id="DepBitUs" class="form-control" style="float:left;width:75%;height:30%">
                                              <option value="">-</option>
                                          </select>&nbsp;Fecha
                                          
                                </td>
                                <td style="text-align: left;width:16%;height:10%">
                                         <select name="DepBitUs" id="DepBitUs" class="form-control" style="float:left;width:75%;height:30%">
                                              <option value="">-</option>
                                          </select>
                                       &nbsp; Accion
                                </td>
                                <td style="text-align: left;width:16%;height:10%">

                                        <select name="DepBitUs" id="DepBitUs" class="form-control" style="float:left;width:70%;height:30%">
                                              <option value="">-</option>
                                          </select>
                                       &nbsp; Ventana
                                      </td>
                                
                              </tr>
                              @foreach($bitacora as $registro)
                                    <tr style="background-color:#FEFCFC;color: #050505;text-align: center;">
                                          <td >{{$registro->username}}</td>
                                          <td >{{$registro->usuario}}</td>
                                          <td >{{$registro->created_at}}</td>
                                          <td ><button type="button" class="btn btn-link btn-primary movUsuario"  id="{{$registro->id}}">{{$registro->accion}}</button></td>
                                          <td >{{$registro->ventana}}</td>
                                          
                                    </tr>
                              @endforeach
                           

                       </table>
                     </div>
                      <div class="modal" tabindex="-1" role="dialog" id="ModalBitacora">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <p>Modal body text goes here.</p>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          </div>
                                        </div>
                                      </div>
                          </div>


               
</div>


                  
