<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paqueteria extends Model
{
    public $timestamps = false; // Esta línea desactiva los timestamps
    
    protected $fillable = [
        'remitente',
        'destinatario',
        'descripcion',
        'recibido'
    ];
}
