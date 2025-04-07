<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'vehiculos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'PlacaVehiculo',
        'MarcaVehiculo',
        'ModeloVehiculo',
        'hora_ingreso',
        'hora_salida',
        'valor_pagado',
        'idBahia',
    ];

    public function parqueadero()
    {
        return $this->belongsTo(Parqueadero::class, 'idBahia');
    }
}

