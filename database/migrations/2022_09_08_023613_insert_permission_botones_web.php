<?php

use App\Models\Permiso;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $existe = Permiso::where("grupo", 1)->first();
        if ($existe) {
            $existe->hijos = 11;
            $existe->save();
            $permiso = new Permiso();
            $permiso->nombre = 'Botones';
            $permiso->grupo = 1;
            $permiso->nivel = 2;
            $permiso->idx = 11;
            $permiso->sub = 1;
            $permiso->hijos = 0;
            $permiso->save();
        }
        $existe2 = Permiso::where("grupo", 4)->first();
        if ($existe2) {
            $existe2->hijos = 10;
            $existe2->save();
            $permiso = new Permiso();
            $permiso->nombre = 'Grafico';
            $permiso->grupo = 4;
            $permiso->nivel = 2;
            $permiso->idx = 10;
            $permiso->sub = 1;
            $permiso->hijos = 0;
            $permiso->save();
        }

        //permisos para elecciones
        $permiso = new Permiso();
        $permiso->nombre = "Elecciones";
        $permiso->grupo = 7;
        $permiso->nivel = 1;
        $permiso->idx = 1;
        $permiso->sub = 1;
        $permiso->hijos = 4;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre = "Locales de votación";
        $permiso->grupo = 7;
        $permiso->nivel = 2;
        $permiso->idx = 1;
        $permiso->sub = 1;
        $permiso->hijos = 0;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre = "Historial votos";
        $permiso->grupo = 7;
        $permiso->nivel = 2;
        $permiso->idx = 2;
        $permiso->sub = 1;
        $permiso->hijos = 0;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre = "Crear elecciones";
        $permiso->grupo = 7;
        $permiso->nivel = 2;
        $permiso->idx = 3;
        $permiso->sub = 1;
        $permiso->hijos = 0;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre = "Grafico";
        $permiso->grupo = 7;
        $permiso->nivel = 2;
        $permiso->idx = 4;
        $permiso->sub = 1;
        $permiso->hijos = 0;
        $permiso->save();
    }


    public function down()
    {
        //

    }
};
