@extends('layouts.aspirante-layout')

@section('content')

    <div>
        <div class="row iepe-info-container">

            <div class="col-lg-5">
                <img src="{{ url('aspirante_public/img/Disenio_grafico_title.png') }}"  style="max-width: 100%;height: auto;"/>
                <p>El Diseño Gráfico es una profesión de carácter artístico, científico y tecnológico, cuyo objeto es la comunicación visual.</p>
                <a class="btn btn-lg iepe-btn-lg" target="_blank" href="{{ url('aspirante_public/files/pdf/PensumDisenio.pdf') }}">Pensum</a>
                <br /><br />
            </div>
            <div class="col-lg-7">
                <div class="col-lg-12 video-container">
                    <iframe src="https://www.youtube.com/embed/{{ json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['carreras']['video_disenio'] }}?version=3&autoplay=1&loop=1&controls=0&playlist={{ json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['carreras']['video_arqui'] }}&showinfo=0&theme=light" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-lg-12"><br/><br/>
            </div>
            <div class="col-lg-2 text-right">
                <p><span class="sub-title">Duración: </span></p>
            </div>
            <div class="col-lg-4 text-left">
                <p>Cinco años incluyendo Práctica Profesional en el quinto ciclo y el Ejercicio de Práctica Supervisada -EPS- en el noveno ciclo.</p>
            </div>
            <div class="col-lg-2 text-right">
                <p><span class="sub-title">Horarios: </span></p>
            </div>
            <div class="col-lg-4 text-left">
                <p>Jornada Matutina de 7:00 a 13:00<br/>
                    Jornada Vespertina de 15:30 a 20:00<br/>
                    <b>Lunes a Viernes</b></p>
            </div>

        </div>



    </div>

@endsection
