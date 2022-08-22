<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'servicios';
    protected $fillable = [
        'datos_empresa_id',
        'codigo',
        'nombre',
        'orden',
        'url'
    ];
}
