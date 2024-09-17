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
        Schema::table('repartidores', function (Blueprint $table) {
            $table->foreign(['fk_persona'], 'fk_Repartidores_personas1')->references(['id_persona'])->on('personas')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('repartidores', function (Blueprint $table) {
            $table->dropForeign('fk_Repartidores_personas1');
        });
    }
};
