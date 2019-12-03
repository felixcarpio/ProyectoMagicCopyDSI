@extends('layouts.app')

@section('nombre')
    Editar Rol
@endsection

@section('content')
<h1 style="text-align: center;"><strong>Editar Rol</strong></h1>
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
<form role="form" action="{{route('roles.update',['role' => $rol->id])}}" autocomplete="off" method="POST">
  	{{csrf_field()}}
  	{{method_field('PUT')}}
  	<div class="form-group">
      <label for="name">Nombre del Rol:</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del Rol" required value="{{$rol->name}}">
    </div>
    <div class="form-group">
      <label for="slug">Identificador:</label>
      <input type="text" class="form-control" id="slug" name="slug" placeholder="Identificador" required value="{{$rol->slug}}">
    </div>

    <div class="form-group">
      <label for="description">Descripcion:</label>
      <input type="text" class="form-control" id="description" name="description" placeholder="Descripcion" required value="{{$rol->description}}">
    </div>
    @if($rol->id != 1 && $rol->id != 2)
	    <div class="form-group">
	    	<nav>
				<div class="nav nav-tabs" id="nav-tab" role="tablist">
					@php
						$tableAnterior 		= 	"";
						$section 			=	[];
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
													@if(in_array($permiso->slug,$slugs))
												        <div class="form-check">
												        	<label class="form-check-label">
												          		<input type="checkbox" name="permission[]" value="{{$permiso->id}}" checked>
												            	{{$permiso->description}}
												          	</label>
												        </div>
											        @else
											        	<div class="form-check">
												        	<label class="form-check-label">
												          		<input type="checkbox" name="permission[]" value="{{$permiso->id}}">
												            	{{$permiso->description}}
												          	</label>
												        </div>
											        @endif
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
											        @if(in_array($permiso->slug, $slugs))
												        <div class="form-check">
												        	<label class="form-check-label">
												          		<input type="checkbox" name="permission[]" value="{{$permiso->id}}" checked>
												            	{{$permiso->description}}
												          	</label>
												        </div>
											        @else
											        	<div class="form-check">
												        	<label class="form-check-label">
												          		<input type="checkbox" name="permission[]" value="{{$permiso->id}}">
												            	{{$permiso->description}}
												          	</label>
												        </div>
											        @endif
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
   	@else
   		<div class="form-group" align="center">
   			@if($rol->id == 1)
   				<h1>Acceso Total</h1>
   			@elseif($rol->id == 2)
   				<h1>Sin Acceso</h1>
   			@endif
   		</div>
   	@endif
	<div class="d-flex justify-content-center">
		<button class="btn btn-sm btn-success" style="margin-right: 1%">Guardar</button>
		<a href="{{route('roles.index')}}" class="btn btn-sm btn-danger" style="">Regresar</a>
	</div>
</form>
@endsection