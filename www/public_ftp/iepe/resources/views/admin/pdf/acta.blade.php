<h1>Acta {{$acta->id}} {{$aplicacion->nombre()}}</h1>
<table class="table">
    <thead>
        <tr>
            <th>No. Orientacion</th>
            <th>RA</th>
            <th>APE</th>
            <th>RV</th>
            <th>APN</th>
        </tr>
    </thead>
    <tbody>
    @foreach($asignaciones->get() as $a)
        <tr>
            <td>{{$a->aspirante_id}}</td>
            <td>{{$a->nota_RA}}</td>
            <td>{{$a->nota_APE}}</td>
            <td>{{$a->nota_RV}}</td>
            <td>{{$a->nota_APN}}</td>
        </tr>
    @endforeach
    </tbody>
</table>