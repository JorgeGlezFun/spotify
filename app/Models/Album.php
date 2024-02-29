<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table='albumes';

    protected $fillable = [
        'titulo',
        'anyo'
    ];

    use HasFactory;

    public function temas(){
        return $this->belongsToMany(Tema::class, 'albumes_temas', 'album_id', 'tema_id');
    }
}
