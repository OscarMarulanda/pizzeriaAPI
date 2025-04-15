<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Sabor extends Model
{
    use HasFactory;

    protected $table = 'sabor';
    public $timestamps = false;
    protected $primaryKey = 'idSabor';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'idSabor',
        'Nombre_Pizza',
        'Precio_Porcion'
    ];

    public function saborIngrediente()
    {
        return $this->hasMany(saborIngrediente::class, 'idSabor', 'idSabor');
    }
}
