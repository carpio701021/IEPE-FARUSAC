@extends('layouts.admin-user')

@section('content')
<div class="container">
    @include('layouts.mensajes')
    <h3>Carga de datos</h3>
    <form class="form-horizontal" role="form" action="{{ action('DatosController@store') }}" method="Post" accept-charset="UTF-8" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="panel panel-default">
            <div class="panel-heading">Cargar datos provistos por el SUN</div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="container">
                        <label class="btn btn-default btn-file" onclick="cancelarFile()">
                            Seleccionar archivo...
                            {!! Form::file('datos_sun' , array(
                            'style' =>'display:none',
                            'onchange'=> "cambiar_archivo()",
                            'id' => 'file'
                            )) !!}

                        </label>
                        <label class="control-label" id="labelfile">No se ha seleccionado ningun archivo</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-6">
                        <button type="submit" class="btn btn-primary">Cargar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@stop

@section('scripts')
    <script type="text/javascript">

        function cancelarFile(){
            file.value=null;
        }
        function cambiar_archivo() {
            labelfile.innerHTML=file.value;
        }
    </script>
@stop