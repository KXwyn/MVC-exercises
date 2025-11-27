<?php

namespace App\Http\Controllers;

use App\Models\Timer;
use Illuminate\Http\Request;

class TimerController extends Controller
{
    public function index()
    {
        // Traemos el historial (últimos 10)
        $history = Timer::orderBy('created_at', 'desc')->take(10)->get();
        return view('timer.index', compact('history'));
    }

    public function store(Request $request)
    {
        // El JS nos enviará 'laps' como una cadena JSON,
        // pero necesitamos decodificarla antes de pasarla al modelo
        // para que el Cast de Laravel funcione correctamente.

        $lapsArray = json_decode($request->laps, true) ?? [];

        Timer::create([
            'duration' => $request->duration,
            'laps' => $lapsArray
        ]);

        return redirect()->route('timer.index')->with('success', 'Sesión guardada en el historial.');
    }

    public function destroy(Timer $timer)
    {
        $timer->delete();
        return back()->with('success', 'Registro eliminado.');
    }
}
