@extends('layouts.app')

@section('nombre')
    Registrar Rol
@endsection

@section('content')
<h1 style="text-align: center;"><strong>Registrar Rol</strong></h1>
@if (count($errors) > 0)
	<div class="alert alert-danger" role="alert">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
@if(session()->has('danger'))
	<div class="alert alert-danger" role="alert">{{session('danger')}}</div>
@endif
<form role="form" action="{{route('roles.store')}}" autocomplete="off" method="POST">
  	{{csrf_field()}}
  	<div class="form-group">
      <label for="name">Nombre del Rol:</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del Rol" required>
    </div>
    <div class="form-group">
      <label for="slug">Identificador:</label>
      <input type="text" class="form-control" id="slug" name="slug" placeholder="Identificador" required>
    </div>

    <div class="form-group">
      <label for="description">Descripcion:</label>
      <input type="text" class="form-control" id="description" name="description" placeholder="Descripcion" required>
    </div>

    <div class="form-group">
    	<nav>
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				@php
					$tableAnterior 		= 	"";
					$section			=	[];
				@endphp
				@foreach($permisos as $permiso)
			      	@php
			      		$table 			= 	explode(".",$permiso->slug);
			      	 	$table 			= 	$table[0];

			      	@endphp
			      	@if($table != $tableAnterior)
			      		@if($loop->first)
			      			<a class="nav-item nav-link active" id="nav-{{$table}}-tab" data-toggle="tab" href="#nav-{{$table}}" role="tab" aria-controls="nav-{{$table}}" aria-selected="true">{{$table}}</a>
			      		@else
			      			<a class="nav-item nav-link" id="nav-{{$table}}-tab" data-toggle="tab" href="#nav-{{$table}}" role="tab" aria-controls="nav-{{$table}}" aria-selected="false">{{$table}}</a>
			      		@endif
			      	@php 
			      		$tableAnterior = $table;
			      		$section[] = $table;
			      	@endphp
			      	@endif
			    @endforeach
			</div>
		</nav>
		<div class="tab-content" id="nav-tabContent">
			@foreach($section as $sec)
				@if($loop->first)
					<div class="tab-pane fade show active" id="nav-{{$sec}}" role="tabpanel" aria-labelledby="nav-{{$sec}}-tab">
						<div class="container">
							<fieldset class="form-group">
							    <div class="row">
							      <legend class="col-form-label col-sm-2 pt-0">Permisos</legend>
							      	<div class="col-sm-10">
								      	@foreach($permisos as $permiso)
											@if($sec == explode(".",$permiso->slug)[0])
										        <div class="form-check">
										        	<label class="form-check-label">
										          		<input type="checkbox" name="permission[]" value="{{$permiso->id}}">
										            	{{$permiso->description}}
										          	</label>
										        </div>
											@endif
										@endforeach
							      	</div>
							    </div>
							  </fieldset>												
						</div>
					</div>
				@else
					<div class="tab-pane fade" id="nav-{{$sec}}" role="tabpanel" aria-labelledby="nav-{{$sec}}-tab">
						<div class="container">
							<fieldset class="form-group">
							    <div class="row">
							      <legend class="col-form-label col-sm-2 pt-0">Permisos</legend>
							      	<div class="col-sm-10">
								      	@foreach($permisos as $permiso)
											@if($sec == explode(".",$permiso->slug)[0])
										        <div class="form-check">
										        	<label class="form-check-label">
										          		<input type="checkbox" name="permission[]" value="{{$permiso->id}}">
										            	{{$permiso->description}}
										          	</label>
										        </div>
											@endif
										@endforeach
							      	</div>
							    </div>
							  </fieldset>												
						</div>
					</div>
				@endif
			@endforeach
		</div>
    </div>
    <div class="d-flex justify-content-center">
		<button class="btn btn-sm btn-success" style="margin-right: 1%">Guardar</button>
		<a href="{{route('roles.index')}}" class="btn btn-sm btn-danger" style="">Cancelar</a>
	</div>
</form>
@endsection
