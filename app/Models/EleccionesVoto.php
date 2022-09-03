<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EleccionesVoto extends Model
{
    use HasFactory;
    public $table = "elecciones_votos";
    public $fillable = [
        "id",
        "eleccion_id",
        "partido_id",
        "departamento",
        "provincia",
        "distrito",
        "mesa_id",
        "datos_empresa_id",
        "region",
        "votos",
        "tipo_voto",
        "codigo",
        "fecha",
        "publicado",
        "grafico",
        "estado",
        "created_at",
        "updated_at",
        "votos_departamento",
        "votos_provincia",
        "votos_distrito",
        "created_by",
        "updated_by"
    ];
    public function eleccion()
    {
        return $this->belongsTo(Eleccion::class, 'eleccion_id', 'id');
    }

    public function partido()
    {
        return $this->belongsTo(Partido::class, 'partido_id', 'id');
    }

    public function _departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento', 'id');
    }
    public function departamento_()
    {
        return $this->belongsTo(Departamento::class, 'departamento', 'id');
    }

    public function _provincia()
    {
        return $this->belongsTo(Provincia::class, 'provincia', 'id');
    }

    public function _distrito()
    {
        return $this->belongsTo(Distrito::class, 'distrito', 'id');
    }

    public function localVotacion()
    {
        return $this->belongsTo(LocalVotacion::class, 'mesa_id', 'id');
    }
    public function locales_votacion()
    {
        return $this->belongsTo(LocalVotacion::class, 'mesa_id', 'id');
    }
    public function creador()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
