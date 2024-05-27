<table>
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th colspan="3">EXISTENCIAS</th>
            <th colspan="3">POR LLENAR</th>
            <th colspan="3">DÍAS DE VENCIMIENTO</th>
        </tr>
        <tr>
            <th style='color:white;background-color:#000000;'>ZONA</th>
            <th style='color:white;background-color:#000000;'>ESTACIÓN</th>
            <th style='color:white;background-color:#009739;'>MAGNA</th>
            <th style='color:white;background-color:#CC0000;'>PREMIUM</th>
            <th style='color:white;background-color:#000000;'>DIESEL</th>
            <th style='color:white;background-color:#009739;'>MAGNA</th>
            <th style='color:white;background-color:#CC0000;'>PREMIUM</th>
            <th style='color:white;background-color:#000000;'>DIESEL</th>
            <th style='color:white;background-color:#009739;'>V.MAGNA</th>
            <th style='color:white;background-color:#CC0000;'>V.PREMIUM</th>
            <th style='color:white;background-color:#000000;'>V.DIESEL</th>
            <th style='color:white;background-color:#000000;'>FECHA DE REGISTRO</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tablas as $registro)
            @foreach ($registro['data'] as $data)    
                <tr>
                    <td>{{$registro['zona']}}</td>
                    <td>{{$registro['estacion']}}</td>
                    <td>{{$data['lecturas']['MAGNA']['existencia']}}</td>
                    <td>{{$data['lecturas']['PREMIUM']['existencia']}}</td>
                    <td>{{$data['lecturas']['DIESEL']['existencia']}}</td>
                    <td>{{$data['lecturas']['MAGNA']['llenar']}}</td>
                    <td>{{$data['lecturas']['PREMIUM']['llenar']}}</td>
                    <td>{{$data['lecturas']['DIESEL']['llenar']}}</td>
                    <td>{{$data['lecturas']['MAGNA']['dias']}}</td>
                    <td>{{$data['lecturas']['PREMIUM']['dias']}}</td>
                    <td>{{$data['lecturas']['DIESEL']['dias']}}</td>
                    <td>{{$data['creado']}}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
{{-- @foreach ($tablas as $tabla)
    <table>
        <thead>
            <tr>
                <th colspan={{(count($tabla['combustibles'])*2)+2}}>{{$tabla['estacion']}}</th>
            </tr>
            <tr>
                <th>ZONA</th>
                @foreach ($tabla['combustibles'] as $combustible)    
                    <th
                        @if ($combustible->tipo=='MAGNA')
                            style='color:white;background-color:#009739;'    
                        @elseif($combustible->tipo=='PREMIUM')
                            style='color:white;background-color:#CC0000;'
                        @else
                            style='color:white;background-color:#000000;'
                        @endif
                    >
                    {{$combustible->tipo}}
                    </th>
                @endforeach
                @foreach ($tabla['combustibles'] as $combustible)    
                    <th
                        @if ($combustible->tipo=='MAGNA')
                            style='color:white;background-color:#009739;'    
                        @elseif($combustible->tipo=='PREMIUM')
                            style='color:white;background-color:#CC0000;'
                        @else
                            style='color:white;background-color:#000000;'
                        @endif
                        >
                        LLENAR {{$combustible->tipo}}
                    </th>
                @endforeach
                <th>FECHA DE REGISTRO</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tabla['data'] as $data)
                <tr>
                    <td>{{$tabla['zona']}}</td>
                    @foreach ($tabla['combustibles'] as $combustible)
                        @foreach ($data['lecturas'] as $registro)
                            @if ($registro['combustible']==$combustible->tipo)
                            <td>id:{{$registro['lectura_id']}},{{$registro['existencia']}}</td>
                            @else
                                <td style="background-color: black;"></td>
                            @endif
                        @endforeach
                    @endforeach
                    @foreach ($tabla['combustibles'] as $combustible)
                        @foreach ($data['lecturas'] as $registro)
                            @if ($registro['combustible']==$combustible->tipo)
                            <td>{{$registro['llenar']}}</td>
                            @else
                                <td style="background-color: black;"></td>
                            @endif
                        @endforeach
                    @endforeach
                    <td>{{$data['creado']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endforeach --}}
{{-- @foreach ($zonas as $zona)
    @foreach ($tablas as $tabla)
        @if ($zona->id == $tabla['zona'])    
            <table>
                <thead>
                    <tr>
                        <th colspan={{count($tabla['combustibles'])+2}}>{{$tabla['estacion']}}</th>
                    </tr>
                    <tr>
                        <th>ZONA</th>
                        @foreach ($tabla['combustibles'] as $combustible)    
                            <th>{{$combustible->tipo}}</th>
                        @endforeach
                        <th>FECHA DE REGISTRO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$zona->name}}</td>
                        @foreach ($tabla['combustibles'] as $comb)
                            @foreach ($tabla['data'] as $data)
                                @if ($data['combustible']==$comb->tipo)
                                    <td>{{$data['existencia']}}</td>
                                @endif
                            @endforeach
                        @endforeach
                    </tr>
                </tbody>
            </table>
        @endif
    @endforeach
@endforeach --}}