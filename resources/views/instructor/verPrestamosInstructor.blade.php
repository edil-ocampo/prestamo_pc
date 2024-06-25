@extends('layouts.app')
@section('title','Listado prestamos instructor')
@section('style')
<link rel="stylesheet" href="{{ asset('css/listas.css')}}">
@section('content')
@section('title-section','Listado completo de préstamos a los instructores')
@section('total-prestamos')
<div class="total-instructor">   
    <label class="label">Total de préstamos a instructores:</label>
<h1>{{ $totalRegistros }}</h1>
</div>
<br>

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
    @foreach ($computadores as $computador)
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
    @endforeach
</tbody>
</table>
<a href="{{ route('pdf.listadoInstructor') }}" class="pdf-download-link" download>
    <i class="fas fa-file-pdf"></i>
</a>


@endsection