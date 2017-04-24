@extends('layouts.app')

<head><link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"></head>

@section('content')
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			Mis requisiciones
		</div>

		<form class="navbar-form navbar-left pull-right" role="search" action="" method="GET">
			<div class="form-group">
				<input name="name" type="text" class="form-control" placeholder="ID o Área...">
			</div>
			<button class="btn btn-default" type="submit">Buscar</button>
		</form>

		<div class="panel-body">
			<div class="col-md-12">
				<table id="activityTable" class="table .table-striped">
					<tr>
						<th>ID</th>
						<th>Fecha</th>
						<th>Area</th>
						<th>Observaciones</th>
						<th>Opción</th>
					</tr>
					@foreach($requisicions as $requisicion)
					<tr>
						<td>
							{{ $requisicion->id }}
						</td>
						<td>
							{{ $requisicion->date }}
						</td>
						<td>
							{{ $requisicion->area }}
						</td>
						<td>
							@if ($requisicion->status != 0)
								@if ($requisicion->secretario == 0 && $requisicion->planeacion == 0 && $requisicion->finanzas == 0)
									Pendiente por autorizar
								@else
									Autorizada
								@endif
							@else
								Cancelada
							@endif
						</td>
						<td>
							<a href="requisicion={{ $requisicion->id }}" class="btn btn-success"><span title="Editar" class="glyphicon glyphicon-pencil"></span></a>
						</td>
					</tr>
					@endforeach
				</table>
				{!! $requisicions->render() !!}
			</div>
				
		</div>
	</div>
</div>
@endsection