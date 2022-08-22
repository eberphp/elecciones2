<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedesSociales extends Model
{
    use HasFactory;

    protected $table = 'redes_sociales';
    protected $fillable = [
        'id',
        'datos_empresa_id',
        'perfil_id',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'whatsapp',
        'colorFondo'
    ];
}
