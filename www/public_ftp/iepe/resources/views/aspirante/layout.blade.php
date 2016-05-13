<!DOCTYPE html>
<html lang="en">
<head>
    <title>SAPE - FARUSAC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/aspirante.css">
    <link href="/css/simple-sidebar.css" rel="stylesheet">    
    <script src="/js/jquery-2.2.2.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>    
    <script src="/js/jquery.easing.1.3.js" type="text/javascript"></script>       

    
</head>
<body>
    <div id="wrapper">
<!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">

                    <img src="img/logotipoFARUSAC_Amarillo.png"  style="width:210px;height:70px;">

                </li>
                <li>
                    <a href="/aspirante">Aspirante</a>
                </li>
                <li class="active" id="li_pruebaEspecifica">
                    <a href="/aspirante/PruebaEspecifica">Prueba Especifica</a>
                </li>                
                <li>
                    <a href="/aspirante/ResultadosSatisfactorios">Resultados satisfactorios</a>
                </li>
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
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");        
    });
    </script>
</body>

</html>

