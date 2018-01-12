@foreach($consulta as $director)
        <div class="titulo-registros">
          <label>{{$director->descripcion}}</label>
        </div>
        @foreach($extra as $departamento)
            @if($departamento->director_id == $director->id)
                <div class="contMd">

                    <div class="icl">
                        @foreach($acciones as $accion)
                            @if($accion->id!=1 )
                                @if($accion->id==2)
                                    <span class="iclsp">
                                        <a  class="tltp modificar" data-modal="1" data-padre="{{$departamento->director_id}}" data-reg="{{$departamento->id}}" id="ModificaDepar{{$departamento->id}}" data-ttl="{{$accion->descripcion}}" data-toggle="modal" >
                                            <i class="{{$accion->clase_css}}"></i>
                                        </a>
                                    </span>
                                @elseif($accion->id==3)
                                    <span class="iclsp">
                                        <a data-modal="1" class="tltp add-reg" data-reg="{{$departamento->id}}" data-ttl="{{$accion->descripcion}}">
                                            <i class="{{$accion->clase_css}}"></i>
                                        </a>
                                    </span>
                                @endif
                            @elseif($accion->id==1 )
                                @if($departamento->status==1)
                                    <div class="chbx">
                                        <input type="checkbox" data-table="1" data-registro="{{ $departamento->id }}" class="btnAcc" name="status" id="{{'inchbx'. $departamento->id}}" value="{{$departamento->status}}" checked><label for="{{'inchbx'. $departamento->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                    </div>
                                @elseif($departamento->status==0)
                                    <div class="chbx">
                                        <input type="checkbox" data-table="1" data-registro="{{ $departamento->id }}" class="btnAcc" name="status" id="{{'inchbx'. $departamento->id}}" value="{{$departamento->status}}"><label for="{{'inchbx'. $departamento->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                    <div class="checkbox ttlMd1 filtro">
                        @if(in_array($departamento->id,$datosC1))                     
                            <label><input type="checkbox" checked="checked" value="{{$departamento->id}}">{{$departamento->descripcion}}</label>
                        @else
                            <label><input type="checkbox" value="{{$departamento->id}}">{{$departamento->descripcion}}</label>
                        @endif
                    </div>     
                </div>
            @endif
      @endforeach
    @endforeach