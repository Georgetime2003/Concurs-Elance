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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('categoria');
            $table->string('modalitat');
            $table->string('estils');
            $table->string('subcategoria');
            $table->foreignId('sistema_puntuacio_id1')->constrained('sistema_puntuacio');
            $table->foreignId('sistema_puntuacio_id2')->constrained('sistema_puntuacio');
            $table->foreignId('sistema_puntuacio_id3')->constrained('sistema_puntuacio');
            $table->foreignId('sistema_puntuacio_id4')->constrained('sistema_puntuacio');
            $table->foreignId('sistema_puntuacio_id5')->constrained('sistema_puntuacio');
            $table->timestamps();
        });

        // * Les categories a afegir són
        // * - Amateur:
        // *   - Modalitats: Solo, Duo/Trio, Grupal
        // *   - Estils: Clàssic, Contemporani, Fusió, Jazz,
        // *   - Subcategories: C0 a C5
        // * - Pre-professional:
        // *   - Modalitats: Solo, Duo/Trio
        // *   - Estils: Clàssic, Contemporani
        // *   - Subcategories:
        // *     - C0 a C2 (Solos)
        // *     - C0 (Duo/Trio)
        // TODO: Refactoritzar aquest codi

        $enviar = [];
        for ($i = 0; $i <= 5; $i++) {
            $enviar[] = [
                'categoria' => 'Amateur',
                'modalitat' => 'Solo',
                'estils' => 'Clàssic',
                'subcategoria' => 'C' . $i,
                'sistema_puntuacio_id1' => 1,
                'sistema_puntuacio_id2' => 2,
                'sistema_puntuacio_id3' => 3,
                'sistema_puntuacio_id4' => 4,
                'sistema_puntuacio_id5' => 5,
            ];
        }
        for ($i = 0; $i <= 5; $i++) {
            $enviar[] = [
                'categoria' => 'Amateur',
                'modalitat' => 'Solo',
                'estils' => 'Contemporani',
                'subcategoria' => 'C' . $i,
                'sistema_puntuacio_id1' => 1,
                'sistema_puntuacio_id2' => 2,
                'sistema_puntuacio_id3' => 3,
                'sistema_puntuacio_id4' => 4,
                'sistema_puntuacio_id5' => 5,
            ];
        }
        for ($i = 0; $i <= 5; $i++) {
            $enviar[] = [
                'categoria' => 'Amateur',
                'modalitat' => 'Solo',
                'estils' => 'Fusió',
                'subcategoria' => 'C' . $i,
                'sistema_puntuacio_id1' => 1,
                'sistema_puntuacio_id2' => 2,
                'sistema_puntuacio_id3' => 3,
                'sistema_puntuacio_id4' => 4,
                'sistema_puntuacio_id5' => 5,
            ];
        }
        for ($i = 0; $i <= 5; $i++) {
            $enviar[] = [
                'categoria' => 'Amateur',
                'modalitat' => 'Solo',
                'estils' => 'Jazz',
                'subcategoria' => 'C' . $i,
                'sistema_puntuacio_id1' => 1,
                'sistema_puntuacio_id2' => 2,
                'sistema_puntuacio_id3' => 3,
                'sistema_puntuacio_id4' => 4,
                'sistema_puntuacio_id5' => 5,
            ];
        }
        for ($i = 0; $i <= 5; $i++) {
            $enviar[] = [
                'categoria' => 'Amateur',
                'modalitat' => 'Duos/Trios',
                'estils' => 'Clàssic',
                'subcategoria' => 'C' . $i,
                'sistema_puntuacio_id1' => 1,
                'sistema_puntuacio_id2' => 2,
                'sistema_puntuacio_id3' => 3,
                'sistema_puntuacio_id4' => 6,
                'sistema_puntuacio_id5' => 5,
            ];
        }
        for ($i = 0; $i <= 5; $i++) {
            $enviar[] = [
                'categoria' => 'Amateur',
                'modalitat' => 'Duos/Trios',
                'estils' => 'Contemporani',
                'subcategoria' => 'C' . $i,
                'sistema_puntuacio_id1' => 1,
                'sistema_puntuacio_id2' => 2,
                'sistema_puntuacio_id3' => 3,
                'sistema_puntuacio_id4' => 6,
                'sistema_puntuacio_id5' => 5,
            ];
        }
        for ($i = 0; $i <= 5; $i++) {
            $enviar[] = [
                'categoria' => 'Amateur',
                'modalitat' => 'Duos/Trios',
                'estils' => 'Fusió',
                'subcategoria' => 'C' . $i,
                'sistema_puntuacio_id1' => 1,
                'sistema_puntuacio_id2' => 2,
                'sistema_puntuacio_id3' => 3,
                'sistema_puntuacio_id4' => 6,
                'sistema_puntuacio_id5' => 5,
            ];
        }
        for ($i = 0; $i <= 5; $i++) {
            $enviar[] = [
                'categoria' => 'Amateur',
                'modalitat' => 'Duos/Trios',
                'estils' => 'Jazz',
                'subcategoria' => 'C' . $i,
                'sistema_puntuacio_id1' => 1,
                'sistema_puntuacio_id2' => 2,
                'sistema_puntuacio_id3' => 3,
                'sistema_puntuacio_id4' => 6,
                'sistema_puntuacio_id5' => 5,
            ];
        }
        for ($i = 0; $i <= 5; $i++) {
            $enviar[] = [
                'categoria' => 'Amateur',
                'modalitat' => 'Grupal',
                'estils' => 'Clàssic',
                'subcategoria' => 'C' . $i,
                'sistema_puntuacio_id1' => 1,
                'sistema_puntuacio_id2' => 2,
                'sistema_puntuacio_id3' => 3,
                'sistema_puntuacio_id4' => 7,
                'sistema_puntuacio_id5' => 5,
            ];
        }
        for ($i = 0; $i <= 5; $i++) {
            $enviar[] = [
                'categoria' => 'Amateur',
                'modalitat' => 'Grupal',
                'estils' => 'Contemporani',
                'subcategoria' => 'C' . $i,
                'sistema_puntuacio_id1' => 1,
                'sistema_puntuacio_id2' => 2,
                'sistema_puntuacio_id3' => 3,
                'sistema_puntuacio_id4' => 7,
                'sistema_puntuacio_id5' => 5,
            ];
        }
        for ($i = 0; $i <= 5; $i++) {
            $enviar[] = [
                'categoria' => 'Amateur',
                'modalitat' => 'Grupal',
                'estils' => 'Fusió',
                'subcategoria' => 'C' . $i,
                'sistema_puntuacio_id1' => 1,
                'sistema_puntuacio_id2' => 2,
                'sistema_puntuacio_id3' => 3,
                'sistema_puntuacio_id4' => 7,
                'sistema_puntuacio_id5' => 5,
            ];
        }
        for ($i = 0; $i <= 5; $i++) {
            $enviar[] = [
                'categoria' => 'Amateur',
                'modalitat' => 'Grupal',
                'estils' => 'Jazz',
                'subcategoria' => 'C' . $i,
                'sistema_puntuacio_id1' => 1,
                'sistema_puntuacio_id2' => 2,
                'sistema_puntuacio_id3' => 3,
                'sistema_puntuacio_id4' => 7,
                'sistema_puntuacio_id5' => 5,
            ];
        }

        for ($i = 0; $i <= 2; ++$i){
            $enviar[] = [
                'categoria' => 'Pre-Professional',
                'modalitat' => 'Solo',
                'estils' => 'Clàssic',
                'subcategoria' => 'C' . $i,
                'sistema_puntuacio_id1' => 1,
                'sistema_puntuacio_id2' => 2,
                'sistema_puntuacio_id3' => 8,
                'sistema_puntuacio_id4' => 4,
                'sistema_puntuacio_id5' => 9,
            ];
        }
        for ($i = 0; $i <= 2; ++$i){
            $enviar[] = [
                'categoria' => 'Pre-Professional',
                'modalitat' => 'Solo',
                'estils' => 'Contemporani',
                'subcategoria' => 'C' . $i,
                'sistema_puntuacio_id1' => 1,
                'sistema_puntuacio_id2' => 2,
                'sistema_puntuacio_id3' => 8,
                'sistema_puntuacio_id4' => 4,
                'sistema_puntuacio_id5' => 9,
            ];
        }
        for ($i = 0; $i <= 2; ++$i){
            $enviar[] = [
                'categoria' => 'Pre-Professional',
                'modalitat' => 'Solo',
                'estils' => 'Dues Variacions',
                'subcategoria' => 'C' . $i,
                'sistema_puntuacio_id1' => 1,
                'sistema_puntuacio_id2' => 2,
                'sistema_puntuacio_id3' => 8,
                'sistema_puntuacio_id4' => 4,
                'sistema_puntuacio_id5' => 9,
            ];
        }
        $enviar[] = [
            'categoria' => 'Pre-Professional',
            'modalitat' => 'Duet',
            'estils' => 'Clàssic',
            'subcategoria' => 'C0',
            'sistema_puntuacio_id1' => 1,
            'sistema_puntuacio_id2' => 2,
            'sistema_puntuacio_id3' => 8,
            'sistema_puntuacio_id4' => 4,
            'sistema_puntuacio_id5' => 9,
        ];
        $enviar[] = [
            'categoria' => 'Pre-Professional',
            'modalitat' => 'Duet',
            'estils' => 'Contemporani',
            'subcategoria' => 'C0',
            'sistema_puntuacio_id1' => 1,
            'sistema_puntuacio_id2' => 2,
            'sistema_puntuacio_id3' => 8,
            'sistema_puntuacio_id4' => 4,
            'sistema_puntuacio_id5' => 9,
        ];

        DB::table('categories')->insert($enviar);
        

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
