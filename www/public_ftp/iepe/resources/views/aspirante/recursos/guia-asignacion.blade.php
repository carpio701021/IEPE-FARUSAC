@extends('layouts.aspirante-layout')

@section('content')
    <h1>Guía de asignación a la prueba específica</h1>
    <div class="row">
        <div class="col-lg-12">
            <iframe width="100%" height="400px" src="{{ json_decode(file_get_contents(public_path().'/recursos.json'),TRUE)['video_guia_asignacion'] }}" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
@endsection
