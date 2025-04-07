<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'documento',
        'apartamento',
        'hora_entrada',
        'hora_salida'
    ];
}
