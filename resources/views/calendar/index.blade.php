@extends('layouts.app')

@section('title', 'Calendario de Eventos')

@section('styles')
<style>
    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 1px;
        background: #ddd;
        border: 1px solid #ddd;
    }
    .day-name {
        background: #343a40;
        color: white;
        text-align: center;
        padding: 10px 0;
        font-weight: bold;
    }
    .day-cell {
        background: white;
        min-height: 120px;
        padding: 5px;
        position: relative;
    }
    .day-cell.empty { background: #f8f9fa; }
    .day-cell.today { background: #e8f8f5; border: 2px solid #20c997; }
    .day-number { font-weight: bold; color: #6c757d; text-align: right; display: block; margin-bottom: 5px; }

    .event-badge {
        display: block;
        color: white;
        font-size: 0.75rem;
        padding: 2px 5px;
        margin-bottom: 2px;
        border-radius: 3px;
        text-decoration: none;
        transition: opacity 0.2s;
        cursor: pointer;
    }
    .event-badge:hover { opacity: 0.8; color: white; }
</style>
@endsection

@section('content')
<div class="container-fluid px-4">

    <!-- Cabecera y Navegación -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('calendar.index', ['month' => $prev->month, 'year' => $prev->year]) }}" class="btn btn-outline-dark">
            ◀ Anterior
        </a>

        <h2 class="fw-bold text-uppercase">
            {{-- Array manual de meses para evitar problemas de idioma --}}
            @php
                $meses = [1=>'Enero', 2=>'Febrero', 3=>'Marzo', 4=>'Abril', 5=>'Mayo', 6=>'Junio',
                          7=>'Julio', 8=>'Agosto', 9=>'Septiembre', 10=>'Octubre', 11=>'Noviembre', 12=>'Diciembre'];
            @endphp
            {{ $meses[$date->month] }} {{ $date->year }}
        </h2>

        <a href="{{ route('calendar.index', ['month' => $next->month, 'year' => $next->year]) }}" class="btn btn-outline-dark">
            Siguiente ▶
        </a>
    </div>

    <!-- Formulario Rápido -->
    <div class="card mb-4 shadow-sm bg-light">
        <div class="card-body py-2">
            <form action="{{ route('calendar.store') }}" method="POST" class="row g-2 align-items-center">
                @csrf
                <div class="col-auto"><span class="fw-bold">Nuevo Evento:</span></div>
                <div class="col-md-4">
                    <input type="text" name="title" class="form-control form-control-sm" placeholder="Título del evento" required>
                </div>
                <div class="col-md-3">
                    <input type="date" name="date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="col-md-2">
                    <select name="color" class="form-select form-select-sm">
                        <option value="#0d6efd">Azul</option>
                        <option value="#dc3545">Rojo</option>
                        <option value="#198754">Verde</option>
                        <option value="#ffc107">Amarillo</option>
                        <option value="#6f42c1">Morado</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button class="btn btn-sm btn-dark">Agregar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- CALENDARIO -->
    <div class="calendar-grid shadow">
        <!-- Nombres de días -->
        <div class="day-name">Lun</div>
        <div class="day-name">Mar</div>
        <div class="day-name">Mié</div>
        <div class="day-name">Jue</div>
        <div class="day-name">Vie</div>
        <div class="day-name">Sáb</div>
        <div class="day-name">Dom</div>

        <!-- Celdas vacías (mes anterior) -->
        @for($i = 0; $i < $startDay; $i++)
            <div class="day-cell empty"></div>
        @endfor

        <!-- Días del mes -->
        @for($day = 1; $day <= $daysInMonth; $day++)
            @php
                // Construimos la fecha actual YYYY-MM-DD
                $currentDateStr = $date->copy()->day($day)->format('Y-m-d');
                $isToday = ($currentDateStr == now()->format('Y-m-d'));
            @endphp

            <div class="day-cell {{ $isToday ? 'today' : '' }}">
                <span class="day-number">{{ $day }}</span>

                <!-- Buscamos eventos de este día -->
                @foreach($events as $event)
                    @if($event->date->format('Y-m-d') == $currentDateStr)
                        <div class="dropdown">
                            <span class="event-badge dropdown-toggle"
                                  style="background-color: {{ $event->color }}"
                                  data-bs-toggle="dropdown">
                                {{ $event->title }}
                            </span>
                            <ul class="dropdown-menu">
                                <li>
                                    <form action="{{ route('calendar.destroy', $event) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="dropdown-item text-danger" onclick="return confirm('¿Borrar?')">Eliminar</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endif
                @endforeach
            </div>
        @endfor
    </div>

</div>
@endsection
