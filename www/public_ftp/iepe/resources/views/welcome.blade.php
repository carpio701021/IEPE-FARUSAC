@extends('layouts.aspirante-layout')

@section('content')
<div class="container">
    <h1>Bienvenido a la facultad de Arquitectura - USAC</h1>
    <div class="row">
        <div class="col-lg-10">
            <iframe width="100%" height="400px" src="https://www.youtube.com/embed/KhKiyDJ5b_M?version=3&autoplay=1&loop=1&controls=0&playlist=KhKiyDJ5b_M&showinfo=0&theme=light" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <h3>Reglamento</h3>
            <a href="/aspirante/recursos/reglamento" class="btn btn-primary" target="_blank"> <span class="glyphicon glyphicon-download-alt"></span> Ver reglamento</a>

        </div>
        <div class="col-sm-4">
            <h3>Instructivo</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
        </div>
        <div class="col-sm-4">
            <h3>Simulador</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
        </div>
    </div>
</div>
@endsection
