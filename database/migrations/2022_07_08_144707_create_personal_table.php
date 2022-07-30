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
        Schema::create('personal', function (Blueprint $table) {
            $table->id();
            $table->string("nombres");
            $table->integer("cargo_id");
            $table->string("ppd")->nullable();
            $table->text("perfil");
            $table->string("foto")->nullable();
            $table->text("cv")->nullable();
            $table->string("url_facebook")->nullable();
            $table->string("url_1")->nullable();
            $table->string("url_2")->nullable();
            $table->integer("puesto_id");
            $table->string("nombreCorto");
            $table->string("telefono");
            $table->text("referencias");
            $table->integer("estado");
            $table->integer("vinculo_id");
            $table->string("dni");
            $table->string("clave");
            $table->timestamp("fecha_ingreso");
            $table->string("correo");
            $table->text("sugerencias");
            $table->integer("tipo_usuarios_id");
            $table->string("asignar_usuarios");
            $table->text("observaciones");
            $table->string("tipo_ubigeo");
            $table->integer("rol_id");
            $table->string("departamento");
            $table->string("provincia");
            $table->string("distrito");
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
        Schema::dropIfExists('personal');
    }
};
