@extends('layouts.aspirante-layout')

@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registro</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ action('Auth\AuthController@register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('NOV') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Número de orientación vocacional*</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="NOV" value="{{ old('orientacionV') }}">

                                @if ($errors->has('NOV'))
                                    <span class="help-block">
                                        <strong>{!! $errors->first('NOV') !!}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Correo electrónico*</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{!! $errors->first('email') !!}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('email_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Confirmar correo electrónico*</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email_confirmation" value="{{ old('email_confirmation') }}"  autocomplete="off" oncopy="return false" oncut="return false" onpaste="return false">

                                @if ($errors->has('email_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('fecha_nac') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Fecha de nacimiento*</label>

                            <div class="col-md-6">
                                <select name="fecha_nac[]" required>
                                    <option disabled selected>día</option>
                                    @for($i=1;$i<=31;$i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>/
                                <select name="fecha_nac[]" required>
                                    <option disabled selected>mes</option>
                                    <option value="1">enero</option>
                                    <option value="2">febrero</option>
                                    <option value="3">marzo</option>
                                    <option value="4">abril</option>
                                    <option value="5">mayo</option>
                                    <option value="6">junio</option>
                                    <option value="7">julio</option>
                                    <option value="8">agosto</option>
                                    <option value="9">septiembre</option>
                                    <option value="10">octubre</option>
                                    <option value="11">noviembre</option>
                                    <option value="12">diciembre</option>
                                </select>/
                                <input type="number" min="{{ date('Y') - 70 }}" max="{{ date('Y') - 10 }}" name="fecha_nac[]" placeholder="año" required>

                                @if ($errors->has('email_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Contraseña*</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Confirmar contraseña*</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation"  autocomplete="off">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-user"></i> Registrarme
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="alert alert-warning" role="alert">
                Si ya estas registrado prueba <a href="{{ action('Auth\PasswordController@showResetForm') }}">recuperar contraseña</a>.
            </div>
        </div>



    </div>

@endsection
