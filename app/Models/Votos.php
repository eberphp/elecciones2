<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votos extends Model
{
    use HasFactory;

    protected $table = "votos";
    protected $primaryKey = 'idVoto';
    public $timestamps = false;

    protected $fillable = [
        'encuestaId',
        'partidoId',
        'departamentoId',
        'provinciaId',
        'distritoId',
        'zonaId',
        'region',
        'votos',
        'tipoEncuesta',
        'codigo',
        'fecha',
        'estado',
    ];

    public function encuesta()
    {
        return $this->belongsTo(Encuestas::class,'encuestaId','idEncuesta');
    }

    public function partido()
    {
        return $this->belongsTo(Partido::class,'partidoId','id');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class,'departamentoId','id');
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class,'provinciaId','id');
    }

    public function distrito()
    {
        return $this->belongsTo(Distrito::class,'distritoId','id');
    }

    public function zona()
    {
        return $this->belongsTo(Zona::class,'zonaId','id');
    }
}
