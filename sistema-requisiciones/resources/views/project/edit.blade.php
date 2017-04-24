@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
					<img src="/images/headerProject.png" class="img-responsive center-block" alt="Imagen responsive">
					<br><br>
				</div>

				<div class="row text-center">
					<strong style="font-size: 3vh">Dictamen Aprobado</strong>
				</div>

				<div class="row">
					<div class="table-responsive col-md-6 col-md-offset-3">
						<table class="table table-condensed">
							<tr>
								<th class="text-center" width="200">Institución</th>
								<td >Universidad Politénica de la Zona Metropolitana de Guadalajara</td>
							</tr>
							<tr>
								<th class="text-center" width="200">Nombre del Cuerpo Académico</th>
								<td>{{$project->caname}}</td>
							</tr>
							<tr>
								<th class="text-center" width="200">IDCA</th>
								<td> {{$project->id}} </td>
							</tr>
							<tr>
								<th class="text-center" width="200">CLAVE</th>
								<td> {{$project->clave}} </td>
							</tr>
							<tr>
								<th class="text-center" width="200">Nombre del Proyecto</th>
								<td> {{$project->name}} </td>
							</tr>
							<tr>
								<th class="text-center" width="200">Vigencia del Proyecto</th>
								<td> {{$project->startDate}} - {{$project->endDate}} </td>
							</tr>
						</table>
					</div>
				</div>

				<div class="row">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="text-center"> {{$project->description}} </h3>
						</div>
					</div>
				</div>

				@foreach($activities as $activity)
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading text-center"> <h4 style="font-size: 3vh;"> Actividad {{ $activity->id}} </h4> </div>

							<div class="panel-body">
								<div class="row container">
									<label for="description" style="font-size: 3vh;"><strong>Descripción</strong></label>
									<p id="description" style="font-size: 3vh;">{{ $activity->description }}</p>
									<label for="" style="font-size: 3vh;"><strong>Integrantes</strong></label>
								</div>
								<div class="table-responsive col-md-12">
									<table class="table table-bordered">
										<tr>
											<th>Nombre</th>
										</tr>
										@foreach($activity->users()->get() as $u)
										<tr>
											<td>{{ $u->name }}</td>
										</tr>
										@endforeach
									</table>
								</div>
								<div class="row container">
									<label for="" style="font-size: 3vh;"><strong>Recursos</strong></label>
								</div>
								<div class="table-responsive col-md-12">
									<table class="table table-bordered">
										<tr>
											<th>ID</th>
											<th>Tipo de Recurso</th>
											<th>Descripción</th>
											<th>Monto Aprobado</th>
										</tr>
										@foreach($activity->resources()->get() as $r)
										<tr>
											<td>
												{{ $r->id }}
											</td>
											<td>
												{{ $r->type }}
											</td>
											<td>
												<table class="table table-bordered">
													@foreach($r->products()->get() as $p)
													<tr>
														<td>{{ $p->name }}</td>
													</tr>
													@endforeach
												</table>
											</td>
											<td>
												<table class="table table-bordered">
													@foreach($r->products()->get() as $p)
													<tr>
														<td>${{ $p->price }}</td>
													</tr>
													@endforeach
												</table>
											</td>
										</tr>
										@endforeach
									</table>
								</div>
							</div>
						</div>
						
					</div>
				</div>
				@endforeach

				<div class="row">
					<div class="table-responsive col-md-6 col-md-offset-3">
						<table class="table table-condensed">
							<tr>
								<th class="text-center" width="200">Monto Total Aprobado al Cuerpo Académico</th>
								<td class="text-center" style="font-size: 3vh"> ${{$project->Amount}} </td>
							</tr>
							@if ($project->currentAmount != 0)
								<tr>
									<th class="text-center" width="200">Monto Total Disponible</th>
									<td class="text-center" style="font-size: 3vh"> ${{$project->currentAmount}} </td>
								</tr>
							@else
								<tr class="text-center">
									<th class="text-center" width="200">Status</th>
									<td class="text-center" width="200">Proyecto Ejercido</td>
								</tr>
							@endif
						</table>
					</div>
				</div>

				<div class="row">
					<div class="row">			
						<img src="/images/footerProject.png" class="img-responsive center-block" alt="Imagen responsive">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
