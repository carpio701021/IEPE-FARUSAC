@extends('layouts.aspirante-layout')

<script type="text/javascript">
	function asignar_segunda() {
		alert("Aqui se genera y muestra la constancia de asignacion. También se le manda un correo con el PDF")
		btn_verConstancia.disabled=false;
		btn_asignar.disabled=true;

	}
</script>
@section('content')	
	<h1>Prueba especifica</h1>
	<div class="container">
        <h2>Aplicaciones</h2>

		@if(count($proximas)>0 || count($asignadas)>0)
		@foreach($proximas as $aplicacion)
			<div class="panel-group">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" href="#colapse{{$aplicacion->id}}">{{$aplicacion->nombre}}</a>
							- <strong>No asignada</strong>
						</h4>
					</div>
					<div id="colapse{{$aplicacion->id}}" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="col-sm-3">
								<div class="row">
									<div class="col-xs-4"><strong>Fecha:</strong> </div>
									<div class="col-xs-6"> {{$aplicacion->fecha_aplicacion}} </div>
								</div>
								<div class="row">
									<div class="col-sm-4"><strong>Horario: </strong></div>
									<div class="col-sm-6"> - </div>
								</div>
								<div class="row">
									<div class="col-sm-4"><strong>Salon:</strong> </div>
									<div class="col-sm-6"> - </div>
								</div>
								<div class="row">
									<div class="col-sm-4"><strong>Resultado:</strong> </div>
									<div class="col-sm-6"> - </div>
								</div>
							</div>
						</div>
						<div class="panel-footer">
							<form class="form-group" method="POST" action="/aspirante/PruebaEspecifica">
								<input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
								<input type="hidden" value="{{$aplicacion->id}}"  name="aplicacion_id"/>
							<input type="submit"  value="Asignar oportunidad"/>
							</form>
						</div>
					</div>
				</div>
			</div>
		@endforeach
		@foreach($asignadas as $asignada)
			<div class="panel-group">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" href="#colaps{{$asignada->id}}">{{$asignada->getAplicacion()->nombre}}</a>
						</h4>
					</div>
					<div id="colaps{{$asignada->id}}" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="col-sm-3">
								<div class="row">
									<div class="col-xs-4"><strong>Fecha:</strong> </div>
									<div class="col-xs-6"> {{$asignada->getAplicacion()->fecha_aplicacion}} </div>
								</div>
								<div class="row">
									<div class="col-sm-4"><strong>Horario: </strong></div>
									<div class="col-sm-7">
										{{date("g:ia",strtotime($asignada->getHorario()->hora_inicio))."-".date("g:ia",strtotime($asignada->getHorario()->hora_fin))}} </div>
								</div>
								<div class="row">
									<div class="col-sm-4"><strong>Salon:</strong> </div>
									<div class="col-sm-6"> {{$asignada->getSalon()->nombre}} </div>
								</div>
								<div class="row">
									<div class="col-sm-4"><strong>Resultado:</strong> </div>
									<div class="col-sm-6"> {{$asignada->getResultado()}} </div>
								</div>
							</div>
						</div>
						<div class="panel-footer">
							<button class="btn btn-xs btn-primary" id="btn_verConstancia" >Ver constancia de asignación</button>
						</div>
					</div>
				</div>
			</div>
		@endforeach
		@else
			<div class="panel panel-default">
				<div class="panel-body">En esta area podrá ver las aplicaciones de pruebas especificas
				disponibles, cuando exista alguna</div>
			</div>
		@endif
    </div>
@stop