<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    use HasFactory;
    
    protected $table = 'visitantes';
    protected $fillable = ['nombre', 'documento', 'fecha_visita', 'apartamento_id'];
}