<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionMenu extends Model
{
    protected $table = 'OptionMenu';
    protected $primaryKey = 'idOption';
    public $timestamps = false;
    protected $fillable = [
        'idMenu',
        'codOption',
        'description',
        'flag_estatus',
        'created_at',
        'create_up'

                            ];
    protected $guarded = [];

}
