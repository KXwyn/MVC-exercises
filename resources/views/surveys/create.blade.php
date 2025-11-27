@extends('layouts.app')
@section('title', 'Crear Encuesta')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">Nueva Encuesta</div>
            <div class="card-body">
                <form action="{{ route('surveys.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Pregunta</label>
                        <input type="text" name="question" class="form-control" placeholder="Ej: ¿Qué lenguaje prefieres?" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Opciones (Separadas por coma)</label>
                        <textarea name="options" class="form-control" rows="3" placeholder="PHP, Python, Java, JavaScript" required></textarea>
                        <div class="form-text">Escribe las opciones separadas por una coma (,).</div>
                    </div>
                    <button class="btn btn-primary w-100">Crear Encuesta</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
