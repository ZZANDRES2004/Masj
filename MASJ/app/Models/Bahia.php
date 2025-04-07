<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bahia extends Model
{
    protected $table = 'parqueadero';
    protected $primaryKey = 'idBahia';
    public $timestamps = true;

    protected $fillable = [
        'Novedad',
        'Estado',
    ];

    // Relación con Vehiculos (una bahía puede tener muchos vehículos)
    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, 'idBahia', 'idBahia');
    }
}
