<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTitulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titulos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('idUsuario');
            $table->string('titleTestimonio', 250)->nullable();
            $table->enum('tituloTestimonioVisible', ['SI', 'NO'])->nullable();
            $table->string('titleServicio', 250)->nullable();
            $table->enum('tituloServicioVisible', ['SI', 'NO'])->nullable();
            $table->string('titleProducto', 250)->nullable();
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
        Schema::dropIfExists('titulos');
    }
}
