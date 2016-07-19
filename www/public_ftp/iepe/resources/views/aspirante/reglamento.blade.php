@extends('layouts.aspirante-layout')

@section('content')
    <object data="{{ url('files/pdf/reglamento/reglamento.pdf') }}"
            type="application/pdf" style="width:100%;height:1000px;">
        <p>Pre visualizacion no disponible en tu navegador.
            <a target="_blank" href="{{ url('files/pdf/reglamento/reglamento.pdf') }}">Descargar</a>
        </p>
    </object>
@endsection
