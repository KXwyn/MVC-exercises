@extends('layouts.app')

@section('title', 'Juego de Memoria')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 text-center">

        <h1 class="display-4 mb-3">🧠 Memory Game</h1>
        <p class="lead mb-5">Encuentra los pares en el menor número de movimientos.</p>

        <!-- Selección de Nivel -->
        <div class="card shadow mb-5">
            <div class="card-body p-5">
                <h3>🎮 ¡A Jugar!</h3>
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="{{ route('memory.play', ['level' => 'easy']) }}" class="btn btn-success btn-lg px-5">
                        Fácil (4x3)
                    </a>
                    <a href="{{ route('memory.play', ['level' => 'hard']) }}" class="btn btn-danger btn-lg px-5">
                        Difícil (4x4)
                    </a>
                </div>
            </div>
        </div>

        <!-- Tabla de Récords -->
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark fw-bold">
                🏆 Top 5 Mejores Jugadores
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Jugador</th>
                            <th>Movimientos</th>
                            <th>Nivel</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($scores as $s)
                            <tr>
                                <td class="fw-bold">{{ $s->player }}</td>
                                <td>{{ $s->moves }}</td>
                                <td>
                                    <span class="badge bg-{{ $s->level == 'easy' ? 'success' : 'danger' }}">
                                        {{ ucfirst($s->level) }}
                                    </span>
                                </td>
                                <td class="text-muted small">{{ $s->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($scores->isEmpty())
                    <div class="p-4 text-muted">Aún no hay récords. ¡Sé el primero!</div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
