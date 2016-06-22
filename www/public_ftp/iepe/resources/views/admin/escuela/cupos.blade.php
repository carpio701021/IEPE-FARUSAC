@extends('layouts.admin-user')

@section('content')
    <div class="container">
        <h2>Primer Ingreso -
            @if(Auth::guard('admin')->user()->tieneRol('director_arquitectura'))
                Arquitectura
            @elseif(Auth::guard('admin')->user()->tieneRol('director_disenio_grafico'))
                Diseño Gráfico
            @endif
        </h2>
        @include('layouts.mensajes')


        <br>

        <div class="panel-group">
        @foreach ($anios as $anio)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapse_{{ $anio->year }}"><b>{{ $anio->year }}</b></a>
                        </h4>
                    </div>
                    <div id="collapse_{{ $anio->year }}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>Listado de aspirantes aprobados</h4>
                                    <button class="btn btn-primary">Descargar</button>
                                </div>
                                <div class="col-md-4">
                                    <h4>Jornada Matutina</h4>

                                        <div class="row">
                                            <div class="col-md-6"><b>Cupo:</b></div>
                                            <div class="col-md-6"> -</div>
                                        </div>

                                    <br>
                                    <form class="form-horizontal" action="/admin/escuela/primerIngreso/guardarCupo" method="post">
                                        {{csrf_field()}}
                                        @if(Auth::guard('admin')->user()->tieneRol('director_arquitectura'))
                                            <input type="hidden" name="carrera" value="arquitectura">
                                        @elseif(Auth::guard('admin')->user()->tieneRol('director_disenio_grafico'))
                                            <input type="hidden" name="carrera" value="disenio">
                                        @endif
                                        <input type="hidden" name="jornada" value="matutina">
                                        <input type="hidden" name="anio" value="{{$anio->year}}">
                                        <div class="form-group">
                                                <div class="col-md-6">
                                                    <input class="form-control" type="number" min="0" name="cantidad">
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-default">Guardar Cupo</button>
                                                </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                    <h4>Jornada Vespertina</h4>
                                    <div class="row">
                                        <div class="col-md-6"><b>Cupo:</b></div>
                                        <div class="col-md-6"> -</div>
                                    </div>

                                    <br>
                                    <form class="form-horizontal" action="/admin/escuela/primerIngreso/guardarCupo" method="post">
                                        {{csrf_field()}}
                                        @if(Auth::guard('admin')->user()->tieneRol('director_arquitectura'))
                                            <input type="hidden" name="carrera" value="arquitectura">
                                        @elseif(Auth::guard('admin')->user()->tieneRol('director_disenio_grafico'))
                                            <input type="hidden" name="carrera" value="disenio">
                                        @endif
                                        <input type="hidden" name="jornada" value="vespertina">
                                        <input type="hidden" name="anio" value="{{$anio->year}}">
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <input class="form-control" type="number" min="0" name="cantidad">
                                            </div>
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-default">Guardar Cupo</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
        @endforeach
        </div>

        <div align="center">{!! $anios->render() !!}</div>

    </div>

@endsection

@section('scripts')
<script>
    $(function () {
        $('.fecha').each(function(i, obj) {
            fechaO = obj.innerHTML;
            //alert(fechaO);
            obj.innerHTML = moment(fechaO,'YYYY-MM-DD').format('D [de] MMMM [del] YYYY');
            //obj.innerHTML = moment(fechaO).format('L');
        });
    });
</script>
@endsection