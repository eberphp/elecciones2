<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfiles', function (Blueprint $table) {
            $table->integer('id', true);
            $table->enum('tipo', ['admin', 'persona', 'empresa'])->nullable();
            $table->string('codigo')->nullable();
            $table->string('nombres')->nullable();
            $table->string('telefono', 9)->nullable();
            $table->string('nombreCorto')->nullable();
            $table->string('docIdentidad', 11)->nullable();
            $table->integer('edad')->nullable();
            $table->date('fechaNacimiento')->nullable();
            $table->string('profesion', 250)->nullable();
            $table->string('cargo', 250)->nullable();
            $table->string('correo', 250)->nullable();
            $table->string('lugar', 250)->nullable();
            $table->string('empresa', 250)->nullable();
            $table->string('ruc', 11)->nullable();
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
        Schema::dropIfExists('perfiles');
    }
}
