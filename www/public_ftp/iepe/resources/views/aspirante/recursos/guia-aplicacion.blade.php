@extends('layouts.aspirante-layout')

@section('content')
    <div class="row">
        <div class="col-lg-12" id="central">
            <img id="imgcentral" src="{{ url('aspirante_public/img/guia-aplicacion/'.json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['guia_aplicacion']['imginfo']) }}" style="width:100%;height:auto;" />
        </div>
        <div class="col-sm-3" style="padding: 0 0 0 0;">
            <input type="image" onclick="changeCentral(1);"
                   src="{{ url('aspirante_public/img/guia-aplicacion/'.json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['guia_aplicacion']['imgbtn1']) }}" style="width:100%;height:auto;" />
        </div>
        <div class="col-sm-3" style="padding: 0 0 0 0;">
            <input type="image" onclick="changeCentral(2);"
                   src="{{ url('aspirante_public/img/guia-aplicacion/'.json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['guia_aplicacion']['imgbtn2']) }}" style="width:100%;height:auto;" />
            </button>
        </div>
        <div class="col-sm-3" style="padding: 0 0 0 0;">
            <input type="image" onclick="changeCentral(3);"
                   src="{{ url('aspirante_public/img/guia-aplicacion/'.json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['guia_aplicacion']['imgbtn3']) }}" style="width:100%;height:auto;" />
            </input>
        </div>
        <div class="col-sm-3" style="padding: 0 0 0 0;">
            <input type="image" onclick="changeCentral(4);"
                   src="{{ url('aspirante_public/img/guia-aplicacion/'.json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['guia_aplicacion']['imgbtn4']) }}" style="width:100%;height:auto;" />
            </input>
        </div>
    </div>
    <br /><br /><br />
    <div class="row">
        <div class="col-lg-12" id="central">
            {!! json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['guia_aplicacion']['enlaces_ayuda'] !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        video = [];
        video[1] = "https://www.youtube.com/embed/{{ json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['guia_aplicacion']['enlace1'] }}?version=3&autoplay=1&loop=1&controls=0&playlist={{ json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['guia_aplicacion']['enlace1'] }}&showinfo=0&theme=light";
        video[2] = "https://www.youtube.com/embed/{{ json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['guia_aplicacion']['enlace2'] }}?version=3&autoplay=1&loop=1&controls=0&playlist={{ json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['guia_aplicacion']['enlace2'] }}&showinfo=0&theme=light";
        video[3] = "https://www.youtube.com/embed/{{ json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['guia_aplicacion']['enlace3'] }}?version=3&autoplay=1&loop=1&controls=0&playlist={{ json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['guia_aplicacion']['enlace3'] }}&showinfo=0&theme=light";
        video[4] = "https://www.youtube.com/embed/{{ json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['guia_aplicacion']['enlace4'] }}?version=3&autoplay=1&loop=1&controls=0&playlist={{ json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['guia_aplicacion']['enlace4'] }}&showinfo=0&theme=light";
        function changeCentral(num){
            iframe = '<iframe width="100%" height="400px" src="'+video[num]+'" frameborder="0" allowfullscreen></iframe>';
            document.getElementById("central").innerHTML = iframe;
        }
    </script>
@endsection
