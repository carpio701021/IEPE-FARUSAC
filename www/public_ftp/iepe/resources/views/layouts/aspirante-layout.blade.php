<!DOCTYPE html>
<html lang="en">
<head>
    <title>SAPE - FARUSAC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/css/aspirante.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/simple-sidebar.css">
    <link rel="stylesheet" href="/css/bootstrap-datetimepicker.min.css">


</head>
<body>
<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <img src="/img/logotipoFARUSAC_Amarillo.png"  style="width:210px;height:70px;">
            </li>
            <li id="item_aspirante">
                <a href="/aspirante">Aspirante</a>
            </li>
            <li id="li_pruebaEspecifica">
                <a href="/aspirante/PruebaEspecifica">Prueba Especifica</a>
            </li>
            <li>
                <a href="/aspirante/ResultadosSatisfactorios">Resultados satisfactorios</a>
            </li>
            @if  (Auth::guest())
                <li><a href="{{ url('/login') }}">Iniciar Sesión</a></li>
                <li><a href="{{ url('/register') }}">Registro</a></li>
            @else

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->email }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <!--<li><a href="/aspirante/{{Auth::user()->NOV}}/edit"><i class="fa fa-btn fa-sign-out"></i>Configuración de cuenta</a></li>-->
                        <li><a href="/configuracion"><i class="fa fa-btn fa-sign-out"></i>Configuración de cuenta</a></li>
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Cerrar Sesión</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @yield('content')
                    <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
                </div>
            </div>
        </div>
    </div>
</div> <!-- /#wrapper -->





<!-- JavaScripts -->
<script src="/js/jquery.min.js"></script>
<script src="/js/moment.js"></script>
<script src="/js/bootstrap.min.js"></script>

<script src="/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="/js/locale/es.js" type="text/javascript"></script>

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

