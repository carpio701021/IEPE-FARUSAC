@extends('layouts.aspirante-layout')


@section('content')
    
<div class="container">
<br /><br /><br />
<h1>Ups!</h1>
<h2 style='text-align: center'>Ocurrió un error inesperado :(  </h2>
<h2 style='text-align: center'>Vuele a intentarlo desde el inicio o más tarde.</h2>
<p style='text-align: center'>
    <small>Si el problema persiste contacta con Bienestar y Desarrollo Estudiantil de la Facultad de Arquitectura</small>
</p>

    <p>{{!! $exception or '' !!}}</p>

</div>

@endsection
