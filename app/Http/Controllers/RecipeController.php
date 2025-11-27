<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        // Iniciamos la consulta
        $query = Recipe::orderBy('created_at', 'desc');

        // Filtro por Categoría (Si no es 'Todas')
        if ($request->has('category') && $request->category != 'Todas') {
            $query->where('category', $request->category);
        }

        // Filtro por Búsqueda (Título o Ingredientes)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('ingredients', 'LIKE', "%{$search}%");
            });
        }

        $recipes = $query->get();

        return view('recipes.index', compact('recipes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'ingredients' => 'required',
            'instructions' => 'required',
            'category' => 'required'
        ]);

        Recipe::create($request->all());

        return redirect()->route('recipes.index')->with('success', '¡Receta guardada!');
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return back()->with('success', 'Receta borrada.');
    }
}
