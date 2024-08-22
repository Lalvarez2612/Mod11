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
        Schema::table('asiganciones_x_ordenes', function (Blueprint $table) {
            $table->foreign(['fk_orden'], 'fk_repartidores_has_ordenes_ordenes1')->references(['id_orden'])->on('ordenes')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_repartidor'], 'fk_repartidores_has_ordenes_repartidores1')->references(['id_repartidor'])->on('repartidores')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('asiganciones_x_ordenes', function (Blueprint $table) {
            $table->dropForeign('fk_repartidores_has_ordenes_ordenes1');
            $table->dropForeign('fk_repartidores_has_ordenes_repartidores1');
        });
    }
};
