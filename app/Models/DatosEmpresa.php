<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosEmpresa extends Model
{
    use HasFactory;
    protected $table = 'datos_empresa';
    protected $fillable = [
        'id',
        'datos_empresa_id',
        'perfil_id',
        'nombre',
        'favicon',
        'bannerPrincipal',
        'telefono1',
        'telefono2',
        'correo',
        'piePagina',
        'terminoCondiciones',
        'derechos',
        'nosotros',
        'dominio'
    ];
}
