@foreach($consulta as $departamento)
    <div class="titulo-registros">
      <label>{{$departamento->descripcion}}</label>
    </div>
    @foreach($extra as $area)
        @if($area->departamento_id == $departamento->id)
            <div class="contMd">
                <div class="icl">
                    @foreach($acciones as $accion)
                        @if($accion->id!=1 )
                            @if($accion->id==2)
                                <span class="iclsp">
                                    <a  class="tltp ModificaR" data-reg="{{$area->id}}" id="ModificaDepar{{$area->id}}" data-ttl="{{$accion->descripcion}}" data-toggle="modal" >
                                        <i class="{{$accion->clase_css}}"></i>
                                    </a>
                                </span>
                            @elseif($accion->id==3)
                                <span class="iclsp">
                                    <a href="{{$accion->url.$area->id}}" class="tltp"  data-ttl="{{$accion->descripcion}}">
                                        <i class="{{$accion->clase_css}}"></i>
                                    </a>
                                </span>
                            @endif
                        @elseif($accion->id==1 )
                            @if($area->status==1)
                                <div class="chbx">
                                    <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $area->id}}" value="{{$area->status}}" checked><label for="{{'inchbx'. $area->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                </div>
                            @elseif($area->status==0)
                                <div class="chbx">
                                    <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $area->id}}" value="{{$area->status}}"><label for="{{'inchbx'. $area->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>
                <div class="checkbox ttlMd1 filtro">
                    <label><input type="checkbox" value="{{$area->id}}">{{$area->descripcion}}</label>
                </div>
            </div>
        @endif
  @endforeach
@endforeach