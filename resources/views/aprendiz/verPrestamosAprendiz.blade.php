@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="{{ asset('css/listas.css')}}">
<link rel="stylesheet" href="{{ asset('css/paginacion.css')}}">
@section('title-section','Listado completo de los préstamos a los aprendices')
@section('total-prestamos')
@section('content')
<div class="total-instructor">
    <label class="label">Total de préstamos aprendices:</label>
<h1>{{ $totalRegistros }}</h1>
</div>
<br>

<table id="tabla-computadores">
    <thead>
        <tr>
            <th>Documento</th>
            <th>Nombre y Apellido</th>
            <th>Fecha</th>
            <th>Componentes</th>
            <th>Serial de Computador</th>
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
{{ $computadores->links('vendor.pagination.default') }}
<a href="{{ route('pdf.listadoAprendiz') }}" class="pdf-download-link" download>
    <i class="fas fa-file-pdf"></i>
</a>


@endsection
