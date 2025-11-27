<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        // Traer citas ordenadas por fecha y hora
        $bookings = Booking::orderBy('date')->orderBy('time')->get();
        return view('bookings.index', compact('bookings'));
    }

    public function store(Request $request)
    {
        // 1. Validar campos básicos
        $request->validate([
            'client' => 'required',
            'service' => 'required',
            'date' => 'required|date|after_or_equal:today', // No permitir fechas pasadas
            'time' => 'required'
        ]);

        // 2. VALIDACIÓN DE DISPONIBILIDAD (Lógica de Negocio)
        // Buscamos si ya existe una cita en esa misma fecha y hora
        $exists = Booking::where('date', $request->date)
                         ->where('time', $request->time)
                         ->exists();

        if ($exists) {
            // Si existe, regresamos atrás con un error
            return back()->withErrors(['time' => '⚠️ Lo sentimos, ese horario ya está reservado. Intenta otro.'])->withInput();
        }

        // 3. Crear Reserva
        Booking::create($request->all());

        return redirect()->route('bookings.index')->with('success', '¡Cita agendada correctamente!');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Cita cancelada.');
    }
}
