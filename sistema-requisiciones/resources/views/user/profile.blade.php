@extends('layouts.app')

<head><link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"></head>

@section('content')
<div class="container">

	<div class="panel panel-default">
		<div class="panel-body">
			<form action="" role="form" method="POST">
				{{ csrf_field() }}
				<div class="row-container text-center">
					<h2><strong>{{ $user->name }}</strong></h2>
					<br><br>
				</div>

				@if (session('notification'))
                <div class="alert alert-success">
                    {{ session('notification') }}
                </div>
            	@endif

				<div class="form-group row">
					<label for="role" class="label-control col-md-1"><strong>Puesto</strong></label>
					<div class="col-md-8">
						@if ($user->role == 1)
						<p id="role" name="" class="col-md-10"> Secretario Académico </p>
						@elseif ($user->role == 2)
						<p id="role" class="col-md-10"> Planeacion </p>
						@elseif ($user->role == 3)
						<p id="role" class="col-md-10"> Finanzas </p>
						@elseif ($user->role == 4)
						<p id="role" class="col-md-10"> Compras </p>
						@elseif ($user->role == 5)
						<p id="role" class="col-md-10"> Profesor </p>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label for="email" class="control-label col-md-1"><strong>Email</strong></label>
					<div class="col-md-8">
						<input id="email" name="email" type="email" class="form-control" value="{{$user->email}}">
					</div>
				</div>
				<div class="form-group row">
					<label for="tel" class="control-label col-md-1"><strong>Teléfono</strong></label>
					<div class="col-md-8">
						<input id="tel" name="tel" type="text" class="form-control" value="{{$user->tel}}">
					</div>
				</div>
				<div class="form-group row">
					<label for="password" class="control-label col-md-1"><strong>Nueva Contraseña</strong></label>
					<div class="col-md-8">
						<input id="password" name="password" type="password" class="form-control" value="">
					</div>
				</div>
				<div class="form-group row">
					<label for="confirm" class="control-label col-md-1"><strong>Confirmar Contraseña</strong></label>
					<div class="col-md-8">
						<input id="confirm" name="confirm" type="password" class="form-control" value="">
					</div>
				</div>

				<div class="form-group col-md-2">
					<button class="btn btn-primary">Guardar Cambios</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection