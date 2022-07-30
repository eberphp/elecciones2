<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class candidato extends Model
{
    use HasFactory;
    protected $table = 'candidatos';
    protected $fillable = [
        'id',
        'tipo',
        'idDepartamento',
        'idProvincia',
        'idDistrito',
        'nombreCorto',
        'idPartido',
        'nombresApellidos',
        'foto',
        'estado',
        'visualiza',
        'observaciones'
    ];
}
