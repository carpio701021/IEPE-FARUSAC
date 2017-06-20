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
    <link rel="stylesheet" href="{{ url('aspirante_public/css/simple-sidebar.css') }}">
    <link rel="stylesheet" href="{{ url('aspirante_public/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ url('aspirante_public/css/iepe2017.css') }}">

    @section('styles')
    @show

</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top" >
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
            
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

          <a class="navbar-brand brand-arqui" href="{{ url('aspirante') }}">
              <div class="container">
                  <img src="{{ url('aspirante_public/img/logotipoFARUSAC_Amarillo.png') }}"  >{{-- 210 y 70 --}}
              </div>
            </a>
                <ul class="nav navbar-nav navbar-right">
                    <!--li class="active"><a href="#">Usuarios <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Notificaciones</a></li-->
                        <li class="dropdown">
                            <a href="{{ url('aspirante') }}">Inicio</a>
                        </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Proceso de Ingreso <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Prueba de Orientación Vocacional</a></li>
                            <li><a href="#">Prueba de Conocimientos Básicos</a></li>
                            <li><a href="{{ action('RecursosController@viewGuiaAplicacion') }}">Pruebas específicas</a></li>
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

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<style type="text/css">
body {
}
</style>

<nav class="navbar navbar-inverse navbar-static-top navbar-secundary">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbary" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>            
                
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbary" >

                <ul class="nav navbar-nav navbar-iepe-icons">
                    <li><a href="#">
                            <span class="fa-stack fa-lg iepe-icon">
                              <i class="fa fa-circle fa-stack-2x"></i>
                              <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                            </span>
                    </a></li>
                    <li><a href="#">
                            <span class="fa-stack fa-lg iepe-icon">
                              <i class="fa fa-circle fa-stack-2x"></i>
                              <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
                            </span>
                        </a></li>
                    <li><a href="#">
                            <span class="fa-stack fa-lg iepe-icon">
                              <i class="fa fa-circle fa-stack-2x"></i>
                              <i class="fa fa-youtube fa-stack-1x fa-inverse"></i>
                            </span>
                        </a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <!--li class="active"><a href="#">Usuarios <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Notificaciones</a></li-->
                    <li class="dropdown">
                        <a href="{{ action('Auth\AuthController@showRegistrationForm') }}">Registrate</a>
                    </li>
                    <li class="dropdown">
                            <a href="{{ action('Auth\AuthController@showLoginForm') }}">Inicia Sesión
                                <span class="glyphicon glyphicon-user"></span>

                            </a>
                    </li>

                </ul>
                {{-- <ul class="nav navbar-nav navbar-right">
                                                    <li class="dropdown">
                                                        <a>{{ "" }}:</a>
                                                    </li>
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                            <span class="glyphicon glyphicon-user"></span>  {{ "" }} <span class="caret"></span>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <!--li><a href="#">Cambiar contraseña</a></li-->
                                                            <li><a href="{{ action('AuthAdmin\AuthController@logout') }}"><i class="glyphicon glyphicon-logout"></i>Cerrar Sesión</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                 --}}

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

@yield('content')

{{-- <div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand"><a href="{{ url('aspirante') }}">
                <img src="{{ url('aspirante_public/img/logotipoFARUSAC_Amarillo.png') }}"  style="width:210px;height:70px;">
            </a></li>
            <li>&nbsp;</li>
            <li><a href="{{ action('RecursosController@viewImagenInformativa') }}"><span class="glyphicon glyphicon-calendar" style="font-size:25px"></span>&nbsp;&nbsp;&nbsp;
                    Fechas</a></li>
            <li><a href="{{ action('RecursosController@getReglamento') }}"><span class="glyphicon glyphicon-file" style="font-size:25px"></span>&nbsp;&nbsp;&nbsp;
                    Reglamento</a></li>
            <li><a href="{{ action('RecursosController@viewGuiaAsignacion') }}"><span class="glyphicon glyphicon-facetime-video" style="font-size:25px"></span>&nbsp;&nbsp;&nbsp;
                    Guía de asignación</a></li>
            <li><a href="{{ action('RecursosController@viewGuiaAplicacion') }}"><span class="glyphicon glyphicon-apple" style="font-size:25px"></span>&nbsp;&nbsp;&nbsp;
                    Guía de aplicación</a></li>
            <li>&nbsp;</li>
            @if  (Auth::guest())
                <li><a href="{{ action('Auth\AuthController@showRegistrationForm') }}"><span class="glyphicon glyphicon-user" style="font-size:25px"></span>&nbsp;&nbsp;&nbsp;
                        Registro</a></li>
                <li><a href="{{ action('Auth\AuthController@showLoginForm') }}"><span class="glyphicon glyphicon-log-in" style="font-size:25px"></span>&nbsp;&nbsp;&nbsp;
                        Iniciar Sesión</a></li>
            @else
                <li id="item_aspirante">
                    <a href="{{ action('AspiranteController@index') }}">
                        <span class="glyphicon glyphicon-edit" style="font-size:25px"></span>&nbsp;&nbsp;&nbsp;
                        Datos</a>
                </li>
                <!--li id="li_pruebaEspecifica" style="background:#e2b12c" class="parpadea"-->
                <li id="li_pruebaEspecifica" style="background:#e2b12c">
                    <a href="{{ action('AspiranteAplicacionController@create') }}">
                        <span class="glyphicon glyphicon-align-justify" style="font-size:25px"></span>&nbsp;&nbsp;&nbsp;
                        Asignar Específica</a>
                </li>
                <li id="li_pruebaEspecifica">
                    <a href="{{ action('AspiranteAplicacionController@create') }}">
                        <span class="glyphicon glyphicon-tasks" style="font-size:25px"></span>&nbsp;&nbsp;&nbsp;
                        Resultados</a>
                </li>
                <li>
                    <a href="{{ action('formularioController@getConfirmacion') }}">
                        <span class="glyphicon glyphicon-check" style="font-size:25px"></span>&nbsp;&nbsp;&nbsp;
                        Aprobados</a>
                </li>
                <li>&nbsp;</li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <span class="glyphicon glyphicon-user" style="font-size:25px"></span>&nbsp;&nbsp;&nbsp;
                        NOV: {{ Auth::user()->NOV }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('aspirante.configuracion') }}">
                                <span class="glyphicon glyphicon-wrench" style="font-size:25px"></span>&nbsp;&nbsp;&nbsp;
                                Configurar cuenta</a></li>
                        <li><a href="{{ action('Auth\AuthController@logout') }}">
                                <span class="glyphicon glyphicon-log-out" style="font-size:25px"></span>&nbsp;&nbsp;&nbsp;
                                Cerrar Sesión</a></li>
                    </ul>
                </li>
            @endif
        </ul>
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

                        <div class="container" id="menu-toggle">
                            <a href="#menu-toggle" class="btn btn-primary">
                                <span class="glyphicon glyphicon-menu-hamburger"></span> Menú
                            </a>
                            <br>
                            <br>
                        </div>

                    <!--a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a-->
                    </div>
                <div class="col-lg-12">
                    @yield('content')

                </div>
            </div>
        </div>
    </div>
</div>  --}}<!-- /#wrapper -->





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

