<div class="sidebar">
	<ul id="accordion" class="accordion">
		<li>		
			@foreach($modulos as $modulo)
				<div class="link">{{$modulo->descripcion}}<i class="fa fa-chevron-circle-right"></i></div>
				<ul class="submenu">
				@foreach($submodulos as $submodulo)
					@if( ($submodulo->padre==$modulo->moduloId)  )
						<li class="c" data-activo="{{$submodulo->url}}">
							<a href="{{$submodulo->ruta}}">{{$submodulo->descripcion}}</a>
						</li>
					@endif
				@endforeach
		       </ul>
			@endforeach
		</li>
	</ul>
</div>

