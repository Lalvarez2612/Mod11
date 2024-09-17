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
        Schema::table('rutas', function (Blueprint $table) {
            $table->foreign(['fk_direccion'], 'fk_ordenes_has_direcciones_direcciones1')->references(['id_direccion'])->on('direcciones')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_orden'], 'fk_ordenes_has_direcciones_ordenes1')->references(['id_orden'])->on('ordenes')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rutas', function (Blueprint $table) {
            $table->dropForeign('fk_ordenes_has_direcciones_direcciones1');
            $table->dropForeign('fk_ordenes_has_direcciones_ordenes1');
        });
    }
};
