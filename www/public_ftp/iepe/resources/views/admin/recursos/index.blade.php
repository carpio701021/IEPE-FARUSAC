@extends('layouts.admin-user')

@section('content')
<div class="container">
    @include('layouts.mensajes')
    <h3>Administrar recursos para aspirantes</h3>
    <form class="form-horizontal" role="form" action="/admin/recursos/reglamento" method="Post" accept-charset="UTF-8" enctype="multipart/form-data">
        <div class="panel panel-default">
            <div class="panel-heading">Reglamento</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <a href="/admin/recursos/reglamento" class="btn btn-default" target="_blank">Ver reglamento actual</a>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="container">
                                {{csrf_field()}}
                                <label class="btn btn-default btn-file" onclick="cancelarFile()">
                                    Seleccionar archivo...
                                    {!! Form::file('reglamento' , array(
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