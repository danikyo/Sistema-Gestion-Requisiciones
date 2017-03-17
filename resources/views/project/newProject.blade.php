@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Nuevo Proyecto</div>

				<div class="panel-body">

                    @if (session('notification'))
                        <div class="alert alert-success">
                            {{ session('notification') }}
                        </div>
                    @endif

                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                          @if(Session::has('alert-' . $msg))

                          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                          @endif
                        @endforeach
                    </div> <!-- end .flash-message -->

                    <form class="form-horizontal" role="form" method="POST" action="">
                    	{{ csrf_field() }}

                    	<div class="form-group">
                    		<label for="date1" class="col-md-4 control-label">Fecha Inicio</label>

                    		<div class="col-sm-3">
                    			<input id="date1" type="date" class="form-control" name="date1" value="{{ old('date1') }}" required autofocus>
                    		</div>
                    	</div>

                    	<div class="form-group">
                    		<label for="date2" class="col-md-4 control-label">Fecha Final</label>

                    		<div class="col-sm-3">
                    			<input id="date2" type="date" class="form-control" name="date2" value="{{ old('date2') }}" required autofocus>
                    		</div>
                    	</div>

                    	<div class="form-group">
                    		<label for="idca" class="col-md-4 control-label">IDCA</label>

                    		<div class="col-md-3">
                    			<input id="idca" type="text" class="form-control" name="idca" value="{{ old('idca') }}" required autofocus>
                    		</div>
                    	</div>

                    	<div class="form-group">
                    		<label for="clave" class="col-md-4 control-label">CLAVE</label>

                    		<div class="col-md-3">
                    			<input id="clave" type="text" class="form-control" name="clave" value="{{ old('clave') }}" required autofocus>
                    		</div>
                    	</div>

                    	<div class="form-group">
                    		<label for="nameca" class="col-md-4 control-label">Nombre del Cuerpo Académico</label>

                    		<div class="col-md-6">
                    			<input id="nameca" type="text" class="form-control" name="nameca" value="{{ old('nameca') }}" required autofocus>
                    		</div>
                    	</div>

                    	<div class="form-group">
                    		<label for="name" class="col-md-4 control-label">Nombre del Proyecto</label>

                    		<div class="col-md-6">
                    			<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                    		</div>
                    	</div>

                    	<div class="form-group">
                    		<label for="description" class="col-md-4 control-label">Descripción</label>

                    		<div class="col-md-6">
                    			<textarea id="description" class="form-control" name="description" value="{{ old('description') }}" required autofocus style="resize:none"></textarea>
                    		</div>
                    	</div>

                    	<div class="form-group">
                    		<label for="amount" class="col-md-4 control-label">Monto</label>

                    		<div class="col-md-3">
                    			<input id="amount" type="number" step=any class="form-control" name="amount" value="{{ old('amount') }}" required autofocus>
                    		</div>
                    	</div>

                        <div class="form-group">
                            <br><br>
                            <label for="btnNewActivity" class="col-md-3 control-label">Actividades</label>
                            <div id="btnNewActivity" class="btn btn-success">Nueva</div>
                            <br><br>
                            <div class="col-md-12 table-responsive">
                                <table  id="activityTable" class="table table-bordered table-hover">
                                <tr>
                                    <th>Actividad</th>
                                    <th>Opción</th>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group col-md-12">
                                            <label for="Adescription" class="control-label">Descripción</label>
                                            <input id="Adescription" type="text" class="form-control" name="Adescription[]" value="{{ old('Adescription') }}" required>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <table id="resourcesTable" class="table table-bordered table-hover">
                                                <tr>
                                                    <th>Tipo de recurso</th>
                                                    <th>Monto</th>
                                                    <th>Opción</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input id="rType" type="text" class="form-control" name="rType[]" value="{{ old('rType') }}" required>
                                                    </td>
                                                    <td>
                                                        <input id="rAmount" type="number" class="form-control" step=any name="rAmount[]" value="{{ old('rAmount') }}" required>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn btn-sm btn-danger">Quitar</div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <table id="resourcesTable" class="table table-bordered table-hover">
                                                <tr>
                                                    <th>ID de empleado</th>
                                                    <th>Nombre del empleado</th>
                                                    <th>Opción</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input id="eType" type="text" class="form-control" name="eType[]" value="{{ old('eType') }}" required>
                                                    </td>
                                                    <td>
                                                        <input id="eId" type="text" class="form-control" name="eId[]" value="{{ old('eId') }}" required disabled>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn btn-sm btn-primary">Check</div>
                                                        <div class="btn btn-sm btn-danger">Quitar</div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>                         
                                    </td>

                                    <td class="text-center">
                                        <div class="btn btn-sm btn-danger">Quitar</div>
                                    </td>
                                </tr>
                            </table>
                            </div>
                            
                        </div>
                        
                    	<div class="form-group">
                    		<div class="col-md-3 col-md-offset-5">
                    			<button class="btn btn-primary">Registrar Proyecto</button>
                    		</div>
                    	</div>
                    </form>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection