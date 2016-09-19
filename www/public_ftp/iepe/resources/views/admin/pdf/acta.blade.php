<html>
    <head>
        <style>
            p{
                font-family: Jester, "Comic Sans MS", sans-serif;
            }
        </style>
    </head>
    <body>
    <p><b>ACTA {{"0".$aplicacion->naplicacion."-".$aplicacion->year."-".$acta->id}}</b></p>
    <p align="justify">En la Ciudad de Guatemala {{strftime('a los %e dias del mes de %B del año %G',strtotime($fecha))}}, 
    constituidos en la oficina administrativa de la Unidad 
    de Desarrollo y Bienestar Estudiantil de la Facultad de Arquitectura del Edificio T-2, Primer
    Nivel, estado presentes: Arquitecto Byron Alfredo Rabe Rendón, Decano, Arquitecto 
    Publio Alcides Rodríguez Lobos, Secretario Académico, Arquitecto Oscar Romeo Enríquez 
    Guitiérrez, Jefe de Unidad de Desarrollo y Bienestar Estudiantil hacen constar: <b>PRIMERO: </b>
    de acuerdo a los percentiles recomendados en la aplicación de la prueba Específica, que dan 
    como resultado satisfactorio, se detalla a continuación el listado de aspirantes estudiantiles 
    que cumplen con este requisito.
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
    <div style="page-break-before: always;"></div>
    <p align="justify">
    <b>SEGUNDO:</b> Dando como resultado el total de {{count($aspirantes)}} personas con resultado satisfactorio. 
    <b>TERCERO:</b> Se extiende la presente para legitimar y avalar la impresión de las constancias correspondientes. 
    <b>CUARTO:</b> Se levanta la presente acta y sin más que asentar se finaliza la presente en el mismo lugar y fecha del encabezado. 
    Sin más, se firma para constancia, los que en ella intervinieron. Damos Fe:- </p>

        <br>
        <br>
        <p align='center'> <strong>"Id y ensañar a todos"</strong></p>
        <br>
        <br>
        <p align='center'> Arq. Byron Rabe Rendón<br>
            Decano<br>
            Facultad de Arquitectura
        </p>
        <br>
        <br>
    <table width="100%">
        <tr>
            <td valign="top">
                <p align="center">Arq. Oscar Enríquez <br>
                Bienestar y Desarrollo Estudiantil<br>
                Facultad de Arquitectura<br>
                Jefe</p>
            </td>
            <td valign="top">
                <p align="center">
                Arq. Publio Rodríguez Lobos<br>
                Secretaría Académica<br>
                Facultad de Arquitectura<br>
                </p>
            </td>
        </tr>
    </table>
    
    
    <!-- ----------------------------
    <p align="justify">Universidad de San Carlos de Guatemala, Facultad de Arquitectura, Acta Ref. EA-{{$aplicacion->year*1000+$acta->id}} , por
        medio de la presente, el señor decano, Arquitecto Byron Rabe Rendón, el señor Secretario
        Académico Arquitecto Publio Rodríguez Lobos y el Jefe de la Unidad de Bienestar y Desarrollo
        Estudiantil Arquitecto Oscar Enríquez, hacen constar que se tuvo a la vista los resultados de la
        prueba específica correspondiente a la {{$aplicacion->nombre()}}, así mismo de
        acuerdo a los percentiles que la misma evaluación establece, se detallan a continuación los
        resultados satisfactorios.</p>
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
        <div style="page-break-before: always;"></div>
        <p align="justify">
        Dando como resultado el total de: {{count($aspirantes)}} personas con resultado satisfactorio, se extiende la

        presente para legitimar y avalar la impresión de las constancias correspondientes,

        {{strftime('a los %e dias del mes de %B del año %G',strtotime($fecha))}}.
        </p>
        <br>
        <br>
        <p align='center'> <strong>"Id y ensañar a todos"</strong></p>
        <br>
        <br>
        <p align='center'> Arq. Byron Rabe Rendón<br>
            Decano<br>
            Facultad de Arquitectura
        </p>
        <br>
        <br>
        <table width="100%">
            <tr>
            <td valign="top">
                <p align="center">Arq. Oscar Enríquez <br>
                Bienestar y Desarrollo Estudiantil<br>
                Facultad de Arquitectura<br>
                Jefe</p>
            </td>
            <td valign="top">
                <p align="center">
                Arq. Publio Rodríguez Lobos<br>
                Secretaría Académica<br>
                Facultad de Arquitectura<br>
                </p>
            </td>
            </tr>
        </table>
    ----------------------- -->
    
    </body>
</html>
