<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartamento extends Model
{
    protected $table = 'apartamentos';
    protected $primaryKey = 'idApartamentos';
    public $timestamps = false;

    protected $fillable = ['torre', 'apto'];

    public function residentes()
    {
        return $this->hasMany(Residente::class, 'idApartamento');
    }
}
