@extends('layouts.admin-user')

@section('content')
<div class="container">
    <h3>Administración de usuarios</h3>

    <input type="submit" class="btn btn-primary" value="Guardar Cambios">
    <input type="submit" class="btn btn-success" value="Nuevo Usuario">
    <br><br>
    <ul class="list-group">
        <li class="list-group-item active">Usuarios</li>
        @foreach($admins as $admin)
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-3">
                            <b>Registro personal:</b> {{ $admin->registro_personal }} <br>
                            <b>Nombre:</b> {{ $admin->apellido }}, {{ $admin->nombre }} <br>
                            <b>Correo:</b> {{ $admin->email }} <br>
                            <b>Rol:</b> {{ $admin->rol }}
                        </div>
                        <div class="col-md-4">
                            <label>Rol</label>
                            <select class="form-control">
                                @foreach($rol_enum=[
                                    'superadmin'                =>'Super admin',
                                    'jefe_bienestar'            =>'Jefe de Bienestar',
                                    'secretario'                =>'Secretario',
                                    'decano'                    =>'Decano',
                                    'director_arquitectura'     =>'Director de Arquitectura',
                                    'director_disenio_grafico'  =>'Director de Diseño Gráfico'
                                ] as $rol => $rol_name)
                                    <option value="{{ $rol }}"{{ ($rol==$admin->rol)?' selected=true':'' }}>{{ $rol_name }}</option>

                                @endforeach
                                <!--option value="superadmin">Super admin</option>
                                <option value="jefe_bienestar">Jefe de Bienestar</option>
                                <option value="secretario">Secretario</option>
                                <option value="decano">Decano</option>
                                <option value="director_arquitectura">Director de Arquitectura</option>
                                <option value="director_disenio_grafico">Director de Diseño Gráfico</option-->
                            </select>
                        </div>
                        <div class="col-md-5">
                            <input type="button" class="btn btn-success btn-sm" value="Editar datos" onclick="editarDatos({{ $admin->registro_personal }})">
                            <input type="button" class="btn btn-success btn-sm" value="Cambiar contraseña" onclick="cambiarPass({{ $admin->registro_personal }})">
                            <input type="button" class="btn btn-success btn-sm" value="Borrar" onclick="borrarAdmin({{ $admin->registro_personal }})">
                        </div>
                    </div>

                </li>
        @endforeach
    </ul>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>Usuario</th>
            <th>Bienestar estudiantil</th>
            <th>Secretario</th>
            <th>Decano</th>
            <th>Director de escuela de Arquitectura</th>
            <th>Director de escuela de Diseño Gráfico</th>
            <th>Administrador general</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Oscar Enriquez</td>
            <td><input type="checkbox" checked></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td>
                <button class="btn btn-xs btn-primary">Editar</button>
                <button class="btn btn-xs btn-danger">Borrar</button>
            </td>
        </tr>
        <tr>
            <td>Angel Caal</td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox" checked></td>
            <td>
                <button class="btn btn-xs btn-primary">Editar</button>
                <button class="btn btn-xs btn-danger">Borrar</button>
            </td>
        </tr>
        <tr>
            <td>*Nombre de Actual Secretario*</td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox" checked></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td>
                <button class="btn btn-xs btn-primary">Editar</button>
                <button class="btn btn-xs btn-danger">Borrar</button>
            </td>
        </tr>
        <tr>
            <td>*Nombre de Actual Decano*</td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox" checked></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td>
                <button class="btn btn-xs btn-primary">Editar</button>
                <button class="btn btn-xs btn-danger">Borrar</button>
            </td>
        </tr>
        <tr>
            <td>*Nombre de actual director de escuela de arquitectura*</td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox" checked></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td>
                <button class="btn btn-xs btn-primary">Editar</button>
                <button class="btn btn-xs btn-danger">Borrar</button>
            </td>
        </tr>
        <tr>
            <td>*Nombre de actual director de escuela de diseño gráfico*</td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox" checked></td>
            <td><input type="checkbox"></td>
            <td>
                <button class="btn btn-xs btn-primary">Editar</button>
                <button class="btn btn-xs btn-danger">Borrar</button>
            </td>
        </tr>
        <tr>
            <td>Usuario 3</td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox" checked></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox" checked></td>
            <td><input type="checkbox"></td>
            <td>
                <button class="btn btn-xs btn-primary">Editar</button>
                <button class="btn btn-xs btn-danger">Borrar</button>
            </td>
        </tr>
        </tbody>
        <tfoot></tfoot>
    </table>



</div>

@endsection

@section('scripts')
<script>
    function editarDatos(registro_personal){
        alert('Editar: '+registro_personal);
    }

    function cambiarPass(registro_personal){
        alert('Pass: '+registro_personal);
    }

    function borrarAdmin(registro_personal){
        alert('Borrar: '+registro_personal);
    }
</script>
@endsection