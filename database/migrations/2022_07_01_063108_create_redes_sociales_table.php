<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedesSocialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redes_sociales', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('idUsuario');
            $table->integer('idPerfil');
            $table->string('facebook', 250)->nullable();
            $table->string('twitter', 250)->nullable();
            $table->string('instagram', 250)->nullable();
            $table->string('linkedin', 250)->nullable();
            $table->string('whatsapp', 250)->nullable();
            $table->string('colorFondo', 250)->nullable();
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
        Schema::dropIfExists('redes_sociales');
    }
}
