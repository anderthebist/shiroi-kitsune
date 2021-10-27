<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryAnime extends Model
{
    protected $table = 'categories_animes';
    protected $fillable = [
        'anime_id',
        'original_title'
    ];
}
