@extends('layouts.aspirante-layout')

@section('content')

    <p class="text-right iepe-logform-message">¿Aún no te has registrado? <a href="{{ action('Auth\AuthController@showRegistrationForm') }}">Regístrate</a></p>

    <div class="row iepe-logform">
        <div class="col-sm-3 col-sm-offset-4">


            @if (Session::has('status'))
                <div class="alert alert-success">
                    {{ Session::get('status') }}
                </div>
            @endif

            <div class="container-fluid">
                <img src="{{ url('aspirante_public/img/aspirante_title.png') }}" />
                <h4>INICIA SESIÓN</h4>
                <br/>

            </div>

            <form class="form-horizontal" role="form" method="POST" action="{{ action('Auth\AuthController@login') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('NOV') ? ' has-error' : '' }}">
                    <input type="text"  class="form-control" name="NOV" value="{{ old('NOV') }}" placeholder="No. Orientación Vocacional">
                    @if ($errors->has('NOV'))
                        <span class="help-block">
                            <strong>{{ $errors->first('NOV') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" name="password" placeholder="Contraseña">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <br/>

                <button type="submit" class="btn iepe-btn">Ingresar</button>
                <br/><br/>

                <p class="iepe-logform-message">¿Olvidaste tu contraseña? <a class="" href="{{ action('Auth\PasswordController@showResetForm') }}">Click Aquí</a></p>

            </form>

        </div>
    </div>


@endsection
