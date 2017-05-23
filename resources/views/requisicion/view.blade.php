@extends('layouts.app')

<head><link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"></head>

@section('content')
<div class="container">

	<div class="panel panel-default">
		<div class="panel-body">

			<div class="row">
				<img src="/images/logo.png" class="img-responsive center-block" alt="Imagen responsive">
			</div>

			<div class="row-container text-center">
				<h2><strong>REQUISICIÓN DE COMPRA</strong></h2>
				<br><br>
			</div>

			@if (session('notification'))
                <div class="alert alert-success">
                    {{ session('notification') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

			<div class="row-container">
				<label for="no" class="label-control col-md-2"><strong>No. de Requisición</strong></label>
				<p id="no" class="col-md-10">{{ $requisicion->id }}</p>
			</div>
			<div class="row-container">
				<label for="fecha" class="label-control col-md-2"><strong>Fecha</strong></label>
				<p id="fecha" class="col-md-10"> {{$requisicion->date}} </p>
			</div>
			<div class="row-container">
				<label for="solicitante" class="label-control col-md-2"><strong>Solicitante</strong></label>
				<p id="solicitante" class="col-md-10"> {{$user->name}} </p>
			</div>
			<div class="row-container">
				<label for="area" class="label-control col-md-2"><strong>Área</strong></label>
				<p id="area" class="col-md-10"> {{$requisicion->area}} </p>
			</div>
			<div class="row-container">
				<label for="area" class="label-control col-md-2"><strong>Proyecto</strong></label>
				<p id="area" class="col-md-10"> {{$project->name}} </p>
			</div>
			<div class="row-container">
				<label for="area" class="label-control col-md-2"><strong>Actividad</strong></label>
				<p id="area" class="col-md-10"> {{$activity->description}} </p>
			</div>
			<div class="row-container">
				<label for="area" class="label-control col-md-2"><strong>Recurso</strong></label>
				<p id="area" class="col-md-10"> {{$resource->type}} </p>
			</div>
			<div class="row-container">
				<label for="area" class="label-control col-md-2"><strong>Autorizado</strong></label>
				<p id="area" class="col-md-10"> {{$autorizado}} </p>
			</div>
			<div class="row-container">
				<label for="area" class="label-control col-md-2"><strong>Status</strong></label>
				<p id="area" class="col-md-10"> {{$status}} </p>
			</div>

			@if(auth()->user()-> is_admin)
			<div class="row-container">
				<h4 class="label-control col-md-12"><strong>Autorizado por</strong></h4>
			</div>

			<div class="row-container">
				<label for="secretario" class="label-control col-md-2"><strong>Secretario Académico</strong></label>
				<p id="secretario" class="col-md-10">
					@if ($requisicion->secretario == 0)
						No
					@else
						Sí
					@endif
				</p>
			</div>

			<div class="row-container">
				<label for="planeacion" class="label-control col-md-2"><strong>Planeación</strong></label>
				<p id="planeacion" class="col-md-10">
					@if ($requisicion->planeacion == 0)
						No
					@else
						Sí
					@endif
				</p>
			</div>

			<div class="row-container">
				<label for="finanzas" class="label-control col-md-2"><strong>Finanzas</strong></label>
				<p id="finanzas" class="col-md-10">
					@if ($requisicion->finanzas == 0)
						No
					@else
						Sí
					@endif
				</p>
			</div>
			@endif

			<div class="table-responsive col-md-12">
				<br><br>
				<table class="table table-bordered">
					<tr>
						<th class="text-center info">ID</th>
						<th class="text-center info">Nombre de Producto</th>
						<th class="text-center info">Precio Unitario</th>
					</tr>
					@foreach($requisicion->products()->get() as $product)
						<tr>
							<td class="text-center"> {{$product->id}} </td>
							<td class="text-center"> {{ $product->name }} </td>
							<td class="text-center"> $ {{ $product->price }} </td>
							<label for="" class="sr-only">{{ $total += $product->price }}</label>
						</tr>
					@endforeach
					<tr>
						<td class="text-center info"><strong>IVA% <br>16</td></strong>
						<td class="text-center info"><strong>IVA &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp NETO <br>${{$iva = $total*.16}} &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ${{$neto = $total-$iva}}</strong></td>
						<td class="text-center info"><strong>TOTAL <br>$ {{$total}}</td></strong>
					</tr>
				</table>
			</div>

			<div class="row">
				<div class="col-md-12">
					<br><br>
					<label for="observations" style="font-size: 3vh;"><strong>Observaciones</strong></label>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-body">
					<p id="observations" style="font-size: 3vh;">{{ $requisicion->observations }}</p>
				</div>
			</div>

			<!--<div class="row">
				<br><br>
				<img src="/images/firmas.png" class="img-responsive center-block" alt="Imagen responsive">
			</div>-->

			@if (auth()->user()->is_compras)
				@if ($requisicion->status == 2)
					<h4 class="text-center"><strong>Requisición Ejercida</strong></h4>
				@elseif ($requisicion->status == 1)
					<form action="" role="form" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
						<div class="form-group">
				        	<label for="factura">Subir Factura en PDF</label>
				        	<input name="factura" type="file">
		        		</div>
				        <div class="form-group">
							<div class="col-md-2 col-md-offset-4">
								<select id="autorizar" name="autorizar" class="form-control">
									<option value="1">Ejercer</option>
									<option value="2">Cancelar</option>
								</select>
							</div>

				            <div class="col-md-3">
				                <button id="btnAuth" class="btn btn-primary">Aceptar</button>
				            </div>
			            </div>
			        </form>
		        @endif
			@endif

	        @if  (auth()->user()->role == 1)
	        	@if ($requisicion->secretario == 0)
	        	<form action="" role="form" method="POST">
				{{ csrf_field() }}
					<div class="form-group">
						<div class="col-md-2 col-md-offset-4">
							<select id="autorizar" name="autorizar" class="form-control">
								<option value="1">Autorizar</option>
								<option value="2">Cancelar</option>
							</select>
						</div>
			        
			            <div class="col-md-3">
			                <button id="btnAuth" class="btn btn-primary">Aceptar</button>
			            </div>
		            </div>
		        </form>
	        	@endif
	        @endif

	        @if  (auth()->user()->role == 2)
	        	@if ($requisicion->planeacion == 0)
	        	<form action="" role="form" method="POST">
				{{ csrf_field() }}
			        <div class="form-group">
						<div class="col-md-2 col-md-offset-4">
							<select id="autorizar" name="autorizar" class="form-control">
								<option value="1">Autorizar</option>
								<option value="2">Cancelar</option>
							</select>
						</div>
			        
			            <div class="col-md-3">
			                <button id="btnAuth" class="btn btn-primary">Aceptar</button>
			            </div>
		            </div>
		        </form>
	        	@endif
	        @endif

	        @if  (auth()->user()->role == 3)
	        	@if ($requisicion->finanzas == 0)
	        	<form action="" role="form" method="POST">
				{{ csrf_field() }}
				<div class="form-group">
						<div class="col-md-2 col-md-offset-4">
							<select id="autorizar" name="autorizar" class="form-control">
								<option value="1">Autorizar</option>
								<option value="2">Cancelar</option>
							</select>
						</div>
			        
			            <div class="col-md-3">
			                <button id="btnAuth" class="btn btn-primary">Aceptar</button>
			            </div>
		            </div>
		        </form>
	        	@endif
	        @endif

	        @if ($requisicion->status == 2)
	        	<form action="" role="form" method="POST">
				{{ csrf_field() }}
				<div class="form-group">
						<div class="col-md-2 col-md-offset-4">
							<input name="filename" type="text" value="{{$requisicion->factura}}" readonly style="visibility:hidden">
						</div>
						<div class="col-md-2 col-md-offset-4">
							<input name="status" type="text" value="{{$requisicion->status}}" readonly style="visibility:hidden">
						</div>
			        
			            <div class="col-md-3 col-md-offset-5">
			                <button id="btnAuth" class="btn btn-default">Descargar Factura</button>
			            </div>
		            </div>
		        </form>
	        	<!--<a href="/download" class="btn btn-large pull-right"><i class="icon-download-alt"> </i> Descargar Reporte </a>-->
	        @endif
		</div>
	</div>
</div>
@endsection