<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleccion extends Model
{
    use HasFactory;
    public $table = "elecciones";
    public $fillable = [
        'nombre',
        'datos_empresa_id',
        'fecha_inicio',
        'fecha_termino',
        'encuesta_manual',
        'estado',
        'observaciones'
    ];
}
