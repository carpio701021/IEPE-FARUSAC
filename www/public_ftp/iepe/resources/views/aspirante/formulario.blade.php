<!DOCTYPE html>
<html lang="en">
<head>
    <title>SAPE - FARUSAC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/aspirante.css">
    <link rel="stylesheet" href="/css/bootstrap-datepicker.min.css">    
    <script src="/js/jquery-2.2.2.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>    
    <script src="/js/jquery.easing.1.3.js" type="text/javascript"></script>   
    <script src="/js/bootstrap-datepicker.min.js" type="text/javascript"></script> 
    <script src="/js/bootstrap-datepicker.es.min.js" type="text/javascript"></script> 

    
</head>
<body>


<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">FARUSAC</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <!--li class="active"><a href="#">Usuarios <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Notificaciones</a></li-->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Aspirante <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Consultar numero de orientacion</a></li>
                        <li><a href="#">otro</a></li>
                        <!--li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li-->
                    </ul>
                </li>                
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">-Nombre de usuario- <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<form id="msform" class="control-form" action="aspirante/formulario" method="POST">
	<!-- progressbar -->
	<ul id="progressbar">
        <li class="active">Ińformación Personal</li>
        <li>Formación académica</li>
        <li>Intereses universitarios</li>
    </ul>
	<!-- fieldsets -->
	<fieldset>
		<h2 class="fs-title">Información Personal</h2>
		<h3 class="fs-subtitle">Requisito para asignación de prueba especifica</h3>
        <div class="row">
            <div class="col-sm-3">
              <label >Nombres: </label>
            </div>
            <div class="col-sm-9" >
              <input type="text" name="txt_nombre" id="txt_nombre" placeholder="Nombres" />
            </div>
        </div>		
        <div class="row">
            <div class="col-sm-3">
              <label for="txt_apellido">Apellidos:</label>
            </div>
            <div class="col-sm-9" >
              <input type="text" name="txt_apellido" id="txt_apellido" placeholder="Apellidos" />
            </div>
        </div>   
        <div class="row">
            <div class="col-sm-3">
              <label for "txt_ubicacion">Residencia:</label>
            </div>
            <div class="col-sm-9" >
              <input type="text" name="txt_ubicacion" id="txt_ubicacion" placeholder="Dirección de vivienda actual" />
            </div>
        </div>      
        <div class="row">
            <div class="col-sm-3" align="rigth">
                <label>Departamento: </label>
            </div>            
            <div class="col-sm-4">                    
            <div class="form-group">
                <select class="form-control" name="select_departamento" id="select_departamento" >

                    <option>Alta Verapaz</option><option>Baja Verapaz</option>
                    <option>Chimaltenango</option><option>Chiquimula</option>
                    <option>Petén</option><option>El Progreso</option>
                    <option>Quiché</option><option>Escuintla</option>
                    <option>Guatemala</option><option>Huehuetenango</option>
                    <option>Izabal</option><option>Jalapa</option>
                    <option>Jutiapa</option><option>Quetzaltenango</option>
                    <option>Retalhuleu</option><option>Sacatepéquez</option>
                    <option>San Marcos</option><option>Santa Rosa</option>
                    <option>Sololá</option><option>Suchitepéquez</option>
                    <option>Totonicapán</option><option>Zacapa</option>
                </select>
              </div>
            </div>            
        </div> 
        <div class="row">
            <div class="col-sm-3">
                <label>Genero: </label>
            </div>            
            <div class="col-sm-4">                    
            <div class="form-group">
                 <select class="form-control" name="select_genero" >
                    <option value="1">Masculino</option>
                    <option value="0">Femenino</option>
                  </select>
              </div>
            </div>            
        </div>      
        <div class="row">
            <div class="col-sm-3">
                <label>Fecha de nacimiento: </label>
            </div>            
            <div class="col-sm-9">                                    
                <div class="input-group date">
                <input id="date_nacimiento" name="date_nacimiento">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-th"></i>
                </span>                
                <script>
                        $('.input-group.date').datepicker({
                            language: 'es',
                            format: "yyyy-mm-dd"
                        });                
                </script>
                </div>                               
            </div>            
        </div>      		
        <div class="row">
            <div class="col-sm-3">
                <label for="select_estadoCivil" >Estado civil: </label>
            </div>            
            <div class="col-sm-4">                    
            <div class="form-group">
                 <select class="form-control" name="select_estadoCivil" >
                    <option value="soltero">Soltero</option>
                    <option value="casado">Casado</option>
                  </select>
              </div>
            </div>            
        </div>
        <div class="row">
            <div class="col-sm-3">
                <label for "select_laboral" >Situación laboral: </label>                
            </div>            
            <div class="col-sm-4">                                                 
                <div class="form-group">
                    <select class="form-control" name="select_laboral" >
                        <option value="trabaja">Trabajo</option>
                        <option value="no_trabaja">No trabajo</option>
                    </select>
                </div>
            </div>                        
        </div>
        <div class="row">
            <div class="col-sm-3">
                <label  >Cuantos dependen de usted: </label>
            </div>
            <div class="col-sm-4">
                <input type="number" name="txt_dependientes" id="txt_dependientes" placeholder="Cantidad de personas que dependen de usted" />
            </div>
        </div>
		<input type="button" name="next" class="next action-button" value="Siguiente" />
	</fieldset>
	<fieldset>
        <h2 class="fs-title">Formación académica</h2>
        <h3 class="fs-subtitle">Requisito para asignación de prueba especifica</h3>
        <div class="row">
            <div class="col-sm-3">
              <label>Titulo de nivel medio: </label>
            </div>
            <div class="col-sm-9" >
              <input type="text" name="txt_titulo" id="txt_titulo" placeholder="Titulo" />
            </div>
        </div>   
        <div class="row">
            <div class="col-sm-3">
                <label >Año de graduación: </label>
            </div>            
            <div class="col-sm-3">                                    
                <div class="input-group date">
                <input id="date_titulo" name="date_titulo" >
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-th"></i>
                </span>                
                <script>                        
                        $('.input-group.date').datepicker({
                            language: 'es',
                            format: "yyyy", // Notice the Extra space at the beginning
                            viewMode: "years", 
                            minViewMode: "years",
                            endDate: " " + new Date().getFullYear()
                        });                
                </script>
                </div>                               
            </div>            
        </div> 
        <div class="row">
            <div class="col-sm-3">
              <label>Centro Educativo: </label>
            </div>
            <div class="col-sm-9" >
              <input type="text" name="txt_centroEducativo" id="txt_centroEducativo" placeholder="Nombre completo del centro educativo" />
            </div>
        </div>      
        <div class="row">
            <div class="col-sm-3">
              <label for "txt_direccion" >Dirección: </label>
            </div>
            <div class="col-sm-9" >
              <input type="text" name="txt_direccion" id="txt_direccion" placeholder="Dirección del centro educativo" />
            </div>
        </div>      
        <div class="row">
            <div class="col-sm-3">
                <label for "select_sectorEducativo" >Sector: </label>                
            </div>            
            <div class="col-sm-4">                    
            <div class="form-group">
                 <select class="form-control" id="select_sectorEducativo" name="select_sectorEducativo">
                    <option>Público</option>
                    <option>Privado</option>                    
                  </select>
              </div>
            </div>            
        </div>                          
        <input type="button" name="previous" class="previous action-button" value="Anterior" />
        <input type="button" name="next" class="next action-button" value="Siguiente" />
    </fieldset>
    <fieldset>
        <h2 class="fs-title">Intereses universitarios</h2>
        <h3 class="fs-subtitle">Requisito para asignación de prueba especifica</h3>
        <div class="row">
            <div class="col-sm-3">
              <label for "select_carrera" >Carrera: </label>
            </div>
            <div class="col-sm-4" >
              <div class="form-group">
                 <select class="form-control" id="select_carrera" name="select_carrera">
                    <option>Arquitectura</option>
                    <option>Diseño Gráfico</option>                    
                  </select>
              </div>
            </div>  
            </div>
        </div>      
        <div class="row">
            <div class="col-sm-3">
              <label for "select_jornada" >Jornada: </label>
            </div>
            <div class="col-sm-4" >
              <div class="form-group">
                 <select class="form-control" id="select_jornada" name="select_jornada">
                    <option>Matutina</option>
                    <option>Vespertina</option>                    
                  </select>
              </div>
            </div>  
            </div>
        </div>
        <input type="hidden" name="_token" value= "{{{ csrf_token() }}}" />
        <input type="button" name="previous" class="previous action-button" value="Anterior" />
        <input type="submit" name="finalizar" class="next action-button" value="Finalizar" />
    </fieldset>
</form>



    </div>       
</div>

</body>
<script src="/js/multistep.js" type="text/javascript"></script>


</html>

