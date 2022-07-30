<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    public $table = 'personal';
    use HasFactory;
    public function cargo(){
        return $this->belongsTo(Cargo::class, 'cargo_id');
    }

    public function tipoUsuario(){
        return $this->belongsTo(TipoUsuario::class, 'tipo_usuarios_id');
    }
    public function vinculo(){
        return $this->belongsTo(Vinculo::class, 'vinculo_id');
    }
    public function departamento(){
        return $this->belongsTo(Departamento::class, 'departamento');
    }
    public function provincia(){
        return $this->belongsTo(Provincia::class, 'provincia');
    }
    public function distrito(){
        return $this->belongsTo(Distrito::class, 'distrito');
    }
    public function tiposUbigeo(){
        return $this->belongsTo(TipoUbigeo::class, 'tipo_ubigeo');
    }

}
