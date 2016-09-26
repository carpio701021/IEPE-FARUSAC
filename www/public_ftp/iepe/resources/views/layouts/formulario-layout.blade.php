<!DOCTYPE html>
<html lang="es">
<head>
    <title>Específicas - FARUSAC</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="/estudiante/images/icono.ico" type="image/x-icon">
    <link rel='stylesheet' href="{{ url('aspirante_public/css/googlefonts-css-latio.css') }}" type='text/css'>
    <link rel="stylesheet" href="{{ url('aspirante_public/css/aspirante.css') }}">
    <link rel="stylesheet" href="{{ url('aspirante_public/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('aspirante_public/css/simple-sidebar.css') }}">
    <link rel="stylesheet" href="{{ url('aspirante_public/css/bootstrap-datetimepicker.min.css') }}">

    <style>
        body {
            font-family: 'Lato';
        }
    </style>

</head>
<body>
@if($errors->any())
    <div class="container">
    <div class="alert alert-danger fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        @foreach ($errors->all() as $error)
            <strong>Error: </strong> {{$error}}<br/>
        @endforeach
    </div>
    </div>
    @endif
@yield('content')


<!-- JavaScripts -->
    <script src="{{ url('aspirante_public/js/jquery.min.js') }}"></script>
    <script src="{{ url('aspirante_public/js/moment.js') }}"></script>
    <script src="{{ url('aspirante_public/js/bootstrap.min.js') }}"></script>

    <script src="{{ url('aspirante_public/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('aspirante_public/js/locale/es.js') }}" type="text/javascript"></script>

<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
@section('scripts')
@show

</body>
</html>

