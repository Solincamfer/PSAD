@foreach($consulta as $area)
        <div class="titulo-registros">
          <label>{{$area->descripcion}}</label>
        </div>
        @foreach($extra as $cargo)
            @if($cargo->$area_id == $area->id)
                <div class="contMd">

                    <div class="icl">
                        @foreach($acciones as $accion)
                            @if($accion->id!=1 )
                                @if($accion->id==2)
                                    <span class="iclsp">
                                        <a  class="tltp ModificaR" data-reg="{{$cargo->id}}" id="ModificaDepar{{$cargo->id}}" data-ttl="{{$accion->descripcion}}" data-toggle="modal" >
                                            <i class="{{$accion->clase_css}}"></i>
                                        </a>
                                    </span>
                                @elseif($accion->id==3)
                                    <span class="iclsp">
                                        <a href="{{$accion->url.$cargo->id}}" class="tltp"  data-ttl="{{$accion->descripcion}}">
                                            <i class="{{$accion->clase_css}}"></i>
                                        </a>
                                    </span>
                                @endif
                            @elseif($accion->id==1 )
                                @if($cargo->status==1)
                                    <div class="chbx">
                                        <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $cargo->id}}" value="{{$cargo->status}}" checked><label for="{{'inchbx'. $cargo->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                    </div>
                                @elseif($cargo->status==0)
                                    <div class="chbx">
                                        <input type="checkbox" class="btnAcc" name="status" id="{{'inchbx'. $cargo->id}}" value="{{$cargo->status}}"><label for="{{'inchbx'. $cargo->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                    <div class="checkbox ttlMd1 filtro">
                        <label><input type="checkbox" value="{{$cargo->id}}">{{$cargo->descripcion}}</label>
                    </div>
                </div>
            @endif
        @endforeach
@endforeach