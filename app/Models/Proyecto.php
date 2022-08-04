<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = "proyectos";
    protected $primaryKey = 'idProyecto';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'diasVencidos',
        'fechaInicio',
        'plazo',
        'totalEntregables',
        'encargado',
        'responsable',
        'costo',
        'observaciones',
        'estadoActivida',
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


    protected $casts = [
        'fechaInicio' => 'timestamp',
        'plazo' => 'timestamp',
    ];
}
