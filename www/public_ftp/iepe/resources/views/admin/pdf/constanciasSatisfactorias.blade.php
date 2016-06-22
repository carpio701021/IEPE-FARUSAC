<html>
<head>
    <style type='text/css'>
        p{
            font-family: Jester, "Comic Sans MS", sans-serif;
        }
        @page{
            margin-bottom: 1em;
            margin-top: 1em;
            margin-left: 5em;
            margin-right: 3em;
        }
    </style>
</head>
<body >
{{--background="/img/fondoConstanciaSatisfactorio-min.png"--}}

<?php $count=0; ?>
@foreach($asignaciones as $asignacion)
    <img src="/var/www/public_ftp/iepe/public/img/fondoConstanciaSatisfactorio.png"  style="width:650px;height:510px;" border="1"/>
    @if($count%2==0)
        <div>
            <p style="position: absolute; top: 20px; left: 280px; font-size: 19px;  text-align: center ">
                <strong>Universidad de San Carlos de Guatemala</strong><br>
                Facultad de Arquitectura</p>
            <p style="position: absolute; top: 160px; left: 380px; font-size: 21px;  text-align: center ">
                Constancia de resultado <strong>SATISFACTORIO</strong> en la Prueba Específica <br>
                realizada el {{$aplicacion->fecha_aplicacion}}
            </p>

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
    @else

    @endif
    @if($count%2!=0)
    <div style="page-break-before: always;"></div>
    @endif
    <?php $count++; ?>
@endforeach
</body>
</html>