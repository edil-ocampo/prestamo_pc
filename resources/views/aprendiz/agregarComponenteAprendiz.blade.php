@extends('layouts.app')
@section('title','Buscar prestamos')
@section('style')
<link rel="stylesheet" href="{{ asset('css/frmPrestamo.css') }}">
@section('content')
@section('title-section','Agregar componente préstamo aprendiz')

<div class="container">
        <form action="{{ route('aprendiz.update', $computador->id) }}" method="POST" class="formulario-prestamo"> 
            @csrf
            @method('PUT')
    

            <div class="form-group">
                <label for="documento">Documento:</label>
                <input type="text" name="documento" value="{{ $computador->documento }}" class="input" >
            </div>
    
            <div class="form-group">
                <label for="nombres">Nombres:</label>
                <input type="text" name="nombres" value="{{ $computador->nombres }}" class="input" >
            </div>
    
            <div class="form-group" id="serialField" style="display: none;">
                <label for="serial">Serial del computador:</label>
                <input type="text" name="serial" id="serial" value="{{$computador->serial }}" class="input">
            </div>
            <div class="form-group">
                <label>Componentes:</label>
                @foreach ($componentes as $componente)
                    <div class="form-check">
                        <input type="checkbox" name="componente[]" class="cyberpunk-checkbox" value="{{ $componente->id }}" 
                        {{ $computador->allComponentes->contains($componente->id) ? 'checked' : '' }} class="form-check-input">
                        <label class="form-check-label">{{ $componente->nombre }}</label>
                    </div>
                @endforeach
            </div>
    
            <div class="form-group">
                <button type="submit" class="enviar">Enviar</button>
            </div>
        </form>
</div>
@endsection

@section('script')
<script src="{{ asset('js/frmPrestamoAprendiz.js')}}"></script>