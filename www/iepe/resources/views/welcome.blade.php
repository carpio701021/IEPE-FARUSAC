@extends('layouts.aspirante-layout')
@section('styles')
    <link rel='stylesheet' href="{{ url('aspirante_public/css/quill.snow.css') }}">
@stop

@section('content')
    {{--
    <div class="container-fluid">
        <div class="col-lg-12  ql-editor iepe-img">
            {!! json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['bienvenida'] !!}
        </div>
    </div>
    --}}


<div class="container">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox" >
            <?php $iterador = 0; ?>
            @foreach(json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['inicio']['carousel'] as $imgCarousel)

                <div class="item iepe-img<?php echo (($iterador==0)? " active":"") ?> " >
                    <img class="img-responsive center-block" src="{{$imgCarousel}}" alt="{{"img".$iterador}}">
                    <div class="carousel-caption">
                        {{--"img".$iterador--}}
                    </div>
                </div>

                <?php $iterador += 1; ?>
            @endforeach
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-6 iepe-img">
            <a href="{{ action('RecursosController@getPensumDisenio') }}"><img src="{{ json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['inicio']['disenio'] }}" alt="imgDisenio"></a>
        </div>
        <div class="col-lg-6 iepe-img">
            <a href="{{ action('RecursosController@getPensumArqui') }}"><img src="{{ json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['inicio']['arqui'] }}" alt="imgArqui"></a>
        </div>
    </div>
</div>

@endsection
