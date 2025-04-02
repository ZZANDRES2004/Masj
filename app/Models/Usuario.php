<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuario';
    protected $primaryKey = 'idUsuario';

    protected $fillable = [
        'PrimerNombre',
        'SegundoNombre',
        'PrimerApellido',
        'SegundoApellido',
        'NumeroCelular',
        'CorreoElectronico',
        'Contrasena',
        'ConjuntoNombre',
        'FechaNacimiento',
        'Estado',
        'Rol',
        'TipoDocumento',
        'NumDocumento'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function getAuthPassword()
    {
        return $this->Contrasena; // Cambia 'password' por el nombre de tu campo de contraseña
    }
    public function getAuthIdentifierName()
    {
        return 'CorreoElectronico'; // Cambia 'email' por el nombre de tu campo de email
    }
    public function getAuthIdentifier()
    {
        return $this->getAttribute($this->getAuthIdentifierName());
    }
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public $timestamps = false; // Añade esta línea
}