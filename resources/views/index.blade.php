<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sistema Requisiciones</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="shortcut icon" href="images/icono.ico">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="css/animate.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <!-- Styles -->
        <style>
            html, body {
                background-image: url(images/slide.jpg);
                background-repeat: no-repeat;
                background-size: cover;
                color: #F2F3F3;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #FFFFFF;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="flex-center position-ref full-height">
                @if (Route::has('login'))
                    <div class="top-right links">
                        @if (Auth::check())
                            <a href="{{ url('home') }}">Principal</a>
                        @else
                            <a href="{{ url('/login') }}">Login</a>
                            <a href="{{ url('/register') }}">Registrarse</a>
                        @endif
                    </div>
                @endif

                <div class="content row">
                    <div class="title m-b-md hidden-xs">
                        <p class="animated fadeInDown"><strong>SISTEMA GESTIÓN <br> DE REQUISICIONES</strong></p>
                    </div>
                    <div class="title m-b-md hidden-lg hidden-md hidden-sm">
                        <h3 class="animated fadeInDown"><strong>SISTEMA GESTIÓN <br> DE REQUISICIONES</strong></h3>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>