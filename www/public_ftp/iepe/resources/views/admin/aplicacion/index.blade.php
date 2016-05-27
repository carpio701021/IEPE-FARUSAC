@extends('layouts.admin-user')

@section('content')
    <div class="container">
        <div class='btn-toolbar pull-right'>
            <br>
            <div class='btn-group'>
                <a href="/admin/aplicacion/create" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Nueva aplicación</a>
            </div>
        </div>
        <h2>Aplicaciones</h2>
        @include('layouts.mensajes')


        <br>

        <div class="panel-group">
        @foreach ($aplicaciones as $aplicacion)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapse_{{ $aplicacion->id }}"><b>{{ $aplicacion->nombre }}</b></a>
                        </h4>
                    </div>
                    <div id="collapse_{{ $aplicacion->id }}" class="panel-collapse collapse">
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-5 form-group">
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-6"><b>Inicio de asignaciones:</b></div>
                                        <div class="col-md-6">{{ $aplicacion->fecha_inicio_asignaciones }}</div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-6"><b>Cierre asignaciones:</b></div>
                                        <div class="col-md-6">{{ $aplicacion->fecha_fin_asignaciones }}</div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-6"><b>Día de la aplicación:</b></div>
                                        <div class="col-md-6">{{ $aplicacion->fecha_aplicacion }}</div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-6"><b>Publicación de resultados:</b></div>
                                        <div class="col-md-6">{{ $aplicacion->fecha_publicacion_resultados }}</div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-6"><b>Capacidad máxima de asignaciones:</b></div>
                                        <div class="col-md-6">{{ $aplicacion->getCapacidadMaxima() }} aspirantes</div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-6"><b>Asignados:</b></div>
                                        <div class="col-md-6">{{ $aplicacion->getCountAsignados() }} aspirantes</div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    Arte
                                </div>
                                <div class="col-md-3">
                                    <h4>Opciones:</h4>
                                    <ul>
                                        <li><a href="/admin/aplicacion/{{ $aplicacion->id }}/edit"><span class="glyphicon glyphicon-edit"></span> Editar</a></li>
                                        <li><a href="#"><span class="glyphicon glyphicon-list"></span> Descargar Listado</a></li>
                                        <li><a href="#"><span class="glyphicon glyphicon-upload"></span> Subir resultados</a></li>
                                        <li><a href="#"><span class="glyphicon glyphicon-align-left"></span> Ajustar percentiles</a></li>
                                        <li><a href="#"><span class="glyphicon glyphicon-plus"></span> Asignación manual de aspirante</a></li>
                                        <li><a href="#"><span class="glyphicon glyphicon-tasks"></span> Generar Constancias</a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
        @endforeach
        </div>

        <div align="center">{!! $aplicaciones->render() !!}</div>






        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse2">Primera aplicacion 2016</a>
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