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
        Schema::table('ordenes_has_menus', function (Blueprint $table) {
            $table->foreign(['menus_id_menu'], 'fk_orXme_menus1')->references(['id_menu'])->on('menus')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['ordenes_id_orden'], 'fk_orXme_ordenes1')->references(['id_orden'])->on('ordenes')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ordenes_has_menus', function (Blueprint $table) {
            $table->dropForeign('fk_orXme_menus1');
            $table->dropForeign('fk_orXme_ordenes1');
        });
    }
};
