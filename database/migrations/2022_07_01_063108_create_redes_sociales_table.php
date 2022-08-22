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
            $table->integer('datos_empresa_id')->nullable();
            $table->integer('perfil_id');
            $table->string('facebook', 250)->default('https://www.facebook.com');
            $table->string('twitter', 250)->default('https://twitter.com');
            $table->string('instagram', 250)->default('https://www.instagram.com');
            $table->string('linkedin', 250)->default('https://www.linkedin.com');
            $table->string('whatsapp', 250)->default('https://web.whatsapp.com');
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
