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
        Schema::create('repartidores', function (Blueprint $table) {
            $table->integer('id_repartidor', true);
            $table->integer('fk_persona')->index('fk_repartidores_personas1_idx');
            $table->string('estatus_repartidor', 100);
            $table->string('vehiculo_descripcion', 500);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repartidores');
    }
};
