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
        Schema::table('clientes_x_direcciones', function (Blueprint $table) {
            $table->foreign(['fk_cliente'], 'fk_Clientes_has_Direcciones_Clientes1')->references(['id_cliente'])->on('clientes')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_direccion'], 'fk_Clientes_has_Direcciones_Direcciones1')->references(['id_direccion'])->on('direcciones')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clientes_x_direcciones', function (Blueprint $table) {
            $table->dropForeign('fk_Clientes_has_Direcciones_Clientes1');
            $table->dropForeign('fk_Clientes_has_Direcciones_Direcciones1');
        });
    }
};
