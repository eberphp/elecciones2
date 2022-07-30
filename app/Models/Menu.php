<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'Menu';
    protected $primaryKey = 'idMenu';
    public $timestamps = false;
    protected $fillable = [
        'codMenu',
        'description',
        'flag_estatus',
        'created_at',
        'create_ap'

                            ];
    protected $guarded = [];

}
