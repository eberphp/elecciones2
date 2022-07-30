<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;
    protected $table = 'Periodos';
    protected $primaryKey = 'idPeriodo';
    public $timestamps = false;
    protected $fillable = [
        'idPeriodo',
        'descripcion',
        'fechaInicio',
        'fechaFinal',
        'flagActivo'
    ];
    protected $guarded = [];
}
