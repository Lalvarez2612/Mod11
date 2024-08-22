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
        Schema::create('clientes_x_direcciones', function (Blueprint $table) {
            $table->integer('id_clientDirec', true);
            $table->integer('fk_cliente')->index('fk_clientes_has_direcciones_clientes1_idx');
            $table->integer('fk_direccion')->index('fk_clientes_has_direcciones_direcciones1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes_x_direcciones');
    }
};
