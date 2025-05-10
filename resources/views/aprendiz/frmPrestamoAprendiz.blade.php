@php
    use Carbon\Carbon;
@endphp
@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="{{ asset('css/frmPrestamo.css')}}">
@endsection
@section('content')
@section('title-section','Formulario préstamo aprendices')

<div class="container-form">
    <div class="card-form">
        <div class="form-header">
            <h2>Registro de Préstamo</h2>
            <p class="subtitle">Complete la información para solicitar un préstamo</p>
        </div>

        <form action="{{ route('registroAprendiz.store') }}" method="POST" class="formulario-prestamo">
            @csrf

            <div class="form-group">
                <label for="documento">Documento</label>
                <input type="number" id="documento" name="documento" class="input" required placeholder="Ingrese su número de documento">
            </div>

            <div class="form-group">
                <label for="nombres">Nombre y Apellido</label>
                <input type="text" id="nombres" name="nombres" class="input" required placeholder="Ingrese su nombre completo">
            </div>

            <div class="form-group" id="serialField">
                <label for="serial">Serial del Portátil</label>
                <input type="text" id="serial" name="serial" class="input" placeholder="Ingrese el serial del portátil">
            </div>

            <div class="form-group componentes-group">
                <label class="section-label">Elementos a solicitar</label>
                <div class="components-grid">
                    @foreach ($componentes as $componente)
                    <div class="checkbox-item">
                        <input type="checkbox" class="modern-checkbox" id="comp-{{ $componente['id'] }}" name="componente[]" value="{{ $componente['id'] }}">
                        <label for="comp-{{ $componente['id'] }}" class="checkbox-label">{{ $componente['nombre'] }}</label>
                    </div>
                    @endforeach
                </div>
            </div>

            <input type="hidden" name="fecha" value="{{ now()->format('Y-m-d H:i:s') }}">
            <input type="hidden" name="estado" value="1">

            <div class="form-actions">
                <button type="submit" class="btn-submit">Registrar Préstamo</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
<script src="{{ asset('js/frmPrestamoAprendiz.js')}}"></script>
@endsection
