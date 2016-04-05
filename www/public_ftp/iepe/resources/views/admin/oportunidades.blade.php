@extends('layouts.admin-user')

@section('cuerpo')
    <div class="container">
        <h2>Oportunidades</h2>

        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse1">Segunda oportunidad 2016</a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                    <div class="panel-body">Opciones:
                        <ul>
                            <li><a href="#">Examinar</a></li>
                            <li><a href="#">Guardar</a></li>
                            <li><a href="#">Descargar Listado</a></li>
                            <li><a href="#">Aprobar</a></li>
                            <li><a href="#">Subir Arte</a></li>
                            <li><a href="#">Generar Constancias</a></li>
                        </ul>

                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-xs btn-primary">Asignar salones</button>
                        <button class="btn btn-xs btn-primary">Información</button>
                        <button class="btn btn-xs btn-primary">Asignación manual del aspirante</button>
                        <button class="btn btn-xs btn-primary">Resultado</button>

                    </div>
                </div>
            </div>
        </div>


        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse2">Primera oportunidad 2016</a>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                    <div class="panel-body">Opciones:
                        <ul>
                            <li><a href="#">Examinar</a></li>
                            <li><a href="#">Guardar</a></li>
                            <li><a href="#">Descargar Listado</a></li>
                            <li><a href="#">Aprobar</a></li>
                            <li><a href="#">Subir Arte</a></li>
                            <li><a href="#">Generar Constancias</a></li>
                        </ul>

                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-xs btn-primary">Asignar salones</button>
                        <button class="btn btn-xs btn-primary">Información</button>
                        <button class="btn btn-xs btn-primary">Asignación manual del aspirante</button>
                        <button class="btn btn-xs btn-primary">Resultado</button>

                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection