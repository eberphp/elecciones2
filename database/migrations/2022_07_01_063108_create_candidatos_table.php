<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidatos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->enum('tipo', ['Distrital', 'Provincial', 'Regional']);
            $table->integer('idDepartamento')->nullable();
            $table->integer('idProvincia')->nullable();
            $table->integer('idDistrito')->nullable();
            $table->string('nombreCorto', 250);
            $table->string('idPartido', 250);
            $table->string('nombresApellidos', 250);
            $table->string('foto', 250);
            $table->enum('estado', ['activo', 'inactivo'])->nullable();
            $table->enum('visualiza', ['Si', 'No'])->nullable();
            $table->text('observaciones')->nullable();
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
        Schema::dropIfExists('candidatos');
    }
}
