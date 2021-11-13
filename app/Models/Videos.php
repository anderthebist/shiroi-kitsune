<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    protected $table = "videos";
    protected $guarded = [];

    public function anime() {
        return $this->belongsTo('App\Models\Anime')->orderBy('created_at');
    }
}
