@extends('layouts.admin-user')

@section('cuerpo')
<div class="container">
    <h3>Administración de usuarios</h3>

    <input type="submit" class="btn btn-primary" value="Guardar Cambios">
    <input type="submit" class="btn btn-success" value="Nuevo Usuario">

    <table class="table table-hover">
        <thead>
        <tr>
            <th>Usuario</th>
            <th>Bienestar estudiantil</th>
            <th>Secretario</th>
            <th>Decano</th>
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
            <td><input type="checkbox" checked></td>
            <td>
                <button class="btn btn-xs btn-primary">Editar</button>
                <button class="btn btn-xs btn-danger">Borrar</button>
            </td>
        </tr>
        <tr>
            <td>Actual Secretario</td>
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
            <td>Actual Decano</td>
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
            <td>Usuario 1</td>
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
            <td>Usuario 2</td>
            <td><input type="checkbox" checked></td>
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
            <td><input type="checkbox" checked></td>
            <td><input type="checkbox" checked></td>
            <td><input type="checkbox" checked></td>
            <td><input type="checkbox" checked></td>
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