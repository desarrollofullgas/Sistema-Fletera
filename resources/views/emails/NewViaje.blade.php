<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro de viaje</title>
    <style>
        main{
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>
<body>
    <main>
        <p>Por este medio de le notifica la programación de viaje a la Estación <strong>{{$viaje->estacion->name}}</strong></p>
        <br>
        <p><strong>Unidad: </strong>{{$viaje->unidad->tractor}}</p>
        <p><strong>Tonel: </strong>{{$viaje->tonel->toneles}}</p>
        <p><strong>Combustible: </strong>{{$viaje->combustible->tipo}}</p>
        <p><strong>Operador: </strong>{{$viaje->operador->name}}</p>
        <br>
        <p>Para más información, por favor  inicie sesión en el sistema Fletera: <a href="{{route('lecturas')}}">{{route('lecturas')}}</a></p>
    </main>
</body>
</html>