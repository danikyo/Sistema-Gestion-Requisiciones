@extends('layouts.app')

<head><link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"></head>

@section('content')
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			Usuarios
		</div>

		@if (session('notification'))
            <div class="alert alert-success">
                {{ session('notification') }}
            </div>
        @endif

		<form class="navbar-form navbar-left pull-right" role="search" action="" method="GET">
			<div class="form-group">
				<input name="name" type="text" class="form-control" placeholder="ID o Área...">
			</div>
			<button class="btn btn-default" type="submit">Buscar</button>
		</form>

		<form role="form" action="" method="POST">
		{{ csrf_field() }}
			<div class="panel-body">
				<div class="col-md-12">
					<table id="userTable" class="table .table-striped">
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Puesto</th>
							<th>Observación</th>
							<th>Opción</th>
						</tr>
						@foreach($users as $user)
						<tr>
							<td>
								{{ $user->id }}
							</td>
							<td>
								{{ $user->name }}
							</td>
							<td>
								@if ($user->role == 1)
								Secretario Académico
								@elseif ($user->role == 2)
								Planeacion
								@elseif ($user->role == 3)
								Finanzas
								@elseif ($user->role == 4)
								Compras
								@elseif ($user->role == 5)
								Profesor
								@endif
							</td>
							<td>
								@if ($user->auth == true)
									<label for="" style="color:green" class="label-control">Ok</label>
								@else
									<label for="" style="color:red" class="label-control">Pendiente por Aprobar</label>
								@endif
							</td>
							<td>
								<a id="btnAuth" href="usuario={{ $user->id }}" class="btn btn-success"><span title="Revisar" class="glyphicon glyphicon-eye-open"></span></a>
								@if ($user->auth == false)
									<button id="btnAuth" class="btn btn-warning"><span title="Aprobar" class="glyphicon glyphicon-ok"></span></button>
									<button id="btnDown" class="btn btn-danger"><span title="No Aprobar" class="glyphicon glyphicon-remove"></span></button>
								@endif
							</td>
						</tr>
						@endforeach
					</table>
					{!! $users->render() !!}
					<input type="text" id="idUsuario" name="idUsuario" class="form-control" readonly style="visibility:hidden">
					<input type="text" id="option" name="option" class="form-control" readonly style="visibility:hidden">
				</div>
			</div>
		</form>
	</div>
</div>
@endsection

@section('scripts')
	<script src="{{asset('js/auth.js')}}"></script>
@endsection