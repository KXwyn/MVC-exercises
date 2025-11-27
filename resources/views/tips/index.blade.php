<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calculadora de Propinas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 500px;">
        <a href="/" class="btn btn-secondary mb-3">⬅ Volver al Menú</a>

        <div class="card shadow">
            <div class="card-header bg-success text-white text-center">
                <h3>💸 Calculadora de Propinas</h3>
            </div>
            <div class="card-body">

                <!-- Si acabamos de calcular, mostrar resultado grande -->
                @if (session('latest_total'))
                    <div class="alert alert-success text-center">
                        <h5>Propina: ${{ number_format(session('latest_tip'), 2) }}</h5>
                        <h2 class="fw-bold">Total: ${{ number_format(session('latest_total'), 2) }}</h2>
                    </div>
                @endif

                <!-- Formulario -->
                <form action="{{ route('tips.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Total de la Cuenta ($)</label>
                        <input type="number" step="0.01" name="amount" class="form-control" required placeholder="Ej: 100.00">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Porcentaje de Propina</label>
                        <select name="percentage" class="form-select">
                            <option value="10">10% (Normal)</option>
                            <option value="15">15% (Bueno)</option>
                            <option value="20">20% (Excelente)</option>
                            <option value="30">30% (Increíble)</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Calcular</button>
                </form>
            </div>
        </div>

        <!-- Historial -->
        <div class="mt-4">
            <h5 class="text-muted">Historial Reciente</h5>
            <ul class="list-group">
                @foreach ($history as $tip)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            ${{ number_format($tip->amount, 2) }} + {{ $tip->percentage }}%
                        </span>
                        <span class="fw-bold text-success">
                            = ${{ number_format($tip->total, 2) }}
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</body>
</html>
