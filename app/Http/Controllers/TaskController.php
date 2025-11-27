<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Mostrar lista
    public function index() {
        // Obtenemos todas las tareas ordenadas por fecha
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return view('tasks.index', compact('tasks'));
    }

    // Guardar tarea
    public function store(Request $request) {
        $request->validate(['description' => 'required']);

        Task::create([
            'description' => $request->description
        ]);

        return redirect()->route('tasks.index');
    }

    // Completar/Descompletar
    public function toggle(Task $task) {
        $task->update([
            'is_completed' => !$task->is_completed
        ]);
        return redirect()->back();
    }

    // Eliminar
    public function destroy(Task $task) {
        $task->delete();
        return redirect()->back();
    }
}
