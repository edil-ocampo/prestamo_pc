@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('css/frmPrestamo.css') }}">
@endsection

@section('title-section','Agregar componente préstamo aprendiz')

@section('content')
<div class="container-form">
    <div class="card-form">
        <div class="form-header">
            <h2>Agregar Componente</h2>
            <p class="subtitle">Complete la información para actualizar el préstamo</p>
        </div>
        <form action="{{ route('aprendiz.update', $computador->id) }}" method="POST" class="formulario-prestamo">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="documento">Documento:</label>
                <input type="text" name="documento" value="{{ $computador->documento }}" class="input">
            </div>

            <div class="form-group">
                <label for="nombres">Nombres:</label>
                <input type="text" name="nombres" value="{{ $computador->nombres }}" class="input">
            </div>

            <div class="form-group" id="serialField">
                <label for="serial">Serial del computador:</label>
                <input type="text" name="serial" id="serial" value="{{ $computador->serial }}" class="input">
            </div>

            <div class="form-group componentes-group">
                <label class="section-label">Componentes:</label>
                <div class="components-grid">
                    @foreach ($componentes as $componente)
                    <div class="checkbox-item">
                        <input type="checkbox"
                               name="componente[]"
                               class="modern-checkbox"
                               id="comp-{{ $componente->id }}"
                               value="{{ $componente->id }}"
                               {{ $computador->allComponentes->contains($componente->id) ? 'checked' : '' }}>
                        <label for="comp-{{ $componente->id }}" class="checkbox-label">{{ $componente->nombre }}</label>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Actualizar Préstamo</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/frmPrestamoAprendiz.js')}}"></script>
@endsection
