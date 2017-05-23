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
						<th>CLAVE</th>
						<th>Nombre de Proyecto</th>
						<th>Monto Aprobado</th>
						<th>Fecha Vigencia</th>
						<th>Observación</th>
						<th>Opción</th>
					</tr>
					@foreach($activityuser as $activity)
						@foreach($projects as $project)
							@if($project->id == $activity->project_id)
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
									<td>
										<label class="label-control">Proyecto en curso</label>
									</td>
									<td class="text-center">
										<a href="proyecto={{ $project->id }}" class="btn btn-success"><span title="Editar" class="glyphicon glyphicon-pencil"></span></div>
									</td>
								</tr>
							@endif
						@endforeach
					@endforeach
				</table>
			</div>
				
		</div>
	</div>
</div>
@endsection