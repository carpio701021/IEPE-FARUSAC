@extends('layouts.admin-user')

@section('content')
    @include('layouts.mensajes')
    <div class="container">
        <h1>Actas - {{$aplicacion->nombre()}}</h1>
        @foreach($actas as $acta)
            <ul>
            <a href="{{ action('ActaController@show',['acta'=> $acta->id ]) }}" target="_blank">Acta No. {{$acta->id}}</a>
            </ul>
        @endforeach
    </div>


@stop

@section('scripts')


@stop


