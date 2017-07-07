@extends('layouts.aspirante-layout')

@section('content')
    <div class="container-fluid text-center">
            <img src="{{ url('/aspirante_public/img/'.json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['imagen_informativa']) }}" />
    </div>
@endsection
