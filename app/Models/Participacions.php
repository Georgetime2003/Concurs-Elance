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
    //Relacionem la taula participacions amb la taula grups
    public function grups()
    {
        return $this->belongsTo('App\Models\Grups', 'grup_id');
    }
    //Relacionem la taula participacions amb la taula categories
    public function categories()
    {
        return $this->belongsTo('App\Models\Categoria', 'categoria_id');
    }
    //Relacionem la taula participacions amb la taula de participants
    public function participants(){
        return $this->belongsTo('App\Models\Participants', 'participant_id');
    }
}
