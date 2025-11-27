<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = ['question'];

    // Relación: Una encuesta tiene muchas opciones
    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
