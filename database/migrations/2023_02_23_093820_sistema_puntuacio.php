<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sistema_puntuacio', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->timestamps();
        });
        
        // * Els items pel sistema de puntuació són:
        // * - Tècnica
        // * - Musicalitat
        // * - Expressivitat i Comunicació
        // * - Us de l'espai
        // * - Coreografia
        // * - Complicitat
        // * - Cohesió de Grup
        // * - Comunicació i expressivitat
        // * - Virtuosisme
        
        DB::table('sistema_puntuacio')->insert([
            ['nom' => 'Tècnica'],
            ['nom' => 'Musicalitat'],
            ['nom' => 'Expressivitat i Comunicacio'],
            ['nom' => 'Us de l\'espai'],
            ['nom' => 'Coreografia'],
            ['nom' => 'Complicitat'],
            ['nom' => 'Cohesio de Grup'],
            ['nom' => 'Comunicacio i expressivitat'],
            ['nom' => 'Virtuosisme'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sistema_puntuacio');
    }
};
