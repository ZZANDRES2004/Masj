<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parqueadero extends Model
{
    protected $table = 'parqueadero';
    protected $primaryKey = 'idBahia';
    public $timestamps = false;

    protected $fillable = ['Novedad', 'Estado'];

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, 'idBahia');
    }
}
