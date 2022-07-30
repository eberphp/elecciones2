<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubImagen extends Model
{
    use HasFactory;

    protected $table = 'sub_imagenes';
    protected $fillable  = [
        'id',
        'idSubpublicacion',
        'imagen'
    ];
}
