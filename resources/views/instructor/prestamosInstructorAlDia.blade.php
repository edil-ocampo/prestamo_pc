@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/listas.css') }}">
    <link rel="stylesheet" href="{{ asset('css/paginacion.css') }}">
@endsection

@section('content')

@section('title-section','Listado de préstamos instructores hoy')
@section('total-prestamos')
<div class="total-instructor">
    <label class="label">Total de préstamos hoy:</label>
<h1>{{ $totalRegistros }}</h1>
</div>
<br>

    <div class="container">


        @if ($computadores->isEmpty())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showErrorMessage("No se ha echo ningún préstamo hoy.");
            });
        </script>
        @else
            <table id="tabla-computadores">
                <thead>
                    <tr>
                        <th>Nombre y Apellido</th>
                        <th>Fecha</th>
                        <th>Componentes</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($computadores as $computador)
                        <tr>
                            <td>{{ $computador->nombres }}</td>
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
                    @empty
                    @endforelse
                </tbody>
            </table>
        @endif
    </div>
    {{ $computadores->links('vendor.pagination.default') }}
@endsection
