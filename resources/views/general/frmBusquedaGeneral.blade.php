@extends('layouts.app')
@section('title','Buscar prestamos')
@section('style')
<link rel="stylesheet" href="{{ asset('css/listas.css') }}">
<link rel="stylesheet" href="{{ asset('css/paginacion.css') }}">
@section('content')
<div class="container">
    @section('title-section','Buscar préstamo de aprendices e instructores por fecha')

<div class="form-container">


    <form action="{{ route('buscar.general') }}" method="GET" >
        <div class="form-group">
            <label for="fecha">Selecciona una fecha:</label>
            <input type="date" id="fecha" name="fecha" class="input" value="{{ $fecha }}">
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
    <br><br><br>
    <label>Total de prestamos en esta fecha:</label>
    <div class="total">
        <h1 style="text-align: center">{{ $totalRegistros }}</h1>
    </div>
</div>
    @if (!is_null($computadores))
        @if ($computadores->isEmpty())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showErrorMessage("No se encontraron registros para la fecha seleccionada.");
            });
        </script>
        @else
            <table id="tabla-computadores">
                <thead>
                    <tr>
                        <th>Documento</th>
                        <th>Nombre y Apellido</th>
                        <th>Fecha</th>
                        <th>Componentes</th>
                        <th>Serial del computador</th>
                        <th>Estado</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($computadores as $computador)
                        <tr>
                            <td>{{ $computador->documento }}</td>
                            <td>{{ $computador->nombres }}</td>
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
                                    <div class="estado-sinentregar">
                                        <h4>Sin entregar</h4>
                                    </div>

                                @else
                                <div class="estado-entregado">
                                    <h4>Entregado</h4>
                                </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
                @if ($totalRegistros > 0)
                <a href="{{ route('pdf.general', ['fecha' => $fecha]) }}" class="pdf-download-link" download>
                    <i class="fas fa-file-pdf"></i>
                </a>
            @endif
            {{ $computadores->links('vendor.pagination.default') }}
        @endif
    @endif
</div>
@endsection
