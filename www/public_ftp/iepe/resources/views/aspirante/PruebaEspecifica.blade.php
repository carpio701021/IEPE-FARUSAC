@extends('aspirante.layout')

<script type="text/javascript">
	function asignar_segunda() {
		alert("Aqui se genera y muestra la constancia de asignacion. También se le manda un correo con el PDF")
		btn_verConstancia2.disabled=false;
		btn_asignar2.disabled=true;

	}
</script>
@section('content')	
	<h1>Prueba especifica</h1>
	<div class="container">
        <h2>Oportunidades</h2>

        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse1">Segunda oportunidad 2016</a> 
                        - <strong>No asignada</strong>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="col-sm-3">
							<div class="row">
								<div class="col-xs-4"><strong>Fecha:</strong> </div>
								<div class="col-xs-5"> - </div>
							</div>
							<div class="row">
								<div class="col-sm-4"><strong>Horario: </strong></div>
								<div class="col-sm-4"> - </div>
							</div>
							<div class="row">
								<div class="col-sm-4"><strong>Salon:</strong> </div>
								<div class="col-sm-4"> - </div>
							</div>
							<div class="row">
								<div class="col-sm-4"><strong>Resultado:</strong> </div>
								<div class="col-sm-4"> - </div>
							</div>
						</div>
					</div>
                    <div class="panel-footer">
                        <button class="btn btn-xs btn-primary" id="btn_asignar2"onClick="asignar_segunda();">
                        	Asignar oportunidad
                        </button>
						<button class="btn btn-xs btn-primary" id="btn_verConstancia2" disabled="disabled">Ver constancia de asignación</button>
                    </div>
                </div>                
            </div>
        </div>


        <div class="panel-group">
            <div class="panel panel-danger">
                <div class="panel-heading" >
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse2">Primera oportunidad 2016</a>
                         - <strong>Finalizada</strong>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
					<div class="panel-body">
						<table>
							<tr>
								<th width="60%">Fecha:</th>
								<td>10-03-2016</td>
							</tr>
							<tr>
								<th width="60%">Horario:</th>
								<td>9:00 - 11:00 </td>
							</tr>
							<tr>
								<th width="60%">Salón:</th>
								<td>201 - T1</td>
							</tr>
							<tr>
								<th>Resultado:</th>
								<td>No satisfactorio</td>
							</tr>
						</table>
					</div>
                    <div class="panel-footer">
                        <button class="btn btn-xs btn-primary" disabled="disabled">Asignar oportunidad</button>
                        <button class="btn btn-xs btn-primary">Ver constancia de asignación</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
@stop