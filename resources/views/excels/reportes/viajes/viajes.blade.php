<table>
    <thead>
        <tr>
            <th>FECHA DE REGISTRO</th>
            <th>NUM. ESTACIÓN</th>
            <th>SIIC</th>
            <th>NOMBRE</th>
            <th>OPERADOR</th>
            <th>UNIDAD</th>
            <th>TONEL</th>
            <th>PRODUCTO</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($viajes as $viaje)
            <tr>
                <td>{{$viaje->created_at}}</td>
                <td>{{$viaje->estacion->num_estacion}}</td>
                <td>{{$viaje->estacion->siic}}</td>
                <td>{{$viaje->estacion->name}}</td>
                <td>{{$viaje->operador->name}}</td>
                <td>{{$viaje->unidad->tractor}}</td>
                <td>{{$viaje->combustible->tipo}}</td>
                <td>{{$viaje->tonel->toneles}}</td>
            </tr>
        @endforeach
    </tbody>
</table>