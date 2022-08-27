<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permiso extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permisos';
    
    /**
     * Protected attributes that CANNOT be mass assigned.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'nombre', 'grupo', 'nivel', 'idx', 'sub', 'hijos'
    ];
    public $timestamps = false;

    public function asignaciones()
    {
    	return $this->hasMany(Asignacion::class);
    }
}
