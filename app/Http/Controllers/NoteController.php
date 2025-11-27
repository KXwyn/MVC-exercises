<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        // Iniciamos la consulta base
        $query = Note::orderBy('created_at', 'desc');

        // Si hay búsqueda (?q=algo)
        if ($request->has('q')) {
            $search = $request->q;
            // Filtramos por título O contenido O categoría
            // Usamos 'LIKE' y los signos % para buscar coincidencias parciales
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%")
                  ->orWhere('category', 'LIKE', "%{$search}%");
            });
        }

        $notes = $query->get();

        return view('notes.index', compact('notes'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'content' => 'required',
            'category' => 'required'
        ]);

        Note::create($validatedData);

        return redirect()->route('notes.index')->with('success', 'Nota creada.');
    }
    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->route('notes.index')->with('success', 'Nota eliminada.');
    }
}
