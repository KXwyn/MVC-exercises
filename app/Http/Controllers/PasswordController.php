<?php

namespace App\Http\Controllers;

use App\Models\GeneratedPassword;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function index()
    {
        // Historial: últimas 10 contraseñas
        $history = GeneratedPassword::orderBy('created_at', 'desc')->take(10)->get();
        return view('passwords.index', compact('history'));
    }

    public function store(Request $request)
    {
        // Validamos
        $request->validate([
            'length' => 'required|integer|min:4|max:32',
        ]);

        $length = $request->length;
        $useUpper = $request->has('use_upper');
        $useNumbers = $request->has('use_numbers');
        $useSymbols = $request->has('use_symbols');

        // Lógica de generación
        $charsLower = 'abcdefghijklmnopqrstuvwxyz';
        $charsUpper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charsNum   = '0123456789';
        $charsSym   = '!@#$%^&*()-_=+?';

        $pool = $charsLower;
        if ($useUpper) $pool .= $charsUpper;
        if ($useNumbers) $pool .= $charsNum;
        if ($useSymbols) $pool .= $charsSym;

        $password = '';
        $maxIndex = strlen($pool) - 1;

        for ($i = 0; $i < $length; $i++) {
            $password .= $pool[random_int(0, $maxIndex)];
        }

        // Guardar en BD
        GeneratedPassword::create([
            'password' => $password,
            'length' => $length
        ]);

        // Redirigir con la contraseña generada en una variable de sesión
        return redirect()->route('passwords.index')
            ->with('generated_password', $password);
    }
}
