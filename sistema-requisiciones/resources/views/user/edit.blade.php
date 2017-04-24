@extends('layouts.app')

<head><link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"></head>

@section('content')
<div class="container">

	<div class="panel panel-default">
		<div class="panel-body">
			<form action="" role="form" method="POST">
				{{ csrf_field() }}
				@if ($user->auth == false)
					<div class="row-container text-center">
						<h2><strong>PENDIENTE POR APROBAR</strong></h2>
						<br><br>
					</div>
				@endif

				<div class="row-container">
					<label for="no" class="label-control col-md-2"><strong>Nombre</strong></label>
					<p id="no" class="col-md-10">{{ $user->name }}</p>
				</div>
				<div class="row-container">
					<label for="fecha" class="label-control col-md-2"><strong>Email</strong></label>
					<p id="fecha" class="col-md-10"> {{$user->email}} </p>
				</div>
				<div class="row-container">
					<label for="solicitante" class="label-control col-md-2"><strong>Teléfono</strong></label>
					<p id="solicitante" class="col-md-10"> {{$user->tel}} </p>
				</div>
				<div class="row-container">
					<label for="area" class="label-control col-md-2"><strong>Puesto</strong></label>
					@if ($user->role == 1)
					<p id="solicitante" class="col-md-10"> Secretario Académico </p>
					@elseif ($user->role == 2)
					<p id="solicitante" class="col-md-10"> Planeacion </p>
					@elseif ($user->role == 3)
					<p id="solicitante" class="col-md-10"> Finanzas </p>
					@elseif ($user->role == 4)
					<p id="solicitante" class="col-md-10"> Compras </p>
					@elseif ($user->role == 5)
					<p id="solicitante" class="col-md-10"> Profesor </p>
					@endif
				</div>

				@if ($user->auth == true)
					<div class="form-group col-md-2">
						<button class="btn btn-danger">Dar de baja</button>
					</div>
				@endif
			</form>
		</div>
	</div>
</div>
@endsection