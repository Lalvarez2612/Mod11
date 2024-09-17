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
        Schema::create('ordenes_has_menus', function (Blueprint $table) {
            $table->integer('id_ordenes_has_menus', true);
            $table->integer('ordenes_id_orden')->index('fk_orxme_ordenes1_idx');
            $table->integer('menus_id_menu')->index('fk_orxme_menús1_idx');
            $table->integer('cantidad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes_has_menus');
    }
};
