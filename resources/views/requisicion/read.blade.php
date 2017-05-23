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
				<div class="col-xs-12">
					<input name="name" type="text" class="form-control" placeholder="ID o área...">
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-12">
					<button class="btn btn-default" type="submit">Buscar</button>
				</div>
			</div>
		</form>

		<div class="panel-body">
			<div class="col-sm-12 table-responsive">
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
								@if ($requisicion->secretario == 0 || $requisicion->planeacion == 0 || $requisicion->finanzas == 0)
									Pendiente por autorizar
								@elseif ($requisicion->status == 2)
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