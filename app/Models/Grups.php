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
        'participants'
    ];
    protected $participants = [
        'participants'
    ];
}
