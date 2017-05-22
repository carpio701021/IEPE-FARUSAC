<html>
<head>
    <style>
        p{
            font-family: Jester, "Comic Sans MS", sans-serif;
        }
        @page {
            margin-top: 3em;
            margin-left: 5em;
            margin-bottom: 2em;
            margin-right: 2em;
        }
    </style>
</head>
<body>
<img src="{{ storage_path() }}/fondoConstanciaAsignacion.jpg"  style="width:650px;height:510px;" border="1"/>

<p style="position: absolute; top: 195px; left: 210px; font-size: 17px"> {{$asignacion->getAplicacion()->nombre()}}</p>
<p style="position: absolute; top: 224px; left: 125px; font-size: 15px"> {{$aspirante->getNombreCompleto()}}</p>
<p style="position: absolute; top: 224px; left: 507px; font-size: 15px"> {{$aspirante->NOV}}</p>

<p style="position: absolute; top: 275px; left: 115px; font-size: 15px"> {{ $asignacion->getFechaFormatoGt() }}</p>
<p style="position: absolute; top: 275px; left: 438px; font-size: 15px"> {{$asignacion->getHorario()->printHorario()}}</p>

<p style="position: absolute; top: 320px; left: 115px; font-size: 15px"> {{$asignacion->getSalon()->edificio}}</p>
<p style="position: absolute; top: 320px; left: 438px; font-size: 15px"> {{$asignacion->getSalon()->nombre}}</p>

</body> 
</html> 