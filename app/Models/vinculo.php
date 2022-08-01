<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vinculo extends Model
{
    public $table = 'vinculos';
    use HasFactory;

    //modelo vinculo requerido por modelo personal
}
