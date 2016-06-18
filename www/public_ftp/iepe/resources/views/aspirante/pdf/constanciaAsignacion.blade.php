<html>
<head>
    <style>
        @page {
            margin-top: 0em;
            margin-left: 0em;
            margin-bottom: 0em;
            margin-right: 0em;
        }
    </style>
</head>
<body background="/img/fondoBoletaAsignacion.png">

<p style="position: absolute; top: 335px; left: 185px; font-size: 25px"> {{$aspirante->getNombreCompleto()}}
<p style="position: absolute; top: 335px; left: 765px; font-size: 25px"> {{$aspirante->NOV}}</p>

<p style="position: absolute; top: 410px; left: 180px; font-size: 25px"> {{$asignacion->getAplicacion()->fecha_aplicacion}}</p>
<p style="position: absolute; top: 410px; left: 675px; font-size: 25px"> {{$asignacion->getHorario()->printHorario()}}</p>

<p style="position: absolute; top: 483px; left: 180px; font-size: 25px"> {{$asignacion->getSalon()->edificio}}</p>
<p style="position: absolute; top: 483px; left: 675px; font-size: 25px"> {{$asignacion->getSalon()->nombre}}</p>
</body>
</html> 