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
        Schema::create('elecciones_votos', function (Blueprint $table) {
            $table->id();
            $table->integer("eleccion_id")->nullable();
            $table->integer("partido_id")->nullable();
            $table->string("departamento")->nullable();
            $table->string("provincia")->nullable();
            $table->string("distrito")->nullable();
            $table->string("mesa_id")->nullable();
            $table->integer("datos_empresa_id")->nullable();
            $table->enum("region",["Regional","Distrital","Provincial"])->nullable();
            $table->integer("votos")->nullable();
            $table->enum("tipo_voto",["Manual"])->nullable();
            $table->string("codigo")->nullable();
            $table->date("fecha")->nullable();
            $table->enum("publicado",["Si","No"])->nullable();
            $table->enum("grafico", ["Si","No"])->nullable();
            $table->enum("estado",["Activo","Inactivo","Eliminado"])->default("Activo");
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
        Schema::dropIfExists('elecciones_votos');
    }
};
