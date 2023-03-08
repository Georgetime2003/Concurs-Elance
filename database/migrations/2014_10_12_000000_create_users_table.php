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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('jutge')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });

        //Crear usuari admin
        $user = new \App\Models\User();
        $user->name = "admin";
        $user->password = \Illuminate\Support\Facades\Hash::make("admin");
        $user->jutge = false;
        $user->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
