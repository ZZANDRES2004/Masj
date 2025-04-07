<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Residente extends Model
{
    protected $table = 'residentes';
    protected $primaryKey = 'idResidente';
    public $timestamps = false;

    protected $fillable = ['idApartamento'];

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, 'idResidente');
    }

    public function quejas()
    {
        return $this->hasMany(Queja::class, 'idResidente');
    }

    public function alquileresZonasComunes()
    {
        return $this->hasMany(AlquilerZonaComun::class, 'idResidente');
    }

    public function apartamento()
    {
        return $this->belongsTo(Apartamento::class, 'idApartamento');
    }
}
