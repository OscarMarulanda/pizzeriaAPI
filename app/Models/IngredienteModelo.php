<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class IngredienteModelo extends Model
{
    use HasFactory;

    protected $table = 'ingrediente';
    public $timestamps = false;
    protected $primaryKey = 'idIngrediente';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'idIngrediente',
        'Descripcion',
        'Existenciaskg'
    ];

    public function saborIngrediente()
    {
        return $this->hasMany(saborIngrediente::class, 'idIngrediente', 'idIngrediente');
    }
}