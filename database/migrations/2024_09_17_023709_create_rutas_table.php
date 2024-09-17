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
        Schema::create('rutas', function (Blueprint $table) {
            $table->integer('id_ruta', true);
            $table->integer('fk_orden')->index('fk_ordenes_has_direcciones_ordenes1_idx');
            $table->integer('fk_direccion')->index('fk_ordenes_has_direcciones_direcciones1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rutas');
    }
};
