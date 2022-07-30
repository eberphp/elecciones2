<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    protected $table = 'publicaciones';
    protected $fillable = [
        'id',
        'idUsuario',
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
