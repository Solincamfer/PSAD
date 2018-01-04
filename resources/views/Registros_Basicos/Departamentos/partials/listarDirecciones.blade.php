@foreach($consulta as $direccion)

    <div class="contMd">

        <div class="icl">
            @foreach($acciones as $accion)
                @if($accion->id!=1 )
                    @if($accion->id==2)
                        <span class="iclsp">
                            <a  class="tltp ModificaR" data-reg="{{$direccion->id}}" id="ModificaDepar{{$direccion->id}}" data-ttl="{{$accion->descripcion}}" data-toggle="modal" >
                                <i class="{{$accion->clase_css}}"></i>
                            </a>
                        </span>
                    @elseif($accion->id==3)
                        <span class="iclsp">
                            <a href="{{$accion->url.$direccion->id}}" class="tltp"  data-ttl="{{$accion->descripcion}}">
                                <i class="{{$accion->clase_css}}"></i>
                            </a>
                        </span>
                    @endif
                @elseif($accion->id==1 )
                    @if($direccion->status==1)
                        <div class="chbx">
                            <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $direccion->id}}" value="{{$direccion->status}}" checked><label for="{{'inchbx'. $direccion->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                        </div>
                    @elseif($direccion->status==0)
                        <div class="chbx">
                            <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $direccion->id}}" value="{{$direccion->status}}"><label for="{{'inchbx'. $direccion->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
        <div class="ttlMd1">
            <span>{{$direccion->descripcion}}</span>
        </div>
    </div>
@endforeach