@extends('layouts.app')

@section('title', 'Menú de Ejercicios')

@section('content')
<div class="text-center mb-5">
    <h1 class="display-5 fw-bold">Colección de Ejercicios</h1>
    <p class="lead text-muted">Selecciona una aplicación para probarla</p>
</div>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

    <!-- 1. Lista de Tareas -->
    <div class="col">
        <div class="card h-100 border-primary">
            <div class="card-body text-center">
                <div class="fs-1 mb-3">📝</div>
                <h5 class="card-title">1. Lista de Tareas</h5>
                <p class="card-text small">CRUD básico con base de datos.</p>
                <a href="{{ route('tasks.index') }}" class="btn btn-primary w-100">Entrar</a>
            </div>
        </div>
    </div>

    <!-- 2. Calculadora de Propinas -->
    <div class="col">
        <div class="card h-100 border-success">
            <div class="card-body text-center">
                <div class="fs-1 mb-3">💸</div>
                <h5 class="card-title">2. Propinas</h5>
                <p class="card-text small">Cálculos matemáticos e historial.</p>
                <a href="{{ route('tips.index') }}" class="btn btn-success w-100">Entrar</a>
            </div>
        </div>
    </div>

    <!-- 3. Generador Contraseñas -->
    <div class="col">
        <div class="card h-100 border-dark">
            <div class="card-body text-center">
                <div class="fs-1 mb-3">🔐</div>
                <h5 class="card-title">3. Password Gen</h5>
                <p class="card-text small">Seguridad y cadenas aleatorias.</p>
                <a href="{{ route('passwords.index') }}" class="btn btn-dark w-100">Entrar</a>
            </div>
        </div>
    </div>

    <!-- 4. Gestor de Gastos -->
    <div class="col">
        <div class="card h-100 border-warning">
            <div class="card-body text-center">
                <div class="fs-1 mb-3">💰</div>
                <h5 class="card-title">4. Gastos</h5>
                <p class="card-text small">Finanzas y categorías.</p>
                <a href="{{ route('expenses.index') }}" class="btn btn-warning w-100">Entrar</a>
            </div>
        </div>
    </div>

    <!-- 5. Reservas -->
    <div class="col">
        <div class="card h-100 border-info">
            <div class="card-body text-center">
                <div class="fs-1 mb-3">📅</div>
                <h5 class="card-title">5. Reservas</h5>
                <p class="card-text small">Validación de fechas y horarios.</p>
                <a href="{{ route('bookings.index') }}" class="btn btn-info w-100 text-white">Entrar</a>
            </div>
        </div>
    </div>

    <!-- 6. Notas -->
    <div class="col">
        <div class="card h-100 border-secondary">
            <div class="card-body text-center">
                <div class="fs-1 mb-3">📌</div>
                <h5 class="card-title">6. Notas</h5>
                <p class="card-text small">Buscador en tiempo real.</p>
                <a href="{{ route('notes.index') }}" class="btn btn-secondary w-100">Entrar</a>
            </div>
        </div>
    </div>

    <!-- 7. Calendario -->
    <div class="col">
        <div class="card h-100">
            <div class="card-body text-center">
                <div class="fs-1 mb-3">🗓️</div>
                <h5 class="card-title">7. Calendario</h5>
                <p class="card-text small">Lógica de fechas y grillas.</p>
                <a href="{{ route('calendar.index') }}" class="btn btn-primary w-100">Entrar</a>
            </div>
        </div>
    </div>

    <!-- 8. Recetas -->
    <div class="col">
        <div class="card h-100 border-danger">
            <div class="card-body text-center">
                <div class="fs-1 mb-3">🍳</div>
                <h5 class="card-title">8. Recetas</h5>
                <p class="card-text small">Filtros y modales.</p>
                <a href="{{ route('recipes.index') }}" class="btn btn-danger w-100">Entrar</a>
            </div>
        </div>
    </div>

    <!-- 9. Memoria -->
    <div class="col">
        <div class="card h-100 border-success">
            <div class="card-body text-center">
                <div class="fs-1 mb-3">🧠</div>
                <h5 class="card-title">9. Memoria</h5>
                <p class="card-text small">Juego interactivo y puntajes.</p>
                <a href="{{ route('memory.index') }}" class="btn btn-success w-100">Entrar</a>
            </div>
        </div>
    </div>

    <!-- 10. Encuestas -->
    <div class="col">
        <div class="card h-100 border-primary">
            <div class="card-body text-center">
                <div class="fs-1 mb-3">📊</div>
                <h5 class="card-title">10. Encuestas</h5>
                <p class="card-text small">Votaciones y gráficos.</p>
                <a href="{{ route('surveys.index') }}" class="btn btn-primary w-100">Entrar</a>
            </div>
        </div>
    </div>

    <!-- 11. Cronómetro -->
    <div class="col">
        <div class="card h-100 border-dark">
            <div class="card-body text-center">
                <div class="fs-1 mb-3">⏱️</div>
                <h5 class="card-title">11. Cronómetro</h5>
                <p class="card-text small">JS en tiempo real + PHP.</p>
                <a href="{{ route('timer.index') }}" class="btn btn-dark w-100">Entrar</a>
            </div>
        </div>
    </div>

</div>
@endsection
