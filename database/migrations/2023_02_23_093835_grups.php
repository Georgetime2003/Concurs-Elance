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
        Schema::create('grups', function (Blueprint $table) {
            $table->id();
            $table->string('nomgrup');
            $table->string('descripcio');

            $table->float('puntuacio1_1')->nullable();
            $table->float('puntuacio1_2')->nullable();
            $table->float('puntuacio1_3')->nullable();

            $table->float('puntuacio2_1')->nullable();
            $table->float('puntuacio2_2')->nullable();
            $table->float('puntuacio2_3')->nullable();

            $table->float('puntuacio3_1')->nullable();
            $table->float('puntuacio3_2')->nullable();
            $table->float('puntuacio3_3')->nullable();

            $table->float('puntuacio4_1')->nullable();
            $table->float('puntuacio4_2')->nullable();
            $table->float('puntuacio4_3')->nullable();

            $table->float('puntuacio5_1')->nullable();
            $table->float('puntuacio5_2')->nullable();
            $table->float('puntuacio5_3')->nullable();

            $table->float('puntuaciofinal')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grups');
    }
};
