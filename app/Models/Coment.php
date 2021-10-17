<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coment extends Model
{
    protected $table = 'coments';
    protected $fillable = [
        'text',
        'anime_id',
        'user_id',
        'parent_id'
    ];

    public function user() {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id');
    }
    public function anime() {
        return $this->belongsTo(
            Anime::class,
            'anime_id',
            'id');
    }
    public function answers() {
        return $this->hasMany(
            Coment::class,
            'parent_id',
            'id');
    }
}
