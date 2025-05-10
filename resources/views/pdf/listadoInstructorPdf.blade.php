<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            max-width: 60px;
            margin: 0 auto;
        }
        h3 {
            font-size: 24px;
            color: #39A900;
            margin-bottom: 20px;
            text-align: center;
        }
        #tabla-computadores {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        #tabla-computadores th, #tabla-computadores td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        #tabla-computadores th {
            background-color: #39A900;
            color: #ffffff;
            font-weight: bold;
        }
        #tabla-computadores tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        ul {
            margin: 0;
            padding-left: 20px;
        }
        
    </style>
</head>
<body>
    <!--Para colocar el logo como emcabezado del pdf (no me funciona)-->
      {{-- <div class="header">
        <img src="{{ $logo }}" alt="logo-sena" class="logo">
    </div> --}}
    {{-- <div class="header">
        <table>
            <tr>
                <td><img class="logo" src="{{ public_path('img/logoSena.png ') }}"></td>
            </tr>
        </table>
    </div> --}}
    <h3>{{ $encabezado }}</h3>
    <table id="tabla-computadores">
        <thead>
            <tr>
                <th style="text-align: center">Nombre y Apellido</th>
                <th style="text-align: center; margin-left: 20px; margin-right: 20px">Fecha</th>
                <th style="text-align: center">Componentes</th>
                <th style="text-align: center">Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($computadores as $computador)
                <tr>
                    <td style="font-size: 16px">{{ $computador->nombres }}</td>
                    <td>{{ $computador->fecha }}</td>
                    <td>
                        <ul>
                            @foreach ($computador->componentes as $componente)
                                <li>{{ $componente->componente->nombre }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        @if ($computador->estado == 1)
                            <div>
                                <h4>Sin entregar</h4>
                            </div>
                        @else
                            <div>
                                <h4>Entregado</h4>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
