@extends('layouts.aspirante-layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <img id="imgcentral" src="{{ url('img/guia-aplicacion/gainfo.gif') }}" style="width:100%;height:auto;" />
        </div>
        <div class="col-sm-3" style="padding: 0 0 0 0;">
            <a onclick="changeCentral(1);">
                <img src="{{ url('img/guia-aplicacion/gabtn1.png') }}" style="width:100%;height:auto;" />
            </a>
        </div>
        <div class="col-sm-3" style="padding: 0 0 0 0;">
            <a onclick="changeCentral(2);">
                <img src="{{ url('img/guia-aplicacion/gabtn2.png') }}" style="width:100%;height:auto;" />
            </a>
        </div>
        <div class="col-sm-3" style="padding: 0 0 0 0;">
            <a onclick="changeCentral(3);">
                <img src="{{ url('img/guia-aplicacion/gabtn3.png') }}" style="width:100%;height:auto;" />
            </a>
        </div>
        <div class="col-sm-3" style="padding: 0 0 0 0;">
            <a onclick="changeCentral(4);">
                <img src="{{ url('img/guia-aplicacion/gabtn4.png') }}" style="width:100%;height:auto;" />
            </a>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function changeCentral(num){

            imgcentral.src='/img/guia-aplicacion/animacion_'+num+'.gif';
        }
    </script>
@endsection
