<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubpublicacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subpublicaciones', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('idUsuario');
            $table->integer('idPublicacion')->nullable();
            $table->string('codigo', 250)->nullable();
            $table->string('nombre', 250)->nullable();
            $table->integer('orden')->nullable();
            $table->string('url', 250)->nullable();
            $table->text('texto')->nullable();
            $table->integer('idConfiguracion')->nullable();
            $table->integer('numOrdenador')->nullable();
            $table->integer('numTablet')->nullable();
            $table->integer('numCelular')->nullable();
            $table->string('modeloBloque', 250)->nullable();
            $table->enum('selecciona', ['Imagen', 'Video'])->nullable();
            $table->string('imagen', 250)->nullable();
            $table->string('linkVideo', 250)->nullable();
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
        Schema::dropIfExists('subpublicaciones');
    }
}
