@extends('layouts.aspirante-layout')

@section('content')

    @if (Session::has('status'))
        <div class="alert alert-success">
            {{ Session::get('status') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Ingreso</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ action('Auth\AuthController@login') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('NOV') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Número de Orientación Vocacional</label>

                            <div class="col-md-6">
                                <input type="text"  class="form-control" name="NOV" value="{{ old('NOV') }}">

                                @if ($errors->has('NOV'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('NOV') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Recordarme
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">

                                <button type="submit" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-log-in"></i> Ingresar
                                </button>

                                <a class="btn btn-link" href="{{ action('Auth\PasswordController@showResetForm') }}">¿Olvidaste tu contraseña?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
