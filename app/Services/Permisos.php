<?php

namespace App\Services;

use App\Models\Permiso;

class Permisos
{
    public function get()
    {
        $permisos = Permiso::orderByRaw('grupo, idx, nivel, sub')->get();
        $array = [];
        foreach ($permisos as $permiso)
            $array[$permiso->id] = [
                'nombre' => $permiso->nombre,
                'grupo' => $permiso->grupo,
                'nivel' => $permiso->nivel,
                'hijos' => $permiso->hijos,
                'idx' => $permiso->idx,
                'sub' => $permiso->sub
            ];
        return $array;
    }
}