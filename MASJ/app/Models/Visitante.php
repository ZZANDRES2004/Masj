<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    protected $table = 'visitante';
    protected $primaryKey = 'idVisitante';
    public $timestamps = false;

    protected $fillable = [
        'NombresVisitante',
        'ApellidosVisitante',
        'TipoDocumento',
        'NumDocumento',
        'apartamento',
        'hora_entrada',
        'hora_salida',
    ];

    public function getRouteKeyName()
    {
        return 'idVisitante';
    }

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, 'idVisitante');
    }
}


