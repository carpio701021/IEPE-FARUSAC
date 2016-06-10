@extends('layouts.admin-user')

@section('content')
    @include('layouts.mensajes')
    <div class="container">
        <h1>Actas - {{$aplicacion->nombre}}</h1>
        @foreach($actas as $acta)
            <a href="/admin/aplicacion/acta/{{$acta->id}}" target="_blank">Acta No. {{$acta->id}}</a>
        @endforeach
    </div>


@stop

@section('scripts')


@stop


