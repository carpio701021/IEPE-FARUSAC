@extends('layouts.aspirante-layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 iepe-img">
            <img src="{{ url('/aspirante_public/img/'.json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['imagen_informativa']) }}" />
        </div>
    </div>
@endsection
