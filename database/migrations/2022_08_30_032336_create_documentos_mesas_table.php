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
        Schema::create('documentos_mesas', function (Blueprint $table) {
            $table->id();
            $table->integer("mesa_id");
            $table->integer("eleccion_id");
            $table->string("file_name")->default("");
            $table->string("file_path")->default("");
            $table->string("file_type")->default('pdf');
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
        Schema::dropIfExists('documentos_mesas');
    }
};
