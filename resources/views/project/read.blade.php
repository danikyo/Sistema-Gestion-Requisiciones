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
				<div class="col-xs-12">
					<input name="name" type="text" class="form-control" placeholder="nombre o código...">
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
						<th>CLAVE</th>
						<th>Nombre de Proyecto</th>
						<th>Monto Aprobado</th>
						<th>Fecha Vigencia</th>
						<th>Opción</th>
					</tr>
					@foreach($projects as $project)
					<tr>
						<td>
							{{ $project->id }}
						</td>
						<td>
							{{ $project->name }}
						</td>
						<td>
							{{ $project->Amount }}
						</td>
						<td>
							{{ $project->endDate }}
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