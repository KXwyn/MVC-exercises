@extends('layouts.app')

@section('title', 'Plataforma de Recetas')

@section('content')
<div class="container">

    <!-- Barra de Filtros -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <div class="row g-2 align-items-center">
                <div class="col-md-3">
                    <h4 class="mb-0 text-danger fw-bold">🍳 Cocina Fácil</h4>
                </div>
                <div class="col-md-9">
                    <form action="{{ route('recipes.index') }}" method="GET" class="row g-2">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Buscar ingrediente o plato..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="category" class="form-select" onchange="this.form.submit()">
                                <option value="Todas">Todas las categorías</option>
                                <option value="Desayuno" {{ request('category') == 'Desayuno' ? 'selected' : '' }}>🥞 Desayuno</option>
                                <option value="Almuerzo" {{ request('category') == 'Almuerzo' ? 'selected' : '' }}>🍝 Almuerzo</option>
                                <option value="Cena" {{ request('category') == 'Cena' ? 'selected' : '' }}>🥗 Cena</option>
                                <option value="Postre" {{ request('category') == 'Postre' ? 'selected' : '' }}>🍰 Postre</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-outline-secondary w-100">Filtrar</button>
                        </div>
                        <div class="col-md-3 text-end">
                            <!-- Botón que abre el Modal -->
                            <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#createRecipeModal">
                                + Nueva Receta
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Grid de Recetas -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($recipes as $recipe)
            <div class="col">
                <div class="card h-100 shadow border-0">
                    <!-- Imagen de relleno automática -->
                    <img src="https://via.placeholder.com/300x150/e9ecef/adb5bd?text={{ urlencode($recipe->title) }}" class="card-img-top" alt="...">

                    <div class="card-body">
                        <span class="badge bg-danger bg-opacity-10 text-danger mb-2">{{ $recipe->category }}</span>
                        <h5 class="card-title fw-bold">{{ $recipe->title }}</h5>

                        <p class="card-text text-muted small">
                            <strong>Ingredientes:</strong><br>
                            {{ Str::limit($recipe->ingredients, 60) }}
                        </p>

                        <div class="collapse" id="desc-{{ $recipe->id }}">
                            <hr>
                            <small class="d-block mb-2"><strong>Preparación:</strong></small>
                            <p class="small text-muted">{{ $recipe->instructions }}</p>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 d-flex justify-content-between">
                        <button class="btn btn-sm btn-link text-danger text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#desc-{{ $recipe->id }}">
                            Ver preparación
                        </button>

                        <form action="{{ route('recipes.destroy', $recipe) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm text-secondary" onclick="return confirm('¿Borrar?')">🗑</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($recipes->isEmpty())
        <div class="text-center mt-5 text-muted">
            <h3>🍽</h3>
            <p>No se encontraron recetas.</p>
        </div>
    @endif
</div>

<!-- MODAL para Nueva Receta -->
<div class="modal fade" id="createRecipeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Nueva Receta</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('recipes.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nombre del Plato</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Categoría</label>
                        <select name="category" class="form-select">
                            <option value="Desayuno">🥞 Desayuno</option>
                            <option value="Almuerzo">🍝 Almuerzo</option>
                            <option value="Cena">🥗 Cena</option>
                            <option value="Postre">🍰 Postre</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ingredientes</label>
                        <textarea name="ingredients" class="form-control" rows="2" placeholder="Ej: Harina, huevos, leche..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Preparación</label>
                        <textarea name="instructions" class="form-control" rows="4" placeholder="Pasos a seguir..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Guardar Receta</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
