<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blocs extends Model
{
    use HasFactory;
    protected $table = 'blocs';

    public function categoria(){
        return $this->belongsTo('App\Models\Categoria', 'categoria_id');
    }
}
