<table>
    <thead>
        <tr>
            <th>FECHA DE REGISTRO</th>
            <th>NUM. ESTACIÓN</th>
            <th>SIIC</th>
            <th>NOMBRE</th>
            <th>OPERADOR</th>
            <th>UNIDAD</th>
            <th>PRODUCTO</th>
            <th>TONEL</th>
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
                <td @if ($viaje->combustible->tipo=='MAGNA')
                    style='color:#009312;'
                @elseif($viaje->combustible->tipo=='PREMIUM')
                    style='color:#DC0000;'
                @else
                    style='color:#000000;'    
                @endif>{{$viaje->combustible->tipo}}</td>
                <td>{{$viaje->tonel->toneles}}</td>
            </tr>
        @endforeach
    </tbody>
</table>