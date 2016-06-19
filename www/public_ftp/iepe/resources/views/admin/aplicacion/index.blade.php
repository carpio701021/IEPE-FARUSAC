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
                            <a data-toggle="collapse" href="#collapse_{{ $aplicacion->id }}"><b>{{ $aplicacion->nombre() }}</b></a>
                        </h4>
                    </div>
                    <div id="collapse_{{ $aplicacion->id }}" class="panel-collapse collapse">
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <h4>Datos generales</h4>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-6"><b>Inicio de asignaciones:</b></div>
                                        <div class="col-md-6 fecha">{{ $aplicacion->fecha_inicio_asignaciones }}</div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-6"><b>Cierre asignaciones:</b></div>
                                        <div class="col-md-6 fecha">{{ $aplicacion->fecha_fin_asignaciones }}</div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-6"><b>Día de la aplicación:</b></div>
                                        <div class="col-md-6 fecha">{{ $aplicacion->fecha_aplicacion }}</div>
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
                                <div class="col-md-4">
                                    <h4>Arte</h4>
                                    <img src="/admin/aplicacion/{{ $aplicacion->id }}/arte" alt="-No establecida-" height="100%" width="100%">
                                </div>
                                <div class="col-md-3">
                                    <h4>Opciones</h4>
                                    <ul>
                                        <li><a href="/admin/aplicacion/{{ $aplicacion->id }}/edit"><span class="glyphicon glyphicon-edit"></span> Editar</a></li>
                                        <li><a href="/admin/aplicacion/{{$aplicacion->id}}/listados"><span class="glyphicon glyphicon-list"></span> Descargar Listado</a></li>
                                        <li><a href="/admin/aplicacion/subirResultados/{{$aplicacion->id}}/edit"><span class="glyphicon glyphicon-upload"></span> Resultados</a></li>
                                        <li><a href="#"><span class="glyphicon glyphicon-align-left"></span> Ajustar percentiles</a></li>
                                        <li><a href="#"><span class="glyphicon glyphicon-plus"></span> Asignación manual de aspirante</a></li>
                                        <li><a href="/admin/aplicacion/{{$aplicacion->id}}/constanciasSatisfactorias" target="_blank"><span class="glyphicon glyphicon-tasks"></span> Generar Constancias</a></li>
                                        <li><a href="/admin/aplicacion/{{$aplicacion->id}}/actas"><span class="glyphicon glyphicon-tasks"></span> Actas</a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
        @endforeach
        </div>

        <div align="center">{!! $aplicaciones->render() !!}</div>

    </div>

@endsection

@section('scripts')
<script>
    $(function () {
        $('.fecha').each(function(i, obj) {
            fechaO = obj.innerHTML;
            //alert(fechaO);
            obj.innerHTML = moment(fechaO,'YYYY-MM-DD').format('D [de] MMMM [del] YYYY');
            //obj.innerHTML = moment(fechaO).format('L');
        });
    });
</script>
@endsection