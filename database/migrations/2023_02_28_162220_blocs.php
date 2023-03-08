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
        Schema::create('blocs', function (Blueprint $table) {
            $table->id();
            $table->integer('jurats');
            $table->foreignId('categoria_id')->constrained('categories');
            $table->boolean('actiu')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blocs');
    }
};
