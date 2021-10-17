<?php

namespace App\Services;

use App\Models\Anime;

class AnimeService {

    public function search($title = "") {
        return Anime:: query()->where('title', 'LIKE', "%{$title}%")->orWhere('original_title', 'LIKE', "%{$title}%");
    }
}