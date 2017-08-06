<html>
    <head>
        <style>
            p{
                font-family: Jester, "Comic Sans MS", sans-serif;
            }
        </style>
    </head>
    <body>
    <p align="center"><b>FACULTAD DE ARQUITECTURA<br />
    UNIVERSIDAD DE SAN CARLOS DE GUATEMALA<br />
    ACTA {{"0".$aplicacion->naplicacion."-".$aplicacion->year."-".$acta->id}}</b></p>

    <p align="justify">
        En la Ciudad de Guatemala
        {{strftime('a los %e días del mes de %B del año %G',strtotime($fecha))}},
        constituidos
        en la oficina administrativa de la Unidad de Bienestar y Desarrollo Estudiantil de la
        Facultad de Arquitectura del Edificio T-2, Primer Nivel, estando presentes:  Arquitecto
        {{ $decano->getNombreCompleto() }}, Decano, Arquitecto {{ $secretario->getNombreCompleto() }},
        Secretario Académico, Arquitecto {{ $jefe_bienestar->getNombreCompleto() }}, Jefe de Unidad de
        Bienestar y Desarrollo Estudiantil hacen constar: <b>PRIMERO: </b>
        de acuerdo a los parámetros previamente convenidos, los aspirantes con evaluación satisfactoria son
        {{ count($aspirantes) }}
    </p>
    
    <table class="table" width="100%">
            <thead>
                <tr>
                    <th width="20%" align="left">No. Orientacion</th>
                    <th width="80%" align="left">Nombre</th>
                </tr>
            </thead>
            <tbody>
            @foreach($aspirantes as $a)
                <tr>
                    <td>{{$a->aspirante_id}}</td>
                    <td>{{$a->nombre.' '.$a->apellido}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!--div style="page-break-before: always;"></div-->
    <p align="justify">
        <b>SEGUNDO:</b> se acuerda autorizar la impresión de las constancias correspondientes.
        <b>TERCERO:</b> Se levanta la presente acta en el mismo lugar y fecha
        descrita al inicio de la misma. Damos Fe:-</p>

        <br>
    <p align='center'><strong>"Id y ensañar a todos"</strong></p>
            <br>
            <br>
            <p align='center'> Arq. {{ $decano->getNombreCompleto() }}<br>
                Decano<br>
                Facultad de Arquitectura
            </p>
            <br>
            <br>
            <table width="100%">
                <tr>
                    <td valign="top">
                        <p align="center">Arq. {{ $jefe_bienestar->getNombreCompleto() }}<br>
                            Unidad de Bienestar y Desarrollo Estudiantil<br>
                            Facultad de Arquitectura<br>
                            Jefe</p>
                    </td>
                    <td valign="top">
                        <p align="center">
                            Arq. {{ $secretario->getNombreCompleto() }}<br>
                            Secretaría Académica<br>
                            Facultad de Arquitectura<br>
                        </p>
                    </td>
                </tr>
            </table>

    </p>
    </body>
</html>
