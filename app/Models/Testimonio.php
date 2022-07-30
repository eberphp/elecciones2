<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonio extends Model
{
    use HasFactory;

    protected $table = 'testimonios';
    protected $fillable = [
        'id',
        'idUsuario',
        'codigo',
        'nombre',
        'orden',
        'url',
        'texto',
        'imagen'
    ];
}
