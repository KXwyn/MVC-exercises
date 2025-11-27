@extends('layouts.app')

@section('title', 'Gestor de Notas')

@section('styles')
<style>
    /* Colores suaves para las notas */
    .border-top-Personal { border-top: 4px solid #0dcaf0 !important; } /* Azul */
    .border-top-Trabajo { border-top: 4px solid #dc3545 !important; }  /* Rojo */
    .border-top-Ideas { border-top: 4px solid #ffc107 !important; }    /* Amarillo */
    .border-top-Importante { border-top: 4px solid #6610f2 !important; } /* Morado */
</style>
@endsection

@section('content')
<div class="container">

    <!-- Barra Superior: Buscador -->
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2 class="fw-bold text-secondary">📝 Mis Notas</h2>
        </div>
        <div class="col-md-6">
            <form action="{{ route('notes.index') }}" method="GET" class="d-flex gap-2">
                <input type="text" name="q" class="form-control" placeholder="🔍 Buscar en notas..." value="{{ request('q') }}">
                @if(request('q'))
                    <a href="{{ route('notes.index') }}" class="btn btn-outline-secondary" title="Limpiar filtro">✖</a>
                @endif
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
        </div>
    </div>

    <!-- Formulario de Creación (Colapsible para ahorrar espacio) -->
    <div class="card mb-4 shadow-sm border-0 bg-white">
        <div class="card-body">
            <form action="{{ route('notes.store') }}" method="POST">
                @csrf
                <div class="row g-2">
                    <div class="col-md-4">
                        <input type="text" name="title" class="form-control fw-bold" placeholder="Título de la nota" required>
                    </div>
                    <div class="col-md-3">
                        <select name="category" class="form-select">
                            <option value="Personal">Personal</option>
                            <option value="Trabajo">Trabajo</option>
                            <option value="Ideas">Ideas 💡</option>
                            <option value="Importante">Importante ⚠️</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input type="text" name="content" class="form-control" placeholder="Escribe el contenido..." required>
                            <button class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Muro de Notas -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
        @foreach ($notes as $note)
            <div class="col">
                <div class="card h-100 shadow-sm border-0 border-top-{{ explode(' ', $note->category)[0] }}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-light text-dark border">{{ $note->category }}</span>

                            <form action="{{ route('notes.destroy', $note) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm text-muted p-0 border-0" onclick="return confirm('¿Borrar?')">✕</button>
                            </form>
                        </div>

                        <h5 class="card-title">{{ $note->title }}</h5>
                        <p class="card-text text-muted">{{ $note->content }}</p>
                        <p class="card-text"><small class="text-muted" style="font-size: 0.8rem">Creado: {{ $note->created_at->diffForHumans() }}</small></p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($notes->isEmpty())
        <div class="text-center py-5 text-muted">
            <p class="fs-4">No se encontraron notas 🍃</p>
        </div>
    @endif

</div>
@endsection
