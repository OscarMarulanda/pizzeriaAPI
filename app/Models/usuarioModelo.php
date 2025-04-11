<?php

namespace App\Models;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class usuarioModelo extends Authenticatable implements JWTSubject
{
    use HasFactory;
    protected $table = 'usuario';
    public $timestamps = false;
    protected $primaryKey = 'UsuarioDocumento';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'UsuarioDocumento',
        'UsuarioTelefono',
        'Contrasena',
        'Correo',
        'UsuarioPrimerNombre',
        'UsuarioApellido',
        'idTipoDocumento',
        'idTipoUsuario'
    ];

    public function getJWTIdentifier(){
        return $this->getKey();
    }
    public function getJWTCustomClaims(){
        return[];
    }
    
}
