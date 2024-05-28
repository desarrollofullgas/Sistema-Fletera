<table>
    <thead>
        <tr>
            <td style="background-color:#DFDFDF;">FECHA</td>
            @foreach ($combustibles as $combustible)
                <td 
                    @if ($combustible->tipo=='MAGNA')
                        style='color:white;background-color:#009739;'    
                    @elseif($combustible->tipo=='PREMIUM')
                        style='color:white;background-color:#CC0000;'
                    @else
                        style='color:white;background-color:#000000;'
                    @endif>
                    {{$combustible->tipo}} ELECTRÓNICO
                </td>
                <td 
                    @if ($combustible->tipo=='MAGNA')
                        style='color:white;background-color:#009739;'    
                    @elseif($combustible->tipo=='PREMIUM')
                        style='color:white;background-color:#CC0000;'
                    @else
                        style='color:white;background-color:#000000;'
                    @endif>
                    {{$combustible->tipo}} ODÓMETRO
                </td>
            @endforeach
            <td style="background-color:#DFDFDF;">TOTAL</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($lecturas as $lectura)
            <tr>
                <td>{{$lectura->created_at}}</td>
                @foreach ($combustibles as $combustible)
                    @foreach ($lectura->detalles as $detalle)
                        @if ($combustible->id==$detalle->combustible_id)    
                            <td>{{$detalle->venta_electronica}}</td>
                            <td>{{$detalle->venta_odometro}}</td>
                        @else
                            <td style="background-color: #ADADAD"></td>
                            <td style="background-color: #ADADAD"></td>
                        @endif
                    @endforeach
                @endforeach
                <td>{{$lectura->total_litros}}</td>
            </tr>
        @endforeach
    </tbody>
</table>