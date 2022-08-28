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
        //
        $existe = Permiso::where("grupo", 3)->first();
        if ($existe) {
            $existe->hijos=26;
            $existe->save();
            $permiso=new Permiso();
            $permiso->nombre = 'Personal intranet';
            $permiso->grupo = 3;
            $permiso->nivel = 2;
            $permiso->idx = 26;
            $permiso->sub = 1;
            $permiso->hijos = 0;
            $permiso->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
