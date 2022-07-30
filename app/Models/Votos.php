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
        'candidatoId',
        'region',
        'votos',
        'tipoEncuesta',
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

    public function candidato()
    {
        return $this->belongsTo(candidato::class,'candidatoId','id');
    }
}
