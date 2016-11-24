@extends('layouts.formulario-layout')

@section('content')


    <form id="msform" class="form-horizontal" role="form" action="{{ action('formularioController@storeCUI') }}" method="POST">

        <fieldset class="form-horizontal">
            <h2 class="fs-title">Actualización de datos</h2>
                <label>{{Auth::user()->getNombreCompleto()}}</label>
                <div class="form-group{{ $errors->has('CUI') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">CUI:</label>
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="CUI" value="{{old('CUI')}}"
                               placeholder="Código único de identificación"/>
                    </div>
                </div>
            <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
            <input type="submit" class="next action-button" value="Finalizar"/>
        </fieldset>
        <br />
        <br />
        <p><a href="http://www.prensalibre.com/economia/cui-genera-alta-expectativa">¿Qué es el CUI? Click aquí</a></p>
    </form>

@stop




@section('scripts')
    <script src="{{ url('aspirante_public/js/jquery.easing.1.3.js') }}" type="text/javascript"></script>
    <script src="{{ url('aspirante_public/js/multistep.js') }}" type="text/javascript"></script>

@endsection
