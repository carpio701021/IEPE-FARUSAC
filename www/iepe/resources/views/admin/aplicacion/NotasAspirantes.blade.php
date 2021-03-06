@extends('layouts.admin-user')

@section('content')
    @include('layouts.mensajes')
    <div class="container">
        <div class='btn-toolbar pull-right'>
            <br>
            <div class='btn-group'>
                <a href="javascript:history.go(-1);" class="btn btn-default">
                    <i class="glyphicon glyphicon-arrow-left"></i> Regresar
                </a>
            </div>
        </div>
        <h3>Aspirantes Aprobados - {{$aplicacion->nombre()}}</h3>

        <div class="container">
            <h3>Resultados</h3>
            <div class="panel panel-default">
                <div class="panel-heading">Ordenar por</div>
                <form role="form" method="get" action="{{ action('AplicacionController@show',['aplicacion'=>$aplicacion->id]) }}">
                    {{csrf_field()}}
                    <div class="panel-body">
                        <div class="col-sm-6">
                            <label class="radio-inline">
                                <input type="radio" value="0" name="orden" @if($ob==0)checked=""@endif>Asignacion
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="1" name="orden" @if($ob==1)checked=""@endif >Orientacion
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="2" name="orden"@if($ob==2)checked=""@endif >RA
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="3" name="orden" @if($ob==3)checked=""@endif>APE
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="4" name="orden" @if($ob==4)checked=""@endif>RV
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="5" name="orden" @if($ob==5)checked=""@endif>APN
                            </label>
                        </div>
                        <div class="col-sm-6" align="right">
                            <button type="submit" class="btn btn-default">Ordenar</button>
                        </div>
                    </div>
                </form>
            </div>
            <p>Estos resultados deben ser aprobados por el Decano y el Secretario para que sean publicados a los aspirantes</p>
            <table class="table">
                <thead>
                <tr>
                    <th>No. @if($ob==0)<span class="glyphicon glyphicon-arrow-down"></span>@endif</th>
                    <th>No. Orientación @if($ob==1)<span class="glyphicon glyphicon-arrow-down"></span>@endif</th>
                    <th>RA @if($ob==2)<span class="glyphicon glyphicon-arrow-down"></span>@endif</th>
                    <th>APE @if($ob==3)<span class="glyphicon glyphicon-arrow-down"></span>@endif</th>
                    <th>RV @if($ob==4)<span class="glyphicon glyphicon-arrow-down"></span>@endif</th>
                    <th>APN @if($ob==5)<span class="glyphicon glyphicon-arrow-down"></span>@endif</th>
                    <th>Resultado</th>
                </tr>
                </thead>
                <tbody>
                @foreach($asignaciones as $a)
                     @if($a->resultado=='aprobado') <tr class="success">
                        @elseif($a->resultado=='reprobado') <tr class="danger">
                            @else <tr class="warning">
                        @endif
                         <td>{{$a->id}}</td>
                        <td>{{$a->aspirante_id}}</td>
                        <td>{{$a->nota_RA}}</td>
                        <td>{{$a->nota_APE}}</td>
                        <td>{{$a->nota_RV}}</td>
                        <td>{{$a->nota_APN}}</td>
                        <td>{{$a->resultado}}</td>
                         <td>
                         <form class="form" action="{{ action('AspiranteAplicacionController@cambiarIrregularAprobado',['aspirante_aplicacion_id'=>$a->id]) }}" method="post">
                             {{csrf_field()}}
                            @if($a->resultado=='aprobado')
                                <input type="hidden" name="resultado" value="irregular">
                                 <button class="btn btn-sm btn-warning" type="submit">Irregular</button>
                            @elseif($a->resultado=='irregular')
                                 <input type="hidden" name="resultado" value="aprobado">
                                 <button class="btn btn-sm btn-success" type="submit">Aprobado</button>
                            @endif
                         </form>
                         </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="container">
                <div class="col-sm-6">
                    <h4> <strong> Total aprobados: {{$aplicacion->getCountAprobadosNuevaActa()}} </strong></h4>
                </div>
                <div class="col-sm-6" align="right">
                    <!--<a href="/admin/aplicacion/acta/{{$aplicacion->id}}/irregular" class="btn btn-warning" target="_blank">
                        Exportar pdf con calificaciones irregulares
                    </a>-->
                    <a href="{{ action('AplicacionController@getCrearEspecial',['aplicacion_id'=>$aplicacion->id]) }}" class="btn btn-warning" target="_blank">
                        Convocar aspirantes irregulares a una aplicación especial
                    </a>
                    <form role="form" action="{{ action('ActaController@store') }}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="aplicacion_id" value="{{$aplicacion->id}}"/>
                        <input type="hidden" name="estado" value="propuesta"/>
                        <button type="submit" class="btn btn-primary">Generar propuesta de acta</button>
                    </form>
                </div>
            </div>
            {{$asignaciones->appends(['orden'=>$ob])->links()}}
        </div>

    </div>



@stop

@section('scripts')


@stop


