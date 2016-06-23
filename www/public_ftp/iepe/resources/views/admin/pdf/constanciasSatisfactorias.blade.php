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
            <p style="position: absolute; top: 30px; left: 280px; font-size: 17px;  text-align: center ">
                <strong>Universidad de San Carlos de Guatemala</strong><br>
                Facultad de Arquitectura</p>
            <p style="position: absolute; top: 110px; left: 248px; font-size: 12px;  text-align: center ">
                Constancia de resultado <strong>SATISFACTORIO</strong> en la Prueba Específica <br>
                realizada el {{$asignacion->getFechaAplicacion()}}
            </p>

            <p style="position: absolute; top: 165px; left: 310px; font-size: 13px;text-align:center" >
                <strong>
                {{$asignacion->getAspirante()->getNombreCompleto()}}<br>
                {{$asignacion->aspirante_id}}<br>
                {{md5($aplicacion->fecha_aplicacion.'-'.$asignacion->aspirante_id)}}
                </strong>
            </p>

            <p style="position: absolute; top: 430px; left: 20px; font-size: 12px;  text-align: right ">
                <strong>Msc. Arq. Publio Rodríguez</strong> <br>
                Secretario<br>
                Facultad de Arquitectura
            </p>
            <p style="position: absolute; top: 430px; left: 493px; font-size: 12px;  text-align: right ">
                <strong>Arq. Oscar Enriquez</strong> <br>
                Unidad Bienestar<br>
                y Desarrollo Estudiantil
            </p>
    @else
            <p style="position: absolute; top: 540px; left: 280px; font-size: 17px;  text-align: center ">
                <strong>Universidad de San Carlos de Guatemala</strong><br>
                Facultad de Arquitectura</p>
            <p style="position: absolute; top: 620px; left: 248px; font-size: 12px;  text-align: center ">
                Constancia de resultado <strong>SATISFACTORIO</strong> en la Prueba Específica <br>
                realizada el {{$asignacion->getFechaAplicacion()}}
            </p>

            <p style="position: absolute; top: 675px; left: 310px; font-size: 13px;text-align:center" >
                <strong>
                    {{$asignacion->getAspirante()->getNombreCompleto()}}<br>
                    {{$asignacion->aspirante_id}}<br>
                    {{md5($aplicacion->fecha_aplicacion.'-'.$asignacion->aspirante_id)}}
                </strong>
            </p>

            <p style="position: absolute; top: 940px; left: 20px; font-size: 12px;  text-align: right ">
                <strong>Msc. Arq. Publio Rodríguez</strong> <br>
                Secretario<br>
                Facultad de Arquitectura
            </p>
            <p style="position: absolute; top: 940px; left: 493px; font-size: 12px;  text-align: right ">
                <strong>Arq. Oscar Enriquez</strong> <br>
                Unidad Bienestar<br>
                y Desarrollo Estudiantil
            </p>
    @endif

    <?php $count++; ?>
@endforeach
</body>
</html>