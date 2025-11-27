<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tareas (Laravel)</title>
    <!-- Usamos Bootstrap para ir rápido con estilos bonitos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .completed { text-decoration: line-through; color: gray; }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 600px;">
        <a href="/" class="btn btn-secondary mb-3">⬅ Volver al Menú</a>

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">📝 Mis Tareas</h3>
            </div>
            <div class="card-body">
                <!-- Formulario -->
                <form action="{{ route('tasks.store') }}" method="POST" class="d-flex gap-2 mb-4">
                    @csrf <!-- Token de seguridad OBLIGATORIO en Laravel -->
                    <input type="text" name="description" class="form-control" placeholder="Nueva tarea..." required>
                    <button type="submit" class="btn btn-success">Agregar</button>
                </form>

                <!-- Lista -->
                <ul class="list-group">
                    @foreach ($tasks as $task)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="{{ $task->is_completed ? 'completed' : '' }}">
                                {{ $task->description }}
                            </span>
                            <div>
                                <!-- Botón Completar -->
                                <form action="{{ route('tasks.toggle', $task) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm {{ $task->is_completed ? 'btn-warning' : 'btn-outline-success' }}">
                                        {{ $task->is_completed ? '↩' : '✔' }}
                                    </button>
                                </form>

                                <!-- Botón Eliminar -->
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">🗑</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
