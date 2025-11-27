@extends('layouts.app')

@section('title', 'Gestor de Gastos')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">

        <!-- Tarjeta de Resumen -->
        <div class="card bg-primary text-white mb-4 shadow text-center">
            <div class="card-body">
                <h5 class="card-title opacity-75">Total Gastado</h5>
                <h1 class="display-4 fw-bold">${{ number_format($total, 2) }}</h1>
            </div>
        </div>

        <!-- Formulario -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-3">Registrar Nuevo Gasto</h5>
                <form action="{{ route('expenses.store') }}" method="POST" class="row g-2">
                    @csrf
                    <div class="col-md-5">
                        <input type="text" name="description" class="form-control" placeholder="Descripción (ej: Almuerzo)" required>
                    </div>
                    <div class="col-md-3">
                        <input type="number" step="0.01" name="amount" class="form-control" placeholder="Monto $" required>
                    </div>
                    <div class="col-md-3">
                        <select name="category" class="form-select">
                            <option value="Comida">🍔 Comida</option>
                            <option value="Transporte">🚌 Transporte</option>
                            <option value="Hogar">🏠 Hogar</option>
                            <option value="Ocio">🎉 Ocio</option>
                            <option value="Otros">📦 Otros</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-success w-100">✔</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabla de Movimientos -->
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Movimientos Recientes</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Categoría</th>
                            <th class="text-end">Monto</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $expense)
                            <tr>
                                <td class="text-muted small">{{ $expense->created_at->format('d/m/Y') }}</td>
                                <td>{{ $expense->description }}</td>
                                <td>
                                    <!-- Lógica simple para colores en la vista -->
                                    @php
                                        $colors = [
                                            'Comida' => 'warning',
                                            'Transporte' => 'info',
                                            'Hogar' => 'primary',
                                            'Ocio' => 'success',
                                            'Otros' => 'secondary'
                                        ];
                                        $color = $colors[$expense->category] ?? 'secondary';
                                    @endphp
                                    <span class="badge bg-{{ $color }} text-dark bg-opacity-25 border border-{{ $color }}">
                                        {{ $expense->category }}
                                    </span>
                                </td>
                                <td class="text-end fw-bold text-danger">
                                    -${{ number_format($expense->amount, 2) }}
                                </td>
                                <td class="text-end">
                                    <form action="{{ route('expenses.destroy', $expense) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('¿Borrar?')">✕</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($expenses->isEmpty())
                <div class="p-4 text-center text-muted">
                    No hay gastos registrados aún.
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
