<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asignacion extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'asignaciones';
        
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'personal_id', 'permiso_id'//, 'created_by'
    ];

    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }

    public function permiso()
    {
        return $this->belongsTo(Permiso::class);
    }
}
