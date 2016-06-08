@extends('layouts.admin-user')

@section('content')
    @include('layouts.mensajes')
    <div class="container">
        <h3>Aspirante aprobados - {{$aplicacion->nombre}}</h3>

        <div class="container">
            <h3>Resultados</h3>
            <p>Estos resultados deben ser aprobados por x y z para que sean publicados a los aspirantes</p>
            <table class="table">
                <thead>
                <tr>
                    <th>No. Orientación</th>
                    <th>RA</th>
                    <th>APE</th>
                    <th>RV</th>
                    <th>APN</th>
                    <th>Resultado</th>
                </tr>
                </thead>
                <tbody>
                @foreach($asignaciones as $a)
                     @if($a->resultado=='aprobado') <tr class="success">
                        @elseif($a->resultado=='reprobado') <tr class="danger">
                            @else <tr class="warning">
                        @endif
                        <td>{{$a->aspirante_id}}</td>
                        <td>{{$a->nota_RA}}</td>
                        <td>{{$a->nota_APE}}</td>
                        <td>{{$a->nota_RV}}</td>
                        <td>{{$a->nota_APN}}</td>
                        <td>{{$a->resultado}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>



@stop

@section('scripts')

@stop


