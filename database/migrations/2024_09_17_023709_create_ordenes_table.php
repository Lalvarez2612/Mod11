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
        Schema::create('ordenes', function (Blueprint $table) {
            $table->integer('id_orden', true);
            $table->integer('fk_cliente')->index('fk_ordenes_clientes1_idx');
            $table->integer('fk_metodoPago')->index('fk_ordenes_metodos_pagos1_idx');
            $table->string('orden_codigo', 100)->unique('orden_codigo_unique');
            $table->string('orden_estatus', 100);
            $table->string('comentario_adicional', 200);
            $table->date('fechaCreacion_orden');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes');
    }
};
