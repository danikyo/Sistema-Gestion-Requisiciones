@extends('layouts.app')

<head><link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"></head>

@section('content')
<div class="container">
    <div class="row">
        @if (auth()->user()->auth == false)
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-warning">
                <div class="panel-heading">Advertencia</div>

                <div class="panel-body  text-center">
                    Tu cuenta está en proceso de verificación, una vez sea aprobada, tendrás acceso a las actividades correspondientes 
                </div>
            </div>
        </div>
        <br><br><br><br><br>
        @else
            <div class="container">
                <div class="col-md-12">
                    <div id="carousel_home" class="carousel slide" data-ride="carousel">
                        <!-- Indicadores -->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel_home" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel_home" data-slide-to="1"></li>
                            <li data-target="#carousel_home" data-slide-to="2"></li>
                        </ol>

                        <!-- Contenedor de los slide -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img src="http://lorempixel.com/1200/400/technics/7" class="img-responsive" alt="">
                                <div class="carousel-caption">
                                    <h3><strong>Realiza requisiciones fácilmente</strong></h3>
                                    <p><strong>¡Manda tu solicitud Ahora!</strong></p>
                                </div>
                            </div>

                            <div class="item">
                                <img src="http://lorempixel.com/1200/400/city/8" class="img-responsive" alt="">
                                <div class="carousel-caption">
                                    <h3><strong>Puedes Modificar tu perfil</strong></h3>
                                    <p><strong>¡Cambia tus datos cuando quieras!</strong></p>
                                </div>
                            </div>

                            <div class="item">
                                <img src="http://lorempixel.com/1200/400/technics/6" class="img-responsive" alt="">
                                <div class="carousel-caption">
                                    <h3><strong>Revisa tus requisiciones</strong></h3>
                                    <p><strong>No olvides revisar el status de tu requisición</strong></p>
                                </div>
                            </div>
                        </div>

                        <!-- Controladores -->
                        <a href="#carousel_home" class="left carousel-control" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a href="#carousel_home" class="right carousel-control" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Siguiente</span>
                        </a>
                    </div>
                </div>
            </div>
        <br><br><br>
        @endif
    </div>
</div>
@endsection
