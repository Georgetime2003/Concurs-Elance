<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grups extends Model
{
    use HasFactory;
    protected $table = 'grups';
    protected $primaryKey = 'id';
    protected $id = 'id';
    protected $fillable = [
        'nomgrup',
        'descripcio',
        'participants',
        'nPase',
        'puntuacio1_1',
        'puntuacio1_2',
        'puntuacio1_3',
        'puntuacio2_1',
        'puntuacio2_2',
        'puntuacio2_3',
        'puntuacio3_1',
        'puntuacio3_2',
        'puntuacio3_3',
        'puntuacio4_1',
        'puntuacio4_2',
        'puntuacio4_3',
        'puntuacio5_1',
        'puntuacio5_2',
        'puntuacio5_3',
        'puntuaciofinal'
    ];
    protected $participants = [
        'participants'
    ];
}
