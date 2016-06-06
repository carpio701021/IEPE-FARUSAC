@extends('layouts.admin-user')

@section('content')
    <div class="container">
        @include('layouts.mensajes')
        <h3>Subir Resultados - {{$aplicacion->nombre}}</h3>
        <form class="form-horizontal" role="form" action="/admin/aplicacion/subirResultados/{{$aplicacion->id}}" method="Post" accept-charset="UTF-8" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">
            <div class="panel panel-default">
                <div class="panel-heading">Cargar archivo con resultados</div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="container">
                            <label class="btn btn-default btn-file" onclick="cancelarFile()">
                                Seleccionar archivo...
                                {!! Form::file('file' , array(
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


    <div class="container">
        <h3>Resultados</h3>
        <p>Estos resultados deben ser aprobados por x y z para que sean publicados a los aspirantes</p>
        <table class="table">
            <thead>
            <tr>
                <th>No. Orientación</th>
                <th>RA</th>
                <th>APE</th>
                <th>RV</th>
                <th>APN</th>
                <th>Resultado</th>
            </tr>
            </thead>
            <tbody>
            <tr class="success">
                <td>1234567890</td>
                <td>78</td>
                <td>80</td>
                <td>62</td>
                <td>75</td>
                <td>Aprobado</td>
            </tr>
            <tr class="danger">
                <td>1234567777</td>
                <td>34</td>
                <td>70</td>
                <td>21</td>
                <td>35</td>
                <td>Reprobado</td>
            </tr>
            <tr class="warning">
                <td>9876542223</td>
                <td>100</td>
                <td>100</td>
                <td>100</td>
                <td>100</td>
                <td>Anómalo</td>
            </tr>
            </tbody>
        </table>
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



@section('scripts')

@endsection