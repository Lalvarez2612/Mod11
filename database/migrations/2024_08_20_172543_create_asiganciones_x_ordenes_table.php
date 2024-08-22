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
        Schema::create('asiganciones_x_ordenes', function (Blueprint $table) {
            $table->integer('id_asigancionOrden', true);
            $table->integer('fk_repartidor')->index('fk_repartidores_has_ordenes_repartidores1_idx');
            $table->integer('fk_orden')->index('fk_repartidores_has_ordenes_ordenes1_idx');
            $table->time('tiempo_inicio');
            $table->time('tiempo_final')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asiganciones_x_ordenes');
    }
};
