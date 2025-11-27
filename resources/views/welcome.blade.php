<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Taller Laravel MVC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center mb-5">🚀 Ejercicios MVC en Laravel</h1>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <!-- Ejercicio 1 -->
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">1. Lista de Tareas</h5>
                        <p class="card-text">CRUD básico con Base de Datos.</p>
                        <a href="{{ route('tasks.index') }}" class="btn btn-primary">Ir al ejercicio</a>
                    </div>
                </div>
            </div>
            <!-- Ejercicio 2 -->
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">2. Calculadora Propinas</h5>
                        <p class="card-text">Cálculo matemático con historial en BD.</p>
                        <a href="{{ route('tips.index') }}" class="btn btn-success">Ir al ejercicio</a>
                    </div>
                </div>
            </div>

            <!-- Aquí agregaremos los demás... -->

        </div>
    </div>
</body>
</html>
