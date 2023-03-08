<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participacions extends Model
{
    use HasFactory;
    protected $table = 'participacions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'grup_id',
        'categoria_id',
        'participant_id',
    ];
}
