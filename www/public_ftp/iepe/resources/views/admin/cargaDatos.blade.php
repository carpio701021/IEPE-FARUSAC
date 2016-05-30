@extends('layouts.admin-user')

@section('content')
<div class="container">
    <h3>Carga de datos</h3>
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-10">
                <input type="path" class="form-control" id="email" placeholder="Enter email">
            </div>
        </div>
        <div class="form-group{{ $errors->has('arte') ? ' has-error' : '' }}">
            {!! Form::label('arte', 'Arte', array('class' => 'col-md-4 control-label')) !!}
            <div class="col-md-6">
                {!! Form::file('arte' , array(
                'accept' =>'image/*'
                )) !!}
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-primary"
                        title="Arte"
                        data-toggle="popover"
                        data-trigger="focus"
                        data-content="Imagen única que se imprime en la constancia de asignación del aspirante.">?</button>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </form>
</div>
@stop
