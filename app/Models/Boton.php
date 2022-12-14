<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boton extends Model
{
    use HasFactory;

    protected $table = 'botones';
    protected $fillable = [
        'id',
        'datos_empresa_id',
        'codigo',
        'nombre',
        'orden',
        'url',
        'colorFondo'
    ];
}
