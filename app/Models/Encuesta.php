<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    protected $table = 'Encuesta';
    protected $primaryKey = 'idEncuesta';
    public $timestamps = false;
    protected $fillable = [
        'idPeriodo',
        'idCandidatoDepartamento',
        'idDepartamento',
        'idCandidatoProvincia',
        'idProvincia',
        'idCandidatoDistrito',
        'idDistrito',
        'VotoDistrital',
        'VotoDepartamento',
        'VotoProvincial',
        

                            ];
    protected $guarded = [];

}
