@if($datosC1==1)
    @foreach($consulta as $departamentos)
        @foreach($departamentos as $departamento)
            <div class="titulo-registros">
              <label>{{$departamento->descripcion}}</label>
            </div>
                @foreach($extra as $conjunto)
                    @foreach($conjunto as $area )
                        @if($area->departamento_id == $departamento->id)
                            <div class="contMd">
                                <div class="icl">
                                    @foreach($acciones as $accion)
                                        @if($accion->id!=1 )
                                            @if($accion->id==2)
                                                <span class="iclsp">
                                                    <a  class="tltp modificar" data-modal="2" data-padre="{{$area->departamento_id}}" data-reg="{{$area->id}}" id="ModificaDepar{{$area->id}}" data-ttl="{{$accion->descripcion}}" data-toggle="modal" >
                                                        <i class="{{$accion->clase_css}}"></i>
                                                    </a>
                                                </span>
                                            @elseif($accion->id==3)
                                                <span class="iclsp">
                                                    <a data-modal="2" class="tltp add-reg" data-reg="{{$area->id}}" data-ttl="{{$accion->descripcion}}">
                                                        <i class="{{$accion->clase_css}}"></i>
                                                    </a>
                                                </span>
                                            @endif
                                        @elseif($accion->id==1 )
                                            @if($area->status==1)
                                                <div class="chbx">
                                                    <input type="checkbox" data-table="2" data-registro="{{ $area->id }}" class="btnAcc" name="status" id="{{'inchbx'. $area->id}}" value="{{$area->status}}" checked><label for="{{'inchbx'. $area->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                                </div>
                                            @elseif($area->status==0)
                                                <div class="chbx">
                                                    <input type="checkbox" data-table="2" data-registro="{{ $area->id }}" class="btnAcc" name="status" id="{{'inchbx'. $area->id}}" value="{{$area->status}}"><label for="{{'inchbx'. $area->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                                <div class="checkbox ttlMd1 filtro">
                                   @if(in_array($area->id,$datosC2))                     
                                        <label><input type="checkbox" checked="checked" value="{{$area->id}}">{{$area->descripcion}}</label>
                                    @else
                                        <label><input type="checkbox" value="{{$area->id}}">{{$area->descripcion}}</label>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
        @endforeach
    @endforeach
@else
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
                                        <a  class="tltp modificar" data-modal="2" data-reg="{{$area->id}}" data-padre="{{ $area->departamento_id }}" id="ModificaDepar{{$area->id}}" data-ttl="{{$accion->descripcion}}" data-toggle="modal" >
                                            <i class="{{$accion->clase_css}}"></i>
                                        </a>
                                    </span>
                                @elseif($accion->id==3)
                                    <span class="iclsp">
                                        <a class="tltp add-reg" data-modal="2" data-reg="{{$area->id}}" data-ttl="{{$accion->descripcion}}">
                                            <i class="{{$accion->clase_css}}"></i>
                                        </a>
                                    </span>
                                @endif
                            @elseif($accion->id==1 )
                                @if($area->status==1)
                                    <div class="chbx">
                                        <input type="checkbox" class="btnAcc" name="status" data-table="2" data-registro="{{ $area->id }}" id="{{'inchbx'. $area->id}}" value="{{$area->status}}" checked><label for="{{'inchbx'. $area->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                    </div>
                                @elseif($area->status==0)
                                    <div class="chbx">
                                        <input type="checkbox" class="btnAcc" data-table="2" data-registro="{{ $area->id }}" name="status" id="{{'inchbx'. $area->id}}" value="{{$area->status}}"><label for="{{'inchbx'. $area->id}}" class="tltpck" data-ttl="{{$accion->descripcion}}"></label>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                    <div class="checkbox ttlMd1 filtro" id="areas">
                        @if(in_array($area->id,$datosC2))                     
                            <label><input type="checkbox" checked="checked" value="{{$area->id}}">{{$area->descripcion}}</label>
                        @else
                            <label><input type="checkbox" value="{{$area->id}}">{{$area->descripcion}}</label>
                        @endif
                    </div>
                </div>
            @endif
      @endforeach
    @endforeach
@endif