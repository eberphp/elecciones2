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
            $table->string('codigo')->nullable()->default('-');
            $table->string('nombres')->nullable()->default('-');
            $table->string('telefono', 9)->nullable()->default('-');
            $table->string('nombreCorto')->nullable()->default('-');
            $table->string('docIdentidad', 11)->nullable()->default('-');
            $table->integer('edad')->nullable()->default(0);
            $table->date('fechaNacimiento')->nullable()->default(now());
            $table->string('profesion', 250)->nullable()->default('-');
            $table->string('cargo', 250)->nullable()->default('-');
            $table->string('correo', 250)->nullable()->default('-');
            $table->string('lugar', 250)->nullable()->default('-');
            $table->string('empresa', 250)->nullable()->default('-');
            $table->string('ruc', 11)->nullable()->default('-');
            $table->text('observaciones')->nullable()->default('-');
            $table->integer('idUsuarioCreador')->nullable();
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
