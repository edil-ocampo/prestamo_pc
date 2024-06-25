@extends('layouts.app')
@section('title','Buscar prestamos')
@section('style')
<link rel="stylesheet" href="{{ asset('css/listas.css') }}">


@section('content')

<div class="container">
    @section('title-section','Entregar préstamo aprendiz')
    
<div class="form-container">


    <form action="{{ route('vistaPrestamoAprendiz') }}" method="GET" >
        
        <div class="form-group">
            <label>Ingrese el documento:</label>
            <input type="number"  name="documento" class="input">
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
</div>
    @if (request()->has('documento'))
        @if (is_null($computadores) || $computadores->isEmpty())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showErrorMessage("No se encontraron registros con este documento.");
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
                        <th>Acciones</th>
                       
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
                            <td>{{ $computador->serial}}</td>
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
                            <td>
                                
                                   <a href="{{ route('edit.aprendiz', $computador->id )}}" class="link-entregar">Agregar Componente</a>
                               
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endif
</div>
@endsection
