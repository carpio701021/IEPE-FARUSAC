@extends('layouts.aspirante-layout')

@section('content')
<div class="container">
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
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
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
                                <input type="email" class="form-control" name="email_confirmation" value="{{ old('email_confirmation') }}"  autocomplete="off">

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
                                    @for($i=1;$i<=12;$i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
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
        </div>



    </div>
</div>
@endsection
