<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'vehiculos';
    protected $primaryKey = 'idVehiculo'; // Asegúrate de usar el nombre correcto de tu PK
    public $timestamps = false;

    protected $fillable = [
        'Placa',
        'Marca',
        'Tipo',
        'Color',
        'idParqueadero',
        'idVisitante', // solo si tu modelo lo relaciona
    ];

    // Relación con Parqueadero
    public function parqueadero()
    {
        return $this->belongsTo(Parqueadero::class, 'idParqueadero');
    }

    // (Opcional) Relación con Visitante si aplica
    public function visitante()
    {
        return $this->belongsTo(Visitante::class, 'idVisitante');
    }
}

