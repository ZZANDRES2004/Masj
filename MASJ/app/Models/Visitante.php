<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    protected $table = 'visitante';
    protected $primaryKey = 'idVisitante';
    public $timestamps = false;

    protected $fillable = [
        'Nombres_visitante', 'ApellidosVisitante', 'TipoDocumento',
        'NumDocumento', 'idGuardia', 'apartamento', 'hora_entrada', 'hora_salida'
    ];

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, 'idVisitante');
    }
}
