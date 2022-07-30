<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('idUsuario');
            $table->integer('idPerfil');
            $table->string('nombre', 250)->nullable();
            $table->integer('orden')->nullable();
            $table->string('url', 250)->nullable();
            $table->text('texto')->nullable();
            $table->string('codigo', 45)->nullable();
            $table->string('imagen', 250)->nullable();
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
        Schema::dropIfExists('sliders');
    }
}
