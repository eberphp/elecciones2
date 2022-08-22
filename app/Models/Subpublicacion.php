<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subpublicacion extends Model
{
    use HasFactory;

    protected $table = 'subpublicaciones';
    protected $fillable = [
        'id',
        'datos_empresa_id',
        'pubicacion_id',
        'codigo',
        'nombre',
        'orden',
        'url',
        'texto',
        'idConfiguracion',
        'numOrdenador',
        'numTablet',
        'numCelular',
        'modeloBloque',
        'selecciona',
        'imagen',
        'linkVideo'
    ];
}
