@extends('layouts.aspirante-layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <img width="100%" src="{{ json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['imagen_informativa'] }}" />
        </div>
    </div>
@endsection
