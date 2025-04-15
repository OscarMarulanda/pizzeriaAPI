<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SaborIngrediente extends Model
{
    use HasFactory;

    protected $table = 'saboringrediente';
    public $timestamps = false;
    protected $primaryKey = '';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'idSabor',
        'idIngrediente',
        'Cantidadkg'
    ];
}