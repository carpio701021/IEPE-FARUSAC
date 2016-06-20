@extends('layouts.admin-user')

@section('content')
    <div class="container">
        <h2>Años</h2>
        @include('layouts.mensajes')


        <br>

        <div class="panel-group">
        @foreach ($anios as $anio)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapse_{{ $anio->year }}"><b>{{ $anio->year }}</b></a>
                        </h4>
                    </div>
                    <div id="collapse_{{ $anio->year }}" class="panel-collapse collapse">
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <h4>Datos generales</h4>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-6"><b>Inicio de asignaciones:</b></div>
                                        <div class="col-md-6 fecha">{{ $anio->year }}</div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-6"><b>Cierre asignaciones:</b></div>
                                        <div class="col-md-6 fecha">{{ $anio->year }}</div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-6"><b>Día de la aplicación:</b></div>
                                        <div class="col-md-6 fecha">{{ $anio->year }}</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h4>Escuela de Arquitectura</h4>
                                    <ul>
                                        <li><a href="/admin/notificar/listado?anio={{$anio->year}}&escuela=arquitectura"><span class="glyphicon glyphicon-list"></span> Generar y ver listado</a></li>
                                        <li><a href="/admin/notificar/enviar?anio={{ $anio->year }}&escuela=arquitectura"><span class="glyphicon glyphicon-send"></span> Notificar a escuela</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h4>Escuela de Diseño Gráfico</h4>
                                    <ul>
                                        <li><a href="/admin/notificar/listado?anio={{$anio->year}}&escuela=diseño"><span class="glyphicon glyphicon-list"></span> Generar y ver listado</a></li>
                                        <li><a href="/admin/notificar/enviar?anio={{ $anio->year }}&escuela=diseño"><span class="glyphicon glyphicon-send"></span> Notificar a escuela</a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
        @endforeach
        </div>

        <div align="center">{!! $anios->render() !!}</div>

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