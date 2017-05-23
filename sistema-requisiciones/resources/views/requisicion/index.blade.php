@extends('layouts.app')

<head><link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"></head>

@section('content')
<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">

			@if (session('notification'))
                <div class="alert alert-success">
                    {{ session('notification') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

			<form class="form-horizontal" role="form" method="POST" action="" enctype="multipart/form-data">
				{{ csrf_field() }}

				<div class="form-group">
					<label for="fecha" class="control-label col-md-1">Fecha</label>
					<div class="col-md-10">
						<input id="fecha" name="fecha" type="date" class="form-control" value="<?php echo date("Y-m-d");?>" required autofocus readonly>
					</div>
				</div>

				<div class="form-group">
					<label for="area" class="control-label col-md-1">Area</label>
					<div class="col-md-10">
						@if (auth()->user()->role == 1)
							<input id="area" name="area" type="text" class="form-control" value="Secretaría Académica" required autofocus readonly>
						@elseif (auth()->user()->role == 2)
							<input id="area" name="area" type="text" class="form-control" value="Planeación" required autofocus readonly>
						@elseif (auth()->user()->role == 3)
							<input id="area" name="area" type="text" class="form-control" value="Finanzas" required autofocus readonly>
						@elseif (auth()->user()->role == 4)
							<input id="area" name="area" type="text" class="form-control" value="Compras" required autofocus readonly>
						@elseif (auth()->user()->role == 5)
							<input id="area" name="area" type="text" class="form-control" value="Docente" required autofocus readonly>
						@endif
					</div>
				</div>

				<div class="form-group">
					<label for="proyecto" class="control-label sr-only">Proyecto</label>
					<div class="col-md-9">
						<select id="proyecto" name="proyecto" class="form-control" required>
							<option value="">Proyectos</option>
							@foreach ($activityuser as $act)
								<option value="{{$projects->find($act->project_id)->id}}">{{$projects->find($act->project_id)->name}}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="actividad" class="control-label sr-only">Actividad</label>
					<div class="col-md-9">
						<select id="actividad" name="actividad" class="form-control" required>
							
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="recurso" class="control-label sr-only">Recurso</label>
					<div class="col-md-9">
						<select id="recurso" name="recurso" class="form-control" required>
							
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="producto" class="control-label sr-only">Producto</label>
					<div class="col-md-9">
						<select id="producto" name="producto" class="form-control" required>
							
						</select>
					</div>
					<div class="col-md-1">
						<input id="precio" name="precio" type="text" class="form-control" autofocus readonly>
					</div>
					<div class="col-md-1">
						<div id="btnAddProducto" class="btn btn-primary btn-sm">Agregar Producto</div>
					</div>
				</div>

				<div class="col-md-12 table-responsive">
	                <table  id="tableProductos" class="table table-bordered table-hover">
	                    <tr>
	                        <th>ID</th>
	                        <th>Nombre</th>
	                        <th>Precio</th>
	                        <th>Opción</th>
	                    </tr>
	                </table>
	            </div>

	            <div class="form-group">
					<label for="observaciones" class="control-label sr-only">Observaciones</label>
					<div class="col-md-9">
                        <textarea id="observaciones" name="observaciones" class="form-control" value="{{ old('observaciones') }}" required autofocus style="resize:none" placeholder="Observaciones"></textarea>
                    </div>
				</div>

	            <div class="form-group">
                    <div class="col-md-3 col-md-offset-5">
                        <button id="btnNewRequisicion" class="btn btn-primary">Enviar Solicitud</button>
                    </div>
                </div>
                <input for="" id="idUser" value="{{auth()->user()->id}}" style="visibility: hidden">
			</form>
		</div>
	</div>
</div>
@endsection

@section('scripts')
	<script src="{{asset('js/SolicitarR.js')}}"></script>
@endsection