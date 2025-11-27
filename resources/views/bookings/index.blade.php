@extends('layouts.app')

@section('title', 'Sistema de Reservas')

@section('content')
<div class="row">
    <!-- Columna Izquierda: Formulario -->
    <div class="col-md-5 mb-4">
        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">📅 Nueva Cita</h4>
            </div>
            <div class="card-body">

                <!-- Mostrar errores de validación -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Tu Nombre</label>
                        <input type="text" name="client" class="form-control" value="{{ old('client') }}" placeholder="Ej: Juan Pérez" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Servicio</label>
                        <select name="service" class="form-select">
                            <option value="Corte de Cabello">💇‍♂️ Corte de Cabello</option>
                            <option value="Manicure">💅 Manicure</option>
                            <option value="Masaje">💆‍♀️ Masaje</option>
                            <option value="Consulta General">👨‍⚕️ Consulta General</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" name="date" class="form-control" value="{{ old('date') }}" min="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hora</label>
                        <select name="time" class="form-select">
                            <option value="09:00">09:00 AM</option>
                            <option value="10:00">10:00 AM</option>
                            <option value="11:00">11:00 AM</option>
                            <option value="14:00">02:00 PM</option>
                            <option value="15:00">03:00 PM</option>
                            <option value="16:00">04:00 PM</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-info text-white w-100 fw-bold">Confirmar Reserva</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Columna Derecha: Lista -->
    <div class="col-md-7">
        <h4 class="mb-3">Próximas Citas</h4>

        @if($bookings->isEmpty())
            <div class="alert alert-light border text-center text-muted">
                No hay citas programadas. ¡Sé el primero!
            </div>
        @else
            <div class="list-group shadow-sm">
                @foreach ($bookings as $booking)
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <div class="d-flex align-items-center gap-2">
                                <h5 class="mb-0 text-dark">{{ $booking->service }}</h5>
                                <span class="badge bg-warning text-dark">{{ $booking->time }}</span>
                            </div>
                            <small class="text-muted">
                                📅 {{ $booking->date->format('d/m/Y') }} &nbsp; | &nbsp; 👤 {{ $booking->client }}
                            </small>
                        </div>

                        <form action="{{ route('bookings.destroy', $booking) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Cancelar cita?')">Cancelar</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
