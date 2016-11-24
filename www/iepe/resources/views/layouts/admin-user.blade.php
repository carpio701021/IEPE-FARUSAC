<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="/estudiante/images/icono.ico" type="image/x-icon">
    <!-- Fonts -->
    <!--link href="/css/font-awesome.min.css" rel='stylesheet' type='text/css'-->
    <link href="{{ url('aspirante_public/css/googlefonts-css-latio.css') }}" rel='stylesheet' type='text/css'>
    <!-- Styles -->
    <link href="{{ url('aspirante_public/css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ url('aspirante_public/css/bootstrap-datetimepicker.min.css') }}">

    <style>
        body {
            font-family: 'Lato';
        }
    </style>
    @section('styles')
    @show

    <title>IEPE - FARUSAC</title>
</head>
<body id="app-layout">

<nav class="navbar navbar-inverse navbar-static-top" >
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('admin.index') }}">FARUSAC</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            @if (!Auth::guard('admin')->check())
                <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ action('AuthAdmin\AuthController@showLoginForm') }}">Iniciar Sesión</a></li>
                </ul>
            @else
                <ul class="nav navbar-nav">
                    <!--li class="active"><a href="#">Usuarios <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Notificaciones</a></li-->
                    <style>
                        li.dropdown ul.dropdown-menu li a{
                            color: white;
                        }
                        li.dropdown ul.dropdown-menu li a:hover{
                            color: #192949;
                        }
                    </style>
                    @if(Auth::guard('admin')->user()->tieneRol('director_arquitectura')||
                    Auth::guard('admin')->user()->tieneRol('director_disenio_grafico'))
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Escuela <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ action('AnioController@indexPrimerIngreso') }}">Primer ingreso</a></li>
                            </ul>
                        </li>
                    @endif
                    @if(Auth::guard('admin')->user()->tieneRol('superadmin'))
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administrador <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ action('GestionUsuariosController@index') }}">Usuarios</a></li>
                            <li><a href="{{ action('AnioController@index') }}">Notificar a direcciones de escuela</a></li>
                            <li><a href="{{ action('DatosController@index') }}">Cargar datos del SUN</a></li>
                        </ul>
                    </li>
                    @endif
                    @if(Auth::guard('admin')->user()->tieneRol('jefe_bienestar'))
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Desarrollo estudiantíl <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ action('AplicacionController@index') }}">Aplicaciones</a></li>
                            <li><a href="{{ action('reportesController@index') }}">Estadística</a></li>
                            <!--li><a href="#">Resultados de básicos</a></li-->
                            <li><a href="{{ action('DatosController@create') }}">Cambiar carnet por NOV</a></li>
                            <!--li><a href="#">Asignación de salones</a></li>
                            <li><a href="#">Información</a></li>
                            <li><a href="#">Ingreso de resultados básicos</a></li>
                            <li><a href="#">Resultado</a></li-->
                        </ul>
                    </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Aspirantes <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ action('ListaNegraController@index') }}">Aspirantes</a></li>
                                <li><a href="{{ action('ListaNegraController@getListaNegra') }}">Casos Especiales</a></li>
                                <li><a href="{{ action('RecursosController@index') }}">Recursos</a></li>
                            </ul>
                        </li>
                    @endif
                    @if(Auth::guard('admin')->user()->tieneRol('jefe_bienestar')
                    ||Auth::guard('admin')->user()->tieneRol('secretario')
                    ||Auth::guard('admin')->user()->tieneRol('decano'))
                    <li class="dropdown">
                            <a href="{{ action('ActaController@index') }}">Actas</a>
                    </li>
                    @endif
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a>{{ Auth::guard('admin')->user()->getRolName() }}:</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span>  {{ Auth::guard('admin')->user()->email }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!--li><a href="#">Cambiar contraseña</a></li-->
                            <li><a href="{{ action('AuthAdmin\AuthController@logout') }}"><i class="glyphicon glyphicon-logout"></i>Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>

            @endif

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
@section('content')
@show



        <!-- JavaScripts -->
<script src="{{ url('aspirante_public/js/jquery.min.js') }}"></script>
<script src="{{ url('aspirante_public/js/moment.js') }}"></script>
<script src="{{ url('aspirante_public/js/bootstrap.min.j') }}s"></script>

<!--script src="/js/jquery.easing.1.3.js" type="text/javascript"></script-->
<script src="{{ url('aspirante_public/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ url('aspirante_public/js/locale/es.js') }}" type="text/javascript"></script>

@section('scripts')
@show

</body>
</html>
