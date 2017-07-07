<!DOCTYPE html>
<html lang="es">
<head>
    <title>Específicas - FARUSAC</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="/estudiante/images/icono.ico" type="image/x-icon">
    <link rel='stylesheet' href="{{ url('aspirante_public/css/googlefonts-css-latio.css') }}" type='text/css'>
    <link rel="stylesheet" href="{{ url('aspirante_public/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('aspirante_public/css/aspirante_style.css') }}">
    <link rel="stylesheet" href="{{ url('aspirante_public/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('aspirante_public/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ url('aspirante_public/css/iepe2017.css') }}">

    <link rel="icon" href="http://farusac.edu.gt/wp-content/uploads/2016/10/favicosquare.png" sizes="32x32" />
    <link rel="icon" href="http://farusac.edu.gt/wp-content/uploads/2016/10/favicosquare.png" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="http://farusac.edu.gt/wp-content/uploads/2016/10/favicosquare.png" />
    <meta name="msapplication-TileImage" content="http://farusac.edu.gt/wp-content/uploads/2016/10/favicosquare.png" />

    @section('styles')
    @show

</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top" >
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand brand-arqui" href="{{ url('aspirante') }}">
                        <img alt="Brand" src="{{ url('aspirante_public/img/logotipoFARUSAC_blanco.png') }}" />{{-- 210 y 70 --}}
                </a>


        </div>


        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse-1">
            <div class="navbar-primary">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="{{ url('aspirante') }}">Inicio</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Proceso de Ingreso <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a target="_blank" href="http://www.vocacional.usac.edu.gt/">1. Prueba de Orientación Vocacional</a></li>
                            <li><a target="_blank" href="http://nuevos.usac.edu.gt">2. Prueba de Conocimientos Básicos</a></li>
                            <li><a href="{{ action('RecursosController@viewGuiaAplicacion') }}">3. Pruebas específicas</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="{{ action('RecursosController@viewGuiaAsignacion') }}">Guía de Asignación</a>
                    </li>
                    <li class="dropdown">
                        <a href="{{ action('RecursosController@viewImagenInformativa') }}">Calendario</a>
                    </li>
                    <li class="dropdown">
                        <a href="{{ action('RecursosController@getReglamento') }}">Reglamento</a>
                    </li>

                </ul>
            </div>
            <div class="divide-nav">
                <div class="container">
                    <p class="divide-text"></p>
                </div>
            </div>
            <div class="navbar-secundary">
                <ul class="nav navbar-nav navbar-iepe-icons ">
                    <li>
                        <div>
                            <a target="_blank" href="https://www.facebook.com/BienestaryDesarrolloEstudiantilFarusac">
                                <span class="fa-stack fa-lg iepe-icon">
                                  <i class="fa fa-circle fa-stack-2x"></i>
                                  <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                            <a href="mailto:bienestar.estudiantil@farusac.edu.gt">
                                <span class="fa-stack fa-lg iepe-icon">
                                  <i class="fa fa-circle fa-stack-2x"></i>
                                  <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                            <a target="_blank" href="https://www.youtube.com/channel/UC5-oKtO_RDA4WLXiETtMuvA">
                                <span class="fa-stack fa-lg iepe-icon">
                                  <i class="fa fa-circle fa-stack-2x"></i>
                                  <i class="fa fa-youtube fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </div>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if  (Auth::guest())
                        <li class="dropdown">
                            <a href="{{ action('Auth\AuthController@showRegistrationForm') }}">Registrate
                                <span class="glyphicon glyphicon-log-in"></span></a>
                        </li>
                        <li class="dropdown">
                            <a href="{{ action('Auth\AuthController@showLoginForm') }}">Inicia Sesión
                                <span class="glyphicon glyphicon-user"></span>

                            </a>
                        </li>
                    @else
                        <li class="dropdown">
                            <a href="{{ action('AspiranteController@index') }}">
                                <span class="glyphicon glyphicon-edit"></span>Datos</a>
                        </li>
                        <li class="dropdown">
                            <a href="{{ action('AspiranteAplicacionController@create') }}">
                                <span class="glyphicon glyphicon-align-justify"></span>Asignar Específica</a>
                        </li>
                        <li class="dropdown">
                            <a href="{{ action('AspiranteAplicacionController@create') }}">
                                <span class="glyphicon glyphicon-tasks"></span>Resultados</a>
                        </li>
                        <li class="dropdown">
                            <a href="{{ action('formularioController@getConfirmacion') }}">
                                <span class="glyphicon glyphicon-check"></span>Aprobados</a>
                        </li>
                        <li>&nbsp;</li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span class="glyphicon glyphicon-user" ></span>NOV: {{ Auth::user()->NOV }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li class="dropdown"><a href="{{ route('aspirante.configuracion') }}">
                                        <span class="glyphicon glyphicon-wrench" ></span>Configurar cuenta</a></li>
                                <li class="dropdown"><a href="{{ action('Auth\AuthController@logout') }}">
                                        <span class="glyphicon glyphicon-log-out" ></span>Cerrar Sesión</a></li>
                            </ul>
                        </li>

                    @endif

                </ul>

            </div>

        </div><!-- /.navbar-collapse -->


    </div><!-- /.container-fluid -->
</nav>

<br /><br /><br />

<div class="divide-nav">
    <div class="container">
        <p class="divide-text"></p>
    </div>
</div>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @if  (!Auth::guest())
                    @if($errors->any())
                        <div class="alert alert-danger fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            @foreach ($errors->all() as $error)
                                <strong>Error: </strong> {!!$error !!}<br/>
                            @endforeach
                        </div>
                    @endif
                    @if (Session::has('mensaje_exito'))
                        <div class="container">
                            <div class="alert alert-success fade in" id="alert_message">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {!! Session::get('mensaje_exito') !!}
                            </div>
                        </div>
                        <script>
                            window.setTimeout(function () { // hide alert message
                                $("#alert_message").alert('close');
                            }, 7000);//milisegundos
                        </script>
                    @endif
                @endif

            </div>
            <div class="col-lg-12">
                @yield('content')

            </div>
        </div>
    </div>
</div>


<!-- JavaScripts -->
<script src="{{ url('aspirante_public/js/jquery.min.js') }}"></script>
<script src="{{ url('aspirante_public/js/moment.js') }}"></script>
<script src="{{ url('aspirante_public/js/bootstrap.min.js') }}"></script>

<script src="{{ url('aspirante_public/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ url('aspirante_public/js/locale/es.js') }}" type="text/javascript"></script>

<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
@section('scripts')
@show

</body>
</html>

