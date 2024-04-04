@foreach ($tablas as $tabla)
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
                @foreach ($tabla['combustibles'] as $combustible)    
                    <th>LLENAR {{$combustible->tipo}}</th>
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
                            <td>{{$registro['existencia']}}</td>
                            @endif
                        @endforeach
                    @endforeach
                    @foreach ($tabla['combustibles'] as $combustible)
                        @foreach ($data['lecturas'] as $registro)
                            @if ($registro['combustible']==$combustible->tipo)
                            <td>{{$registro['llenar']}}</td>
                            @endif
                        @endforeach
                    @endforeach
                    <td>{{$data['creado']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endforeach
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