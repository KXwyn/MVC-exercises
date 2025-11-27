@extends('layouts.app')

@section('title', 'Encuestas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>📊 Encuestas Disponibles</h2>
    <a href="{{ route('surveys.create') }}" class="btn btn-primary">+ Nueva Encuesta</a>
</div>

<div class="row g-4">
    @foreach($surveys as $survey)
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $survey->question }}</h5>
                    <p class="text-muted small">
                        Creada {{ $survey->created_at->diffForHumans() }}
                    </p>
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <a href="{{ route('surveys.show', $survey) }}" class="btn btn-success btn-sm">🗳 Votar</a>
                        <a href="{{ route('surveys.results', $survey) }}" class="btn btn-outline-primary btn-sm">📈 Resultados</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @if($surveys->isEmpty())
        <div class="col-12 text-center text-muted">No hay encuestas activas.</div>
    @endif
</div>
@endsection
