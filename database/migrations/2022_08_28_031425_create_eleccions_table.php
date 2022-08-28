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
        /* 
idEncuesta	
nombreEncuesta	
datos_empresa_id	
fechaInicio	
fechaTermino	
observaciones	
encuestaManual	
publicacion	
dispositivo	
encuestador	
manual	
estado */
        Schema::create('elecciones', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->integer("datos_empresa_id");
            $table->dateTime("fecha_inicio");
            $table->dateTime("fecha_termino");
            $table->text("observaciones");
            $table->enum("encuesta_manual",["Si","No"]);
            $table->enum("publicacion",["Si","No"]);
            $table->enum("dispositivo",["Si","No"]);
            $table->enum("encuestador",["Si","No"]);
            $table->enum("manual",["Si","No"]);
            $table->enum("estado",["Activo","Inactivo","Eliminado"]);
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
        Schema::dropIfExists('elecciones');
    }
};
