<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'date', 'color'];

    // Convertimos 'date' automáticamente a objeto Carbon
    protected $casts = [
        'date' => 'date'
    ];
}
