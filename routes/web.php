<?php

use App\Http\Controllers\PasswordController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\TimerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Rutas Ejercicio 1
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

// Rutas Ejercicio 2
Route::get('/tips', [TipController::class, 'index'])->name('tips.index');
Route::post('/tips', [TipController::class, 'store'])->name('tips.store');

// Ejercicio 3
Route::get('/passwords', [PasswordController::class, 'index'])->name('passwords.index');
Route::post('/passwords', [PasswordController::class, 'store'])->name('passwords.store');

// Ejercicio 4
Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');
Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');

// Ejercicio 5
Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');

// Ejercicio 6
Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');

// Ejercicio 7
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
Route::post('/calendar', [CalendarController::class, 'store'])->name('calendar.store');
Route::delete('/calendar/{event}', [CalendarController::class, 'destroy'])->name('calendar.destroy');

// Ejercicio 8
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('recipes.destroy');

// Ejercicio 9
Route::get('/memory', [GameController::class, 'index'])->name('memory.index');
Route::get('/memory/play', [GameController::class, 'play'])->name('memory.play');
Route::post('/memory', [GameController::class, 'store'])->name('memory.store');

// Ejercicio 10
Route::get('/surveys', [SurveyController::class, 'index'])->name('surveys.index');
Route::get('/surveys/create', [SurveyController::class, 'create'])->name('surveys.create');
Route::post('/surveys', [SurveyController::class, 'store'])->name('surveys.store');
Route::get('/surveys/{survey}', [SurveyController::class, 'show'])->name('surveys.show');
Route::post('/surveys/{survey}/vote', [SurveyController::class, 'vote'])->name('surveys.vote');
Route::get('/surveys/{survey}/results', [SurveyController::class, 'results'])->name('surveys.results');

// Ejercicio 11
Route::get('/timer', [TimerController::class, 'index'])->name('timer.index');
Route::post('/timer', [TimerController::class, 'store'])->name('timer.store');
Route::delete('/timer/{timer}', [TimerController::class, 'destroy'])->name('timer.destroy');
