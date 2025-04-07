<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'vehiculos';
    protected $primaryKey = 'idVehiculo';
    public $timestamps = false;

    protected $fillable = [
        'PlacaVehiculo',
        'MarcaVehiculo',
        'ModeloVehiculo',
        'idBahia',
        'idResidente',
        'idVisitante',
        'hora_ingreso',
        'hora_salida',
        'valor_pagado'
    ];

    public function parqueadero()
    {
        return $this->belongsTo(Parqueadero::class, 'idBahia');
    }
}

