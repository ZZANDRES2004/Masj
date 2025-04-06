<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queja extends Model
{
    use HasFactory;
    
    protected $table = 'quejas';
    protected $fillable = ['titulo', 'descripcion', 'estado', 'apartamento_id'];
}