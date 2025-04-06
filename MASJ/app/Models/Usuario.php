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
        'Contraseña',
        'ConjuntoNombre',
        'FechaNacimiento',
        'Estado',
        'Rol',
        'TipoDocumento',
        'NumDocumento'
    ];
    
    // Corregido: nombre de campo con tilde
    protected $hidden = [
        'Contraseña',
        'remember_token',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function getAuthPassword()
{
    return $this->Contraseña;  
}
    
    public function getAuthIdentifierName()
    {
        return 'CorreoElectronico';
    }
    
    public function getAuthIdentifier()
    {
        return $this->getAttribute($this->getAuthIdentifierName());
    }
    
    public function getRememberToken()
    {
        return $this->remember_token;
    }
    
    /**
     * Obtiene la dirección de correo electrónico del usuario para el restablecimiento de contraseña.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->CorreoElectronico;
    }
    

    


    public $timestamps = false;
}