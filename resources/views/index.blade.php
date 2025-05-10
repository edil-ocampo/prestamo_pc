@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

@section('content')
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        showSuccessMessage("{{ session('success') }}");
    });
</script>
@endif

@section('title-section', '¿A quién va dirigido el préstamo?')

<div class="container-main">
    <h2 class="section-title">Seleccione el tipo de usuario</h2>

    <div class="cards-container">
        <a href="{{ route('registro') }}" class="card-option">
            <div class="card-icon">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div class="card-label">Aprendiz</div>
        </a>

        <a href="{{ route('registro.instructor') }}" class="card-option">
            <div class="card-icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="card-label">Instructor</div>
        </a>
    </div>
</div>
@endsection
