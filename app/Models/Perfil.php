<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    protected $table = 'perfiles';
    protected $fillable = [
        'id',
        'tipo',
        'codigo',
        'nombres',
        'telefono',
        'nombreCorto',
        'docIdentidad',
        'edad',
        'fechaNacimiento',
        'profesion',
        'cargo',
        'correo',
        'lugar',
        'empresa',
        'ruc',
        'observaciones',
        'idUsuarioCreador'
    ];
}
