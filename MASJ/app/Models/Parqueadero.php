<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parqueadero extends Model
{
    use HasFactory;

    protected $table = 'parqueadero'; // Asegúrate que este nombre coincide con tu tabla
    protected $primaryKey = 'idBahia';

    protected $fillable = [
        'Estado',
        // Otros campos que tenga tu tabla parqueaderos
    ];

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, 'idBahia');
    }
}

