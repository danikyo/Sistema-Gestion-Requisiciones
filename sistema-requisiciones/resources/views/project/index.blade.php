@extends('layouts.app')

<head><link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"></head>

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

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

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

                        <!--Actividades-->
                        <div class="form-group"> 
                            <br><br>
                            <div class="col-md-12 table-responsive">
                                <div id="btnNewActivity" class="btn btn-success btn-sm" title="Agregar"><span class="glyphicon glyphicon-plus-sign"></span></div>
                                <div id="btnDelActivity" class="btn btn-danger btn-sm" title="Eliminar"><span class="glyphicon glyphicon-minus-sign"></span></div>
                                <label class="label-control"> Actividades</label>
                                <table  id="activityTable" class="table table-bordered table-hover">
                                    <tr>
                                        <th width=100>ID</th>
                                        <th>Actividad</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            @if (isset($activities))
                                               <label for="" id="idActivity" value=""> {{ $activities->id+1}} </label> 
                                            @else
                                                <label for="" id="idActivity" value=""> 1 </label>
                                            @endif
                                        </td>
                                        <td>
                                            <input id="activityDescription" type="text" name="activityDescription[]" value="{{ old('activityDescription[]') }}" required autofocus class="form-control">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!--End Actividades-->

                        <!--Recursos-->
                        <div class="form-group">
                            <br><br>
                            <div class="col-md-12 table-responsive">
                                
                                <div class="form-group col-md-10">
                                    <label for="select_idActivity" class="control-label col-md-2">ID Actividad</label>
                                    <div class="col-md-2">
                                       <select name="" id="select_idActivity" class="form-control">
                                           @if (isset($activities))
                                                <option value=""> {{$activities->id+1}} </option>
                                           @else
                                                <option value=""> 1 </option>
                                           @endif 
                                       </select>
                                    </div>

                                    <div class="col-md-1">
                                        <div id="btnNewResource" class="btn btn-primary" title="Agregar"><span class="glyphicon glyphicon-plus-sign"></span></div>
                                    </div>
                                    <div class="col-md-1">
                                        <div id="btnDelResource" class="btn btn-danger" title="Quitar"><span class="glyphicon glyphicon-minus-sign"></span></div>
                                    </div>
                                </div>
                                
                                <table  id="resourceTable" class="table table-bordered table-hover">
                                    <tr>
                                        <th>ID Recurso</th>
                                        <th>ID Actividad</th>
                                        <th>Tipo de Recurso</th>
                                        <th>Monto</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            @if (isset($resources))
                                                <label for="" id="idResource" value=""> {{ $resources->id+1}} </label> 
                                            @else
                                                <label for="" id="idResource" value=""> 1 </label> 
                                            @endif
                                        </td>
                                        <td>
                                           @if (isset($activities))
                                               <input type="text" id="resource-IDactivity" name="resource-IDactivity[]" value="{{$activities->id+1}}" required autofocus readonly class="form-control"> 
                                           @else
                                               <input type="text" id="resource-IDactivity" name="resource-IDactivity[]" value="1" required autofocus readonly class="form-control">  
                                           @endif 
                                        </td>
                                        <td>
                                            <input id="resourceType" type="text" name="resourceType[]" value="{{ old('resourceType[]') }}" required autofocus class="form-control">
                                        </td>
                                        <td>
                                            <input id="resourceAmount" type="text" name="resourceAmount[]" value="{{ old('resourceAmount[]') }}" required autofocus class="form-control">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!--End Recursos-->

                        <!--Productos-->
                        <div class="form-group">
                            <br><br>
                            <div class="col-md-12 table-responsive">

                                <div class="form-group col-md-10">
                                    <label for="select_idResources" class="control-label col-md-2">ID Recurso</label>
                                    <div class="col-md-2">
                                       <select name="" id="select_idResources" class="form-control">
                                           @if (isset($resources))
                                                <option value=""> {{$resources->id+1}} </option>
                                           @else
                                                <option value=""> 1 </option>
                                           @endif 
                                       </select>
                                    </div>

                                    <div class="col-md-1">
                                        <div id="btnNewProduct" class="btn btn-primary" title="Agregar"><span class="glyphicon glyphicon-plus-sign"></span></div>
                                    </div>
                                    <div class="col-md-1">
                                        <div id="btnDelProduct" class="btn btn-danger" title="Quitar"><span class="glyphicon glyphicon-minus-sign"></span></div>
                                    </div>
                                </div>

                                <table  id="productTable" class="table table-bordered table-hover">
                                    <tr>
                                        <th>ID Recurso</th>
                                        <th width=700>Nombre de Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            @if (isset($resources))
                                               <input id="product-IDresource" type="text" name="product-IDresource[]" value="{{ $resources->id+1 }}" readonly required autofocus class="form-control"> 
                                            @else
                                                <input id="product-IDresource" type="text" name="product-IDresource[]" value="1" readonly required autofocus class="form-control"> 
                                            @endif
                                            
                                        </td>
                                        <td>
                                            <input id="productName" type="text" name="productName[]" value="{{ old('productName[]') }}" required autofocus class="form-control">
                                        </td>
                                        <td>
                                            <input id="productQuantity" type="text" name="productQuantity[]" value="{{ old('productQuantity[]') }}" required autofocus class="form-control">
                                        </td>
                                        <td>
                                            <input id="productPrice" type="text" name="productPrice[]" value="{{ old('productPrice[]') }}" required autofocus class="form-control">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!--End Productos-->

                        <!--Usuarios-->
                        <div class="form-group">
                            <br><br>
                            <div class="form-group col-md-10">
                                <label for="user-id" class="control-label col-md-2">ID usuario</label>
                                <div class="col-md-3">
                                   <input id="user-id" type="text" name="user-id" value="{{ old('user-id') }}" autofocus class="form-control">
                                </div>

                                <div class="col-md-1">
                                    <div id="btnNewUser" class="btn btn-primary" title="Agregar"><span class="glyphicon glyphicon-plus-sign"></span></div>
                                </div>
                                
                            </div>
                            <div class="col-md-12 table-responsive">
                                <table  id="userTable" class="table table-bordered table-hover">
                                    <tr>
                                        <th width="100">ID Actividad</th>
                                        <th width="100">ID de Usuario</th>
                                        <th>Nombre</th>
                                        <th>Opción</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                    	<div class="form-group">
                    		<div class="col-md-3 col-md-offset-5">
                    			<button id="btnNewProject" class="btn btn-primary">Registrar Proyecto</button>
                    		</div>
                    	</div>
                        <!--End Usuarios-->

                    </form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection