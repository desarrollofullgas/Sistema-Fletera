<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recepcion #{{$recepcion->id}}</title>
    <style>
        table{
            border-collapse: collapse;
        }
        th,td{
            padding-left: 3px;
            padding-right: 3px;
        }
        .bg__gray__dark{
            background-color: #4B4D50;
        }
        .bg__gray__light{
            background-color: #D2D2D2;
        }
        .bg__green{
            background-color: #19640F;
        }
        .bg__red{
            background-color: #F53D3D;
        }
        .bg__black{
            background-color: black;
        }
        .bold{
            font-weight: bold;
        }
        .text__white{
            color: white;
        }
        .font__arial{
            font-family: Arial, Helvetica, sans-serif;
        }
        .border{
            border: 1px black solid;
        }
        .w__full{
            width: 100%;
        }
        .text__center{
            text-align: center;
        }
        .font__14{
            font-size: 14px;
        }
        .font__12{
            font-size: 12px;
        }
        .font__10{
            font-size: 10px;
        }
    </style>
</head>
<body>
    <table class="w__full border font__arial">
        <thead>
            <tr class="bg__gray__dark text__white">
                <th colspan="2">
                    <img src="{{public_path('img/logo/logo-FG-bg-rojo.png')}}" alt="logo" width="100px">
                </th>
                <th colspan="5" class="font__14"><h2>RECEPCIÓN DE PRODUCTO {{$recepcion->cataporte->estacion->name}}</h2></th>
            </tr>
            <tr class="font__12 text__center">
                <th class="border bold bg__gray__light">Fecha de descaga</th>
                <th class="border bold bg__gray__light">Producto</th>
                <th colspan="2" class="border bold bg__gray__light">Estación</th>
                <th class="border bold bg__gray__light">Carta Porte</th>
                <th class="border bold bg__gray__light">Hora inicio de descarga</th>
                <th class="border bold bg__gray__light">Hora llegada de pipa</th>
            </tr>
        </thead>
        <tbody class="font__12">
            <tr class="text__center">
                <td rowspan="3" class="border">{{$recepcion->created_at->locale('es')->isoFormat('D  MMMM  YYYY')}}</td>
                <td rowspan="3" 
                    @if ($recepcion->cataporte->combustible->tipo=='MAGNA')
                        class="border bold text__white bg__green"
                    @elseif($recepcion->cataporte->combustible->tipo=='PREMIUM')
                        class="border bold text__white bg__red"
                    @else
                        class="border bold text__white bg__black"    
                    @endif>
                    {{$recepcion->cataporte->combustible->tipo}}
                </td>
                <td rowspan="3" colspan="2" class="border">{{$recepcion->cataporte->estacion->name}}</td>
                <td rowspan="3" class="border">{{$recepcion->cataporte->id}}</td>
                <td class="border">{{$recepcion->hora_desc_in}}</td>
                <td class="border">{{$recepcion->hora_llegada}}</td>
            </tr>
            <tr class="text__center">
                <td class="border bold bg__gray__light">Hora final de descarga</td>
                <td class="border bold bg__gray__light">Hora salida de pipa</td>
            </tr>
            <tr class="text__center">
                <td class="border">{{$recepcion->hora_desc_fin}}</td>
                <td class="border">{{$recepcion->hora_salida}}</td>
            </tr>
            <tr class="text__center">
                <td rowspan="2" class="border bold bg__gray__light">Cantidad factura PEMEX</td>
                <td colspan="4" rowspan="2" class="border">{{$recepcion->importe}}</td>
                <td colspan="2" class="border bold bg__gray__light font__10">EXISTENCIA VEEDER ROOT LITROS</td>
            </tr>
            <tr class="text__center">
                <td class="border bold bg__gray__light">Antes de descarga</td>
                <td class="border bold bg__gray__light">Después de descarga</td>
            </tr>
            <tr class="text__center">
                <td class="border bold bg__gray__light">SELLOS</td>
                <td colspan="2" class="border bold bg__gray__light">ABAJO</td>
                <td colspan="2" class="border bold bg__gray__light">ARRIBA</td>
                <td class="border">{{$recepcion->ant_desc_vroot}}</td>
                <td class="border">{{$recepcion->desp_desc_vroot}}</td>
            </tr>
            <tr>
                <td class="border">Sellos TFG</td>
                <td colspan="2" class="border text__center">{{$recepcion->cataporte->sello_tfgc}}</td>
                <td colspan="2" class="border text__center">{{$recepcion->cataporte->sello_tfgd}}</td>
                <td colspan="2" class="border text__center font__10 bold bg__gray__light">EXISTENCIA FISICA (VARA ALUMINIO) LTS</td>
            </tr>
            <tr>
                <td class="border">Sellos PEMEX</td>
                <td colspan="2" class="border text__center">{{$recepcion->selloP2}}</td>
                <td colspan="2" class="border text__center">{{$recepcion->selloP1}}</td>
                <td class="border text__center bold bg__gray__light">Antes de descarga</td>
                <td class="border text__center bold bg__gray__light">Después de descarga</td>
            </tr>
            <tr>
                <td class="border">Sellos retorno</td>
                <td colspan="2" class="border text__center">{{$recepcion->sello_r}}</td>
                <td colspan="2" class="border text__center"></td>
                <td class="border text__center">{{$recepcion->ant_desc_fisico}}</td>
                <td class="border text__center">{{$recepcion->desp_desc_fisico}}</td>
            </tr>
            <tr>
                <td class="border">Factura PEMEX</td>
                <td colspan="2" class="border text__center">{{$recepcion->remision_fac}}</td>
                <td class="border bold bg__gray__light text__center">Part. Operador</td>
                <td class="border bold bg__gray__light text__center">CIZA</td>
                <td class="border bold bg__gray__light text__center">Aumento bruto Veeder</td>
                <td class="border bold bg__gray__light text__center">Diferencia fisico</td>
            </tr>
            <tr>
                <td class="border">No. Pipa</td>
                <td colspan="2" class="border text__center">{{$recepcion->cataporte->unidad->tractor}}</td>
                <td class="border text__center">{{$recepcion->parti_gerente}}</td>
                <td class="border text__center">{{$recepcion->ciza}}</td>
                <td class="border text__center">{{$recepcion->aum_desc_vroot}}</td>
                <td class="border text__center">{{$recepcion->aum_desc_fisico}}</td>
            </tr>
            <tr>
                <td class="border">Nombre gerente</td>
                <td colspan="2" class="border text__center">{{$recepcion->cataporte->estacion->user_id}}</td>
                <td colspan="2" class="border text__center bold bg__gray__light">Vent. Durante Desc.</td>
                <td class="border text__center">{{$recepcion->venta_dur_descarga}}</td>
                <td class="border text__center">{{$recepcion->venta_dur_descarga}}</td>
            </tr>
            <tr>
                <td class="border">Nombre operador</td>
                <td colspan="2" class="border text__center">{{$recepcion->cataporte->operador->name}}</td>
                <td colspan="2" class="border text__center bold bg__gray__light">Litros adicionales (Cubetas)</td>
                <td class="border text__center">{{$recepcion->litros_adicionales}}</td>
                <td class="border text__center">{{$recepcion->litros_adicionales}}</td>
            </tr>
            <tr>
                <td colspan="5" class="border bold bg__gray__light">DIFERENCIA LITROS FACTURADOS VR LITROS ENTREGADOS</td>
                <td class="border text__center">{{$recepcion->dif_litros_fact_root}}</td>
                <td class="border text__center">{{$recepcion->dif_lent_fisico}}</td>
            </tr>
            <tr>
                <td colspan="2" class="border bold">Estado físico y limpieza de pipa</td>
                <td colspan="5" class="border">{{$recepcion->status_pipa}}</td>
            </tr>
            <tr>
                <td colspan="2" class="border bold">Imagen del operador</td>
                <td colspan="5" class="border">{{$recepcion->observacion_op}}</td>
            </tr>
            <tr>
                <td colspan="2" class="border bold">Observaciones</td>
                <td colspan="5" class="border">{{$recepcion->observaciones}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>