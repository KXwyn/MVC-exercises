<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Option;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index()
    {
        // Traemos las encuestas con sus opciones y contamos el total de votos de cada una
        $surveys = Survey::with('options')->latest()->get();
        return view('surveys.index', compact('surveys'));
    }

    public function create()
    {
        return view('surveys.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'options'  => 'required' // String separado por comas
        ]);

        // 1. Crear la encuesta
        $survey = Survey::create(['question' => $request->question]);

        // 2. Procesar opciones (separar por coma)
        $optionsArray = explode(',', $request->options);

        foreach ($optionsArray as $optText) {
            if (trim($optText) !== '') {
                // Crear la opción vinculada a la encuesta
                $survey->options()->create([
                    'text' => trim($optText),
                    'votes' => 0
                ]);
            }
        }

        return redirect()->route('surveys.index')->with('success', 'Encuesta creada.');
    }

    // Mostrar formulario para votar
    public function show(Survey $survey)
    {
        return view('surveys.show', compact('survey'));
    }

    // Guardar el voto
    public function vote(Request $request, Survey $survey)
    {
        $request->validate(['option_id' => 'required']);

        // Buscar la opción y sumar 1 voto
        $option = Option::findOrFail($request->option_id);
        $option->increment('votes');

        return redirect()->route('surveys.results', $survey->id);
    }

    // Ver resultados
    public function results(Survey $survey)
    {
        // Cargar opciones
        $survey->load('options');

        // Calcular total de votos de toda la encuesta
        $totalVotes = $survey->options->sum('votes');

        return view('surveys.results', compact('survey', 'totalVotes'));
    }
}
