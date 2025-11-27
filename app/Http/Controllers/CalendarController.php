<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon; // ¡Importante importar esto!

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        // 1. Obtener fecha actual o la solicitada
        // Si no vienen datos, usamos hoy.
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);

        // Creamos una fecha Carbon centrada en el día 1 de ese mes
        $date = Carbon::createFromDate($year, $month, 1);

        // 2. Navegación (Mes anterior / siguiente)
        $prev = $date->copy()->subMonth();
        $next = $date->copy()->addMonth();

        // 3. Cálculos del Calendario
        $daysInMonth = $date->daysInMonth;

        // Calcular espacios en blanco al inicio (para empezar en Lunes)
        // Carbon dayOfWeek: 0=Domingo, 1=Lunes ... 6=Sábado
        // Queremos Lunes=0 ... Domingo=6
        $startDay = ($date->dayOfWeek + 6) % 7;

        // 4. Obtener eventos del mes
        // Filtramos por año y mes
        $events = Event::whereYear('date', $year)
                       ->whereMonth('date', $month)
                       ->get();

        return view('calendar.index', compact(
            'date', 'prev', 'next', 'daysInMonth', 'startDay', 'events'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'date'  => 'required|date',
            'color' => 'required'
        ]);

        Event::create($request->all());

        // Redirigir al mes donde se creó el evento
        $date = Carbon::parse($request->date);

        return redirect()->route('calendar.index', [
            'month' => $date->month,
            'year' => $date->year
        ])->with('success', 'Evento agregado.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return back()->with('success', 'Evento eliminado.');
    }
}
