<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participants extends Model
{
    use HasFactory;
    protected $table = 'participants';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nom',
        'cognoms',
        'edat'
    ];

}
