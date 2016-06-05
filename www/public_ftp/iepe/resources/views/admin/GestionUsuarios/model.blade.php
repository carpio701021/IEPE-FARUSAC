@extends('layouts.admin-user')

@section('content')

    <div class="container">
        <h2>{{ $titulo or 'Nuevo usuario administrativo' }}</h2>

        @include('layouts.mensajes')

        {!! Form::model(
            $admin,
            array('route' => array('admin.usuarios.update', $admin->registro_personal),
            'class' => 'form-horizontal', 'role' => 'form', 'method'=> ((isset($put))?'PUT':'POST')
        ) ) !!}


        <div class="form-group{{ $errors->has('registro_personal') ? ' has-error' : '' }}">
            {!! Form::label('registro_personal', 'Número de registro personal:*', array('class' => 'col-md-4 control-label')) !!}
            <div class="col-md-6">
                {!! Form::number('registro_personal' , null , array(
                'class' => 'form-control',
                'placeholder' => 'Código de trabajador',
                'required' => 'true',
                )) !!}
            </div>
        </div>

        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
            {!! Form::label('nombre', 'Nombres:*', array('class' => 'col-md-4 control-label')) !!}
            <div class="col-md-6">
                {!! Form::text('nombre' , null , array(
                'class' => 'form-control',
                'placeholder' => 'Ejemplo: Juan José',
                'required' => 'true',
                )) !!}
            </div>
        </div>

        <div class="form-group{{ $errors->has('apellido') ? ' has-error' : '' }}">
            {!! Form::label('apellido', 'Apellidos*', array('class' => 'col-md-4 control-label')) !!}
            <div class="col-md-6">
                {!! Form::text('apellido' , null , array(
                'class' => 'form-control',
                'placeholder' => 'Ejemplo: López Herrera',
                'required' => 'true',
                )) !!}
            </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            {!! Form::label('email', 'Correo electrónico*', array('class' => 'col-md-4 control-label')) !!}
            <div class="col-md-6">
                {!! Form::email('email' , null , array(
                'class' => 'form-control',
                'placeholder' => 'Ejemplo: micorreo@farusac.edu.gt',
                'required' => 'true',
                )) !!}
            </div>
        </div>

        <div class="form-group{{ $errors->has('rol') ? ' has-error' : '' }}">
            {!! Form::label('rol', 'Rol*', array('class' => 'col-md-4 control-label')) !!}
            <div class="col-md-6">
                {!! Form::select('rol' , $admin->posiblesRoles() ,null, array(
                'class' => 'form-control',
                'placeholder' => 'Seleccione un rol',
                'required' => 'true',
                )) !!}
            </div>

        </div>
        <div class="form-group">
        <p class="col-md-offset-4">*Si deja los campos de contraseña vacios no se cambiará la contraseña actual</p>
        </div>
        {{-- @if( !isset($put)) --}}
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            {!! Form::label('password', 'Contraseña', array('class' => 'col-md-4 control-label')) !!}
            <div class="col-md-6">
                {!! Form::password('password' , array(
                'class' => 'form-control',
                'placeholder' => 'mínimo 6 caracteres',
                )) !!}
            </div>
        </div>
        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            {!! Form::label('password_confirmation', 'Confirme la contraseña', array('class' => 'col-md-4 control-label')) !!}
            <div class="col-md-6">
                {!! Form::password('password_confirmation' , array(
                'class' => 'form-control',
                'placeholder' => 'mínimo 6 caracteres',
                )) !!}
            </div>
        </div>
        {{-- @endif --}}

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    <i class="glyphicon glyphicon-floppy-disk"></i> Guardar
                </button>
            </div>
        </div>


        {!! Form::close() !!}

        <br><br>



    </div>

@endsection

@section('scripts')

    <script type="text/javascript">


    </script>
@endsection