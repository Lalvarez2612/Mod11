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
        Schema::table('ordenes', function (Blueprint $table) {
            $table->foreign(['fk_cliente'], 'fk_ordenes_Clientes1')->references(['id_cliente'])->on('clientes')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_metodoPago'], 'fk_ordenes_metodos_pagos1')->references(['id_metodoPago'])->on('metodos_pagos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ordenes', function (Blueprint $table) {
            $table->dropForeign('fk_ordenes_Clientes1');
            $table->dropForeign('fk_ordenes_metodos_pagos1');
        });
    }
};
