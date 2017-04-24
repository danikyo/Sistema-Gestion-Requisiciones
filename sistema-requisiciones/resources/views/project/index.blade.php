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
                                <input id="idca" type="number" class="form-control" name="idca" value="{{ old('idca') }}" required autofocus>
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
                        <hr>
                        <!--Actividades-->
                        <div class="form-group"> 
                            <br><br>
                            <div class="col-md-12 table-responsive">
                                <div class="form-group col-md-12">
                                    <div class="col-md-3">
                                        <label for="inputActivity" class="sr-only">Escribe el ID de la actividad</label>
                                        <input id="inputActivity" type="number" step=any class="form-control" autofocus placeholder="Escribe el ID de la actividad">
                                    </div>
                                    
                                    <div id="btnNewActivity" class="btn btn-success btn-sm">Agregar</div>
                                    <div id="btnDelActivity" class="btn btn-danger btn-sm">Eliminar</div>
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
                            <div class="form-group col-md-12">
                                <div class="col-md-3">
                                    <label for="inputResource" class="sr-only">Escribe el ID del Recurso</label>
                                    <input id="inputResource" type="number" step=any class="form-control" autofocus placeholder="Escribe el ID del recurso">
                                </div>

                            </div>
                            <div class="col-md-12 table-responsive">

                                <div class="form-group col-md-12">
                                    <label for="select_idActivity" class="label-control col-md-3">Elije actividad para recurso</label>

                                    <div class="col-md-2">
                                       <select id="selectActivity" class="form-control">
                                       </select>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div id="btnNewResource" class="btn btn-primary btn-sm">Agregar</div>
                                        <div id="btnDelResource" class="btn btn-danger btn-sm">Eliminar</div>
                                    </div> 
                                </div>
                                
                                <table  id="resourceTable" class="table table-bordered table-hover">
                                    <tr>
                                        <th>ID Recurso</th>
                                        <th>ID Actividad</th>
                                        <th>Tipo de Recurso</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!--End Recursos-->
                        <hr>
                        <!--Productos-->
                        <div class="form-group">
                            <br><br>
                            <div class="col-md-12 table-responsive">
                                <br><br>
                                <div class="form-group col-md-12">
                                    <label for="selectResource" class="label-control col-md-3">Elije recurso para producto</label>
                                    <div class="col-md-2">
                                       <select id="selectResource" class="form-control">
                                       </select>
                                    </div>

                                    <div id="btnNewProduct" class="btn btn-primary btn-sm">Agregar</div>
                                    <div id="btnDelProduct" class="btn btn-danger btn-sm">Eliminar</div>
                                </div>

                                <table  id="productTable" class="table table-bordered table-hover">
                                    <tr>
                                        <th>ID Recurso</th>
                                        <th width=700>Nombre de Producto</th>
                                        <th>Precio</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!--End Productos-->
                        <hr>
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