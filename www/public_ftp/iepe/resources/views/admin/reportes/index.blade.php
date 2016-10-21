@extends('layouts.admin-user')

@section('content')
    <h1>Reportes de aplicaciones</h1>
    <div class="jumbotron">
        <div class="container">
            <p>Sistema de Asignación de Pruebas Específicas</p>
            <a class="btn btn-primary" href="{{ action('reportesController@reporteGeneral') }}">Descargar reporte general</a>
        </div>
    </div>
@endsection
