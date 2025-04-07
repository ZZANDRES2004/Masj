<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Correspondencia extends Model
{
    use HasFactory;
    
    protected $table = 'correspondencia';
    protected $fillable = ['remitente', 'tipo', 'fecha_recepcion', 'apartamento_id'];
}