<div class="sidebar">
	<ul id="accordion" class="accordion">
		<li>		
			@foreach($modulos as $modulo)
				<div class="link"><i class=""></i>{{$modulo->descripcion}}<i class="fa fa-chevron-circle-left"></i></div>
				<ul class="submenu">
				@foreach($submodulos as $submodulo)
					@if($submodulo->modulo_id ==$modulo->id)
						<li><a href="#">{{$submodulo->descripcion}}</a></li>
					@endif
				@endforeach
		       </ul>
			@endforeach
		</li>
	</ul>
</div>