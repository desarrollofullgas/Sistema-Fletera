<table>
    <thead>
        <tr>
            <th>FECHA FACTURACIÓN</th>
            <th>ESTACIÓN DESTINO</th>
            <th>ZONA</th>
            <th>PRODUCTO</th>
            <th>PROCEDENCIA</th>
            <th>UNIDAD</th>
            <th>OPERADOR</th>
            <th>TRANSPORTE FG</th>
            <th>CAPACIDAD DE TONEL</th>
            <th>NUM. FACTURA</th>
            <th>CRATAPORTE</th>
            <th>VOLUMEN FACTURADO</th>
            <th>IMPORTE DE FACTURA</th>
            <th>PRECIO UNITARIO</th>
            <th>NIVEL SE CISA</th>
            <th>VOLUMEN ANTES DE DESCARGA (FISICO)</th>
            <th>VOLUMEN DESPUES DE DESCARGA (FISICO)</th>
            <th>VOLUMEN ANTES DE DESCARGA (VROOT)</th>
            <th>VOLUMEN DESPUES DE DESCARGA (VROOT)</th>
            <th>LTS. VENDIDOS DURANTE DESCARGA</th>
            <th>LTS ADICIONALES (CUBETAS)</th>
            <th>VOLMEN AUMENTO BRUTO (FISICO)</th>
            <th>VOLMEN AUMENTO BRUTO (VROOT)</th>
            <th>DIFERENCIA (FISICO)</th>
            <th>DIFERENCIA (VROOT)</th>
            <th>DIFERENCIA FISICO VS VROOT</th>
            <th>MERMA FISICA VS CAPACIDAD DE PIPA</th>
            <th>MERMAS FISICA VS FACTURA</th>
            <th>FECHA DE DESCARGA</th>
            <th>OBSERVACIONES</th>
            <th>HORA DE INICIO DE DESCARGA</th>
            <th>HORA DE FINAL DE DESCARGA</th>
            <th>DIF. ENTRE CAPACIDAD DE PIPA Y FACTURA</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $recepcion)    
        <tr>
            <td>{{$recepcion->fecha_factura}}</td>
            <td>{{$recepcion->cataporte->estacion->name}}</td>
            <td>{{$recepcion->cataporte->estacion->zona->name}}</td>
            <td>{{$recepcion->cataporte->combustible->tipo}}</td>
            <td>{{$recepcion->cataporte->proveedor->name}}</td>
            <td>{{$recepcion->cataporte->unidad->tractor}}</td>
            <td>{{$recepcion->cataporte->operador->name}}</td>
            <td>{{$recepcion->cataporte->unidad->linea->name}}</td>
            <td>{{$recepcion->cataporte->contenido}}</td>
            <td>{{$recepcion->remision_fac}}</td>
            <td>{{$recepcion->cataporte->id}}</td>
            <td>{{$recepcion->importe}}</td>
            <td>{{$recepcion->costos_uni}}</td>
            <td>{{$recepcion->ciza}}</td>
            <td>{{$recepcion->ant_desc_fisico}}</td>
            <td>{{$recepcion->desp_desc_fisico}}</td>
            <td>{{$recepcion->ant_desc_vroot}}</td>
            <td>{{$recepcion->desp_desc_vroot}}</td>
            <td>{{$recepcion->venta_dur_descarga}}</td>
            <td>{{$recepcion->litros_adicionales}}</td>
            <td>{{$recepcion->aum_desc_fisico}}</td>
            <td>{{$recepcion->aum_desc_vroot}}</td>
            <td>{{$recepcion->dif_fisico}}</td>
            <td>{{$recepcion->dif_vroot}}</td>
            <td>{{$recepcion->merma_fisico_p}}</td>
            <td>{{$recepcion->merma_vroot_p}}</td>
            <td>{{$recepcion->merma_fisico_f}}</td>
            <td>{{$recepcion->merma_vroot_f}}</td>
            <td>{{$recepcion->created_at}}</td>
            <td>{{$recepcion->observaciones}}</td>
            <td>{{$recepcion->hora_desc_in}}</td>
            <td>{{$recepcion->hora_desc_fin}}</td>
            <td>{{$recepcion->dif_litros_fact_root}}</td>
        </tr>
        @endforeach
    </tbody>
</table>