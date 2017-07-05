@extends('layouts.aspirante-layout')

@section('content')

    <p class="text-right iepe-logform-message" style="margin-top: -25px">Si ya estas registrado prueba <a href="{{ action('Auth\PasswordController@showResetForm') }}">recuperar contraseña</a>.</p>

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

    <br/><br/><br/>

    <div class="row iepe-logform">
        <div class="col-sm-3 col-sm-offset-2">
            <div class="container-fluid">
                <img src="{{ url('aspirante_public/img/aspirante_title.png') }}" />
                <h4>REGÍSTRATE</h4>
                <br/>

            </div>

        </div>

        <div class="col-sm-3 col-sm-offset-1">

            <form class="form-horizontal" role="form" method="POST" action="{{ action('Auth\AuthController@register') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('NOV') ? ' has-error' : '' }}">
                    <input type="text" class="form-control" name="NOV" value="{{ old('orientacionV') }}" placeholder="No. Orientación Vocacional">
                    @if ($errors->has('NOV'))
                        <span class="help-block">
                            <strong>{!! $errors->first('NOV') !!}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo Electrónico">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{!! $errors->first('email') !!}</strong>
                                    </span>
                        @endif
                </div>


                <div class="form-group{{ $errors->has('email_confirmation') ? ' has-error' : '' }}">
                        <input type="email" class="form-control" name="email_confirmation" value="{{ old('email_confirmation') }}"  autocomplete="off" oncopy="return false" oncut="return false" onpaste="return false" placeholder="Confirmar Correo Electrónico">
                        @if ($errors->has('email_confirmation'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email_confirmation') }}</strong>
                                    </span>
                        @endif
                </div>

                <div class="form-group{{ $errors->has('fecha_nac') ? ' has-error' : '' }}">

                        <select name="fecha_nac[]" style="width:20%" required>
                            <option disabled selected>Día nacimiento</option>
                            @for($i=1;$i<=31;$i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>&nbsp;/&nbsp;
                        <select name="fecha_nac[]" style="width:20%" required>
                            <option disabled selected>Mes nacimiento</option>
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
                        </select>&nbsp;/&nbsp;
                        <input type="number" style="width:40%" min="{{ date('Y') - 70 }}" max="{{ date('Y') - 10 }}" name="fecha_nac[]" placeholder=" Año nacimiento" required>

                        @if ($errors->has('email_confirmation'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email_confirmation') }}</strong>
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

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <input type="password" class="form-control" name="password_confirmation"  autocomplete="off" placeholder="Confirmar Contraseña">

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                        @endif
                </div>

                        <button type="submit" class="btn iepe-btn">Registrarme</button>
            </form>

        </div>

    </div>



@endsection
