@foreach($consulta as $departamento)

    <div class="contMd">

        <div class="icl">
            @foreach($acciones as $accion)
                @if($accion->id!=1 )
                    @if($accion->id==2)
                        <span class="iclsp">
                            <a  class="tltp ModificaR" data-reg="{{$departamento->id}}" id="ModificaDepar{{$departamento->id}}" data-ttl="{{$accion->descripcion}}" data-toggle="modal" >
                                <i class="{{$accion->clase_css}}"></i>
                            </a>
                        </span>
                    @elseif($accion->id==3)
                        <span class="iclsp">
                            <a href="{{$accion->url.$departamento->id}}" class="tltp"  data-ttl="{{$accion->descripcion}}">
                                <i class="{{$accion->clase_css}}"></i>
                            </a>
                        </span>
                    @endif
                @elseif($accion->id==1 )
                    @if($departamento->status==1)
                        <div class="chbx">
                            <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $departamento->id}}" value="{{$departamento->status}}" checked><label for="{{'inchbx'. $departamento->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                        </div>
                    @elseif($departamento->status==0)
                        <div class="chbx">
                            <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $departamento->id}}" value="{{$departamento->status}}"><label for="{{'inchbx'. $departamento->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
        <div class="checkbox ttlMd1 filtro">
            <label><input type="checkbox" value="{{$departamento->id}}">{{$departamento->descripcion}}</label>
        </div>
    </div>

@endforeach
