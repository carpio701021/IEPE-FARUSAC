@extends('layouts.aspirante-layout')

<!-- Main Content -->
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Restablecer contraseña</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ action('Auth\PasswordController@sendResetLink') }}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="email" value="mail@mail.com"/>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Número de orientación vocacional:</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" name="NOV" value="{{ old('NOV') }}" min=1000000000>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-envelope"></i> Enviar enlace para restablecer contraseña
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="alert alert-warning" role="alert">
                <strong>¿Cómo funciona?</strong><br>
                Se te enviará a tu correo un enlace secreto para restablecer tu contraseña. <br>
                Si ya no tienes acceso a tu correo, debes presentarte a la oficina de Bienestar y Desarrollo Estudiantil de la Facultad de Arquitectura o escribenos por medio de la <a href="https://www.facebook.com/BienestaryDesarrolloEstudiantilFarusac" target="_blank">fanpage de facebook</a> para que te sea restablecido tu nuevo correo.
            </div>
        </div>
    </div>
</div>
@endsection
