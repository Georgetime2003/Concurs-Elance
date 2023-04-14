<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blocs_Jutges extends Model
{
    use HasFactory;
    protected $table = 'blocs_jutges';
    protected $fillable = [
        'bloc_id',
        'jutge_id',
        'posicio'
    ];

    public function bloc(){
        return $this->belongsTo(Blocs::class);
    }

    public function jutge(){
        return $this->belongsTo(User::class);
    }
}
