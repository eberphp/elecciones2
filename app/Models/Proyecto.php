<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = "proyectos";
    protected $primaryKey = 'idProyectos';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'diasVencidos',
        'fechaInicio',
        'plazoDias',
        'plazoHoras',
        'totalEntregables',
        'encargado',
        'responsable',
        'costo',
        'observaciones',
        'estado',
    ];

    public function encargados()
    {
        return $this->belongsTo(User::class,'encargado','id');
    }

    public function responsables()
    {
        return $this->belongsTo(User::class,'responsable','id');
    }
}
