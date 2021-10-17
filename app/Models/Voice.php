<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voice extends Model
{
    protected $table = 'voices';

    public function animes() {
        return $this->belongsToMany(
            Anime::class,
            'voices_animes',
            'voice_id',
            'anime_id');
    }
}
