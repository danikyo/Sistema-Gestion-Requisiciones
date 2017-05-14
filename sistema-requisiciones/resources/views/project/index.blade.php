@extends('layouts.app')

<head>
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Registrar Nuevo Proyecto</div>

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

                    <form class="form-horizontal" role="form" method="POST" action="">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="date1" class="col-md-2 control-label">Inicia en</label>

                            <div class="col-sm-3">
                                <input id="date1" type="date" class="form-control" name="date1" value="{{ old('date1') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date2" class="col-md-2 control-label">Se vence en</label>

                            <div class="col-sm-3">
                                <input id="date2" type="date" class="form-control" name="date2" value="{{ old('date2') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="idca" class="col-md-4 control-label sr-only">CLAVE</label>

                            <div class="col-md-10">
                                <input id="id" type="number" class="form-control" name="idca" value="{{ old('id') }}" placeholder="Colócale un ID al proyecto (CLAVE)" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="clave" class="col-md-4 control-label sr-only">IDCA</label>

                            <div class="col-md-10">
                                <input id="clave" type="text" class="form-control" name="clave" value="{{ old('idca') }}" placeholder="Escribe el ID del cuerpo académico" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nameca" class="col-md-4 control-label sr-only">Nombre del Cuerpo Académico</label>

                            <div class="col-md-10">
                                <input id="nameca" type="text" class="form-control" name="nameca" value="{{ old('nameca') }}" placeholder="¿Cuál es el nombre del cuerpo académico?" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label sr-only">Nombre del Proyecto</label>

                            <div class="col-md-10">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Escribe un nombre para el proyecto" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="currentAmount" class="col-md-4 control-label sr-only">Saldo Actual</label>

                            <div class="col-md-10">
                                <input id="currentAmount" type="number" step=any class="form-control" name="currentAmount" value="{{ old('currentAmount') }}" placeholder="¿Cuál es el monto inicial del proyecto?" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-md-4 control-label sr-only">Descripción</label>

                            <div class="col-md-10">
                                <textarea id="description" class="form-control" name="description" value="{{ old('description') }}" placeholder="Anota la descripción del proyecto aquí" required autofocus style="resize:none"></textarea>
                            </div>
                        </div>
                        <hr>
                        <!--Actividades-->
                        <div class="form-group"> 
                            <br><br>
                            <div class="col-md-12 table-responsive">
                                <div class="form-group col-md-12">
                                    <div class="col-md-2">
                                        <label for="inputActivity" class="sr-only">Escribe el ID de la actividad</label>
                                        <input id="inputActivity" type="number" step=any class="form-control" autofocus placeholder="ID de actividad">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="inputActivityName" class="sr-only">Escribe la descripción de la actividad</label>
                                        <input id="inputActivityName" type="text" class="form-control" autofocus placeholder="Descripción de la actividad">
                                    </div>
                                
                                    <div id="btnNewActivity" class="btn btn-default btn-sm">Agregar Actividad</div>
                                    <div id="btnDelActivity" class="btn btn-default btn-sm">Remover</div>
                                </div>
                                
                                <table  id="activityTable" class="table table-bordered table-hover">
                                    <tr>
                                        <th width=100>ID</th>
                                        <th>Actividad</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!--End Actividades-->
                        <hr>
                        <!--Recursos-->
                        <div class="form-group">
                            <br><br>
                            <div class="col-md-12 table-responsive">
                                <div class="form-group col-md-12">
                                    <div class="col-md-2">
                                        <label for="inputResourceId" class="sr-only">ID del Recurso</label>
                                        <input id="inputResourceId" type="number" step=any class="form-control" autofocus placeholder="ID del recurso">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="inputResourceType" class="sr-only">Tipo de Recurso</label>
                                        <input id="inputResourceType" class="form-control" autofocus placeholder="Tipo de recurso">
                                    </div>
                                    <div class="col-md-3">
                                       <select id="selectActivity" class="selectpicker" title="Actividades">
                                       </select>
                                    </div>      

                                        <div id="btnNewResource" class="btn btn-default btn-sm">Agregar Recurso</div>
                                        <div id="btnDelResource" class="btn btn-default btn-sm">Remover</div>
                                </div>
                                <table  id="resourceTable" class="table table-bordered table-hover">
                                    <tr>
                                        <th>ID Recurso</th>
                                        <th>Tipo de Recurso</th>
                                        <th>ID Actividad</th>
                                        <th>Actividad</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!--End Recursos-->
                        <hr>
                        <!--Productos-->
                        <div class="form-group">
                            <div class="col-md-12 table-responsive">
                                <br><br>
                                <div class="form-group col-md-12">
                                    <div class="col-md-3">
                                       <select id="selectResource" class="selectpicker" title="Recursos">
                                       </select>
                                    </div>
                                        <div id="btnNewProduct" class="btn btn-default btn-sm">Agregar Producto</div>
                                        <div id="btnDelProduct" class="btn btn-default btn-sm">Remover</div>
                                </div>

                                <table  id="productTable" class="table table-bordered table-hover">
                                    <tr>
                                        <th>Nombre de Producto</th>
                                        <th>Precio</th>
                                        <th>ID Recurso</th>
                                        <th>Recurso</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!--End Productos-->
                        <hr>
                        <!--Usuarios-->
                        <div class="form-group">
                            <br><br>
                            <div class="form-group col-md-12">
                                <div class="col-md-3">
                                   <select id="selectActivity2" class="selectpicker" title="Actividades">
                                   </select>
                                </div>                    
                                <div class="col-md-3">
                                    <select name="user" id="user" class="selectpicker" title="Usuarios">
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="btnNewUser" class="btn btn-default btn-sm">Agregar Usuario</div> 
                            </div>
                            <div class="col-md-12 table-responsive">
                                <table  id="userTable" class="table table-bordered table-hover">
                                    <tr>
                                        <th>ID de Usuario</th>
                                        <th>Nombre</th>
                                        <th>ID Actividad</th>
                                        <th>Actividad</th>
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

@section ('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
@endsection