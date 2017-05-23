@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
					<img src="/images/headerProject.PNG" class="img-responsive center-block" alt="Imagen responsive">
					<br><br>
				</div>

				@if (session('notification'))
                    <div class="alert alert-success">
                        {{ session('notification') }}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

				<div class="row text-center">
					<strong style="font-size: 3vh">Dictamen Aprobado</strong>
				</div>

				<div class="row">
					<div class="table-responsive col-md-6 col-md-offset-3">
						<table class="table table-condensed">
							<tr>
								<th class="text-center" width="200">Institución</th>
								<td >Universidad Politécnica de la Zona Metropolitana de Guadalajara</td>
							</tr>
							<tr>
								<th class="text-center" width="200">CLAVE</th>
								<td> {{$project->id}} </td>
							</tr>
							<tr>
								<th class="text-center" width="200">IDCA</th>
								<td> {{$project->idca}} </td>
							</tr>
							<tr>
								<th class="text-center" width="200">Nombre del Cuerpo Académico</th>
								<td>{{$project->caname}}</td>
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

				<div class="row container">
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
														@if ($p->exercised == 1)
															<td class="warning">{{ $p->name }}</td>
														@elseif ($p->exercised == 2)
															<td class="danger">{{ $p->name }}</td>
														@else
															<td>{{ $p->name }}</td>
														@endif
													</tr>
													@endforeach
												</table>
											</td>
											<td>
												<table class="table table-bordered">
													@foreach($r->products()->get() as $p)
													<tr>
														@if ($p->exercised == 1)
															<td class="warning">${{ $p->price }}</td>
														@elseif ($p->exercised == 2)
															<td class="danger">${{ $p->price }}</td>
														@else
															<td>${{ $p->price }}</td>
														@endif
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
							<tr>
								<th class="text-center" width="200">Monto Total Disponible</th>
								<td class="text-center" style="font-size: 3vh"> ${{$project->currentAmount}} </td>
							</tr>
						</table>
							@if (auth()->user()->is_finanzas)
								@if ($flag == true)
								<form action="" role="form" method="POST">
									{{ csrf_field() }}
									<div class="form-gruop row">
										<label for="currentAmount" class="col-md-3 col-md-offset-2">Saldo Actual</label>
										<div class="col-md-4">
											<input name="currentAmount" type="number" step=any class="form-control" required>
										</div>
									</div>

									<div class="form-gruop row">
										<label for="date" class="col-md-4 col-md-offset-1">Fecha de Vigencia</label>
										<div class="col-md-4">
											<input name="date" type="date" class="form-control" value="{{$project->endDate}}" required>
										</div>
									</div>

									<div class="form-group">
										<br>
			                            <div class="col-md-3 col-md-offset-4">
			                                <button id="btnNewProject" class="btn btn-default">Guardar Cambios</button>
			                            </div>
			                        </div>
								</form>
								@else
								<div class="row">
										<h4 class="text-center"><strong>Proyecto Ejercido</strong></h4>
			                        </div>
								@endif
							@endif
						</table>
					</div>
				</div>

				<div class="row">
					<div class="row">			
						<img src="/images/footerProject.PNG" class="img-responsive center-block" alt="Imagen responsive">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
