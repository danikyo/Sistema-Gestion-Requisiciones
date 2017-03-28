@extends('layouts.app')

<head><link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"></head>

@section('content')
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			Proyectos 
		</div>

		<form class="navbar-form navbar-left pull-right" role="search" action="consultarProyecto" method="GET">
			<div class="form-group">
				<input name="name" type="text" class="form-control" placeholder="nombre o código...">
			</div>
			<button class="btn btn-default" type="submit">Buscar</button>
		</form>

		<div class="panel-body">
			<div class="col-md-12">
				<table id="activityTable" class="table .table-striped">
					<tr>
						<th>IDCA</th>
						<th>Nombre de Proyecto</th>
						<th>Monto</th>
						<th>Fecha Vigencia</th>
						<th>Opción</th>
					</tr>
					@foreach($projects as $project)
					<tr>
						<td class="text-center">
							{{ $project->id }}
						</td>
						<td>
							{{ $project->name }}
						</td>
						<td>
							{{ $project->currentAmount }}
						</td>
						<td>
							{{ $project->startDate }}
						</td>
						<td class="text-center">
							<a href="proyecto={{ $project->id }}" class="btn btn-success"><span title="Editar" class="glyphicon glyphicon-pencil"></span></div>
						</td>
					</tr>
					@endforeach
				</table>
				{!! $projects->render() !!}
			</div>
				
		</div>
	</div>
</div>
@endsection