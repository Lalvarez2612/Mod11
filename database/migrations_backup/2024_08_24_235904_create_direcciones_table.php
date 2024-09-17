<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('direcciones', function (Blueprint $table) {
            $table->integer('id_direccion', true);
            $table->string('estado', 100);
            $table->string('ciudad', 100);
            $table->string('municipio', 100);
            $table->string('parroquia', 100);
            $table->string('punto_referencia', 500);
            $table->string('latitud', 100);
            $table->string('longitud', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direcciones');
    }
};
