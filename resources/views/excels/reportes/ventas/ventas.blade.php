<table>
    <thead>
        <tr>
            <td style="background-color:#DFDFDF;">FECHA</td>
            @foreach ($combustibles as $combustible)
                <td 
                    @if ($combustible->combustible->tipo=='MAGNA')
                        style='color:white;background-color:#009739;'    
                    @elseif($combustible->combustible->tipo=='PREMIUM')
                        style='color:white;background-color:#CC0000;'
                    @else
                        style='color:white;background-color:#000000;'
                    @endif>
                    {{$combustible->combustible->tipo . '(TANQUE ' . number_format($combustible->capacidad) . 'lts)'}} ELECTRÓNICO
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
        @foreach ($table as $item)
            <tr>
                <td>{{$item['fecha']}}</td>
                @foreach ($item['fila'] as $row)
                    @if ($row['value'] > 0 && $row['odo'] > 0)
                        <td>{{$row['value']}}</td>
                        <td>{{$row['odo']}}</td>
                    @else
                        <td style="background-color: #ADADAD"></td>
                        <td style="background-color: #ADADAD"></td>
                    @endif
                @endforeach
                <td>{{$item['total']}}</td>
            </tr>
        @endforeach
        {{-- @foreach ($lecturas as $lectura)
            <tr>
                <td>{{$lectura->created_at}}</td>
                @foreach ($combustibles as $combustible)
                    @foreach ($lectura->detalles as $detalle)
                        @if ($combustible->id==$detalle->estacion_combustible_id)    
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
        @endforeach --}}
    </tbody>
</table>