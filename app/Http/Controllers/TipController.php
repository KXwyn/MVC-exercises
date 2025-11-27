<?php


namespace App\Http\Controllers;

use App\Models\Tip;
use Illuminate\Http\Request;

class TipController extends Controller
{
    public function index() {
        // Traemos el historial (últimos 5 para no saturar)
        $history = Tip::orderBy('created_at', 'desc')->take(5)->get();
        return view('tips.index', compact('history'));
    }

    public function store(Request $request) {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'percentage' => 'required|integer|min:0'
        ]);

        $amount = $request->amount;
        $pct = $request->percentage;

        // Cálculos matemáticos
        $tipAmount = $amount * ($pct / 100);
        $total = $amount + $tipAmount;

        // Guardar en BD
        Tip::create([
            'amount' => $amount,
            'percentage' => $pct,
            'tip_amount' => $tipAmount,
            'total' => $total
        ]);

        // Redirigir con un mensaje de "sesión" para mostrar el resultado arriba
        return redirect()->route('tips.index')
            ->with('latest_tip', $tipAmount)
            ->with('latest_total', $total);
    }
}
