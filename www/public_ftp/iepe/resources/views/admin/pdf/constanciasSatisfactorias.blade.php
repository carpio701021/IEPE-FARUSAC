<html>
<head>
    <style type='text/css'>
        @page{
            margin-top: 0em;
            margin-left: 0em;
            margin-bottom: 0em;
            margin-right: 0em;
        }

    </style>
</head>
<body background="/img/fondoConstanciaSatisfactorio.png">

@foreach($asignaciones as $asignacion)

    <div>
        <!--h2 style="position: absolute; top: 50px; left: 410px; font-size: 28px"> Universidad de San Carlos de Guatemala</h2-->
        <p style="position: absolute; top: 37px; left: 435px; font-size: 28px; text-align:center">
            <strong>Universidad de San Carlos de Guatemala</strong><br>
            Facultad de Arquitectura</p>
        <p style="position: absolute; top: 160px; left: 380px; font-size: 21px;  text-align: center ">
            Constancia de resultado <strong>SATISFACTORIO</strong> en la Prueba Específica <br>
            realizada el {{$aplicacion->fecha_aplicacion}}
        </p>

        <!--p-- style="position: absolute; top: 382px; left: 480px; font-size: 21px;  text-align: center ">
            <strong>Éste resultado tiene validez únicamente <br>
            para inscribirse en el año 2017
            </strong>
        </--p-->

        <p style="position: absolute; top: 634px; left: 33px; font-size: 20px;  text-align: right ">
            <strong>Msc. Arq. Publio Rodríguez</strong> <br>
            Secretario<br>
            Facultad de Arquitectura
        </p>
        <p style="position: absolute; top: 634px; left: 744px; font-size: 20px;  text-align: right ">
            <strong>Arq. Oscar Enriquez</strong> <br>
            Unidad Bienestar<br>
            y Desarrollo Estudiantil
        </p>

        <p style="position: absolute; top: 235px; left: 425px; font-size: 25px;text-align:center" >
            {{$asignacion->getAspirante()->getNombreCompleto()}}<br>
            {{$asignacion->aspirante_id}}<br>
            {{md5($aplicacion->fecha_aplicacion.'-'.$asignacion->aspirante_id)}}
        </p>
    </div>
    <div style="page-break-before: always;"></div>
@endforeach
</body>
</html>