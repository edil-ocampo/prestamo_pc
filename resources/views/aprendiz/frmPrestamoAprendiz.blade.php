@php
    use Carbon\Carbon;
@endphp
@extends('layouts.app')
@section('title','Formulario prestamo aprendices')
@section('style')
<link rel="stylesheet" href="{{ asset('css/frmPrestamo.css')}}">
@section('content')
@section('title-section','Formulario préstamo aprendices')


<form action="{{ route('registroAprendiz.store') }}" method="POST" class="formulario-prestamo">
    @csrf
    
    <div class="form-group">
        <label for="documento">Documento:</label><br>
        <input type="number" id="documento" name="documento" class="input" required><br>
    </div>
    
    <div class="form-group">
        <label for="nombres">Nombre y Apellido:</label><br>
        <input type="text" id="nombres" name="nombres" class="input" required><br>
    </div>
    
    <div class="form-group" id="serialField" style="display: none;">
        <label for="serial">Serial del Portátil:</label><br>
        <input type="text" id="serial" name="serial" class="input"><br>
    </div>
    
    <div class="form-group">
        <label>Seleccione lo que se va a prestar:</label><br>
        @foreach ($componentes as $componente)

        <label class="cyberpunk-checkbox-label">
            <input type="checkbox" class="cyberpunk-checkbox" name="componente[]" value="{{ $componente['id'] }}">
            {{ $componente['nombre'] }}</label>
        @endforeach
    </div>
    
    <input type="hidden" name="fecha" value="{{ now()->format('Y-m-d H:i:s') }}">
    <input type="hidden" name="estado" value="1">
    
    <div class="form-group">
        <button type="submit" class="enviar">Enviar</button>
    </div>
</form>


@endsection

@section('script')
<script src="{{ asset('js/frmPrestamoAprendiz.js')}}"></script>
