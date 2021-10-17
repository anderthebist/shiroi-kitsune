<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = "favorites";

    protected $fillable = [
        'anime_id',
        'user_id'
    ];
}
