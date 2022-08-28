<?php

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
        Schema::create('locales_votacion', function (Blueprint $table) {
            $table->id();
            $table->string("departamento");
            $table->string("provincia");
            $table->string("distrito");
            $table->string("nom_local");
            $table->string("num_mesa");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locales_votacion');
    }
};
