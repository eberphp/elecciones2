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
        'datos_empresa_id',
        'codigo',
        'nombre',
        'orden',
        'url',
        'texto',
        'imagen'
    ];
}
