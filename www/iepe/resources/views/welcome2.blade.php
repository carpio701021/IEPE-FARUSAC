@extends('layouts.aspirante-layout')
@section('styles')
    <link rel='stylesheet' href="{{ url('aspirante_public/css/quill.snow.css') }}">
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12  ql-editor">
            {!! dump($respuesta) !!}
        </div>
    </div>
@endsection
