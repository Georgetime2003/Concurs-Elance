<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sistema_Puntuacio extends Model
{
    use HasFactory;
    protected $table = 'sistema_puntuacio';
    protected $fillable = [
        'id',
        'nom',
    ];
}
