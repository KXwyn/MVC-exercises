<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{
    use HasFactory;

    protected $fillable = ['duration', 'laps'];

    // ¡Magia! Laravel convierte el JSON de la BD a Array automáticamente
    protected $casts = [
        'laps' => 'array'
    ];
}
