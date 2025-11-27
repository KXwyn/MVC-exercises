<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class GameController extends Controller
{
    // Pantalla de Inicio y Récords
    public function index()
    {
        // Traemos los 5 mejores puntajes (menos movimientos es mejor)
        $scores = Score::orderBy('moves', 'asc')->take(5)->get();
        return view('memory.index', compact('scores'));
    }

    // Tablero de Juego
    public function play(Request $request)
    {
        $level = $request->get('level', 'easy');

        // Configuración
        $numPairs = ($level == 'hard') ? 8 : 6; // 16 cartas o 12 cartas

        // Iconos disponibles
        $icons = ['🍕', '🚀', '🐱', '🌵', '🎈', '💎', '🎸', '🍦', '🚲', '⚓'];

        // Seleccionamos y duplicamos
        $selected = array_slice($icons, 0, $numPairs);
        $deck = array_merge($selected, $selected);

        // Barajamos aleatoriamente
        shuffle($deck);

        return view('memory.board', compact('deck', 'level'));
    }

    // Guardar Récord
    public function store(Request $request)
    {
        $request->validate([
            'player' => 'required',
            'moves' => 'required|integer',
            'level' => 'required'
        ]);

        Score::create($request->all());

        return redirect()->route('memory.index')->with('success', '¡Récord guardado!');
    }
}
