<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public function animes() {
        return $this->belongsToMany(
            Anime::class,
            'categories_animes',
            'category_id',
            'anime_id');
    }
}
