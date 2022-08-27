<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Personal extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable;

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
    public function _departamento(){
        return $this->belongsTo(Departamento::class, 'departamento');
    }
    public function _provincia(){
        return $this->belongsTo(Provincia::class, 'provincia');
    }
    public function _distrito(){
        return $this->belongsTo(Distrito::class, 'distrito');
    }
    public function tiposUbigeo(){
        return $this->belongsTo(TipoUbigeo::class, 'tipo_ubigeo');
    }
    public function funcion(){
        return $this->belongsTo(Funcion::class,'funcion_id');
    }
    public function asignaciones()
    {
    	return $this->hasMany(Asignacion::class);
    }
}
