<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Fonts -->

    <link href="/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="/css/googlefonts-css-latio.css" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="/css/bootstrap-datepicker.min.css">



    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
    <title>IEPE - FARUSAC</title>
</head>
<body>

<nav class="navbar navbar-inverse" >
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/admin">FARUSAC</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            @if (!Auth::guard('admin')->check())
                <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url('/admin/login') }}">Iniciar Sesión</a></li>
                </ul>
            @else
                <ul class="nav navbar-nav">
                    <!--li class="active"><a href="#">Usuarios <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Notificaciones</a></li-->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administrador <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/admin/usuarios">Usuarios</a></li>
                            <li><a href="#">Notificar a direcciones de escuela</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Desarrollo estudiantil <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/admin/oportunidad">Oportunidades</a></li>
                            <li><a href="#">Estadística</a></li>
                            <li><a href="#">Resultados de básicos</a></li>
                            <li><a href="#">Ingreso de resultados básicos</a></li>
                            <!--li><a href="#">Asignación de salones</a></li>
                            <li><a href="#">Información</a></li>
                            <li><a href="#">Asignación manual de aspirante</a></li>
                            <li><a href="#">Resultado</a></li-->
                            <li><a href="#">Cargar datos</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            Resultados<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Aprobar resultados</a></li>
                            <li><a href="#"></a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span>  {{ Auth::guard('admin')->user()->email }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Cambiar contraseña</a></li>
                            <li><a href="#">Mis roles</a></li>
                            <li><a href="{{ url('/admin/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Cerrar Sesión</a></li>
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
<script src="/js/jquery-2.2.2.min.js"></script>
<script src="/js/bootstrap.min.js"></script>

<script src="/js/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="/js/bootstrap-datepicker.es.min.js" type="text/javascript"></script>

@section('scripts')
    @show

</body>
</html>
