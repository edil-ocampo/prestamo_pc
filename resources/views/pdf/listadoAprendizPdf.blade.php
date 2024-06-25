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
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }

        .header {
            background-color: #ddd;
            padding: 1em;
            text-align: center
            }

        .logo {
            display: block;
            margin: 0 auto;
            max-width: 60px;  
        }

        h3 {
            font-size: 24px;
            color: #39A900;
            margin-bottom: 20px;
        }

        #tabla-computadores {
            width: 80%;
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            border-collapse: collapse;
            font-size: 14px;
            table-layout: auto;
            word-wrap: break-word;
        }

        #tabla-computadores th, #tabla-computadores td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #dddddd; 
        }

        #tabla-computadores th {
            background-color: #39A900; 
            color: #ffffff; 
            font-weight: bold;
            border-bottom: 2px solid #337f0a; 
        }

        #tabla-computadores tbody tr:nth-child(even) {
            background-color: #f2f2f2; 
        }

        #tabla-computadores ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        #tabla-computadores ul li {
            margin-bottom: 5px;
            line-height: 1.4;
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
                    <th style="text-align: center">Documento</th>
                    <th style="text-align: center">Nombre y Apellido</th>
                    <th style="text-align: center; margin-left: 20px; margin-right: 20px">Fecha</th>
                    <th style="text-align: center">Componentes</th>
                    <th style="text-align: center">Serial Computador</th>
                    <th style="text-align: center">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($computadores as $computador)
                    <tr>
                        <td>{{ $computador->documento }}</td>
                        <td style="font-size: 16px">{{ $computador->nombres }}</td>
                        <td>{{ $computador->fecha }}</td>
                        <td>
                            <ul>
                                @foreach ($computador->componentes as $componente)
                                    <li>{{ $componente->componente->nombre }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td style="text-align: center">{{ $computador->serial }}</td>
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
