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

    public function partido()
    {
        return $this->belongsTo(Partido::class,'idPartido','id');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class,'idDepartamento','id');
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class,'idProvincia','id');
    }

    public function distrito()
    {
        return $this->belongsTo(Distrito::class,'idDistrito','id');
    }
}
