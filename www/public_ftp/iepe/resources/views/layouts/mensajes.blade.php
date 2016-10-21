@if ($errors->any())
    <div class="container">
        <div class="alert alert-danger  fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        @foreach ($errors->all() as $n => $error)
                * {!! $error !!} <br>
        @endforeach
        </div>
    </div>
@endif

@if (Session::has('mensaje_exito'))
    <div class="container">
        <div class="alert alert-success fade in" id="alert_message">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Hecho: </strong> {!! Session::get('mensaje_exito') !!}
        </div>
    </div>

    {{--<script>
        window.setTimeout(function () { // hide alert message
            $("#alert_message").alert('close');
        }, 7000);//milisegundos
    </script>--}}

@endif