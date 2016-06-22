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

<p style="position: absolute; top: 285px; left: 315px; font-size: 30px"> {{$asignacion->getAplicacion()->nombre()}}</p>
<p style="position: absolute; top: 330px; left: 185px; font-size: 25px"> {{$aspirante->getNombreCompleto()}}</p>
<p style="position: absolute; top: 330px; left: 765px; font-size: 25px"> {{$aspirante->NOV}}</p>

<p style="position: absolute; top: 405px; left: 180px; font-size: 25px"> {{$asignacion->getFechaAplicacion()}}</p>
<p style="position: absolute; top: 405px; left: 675px; font-size: 25px"> {{$asignacion->getHorario()->printHorario()}}</p>

<p style="position: absolute; top: 478px; left: 180px; font-size: 25px"> {{$asignacion->getSalon()->edificio}}</p>
<p style="position: absolute; top: 478px; left: 675px; font-size: 25px"> {{$asignacion->getSalon()->nombre}}</p>
</body>
</html> 