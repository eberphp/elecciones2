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

    public function scopeJoinCargo($query){
        return $query->join('cargos', 'cargos.id', '=', 'personal.cargo_id');
    }

    public function tipoUsuario(){
        return $this->belongsTo(TipoUsuario::class, 'tipo_usuarios_id');
    }

    public function scopeJoinTipoUsuario($query){
        return $query->join('tipo_usuarios', 'tipo_usuarios.id', '=', 'personal.tipo_usuarios_id');
    }
    
    public function vinculo(){
        return $this->belongsTo(Vinculo::class, 'vinculo_id');
    }

    public function scopeJoinVinculo($query){
        return $query->join('vinculos', 'vinculos.id', '=', 'personal.vinculo_id');
    }

    public function _departamento(){
        return $this->belongsTo(Departamento::class, 'departamento');
    }

    public function scopeJoinDepartamento($query){
        return $query->join('departamentos', 'departamentos.id', '=', 'personal.departamento');
    }

    public function _provincia(){
        return $this->belongsTo(Provincia::class, 'provincia');
    }

    public function scopeJoinProvincia($query){
        return $query->join('provincias', 'provincias.id', '=', 'personal.provincia');
    }

    public function _distrito(){
        return $this->belongsTo(Distrito::class, 'distrito');
    }

    public function scopeJoinDistrito($query){
        return $query->join('distritos', 'distritos.id', '=', 'personal.distrito');
    }

    public function tiposUbigeo(){
        return $this->belongsTo(TipoUbigeo::class, 'tipo_ubigeo');
    }

    public function scopeJoinTipoUbigeo($query){
        return $query->join('tipo_ubigeos', 'tipo_ubigeos.id', '=', 'personal.tipo_ubigeo');
    }

    public function funcion(){
        return $this->belongsTo(Funcion::class,'funcion_id');
    }

    public function scopeJoinFuncion($query){
        return $query->join('funciones', 'funciones.id', '=', 'personal.funcion_id');
    }

    public function asignaciones()
    {
    	return $this->hasMany(Asignacion::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class,"idPersonal","id");
    }

    public function scopeJoinUser($query){
        return $query->join('users', 'users.idPersonal', '=', 'personal.id');
    }

    public function _estado(){
        return $this->belongsTo(EstadoEvaluacion::class, 'estado');
    }

    public function scopeJoinEstado($query){
        return $query->join('estado_evaluaciones', 'estado_evaluaciones.id', '=', 'personal.estado');
    }

    public function scopeJoinMesa($query)
    {
        return $query->leftJoin('locales_votacion', 'locales_votacion.num_mesa', '=', 'personal.nro_mesa');
    }

    public function scopeJoinEleccionesVoto($query)
    {
        return $query->leftJoin('elecciones_votos', 'elecciones_votos.mesa_id', '=', 'locales_votacion.id');
    }
}
