@extends('layouts.aspirante-layout')

@section('content')
    <h1>Guía de asignación a la prueba específica</h1>
    <div class="row">
        <div class="col-lg-12">
            <iframe width="100%" height="400px" src="https://www.youtube.com/embed/{{ json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['video_guia_asignacion'] }}?version=3&autoplay=1&loop=1&controls=0&playlist={{ json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['video_guia_asignacion'] }}&showinfo=0&theme=light" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
@endsection
