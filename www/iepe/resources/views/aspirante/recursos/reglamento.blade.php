@extends('layouts.aspirante-layout')

@section('content')
    <h1>Reglamento</h1>
    <object data="{{ url('aspirante_public/files/pdf/reglamento/reglamento.pdf') }}"
            type="application/pdf" style="width:100%;height:1000px;">
        <p>Pre visualizacion no disponible en tu navegador.
            <a target="_blank" href="{{ url('aspirante_public/files/pdf/reglamento/reglamento.pdf') }}">Descargar</a>
        </p>
    </object>
@endsection
