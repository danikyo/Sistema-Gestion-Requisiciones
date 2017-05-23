@extends('layouts.app')

<head><link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"></head>

@section('content')
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			Requisiciones
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

		@if (auth()->user()-> is_compras)
		<div class="panel-body">
			<div class="col-sm-12 table-responsive">
				<table id="activityTable" class="table .table-striped">
					<tr>
						<th class="info">ID</th>
						<th class="info">Fecha</th>
						<th class="info">Area</th>
						<th class="info">Responsable</th>
						<th class="info">Opción</th>
					</tr>
					@foreach($requisicions->where('secretario', 1 && 'planeacion', 1 && 'finanzas', 1) as $requisicion)
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
									{{ $user->find($requisicion->user_id)->name }}
								</td>
								<td class="text-center">
									<div class="row">
										<a href="requisicion={{ $requisicion->id }}" class="btn btn-success"><span title="Editar" class="glyphicon glyphicon-pencil"></span></a>
									</div>
								</td>
							</tr>
					@endforeach
				</table>
				{!! $requisicions->render() !!}
			</div>
		</div>
		@else
		<div class="panel-body">
			<div class="col-sm-12 table-responsive">
				<table id="activityTable" class="table .table-striped">
					<tr>
						<th class="info">ID</th>
						<th class="info">Fecha</th>
						<th class="info">Area</th>
						<th class="info">Responsable</th>
						<th class="info">Observación</th>
						<th class="info">Opción</th>
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
									{{ $user->find($requisicion->user_id)->name }}
								</td>
								<td>
									@if ($requisicion->status != 0)
										@if ($requisicion->secretario == 1 && $requisicion->planeacion == 1 && $requisicion->finanzas == 1)
										<label for="" class="label-control">Autorizada por Todos</label>
										@else
											@if (auth()->user()->role == 1)
												@if ($requisicion->secretario == 0)
												<label for="" class="label-control">Pendiente por Autorizar</label>
												@elseif ($requisicion->secretario == 1)
												<label for="" class="label-control">Autorizada por ti</label>
												@endif
											@endif
											@if (auth()->user()->role == 2)
												@if ($requisicion->planeacion == 0)
												<label for="" class="label-control">Pendiente por Autorizar</label>
												@elseif ($requisicion->planeacion == 1)
												<label for="" class="label-control">Autorizada por ti</label>
												@endif
											@endif
											@if (auth()->user()->role == 3)
												@if ($requisicion->finanzas == 0)
												<label for="" class="label-control">Pendiente por Autorizar</label>
												@elseif ($requisicion->finanzas == 1)
												<label for="" class="label-control">Autorizada por ti</label>
												@endif
											@endif
										@endif
									@else
										<label for="" class="label-control" style="color:red">Cancelada</label>
									@endif
								</td>
								<td class="text-center">
									<div class="row">
										<a href="requisicion={{ $requisicion->id }}" class="btn btn-success"><span title="Editar" class="glyphicon glyphicon-pencil"></span></a>
									</div>
								</td>
							</tr>
					@endforeach
				</table>
				{!! $requisicions->render() !!}
			</div>
		</div>
		@endif
	</div>
</div>
@endsection