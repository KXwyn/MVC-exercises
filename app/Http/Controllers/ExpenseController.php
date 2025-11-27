<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        // Traemos todos los gastos ordenados por fecha (más reciente primero)
        $expenses = Expense::orderBy('created_at', 'desc')->get();

        // Calculamos el total automáticamente
        $total = $expenses->sum('amount');

        return view('expenses.index', compact('expenses', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'amount' => 'required|numeric|min:0',
            'category' => 'required'
        ]);

        Expense::create($request->all());

        return redirect()->route('expenses.index')->with('success', 'Gasto registrado correctamente.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Gasto eliminado.');
    }
}
