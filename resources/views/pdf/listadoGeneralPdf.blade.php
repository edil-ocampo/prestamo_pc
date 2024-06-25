<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Préstamos</title>
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
    {{-- <div class="header">
        <img src="{{ $logo }}" alt="logo-sena" class="logo">
    </div> --}}
    
    <h3>{{ $encabezado }}</h3>
    
    <table id="tabla-computadores">
        <thead>
            <tr>
                <th>Documento</th>
                <th>Nombre y Apellido</th>
                <th>Fecha</th>
                <th>Componentes</th>
                <th>Serial Computador</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($computadores as $computador)
                <tr>
                    <td>{{ $computador->documento ?? 'N/A' }}</td>
                    <td>{{ $computador->nombres }}</td>
                    <td>{{ $computador->fecha }}</td>
                    <td>
                        <ul>
                            @foreach ($computador->componentes as $componente)
                                <li>{{ $componente->componente->nombre }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td style="text-align: center">{{ $computador->serial ?? 'N/A' }}</td>
                    <td>
                        @if ($computador->estado == 1)
                            Sin entregar
                        @else
                            Entregado
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>