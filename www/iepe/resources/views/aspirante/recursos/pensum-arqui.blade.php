@extends('layouts.aspirante-layout')

@section('content')

    <div>
        <div class="row iepe-info-container">

            <div class="col-lg-5">
                <img src="{{ url('aspirante_public/img/arquitectura_title.png') }}" />
                <p>La Arquitectura es una profesión de carácter artístico, social y tecnológico, cuyo objeto es producir espacios utilitarios y estéticos para desarrollar confortablemente las actividades que realiza el ser humano.</p>
                <a class="btn btn-lg iepe-btn-lg" target="_blank" href="{{ url('aspirante_public/files/pdf/PensumArqui.pdf') }}">Pensum</a>
                <br /><br />
            </div>
            <div class="col-lg-7">
                <div class="col-lg-12 video-container">
                    <iframe src="https://www.youtube.com/embed/{{ json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['carreras']['video_arqui'] }}?version=3&autoplay=1&loop=1&controls=0&playlist={{ json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['carreras']['video_arqui'] }}&showinfo=0&theme=light" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-lg-12"><br/><br/>
            </div>
            <div class="col-lg-2 text-right">
                <p><span class="sub-title">Duración: </span></p>
            </div>
            <div class="col-lg-4 text-left">
                <p>5 años más 6 meses de Ejercicio de Práctica Supervisada -EPS-.</p>
            </div>
            <div class="col-lg-2 text-right">
                <p><span class="sub-title">Horarios: </span></p>
            </div>
            <div class="col-lg-4 text-left">
                <p>Jornada Matutina de 7:00 a 13:00<br/>
                    Jornada Vespertina de 14:00 a 20:00<br/>
                    <b>Lunes a Viernes</b></p>
            </div>

        </div>



    </div>

@endsection
