<div class="sidebar">
	<ul id="accordion" class="accordion">
		<li>		
			
			@foreach($modulos as $modulo)
				@if($modulo->status_m==1)
					<div class="link">{{$modulo->descripcion}}<i class="fa fa-chevron-circle-left"></i></div>
					<ul class="submenu">
				@endif
				@foreach($submodulos as $submodulo)
					@if(($submodulo->modulo_id ==$modulo->id)and ($submodulo->status_sm==1 and $submodulo->padre==1))
						<li class="c"><a href="{{$submodulo->ruta}}">{{$submodulo->descripcion}}</a></li>
					@endif
				@endforeach
		       </ul>
			@endforeach
		</li>
	</ul>
</div>