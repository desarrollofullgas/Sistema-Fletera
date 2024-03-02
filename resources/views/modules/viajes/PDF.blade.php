<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cataporte {{$cataporte->id}}</title>
    <style>
        table{
            border-collapse: collapse;
        }
        th,td{
            padding: 5px 10px;
        }
        .border{
            border: 1px black solid;
        }
        .border_b{
            border-bottom: 1px black solid;
        }
        .border_t{
            border-top: 1px black solid;
        }
        .w__fit{
            width: fit-content;
        }
        .w__full{
            width: 100%;
        }
        .font__bold{
            font-weight: bold;
        }
        .font__light{
            font-weight:lighter;
        }
        .font__16{
            font-size: 16px;
        }
        .font__12{
            font-size: 12px;
        }
        .font__10{
            font-size: 10px;
        }
        .font__8{
            font-size: 8px;
        }
        .line__20{
            line-height: 20px;
        }
        .text__center{
            text-align: center;
        }
        .text__right{
            text-align: right;
        }
        .px_0{
            padding-left: 0;
            padding-right: 0;
        }
        .px_10{
            padding-left: 10px;
            padding-right: 10px;
        }
        .px_30{
            padding-left: 30px;
            padding-right: 30px;
        }
        .salto{
            page-break-after: always;
        }
    </style>
</head>
<body class="font__10">
    @php
        use Carbon\Carbon;
    @endphp
    {{-- Página 1 --}}
    <div class="w__full salto">
        <table style="width: 100%" class="border font__10">
            <thead>
                <tr>
                    <th colspan="5">
                        <p>TRANSPORTED FG, S.A DE C.V</p>
                        <p class="font__light font__12">SERVICIO PUBLICO DE AUTOTRANSPORTE DE CARGA</p>
                        <p class="font__bold font__10">R.F.C. TFG060626CT6</p>
                        <p class="font__light font__10">Calle 41 x 62, Tablaje Catastral 4104, C.P.97780. Valladolid, Yucatán</p>
                    </th>
                    <th class="font__light border">
                        <p>CARTA PORTE</p>
                        <P>{{$cataporte->id}}</P>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3" class="border">
                        <table style="width: 100%">
                            <tr>
                                <td style="padding: 0;">ORIGEN: ZONA {{$cataporte->estacion->zona->name}}</td>
                                <td style="padding: 0;">FECHA: {{Carbon::create($cataporte->created_at)->toDateString();}}</td>
                            </tr>
                        </table>
                        <p>REMITENTE: {{$cataporte->proveedor->razon_social}}</p>
                        <p>DOMICILIO: {{$cataporte->proveedor->direccion}}</p>
                        <p>R.F.C {{$cataporte->proveedor->rfc}}</p>
                        <p>SE RECOGERÁ: {{$cataporte->proveedor->busqueda}}</p>
                    </td>
                    <td colspan="3" class="border">
                        <p>DESTINO: {{$cataporte->estacion->name}}</p>
                        <p>DESTINATARIO: {{$cataporte->estacion->razon_social}}</p>
                        <p>DOMICILIO: {{$cataporte->estacion->direccion}}</p>
                        <p>R.F.C. {{$cataporte->estacion->rfc}}</p>
                        <table style="width: 100%">
                            <tr>
                                <td style="padding: 0;">SE ENTREGA EN: E.S {{$cataporte->estacion->num_estacion}}</td>
                                <td style="padding: 0;">SIIC: {{$cataporte->estacion->siic}}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <p>PIPA CONTENIDO: <u class="px_10 border_b">{{number_format($cataporte->contenido)}}</u> DE: <u class="px_10 border_b">{{$cataporte->combustible->clave}}</u></p>
                        <table style="width: 100%">
                            <tr>
                                <td style="padding: 0;">OPERADOR: <u class="px_10 border_b">{{$cataporte->operador->name}}</u></td>
                                <td style="padding: 0;">REMISION N.FACT._______</td>
                            </tr>
                            <tr>
                                <td style="padding: 0;">TRACTOR ECO: <u class="px_10 border_b">{{$cataporte->unidad->tractor}}</u></td>
                                <td style="padding: 0;">PLACAS: <u class="px_10 border_b">{{$cataporte->unidad->placa}}</u></td>
                                <td style="padding: 0;">MARCA: <u class="px_10 border_b">{{$cataporte->unidad->marca}}</u></td>
                                <td style="padding: 0;">SERIE: <u class="px_10 border_b">{{$cataporte->unidad->serie}}</u></td>
                            </tr>
                            <tr>
                                <td style="padding: 0;">PIPA ECO: <u class="px_10 border_b">{{$cataporte->tonel->toneles}}</u></td>
                                <td style="padding: 0;">PLACAS: <u>{{$cataporte->tonel->placa}}</u></td>
                                <td style="padding: 0;">MARCA: <u>{{$cataporte->tonel->marca}}</u></td>
                                <td style="padding: 0;">SERIE: <u>{{$cataporte->tonel->SERIE}}</u></td>
                            </tr>
                            <tr>
                                <td style="padding: 0;">SELLO TF G: <u class="px_10 border_b">{{$cataporte->sello_tfgd}}</u></td>
                                <td style="padding: 0;">SELLO TF C: <u class="px_10 border_b">{{$cataporte->sello_tfgc}}</u></td>
                                <td style="padding: 0;">SELLO RETORNO: <u class="px_10 border_b">{{$cataporte->sello_r}}</u></td>
                            </tr>
                        </table>
                        <br>
                        <br>
                        <br>
                        <div class="px_30">
                            <hr>
                        </div>
                        <p class="text__center">NOMBRE Y FIRMA DE LA PERSONA AUTORIZADA PARA RECIBIR EL PRODUCTO</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <br><br>
        <table style="width: 100%" class="font__10">
            <thead>
                <tr>
                    <th colspan="5">
                        <h1 class="font__10 text__center">VALE DE RETIRO DE PRODUCTO</h1>
                    </th>
                    <th class="font__light border">
                        <P>{{$cataporte->id}}</P>
                    </th>
                </tr>
            </thead>
        </table>
        <p>ESTACIÓN DE SERVICIO: <u class="border_b px_10" style="width: 100%;">{{$cataporte->estacion->razon_social}}</u></p>
        <p>NO DE E.S. <u>{{$cataporte->estacion->num_estacion}}</u> CLAVE SIIC: <u>{{$cataporte->estacion->siic}}</u></p>
        <p class="line__20">UBICACIÓN: <u>{{$cataporte->estacion->direccion}}</u></p>
        <p class="line__20">ADRADECE SUMINISTRE <u class="border_b px_10">{{$cataporte->combustible->clave}}</u> RETIRADO CON EL AUTOTANQUE <u class="border_b px_10">{{$cataporte->unidad->tractor}}</u> CAPACIDAD <u class="border_b px_10">{{number_format($cataporte->contenido)}}</u> DE LA LÍNEA DE TRANSPORTE <u class="border_b px_10">{{$cataporte->unidad->linea->name}}</u> QUE TENGO AUTORIZADA.</p>
        <p>NOMBRE DEL OPERADOR <u class="border_b px_10">{{$cataporte->operador->name}}</u> R.F.C. <u class="border_b px_10">{{$cataporte->operador->rfc}}</u></p>
        <table>
            <tbody>
                <tr>
                    <td style="padding: 0;">NOMBRE </td>
                    <td>
                        <p class="text__center">{{$cataporte->estacion->propietario}}SDF</p>
                        <h3 class="border_t font__8 text__center">PROPIETARIO Y/O APODERADO DE LA E.S. PARA SUSCRIBIR TITULOS Y OPERACIONES DE CRÉDITO</h3>
                    </td>
                    <td style="padding: 0;">
                        <p>OPERADOR</p>
                        <p>SELLO Y FIRMA</p>
                    </td>
                </tr>
            </tbody>   
        </table>
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td colspan="2"><p></p></td>
                    <td colspan="2"><p></p></td>
                    <td>
                        <div style="margin-left: 50%;" class="font__12 font__bold text__center">
                            <p>{{$cataporte->estacion->name}} - {{$cataporte->estacion->num_estacion}}</p>
                            <p>{{$cataporte->estacion->razon_social}}</p>
                            <p>{{$cataporte->estacion->direccion}}</p>
                            <p>{{$cataporte->estacion->rfc}}</p>
                            <p>SIIC: {{$cataporte->estacion->siic}}</p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    {{-- Página 2 --}}
    <div class="w__full font__10">
        <h1 class="font__10 text__center">CONSTANCIA DE RECEPCIÓN DE PRODUCTO</h1>
        <br><br><br>
        <table class="w__full">
            <tbody>
                <tr>
                    <td class="px_0" style="width: 4.5cm;">CLAVE DE TRANSPORTISTA: </td>
                    <td class="border_b">{{$cataporte->unidad->linea->clave}}</td>
                </tr>
                <tr>
                    <td class="px_0" style="width: 4.5cm;">R.F.C. </td>
                    <td class="border_b">{{$cataporte->unidad->linea->rfc}}</td>
                </tr>
                <tr>
                    <td class="px_0" style="width: 4.5cm;">CARTA DE AUTORIZACIÓN</td>
                    <td class="border_b"></td>
                </tr>
                <tr>
                    <td class="px_0" style="width: 4.5cm;">VALE DE CARGA NO. Y/O FECHA </td>
                    <td class="border_b"></td>
                </tr>
                <tr>
                    <td class="px_0" style="width: 4.5cm;">NÚMERO DE REMISIÓN </td>
                    <td class="border_b"></td>
                </tr>
                <tr>
                    <td class="px_0" style="width: 4.5cm;">PRODUCTO </td>
                    <td class="border_b">{{$cataporte->combustible->clave}}</td>
                </tr>
            </tbody>
        </table>
        <p style="width: 50%;">RECIBIMOS DE CONFORMIDAD EL PRODUCTO CONSIGNADO EN LA REMISIÓN ARRIBA INDICADA EN LAS INSTALACIONES DE PEMEX</p>
        <p>PARA SER TRANSPORTADO A LA ESTACIÓN DE SERVICIO: <u class="border_b px_10">{{$cataporte->estacion->name}}</u></p>
        <p>E.S. <u class="border_b px_10">{{$cataporte->estacion->num_estacion}}</u> SIIC <u class="border_b px_10">{{$cataporte->estacion->siic}}</u> CON UBICACIÓN EN <u class="border_b px_10">{{$cataporte->estacion->direccion}}</u></p>
        <table class="w__full">
            <tbody>
                <tr>
                    <td class="px_0" style="width: 4.5cm;">NOMBRE DEL OPERADOR </td>
                    <td class="border_b">{{$cataporte->operador->name}}</td>
                </tr>
                <tr>
                    <td class="px_0" style="width: 4.5cm;">FECHA</td>
                    <td class="border_b"></td>
                </tr>
                <tr>
                    <td class="px_0" style="width: 4.5cm;">FIRMA</td>
                    <td class="border_b"></td>
                </tr>
            </tbody>
        </table>
        <p style="width: 60%;">SE ENTIENDE LA TRANSACCIÓN COMERCIAL EN TÉRMINOS DEL ART. 321, 324 DEL CÓDIGO DE COMERCIO.</p>
        <br><br>
        <p>REF.</p>
        <p>CONDICIÓNDE ENTREGA L.A.B LLENADERAS PEMEX</p>
        <br>
        <div class="w-full">
            <div class="border" style="width:50%; height:3.5cm; margin-left:25%"></div>
            <p class="text__center">SELLO DEL TRANSPORTISTA</p>
        </div>
    </div>
</body>
</html>