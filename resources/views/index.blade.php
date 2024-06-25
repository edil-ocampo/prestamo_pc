@extends('layouts.app')
@section('title', 'SENA Presta')
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

<div class="container-index">
    <a href="{{ route('registro') }}" class="links-index">
        <i class="fas fa-user-graduate"></i>&nbsp;Aprendiz
    </a>
    <a href="{{ route('registro.instructor') }}" class="links-index">
        <i class="fas fa-chalkboard-teacher"></i>&nbsp;Instructor
    </a>
</div>
@endsection
