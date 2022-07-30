<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Titulo extends Model
{
    use HasFactory;

    protected $table = 'titulos';

    protected $fillable = [
        'id',
        'idUsuario',
        'titleTetimonio',
        'tituloTestimonioVisible',
        'titleServicio',
        'tituloServicioVisible',
        'titleProducto'
    ];
}
