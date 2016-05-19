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
            <ul class="nav navbar-nav">
                <!--li class="active"><a href="#">Usuarios <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Notificaciones</a></li-->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administrador <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/usuarios">Usuarios</a></li>
                        <li><a href="#">Notificar a direcciones de escuela</a></li>
                        <!--li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li-->
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Desarrollo estudiantil <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/oportunidades">Oportunidades</a></li>
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
            @if( Auth::check() )
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span>  {{ Auth::user()->nombre }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Cambiar contraseña</a></li>
                            <li><a href="#">Mis roles</a></li>
                        </ul>
                    </li>
                </ul>
            @else
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            nada
                        </a>
                    </li>
                </ul>
            @endif
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
@section('cuerpo')
@show



        <!-- JavaScripts -->
<script src="/js/jquery-2.2.2.min.js"></script>
<script src="/js/bootstrap.min.js"></script>

</body>
</html>
