<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_empresa', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('idUsuario');
            $table->integer('idPerfil');
            $table->string('nombre', 250)->nullable();
            $table->string('favicon', 250)->nullable();
            $table->string('bannerPrincipal', 250)->nullable();
            $table->string('telefono1', 9)->nullable();
            $table->string('telefono2', 9)->nullable();
            $table->string('correo', 250)->nullable();
            $table->text('piePagina')->nullable();
            $table->text('terminoCondiciones')->nullable();
            $table->string('derechos', 250)->nullable();
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
        Schema::dropIfExists('datos_empresa');
    }
}
