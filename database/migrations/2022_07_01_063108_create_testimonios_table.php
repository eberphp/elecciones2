<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestimoniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimonios', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('idUsuario');
            $table->string('codigo', 250)->nullable();
            $table->string('nombre', 250)->nullable();
            $table->integer('orden')->nullable();
            $table->string('url', 250)->nullable();
            $table->text('texto')->nullable();
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
        Schema::dropIfExists('testimonios');
    }
}
